<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

$input = $params['input_option'];
$sql = "SELECT * FROM
              RMP_REKENING
          WHERE
              RMP_REKENING_ID='".$input['ID']."' AND RECORD_STATUS='A'";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql ;
$result_a = $this->MYSQL->data();

$data_detail1 = array(
	'RMP_REKENING_STATUS' => ""
);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_REKENING";
$this->MYSQL->record = $data_detail1;
$this->MYSQL->dimana = "where RMP_MASTER_PERSONAL_ID='".$result_a[0]['RMP_MASTER_PERSONAL_ID']."' AND RMP_REKENING_STATUS='PRIORITAS' AND RECORD_STATUS='A'";
$this->MYSQL->ubah();

$data_detail3 = array(
	'RMP_REKENING_STATUS' => "PRIORITAS"
);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_REKENING";
$this->MYSQL->record = $data_detail3;
$this->MYSQL->dimana = "where RMP_REKENING_ID='".$input['ID']."' AND RECORD_STATUS='A'";
//$this->MYSQL->ubah();

if ($this->MYSQL->ubah() == true)
	{
	$this->callback['respon']['pesan'] = "sukses";
	$this->callback['respon']['text_msg'] = "Berhasil Simpan";
	}
  else
	{
	$this->callback['respon']['pesan'] = "gagal";
	$this->callback['respon']['text_msg'] = "Gagal Simpan";
	}

?>
