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
$posisi = $this->PAGING->cariPosisi($batas, $halaman);
$input = $params['input_option'];

$sql = "SELECT * FROM
        RMP_FAKTUR AS F LEFT JOIN
        RMP_MASTER_PERSONAL AS P
        ON
        P.RMP_MASTER_PERSONAL_ID=F.RMP_MASTER_PERSONAL_ID
        LEFT JOIN
        RMP_REKENING_RELASI AS RR
        ON
        F.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
        WHERE
        RR.RMP_REKENING_RELASI_MATERIAL LIKE '%".$input['material']."%'
        AND
        F.RMP_FAKTUR_TANGGAL LIKE '%".$input['tanggal']."%'
        AND
        RR.RMP_MASTER_WILAYAH_KODE = '".$input['wilayah']."'
        AND
        F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%".$input['material']."%'
        AND
        F.RECORD_STATUS='A'
        AND
        P.RECORD_STATUS='A'
        AND
        RR.RECORD_STATUS='A'
        ORDER BY F.RMP_MASTER_PERSONAL_ID ASC
        ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql;
$result_a = $this->MYSQL->data();

// -- >>

$no = $posisi + 1;

foreach($result_a as $r)
    {
    $r['NO'] = $no;
    $r['TOTAL_BRUTO'] += $r['RMP_FAKTUR_PURCHASER_BRUTO'];
    $r['RMP_MASTER_WILAYAH_KODE']=$r['RMP_MASTER_WILAYAH_KODE'];
    $r['MASTER_WILAYAH']=$r['RMP_FAKTUR_ALAMAT'];
    $potongan = $r['RMP_FAKTUR_POTONGAN'];

    $sql2 = "SELECT * FROM
             RMP_MASTER_WILAYAH
             WHERE
             RMP_MASTER_WILAYAH_ID='".$r['SUB_WILAYAH_ID']."' AND RECORD_STATUS='A'";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sql2 ;
    $result_b = $this->MYSQL->data();

    $sql2_purchaser = "SELECT *, RECORD_STATUS AS PURCHASER_STATUS FROM
             RMP_FAKTUR_PURCHASER
             WHERE
             RMP_FAKTUR_NO_FAKTUR='".$r['RMP_FAKTUR_NO_FAKTUR']."' AND RECORD_STATUS='A'";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sql2_purchaser ;
    $result_purchaser = $this->MYSQL->data();


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

    $bulan = date("m",strtotime($input['tanggal']));
    $tahun = date("Y",strtotime($input['tanggal']));
    $sqlsum_bulan = "SELECT
                      SUM(FP.RMP_FAKTUR_PURCHASER_GONI) AS SUM_GONI_BULAN,
                      SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS SUM_BRUTO_BULAN,
                      SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS SUM_NETTO_BULAN,
                      SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS SUM_RP_BULAN
              FROM
              RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
              ON
              FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
              LEFT JOIN
              RMP_REKENING_RELASI AS RR
              ON
              FP.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
              WHERE
              MONTH(F.RMP_FAKTUR_TANGGAL) = '".$bulan."'
              AND
              YEAR(F.RMP_FAKTUR_TANGGAL) = '".$tahun."'
              AND
              F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%".$input['material']."%'
              AND
              RR.RMP_REKENING_RELASI_MATERIAL = '".$input['material']."'
              AND
              RR.RMP_MASTER_WILAYAH_KODE = '".$input['wilayah']."'
              AND
              FP.RECORD_STATUS='A'
              AND
              F.RECORD_STATUS='A'
              AND
              RR.RECORD_STATUS='A'
             ";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sqlsum_bulan ;
    $result_sum_bulan = $this->MYSQL->data();

    $sqlsum = "SELECT
                      SUM(FP.RMP_FAKTUR_PURCHASER_GONI) AS SUM_GONI,
                      SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS SUM_BRUTO,
                      SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS SUM_NETTO,
                      SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS SUM_RP
              FROM
              RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
              ON
              FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
              LEFT JOIN
              RMP_REKENING_RELASI AS RR
              ON
              FP.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
              WHERE
              F.RMP_FAKTUR_TANGGAL LIKE '%".$input['tanggal']."%'
              AND
              F.RMP_FAKTUR_JENIS_MATERIAL = '".$input['material']."'
              AND
              RR.RMP_REKENING_RELASI_MATERIAL = '".$input['material']."'
              AND
              RR.RMP_MASTER_WILAYAH_KODE = '".$input['wilayah']."'
              AND
              FP.RECORD_STATUS='A'
              AND
              F.RECORD_STATUS='A'
              AND
              RR.RECORD_STATUS='A'
             ";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sqlsum ;
    $result_sum = $this->MYSQL->data();

    $r['SUM_GONI']=number_format($result_sum[0]['SUM_GONI'],0,",",".");
    $r['SUM_BRUTO']=number_format($result_sum[0]['SUM_BRUTO'],0,",",".");
    $r['SUM_NETTO']=number_format($result_sum[0]['SUM_NETTO'],0,",",".");
    $r['SUM_RP']=number_format($result_sum[0]['SUM_RP'],0,",",".");

    $r['SUM_GONI_BULAN']=number_format($result_sum_bulan[0]['SUM_GONI_BULAN'],0,",",".");
    $r['SUM_BRUTO_BULAN']=number_format($result_sum_bulan[0]['SUM_BRUTO_BULAN'],0,",",".");
    $r['SUM_NETTO_BULAN']=number_format($result_sum_bulan[0]['SUM_NETTO_BULAN'],0,",",".");
    $r['SUM_RP_BULAN']=number_format($result_sum_bulan[0]['SUM_RP_BULAN'],0,",",".");


      if ($r['RMP_FAKTUR_KUALITET'] <= 75)
    	{
    		$r['RMP_FAKTUR_KUALITET'] = $r['RMP_FAKTUR_KUALITET'] - 2;

    	}
      else{
        $r['RMP_FAKTUR_KUALITET'] = $r['RMP_FAKTUR_KUALITET'];
      }

      $r['KG_KERING']=number_format(round(($r['KG_BASAH']*$r['RMP_FAKTUR_KUALITET'])/100));
      $r['RP_KERING']=number_format(round(($result_purchaser[0]['RMP_FAKTUR_PURCHASER_RP_KELAPA']/$r['KG_KERING'])));
      $r['TOTAL'] = number_format($result_purchaser[0]['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'],0,",",".");
      $r['RMP_FAKTUR_PURCHASER_RP_KG'] = $result_purchaser[0]['RMP_FAKTUR_PURCHASER_RP_KG'];
      $r['PURCHASER_STATUS'] = $result_purchaser[0]['PURCHASER_STATUS'];







    if (empty($r['RMP_FAKTUR_NAMA_SUB']))
    {
      $r['RMP_MASTER_PERSONAL_NAMA']=$r['RMP_MASTER_PERSONAL_NAMA'];
    }
    else {
      $r['RMP_MASTER_PERSONAL_NAMA']=$r['RMP_MASTER_PERSONAL_NAMA'].' / '.$r['RMP_FAKTUR_NAMA_SUB'];
    }

    $result[] = $r;
    $no++;
    }

if (empty($result_a))
    {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Data tidak ada";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = $sqlsum_bulan;
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result_option']['jml_halaman'] = $this->pagging(array(
        'sql' => $sql,
        'batas' => $batas
    ))->jmlhalaman;
    }

?>
