<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

$input = $params['input_option'];
if($input['QUALITED'] == 'on')
{
	$qualited = "ALLOW";
}
else
{
	$qualited = "";
}
$data_detail2 = array(
	'RMP_KONFIGURASI_PETUGAS_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	'RMP_KONFIGURASI_PETUGAS_TIPE' => $input['PETUGAS'],
	'RMP_KONFIGURASI_PETUGAS_NIK' => $input['NIK_PETUGAS'],
	'RMP_KONFIGURASI_PETUGAS_NAMA' => $input['PETUGAS_NAMA'],

  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
  'RECORD_STATUS' => "A"

);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_KONFIGURASI_PETUGAS";
$this->MYSQL->record = $data_detail2;
if ($this->MYSQL->simpan() == true)
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
