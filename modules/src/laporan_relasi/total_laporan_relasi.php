<?php

if (empty($params['case'])) {
    $result['respon']['pesan'] == "gagal";
    $result['respon']['pesan'] == "Module tidak dapat di muat";
    echo json_encode($result);
    exit();
}

$halaman = $params['halaman'];
$batas = $params['batas'];
$posisi = $this->PAGING->cariPosisi($batas, $halaman);
$input = $params['input_option'];

$tanggal_angka = date("t", strtotime("" . $input['tahun'] . "-" . $input['bulan'] . "-01"));
$tanggal = "" . $input['tahun'] . "-" . $input['bulan'] . "-" . $tanggal_angka . "";
$bulan = date("m", strtotime($tanggal));
$tahun = date("Y", strtotime($tanggal));

$sql_a = "SELECT
              *,
              SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS TOTAL_SUM_BRUTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS TOTAL_SUM_NETTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS TOTAL_SUM_RP
                  FROM
              RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
          ON
          FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
              WHERE
              F.RMP_FAKTUR_TANGGAL >= '" . $tahun . "-" . $bulan . "-01'
              AND
              F.RMP_FAKTUR_TANGGAL <= '" . $tanggal . "'
              AND
          F.RMP_FAKTUR_JENIS_MATERIAL = '" . $input['material'] . "-A'
          AND
              FP.RMP_MASTER_PERSONAL_ID = '" . $input['supplier'] . "'
              AND F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%" . $input['material'] . "%'
              AND F.RECORD_STATUS='A'
              AND FP.RECORD_STATUS='A'
        ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql_a;
$result_a = $this->MYSQL->data();

$sql_b = "SELECT
              *,
              SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS TOTAL_SUM_BRUTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS TOTAL_SUM_NETTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS TOTAL_SUM_RP
                  FROM
              RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
          ON
          FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
              WHERE
              F.RMP_FAKTUR_TANGGAL >= '" . $tahun . "-" . $bulan . "-01'
              AND
              F.RMP_FAKTUR_TANGGAL <= '" . $tanggal . "'
              AND
          F.RMP_FAKTUR_JENIS_MATERIAL = '" . $input['material'] . "-B'
          AND
              FP.RMP_MASTER_PERSONAL_ID = '" . $input['supplier'] . "'
              AND F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%" . $input['material'] . "%'
              AND F.RECORD_STATUS='A'
              AND FP.RECORD_STATUS='A'
        ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql_b;
$result_b = $this->MYSQL->data();

$sql_c = "SELECT
              *,
              SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS TOTAL_SUM_BRUTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS TOTAL_SUM_NETTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS TOTAL_SUM_RP
                  FROM
              RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
          ON
          FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
              WHERE
              F.RMP_FAKTUR_TANGGAL >= '" . $tahun . "-" . $bulan . "-01'
              AND
              F.RMP_FAKTUR_TANGGAL <= '" . $tanggal . "'
              AND
          F.RMP_FAKTUR_JENIS_MATERIAL = '" . $input['material'] . "-C'
          AND
              FP.RMP_MASTER_PERSONAL_ID = '" . $input['supplier'] . "'
              AND F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%" . $input['material'] . "%'
              AND F.RECORD_STATUS='A'
              AND FP.RECORD_STATUS='A'
        ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql_c;
$result_c = $this->MYSQL->data();

$x['TOTAL_SUM_BRUTO_A'] = number_format($result_a[0]['TOTAL_SUM_BRUTO'], 0, ",", ".");
$x['TOTAL_SUM_PERSEN_A'] = round((($result_a[0]['TOTAL_SUM_BRUTO'] - $result_a[0]['TOTAL_SUM_NETTO']) / $result_a[0]['TOTAL_SUM_BRUTO']) * 100);
$x['TOTAL_SUM_NETTO_A'] = number_format($result_a[0]['TOTAL_SUM_NETTO'], 0, ",", ".");
$x['TOTAL_SUM_RP_A'] = number_format($result_a[0]['TOTAL_SUM_RP'], 0, ",", ".");

$x['TOTAL_SUM_BRUTO_B'] = number_format($result_b[0]['TOTAL_SUM_BRUTO'], 0, ",", ".");
$x['TOTAL_SUM_PERSEN_B'] = round((($result_b[0]['TOTAL_SUM_BRUTO'] - $result_b[0]['TOTAL_SUM_NETTO']) / $result_b[0]['TOTAL_SUM_BRUTO']) * 100);
$x['TOTAL_SUM_NETTO_B'] = number_format($result_b[0]['TOTAL_SUM_NETTO'], 0, ",", ".");
$x['TOTAL_SUM_RP_B'] = number_format($result_b[0]['TOTAL_SUM_RP'], 0, ",", ".");

$x['TOTAL_SUM_BRUTO_C'] = number_format($result_c[0]['TOTAL_SUM_BRUTO'], 0, ",", ".");
$x['TOTAL_SUM_PERSEN_C'] = round((($result_c[0]['TOTAL_SUM_BRUTO'] - $result_c[0]['TOTAL_SUM_NETTO']) / $result_c[0]['TOTAL_SUM_BRUTO']) * 100);
$x['TOTAL_SUM_NETTO_C'] = number_format($result_c[0]['TOTAL_SUM_NETTO'], 0, ",", ".");
$x['TOTAL_SUM_RP_C'] = number_format($result_c[0]['TOTAL_SUM_RP'], 0, ",", ".");

$result[] = $x;





if (empty($result_a)) {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = $tanggal;
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
} else {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = "Data Ada";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
}
