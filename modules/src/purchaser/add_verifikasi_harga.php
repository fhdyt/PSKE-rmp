<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

$input = $params['input_option'];

$data_detail777 = array(
	'RECORD_STATUS' => "E"
);

$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_FAKTUR_PURCHASER";
$this->MYSQL->record = $data_detail777;
$this->MYSQL->dimana = "where RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."' AND RECORD_STATUS='A'";
$this->MYSQL->ubah();

	$data_detail2 = array(
		'RMP_FAKTUR_PURCHASER_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	  'RMP_FAKTUR_NO_FAKTUR' => $input['NO_FAKTUR'],
	  'RMP_MASTER_PERSONAL_ID' => $input['PERSONAL_ID'],
	  'RMP_FAKTUR_PURCHASER_TAMBANG' => $input['TAMBANG'],
	  'RMP_FAKTUR_PURCHASER_BIAYA' => $input['BIAYA'],
	  'RMP_FAKTUR_PURCHASER_RP_KG' => $input['RP_KG'],
	  'RMP_FAKTUR_PURCHASER_RP_KG_LAMA' => $input['RP_KG_LAMA'],
	  'RMP_FAKTUR_PURCHASER_PURCHASER_NIK' => $user_login['PERSONAL_NIK'],
	  'RMP_FAKTUR_PURCHASER_KET' => $input['KETERANGAN'],
	  'RMP_FAKTUR_PURCHASER_VERIFIKASI_STATUS' => 'VERIFIKASI',

	  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
	  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
	  'RECORD_STATUS' => "V"
	);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_FAKTUR_PURCHASER";
$this->MYSQL->record = $data_detail2;

if ($this->MYSQL->simpan() == true)
	{
		$input_option_semua=array(
				'NOTIFICATION_INDEX'	=>waktu_decimal(Date("Y-m-d H:i:s")),
				'NOTIFICATION_ID'		=>waktu_decimal(Date("Y-m-d H:i:s")),
				'NOTIFICATION_DESCRIPTION' =>'Meminta verifikasi perubahan harga rupiah untuk faktur dengan Nomor Faktur : '.$input['NO_FAKTUR'].'.',
				'NOTIFICATION_TO_USER'	=>'5327',
				'NOTIFICATION_FROM_USER' =>$user_login['PERSONAL_NIK'],
				'NOTIFICATION_LINK_VIEW' =>'?show=rmp/verifikasi_harga',
				'NOTIFICATION_ICON_SIMBOL' =>'fa fa-check text-success',
				'NOTIFICATION_TYPE'	=>'Other Notification',
				'NOTIFICATION_READ_STATUS'  =>'N',
				'REF_INDEX' =>'',
				'REF_TABLE' =>'RMP_FAKTUR_PURCHASER',
				'RECORD_STATUS'				=>'A',
				'ENTRI_OPERATOR'			=>date("Y-m-d H:i:s"),
				'ENTRI_WAKTU'				=>$user_login['PERSONAL_NIK'],
		);
		$this->MYSQL = new MYSQL;
		$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
		$this->MYSQL->tabel = "NOTIFICATION";
		$this->MYSQL->record = $input_option_semua;
		$this->MYSQL->simpan();

	$this->callback['respon']['pesan'] = "sukses";
	$this->callback['respon']['text_msg'] = "Berhasil Simpan";
	}
  else
	{
	$this->callback['respon']['pesan'] = "gagal";
	$this->callback['respon']['text_msg'] = "Gagal Simpan";
	}

?>
