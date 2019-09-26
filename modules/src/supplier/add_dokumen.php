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
  'RMP_DOKUMEN_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	'RMP_DOKUMEN_FOTO' => $input['FOTO_DOKUMEN'],
	'RMP_DOKUMEN_JENIS' => $input['JENIS_DOKUMEN'],
	'RMP_DOKUMEN_STATUS' => $input['STATUS_BERLAKU'],
	'RMP_DOKUMEN_TANGGAL_BERLAKU' => $input['TANGGAL_BERLAKU_DOKUMEN'],


  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
  'RECORD_STATUS' => "A"

);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_DOKUMEN";
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
