<?php

if (empty($params['case']))
    {
    $result['respon']['pesan'] == "gagal";
    $result['respon']['pesan'] == "Module tidak dapat di muat";
    echo json_encode($result);
    exit();
    }

$halaman = $params['halaman'];
$batas = $params['batas'];
$input = $params['input_option'];

$kode_wilayah = array('02','03','04','05','06','07','08','09','10');
foreach ($kode_wilayah as $kode)
{
// ------------------------------------------------- 02 ----------------------------------
${sql_.$kode} = "SELECT * FROM
        RMP_FAKTUR AS F LEFT JOIN
        RMP_MASTER_PERSONAL AS P
        ON
        P.RMP_MASTER_PERSONAL_ID=F.RMP_MASTER_PERSONAL_ID
        LEFT JOIN
        RMP_REKENING_RELASI AS RR
        ON
        F.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
        LEFT JOIN RMP_FAKTUR_PURCHASER AS FP
        ON
        F.RMP_FAKTUR_NO_FAKTUR=FP.RMP_FAKTUR_NO_FAKTUR
        WHERE
        RR.RMP_REKENING_RELASI_MATERIAL LIKE '%KOPRA%'
        AND
        F.RMP_FAKTUR_TANGGAL LIKE '%".$input['tanggal']."%'
        AND
        RR.RMP_MASTER_WILAYAH_KODE = '".$kode."'
        AND
        F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%KOPRA%'
        AND
        F.RECORD_STATUS='A'
        AND
        P.RECORD_STATUS='A'
        AND
        RR.RECORD_STATUS='A'
        AND
        FP.RECORD_STATUS='A'
        ORDER BY F.RMP_MASTER_PERSONAL_ID ASC
        ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = ${sql_.$kode};
${result_a_.$kode} = $this->MYSQL->data();

foreach(${result_a_.$kode} as $r)
    {
      $sqlfaktur = "SELECT SUM(FD.RMP_FAKTUR_DETAIL_NETTO) AS KG_BASAH FROM
               RMP_FAKTUR_DETAIL AS FD LEFT JOIN RMP_FAKTUR AS F
               ON FD.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
               WHERE
               FD.RMP_FAKTUR_NO_FAKTUR='".$r['RMP_FAKTUR_NO_FAKTUR']."'
               AND
               FD.RECORD_STATUS='A'
               AND
               F.RECORD_STATUS='A'
               ";
      $this->MYSQL = new MYSQL();
      $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
      $this->MYSQL->queri = $sqlfaktur ;
      $result_faktur= $this->MYSQL->data();
      $r['KG_BASAH'] = $result_faktur[0]['KG_BASAH'];

      $sql2_purchaser = "SELECT *, RECORD_STATUS AS PURCHASER_STATUS FROM
               RMP_FAKTUR_PURCHASER
               WHERE
               RMP_FAKTUR_NO_FAKTUR='".$r['RMP_FAKTUR_NO_FAKTUR']."' AND RECORD_STATUS='A'";
      $this->MYSQL = new MYSQL();
      $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
      $this->MYSQL->queri = $sql2_purchaser ;
      $result_purchaser = $this->MYSQL->data();

      if ($r['RMP_FAKTUR_PURCHASER_KUALITET_QC'] <= 75)
    	{
    		$r['KUALITET'] = $r['RMP_FAKTUR_PURCHASER_KUALITET_QC'] - 2;

    	}
      else{
        $r['KUALITET'] = $r['RMP_FAKTUR_PURCHASER_KUALITET_QC'];
      }
      
      $r['KG_KERING']=number_format(round(($r['KG_BASAH']*$r['RMP_FAKTUR_KUALITET'])/100));
      $r['RP_KERING']=number_format(round(($result_purchaser[0]['RMP_FAKTUR_PURCHASER_RP_KELAPA']/$r['KG_KERING'])));
      $r['TOTAL'] = number_format($result_purchaser[0]['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'],0,",",".");
      $r['RMP_FAKTUR_PURCHASER_RP_KG'] = $result_purchaser[0]['RMP_FAKTUR_PURCHASER_RP_KG'];
      $r['PURCHASER_STATUS'] = $result_purchaser[0]['PURCHASER_STATUS'];

      ${result_.$kode}[] = $r;
    }
  }


  //////////////////// Bulan Ini
  $bulan = date("m",strtotime($input['tanggal']));
  $tahun = date("Y",strtotime($input['tanggal']));
  $mulai_bulan = $tahun.'-'.$bulan.'-01';
  $sqlsum_bulan_ini = "SELECT
                    SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS TOTAL_BULAN_SUM_BRUTO,
                    SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS TOTAL_BULAN_SUM_NETTO,
                    SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS TOTAL_BULAN_SUM_RP
            FROM
            RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
            ON
            FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
            WHERE
            (RMP_FAKTUR_TANGGAL BETWEEN '".$mulai_bulan."'AND '".$input['tanggal']."')
            AND
            F.RMP_FAKTUR_JENIS_MATERIAL = 'KOPRA'
            AND
            FP.RECORD_STATUS='A'
            AND
            F.RECORD_STATUS='A'
           ";
  $this->MYSQL = new MYSQL();
  $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
  $this->MYSQL->queri = $sqlsum_bulan_ini ;
  $result_sum_bulan_a = $this->MYSQL->data();

  $y['TOTAL_BULAN_SUM_BRUTO']=$result_sum_bulan_a[0]['TOTAL_BULAN_SUM_BRUTO'];
  $y['TOTAL_BULAN_SUM_NETTO']=$result_sum_bulan_a[0]['TOTAL_BULAN_SUM_NETTO'];
  $y['TOTAL_BULAN_SUM_RP']=$result_sum_bulan_a[0]['TOTAL_BULAN_SUM_RP'];

  $total[] = $y;


    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = "SUKSES";
    $this->callback['filter'] = $params;
    $this->callback['result_02'] = $result_02;
    $this->callback['result_03'] = $result_03;
    $this->callback['result_04'] = $result_04;
    $this->callback['result_05'] = $result_05;
    $this->callback['result_06'] = $result_06;
    $this->callback['result_07'] = $result_07;
    $this->callback['result_08'] = $result_08;
    $this->callback['result_09'] = $result_09;
    $this->callback['result_10'] = $result_10;
    $this->callback['total'] = $total;

?>
