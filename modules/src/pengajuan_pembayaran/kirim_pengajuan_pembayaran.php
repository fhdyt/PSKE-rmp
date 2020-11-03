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

$sql2_purchaser = "SELECT
          P.RMP_MASTER_PERSONAL_ID AS RMP_MASTER_PERSONAL_ID,
          F.RMP_FAKTUR_JENIS_MATERIAL AS RMP_FAKTUR_JENIS_MATERIAL,
          P.RMP_MASTER_PERSONAL_NAMA AS RMP_MASTER_PERSONAL_NAMA,
          P.RMP_MASTER_PERSONAL_NAMA AS RMP_MASTER_PERSONAL_NAMA,
          FP.RMP_FAKTUR_PURCHASER_NO_REKENING AS RMP_FAKTUR_PURCHASER_NO_REKENING
          FROM
         RMP_FAKTUR_PURCHASER AS FP
         LEFT JOIN RMP_FAKTUR AS F
         ON
         FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
         LEFT JOIN RMP_MASTER_PERSONAL AS P
         ON
         FP.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
         WHERE
         FP.RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR_PENGAJUAN']."' AND P.RECORD_STATUS='A' AND FP.RECORD_STATUS='A' AND F.RECORD_STATUS='A' LIMIT 1";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql2_purchaser ;
$result_purchaser = $this->MYSQL->data();

$data_detail2 = array(
	'RMP_JURNAL_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	'FINANCE_DANA_MATERIAL_ID' => $input['PERIODE_ID'],
	'RMP_JURNAL_NO_FAKTUR' => $input['NO_FAKTUR_PENGAJUAN'],
	'RMP_MASTER_PERSONAL_ID' => $result_purchaser[0]['RMP_MASTER_PERSONAL_ID'],
	'RMP_JURNAL_NAMA_SUPPLIER' => $result_purchaser[0]['RMP_MASTER_PERSONAL_NAMA'],
	'RMP_JURNAL_REKENING' => $result_purchaser[0]['RMP_FAKTUR_PURCHASER_NO_REKENING'],
	'RMP_JURNAL_MATERIAL' => $result_purchaser[0]['RMP_FAKTUR_JENIS_MATERIAL'],
	'RMP_JURNAL_RUPIAH_TOTAL' => $input['TOTAL_RUPIAH'],
	'RMP_JURNAL_RUPIAH_PENGAJUAN' => $input['PENGAJUAN_RUPIAH'],
	'RMP_JURNAL_RUPIAH_SISA' => $input['SISA_RUPIAH'],
	'RMP_JURNAL_STATUS_JURNAL' => "PENGAJUAN",
	'RMP_JURNAL_STATUS_PEMBAYARAN' => "",


  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
  'RECORD_STATUS' => "A"
);

$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_JURNAL";
$this->MYSQL->record = $data_detail2;
if ($this->MYSQL->simpan() == true)
	{
	$this->callback['respon']['pesan'] = "sukses";
	$this->callback['respon']['text_msg'] = $result_a[0]['relasi'];
	$this->callback['respon']['no_faktur'] = $buat_nomor_faktur;
	}
  else
	{
	$this->callback['respon']['pesan'] = "gagal";
	$this->callback['respon']['text_msg'] = "Gagal Simpan";
	}




?>
