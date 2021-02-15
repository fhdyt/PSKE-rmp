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

$bulan = date("m",strtotime($input['tanggal']));
$tahun = date("Y",strtotime($input['tanggal']));

$sqlsum = "SELECT
              FP.RECORD_STATUS AS PURCHASER_STATUS,
              FP.RMP_FAKTUR_PURCHASER_NETTO AS RMP_FAKTUR_PURCHASER_NETTO,
              FP.RMP_FAKTUR_PURCHASER_BRUTO AS RMP_FAKTUR_PURCHASER_BRUTO,
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
          WHERE
          F.RMP_FAKTUR_TANGGAL = '".$input['tanggal']."'
          AND
          F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%KOPRA%'
          AND
          FP.RECORD_STATUS='A'
          AND
          F.RECORD_STATUS='A'
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
    $x['SUM_RP_KERING']=number_format($hari_total/$hari_kg_kering);
    $x['SUM_KUALITET']=round($hari_kualitet);

// $x['SUM_GONI']=number_format($result_sum[0]['SUM_GONI'],0,",",".");
// $x['SUM_BRUTO']=number_format($result_sum[0]['SUM_BRUTO'],0,",",".");
// $x['SUM_NETTO']=number_format($result_sum[0]['SUM_NETTO'],0,",",".");
// $x['SUM_RP']=number_format($result_sum[0]['SUM_RP'],0,",",".");
// $x['SUM_KG_BASAH']=number_format($result_sum[0]['SUM_KG_BASAH'],0,",",".");
// $x['SUM_RP_BASAH']=number_format($result_sum[0]['SUM_RP_BASAH'],0,",",".");
// $x['SUM_KG_KERING']=number_format($result_sum[0]['SUM_KG_KERING'],0,",",".");
// $x['SUM_KG_KERING2']=$result_sum[0]['SUM_KG_KERING'];
// $x['SUM_TOTAL']=number_format($result_sum[0]['RMP_FAKTUR_PURCHASER_RP_KELAPA'],0,",",".");
// $x['SUM_RP_KERING']=number_format(round(($result_sum[0]['RMP_FAKTUR_PURCHASER_RP_KELAPA']/$x['SUM_KG_KERING2'])));


$x['TANGGAL'] = tanggal_format(Date("Y-m-d",strtotime($input['tanggal'])));
$sqlsum_bulan_a = "SELECT
                      FP.RECORD_STATUS AS PURCHASER_STATUS,
                      FP.RMP_FAKTUR_PURCHASER_NETTO AS RMP_FAKTUR_PURCHASER_NETTO,
                      FP.RMP_FAKTUR_PURCHASER_BRUTO AS RMP_FAKTUR_PURCHASER_BRUTO,
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
          WHERE
          F.RMP_FAKTUR_TANGGAL >= '".$tahun."-".$bulan."-01'
          AND
          F.RMP_FAKTUR_TANGGAL <= '".$input['tanggal']."'
          AND
          F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%KOPRA%'
          AND
          FP.RECORD_STATUS='A'
          AND
          F.RECORD_STATUS='A'
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

// $x['SUM_GONI_BULAN']=number_format($result_sum_bulan_a[0]['SUM_GONI_BULAN'],0,",",".");
// $x['SUM_BRUTO_BULAN']=number_format($result_sum_bulan_a[0]['SUM_BRUTO_BULAN'],0,",",".");
// $x['SUM_NETTO_BULAN']=number_format($result_sum_bulan_a[0]['SUM_NETTO_BULAN'],0,",",".");
// $x['SUM_RP_BULAN']=number_format($result_sum_bulan_a[0]['SUM_RP_BULAN'],0,",",".");
// $x['SUM_KG_BASAH_BULAN']=number_format($result_sum_bulan_a[0]['SUM_KG_BASAH_BULAN'],0,",",".");
// $x['SUM_RP_BASAH_BULAN']=number_format($result_sum_bulan_a[0]['SUM_RP_BASAH_BULAN'],0,",",".");
// $x['SUM_KG_KERING_BULAN']=number_format($result_sum_bulan_a[0]['SUM_KG_KERING_BULAN'],0,",",".");
// $x['SUM_KG_KERING_BULAN2']=$result_sum_bulan_a[0]['SUM_KG_KERING_BULAN'];
// $x['SUM_TOTAL_BULAN']=number_format($result_sum_bulan_a[0]['RMP_FAKTUR_PURCHASER_RP_KELAPA'],0,",",".");
// $x['SUM_RP_KERING_BULAN']=number_format(round(($result_sum_bulan_a[0]['RMP_FAKTUR_PURCHASER_RP_KELAPA']/$x['SUM_KG_KERING_BULAN2'])));
// $x['SUM_KUALITET_BULAN']=round(($result_sum_bulan_a[0]['SUM_KG_KERING_BULAN']/$result_sum_bulan_a[0]['SUM_KG_BASAH_BULAN']*100));
$result_bulan[] = $x;

if (empty($result_sum_bulan_a))
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
    $this->callback['respon']['text_msg'] = "Data Sukses";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result_bulan'] = $result_bulan;
    }

?>
