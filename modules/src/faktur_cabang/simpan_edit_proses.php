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
				 FROM RMP_REKAP_FC_PROSES
				 WHERE RMP_REKAP_FC_PROSES_ID='".$input['PROSES_ID']."' AND RECORD_STATUS='A'
            ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql2 ;
$result_a = $this->MYSQL->data();

//JIKA BELUM TERSEDIA
if (empty($result_a))
    {
			$data_detail2 = array(
				'RMP_REKAP_FC_ID' => $result_a[0]['RMP_REKAP_FC_ID'],
				'RMP_REKAP_FC_PROSES_ID' => $input['PROSES_ID'],
				'RMP_REKAP_FC_PROSES_NAMA' => $input['PROSES_NAMA'],
				'RMP_REKAP_FC_PROSES_JENIS' => $result_a[0]['RMP_REKAP_FC_PROSES_JENIS'],
				'RMP_REKAP_FC_PROSES_TANGGAL' => $result_a[0]['RMP_REKAP_FC_PROSES_TANGGAL'],
				'RMP_REKAP_FC_PROSES_BRUTO' => $input['PROSES_BRUTO'],
				'RMP_REKAP_FC_PROSES_POTONGAN' => $input['PROSES_POTONGAN'],
				'RMP_REKAP_FC_PROSES_NETTO' => $input['PROSES_NETTO'],
				'RMP_REKAP_FC_PROSES_RP_KG' => $input['PROSES_RP_KG'],
				'RMP_REKAP_FC_PROSES_RUPIAH_KB' => $input['PROSES_RUPIAH_KB'],
				'RMP_REKAP_FC_PROSES_TAMBANG' => $input['PROSES_TAMBANG'],
				'RMP_REKAP_FC_PROSES_BIAYA' => $input['PROSES_BIAYA'],
				'RMP_REKAP_FC_PROSES_RUPIAH_TOTAL' => $input['PROSES_RUPIAH_TOTAL'],

			  'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
			  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
			  'RECORD_STATUS' => "A"
			);
			$this->MYSQL = new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel = "RMP_REKAP_FC_PROSES";
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
	    $this->MYSQL->tabel = "RMP_REKAP_FC_PROSES";
	    $this->MYSQL->record = $data_detail;
	    $this->MYSQL->dimana = "where RMP_REKAP_FC_PROSES_ID='".$input['PROSES_ID']."' AND RECORD_STATUS='A'";
	    $this->MYSQL->ubah();

			//INPUT DATA BARU
			$data_detail2 = array(
				'RMP_REKAP_FC_ID' => $result_a[0]['RMP_REKAP_FC_ID'],
				'RMP_REKAP_FC_PROSES_ID' => $input['PROSES_ID'],
				'RMP_REKAP_FC_PROSES_NAMA' => $input['PROSES_NAMA'],
				'RMP_REKAP_FC_PROSES_JENIS' => $result_a[0]['RMP_REKAP_FC_PROSES_JENIS'],
				'RMP_REKAP_FC_PROSES_TANGGAL' => $result_a[0]['RMP_REKAP_FC_PROSES_TANGGAL'],
				'RMP_REKAP_FC_PROSES_BRUTO' => $input['PROSES_BRUTO'],
				'RMP_REKAP_FC_PROSES_POTONGAN' => $input['PROSES_POTONGAN'],
				'RMP_REKAP_FC_PROSES_NETTO' => $input['PROSES_NETTO'],
				'RMP_REKAP_FC_PROSES_RP_KG' => $input['PROSES_RP_KG'],
				'RMP_REKAP_FC_PROSES_RUPIAH_KB' => $input['PROSES_RUPIAH_KB'],
				'RMP_REKAP_FC_PROSES_TAMBANG' => $input['PROSES_TAMBANG'],
				'RMP_REKAP_FC_PROSES_BIAYA' => $input['PROSES_BIAYA'],
				'RMP_REKAP_FC_PROSES_RUPIAH_TOTAL' => $input['PROSES_RUPIAH_TOTAL'],

			  'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
			  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
			  'RECORD_STATUS' => "A"
			);
			$this->MYSQL = new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel = "RMP_REKAP_FC_PROSES";
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
