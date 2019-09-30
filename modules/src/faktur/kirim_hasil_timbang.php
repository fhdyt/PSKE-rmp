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

$tanggalnota = date("mY");
$sql33 = "SELECT * FROM pkb.nota_".$tanggalnota." WHERE id='".$input['ID_TIMBANG']."' LIMIT 1";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql33 ;
$result_a = $this->MYSQL->data();

// if($result_a[0]['id_timbang'] == 'PTN-1')
// {
// 	$ptn = "A";
// }
// elseif($result_a[0]['id_timbang'] == 'PTN-2')
// {
// 	$ptn = "B";
// }
// else
// {
// 	$ptn = "";
// }
//
// if($result_a[0]['jenis_kelapa'] == "GELONDONG-A")
// {
// 	$kelapa = "GLA";
// }
// elseif($result_a[0]['jenis_kelapa'] == "GELONDONG-B")
// {
// 	$kelapa = "GLB";
// }
// elseif($result_a[0]['jenis_kelapa'] == "GELONDONG-C")
// {
// 	$kelapa = "GLC";
// }
// elseif($result_a[0]['jenis_kelapa'] == "LICIN-A")
// {
// 	$kelapa = "KBA";
// }
// elseif($result_a[0]['jenis_kelapa'] == "LICIN-B")
// {
// 	$kelapa = "KBB";
// }
// elseif($result_a[0]['jenis_kelapa'] == "LICIN-C")
// {
// 	$kelapa = "KBC";
// }
// elseif($result_a[0]['jenis_kelapa'] == "JAMBUL-A")
// {
// 	$kelapa = "JBA";
// }
// elseif($result_a[0]['jenis_kelapa'] == "JAMBUL-B")
// {
// 	$kelapa = "JBB";
// }
// elseif($result_a[0]['jenis_kelapa'] == "JAMBUL-C")
// {
// 	$kelapa = "JBC";
// }
// else
// {
// 	$kelapa = "";
// }

$jenis_kelapa = $result_a[0]['jenis_kelapa'];
$ponton = $result_a[0]['id_timbang'];
$buat_nomor_faktur=$RMP_CONFIG->buat_nomor_faktur($jenis_kelapa,$ponton)->callback['nomor'];

$data_detail2 = array(
	'RMP_FAKTUR_DETAIL_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	'id_nota' => $result_a[0]['id'],
	'RMP_FAKTUR_DETAIL_REF' => $result_a[0]['ref'],
	'RMP_FAKTUR_DETAIL_ID_TIMBANG' => $result_a[0]['id_timbang'],
	'RMP_FAKTUR_NO_FAKTUR' => $buat_nomor_faktur,
	'RMP_FAKTUR_DETAIL_JENIS_MATERIAL' => $result_a[0]['jenis_kelapa'],
	'RMP_FAKTUR_DETAIL_NO_NOTA' => $result_a[0]['notr'],
	'RMP_FAKTUR_DETAIL_GROSS' => $result_a[0]['gross'],
	'RMP_FAKTUR_DETAIL_TARA' => '0',
	'RMP_FAKTUR_DETAIL_BRUTO' => $result_a[0]['gross'],
	'RMP_FAKTUR_DETAIL_POTONGAN' => '0',
	'RMP_FAKTUR_DETAIL_NETTO' => $result_a[0]['gross'],
	'RMP_FAKTUR_DETAIL_TANGGAL' => $result_a[0]['tgl'],
  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
  'RECORD_STATUS' => "N"
);

$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_FAKTUR_DETAIL";
$this->MYSQL->record = $data_detail2;
if ($this->MYSQL->simpan() == true)
	{
	$this->callback['respon']['pesan'] = "sukses";
	$this->callback['respon']['text_msg'] = $result_a[0]['notr'];
	$this->callback['respon']['no_faktur'] = $buat_nomor_faktur;
	}
  else
	{
	$this->callback['respon']['pesan'] = "gagal";
	$this->callback['respon']['text_msg'] = "Gagal Simpan";
	}
?>
