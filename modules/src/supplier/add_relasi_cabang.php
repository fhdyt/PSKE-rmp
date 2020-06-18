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
  'RMP_RELASI_CABANG_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	'RMP_RELASI_CABANG_NAMA' => $input['NAMA_RELASI_CABANG'],
	'RMP_RELASI_CABANG_NO' => $input['NO_RELASI_CABANG'],
	'RMP_RELASI_CABANG_ALAMAT' => $input['ALAMAT_RELASI_CABANG'],
	'RMP_RELASI_CABANG_KTP' => $input['KTP_RELASI_CABANG'],
	'RMP_RELASI_CABANG_HP' => $input['HP_RELASI_CABANG'],
	'RMP_RELASI_CABANG_PREV_LINK' => $input['RELASI_MASTER_RELASI_CABANG'],


  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
  'RECORD_STATUS' => "A"

);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_RELASI_CABANG";
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
