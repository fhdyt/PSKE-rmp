<?php

if (empty($params['case']))
	{
	$result['respon']['pesan'] == "gagal";
	$result['respon']['pesan'] == "Module tidak dapat di muat";
	echo json_encode($result);
	exit();
	}

$input = $params['input_option'];

$sql = "SELECT * FROM
              RMP_MASTER_PERSONAL
          WHERE
        			RMP_MASTER_PERSONAL_ID='".$input['ID_SUPPLIER']."'
					AND
							RECORD_STATUS='A'";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql ;
$result_a = $this->MYSQL->data();

if (empty($result_a))
    {
			$data_detail2 = array(
			  'RMP_MASTER_PERSONAL_ID' => $input['ID_SUPPLIER'],
			  'RMP_MASTER_PERSONAL_ROLE' => $input['JENIS_SUPPLIER'],
			  'RMP_MASTER_PERSONAL_FOTO' => $input['FOTO_SUPPLIER'],
			  'RMP_MASTER_PERSONAL_NAMA' => $input['NAMA'],
			  'RMP_MASTER_PERSONAL_KTP' => $input['KTP'],
			  'RMP_MASTER_PERSONAL_NPWP' => $input['NPWP'],
				'RMP_MASTER_PERSONAL_SUKU' => $input['SUKU'],
			  'RMP_MASTER_PERSONAL_TANGGAL_DAFTAR' => $input['TANGGAL_DAFTAR'],
			  'RMP_MASTER_PERSONAL_PROVINSI' => $input['PROVINSI'],
			  'RMP_MASTER_PERSONAL_KABUPATEN' => $input['KABUPATEN'],
			  'RMP_MASTER_PERSONAL_KECAMATAN' => $input['KECAMATAN'],
			  'RMP_MASTER_PERSONAL_DESA' => $input['DESA'],
			  'RMP_MASTER_PERSONAL_ALAMAT' => $input['ALAMAT_PERSONAL'],
			  'RMP_MASTER_WILAYAH_ID' => $input['WILAYAH_SUPPLIER'],
			  'SUB_WILAYAH_ID' => $input['SUB_WILAYAH_SUPPLIER'],

			  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
			  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
			  'RECORD_STATUS' => "A"
			);
			$this->MYSQL = new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel = "RMP_MASTER_PERSONAL";
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
			$data_detail3 = array(
				'EDIT_WAKTU' => date("Y-m-d H:i:s") ,
				'EDIT_OPERATOR' => $user_login['PERSONAL_NIK'],
				'RECORD_STATUS' => "E"
			);
			$this->MYSQL = new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel = "RMP_MASTER_PERSONAL";
			$this->MYSQL->record = $data_detail3;
			$this->MYSQL->dimana = "where RMP_MASTER_PERSONAL_ID='".$input['ID_SUPPLIER']."' AND RECORD_STATUS='A'";
			$this->MYSQL->ubah();

			$data_detail2 = array(
			  'RMP_MASTER_PERSONAL_ID' => $input['ID_SUPPLIER'],
			  'RMP_MASTER_PERSONAL_ROLE' => $input['JENIS_SUPPLIER'],
			  'RMP_MASTER_PERSONAL_FOTO' => $input['FOTO_SUPPLIER'],
			  'RMP_MASTER_PERSONAL_NAMA' => $input['NAMA'],
			  'RMP_MASTER_PERSONAL_KTP' => $input['KTP'],
			  'RMP_MASTER_PERSONAL_NPWP' => $input['NPWP'],
				'RMP_MASTER_PERSONAL_SUKU' => $input['SUKU'],
			  'RMP_MASTER_PERSONAL_TANGGAL_DAFTAR' => $input['TANGGAL_DAFTAR'],
			  'RMP_MASTER_PERSONAL_PROVINSI' => $input['PROVINSI'],
			  'RMP_MASTER_PERSONAL_KABUPATEN' => $input['KABUPATEN'],
			  'RMP_MASTER_PERSONAL_KECAMATAN' => $input['KECAMATAN'],
			  'RMP_MASTER_PERSONAL_DESA' => $input['DESA'],
			  'RMP_MASTER_PERSONAL_ALAMAT' => $input['ALAMAT_PERSONAL'],
			  'RMP_MASTER_WILAYAH_ID' => $input['WILAYAH_SUPPLIER'],
				'SUB_WILAYAH_ID' => $input['SUB_WILAYAH_SUPPLIER'],

			  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
			  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
			  'RECORD_STATUS' => "A"
			);
			$this->MYSQL = new MYSQL;
			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->tabel = "RMP_MASTER_PERSONAL";
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
