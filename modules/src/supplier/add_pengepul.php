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
  'RMP_MASTER_PENGEPUL_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
  'RMP_MASTER_PENGEPUL_NAMA' => $input['NAMA'],
  'RMP_MASTER_PENGEPUL_KTP' => $input['KTP'],
  'RMP_MASTER_PENGEPUL_NPWP' => $input['NPWP'],
  'RMP_MASTER_PENGEPUL_TANGGAL_DAFTAR' => $input['TANGGAL_DAFTAR'],
  'RMP_MASTER_PENGEPUL_HP' => $input['HP'],
  'RMP_MASTER_PENGEPUL_TELP' => $input['TELP'],
  'RMP_MASTER_PENGEPUL_PROVINSI' => $input['PROVINSI'],
  'RMP_MASTER_PENGEPUL_KABUPATEN' => $input['KABUPATEN'],
  'RMP_MASTER_PENGEPUL_KECAMATAN' => $input['KECAMATAN'],
  'RMP_MASTER_PENGEPUL_DESA' => $input['DESA'],
  'RMP_MASTER_PENGEPUL_ALAMAT' => $input['ALAMAT'],

  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
  'RECORD_STATUS' => "A"

);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_MASTER_PENGEPUL";
$this->MYSQL->record = $data_detail2;
if ($this->MYSQL->simpan() == true)
	{
	$this->callback['respon']['pesan'] = "sukses";
	$this->callback['respon']['text_msg'] = "Berhasil Simpan".$input['NAMA'];
	}
  else
	{
	$this->callback['respon']['pesan'] = "gagal";
	$this->callback['respon']['text_msg'] = "Gagal Simpan";
	}

?>
