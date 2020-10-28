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
                  SUM(F.RMP_FAKTUR_GONI) AS SUM_GONI,
                  SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS SUM_BRUTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS SUM_NETTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS SUM_RP,
                  SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS SUM_KG_BASAH,
                  SUM(FP.RMP_FAKTUR_PURCHASER_RP_KG) AS SUM_RP_BASAH,
                  SUM(FP.RMP_FAKTUR_PURCHASER_RP_KELAPA) AS RMP_FAKTUR_PURCHASER_RP_KELAPA,
                  SUM((FP.RMP_FAKTUR_PURCHASER_NETTO *FP.RMP_FAKTUR_PURCHASER_KUALITET_QC)/100) AS SUM_KG_KERING
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
$x['SUM_GONI']=number_format($result_sum[0]['SUM_GONI'],0,",",".");
$x['SUM_BRUTO']=number_format($result_sum[0]['SUM_BRUTO'],0,",",".");
$x['SUM_NETTO']=number_format($result_sum[0]['SUM_NETTO'],0,",",".");
$x['SUM_RP']=number_format($result_sum[0]['SUM_RP'],0,",",".");
$x['SUM_KG_BASAH']=number_format($result_sum[0]['SUM_KG_BASAH'],0,",",".");
$x['SUM_RP_BASAH']=number_format($result_sum[0]['SUM_RP_BASAH'],0,",",".");
$x['SUM_KG_KERING']=number_format($result_sum[0]['SUM_KG_KERING'],0,",",".");
$x['SUM_TOTAL']=number_format($result_sum[0]['RMP_FAKTUR_PURCHASER_RP_KELAPA'],0,",",".");
$x['SUM_RP_KERING']=number_format(round(($result_sum[0]['RMP_FAKTUR_PURCHASER_RP_KELAPA']/$x['SUM_KG_KERING'])));
$x['TANGGAL'] = tanggal_format(Date("Y-m-d",strtotime($input['tanggal'])));
$sqlsum_bulan_a = "SELECT
                  SUM(F.RMP_FAKTUR_GONI) AS SUM_GONI_BULAN,
                  SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS SUM_BRUTO_BULAN,
                  SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS SUM_NETTO_BULAN,
                  SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS SUM_RP_BULAN,
                  SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS SUM_KG_BASAH_BULAN,
                  SUM(FP.RMP_FAKTUR_PURCHASER_RP_KG) AS SUM_RP_BASAH_BULAN,
                  SUM(FP.RMP_FAKTUR_PURCHASER_RP_KELAPA) AS RMP_FAKTUR_PURCHASER_RP_KELAPA,
                  SUM((FP.RMP_FAKTUR_PURCHASER_NETTO *FP.RMP_FAKTUR_PURCHASER_KUALITET_QC)/100) AS SUM_KG_KERING_BULAN
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
$x['SUM_GONI_BULAN']=number_format($result_sum_bulan_a[0]['SUM_GONI_BULAN'],0,",",".");
$x['SUM_BRUTO_BULAN']=number_format($result_sum_bulan_a[0]['SUM_BRUTO_BULAN'],0,",",".");
$x['SUM_NETTO_BULAN']=number_format($result_sum_bulan_a[0]['SUM_NETTO_BULAN'],0,",",".");
$x['SUM_RP_BULAN']=number_format($result_sum_bulan_a[0]['SUM_RP_BULAN'],0,",",".");
$x['SUM_KG_BASAH_BULAN']=number_format($result_sum_bulan_a[0]['SUM_KG_BASAH_BULAN'],0,",",".");
$x['SUM_RP_BASAH_BULAN']=number_format($result_sum_bulan_a[0]['SUM_RP_BASAH_BULAN'],0,",",".");
$x['SUM_KG_KERING_BULAN']=number_format($result_sum_bulan_a[0]['SUM_KG_KERING_BULAN'],0,",",".");
$x['SUM_TOTAL_BULAN']=number_format($result_sum_bulan_a[0]['RMP_FAKTUR_PURCHASER_RP_KELAPA'],0,",",".");
$x['SUM_RP_KERING_BULAN']=number_format(round(($result_sum_bulan_a[0]['RMP_FAKTUR_PURCHASER_RP_KELAPA']/$x['SUM_KG_KERING_BULAN'])));
$x['SUM_KUALITET_BULAN']=round(($result_sum_bulan_a[0]['SUM_KG_KERING_BULAN']/$result_sum_bulan_a[0]['SUM_KG_BASAH_BULAN']*100));
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
