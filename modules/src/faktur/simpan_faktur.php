<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}


if(empty($input['ID_FAKTUR']))
{

			$input = $params['input_option'];
			$data_detail777 = array(
				'RECORD_STATUS' => "A"
			);

			$this->MYSQL = new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel = "RMP_FAKTUR_DETAIL";
			$this->MYSQL->record = $data_detail777;
			$this->MYSQL->dimana = "where RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."' AND RECORD_STATUS='N'";
			$this->MYSQL->ubah();

			if($input['CEK_DITERIMA'] == 'on')
			{
				$checkbox_diterima = "Y";
			}
			else
			{
				$checkbox_diterima = "N";
			}

			if($input['CEK_100_INSPEKSI'] == 'on')
			{
				$checkbox_100_inspeksi = "Y";
			}
			else
			{
				$checkbox_100_inspeksi = "N";
			}

			if($input['CEK_DIPISAH'] == 'on')
			{
				$checkbox_dipisah = "Y";
			}
			else
			{
				$checkbox_dipisah = "N";
			}

			$data_master = array(
				'RMP_FAKTUR_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
				'RMP_FAKTUR_NO_FAKTUR' => $input['NO_FAKTUR'],
				'RMP_MASTER_PERSONAL_ID' => $input['NAMA_SUPPLIER'],
				'RMP_FAKTUR_NAMA_SUB' => $input['NAMA_PETANI'],
				'RMP_FAKTUR_KAPAL' => $input['KAPAL_FAKTUR'],
				'RMP_FAKTUR_ALAMAT' => $input['ALAMAT_SUPPLIER'],
				'RMP_FAKTUR_TANGGAL' => $input['TANGGAL_FAKTUR'],
				'RMP_FAKTUR_POTONGAN' => $input['POTONGAN'],
				'RMP_FAKTUR_JENIS_MATERIAL' => $input['JENIS_KELAPA'],
				'RMP_FAKTUR_OPERATOR_TIMBANG' => $input['OPERATOR_TIMBANG'],
				'RMP_FAKTUR_QC' => $input['INSPEKTUR_MUTU'],
				'RMP_FAKTUR_CATATAN_PURCHASER' => $input['CATATAN_PURCHASER'],
				'RMP_FAKTUR_CATATAN_SUPPLIER' => $input['CATATAN_SUPPLIER'],
				'RMP_FAKTUR_CEK_DITERIMA' => $checkbox_diterima,
				'RMP_FAKTUR_CEK_100_INSPEKSI' => $checkbox_100_inspeksi,
				'RMP_FAKTUR_CEK_DIPISAH' => $checkbox_dipisah,
				'RMP_FAKTUR_JENIS' => "FAKTUR",
			  'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
			  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
			  'RECORD_STATUS' => "A"
			);

			$this->MYSQL =new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel ="RMP_FAKTUR";
			$this->MYSQL->record = $data_master;

			if ($this->MYSQL->simpan() == true)
				{
					$this->MYSQL=new MYSQL();
					$this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
					$this->MYSQL->queri="select * from RMP_FAKTUR
														WHERE
												RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."'
														AND
												RECORD_STATUS='A' LIMIT 1";
					$result_a=$this->MYSQL->data();

					foreach($result_a as $r)
					{
						$result[]=$r;
					}
					if(empty($result)){
						$this->callback['respon']['pesan']="gagal";
						$this->callback['respon']['text_msg']="Data kosong _";
						$this->callback['result']=$result;
					}else{
						$this->callback['respon']['pesan']="sukses";
						$this->callback['respon']['text_msg']="OK".print_r($result,true);
						$this->callback['result']=$result;
					}


				}
			  else
				{
				$this->callback['respon']['pesan'] = "gagal";
				$this->callback['respon']['text_msg'] = "Gagal Simpan";
				}

}
//////////////////////////////////////////////// ELSE NOT EMPTY ///////////////////////
else
{

			$input = $params['input_option'];
			// $sql = "SELECT * FROM RMP_FAKTUR
			//         WHERE
			//     RMP_FAKTUR_ID='".$input['ID_FAKTUR']."' AND RECORD_STATUS='A'";
			//
			// $this->MYSQL = new MYSQL();
			// $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			// $this->MYSQL->queri = $sql ;
			// $result_a = $this->MYSQL->data();
			// $tanggal_faktur = $result_a[0]['RMP_FAKTUR_TANGGAL'];

			$data_detail7778 = array(
				'RECORD_STATUS' => "E"
			);

			$this->MYSQL = new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel = "RMP_FAKTUR";
			$this->MYSQL->record = $data_detail7778;
			$this->MYSQL->dimana = "where RMP_FAKTUR_ID='".$input['ID_FAKTUR']."' AND RECORD_STATUS='A'";
			$this->MYSQL->ubah()	;

			$data_detail777 = array(
				'RECORD_STATUS' => "A"
			);

			$this->MYSQL = new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel = "RMP_FAKTUR_DETAIL";
			$this->MYSQL->record = $data_detail777;
			$this->MYSQL->dimana = "where RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."' AND RECORD_STATUS='N'";
			$this->MYSQL->ubah();

			if($input['CEK_DITERIMA'] == 'on')
			{
				$checkbox_diterima = "Y";
			}
			else
			{
				$checkbox_diterima = "N";
			}

			if($input['CEK_100_INSPEKSI'] == 'on')
			{
				$checkbox_100_inspeksi = "Y";
			}
			else
			{
				$checkbox_100_inspeksi = "N";
			}

			if($input['CEK_DIPISAH'] == 'on')
			{
				$checkbox_dipisah = "Y";
			}
			else
			{
				$checkbox_dipisah = "N";
			}



			$data_master = array(
				'RMP_FAKTUR_ID' => $input['ID_FAKTUR'],
				'RMP_FAKTUR_NO_FAKTUR' => $input['NO_FAKTUR'],
				'RMP_MASTER_PERSONAL_ID' => $input['NAMA_SUPPLIER'],
				'RMP_FAKTUR_NAMA_SUB' => $input['NAMA_PETANI'],
				'RMP_FAKTUR_KAPAL' => $input['KAPAL_FAKTUR'],
				'RMP_FAKTUR_ALAMAT' => $input['ALAMAT_SUPPLIER'],
				'RMP_FAKTUR_TANGGAL' => $input['TANGGAL_FAKTUR'],
				'RMP_FAKTUR_POTONGAN' => $input['POTONGAN'],
				'RMP_FAKTUR_JENIS_MATERIAL' => $input['JENIS_KELAPA'],
				'RMP_FAKTUR_OPERATOR_TIMBANG' => $input['OPERATOR_TIMBANG'],
				'RMP_FAKTUR_QC' => $input['INSPEKTUR_MUTU'],
				'RMP_FAKTUR_CATATAN_PURCHASER' => $input['CATATAN_PURCHASER'],
				'RMP_FAKTUR_CATATAN_SUPPLIER' => $input['CATATAN_SUPPLIER'],
				'RMP_FAKTUR_CEK_DITERIMA' => $checkbox_diterima,
				'RMP_FAKTUR_CEK_100_INSPEKSI' => $checkbox_100_inspeksi,
				'RMP_FAKTUR_CEK_DIPISAH' => $checkbox_dipisah,
				'RMP_FAKTUR_JENIS' => "FAKTUR",
			  'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
			  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
			  'RECORD_STATUS' => "A"
			);

			$this->MYSQL =new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel ="RMP_FAKTUR";
			$this->MYSQL->record = $data_master;

			if ($this->MYSQL->simpan() == true)
				{
					$this->MYSQL=new MYSQL();
					$this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
					$this->MYSQL->queri="select * from RMP_FAKTUR
														WHERE
												RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."'
														AND
												RECORD_STATUS='A' LIMIT 1";
					$result_a=$this->MYSQL->data();

					foreach($result_a as $r)
					{
						$result[]=$r;
					}
					if(empty($result)){
						$this->callback['respon']['pesan']="gagal";
						$this->callback['respon']['text_msg']="Data kosong _";
						$this->callback['result']=$result;
					}else{
						$this->callback['respon']['pesan']="sukses";
						$this->callback['respon']['text_msg']="OK".print_r($result,true);
						$this->callback['result']=$result;
					}


				}
			  else
				{
				$this->callback['respon']['pesan'] = "gagal";
				$this->callback['respon']['text_msg'] = "Gagal Simpan";
				}

}
?>
