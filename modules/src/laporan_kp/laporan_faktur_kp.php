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

$sql = "SELECT
           FP.RECORD_STATUS AS PURCHASER_STATUS,
           FP.RMP_FAKTUR_PURCHASER_BRUTO AS RMP_FAKTUR_PURCHASER_BRUTO,
           RR.RMP_MASTER_WILAYAH_KODE AS RMP_MASTER_WILAYAH_KODE,
           F.RMP_FAKTUR_ALAMAT AS RMP_FAKTUR_ALAMAT,
           F.RMP_FAKTUR_POTONGAN AS RMP_FAKTUR_POTONGAN,
           F.RMP_FAKTUR_ALAMAT AS RMP_FAKTUR_ALAMAT,
           F.RMP_FAKTUR_GONI AS RMP_FAKTUR_GONI,
           FP.RMP_FAKTUR_PURCHASER_TOTAL_GONI AS RMP_FAKTUR_PURCHASER_TOTAL_GONI,
           FP.RMP_FAKTUR_PURCHASER_KUALITET_QC AS RMP_FAKTUR_PURCHASER_KUALITET_QC,
           F.RMP_FAKTUR_KUALITET AS RMP_FAKTUR_KUALITET,
           FP.RMP_FAKTUR_PURCHASER_RP_KELAPA AS RMP_FAKTUR_PURCHASER_RP_KELAPA,
           FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR AS RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR,
           P.RMP_MASTER_PERSONAL_NAMA AS RMP_MASTER_PERSONAL_NAMA,
           FP.RMP_FAKTUR_PURCHASER_NO_REKENING AS RMP_FAKTUR_PURCHASER_NO_REKENING,
           F.RMP_FAKTUR_NO_FAKTUR AS RMP_FAKTUR_NO_FAKTUR,
           FP.RMP_FAKTUR_PURCHASER_RP_KG AS RMP_FAKTUR_PURCHASER_RP_KG,
           F.RMP_FAKTUR_NAMA_SUB AS RMP_FAKTUR_NAMA_SUB,
           F.RMP_FAKTUR_ID AS RMP_FAKTUR_ID
        FROM
        RMP_FAKTUR AS F LEFT JOIN
        RMP_MASTER_PERSONAL AS P
        ON
        P.RMP_MASTER_PERSONAL_ID=F.RMP_MASTER_PERSONAL_ID
        LEFT JOIN
        RMP_REKENING_RELASI AS RR
        ON
        F.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
        LEFT JOIN RMP_FAKTUR_PURCHASER AS FP
        ON F.RMP_FAKTUR_NO_FAKTUR=FP.RMP_FAKTUR_NO_FAKTUR
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
        AND
        FP.RECORD_STATUS='A'
        ORDER BY FP.RMP_FAKTUR_PURCHASER_NO_REKENING ASC
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
    $r['KG_BASAH'] = number_format($result_faktur[0]['KG_BASAH'],0,",",".");
    $r['GONI'] = $r['RMP_FAKTUR_GONI'];

      if ($r['RMP_FAKTUR_PURCHASER_KUALITET_QC'] <= 75)
    	{
    		$r['KUALITET'] = $r['RMP_FAKTUR_PURCHASER_KUALITET_QC'] - 2;

    	}
      else{
        $r['KUALITET'] = $r['RMP_FAKTUR_PURCHASER_KUALITET_QC'];
      }

      $r['KG_KERING']=number_format(round(($result_faktur[0]['KG_BASAH']*$r['KUALITET'])/100),0,",",".");
      $r['KG_KERING2']=($result_faktur[0]['KG_BASAH']*$r['KUALITET'])/100;
      $kg_kering += $r['KG_KERING2'];
      $r['RP_KERING']=number_format(round(($r['RMP_FAKTUR_PURCHASER_RP_KELAPA']/$r['KG_KERING2'])),0,",",".");
      $r['TOTALLL'] = $r['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR']-$r['RMP_FAKTUR_PURCHASER_TOTAL_GONI'];
      $r['TOTAL'] = number_format(($r['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR']-$r['RMP_FAKTUR_PURCHASER_TOTAL_GONI']),0,",",".");
      $r['RMP_FAKTUR_PURCHASER_RP_KG'] = number_format(($r['TOTALLL']/$result_faktur[0]['KG_BASAH']),0,",",".");
      $r['PURCHASER_STATUS'] = $r['PURCHASER_STATUS'];

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


