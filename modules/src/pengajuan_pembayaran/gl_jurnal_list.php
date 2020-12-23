<?php

//crontrol
if(empty($params['case'])){
	$result['respon']['pesan']=="gagal";
	$result['respon']['pesan']=="Module tidak dapat di muat";
	echo json_encode($result);
	exit();
}

###START MODULE
//--pagging start top--/
$halaman=$params['halaman'];
$batas = $params['batas'];
$posisi = $this->PAGING->cariPosisi($batas,$halaman);
$queri="SELECT
									P.RMP_MASTER_PERSONAL_NAMA,
									P.RMP_MASTER_PERSONAL_ID,
									RR.RMP_REKENING_RELASI
								FROM RMP_MASTER_PERSONAL AS P
								LEFT JOIN RMP_REKENING_RELASI AS RR
								ON P.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
								WHERE (P.RMP_MASTER_PERSONAL_ID LIKE '%".$input['supplier']."%' OR RR.RMP_REKENING_RELASI LIKE '%".$input['rekening']."%')
								AND RR.RMP_REKENING_RELASI_MATERIAL LIKE '%".$input['material']."%'
								AND P.RECORD_STATUS='A'
								AND RR.RECORD_STATUS='A'
								LIMIT 1
								";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $queri;
$result_rekening = $this->MYSQL->data();
if ($input['material'] == 'KOPRA'){
  $material = '4';
}
else if ($input['material'] == 'JAMBUL'){
  $material = '3';
}
else if ($input['material'] == 'GELONDONG'){
  $material = '2';
}
else{
  $material = '2,3,4';
}


if(empty($input['rekening']))
{
	$sql="select * from (Select GroupWil,GroupSupplierName,NoFaktur,KodeSup ,SupplierName,
			NomorIC ,Tanggal ,TglInvoice,CurrencyID ,
			Hutang-Creditnote+debitnote as NilaiFaktur ,
			BayarAP ,
			debitnote,Creditnote,
			(Hutang-NotaKredit+NotaDebet+Creditnote-debitnote) - BayarAP  as SisaHutang
			From vwGLTrnFaktur  A
      where A.GroupWil IN (".$material.")
			) as a where SisaHutang<>'0' ORDER BY Tanggal,Nofaktur";
}
else{
	$sql="select * from (Select GroupWil,GroupSupplierName,NoFaktur,KodeSup ,SupplierName,
			NomorIC ,Tanggal ,TglInvoice,CurrencyID ,
			Hutang-Creditnote+debitnote as NilaiFaktur ,
			BayarAP ,
			debitnote,Creditnote,
			(Hutang-NotaKredit+NotaDebet+Creditnote-debitnote) - BayarAP  as SisaHutang
			From vwGLTrnFaktur  A
			WHERE KodeSup like '%".$input['rekening']."%'
			) as a where SisaHutang<>'0' ORDER BY Tanggal,Nofaktur";
}

/*
$sql="select * from eform_frmfrmtpb002_hdr";
*/

$this->MSSQL=new MSSQL();
$this->MSSQL->database=$this->CONFIG->mysql_koneksi()->db_nama_mssql_gl;
$this->MSSQL->queri=$sql;
$result_a=$this->MSSQL->data();
$no=$posisi+1;
foreach($result_a as $r)
{
	$queri_1="SELECT RECORD_STATUS AS STATUS_FAKTUR FROM RMP_JURNAL WHERE RMP_JURNAL_NO_FAKTUR='".$r['NoFaktur']."' AND RECORD_STATUS='A'
									";
	$this->MYSQL = new MYSQL();
	$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
	$this->MYSQL->queri = $queri_1;
	$result_status = $this->MYSQL->data();
	$r['STATUS'] = $result_status[0]['STATUS_FAKTUR'];
	$r['NO']=$no;
	$r['TANGGAL'] = tanggal_format(Date("Y-m-d", strtotime($r['Tanggal'])));
	$r['NAMA_SUPPLIER'] = $result_rekening[0]['RMP_MASTER_PERSONAL_NAMA'];
	$result[]=$r;
	$no++;
}


if(empty($result_a)){
	$this->callback['respon']['pesan']="gagal";
	$this->callback['respon']['text_msg']="Data tidak ada.";
	$this->callback['filter']=$params;
	$this->callback['result']=$result;
	//$this->callback['log']=$log;
}else{
	$this->callback['respon']['pesan']="sukses";
	$this->callback['respon']['text_msg']="Ok";
	$this->callback['filter']=$params;
	$this->callback['result']=$result;
	//$this->callback['log']=$log;
	$this->callback['result_option']['jml_halaman']=$this->pagging(array('sql'=>$sql,'batas'=>$params['batas'],'tabel'=>$tabel,'dimana_default'=>$dimana_default))->jmlhalaman;
}
?>
