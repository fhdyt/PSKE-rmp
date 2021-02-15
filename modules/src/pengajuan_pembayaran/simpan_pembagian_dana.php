<?php
$RMP_CONFIG=new RMP_CONFIG();
if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

$input = $params['input_option'];

$data_detail2 = array(
	'FINANCE_PEMBAGIAN_DANA_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	'FINANCE_DANA_MATERIAL_ID' => $input['ID_PEMBAGIAN_DANA_PERIODE'],
	'FINANCE_PEMBAGIAN_DANA_DANA_KASIR' => $input['DANA_KASIR'],
	'FINANCE_PEMBAGIAN_DANA_DANA_CABANG' => $input['DANA_CABANG'],
	'FINANCE_PEMBAGIAN_DANA_DANA_FAKTUR' => $input['DANA_FAKTUR'],


  'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
  'RECORD_STATUS' => "A"
);

$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "FINANCE_PEMBAGIAN_DANA";
$this->MYSQL->record = $data_detail2;
if ($this->MYSQL->simpan() == true)
	{
	$this->callback['respon']['pesan'] = "sukses";
	$this->callback['respon']['text_msg'] = "";
	$this->callback['respon']['no_faktur'] = "";
	}
  else
	{
	$this->callback['respon']['pesan'] = "gagal";
	$this->callback['respon']['text_msg'] = "Gagal Simpan";
	}
