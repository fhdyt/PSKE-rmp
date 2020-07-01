<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

$input = $params['input_option'];
// CEK TAMBAH PROSES ATAU EDIT PROSES

$data_detail2 = array(
	'RMP_FAKTUR_DETAIL_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	'RMP_FAKTUR_NO_FAKTUR' => $input['MANUAL_NO_FAKTUR'],
	'RMP_FAKTUR_DETAIL_NO_NOTA' => $input['MANUAL_NO_NOTA'],
	'RMP_FAKTUR_DETAIL_JENIS_MATERIAL' => $input['MANUAL_MATERIAL'],
	'RMP_FAKTUR_DETAIL_REF' => $input['MANUAL_REF'],
	'RMP_FAKTUR_DETAIL_ID_TIMBANG' => $input['MANUAL_TIMBANG'],
	'RMP_FAKTUR_DETAIL_GROSS' => $input['MANUAL_GROSS'],
	'RMP_FAKTUR_DETAIL_TARA' => $input['MANUAL_TARA'],
	'RMP_FAKTUR_DETAIL_POTONGAN_TEMPURUNG' => $input['MANUAL_TEMPURUNG'],
	'RMP_FAKTUR_DETAIL_POTONGAN_KOPRA_BASAH' => $input['MANUAL_KOPRA_BASAH'],
	'RMP_FAKTUR_DETAIL_BRUTO' => $input['MANUAL_BRUTO'],
	'RMP_FAKTUR_DETAIL_POTONGAN' => $input['MANUAL_POTONGAN'],
	'RMP_FAKTUR_DETAIL_NETTO' => $input['MANUAL_NETTO'],
	'RMP_FAKTUR_DETAIL_TANGGAL' => $input['MANUAL_TANGGAL'],

	'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
	'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
	'RECORD_STATUS' => "N"
);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_FAKTUR_DETAIL";
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
