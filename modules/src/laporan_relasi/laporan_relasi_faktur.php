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

$sql = "SELECT
              *
              FROM RMP_FAKTUR
              WHERE
              RMP_FAKTUR_TANGGAL >= '" . $tahun . "-" . $bulan . "-01'
              AND
              RMP_FAKTUR_TANGGAL <= '" . $tanggal . "'
              AND
              RMP_MASTER_PERSONAL_ID = '" . $input['supplier'] . "'
              AND RMP_FAKTUR_JENIS_MATERIAL LIKE '%" . $input['material'] . "%'
              AND RECORD_STATUS='A'
              ORDER BY RMP_FAKTUR_TANGGAL
        ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql;
$result_a = $this->MYSQL->data();

// -- >>

$no = $posisi + 1;

foreach ($result_a as $r) {
  $r['NO'] = $no;
  $r['RMP_FAKTUR_TANGGAL'] = tanggal_format(Date("Y-m-d", strtotime($r['RMP_FAKTUR_TANGGAL'])));

  $sql2_purchaser = "SELECT *, RECORD_STATUS AS PURCHASER_STATUS FROM
               RMP_FAKTUR_PURCHASER
               WHERE
               RMP_FAKTUR_NO_FAKTUR='" . $r['RMP_FAKTUR_NO_FAKTUR'] . "' AND RECORD_STATUS='A'";
  $this->MYSQL = new MYSQL();
  $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
  $this->MYSQL->queri = $sql2_purchaser;
  $result_purchaser = $this->MYSQL->data();
  $r['TOTAL_BRUTO'] += $r['RMP_FAKTUR_PURCHASER_BRUTO'];
  $r['RMP_MASTER_WILAYAH_KODE'] = $r['RMP_MASTER_WILAYAH_KODE'];
  $r['PURCHASER_STATUS'] = $result_purchaser[0]['PURCHASER_STATUS'];
  $r['TOTAL_RUPIAH'] = $result_purchaser[0]['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'];
  $grade_kelapa = substr($r['RMP_FAKTUR_JENIS_MATERIAL'], -1);

  $sql23 = "SELECT * FROM
               RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
               ON FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
               WHERE
               FP.RMP_FAKTUR_NO_FAKTUR='" . $r['RMP_FAKTUR_NO_FAKTUR'] . "'
               AND
               FP.RECORD_STATUS='A'
               AND
               F.RECORD_STATUS='A'
               GROUP BY FP.RMP_FAKTUR_NO_FAKTUR
               ";
  $this->MYSQL = new MYSQL();
  $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
  $this->MYSQL->queri = $sql23;
  $result_b3 = $this->MYSQL->data();

  if ($grade_kelapa == 'A') {
    foreach ($result_b3 as $rb3) {
      $r['PURCHASER_RP_KG'] = $rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'] / $rb3['RMP_FAKTUR_PURCHASER_NETTO'];
      $r['RP_A'] = number_format($rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'], 0, ",", ".");
      $r['RP_B'] = "";
      $r['RP_C'] = "";

      $r['BRUTO_A'] = number_format($rb3['RMP_FAKTUR_PURCHASER_BRUTO'], 0, ",", ".");
      $r['BRUTO_B'] = "";
      $r['BRUTO_C'] = "";

      $r['PERSEN_A'] = number_format($rb3['RMP_FAKTUR_POTONGAN'], 0, ",", ".");
      $r['PERSEN_B'] = "";
      $r['PERSEN_C'] = "";

      $r['NETTO_A'] = number_format($rb3['RMP_FAKTUR_PURCHASER_NETTO'], 0, ",", ".");
      $r['NETTO_B'] = "";
      $r['NETTO_C'] = "";

      $r['RP_KG_A'] = number_format($r['PURCHASER_RP_KG'], 0, ",", ".");
      $r['RP_KG_B'] = "";
      $r['RP_KG_C'] = "";
    }
  } else if ($grade_kelapa == 'B') {
    foreach ($result_b3 as $rb3) {
      $r['PURCHASER_RP_KG'] = $rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'] / $rb3['RMP_FAKTUR_PURCHASER_NETTO'];
      $r['RP_B'] = number_format($rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'], 0, ",", ".");
      $r['RP_A'] = "";
      $r['RP_C'] = "";

      $r['BRUTO_B'] = number_format($rb3['RMP_FAKTUR_PURCHASER_BRUTO'], 0, ",", ".");
      $r['BRUTO_A'] = "";
      $r['BRUTO_C'] = "";

      $r['PERSEN_B'] = number_format($rb3['RMP_FAKTUR_POTONGAN'], 0, ",", ".");
      $r['PERSEN_A'] = "";
      $r['PERSEN_C'] = "";

      $r['NETTO_B'] = number_format($rb3['RMP_FAKTUR_PURCHASER_NETTO'], 0, ",", ".");
      $r['NETTO_A'] = "";
      $r['NETTO_C'] = "";

      $r['RP_KG_B'] = number_format($r['PURCHASER_RP_KG'], 0, ",", ".");
      //$r['RP_KG_B']=number_format($rb3['RMP_FAKTUR_PURCHASER_RP_KG'],0,",",".");
      $r['RP_KG_A'] = "";
      $r['RP_KG_C'] = "";
    }
  } else if ($grade_kelapa == 'C') {
    foreach ($result_b3 as $rb3) {
      $r['PURCHASER_RP_KG'] = $rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'] / $rb3['RMP_FAKTUR_PURCHASER_NETTO'];
      $r['RP_C'] = number_format($rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'], 0, ",", ".");
      $r['RP_A'] = "";
      $r['RP_B'] = "";

      $r['BRUTO_C'] = number_format($rb3['RMP_FAKTUR_PURCHASER_BRUTO'], 0, ",", ".");
      $r['BRUTO_A'] = "";
      $r['BRUTO_B'] = "";

      $r['PERSEN_C'] = number_format($rb3['RMP_FAKTUR_POTONGAN'], 0, ",", ".");
      $r['PERSEN_A'] = "";
      $r['PERSEN_B'] = "";

      $r['NETTO_C'] = number_format($rb3['RMP_FAKTUR_PURCHASER_NETTO'], 0, ",", ".");
      $r['NETTO_A'] = "";
      $r['NETTO_B'] = "";

      $r['RP_KG_C'] = number_format($r['PURCHASER_RP_KG'], 0, ",", ".");
      $r['RP_KG_A'] = "";
      $r['RP_KG_B'] = "";
    }
  }
  $result[] = $r;
  $no++;
}




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
