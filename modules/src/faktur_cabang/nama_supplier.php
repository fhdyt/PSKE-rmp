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
$this->MYSQL->queri="SELECT *  FROM
              RMP_MASTER_PERSONAL WHERE (RMP_MASTER_PERSONAL_ROLE = 'PETANI' OR RMP_MASTER_PERSONAL_ROLE = 'PENGEPUL')
              AND RMP_MASTER_PERSONAL_NAMA LIKE '%".$input['q']."%'
              AND RECORD_STATUS='A'";


$result_a=$this->MYSQL->data();
$no=1;
foreach($result_a as $r){

	$result[]=$r;

$no++;
}
if(empty($result)){
	$this->callback['respon']['pesan']="gagal";
	$this->callback['respon']['text_msg']="Data kosong";
	$this->callback['result']=$result;
}else{
	$this->callback['respon']['pesan']="sukses";
	$this->callback['respon']['text_msg']="OK".print_r($result,true);
	$this->callback['result']=$result;
}

return;
?>
