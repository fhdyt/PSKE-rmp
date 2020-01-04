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

if (empty($input['FILTER_MATERIAL']))
{
  $filter_material = "";
  $filter_material_a = "";
  $filter_material_b = "";
  $filter_material_c = "";
}
else {

  $filter_material = "AND F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%".$input['FILTER_MATERIAL']."%'";
  $filter_material_a = "AND F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%".$input['FILTER_MATERIAL']."-A%'";
  $filter_material_b = "AND F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%".$input['FILTER_MATERIAL']."-B%'";
  $filter_material_c = "AND F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%".$input['FILTER_MATERIAL']."-C%'";
}

$sql = "SELECT * FROM
            RMP_FAKTUR AS F
          LEFT JOIN
            RMP_MASTER_PERSONAL AS P
          ON F.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
          LEFT JOIN
            RMP_FAKTUR_DETAIL AS FD
          ON F.RMP_FAKTUR_NO_FAKTUR=FD.RMP_FAKTUR_NO_FAKTUR
          WHERE
            F.RECORD_STATUS='A'
          AND
            P.RECORD_STATUS='A'
          AND
            F.RMP_FAKTUR_TANGGAL LIKE '%".$input['TANGGAL']."%'
            ".$filter_material."
          GROUP BY
            F.RMP_FAKTUR_NO_FAKTUR
          ORDER BY
            F.ENTRI_WAKTU
          DESC
          ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql ;
$result_a = $this->MYSQL->data();

///////////////// TOTAL KG A
$sql_a = "SELECT SUM(FD.RMP_FAKTUR_DETAIL_NETTO) AS SUM FROM
            RMP_FAKTUR AS F
          LEFT JOIN
            RMP_FAKTUR_DETAIL AS FD
          ON F.RMP_FAKTUR_NO_FAKTUR=FD.RMP_FAKTUR_NO_FAKTUR
          WHERE
            F.RMP_FAKTUR_TANGGAL LIKE '%".$input['TANGGAL']."%'
            ".$filter_material_a."
            AND  F.RECORD_STATUS='A'
          AND FD.RECORD_STATUS='A'
          ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql_a ;
$result_aa = $this->MYSQL->data();
$total_a = $result_a[0]['SUM'];

///////////////// TOTAL KG B
$sql_b = "SELECT SUM(FD.RMP_FAKTUR_DETAIL_NETTO) AS SUM FROM
            RMP_FAKTUR AS F
          LEFT JOIN
            RMP_FAKTUR_DETAIL AS FD
          ON F.RMP_FAKTUR_NO_FAKTUR=FD.RMP_FAKTUR_NO_FAKTUR
          WHERE
            F.RMP_FAKTUR_TANGGAL LIKE '%".$input['TANGGAL']."%'
            ".$filter_material_b."
            AND  F.RECORD_STATUS='A'
          AND FD.RECORD_STATUS='A'
          ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql_b ;
$result_ab = $this->MYSQL->data();
$total_b = $result_a[0]['SUM'];

///////////////// TOTAL KG B
$sql_c = "SELECT SUM(FD.RMP_FAKTUR_DETAIL_NETTO) AS SUM FROM
            RMP_FAKTUR AS F
          LEFT JOIN
            RMP_FAKTUR_DETAIL AS FD
          ON F.RMP_FAKTUR_NO_FAKTUR=FD.RMP_FAKTUR_NO_FAKTUR
          WHERE
            F.RMP_FAKTUR_TANGGAL LIKE '%".$input['TANGGAL']."%'
            ".$filter_material_c."
            AND  F.RECORD_STATUS='A'
          AND FD.RECORD_STATUS='A'
          ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql_c ;
$result_ac = $this->MYSQL->data();
$total_c = $result_a[0]['SUM'];

// -- >>

$no = $posisi + 1;

foreach($result_a as $r)
    {
    $r['NO'] = $no;
    $sql_purchaser = "SELECT * FROM
                RMP_FAKTUR_PURCHASER
              WHERE
                RMP_FAKTUR_NO_FAKTUR = '".$r['RMP_FAKTUR_NO_FAKTUR']."'
                AND RECORD_STATUS='A'
              ";

    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sql_purchaser ;
    $result_purchaser = $this->MYSQL->data();
    if (empty($result_purchaser))
    {
      $r['PURCHASER_STATUS'] = "BELUM DIPROSES";
    }
    else
    {
      $r['PURCHASER_STATUS'] = "TELAH DIPROSES";
    }
    $r['TOTAL_A'] = $result_aa[0]['SUM'];
    $r['TOTAL_B'] = $result_ab[0]['SUM'];
    $r['TOTAL_C'] = $result_ac[0]['SUM'];
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
    $this->callback['respon']['text_msg'] = "OK..".$total_kg;
    $this->callback['respon']['total_kg'] = $total_kg;
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;

    }

?>
