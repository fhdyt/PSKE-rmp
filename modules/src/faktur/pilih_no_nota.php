<?php

//crontrol
if(empty($params['case'])){
	$result['respon']['pesan']=="gagal";
	$result['respon']['pesan']=="Module tidak dapat di muat";
	echo json_encode($result);
	exit();
}

$input=$params['input_option'];
$tanggalnota = date("mY");
$this->MYSQL=new MYSQL();
$this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
// $this->MYSQL->queri="select * from RMP_HASIL_TIMBANG
// 													WHERE
// 					 RMP_HASIL_TIMBANG_NO_NOTA LIKE '%".$input['q']."%'  AND
// 					 RMP_HASIL_TIMBANG_TANGGAL='".$input['TANGGAL_NOTA']."' AND
// 					  RECORD_STATUS='A' GROUP BY RMP_HASIL_TIMBANG_NO_NOTA";

$this->MYSQL->queri="select * from pkb.master_".$tanggalnota." AS M
													LEFT JOIN
													pkb.nota_".$tanggalnota." AS N
													ON
													M.notr=N.notr
													WHERE N.notr LIKE '%".$input['q']."%' GROUP BY N.notr";

$result_a=$this->MYSQL->data();
$no=1;
foreach($result_a as $r){

	$result[]=$r;

$no++;
}
if(empty($result)){
	$this->callback['respon']['pesan']="gagal";
	$this->callback['respon']['text_msg']="Data kosong _".$input['q'];
	$this->callback['result']=$result;
}else{
	$this->callback['respon']['pesan']="sukses";
	$this->callback['respon']['text_msg']="OK".print_r($result,true);
	$this->callback['result']=$result;
}

return;
?>
