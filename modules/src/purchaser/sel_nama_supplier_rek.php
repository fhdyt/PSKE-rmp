<?php

//crontrol
if(empty($params['case'])){
	$result['respon']['pesan']=="gagal";
	$result['respon']['pesan']=="Module tidak dapat di muat";
	echo json_encode($result);
	exit();
}

$input=$params['input_option'];

$this->MYSQL=new MYSQL();
$this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
// $this->MYSQL->queri="select * from RMP_HASIL_TIMBANG
// 													WHERE
// 					 RMP_HASIL_TIMBANG_NO_NOTA LIKE '%".$input['q']."%'  AND
// 					 RMP_HASIL_TIMBANG_TANGGAL='".$input['TANGGAL_NOTA']."' AND
// 					  RECORD_STATUS='A' GROUP BY RMP_HASIL_TIMBANG_NO_NOTA";

$tanggal = date("Y-m-d");

$this->MYSQL->queri="SELECT *, PH.RMP_PENYESUAIAN_HARGA_KB_".$input['grade']." AS HARGA FROM RMP_MASTER_PERSONAL AS P LEFT JOIN RMP_REKENING_RELASI AS R
												ON P.RMP_MASTER_PERSONAL_ID=R.RMP_MASTER_PERSONAL_ID
												LEFT JOIN RMP_PENYESUAIAN_HARGA_KB AS PH ON P.RMP_MASTER_PERSONAL_ID=PH.RMP_MASTER_PERSONAL_ID
												WHERE R.RMP_REKENING_RELASI_MATERIAL='".$input['material']."'
												AND (PH.RMP_PENYESUAIAN_HARGA_KB_TANGGAL_BERLAKU<='".$tanggal."' AND PH.RMP_PENYESUAIAN_HARGA_KB_TANGGAL_BERAKHIR>='".$tanggal."')
												OR (PH.RMP_PENYESUAIAN_HARGA_KB_TANGGAL_BERLAKU<='".$tanggal."' AND PH.RMP_PENYESUAIAN_HARGA_KB_TANGGAL_BERAKHIR='0000-00-00')
												AND PH.RMP_PENYESUAIAN_HARGA_KB_JENIS_MATERIAL='".$input['material']."'
												AND R.RMP_REKENING_RELASI_MATERIAL='".$input['material']."'
												AND P.RECORD_STATUS='A'
												AND PH.RECORD_STATUS='A'
												AND R.RECORD_STATUS='A'
												AND (P.RMP_MASTER_PERSONAL_NAMA LIKE '%".$input['q']."%' OR P.RMP_MASTER_PERSONAL_NAMA LIKE '%".$input['nama_supplier']."%')
												";
$result_a=$this->MYSQL->data();
$no=1;
foreach($result_a as $r){

	$sqlU = "SELECT * FROM RMP_MASTER_PERSONAL AS P LEFT JOIN RMP_MASTER_WILAYAH AS W
	ON P.SUB_WILAYAH_ID=W.RMP_MASTER_WILAYAH_ID WHERE P.RMP_MASTER_PERSONAL_ID='".$r['RMP_MASTER_PERSONAL_ID']."' AND P.RECORD_STATUS='A' AND W.RECORD_STATUS='A'";

	$this->MYSQL = new MYSQL();
	$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
	$this->MYSQL->queri = $sqlU;
	$result_au = $this->MYSQL->data();
	$r['ALAMAT'] = $result_au[0]['RMP_MASTER_WILAYAH'];

	$result[]=$r;

$no++;
}
if(empty($result)){
	$this->callback['respon']['pesan']="gagal";
	$this->callback['respon']['text_msg']=$queri;
	$this->callback['result']=$result;
}else{
	$this->callback['respon']['pesan']="sukses";
		$this->callback['respon']['text_msg']=$queri;
	$this->callback['result']=$result;
}

return;
?>
