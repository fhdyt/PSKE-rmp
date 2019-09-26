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

	'RMP_KONFIGURASI_HARGA_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	'RMP_MASTER_MATERIAL_ID' => $input['QUALITED_JENIS_MATERIAL'],
	'ID_SUB_WILAYAH' => $input['SUB_WILAYAH_SUPPLIER'],
	'RMP_KONFIGURASI_HARGA_JENIS_SUPPLIER' => $input['JENIS_SUPPLIER'],
	'RMP_KONFIGURASI_HARGA_KUALITET' => $input['QUALITED_HARGA_QUALITED'],
	'RMP_KONFIGURASI_HARGA_HARGA' => $input['KONFIGURASI_HARGA'],
	'RMP_KONFIGURASI_HARGA_TGL_BERLAKU' => $input['HARGA_TANGGAL_BERLAKU'],
	'RMP_KONFIGURASI_HARGA_TGL_BERAKHIR' => $input['HARGA_TANGGAL_BERAKHIR'],

  'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
  'RECORD_STATUS' => "A"

);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_KONFIGURASI_HARGA";
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
