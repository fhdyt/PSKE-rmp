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

	foreach($input['KETERANGAN_DETAIL_DANA'] as $key => $value)
	{
		$data_ip = array(
			'FINANCE_PEMBAGIAN_DANA_DETAIL_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
			'FINANCE_DANA_MATERIAL_ID' => $input['PERIODE_ID_MATERIAL'],
			'FINANCE_PEMBAGIAN_DANA_DETAIL_MASTER' => $input['MASTER_DANA'],
			'FINANCE_PEMBAGIAN_DANA_DETAIL_KETERANGAN' => $input['KETERANGAN_DETAIL_DANA'][$key],
			'FINANCE_PEMBAGIAN_DANA_DETAIL_RUPIAH' => $input['RUPIAH_DETAIL_DANA'][$key],

			'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
			'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
			'RECORD_STATUS' => "A"
		);
		$this->MYSQL = new MYSQL;
		$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
		$this->MYSQL->tabel = "FINANCE_PEMBAGIAN_DANA_DETAIL";
		$this->MYSQL->record = $data_ip;
		$this->MYSQL->simpan();
	}

	// $data_detail2 = array(
	// 			'FINANCE_DANA_MATERIAL_ID' => $input['PERIODE_ID_MATERIAL'],
	// 			'FINANCE_PEMBAGIAN_DANA_DETAIL_MASTER' => $input['MASTER_DANA'],
	// 			'FINANCE_PEMBAGIAN_DANA_DETAIL_KETERANGAN' => $input['KETERANGAN_DETAIL_DANA'],
	// 			'FINANCE_PEMBAGIAN_DANA_DETAIL_RUPIAH' => $input['RUPIAH_DETAIL_DANA'],
	//
	//
	//   'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
	//   'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
	//   'RECORD_STATUS' => "A"
	// );
	//
	// $this->MYSQL = new MYSQL;
	// $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
	// $this->MYSQL->tabel = "FINANCE_PEMBAGIAN_DANA_DETAIL";
	// $this->MYSQL->record = $data_detail2;

// if ($this->MYSQL->simpan() == true)
// 	{
// 	$this->callback['respon']['pesan'] = "sukses";
// 	$this->callback['respon']['text_msg'] = "";
// 	$this->callback['respon']['no_faktur'] = "";
// 	}
//   else
// 	{
// 	$this->callback['respon']['pesan'] = "gagal";
// 	$this->callback['respon']['text_msg'] = "Gagal Simpan";
// 	}


$this->callback['respon']['pesan'] = "sukses";
$this->callback['respon']['text_msg'] = "";
$this->callback['respon']['no_faktur'] = "";

?>
