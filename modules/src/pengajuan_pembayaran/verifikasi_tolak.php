<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

//AMBIL PURCHASER
$input = $params['input_option'];

	$data_detail2 = array(
		  'RECORD_STATUS' => 'D'
		);

$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_JURNAL";
$this->MYSQL->record = $data_detail2;
$this->MYSQL->dimana = "where RMP_JURNAL_ID='".$input['id_jurnal']."' AND RECORD_STATUS='A'";

if ($this->MYSQL->ubah() == true)
	{
	$this->callback['respon']['pesan'] = "sukses";
	$this->callback['respon']['text_msg'] = $input['id_jurnal'];
	}
  else
	{
	$this->callback['respon']['pesan'] = "gagal";
	$this->callback['respon']['text_msg'] = "Gagal Simpan";
	}

?>