////////////////////////////////////////////////////////////////////////////
$bulan = date("m",strtotime($input['tanggal']));
$tahun = date("Y",strtotime($input['tanggal']));

$sqlsum = "SELECT
                  FP.RECORD_STATUS AS PURCHASER_STATUS,
                  FP.RMP_FAKTUR_PURCHASER_NETTO AS RMP_FAKTUR_PURCHASER_NETTO,
                  FP.RMP_FAKTUR_PURCHASER_BRUTO AS RMP_FAKTUR_PURCHASER_BRUTO,
                  RR.RMP_MASTER_WILAYAH_KODE AS RMP_MASTER_WILAYAH_KODE,
                  F.RMP_FAKTUR_ALAMAT AS RMP_FAKTUR_ALAMAT,
                  F.RMP_FAKTUR_POTONGAN AS RMP_FAKTUR_POTONGAN,
                  F.RMP_FAKTUR_ALAMAT AS RMP_FAKTUR_ALAMAT,
                  F.RMP_FAKTUR_GONI AS RMP_FAKTUR_GONI,
                  FP.RMP_FAKTUR_PURCHASER_TOTAL_GONI AS RMP_FAKTUR_PURCHASER_TOTAL_GONI,
                  FP.RMP_FAKTUR_PURCHASER_KUALITET_QC AS RMP_FAKTUR_PURCHASER_KUALITET_QC,
                  F.RMP_FAKTUR_KUALITET AS RMP_FAKTUR_KUALITET,
                  FP.RMP_FAKTUR_PURCHASER_RP_KELAPA AS RMP_FAKTUR_PURCHASER_RP_KELAPA,
                  FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR AS RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR,
                  FP.RMP_FAKTUR_PURCHASER_NO_REKENING AS RMP_FAKTUR_PURCHASER_NO_REKENING,
                  F.RMP_FAKTUR_NO_FAKTUR AS RMP_FAKTUR_NO_FAKTUR,
                  FP.RMP_FAKTUR_PURCHASER_RP_KG AS RMP_FAKTUR_PURCHASER_RP_KG,
                  F.RMP_FAKTUR_NAMA_SUB AS RMP_FAKTUR_NAMA_SUB,
                  F.RMP_FAKTUR_ID AS RMP_FAKTUR_ID
          FROM
          RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
          ON
          FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
          LEFT JOIN
          RMP_REKENING_RELASI AS RR
          ON
          FP.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
          WHERE
          F.RMP_FAKTUR_TANGGAL = '".$input['tanggal']."'
          AND
          F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%KOPRA%'
          AND
          RR.RMP_REKENING_RELASI_MATERIAL = 'KOPRA'
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
foreach($result_sum as $r)
    {
      if ($r['RMP_FAKTUR_PURCHASER_KUALITET_QC'] <= 75)
    	{
    		$r['KUALITET'] = $r['RMP_FAKTUR_PURCHASER_KUALITET_QC'] - 2;

    	}
      else{
        $r['KUALITET'] = $r['RMP_FAKTUR_PURCHASER_KUALITET_QC'];
      }

      $r['KG_KERING']=round(($r['RMP_FAKTUR_PURCHASER_NETTO']*$r['KUALITET'])/100);

      $hari_goni += $r['RMP_FAKTUR_GONI'];
      $hari_bruto += $r['RMP_FAKTUR_PURCHASER_BRUTO'];
      $hari_netto += $r['RMP_FAKTUR_PURCHASER_NETTO'];
      $hari_rp += $r['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'];
      $hari_goni_total += $r['RMP_FAKTUR_PURCHASER_TOTAL_GONI'];
      $hari_faktur_total += $r['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'];
      $hari_kg_basah += $r['RMP_FAKTUR_PURCHASER_NETTO'];
      $hari_rp_basah += $r['RMP_FAKTUR_PURCHASER_RP_KG'];
      $hari_kg_kering += $r['KG_KERING'];
      $hari_rp_kering += round(($r['RMP_FAKTUR_PURCHASER_RP_KELAPA']/$r['KG_KERING']));
      $hari_kualitet = round(($hari_kg_kering/$hari_kg_basah*100));
      $hari_total = $hari_faktur_total-$hari_goni_total;
    }
