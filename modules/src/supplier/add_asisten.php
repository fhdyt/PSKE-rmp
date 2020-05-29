<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

$input = $params['input_option'];

$id_asisten = waktu_decimal(Date("Y-m-d H:i:s"));
if (empty($result_a))
    {
			$data_detail2 = array(
			  'RMP_MASTER_PERSONAL_ID' => $id_asisten,
			  'RMP_MASTER_PERSONAL_ROLE' => "ASISTEN",
			  'RMP_MASTER_PERSONAL_FOTO' => $input['FOTO_ASISTEN'],
			  'RMP_MASTER_PERSONAL_NAMA' => $input['NAMA_ASISTEN'],
			  'RMP_MASTER_PERSONAL_KTP' => $input['KTP_ASISTEN'],
			  'RMP_MASTER_PERSONAL_NPWP' => $input['NPWP_ASISTEN'],
				'RMP_MASTER_PERSONAL_SUKU' => $input['SUKU_ASISTEN'],
				'RMP_MASTER_PERSONAL_HP' => $input['HP_ASISTEN'],
			  'RMP_MASTER_PERSONAL_PROVINSI' => $input['PROVINSI_ASISTEN'],
			  'RMP_MASTER_PERSONAL_KABUPATEN' => $input['KABUPATEN_ASISTEN'],
			  'RMP_MASTER_PERSONAL_KECAMATAN' => $input['KECAMATAN_ASISTEN'],
			  'RMP_MASTER_PERSONAL_DESA' => $input['DESA_ASISTEN'],
			  'RMP_MASTER_PERSONAL_ALAMAT' => $input['ALAMAT_PERSONAL_ASISTEN'],

			  'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
			  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
			  'RECORD_STATUS' => "A"
			);
			$this->MYSQL = new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel = "RMP_MASTER_PERSONAL";
			$this->MYSQL->record = $data_detail2;
			$this->MYSQL->simpan();

			$data_detail2 = array(
				'RMP_ASISTEN_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
			  'ASISTEN_ID' => $id_asisten,
			  'SUPPLIER_ID' => $input['ID_SUPPLIER'],

			  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
			  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
			  'RECORD_STATUS' => "A"
			);
			$this->MYSQL = new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel = "RMP_ASISTEN";
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
