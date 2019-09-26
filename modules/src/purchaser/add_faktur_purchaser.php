<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

$input = $params['input_option'];

if($input['CEK_TAMBANG'] == "true")
{
	$cek_tambang = "Y";
}
else
{
	$cek_tambang = "N";
}

if($input['CEK_BIAYA'] == "true")
{
	$cek_biaya = "Y";
}
else
{
	$cek_biaya = "N";
}

if($input['ID_FAKTUR_PURCHASER'] != "")
{
	$data_detail3 = array(
		'RECORD_STATUS' => "VV"
	);
	$this->MYSQL = new MYSQL;
	$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
	$this->MYSQL->tabel = "RMP_FAKTUR_PURCHASER";
	$this->MYSQL->record = $data_detail3;
	$this->MYSQL->dimana = "where RMP_FAKTUR_PURCHASER_ID='".$input['ID_FAKTUR_PURCHASER']."'";
	$this->MYSQL->ubah();
}
else{}

	$data_detail3V = array(
		'RMP_FAKTUR_CEK_TAMBANG' => $cek_tambang,
		'RMP_FAKTUR_CEK_BIAYA' => $cek_biaya
	);
	$this->MYSQL = new MYSQL;
	$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
	$this->MYSQL->tabel = "RMP_FAKTUR";
	$this->MYSQL->record = $data_detail3V;
	$this->MYSQL->dimana = "where RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."' AND RECORD_STATUS='A'";
	$this->MYSQL->ubah();

$data_detail2 = array(
		'RMP_FAKTUR_PURCHASER_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	  'RMP_FAKTUR_NO_FAKTUR' => $input['NO_FAKTUR'],
	  'RMP_MASTER_PERSONAL_ID' => $input['PERSONAL_ID'],
	  'RMP_FAKTUR_PURCHASER_TAMBANG' => $input['TAMBANG'],
	  'RMP_FAKTUR_PURCHASER_BIAYA' => $input['BIAYA'],
	  'RMP_FAKTUR_PURCHASER_RP_KG' => $input['RP_KG'],
	  'RMP_FAKTUR_PURCHASER_PURCHASER_NIK' => $user_login['PERSONAL_NIK'],

	  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
	  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
	  'RECORD_STATUS' => "A"
	);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_FAKTUR_PURCHASER";
$this->MYSQL->record = $data_detail2;

if ($this->MYSQL->simpan() == true)
	{
	$this->callback['respon']['pesan'] = "sukses";
	$this->callback['respon']['text_msg'] = "Berhasil";
	}
  else
	{
	$this->callback['respon']['pesan'] = "gagal";
	$this->callback['respon']['text_msg'] = "Gagal Simpan";
	}

?>