$x['SUM_GONI']=number_format($hari_goni,0,",",".");
$x['SUM_BRUTO']=number_format($hari_bruto,0,",",".");
$x['SUM_NETTO']=number_format($hari_netto,0,",",".");
$x['SUM_RP']=number_format($hari_rp,0,",",".");
$x['SUM_KG_BASAH']=number_format($hari_kg_basah,0,",",".");
$x['SUM_RP_BASAH']=number_format(($hari_total/$hari_kg_basah),0,",",".");
$x['SUM_KG_KERING']=number_format($hari_kg_kering,0,",",".");
$x['SUM_TOTAL']=number_format($hari_total,0,",",".");
$x['SUM_RP_KERING']=number_format(($hari_total/$hari_kg_kering));
$x['SUM_KUALITET']=round($hari_kualitet);

// $x['SUM_GONI']=number_format($result_sum[0]['SUM_GONI'],0,",",".");
// $x['SUM_BRUTO']=number_format($result_sum[0]['SUM_BRUTO'],0,",",".");
// $x['SUM_NETTO']=number_format($result_sum[0]['SUM_NETTO'],0,",",".");
// $x['SUM_RP']=number_format($result_sum[0]['SUM_RP'],0,",",".");
// $x['SUM_KG_BASAH']=number_format($result_sum[0]['SUM_KG_BASAH'],0,",",".");
// $x['SUM_RP_BASAH']=number_format($result_sum[0]['SUM_RP_BASAH'],0,",",".");
// $x['SUM_KG_KERING']=number_format($kg_kering,0,",",".");
// $x['SUM_KG_KERING2']=$kg_kering;
// $x['SUM_TOTAL']=number_format(($result_sum[0]['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR']-$result_sum[0]['RMP_FAKTUR_PURCHASER_TOTAL_GONI']),0,",",".");
// $x['SUM_RP_KERING']=number_format(round(($result_sum[0]['RMP_FAKTUR_PURCHASER_RP_KELAPA']/$x['SUM_KG_KERING2'])));

