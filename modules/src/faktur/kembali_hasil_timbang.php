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
	'EDIT_WAKTU' => date("Y-m-d H:i:s"),
	'EDIT_OPERATOR' => $user_login['PERSONAL_NIK'],
	'RECORD_STATUS' => "D"
);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "PT_PULAU_SAMBU.RMP_FAKTUR_DETAIL";
$this->MYSQL->record = $data_detail3;
$this->MYSQL->dimana = "where RMP_FAKTUR_DETAIL_ID='".$input['ID_TIMBANG']."'";
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
