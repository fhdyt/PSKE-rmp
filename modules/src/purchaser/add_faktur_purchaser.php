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

if($input['CEK_RP_KG'] == "true")
{
	$cek_rp = "Y";
}
else
{
	$cek_rp = "N";
}

if($input['CEK_KONTAN'] == "true")
{
	$cek_kontan = "Y";
}
else
{
	$cek_kontan = "N";
}

if($input['CEK_PPH'] == "true")
{
	$cek_pph = "Y";
}
else
{
	$cek_pph = "N";
}




if($input['JENIS_FAKTUR'] == "FAKTUR")
{
	$total_tambang = $input['TOTAL_NETTO']*$input['TAMBANG'];
}
else if($input['JENIS_FAKTUR'] == "FAKTUR CABANG")
{
	$total_tambang = $input['TAMBANG'];
}

$data_detail3 = array(
	'RECORD_STATUS' => "E"
);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_FAKTUR_PURCHASER";
$this->MYSQL->record = $data_detail3;
$this->MYSQL->dimana = "where RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."'";
$this->MYSQL->ubah();

// if($input['ID_FAKTUR_PURCHASER'] != "")
// {
// 	$data_detail3 = array(
// 		'RECORD_STATUS' => "E"
// 	);
// 	$this->MYSQL = new MYSQL;
// 	$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
// 	$this->MYSQL->tabel = "RMP_FAKTUR_PURCHASER";
// 	$this->MYSQL->record = $data_detail3;
// 	$this->MYSQL->dimana = "where RMP_FAKTUR_PURCHASER_ID='".$input['ID_FAKTUR_PURCHASER']."'";
// 	$this->MYSQL->ubah();
// }
// else
// {
// }

if($input['ID_FAKTUR_PURCHASER'] == "")
{
	$faktur_id = waktu_decimal(Date("Y-m-d H:i:s"));
}
else {
	$faktur_id = $input['ID_FAKTUR_PURCHASER'];
}

$data_detail2 = array(
		'RMP_FAKTUR_PURCHASER_ID' => $faktur_id,
	  'RMP_FAKTUR_NO_FAKTUR' => $input['NO_FAKTUR'],
	  'RMP_MASTER_PERSONAL_ID' => $input['PERSONAL_ID'],
	  'RMP_FAKTUR_PURCHASER_BRUTO' => $input['TOTAL_BRUTO'],
	  'RMP_FAKTUR_PURCHASER_NO_REKENING' => $input['NO_REKENING'],
	  'RMP_FAKTUR_PURCHASER_POTONGAN' => $input['POTONGAN'],
	  'RMP_FAKTUR_PURCHASER_NETTO' => $input['TOTAL_NETTO'],
	  'RMP_FAKTUR_PURCHASER_TAMBANG' => $input['TAMBANG'],
	  'RMP_FAKTUR_PURCHASER_TOTAL_TAMBANG' => $total_tambang,
	  'RMP_FAKTUR_PURCHASER_BIAYA' => $input['BIAYA'],
	  'RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR' => $input['TOTAL_SELURUH'],
		'RMP_FAKTUR_PURCHASER_RP_KELAPA' => $input['RP_KELAPA'],
	  'RMP_FAKTUR_PURCHASER_RP_KG' => $input['RP_KG'],
	  'RMP_FAKTUR_PURCHASER_PURCHASER_NIK' => $user_login['PERSONAL_NIK'],
		'RMP_FAKTUR_PURCHASER_CEK_TAMBANG' => $cek_tambang,
		'RMP_FAKTUR_PURCHASER_CEK_BIAYA' => $cek_biaya,
		'RMP_FAKTUR_PURCHASER_CEK_RP' => $cek_rp,
		'RMP_FAKTUR_PURCHASER_KONTAN' => $cek_kontan,
		'RMP_FAKTUR_PURCHASER_PPH' => $input['INPUT_PPH'],
		'RMP_FAKTUR_PURCHASER_UANG_MUKA' => $input['INPUT_UANG_MUKA'],

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
		$data_detail33 = array(
			'RMP_FAKTUR_JENIS' => $input['JENIS_FAKTUR']
		);
		$this->MYSQL = new MYSQL;
		$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
		$this->MYSQL->tabel = "RMP_FAKTUR";
		$this->MYSQL->record = $data_detail33;
		$this->MYSQL->dimana = "where RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."' AND RECORD_STATUS='A'";
		$this->MYSQL->ubah();

	$this->callback['respon']['pesan'] = "sukses";
	$this->callback['respon']['text_msg'] = "Berhasil";
	}
  else
	{
	$this->callback['respon']['pesan'] = "gagal";
	$this->callback['respon']['text_msg'] = "Gagal Simpan";
	}

?>
