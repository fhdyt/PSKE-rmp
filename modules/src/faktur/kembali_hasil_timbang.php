<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

$input = $params['input_option'];

$sql = "SELECT * FROM RMP_FAKTUR_CATATAN_PURCHASER
        WHERE
    RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."' AND RECORD_STATUS='A' ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql ;
$result_a = $this->MYSQL->data();

foreach($result_a as $r)
    {
    }

if (empty($result_a))
    {
			$data_detail3 = array(
				'EDIT_WAKTU' => date("Y-m-d H:i:s"),
				'EDIT_OPERATOR' => $user_login['PERSONAL_NIK'],
				'RECORD_STATUS' => "D"
			);
			$this->MYSQL = new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel = "PT_PULAU_SAMBU.RMP_FAKTUR_DETAIL";
			$this->MYSQL->record = $data_detail3;
			$this->MYSQL->dimana = "where RMP_FAKTUR_DETAIL_ID='".$input['ID_TIMBANG']."'";
			if ($this->MYSQL->ubah() == true)
				{
				$this->callback['respon']['pesan'] = "sukses";
				$this->callback['respon']['text_msg'] = "Berhasil Simpan";
				}
			  else
				{
				$this->callback['respon']['pesan'] = "gagal";
				$this->callback['respon']['text_msg'] = "Gagal Simpan";
				}
    }
else
    {
    $this->callback['respon']['pesan'] = "gagal_purchaser";
    $this->callback['respon']['text_msg'] = "OK..";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;

    }

?>
