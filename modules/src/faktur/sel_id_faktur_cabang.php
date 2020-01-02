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

$this->MYSQL->queri="SELECT * FROM RMP_REKAP_FC AS FC LEFT JOIN RMP_MASTER_PERSONAL AS P
				ON FC.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
				WHERE
				(P.RMP_MASTER_PERSONAL_NAMA LIKE '%".$input['q']."%')
				AND FC.RECORD_STATUS='A'
				AND P.RECORD_STATUS='A'
				AND NOT FC.RMP_REKAP_FC_PROSES_ADM_PKB = 'Yes'
				ORDER BY FC.RMP_REKAP_FC_TANGGAL DESC
				";

$result_a=$this->MYSQL->data();
$no=1;
foreach($result_a as $r){
	$r['TANGGAL_REKAP']=tanggal_format(Date("Y-m-d",strtotime($r['RMP_REKAP_FC_TANGGAL'])));
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
