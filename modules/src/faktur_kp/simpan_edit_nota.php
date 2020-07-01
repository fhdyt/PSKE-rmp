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

$data_detail3 = array(
	'RMP_FAKTUR_DETAIL_POTONGAN_TEMPURUNG' => $input['POTONGAN_TEMPURUNG_NOTA'],
	'RMP_FAKTUR_DETAIL_POTONGAN_KOPRA_BASAH' => $input['POTONGAN_KOPRA_BASAH_NOTA'],
	'RMP_FAKTUR_DETAIL_BRUTO' => $input['NETTO_NOTA'],
	'RMP_FAKTUR_DETAIL_NETTO' => $input['NETTO_NOTA'],
);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_FAKTUR_DETAIL";
$this->MYSQL->record = $data_detail3;
$this->MYSQL->dimana = "where RMP_FAKTUR_DETAIL_ID='".$input['ID_TIMBANG_NOTA']."'";

if ($this->MYSQL->ubah() == true)
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
