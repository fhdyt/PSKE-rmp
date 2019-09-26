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
	'RMP_REKENING_RELASI_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	'RMP_MASTER_PERSONAL_ID' => $input['ID_SUPPLIER'],
  'RMP_MASTER_MATERIAL_ID' => $input['KODE_JENIS_REKENING'],
  'RMP_MASTER_WILAYAH_KODE' => $input['NO_REKENING_KODE_WILAYAH'],
  'RMP_REKENING_RELASI_MATERIAL' => $input['MATERIAL_NAMA'],
  'SUB_WILAYAH_KODE' => $input['NO_REKENING_SUB_WILAYAH'],
  'ID_SUB_WILAYAH' => $input['NO_REKENING_ID_SUB_WILAYAH'],
  'RMP_REKENING_RELASI_SUPPLIER_ID' => $input['NO_REKENING_ID_RELASI'],
	'RMP_REKENING_RELASI' => $input['KODE_JENIS_REKENING']. "." .$input['NO_REKENING_KODE_WILAYAH']. "." .$input['NO_REKENING_SUB_WILAYAH']. "." .$input['NO_REKENING_ID_RELASI'],

  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
  'RECORD_STATUS' => "A"
);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_REKENING_RELASI";
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
