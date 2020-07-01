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

$tanggalnota = date("mY");
$sql = "SELECT * FROM
relasi.kopra_".$input['TANGGAL_NOTA']." WHERE relasi='".$input['NO_NOTA']."' GROUP BY recno";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama_relasi_isea;
$database = $this->CONFIG->mysql_koneksi()->db_nama_relasi_isea;
$this->MYSQL->queri = $sql ;
$result_a = $this->MYSQL->data();

// $sql_kapal = "select * from pkb.master_".$input['TANGGAL_NOTA']." AS M
// 													LEFT JOIN
// 													pkb.nota_".$input['TANGGAL_NOTA']." AS N
// 													ON
// 													M.notr=N.notr
// 													WHERE N.notr='".$input['NO_NOTA']."' GROUP BY N.notr";
// $this->MYSQL = new MYSQL();
// $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
// $this->MYSQL->queri = $sql_kapal ;
// $result_kapal = $this->MYSQL->data();
// $kapal = $result_kapal[0]['kapal'];
// -- >>

$no = $posisi + 1;

foreach($result_a as $r)
    {
    $r['NO'] = $no;
    $r['ENTRI']=tanggal_format(Date("Y-m-d",strtotime($r['ENTRI_WAKTU'])));
    $result[] = $r;
    $no++;
    }

if (empty($result_a))
    {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Data tidak ada";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['database'] = $database;
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = "OK..";
    $this->callback['respon']['text_msg2'] = "OK..";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['kapal'] = $kapal;
    $this->callback['database'] = $database;
    }

?>
