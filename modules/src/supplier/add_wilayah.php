<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

$input = $params['input_option'];
$data_detail2 = array(
  'RMP_MASTER_PERSONAL_ID' => $input['ID_SUPPLIER'],
  'RMP_WILAYAH_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	'RMP_WILAYAH_PROVINSI' => $input['PROVINSI2'],
	'RMP_WILAYAH_KABUPATEN' => $input['KABUPATEN2'],
	'RMP_WILAYAH_KECAMATAN' => $input['KECAMATAN2'],
	'RMP_WILAYAH_DESA' => $input['DESA2'],
	'RMP_WILAYAH_ALAMAT' => $input['ALAMAT2'],
	'RMP_WILAYAH_NAIK_WILAYAH' => $input['NAIK_WILAYAH'],
	'RMP_WILAYAH_BARIS_WILAYAH' => $input['BARIS_WILAYAH'],
	'RMP_WILAYAH_PANJANG_WILAYAH' => $input['PANJANG_WILAYAH'],
	'RMP_WILAYAH_LUAS' => $input['LUAS_WILAYAH'],
	'RMP_WILAYAH_LUAS_BARIS_NAIK' => $input['LUAS_BARIS_NAIK_WILAYAH'],
	'RMP_WILAYAH_LEBAR_WILAYAH' => $input['LEBAR_WILAYAH'],

  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
  'RECORD_STATUS' => "A"

);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_WILAYAH";
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