// $sqlsum_bulan_a = "SELECT
//                   SUM(F.RMP_FAKTUR_GONI) AS SUM_GONI_BULAN,
//                   SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS SUM_BRUTO_BULAN,
//                   SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS SUM_NETTO_BULAN,
//                   SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS SUM_RP_BULAN,
//                   SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS SUM_KG_BASAH_BULAN,
//                   SUM(FP.RMP_FAKTUR_PURCHASER_RP_KG) AS SUM_RP_BASAH_BULAN,
//                   SUM(FP.RMP_FAKTUR_PURCHASER_RP_KELAPA) AS RMP_FAKTUR_PURCHASER_RP_KELAPA,
//                   SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR,
//                   SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_GONI) AS RMP_FAKTUR_PURCHASER_TOTAL_GONI,
//                   SUM((FP.RMP_FAKTUR_PURCHASER_NETTO *FP.RMP_FAKTUR_PURCHASER_KUALITET_QC)/100) AS SUM_KG_KERING_BULAN
//           FROM
//           RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
//           ON
//           FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
//           LEFT JOIN
//           RMP_REKENING_RELASI AS RR
//           ON
//           FP.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
//           WHERE
//           F.RMP_FAKTUR_TANGGAL >= '".$tahun."-".$bulan."-01'
//           AND
//           F.RMP_FAKTUR_TANGGAL <= '".$input['tanggal']."'
//           AND
//           F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%KOPRA%'
//           AND
//           RR.RMP_REKENING_RELASI_MATERIAL = 'KOPRA'
//           AND
//           RR.RMP_MASTER_WILAYAH_KODE = '".$input['wilayah']."'
//           AND
//           FP.RECORD_STATUS='A'
//           AND
//           F.RECORD_STATUS='A'
//           AND
//           RR.RECORD_STATUS='A'
//          ";
//
// $this->MYSQL = new MYSQL();
// $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
// $this->MYSQL->queri = $sqlsum_bulan_a ;
// $result_sum_bulan_a = $this->MYSQL->data();
// $x['SUM_GONI_BULAN']=number_format($result_sum_bulan_a[0]['SUM_GONI_BULAN'],0,",",".");
// $x['SUM_BRUTO_BULAN']=number_format($result_sum_bulan_a[0]['SUM_BRUTO_BULAN'],0,",",".");
// $x['SUM_NETTO_BULAN']=number_format($result_sum_bulan_a[0]['SUM_NETTO_BULAN'],0,",",".");
// $x['SUM_RP_BULAN']=number_format($result_sum_bulan_a[0]['SUM_RP_BULAN'],0,",",".");
// $x['SUM_KG_BASAH_BULAN']=number_format($result_sum_bulan_a[0]['SUM_KG_BASAH_BULAN'],0,",",".");
// $x['SUM_RP_BASAH_BULAN']=number_format($result_sum_bulan_a[0]['SUM_RP_BASAH_BULAN'],0,",",".");
// $x['SUM_KG_KERING_BULAN']=number_format($result_sum_bulan_a[0]['SUM_KG_KERING_BULAN'],0,",",".");
// $x['SUM_KG_KERING_BULAN2']=$result_sum_bulan_a[0]['SUM_KG_KERING_BULAN'];
// $x['SUM_TOTAL_BULAN']=number_format(($result_sum_bulan_a[0]['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR']-$result_sum_bulan_a[0]['RMP_FAKTUR_PURCHASER_TOTAL_GONI']),0,",",".");
// $x['SUM_RP_KERING_BULAN']=number_format(round(($result_sum_bulan_a[0]['RMP_FAKTUR_PURCHASER_RP_KELAPA']/$x['SUM_KG_KERING_BULAN2'])));
// $x['SUM_KUALITET_BULAN']=round(($result_sum_bulan_a[0]['SUM_KG_KERING_BULAN']/$result_sum_bulan_a[0]['SUM_KG_BASAH_BULAN']*100));
// $result_bulan[] = $x;



