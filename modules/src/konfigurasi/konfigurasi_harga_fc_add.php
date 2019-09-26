<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

$input = $params['input_option'];
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = "SELECT * FROM RMP_KONFIGURASI_HARGA_FC
												WHERE
												RECORD_STATUS='A'
												ORDER BY RMP_KONFIGURASI_HARGA_FC_INDEX DESC LIMIT 1 ";
$result_a = $this->MYSQL->data() [0];
$sisa = $result_a['RMP_KONFIGURASI_HARGA_FC_TANGGAL_BERLAKU'];
if(empty($result_a))
{
	$tanggal_berakhir = "";
}
else
{
	$data_detail3 = array(
  	'RMP_KONFIGURASI_HARGA_FC_TANGGAL_BERAKHIR' => $input['QUALITED_HARGA_TANGGAL_BERLAKU'],
  );
  $this->MYSQL = new MYSQL;
  $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
  $this->MYSQL->tabel = "RMP_KONFIGURASI_HARGA_FC";
  $this->MYSQL->record = $data_detail3;
  $this->MYSQL->dimana = "where RMP_KONFIGURASI_HARGA_FC_ID='".$result_a['RMP_KONFIGURASI_HARGA_FC_ID']."' AND RECORD_STATUS='A'";
  $this->MYSQL->ubah();

	$tanggal_berakhir = $result_a['RMP_PENYESUAIAN_HARGA_GL_TANGGAL_BERLAKU'];;
}

	$data_detail2 = array(
		'RMP_KONFIGURASI_HARGA_FC_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	  'RMP_KONFIGURASI_HARGA_FC_A' => $input['HARGA_A'],
	  'RMP_KONFIGURASI_HARGA_FC_B' => $input['HARGA_B'],
	  'RMP_KONFIGURASI_HARGA_FC_C' => $input['HARGA_C'],
	  'RMP_KONFIGURASI_HARGA_FC_TANGGAL_BERLAKU' => $input['QUALITED_HARGA_TANGGAL_BERLAKU'],
	  'RMP_KONFIGURASI_HARGA_FC_TANGGAL_BERAKHIR' => $input['QUALITED_HARGA_TANGGAL_BERAKHIR'],

	  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
	  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
	  'RECORD_STATUS' => "A"
	);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_KONFIGURASI_HARGA_FC";
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
