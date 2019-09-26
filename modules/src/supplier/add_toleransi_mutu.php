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
	'RMP_TOLERANSI_MUTU_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
  'RMP_MASTER_PERSONAL_ID' => $input['ID_SUPPLIER'],
  'RMP_TOLERANSI_MUTU_NILAI_MIN' => $input['TOLERANSI_MUTU_NILAI_MIN'],
  'RMP_TOLERANSI_MUTU_NILAI_MAX' => $input['TOLERANSI_MUTU_NILAI_MAX'],
  'RMP_TOLERANSI_MUTU_TANGGAL_BERLAKU' => $input['TOLERANSI_MUTU_TANGGAL_BERLAKU'],
  'RMP_TOLERANSI_MUTU_TANGGAL_BERAKHIR' => $input['TOLERANSI_MUTU_TANGGAL_BERAKHIR'],

  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
  'RECORD_STATUS' => "A"

);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_TOLERANSI_MUTU";
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
