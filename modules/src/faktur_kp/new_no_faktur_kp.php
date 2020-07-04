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
				$tanggalnota = $input['TANGGAL_NOTA'];
				$ponton = $input['PONTON_TIMBANG'];
				$buat_nomor_faktur=$RMP_CONFIG->buat_nomor_faktur_kopra($tanggalnota,$ponton)->callback['nomor'];

				$data_detail2 = array(
					'RMP_FAKTUR_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
					'RMP_FAKTUR_NO_FAKTUR' => $buat_nomor_faktur,
					'RMP_FAKTUR_TANGGAL' => $input['TANGGAL_FAKTUR'],
					'RMP_FAKTUR_JENIS_MATERIAL' => 'KOPRA',

				  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
				  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
				  'RECORD_STATUS' => "N"
				);

				$this->MYSQL = new MYSQL;
				$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
				$this->MYSQL->tabel = "RMP_FAKTUR";
				$this->MYSQL->record = $data_detail2;
				if ($this->MYSQL->simpan() == true)
					{
					$this->callback['respon']['pesan'] = "sukses";
					$this->callback['respon']['text_msg'] = $buat_nomor_faktur;
					}
				  else
					{
					$this->callback['respon']['pesan'] = "gagal";
					$this->callback['respon']['text_msg'] = "Gagal Simpan";
					}


?>
