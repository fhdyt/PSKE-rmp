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

// -- >>

$no = $posisi + 1;

foreach($result_a as $r)
    {
    $r['NO'] = $no;
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
