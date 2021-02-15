<?php

//crontrol
if (empty($params['case'])) {
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
}

$input = $params['input_option'];

$rekening_relasi = substr($input['rekening'], 0, 14);
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = "SELECT * FROM RMP_REKENING_RELASI WHERE RMP_REKENING_RELASI='" . $rekening_relasi . "' AND RECORD_STATUS='A'";

$result_id_relasi = $this->MYSQL->data();


$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = "SELECT * FROM RMP_REKENING AS REKENING LEFT JOIN MASTER_BANK AS BANK ON REKENING.RMP_REKENING_KODE_BANK=BANK.MASTER_BANK_KODE WHERE REKENING.RMP_MASTER_PERSONAL_ID='" . $result_id_relasi[0]['RMP_MASTER_PERSONAL_ID'] . "' AND REKENING.RECORD_STATUS='A'";

$result_a = $this->MYSQL->data();
foreach ($result_a as $r) {

	$result[] = $r;

	$no++;
}
if (empty($result)) {
	$this->callback['respon']['pesan'] = "gagal";
	$this->callback['respon']['text_msg'] = "Data kosong";
	$this->callback['result'] = $result;
} else {
	$this->callback['respon']['pesan'] = "sukses";
	$this->callback['respon']['text_msg'] = "OK" . print_r($result, true);
	$this->callback['result'] = $result;
}

return;
