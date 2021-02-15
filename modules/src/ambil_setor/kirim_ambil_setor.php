<?php
$RMP_CONFIG=new RMP_CONFIG();
if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

$input = $params['input_option'];

$data_detail2 = array(
	'RMP_AMBIL_SETOR_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	'RMP_AMBIL_SETOR_NO' => $input['NOMOR'],
	'RMP_AMBIL_SETOR_TANGGAL' => $input['TANGGAL'],
	'RMP_MASTER_PERSONAL_ID' => $input['NAMA_SUPPLIER'],
	'RMP_AMBIL_SETOR_NAMA_SUPPLIER' => $input['NAMA'],
	'RMP_AMBIL_SETOR_REKENING' => $input['NOMOR_REKENING'],
	'RMP_AMBIL_SETOR_MATERIAL' => $input['JENIS_MATERIAL'],
	'RMP_AMBIL_SETOR_JENIS' => $input['JENIS_PEMBAYARAN'],
	'RMP_AMBIL_SETOR_RUPIAH' => $input['RUPIAH'],
	'RMP_AMBIL_SETOR_KETERANGAN' => $input['KETERANGAN'],

  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
  'RECORD_STATUS' => "A"
);

$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_AMBIL_SETOR";
$this->MYSQL->record = $data_detail2;
if ($this->MYSQL->simpan() == true)
	{
	$this->callback['respon']['pesan'] = "sukses";
	$this->callback['respon']['text_msg'] = $result_ms[0]['TglInvoice'];
	$this->callback['respon']['no_faktur'] = $buat_nomor_faktur;
	}
  else
	{
	$this->callback['respon']['pesan'] = "gagal";
	$this->callback['respon']['text_msg'] = "Gagal Simpan";
	}




?>
