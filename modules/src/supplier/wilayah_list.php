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
              RMP_WILAYAH AS W,
              INDONESIA_PROVINSI AS P,
              INDONESIA_KABUPATEN AS KAB,
              INDONESIA_KECAMATAN AS KEC,
              INDONESIA_DESA AS D
          WHERE
              W.RMP_WILAYAH_PROVINSI=P.INDONESIA_PROVINSI_ID
          AND
              W.RMP_WILAYAH_KABUPATEN=KAB.INDONESIA_KABUPATEN_ID
          AND
              W.RMP_WILAYAH_KECAMATAN=KEC.INDONESIA_KECAMATAN_ID
          AND
              W.RMP_WILAYAH_DESA=D.INDONESIA_DESA_ID
          AND
              W.RMP_MASTER_PERSONAL_ID='".$input['ID_SUPPLIER']."' AND W.RECORD_STATUS='A'";
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
