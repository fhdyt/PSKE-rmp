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

$tanggal_angka = date("t", strtotime("".$input['tahun']."-".$input['bulan']."-01"));
//$tanggal = date("Y-m-d");
$tanggal = "".$input['tahun']."-".$input['bulan']."-".$tanggal_angka."";

$bulan = date("m",strtotime($tanggal));
$tahun = date("Y",strtotime($tanggal));

$sql = "SELECT
              *,
              CASE WHEN RMP_FAKTUR_KUALITET <= 75 THEN (RMP_FAKTUR_KUALITET-2)
              ELSE RMP_FAKTUR_KUALITET END AS KUALITET_QC
              FROM RMP_FAKTUR
              WHERE
              RMP_FAKTUR_TANGGAL >= '".$tahun."-".$bulan."-01'
              AND
              RMP_FAKTUR_TANGGAL <= '".$tanggal."'
              AND
              RMP_MASTER_PERSONAL_ID = '".$input['supplier']."'
              AND RMP_FAKTUR_JENIS_MATERIAL LIKE '%KOPRA%'
              AND RECORD_STATUS='A'
              ORDER BY RMP_FAKTUR_TANGGAL
        ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql;
$result_a = $this->MYSQL->data();

// -- >>

$no = $posisi + 1;

//$r['TEST'] = 0;
foreach($result_a as $r)
    {
      $r['NO'] = $no;
      $r['RMP_FAKTUR_TANGGAL'] = tanggal_format(Date("Y-m-d",strtotime($r['RMP_FAKTUR_TANGGAL'])));

      $sql2_purchaser = "SELECT *, RECORD_STATUS AS PURCHASER_STATUS FROM
               RMP_FAKTUR_PURCHASER
               WHERE
               RMP_FAKTUR_NO_FAKTUR='".$r['RMP_FAKTUR_NO_FAKTUR']."' AND RECORD_STATUS='A'";
      $this->MYSQL = new MYSQL();
      $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
      $this->MYSQL->queri = $sql2_purchaser ;
      $result_purchaser = $this->MYSQL->data();
      if ($r['RMP_FAKTUR_KUALITET'] <= 75)
    	// {
    	// 	$r['KUALITET_QC'] = $r['RMP_FAKTUR_KUALITET'] - 2;
      //
    	// }
      // else{
      //   $r['KUALITET_QC'] = $r['RMP_FAKTUR_KUALITET'];
      // }

      $r['PURCHASER_STATUS'] = number_format($result_purchaser[0]['PURCHASER_STATUS'],0,",",".");
      $r['BRUTO_KG'] = number_format($result_purchaser[0]['RMP_FAKTUR_PURCHASER_BRUTO'],0,",",".");
      $r['NETTO_KG'] = number_format($result_purchaser[0]['RMP_FAKTUR_PURCHASER_NETTO'],0,",",".");
      $r['KUALITET_FAKTUR'] = number_format($result_purchaser[0]['RMP_FAKTUR_PURCHASER_KUALITET_FAKTUR'],0,",",".");
      $r['RP_KG'] = number_format($result_purchaser[0]['RMP_FAKTUR_PURCHASER_RP_KG'],0,",",".");
      $r['RP_KELAPA'] = number_format($result_purchaser[0]['RMP_FAKTUR_PURCHASER_RP_KELAPA'],0,",",".");
      $r['GONI_RP'] = number_format($result_purchaser[0]['RMP_FAKTUR_PURCHASER_TOTAL_GONI'],0,",",".");
      $r['TAMBANG_RP'] = number_format($result_purchaser[0]['RMP_FAKTUR_PURCHASER_TOTAL_TAMBANG'],0,",",".");
      $r['KERING_KG'] = number_format(($result_purchaser[0]['RMP_FAKTUR_PURCHASER_NETTO']*$r['KUALITET_QC']),0,",",".");
      $r['KERING_KG_NON'] = $result_purchaser[0]['RMP_FAKTUR_PURCHASER_NETTO']*$r['KUALITET_QC'];
      $total_kering_kg += $r['KERING_KG_NON'];

    $result[] = $r;
    $no++;
    }

    $total = "SELECT
                  SUM(F.RMP_FAKTUR_GONI) AS TOTAL_GONI,
                  SUM(P.RMP_FAKTUR_PURCHASER_BRUTO) AS TOTAL_BRUTO,
                  SUM(P.RMP_FAKTUR_PURCHASER_NETTO) AS TOTAL_NETTO,
                  SUM(P.RMP_FAKTUR_PURCHASER_RP_KELAPA) AS TOTAL_KELAPA,
                  SUM(P.RMP_FAKTUR_PURCHASER_TOTAL_GONI) AS TOTAL_GONI_RP,
                  SUM(P.RMP_FAKTUR_PURCHASER_TOTAL_TAMBANG) AS TOTAL_TAMBANG
                  FROM RMP_FAKTUR AS F LEFT JOIN RMP_FAKTUR_PURCHASER AS P
                  ON F.RMP_FAKTUR_NO_FAKTUR=P.RMP_FAKTUR_NO_FAKTUR
                  WHERE
                  F.RMP_FAKTUR_TANGGAL >= '".$tahun."-".$bulan."-01'
                  AND
                  F.RMP_FAKTUR_TANGGAL <= '".$tanggal."'
                  AND
                  F.RMP_MASTER_PERSONAL_ID = '".$input['supplier']."'
                  AND F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%KOPRA%'
                  AND F.RECORD_STATUS='A'
                  AND P.RECORD_STATUS='A'
                  ORDER BY F.RMP_FAKTUR_TANGGAL
            ";

    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $total;
    $result_total= $this->MYSQL->data();
    $x['TOTAL_GONI']=number_format($result_total[0]['TOTAL_GONI'],0,",",".");
    $x['TOTAL_BRUTO']=number_format($result_total[0]['TOTAL_BRUTO'],0,",",".");
    $x['TOTAL_NETTO']=number_format($result_total[0]['TOTAL_NETTO'],0,",",".");
    $x['TOTAL_KELAPA']=number_format($result_total[0]['TOTAL_KELAPA'],0,",",".");
    $x['TOTAL_GONI_RP']=number_format($result_total[0]['TOTAL_GONI_RP'],0,",",".");
    $x['TOTAL_TAMBANG']=number_format($result_total[0]['TOTAL_TAMBANG'],0,",",".");
    $x['TOTAL_KERING_KG']=number_format($total_kering_kg,0,",",".");

    //$x['TOTAL_KERING_KG']=number_format($result_total[0]['TOTAL_KERING_KG'],0,",",".");
$result_total_x[] = $x;
if (empty($result_a))
    {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Data tidak ada.";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result_total'] = $result_total_x;
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = "Data Ada";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result_total'] = $result_total_x;
    }

?>
