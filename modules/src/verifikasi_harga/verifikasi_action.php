<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

	
//AMBIL PURCHASER
$input = $params['input_option'];
$sql44 = "SELECT * FROM RMP_FAKTUR_PURCHASER WHERE RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."' AND RECORD_STATUS='V'";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql44;
$result_ab = $this->MYSQL->data();
$purchaser = $result_ab[0]['RMP_FAKTUR_PURCHASER_PURCHASER_NIK'];

// AMBIL FAKTUR ID
$sql446 = "SELECT * FROM RMP_FAKTUR WHERE RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."' AND RECORD_STATUS='A'";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql446;
$result_abc = $this->MYSQL->data();
$id_faktur = $result_abc[0]['RMP_FAKTUR_ID'];



if($input['STATUS'] == "yes")
{
	$data_detail2 = array(
		  'VERIFIKASI_WAKTU' => date("Y-m-d H:i:s") ,
		  'VERIFIKASI_OPERATOR' => $user_login['PERSONAL_NIK'],
		  'RECORD_STATUS' => "N"
		);
		$pesan = 'Permintaan verifikasi perubahan harga rupiah untuk Nomor Faktur : '.$input['NO_FAKTUR'].' telah disetujui.';
}

else
{
	$data_detail2 = array(
		  'VERIFIKASI_WAKTU' => date("Y-m-d H:i:s") ,
		  'VERIFIKASI_OPERATOR' => $user_login['PERSONAL_NIK'],
		  'RECORD_STATUS' => "D"
		);
		$pesan = 'Permintaan verifikasi perubahan harga rupiah untuk Nomor Faktur : '.$input['NO_FAKTUR'].' ditolak, silahkan masukkan harga baru.';
}

$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_FAKTUR_PURCHASER";
$this->MYSQL->record = $data_detail2;
$this->MYSQL->dimana = "where RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."' AND RECORD_STATUS='V'";

if ($this->MYSQL->ubah() == true)
	{
		$input_option_semua=array(
				'NOTIFICATION_INDEX'	=>waktu_decimal(Date("Y-m-d H:i:s")),
				'NOTIFICATION_ID'		=>waktu_decimal(Date("Y-m-d H:i:s")),
				'NOTIFICATION_DESCRIPTION' => $pesan,
				'NOTIFICATION_TO_USER'	=>$purchaser,
				'NOTIFICATION_FROM_USER' =>$user_login['PERSONAL_NIK'],
				'NOTIFICATION_LINK_VIEW' =>'?show=rmp/purchaser/detail_faktur/'.$id_faktur.'',
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
