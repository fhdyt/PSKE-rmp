<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

$input = $params['input_option'];

$id_keluarga = waktu_decimal(Date("Y-m-d H:i:s"));
if (empty($result_a))
    {
			$data_detail2 = array(

			  'RMP_MASTER_PERSONAL_ID' => $id_keluarga,
			  'RMP_MASTER_PERSONAL_ROLE' => "KELUARGA",
			  'RMP_MASTER_PERSONAL_FOTO' => $input['FOTO_KELUARGA'],
			  'RMP_MASTER_PERSONAL_NAMA' => $input['NAMA_KELUARGA'],
			  'RMP_MASTER_PERSONAL_KTP' => $input['KTP_KELUARGA'],
			  'RMP_MASTER_PERSONAL_NPWP' => $input['NPWP_KELUARGA'],
				'RMP_MASTER_PERSONAL_SUKU' => $input['SUKU_KELUARGA'],
				'RMP_MASTER_PERSONAL_HP' => $input['HP_KELUARGA'],
			  'RMP_MASTER_PERSONAL_PROVINSI' => $input['PROVINSI_KELUARGA'],
			  'RMP_MASTER_PERSONAL_KABUPATEN' => $input['KABUPATEN_KELUARGA'],
			  'RMP_MASTER_PERSONAL_KECAMATAN' => $input['KECAMATAN_KELUARGA'],
			  'RMP_MASTER_PERSONAL_DESA' => $input['DESA_KELUARGA'],
			  'RMP_MASTER_PERSONAL_ALAMAT' => $input['ALAMAT_PERSONAL_KELUARGA'],

			  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
			  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
			  'RECORD_STATUS' => "A"
			);
			$this->MYSQL = new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel = "RMP_MASTER_PERSONAL";
			$this->MYSQL->record = $data_detail2;
			$this->MYSQL->simpan();

			$data_detail2 = array(
				'RMP_KELUARGA_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
			  'KELUARGA_ID' => $id_keluarga,
			  'RMP_KELUARGA_STATUS' => $input['STATUS_HUBUNGAN_KELUARGA'],
			  'SUPPLIER_ID' => $input['ID_SUPPLIER'],

			  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
			  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
			  'RECORD_STATUS' => "A"
			);
			$this->MYSQL = new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel = "RMP_KELUARGA";
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

    }


?>