$sqlsum_bulan_a = "SELECT
                      FP.RECORD_STATUS AS PURCHASER_STATUS,
                      FP.RMP_FAKTUR_PURCHASER_NETTO AS RMP_FAKTUR_PURCHASER_NETTO,
                      FP.RMP_FAKTUR_PURCHASER_BRUTO AS RMP_FAKTUR_PURCHASER_BRUTO,
                      RR.RMP_MASTER_WILAYAH_KODE AS RMP_MASTER_WILAYAH_KODE,
                      F.RMP_FAKTUR_ALAMAT AS RMP_FAKTUR_ALAMAT,
                      F.RMP_FAKTUR_POTONGAN AS RMP_FAKTUR_POTONGAN,
                      F.RMP_FAKTUR_ALAMAT AS RMP_FAKTUR_ALAMAT,
                      F.RMP_FAKTUR_GONI AS RMP_FAKTUR_GONI,
                      FP.RMP_FAKTUR_PURCHASER_TOTAL_GONI AS RMP_FAKTUR_PURCHASER_TOTAL_GONI,
                      FP.RMP_FAKTUR_PURCHASER_KUALITET_QC AS RMP_FAKTUR_PURCHASER_KUALITET_QC,
                      F.RMP_FAKTUR_KUALITET AS RMP_FAKTUR_KUALITET,
                      FP.RMP_FAKTUR_PURCHASER_RP_KELAPA AS RMP_FAKTUR_PURCHASER_RP_KELAPA,
                      FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR AS RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR,
                      FP.RMP_FAKTUR_PURCHASER_NO_REKENING AS RMP_FAKTUR_PURCHASER_NO_REKENING,
                      F.RMP_FAKTUR_NO_FAKTUR AS RMP_FAKTUR_NO_FAKTUR,
                      FP.RMP_FAKTUR_PURCHASER_RP_KG AS RMP_FAKTUR_PURCHASER_RP_KG,
                      F.RMP_FAKTUR_NAMA_SUB AS RMP_FAKTUR_NAMA_SUB,
                      F.RMP_FAKTUR_ID AS RMP_FAKTUR_ID
          FROM
          RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
          ON
          FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
          LEFT JOIN
          RMP_REKENING_RELASI AS RR
          ON
          FP.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
          WHERE
          F.RMP_FAKTUR_TANGGAL >= '".$tahun."-".$bulan."-01'
          AND
          F.RMP_FAKTUR_TANGGAL <= '".$input['tanggal']."'
          AND
          F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%KOPRA%'
          AND
          RR.RMP_REKENING_RELASI_MATERIAL = 'KOPRA'
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
$this->MYSQL->queri = $sqlsum_bulan_a ;
$result_sum_bulan_a = $this->MYSQL->data();
foreach($result_sum_bulan_a as $r)
    {
      if ($r['RMP_FAKTUR_PURCHASER_KUALITET_QC'] <= 75)
    	{
    		$r['KUALITET'] = $r['RMP_FAKTUR_PURCHASER_KUALITET_QC'] - 2;

    	}
      else{
        $r['KUALITET'] = $r['RMP_FAKTUR_PURCHASER_KUALITET_QC'];
      }

      $r['KG_KERING']=round(($r['RMP_FAKTUR_PURCHASER_NETTO']*$r['KUALITET'])/100);

      $bulan_goni += $r['RMP_FAKTUR_GONI'];
      $bulan_bruto += $r['RMP_FAKTUR_PURCHASER_BRUTO'];
      $bulan_netto += $r['RMP_FAKTUR_PURCHASER_NETTO'];
      $bulan_rp += $r['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'];
      $bulan_goni_total += $r['RMP_FAKTUR_PURCHASER_TOTAL_GONI'];
      $bulan_faktur_total += $r['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'];
      $bulan_kg_basah += $r['RMP_FAKTUR_PURCHASER_NETTO'];
      $bulan_rp_basah += $r['RMP_FAKTUR_PURCHASER_RP_KG'];
      $bulan_kg_kering += $r['KG_KERING'];
      $bulan_rp_kering += round(($r['RMP_FAKTUR_PURCHASER_RP_KELAPA']/$r['KG_KERING']));
      $bulan_kualitet = round(($bulan_kg_kering/$bulan_kg_basah*100));
      $total = $bulan_faktur_total-$bulan_goni_total;
    }
$x['SUM_GONI_BULAN']=number_format($bulan_goni,0,",",".");
$x['SUM_BRUTO_BULAN']=number_format($bulan_bruto,0,",",".");
$x['SUM_NETTO_BULAN']=number_format($bulan_netto,0,",",".");
$x['SUM_RP_BULAN']=number_format($bulan_rp,0,",",".");
$x['SUM_KG_BASAH_BULAN']=number_format($bulan_kg_basah,0,",",".");
$x['SUM_RP_BASAH_BULAN']=number_format(($total/$bulan_kg_basah),0,",",".");
$x['SUM_KG_KERING_BULAN']=number_format($bulan_kg_kering,0,",",".");
$x['SUM_TOTAL_BULAN']=number_format($total,0,",",".");
$x['SUM_RP_KERING_BULAN']=number_format($total/$bulan_kg_kering);
$x['SUM_KUALITET_BULAN']=round($bulan_kualitet);
$result_bulan[] = $x;

if (empty($result_a))
    {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Data tidak ada";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result_bulan'] = $result_bulan;
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = $sqlsum_bulan;
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result_bulan'] = $result_bulan;
    }

?>
