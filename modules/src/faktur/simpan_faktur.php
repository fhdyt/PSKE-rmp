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
	'RECORD_STATUS' => "A"
);

$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_FAKTUR_DETAIL";
$this->MYSQL->record = $data_detail777;
$this->MYSQL->dimana = "where RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."' AND RECORD_STATUS='N'";
$this->MYSQL->ubah();

if($input['CEK_DITERIMA'] == 'on')
{
	$checkbox_diterima = "Y";
}
else
{
	$checkbox_diterima = "N";
}

if($input['CEK_100_INSPEKSI'] == 'on')
{
	$checkbox_100_inspeksi = "Y";
}
else
{
	$checkbox_100_inspeksi = "N";
}

if($input['CEK_DIPISAH'] == 'on')
{
	$checkbox_dipisah = "Y";
}
else
{
	$checkbox_dipisah = "N";
}

$data_master = array(
	'RMP_FAKTUR_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	'RMP_FAKTUR_NO_FAKTUR' => $input['NO_FAKTUR'],
	'RMP_MASTER_PERSONAL_ID' => $input['NAMA_SUPPLIER'],
	'RMP_FAKTUR_TANGGAL' => date("Y-m-d H:i:s"),
	'RMP_FAKTUR_POTONGAN' => $input['POTONGAN'],
	'RMP_FAKTUR_JENIS_MATERIAL' => $input['JENIS_KELAPA'],
	'RMP_FAKTUR_OPERATOR_TIMBANG' => $input['OPERATOR_TIMBANG'],
	'RMP_FAKTUR_QC' => $input['INSPEKTUR_MUTU'],
	'RMP_FAKTUR_CATATAN_PURCHASER' => $input['CATATAN_PURCHASER'],
	'RMP_FAKTUR_CATATAN_SUPPLIER' => $input['CATATAN_SUPPLIER'],
	'RMP_FAKTUR_CEK_DITERIMA' => $checkbox_diterima,
	'RMP_FAKTUR_CEK_100_INSPEKSI' => $checkbox_100_inspeksi,
	'RMP_FAKTUR_CEK_DIPISAH' => $checkbox_dipisah,
  'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
  'RECORD_STATUS' => "A"
);

$this->MYSQL =new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel ="RMP_FAKTUR";
$this->MYSQL->record = $data_master;

if ($this->MYSQL->simpan() == true)
	{
		$this->MYSQL=new MYSQL();
		$this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
		$this->MYSQL->queri="select * from RMP_FAKTUR
											WHERE
									RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."'
											AND
									RECORD_STATUS='A' LIMIT 1";
		$result_a=$this->MYSQL->data();

		foreach($result_a as $r)
		{
			$result[]=$r;

			// $this->MYSQL=new MYSQL();
			// $this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
			// $this->MYSQL->queri="SELECT * FROM RMP_FAKTUR_DETAIL WHERE RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."' AND RECORD_STATUS='A'";
			// $notif=$this->MYSQL->data();

			// $input_option_semua=array('NOTIFICATION_INDEX'	=>waktu_decimal(Date("Y-m-d H:i:s")),
			// 'NOTIFICATION_ID'		=>waktu_decimal(Date("Y-m-d H:i:s")),
			// 'NOTIFICATION_DESCRIPTION' =>'Pemberitahuan Faktur Kelapa Bulat dengan dan nomor Faktur '.$notif[0]['RMP_FAKTUR_NO_FAKTUR'].' . Mohon segera di periksa.',
			// 'NOTIFICATION_TO_USER'	=>'',
			// 'NOTIFICATION_FROM_USER' =>$user_login['PERSONAL_NIK'],
			// 'NOTIFICATION_LINK_VIEW' =>"?show=rmp/html/faktur/".$notif[0]['RMP_FAKTUR_DETAIL_ID'],
			// 'NOTIFICATION_ICON_SIMBOL' =>"fa fa-check text-success",
			// 'NOTIFICATION_TYPE'	=>"Other Notification",
			// 'REF_INDEX' =>$notif[0]['RMP_FAKTUR_DETAIL_ID'],
			// 'REF_TABLE' =>'RMP_FAKTUR_DETAIL',
			//'RECORD_STATUS'				=>'A',
			//'ENTRI_OPERATOR'			=>date("Y-m-d H:i:s"),
			//'ENTRI_WAKTU'				=>$user_login['PERSONAL_NIK']
			// );
			//$this->sendNotification($input_option_semua);
		}
		if(empty($result)){
			$this->callback['respon']['pesan']="gagal";
			$this->callback['respon']['text_msg']="Data kosong _";
			$this->callback['result']=$result;
		}else{
			$this->callback['respon']['pesan']="sukses";
			$this->callback['respon']['text_msg']="OK".print_r($result,true);
			$this->callback['result']=$result;
		}


	}
  else
	{
	$this->callback['respon']['pesan'] = "gagal";
	$this->callback['respon']['text_msg'] = "Gagal Simpan";
	}
?>
