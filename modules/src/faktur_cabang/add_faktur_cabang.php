<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

$input = $params['input_option'];
// CEK ID FAKTUR CABANG APAKAH TELAH TERSEDIA SEBELUMNYA ?
$sql2 = "SELECT *
				 FROM RMP_REKAP_FC
				 WHERE RMP_REKAP_FC_ID='".$input['ID_FAKTUR_CABANG']."' AND RECORD_STATUS='A'
            ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql2 ;
$result_a = $this->MYSQL->data();

//JIKA BELUM TERSEDIA
if (empty($result_a))
    {
			$data_detail2 = array(
				'RMP_REKAP_FC_ID' => $input['ID_FAKTUR_CABANG'],
				'RMP_REKAP_FC_TANGGAL' => $input['TANGGAL_FAKTUR_CABANG'],
				'RMP_REKAP_FC_KAPAL' => $input['KAPAL'],
				'RMP_REKAP_FC_TIMBANG' => $input['PONTON'],
				'RMP_MASTER_PERSONAL_ID' => $input['CABANG'],
				'RMP_REKAP_FC_TAMBANG' => $input['TAMBANG'],
				'RMP_REKAP_FC_BIAYA' => $input['BIAYA'],
				'RMP_REKAP_FC_KELAPA' => $input['HARGA_KELAPA_BULAT'],
				'RMP_REKAP_FC_JENIS_KB' => $input['JENIS_KB'],
				'RMP_REKAP_FC_QTY_PSKE_A' => $input['QTY_TERIMA_PSKE_A'],
				'RMP_REKAP_FC_QTY_PSKE_B' => $input['QTY_TERIMA_PSKE_B'],
				'RMP_REKAP_FC_QTY_PSKE_C' => $input['QTY_TERIMA_PSKE_C'],
				'RMP_REKAP_FC_POTONGAN_A' => $input['POTONGAN_KELAPA_A'],
				'RMP_REKAP_FC_POTONGAN_B' => $input['POTONGAN_KELAPA_B'],
			  'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
			  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
			  'RECORD_STATUS' => "A"

			);
			$this->MYSQL = new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel = "RMP_REKAP_FC";
			$this->MYSQL->record = $data_detail2;
			if ($this->MYSQL->simpan() == true)
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
			//EDIT DATA SEBELUMNNYA
			$data_detail = array(
				'EDIT_WAKTU' => date("Y-m-d H:i:s"),
			  'EDIT_OPERATOR' => $user_login['PERSONAL_NIK'],
			  'RECORD_STATUS' => "E"
	    );
	    $this->MYSQL = new MYSQL;
	    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
	    $this->MYSQL->tabel = "RMP_REKAP_FC";
	    $this->MYSQL->record = $data_detail;
	    $this->MYSQL->dimana = "where RMP_REKAP_FC_ID='" . $input['ID_FAKTUR_CABANG'] . "' AND RECORD_STATUS='A'";
	    $this->MYSQL->ubah();

			//INPUT DATA BARU
			$data_detail2 = array(
				'RMP_REKAP_FC_ID' => $input['ID_FAKTUR_CABANG'],
				'RMP_REKAP_FC_TANGGAL' => $input['TANGGAL_FAKTUR_CABANG'],
				'RMP_MASTER_PERSONAL_ID' => $input['CABANG'],
				'RMP_REKAP_FC_KAPAL' => $input['KAPAL'],
				'RMP_REKAP_FC_TIMBANG' => $input['PONTON'],
				'RMP_REKAP_FC_TAMBANG' => $input['TAMBANG'],
				'RMP_REKAP_FC_BIAYA' => $input['BIAYA'],
				'RMP_REKAP_FC_KELAPA' => $input['HARGA_KELAPA_BULAT'],
				'RMP_REKAP_FC_JENIS_KB' => $input['JENIS_KB'],
				'RMP_REKAP_FC_QTY_PSKE_A' => $input['QTY_TERIMA_PSKE_A'],
				'RMP_REKAP_FC_QTY_PSKE_B' => $input['QTY_TERIMA_PSKE_B'],
				'RMP_REKAP_FC_QTY_PSKE_C' => $input['QTY_TERIMA_PSKE_C'],
				'RMP_REKAP_FC_POTONGAN_A' => $input['POTONGAN_KELAPA_A'],
				'RMP_REKAP_FC_POTONGAN_B' => $input['POTONGAN_KELAPA_B'],
			  'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
			  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
			  'RECORD_STATUS' => "A"

			);
			$this->MYSQL = new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel = "RMP_REKAP_FC";
			$this->MYSQL->record = $data_detail2;
			if ($this->MYSQL->simpan() == true)
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


?>
