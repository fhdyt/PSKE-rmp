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
              RMP_MASTER_WILAYAH AS W LEFT JOIN RMP_MASTER_MATERIAL AS M
              ON W.RMP_MASTER_MATERIAL_ID=M.RMP_MASTER_MATERIAL_ID
          WHERE
              W.RMP_MASTER_WILAYAH_PREV_LINK='".$input['ID_WILAYAH']."'
              AND W.RECORD_STATUS='A'
              ORDER BY W.RMP_MASTER_WILAYAH_KODE ASC
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
    //$r['TANGGAL_DAFTAR']=tanggal_format(Date("Y-m-d",strtotime($r['RMP_MASTER_PERSONAL_TANGGAL_DAFTAR'])));
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
    $this->callback['respon']['text_msg'] = "OK..";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;

    }

?>
