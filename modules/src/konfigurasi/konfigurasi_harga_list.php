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

if (empty($input['keyword']) or $input['keyword'] == "")
    {
    $filter_a = "";
    }
  else
    {
    $filter_a = "AND (RMP_MASTER_MATERIAL like '%" . $input['keyword'] . "%')";
    }

$sql = "SELECT * FROM RMP_KONFIGURASI_HARGA AS H
                    LEFT JOIN RMP_MASTER_WILAYAH AS W
                        ON H.ID_SUB_WILAYAH=W.RMP_MASTER_WILAYAH_ID
                    LEFT JOIN RMP_MASTER_MATERIAL AS M
                        ON H.RMP_MASTER_MATERIAL_ID=M.RMP_MASTER_MATERIAL_ID
                        WHERE H.RECORD_STATUS='A'
                        ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql . " limit " . $posisi . "," . $batas;
$result_a = $this->MYSQL->data();

// -- >>

$no = $posisi + 1;

foreach($result_a as $r)
    {
    $r['NO'] = $no;
    $r['TANGGAL_BERLAKU']=tanggal_format(Date("Y-m-d",strtotime($r['RMP_KONFIGURASI_HARGA_TGL_BERLAKU'])));
    $r['TANGGAL_BERAKHIR']=tanggal_format(Date("Y-m-d",strtotime($r['RMP_KONFIGURASI_HARGA_TGL_BERAKHIR'])));
    $sql2 = "SELECT * FROM
                  RMP_MASTER_WILAYAH
              WHERE
                  RMP_MASTER_WILAYAH_ID='".$r['RMP_MASTER_WILAYAH_PREV_LINK']."' AND RECORD_STATUS='A'";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sql2 ;
    $result_b = $this->MYSQL->data();

    foreach($result_b as $rb){
      $r['MASTER_WILAYAH']=$rb['RMP_MASTER_WILAYAH'];
    }
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
    $this->callback['result_option']['jml_halaman'] = $this->pagging(array(
        'sql' => $sql,
        'batas' => $batas
    ))->jmlhalaman;
    }

?>
