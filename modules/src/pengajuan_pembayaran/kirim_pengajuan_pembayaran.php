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
          F.RMP_FAKTUR_TANGGAL AS RMP_FAKTUR_TANGGAL,
          F.RMP_FAKTUR_NO_FAKTUR AS RMP_FAKTUR_NO_FAKTUR,
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
         FP.RMP_FAKTUR_NO_FAKTUR LIKE '%".$input['NO_FAKTUR_PENGAJUAN']."%' AND P.RECORD_STATUS='A' AND FP.RECORD_STATUS='A' AND F.RECORD_STATUS='A' LIMIT 1";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql2_purchaser ;
$result_purchaser = $this->MYSQL->data();



if(empty($result_purchaser))
{
	$sql2_ms = "Select GroupWil,GroupSupplierName,NoFaktur,KodeSup ,SupplierName,
			NomorIC ,Tanggal ,TglInvoice,CurrencyID ,
			Hutang-Creditnote+debitnote as NilaiFaktur ,
			BayarAP ,
			debitnote,Creditnote,
			(Hutang-NotaKredit+NotaDebet+Creditnote-debitnote) - BayarAP  as SisaHutang
			From vwGLTrnFaktur  A
			WHERE NoFaktur='".$input['NO_FAKTUR_PENGAJUAN']."'
			ORDER BY Tanggal,Nofaktur";
			$this->MSSQL=new MSSQL();
			$this->MSSQL->database=$this->CONFIG->mysql_koneksi()->db_nama_mssql_gl;
			$this->MSSQL->queri=$sql2_ms;
			$result_ms=$this->MSSQL->data();


		$sql2_supplier = "SELECT RR.RMP_REKENING_RELASI AS REKENING, P.RMP_MASTER_PERSONAL_ID AS PERSONAL_ID, P.RMP_MASTER_PERSONAL_NAMA AS NAMA
												FROM RMP_REKENING_RELASI AS RR LEFT JOIN RMP_MASTER_PERSONAL AS P
												ON RR.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID WHERE RR.RMP_REKENING_RELASI='".$result_ms[0]['KodeSup']."'
												AND RR.RECORD_STATUS='A' AND P.RECORD_STATUS='A' LIMIT 1";
		$this->MYSQL = new MYSQL();
		$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
		$this->MYSQL->queri = $sql2_supplier ;
		$result_supplier = $this->MYSQL->data();

	$no_faktur = $result_ms[0]['NoFaktur'];
	$tanggal_faktur = date('Y-m-d', strtotime($result_ms[0]['TglInvoice']));
	$personal_id = $result_supplier[0]['PERSONAL_ID'];
	$nama_supplier = $result_supplier[0]['NAMA'];
	$rekening_supplier = $result_supplier[0]['REKENING'];
	$material = 'KOPRA';
}
else
{
	$no_faktur = $result_purchaser[0]['RMP_FAKTUR_NO_FAKTUR'];
	$tanggal_faktur = $result_purchaser[0]['RMP_FAKTUR_TANGGAL'];
	$personal_id = $result_purchaser[0]['RMP_MASTER_PERSONAL_ID'];
	$nama_supplier = $result_purchaser[0]['RMP_MASTER_PERSONAL_NAMA'];
	$rekening_supplier = $result_purchaser[0]['RMP_FAKTUR_PURCHASER_NO_REKENING'];
	$material = $result_purchaser[0]['RMP_FAKTUR_JENIS_MATERIAL'];
}

$data_detail2 = array(
	'RMP_JURNAL_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	'FINANCE_DANA_MATERIAL_ID' => $input['PERIODE_ID'],
	'RMP_JURNAL_NO_FAKTUR' => $no_faktur,
	'RMP_JURNAL_TANGGAL_FAKTUR' => $tanggal_faktur,
	'RMP_MASTER_PERSONAL_ID' => $personal_id,
	'RMP_JURNAL_NAMA_SUPPLIER' => $nama_supplier,
	'RMP_JURNAL_REKENING' => $rekening_supplier,
	'RMP_JURNAL_MATERIAL' => $material,
	'RMP_JURNAL_RUPIAH_TOTAL' => $input['TOTAL_RUPIAH'],
	'RMP_JURNAL_RUPIAH_PENGAJUAN' => $input['PENGAJUAN_RUPIAH'],
	'RMP_JURNAL_RUPIAH_SISA' => $input['SISA_RUPIAH'],
	'RMP_JURNAL_STATUS_JURNAL' => "",
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
	$this->callback['respon']['text_msg'] = $result_ms[0]['TglInvoice'];
	$this->callback['respon']['no_faktur'] = $buat_nomor_faktur;
	}
  else
	{
	$this->callback['respon']['pesan'] = "gagal";
	$this->callback['respon']['text_msg'] = "Gagal Simpan";
	}




?>
