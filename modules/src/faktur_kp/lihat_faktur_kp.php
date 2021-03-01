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


$sql = "SELECT *, F.RECORD_STATUS AS FAKTUR_RECORD_STATUS FROM
            RMP_FAKTUR AS F
          WHERE
            F.RMP_FAKTUR_TANGGAL LIKE '%" . $input['TANGGAL'] . "%'
            AND F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%KOPRA%'
            AND F.RECORD_STATUS IN ('A','N')
          GROUP BY
            F.RMP_FAKTUR_NO_FAKTUR
          ORDER BY
            F.RMP_FAKTUR_NO_FAKTUR
          DESC
          ";
// $sql = "SELECT *, F.RECORD_STATUS AS FAKTUR_RECORD_STATUS FROM
//             RMP_FAKTUR AS F
//           LEFT JOIN
//             RMP_MASTER_PERSONAL AS P
//           ON F.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
//           WHERE
//             F.RMP_FAKTUR_TANGGAL LIKE '%".$input['TANGGAL']."%'
//             AND F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%KOPRA%'
//             AND (F.RECORD_STATUS='A' OR F.RECORD_STATUS='N')
//           GROUP BY
//             F.RMP_FAKTUR_NO_FAKTUR
//           ORDER BY
//             F.ENTRI_WAKTU
//           ASC
//           ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql;
$result_a = $this->MYSQL->data();

///////////////// TOTAL KG A
$sql_a = "SELECT *,SUM(FD.RMP_FAKTUR_DETAIL_NETTO) AS SUM FROM
            RMP_FAKTUR AS F
          LEFT JOIN
            RMP_FAKTUR_DETAIL AS FD
          ON F.RMP_FAKTUR_NO_FAKTUR=FD.RMP_FAKTUR_NO_FAKTUR
          WHERE
            F.RMP_FAKTUR_TANGGAL LIKE '%" . $input['TANGGAL'] . "%'
            AND F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%KOPRA%'
            AND  F.RECORD_STATUS='A'
          AND FD.RECORD_STATUS='A'
          ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql_a;
$result_aa = $this->MYSQL->data();
foreach ($result_sum as $r) {
}

// -- >>

$no = $posisi + 1;

foreach ($result_a as $r) {
  $r['NO'] = $no;
  $sql_a = "SELECT *, SUM(FD.RMP_FAKTUR_DETAIL_NETTO)AS SUM FROM
                RMP_FAKTUR AS F
              LEFT JOIN
                RMP_FAKTUR_DETAIL AS FD
              ON F.RMP_FAKTUR_NO_FAKTUR=FD.RMP_FAKTUR_NO_FAKTUR
              WHERE
                F.RMP_FAKTUR_NO_FAKTUR = '" . $r['RMP_FAKTUR_NO_FAKTUR'] . "'
                AND  F.RECORD_STATUS='A'
              AND FD.RECORD_STATUS='A'
              ";

  $this->MYSQL = new MYSQL();
  $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
  $this->MYSQL->queri = $sql_a;
  $result_aa = $this->MYSQL->data();





  $sql_supplier = "SELECT * FROM
                RMP_MASTER_PERSONAL
              WHERE
                RMP_MASTER_PERSONAL_ID = '" . $r['RMP_MASTER_PERSONAL_ID'] . "'
                AND RECORD_STATUS='A'
              ";

  $this->MYSQL = new MYSQL();
  $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
  $this->MYSQL->queri = $sql_supplier;
  $result_supplier = $this->MYSQL->data();

  $sql_purchaser = "SELECT * FROM
                RMP_FAKTUR_PURCHASER
              WHERE
                RMP_FAKTUR_NO_FAKTUR = '" . $r['RMP_FAKTUR_NO_FAKTUR'] . "'
                AND RECORD_STATUS='A'
              ";

  $this->MYSQL = new MYSQL();
  $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
  $this->MYSQL->queri = $sql_purchaser;
  $result_purchaser = $this->MYSQL->data();
  if (empty($result_purchaser)) {
    $r['PURCHASER_STATUS'] = "BELUM DIPROSES";
  } else {
    $r['PURCHASER_STATUS'] = "TELAH DIPROSES";
  }

  $r['TOTAL_A'] = $result_aa[0]['SUM'];
  $r['RMP_MASTER_PERSONAL_NAMA'] = $result_supplier[0]['RMP_MASTER_PERSONAL_NAMA'];

  if ($r['RMP_MASTER_PERSONAL_NAMA'] == "PKB") {
    $r['KUALITET'] = intval($r['RMP_FAKTUR_KUALITET']);
  } else {
    if (intval($r['RMP_FAKTUR_KUALITET']) <= 75) {
      $r['KUALITET'] = intval($r['RMP_FAKTUR_KUALITET']) - 2;
    } else {
      $r['KUALITET'] = intval($r['RMP_FAKTUR_KUALITET']);
    }
  }


  $r['BRUTO'] = $result_aa[0]['SUM'];
  $r['POTONGAN'] = $r['BRUTO'] * ($result_aa[0]['RMP_FAKTUR_POTONGAN'] / 100);
  $r['TOTAL_POTONGAN'] = number_format($r['POTONGAN'], 0, ",", ".");
  $r['NETTO'] = $r['BRUTO'] - round($r['POTONGAN']);
  $r['KERING'] = round($r['NETTO'] * $r['KUALITET'] / 100);

  $result[] = $r;
  $no++;
}

if (empty($result_a)) {
  $this->callback['respon']['pesan'] = "gagal";
  $this->callback['respon']['text_msg'] = "Data tidak ada";
  $this->callback['filter'] = $params;
  $this->callback['result'] = $result;
} else {
  $this->callback['respon']['pesan'] = "sukses";
  $this->callback['respon']['text_msg'] = "OK.." . $total_kg;
  $this->callback['respon']['total_kg'] = $total_kg;
  $this->callback['filter'] = $params;
  $this->callback['result'] = $result;
}
