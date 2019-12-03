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
$id_detail = $input['id_detail'];

$sql33 = "SELECT * FROM RMP_REKAP_FC AS FC
					LEFT JOIN RMP_MASTER_PERSONAL AS P
					ON FC.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
					WHERE FC.RMP_REKAP_FC_ID='".$input['ID_FAKTUR_CABANG']."'
					AND FC.RECORD_STATUS='A'
					AND P.RECORD_STATUS='A'
					";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql33 ;
$result_a = $this->MYSQL->data();
$nama_ps = $result_a[0]['RMP_MASTER_PERSONAL_ID'];
foreach($id_detail as $key => $value)
{
	if ($input['jenis'][$key] == "A")
	{
		$jenis_kelapa = "".$result_a[0]['RMP_REKAP_FC_JENIS_KB']."-A";
	}
	elseif ($input['jenis'][$key] == "B")
	{
		$jenis_kelapa = "".$result_a[0]['RMP_REKAP_FC_JENIS_KB']."-B";
	}
	elseif ($input['jenis'][$key] == "C")
	{
		$jenis_kelapa = "".$result_a[0]['RMP_REKAP_FC_JENIS_KB']."-C";
	}
	else
	{
		$jenis_kelapa = "";
	}
	$ponton = $result_a[0]['RMP_REKAP_FC_TIMBANG'];
	//$buat_nomor_faktur=$RMP_CONFIG->buat_nomor_faktur($jenis_kelapa,$ponton)->callback['nomor'];
	$bulan = date("m",strtotime($input['TANGGAL_FAKTUR']));
	$tahun = date("Y",strtotime($input['TANGGAL_FAKTUR']));
	$tanggalnota = $bulan.$tahun;
	$buat_nomor_faktur=$RMP_CONFIG->buat_nomor_faktur($jenis_kelapa,$ponton,$tanggalnota)->callback['nomor'];
	$data_detail2 = array(
		'RMP_FAKTUR_CABANG_DETAIL_ID' => $input['id_detail'][$key],
		'RMP_FAKTUR_CABANG_DETAIL_NAMA' => $input['supplier_name'][$key],
		'RMP_REKAP_FC_ID' => $result_a[0]['RMP_REKAP_FC_ID'],
		'RMP_FAKTUR_NO_FAKTUR'=> $buat_nomor_faktur,
		'RMP_FAKTUR_CABANG_DETAIL_JENIS' => $jenis_kelapa,
		'RMP_FAKTUR_CABANG_DETAIL_BRUTO' => str_replace(',', '', $input['bruto'][$key]),
		'RMP_FAKTUR_CABANG_DETAIL_POTONGAN' => str_replace(',', '', $input['potongan'][$key]),
		'RMP_FAKTUR_CABANG_DETAIL_NETTO' => str_replace(',', '', $input['netto'][$key]),
		'RMP_FAKTUR_CABANG_DETAIL_RP_KG' => str_replace(',', '', $input['rp_kg'][$key]),
		'RMP_FAKTUR_CABANG_DETAIL_RUPIAH' => str_replace(',', '', $input['rupiah'][$key]),
		'RMP_FAKTUR_CABANG_DETAIL_TAMBANG' => str_replace(',', '', $input['tambang'][$key]),
		'RMP_FAKTUR_CABANG_DETAIL_BIAYA' => str_replace(',', '', $input['biaya'][$key]),
		'RMP_FAKTUR_CABANG_DETAIL_TTL_RUPIAH' => str_replace(',', '', $input['ttl_rupiah'][$key]),
		'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
		'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
		'RECORD_STATUS' => "A"

	);
	$this->MYSQL = new MYSQL;
	$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
	$this->MYSQL->tabel = "RMP_FAKTUR_CABANG_DETAIL";
	$this->MYSQL->record = $data_detail2;
	$this->MYSQL->simpan();


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

	$data_detail4 = array(
		'RMP_FAKTUR_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
		'RMP_FAKTUR_NO_FAKTUR'=> $buat_nomor_faktur,
		'RMP_MASTER_PERSONAL_ID'=> $nama_ps,
		'RMP_FAKTUR_NAMA_SUB'=> $input['supplier_name'][$key],
		'RMP_FAKTUR_KAPAL' =>  $result_a[0]['RMP_REKAP_FC_KAPAL'],
		'RMP_FAKTUR_ALAMAT' =>  $input['ALAMAT_FAKTUR_CABANG'],
		'RMP_FAKTUR_TANGGAL' => date("Y-m-d H:i:s"),
		'RMP_FAKTUR_POTONGAN' => str_replace(',', '', $input['potongan'][$key]),
		'RMP_FAKTUR_OPERATOR_TIMBANG' => $input['OPERATOR_TIMBANG'],
		'RMP_FAKTUR_JENIS_MATERIAL' => $jenis_kelapa,
		'RMP_FAKTUR_QC' => $input['INSPEKTUR_MUTU'],
		'RMP_FAKTUR_CATATAN_PURCHASER' => $input['CATATAN_PURCHASER'],
		'RMP_FAKTUR_CATATAN_SUPPLIER' => $input['CATATAN_SUPPLIER'],
		'RMP_FAKTUR_CEK_DITERIMA' => $checkbox_diterima,
		'RMP_FAKTUR_CEK_100_INSPEKSI' => $checkbox_100_inspeksi,
		'RMP_FAKTUR_CEK_DIPISAH' => $checkbox_dipisah,
		'RMP_FAKTUR_JENIS' => 'FAKTUR CABANG',
		'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
		'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
		'RECORD_STATUS' => "A"
	);
	$this->MYSQL = new MYSQL;
	$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
	$this->MYSQL->tabel = "RMP_FAKTUR";
	$this->MYSQL->record = $data_detail4;
	$this->MYSQL->simpan();

	$data_detail22222 = array(
		'RMP_FAKTUR_PURCHASER_ID'=> waktu_decimal(Date("Y-m-d H:i:s")),
		'RMP_FAKTUR_NO_FAKTUR'=> $buat_nomor_faktur,
		'RMP_MASTER_PERSONAL_ID'=> $nama_ps,
		'RMP_FAKTUR_PURCHASER_RP_KG' => str_replace(',', '', $input['rp_kg'][$key]),
		'RMP_FAKTUR_PURCHASER_TAMBANG' => str_replace(',', '', $input['tambang'][$key]),
		'RMP_FAKTUR_PURCHASER_BIAYA' => str_replace(',', '', $input['biaya'][$key]),
		'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
		'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
		'RECORD_STATUS' => "N"
	);
	$this->MYSQL = new MYSQL;
	$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
	$this->MYSQL->tabel = "RMP_FAKTUR_PURCHASER";
	$this->MYSQL->record = $data_detail22222;
	$this->MYSQL->simpan();

	$data_detail3 = array(
		'RMP_FAKTUR_DETAIL_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
		'RMP_FAKTUR_NO_FAKTUR'=> $buat_nomor_faktur,
		'RMP_FAKTUR_DETAIL_JENIS_MATERIAL' => $jenis_kelapa,
		'RMP_FAKTUR_DETAIL_ID_TIMBANG' => $result_a[0]['RMP_REKAP_FC_TIMBANG'],
		'RMP_FAKTUR_DETAIL_TANGGAL' => $result_a[0]['RMP_REKAP_FC_TANGGAL'],
		'RMP_FAKTUR_DETAIL_GROSS' => str_replace(',', '', $input['bruto'][$key]),
		'RMP_FAKTUR_DETAIL_TARA' => '',
		'RMP_FAKTUR_DETAIL_BRUTO' => str_replace(',', '', $input['bruto'][$key]),
		'RMP_FAKTUR_DETAIL_POTONGAN' => str_replace(',', '', $input['potongan'][$key]),
		'RMP_FAKTUR_DETAIL_NETTO' => str_replace(',', '', $input['netto'][$key]),
		'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
		'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
		'RECORD_STATUS' => "A"
	);
	$this->MYSQL = new MYSQL;
	$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
	$this->MYSQL->tabel = "RMP_FAKTUR_DETAIL";
	$this->MYSQL->record = $data_detail3;

	if ($this->MYSQL->simpan() == true)
		{
		$this->callback['respon']['pesan'] = "sukses";
		$this->callback['respon']['text_msg'] = $result_a[0]['RMP_REKAP_FC_TIMBANG'];
		}
		else
		{
		$this->callback['respon']['pesan'] = "gagal";
		$this->callback['respon']['text_msg'] = "Gagal Simpan";
		}
}



?>
