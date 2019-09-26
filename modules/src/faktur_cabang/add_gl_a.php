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

	'RMP_REKAP_FC_DETAIL_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	'RMP_REKAP_FC_ID' => $input['ID_FAKTUR_CABANG'],
	'RMP_MASTER_PERSONAL_ID' => $input['NAMA_SUPPLIER'],
	'RMP_REKAP_FC_DETAIL_JENIS' => $input['JENIS'],
	'RMP_REKAP_FC_DETAIL_TANGGAL' => date("Y-m-d"),
	'RMP_REKAP_FC_DETAIL_NO_FAKTUR' => $input['NO_FAKTUR'],
	'RMP_REKAP_FC_DETAIL_BRUTO' => $input['BRUTO'],
	'RMP_REKAP_FC_DETAIL_POTONGAN' => $input['POTONGAN'],
	'RMP_REKAP_FC_DETAIL_NETTO' => $input['NETTO'],
	'RMP_REKAP_FC_DETAIL_RP_KG' => $input['RP_KG'],
	'RMP_REKAP_FC_DETAIL_RUPIAH' => $input['RUPIAH'],

  'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
  'RECORD_STATUS' => "A"

);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_REKAP_FC_DETAIL";
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
