<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

$input = $params['input_option'];
$data_detail3 = array(
	'RECORD_STATUS' => "R"
);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_PENYESUAIAN_HARGA_KB";
$this->MYSQL->record = $data_detail3;
$this->MYSQL->dimana = "where RMP_PENYESUAIAN_HARGA_KB_ID='".$input['ID']."'";

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
