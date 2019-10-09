<?php

if (empty($params['case']))
    {
    $result['respon']['pesan'] == "gagal";
    $result['respon']['pesan'] == "Module tidak dapat di muat";
    echo json_encode($result);
    exit();
    }

$halaman = $params['halaman'];
$batas = $params['batas'];
$posisi = $this->PAGING->cariPosisi($batas, $halaman);
$input = $params['input_option'];

$sql = "SELECT * FROM RMP_MASTER_PERSONAL AS P
        LEFT JOIN RMP_MASTER_WILAYAH AS W ON P.SUB_WILAYAH_ID=W.RMP_MASTER_WILAYAH_ID
        LEFT JOIN RMP_REKENING_RELASI AS R ON P.RMP_MASTER_PERSONAL_ID=R.RMP_MASTER_PERSONAL_ID
        WHERE
        P.RECORD_STATUS='A'
        AND
        W.RECORD_STATUS='A'
        AND
        R.RECORD_STATUS='A'
        AND
        R.RMP_MASTER_MATERIAL_ID='".$input['MATERIAL']."'
        AND
        R.RMP_REKENING_RELASI_MATERIAL='".$input['JENIS_MATERIAL']."'
        AND
        (P.RMP_MASTER_PERSONAL_ROLE='PETANI' OR P.RMP_MASTER_PERSONAL_ROLE='PENGEPUL')";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql;
$result_a = $this->MYSQL->data();

// -- >>

$no = $posisi + 1;
foreach($result_a as $key => $value)
{
	
	$data_detail2 = array(
		'RMP_PENYESUAIAN_HARGA_KB_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
	  'RMP_MASTER_PERSONAL_ID' => $result_a[$key]['RMP_MASTER_PERSONAL_ID'],
	  'RMP_MASTER_MATERIAL_ID' => $input['MATERIAL'],
	  'RMP_PENYESUAIAN_HARGA_KB_JENIS_MATERIAL' => $input['JENIS_MATERIAL'],
	  'RMP_PENYESUAIAN_HARGA_KB_A' => $input['HARGA_PATOKAN_A'],
	  'RMP_PENYESUAIAN_HARGA_KB_B' => $input['HARGA_PATOKAN_B'],
	  'RMP_PENYESUAIAN_HARGA_KB_C' => $input['HARGA_PATOKAN_C'],
	  'RMP_PENYESUAIAN_HARGA_KB_TANGGAL_BERLAKU' => $input['QUALITED_HARGA_TANGGAL_BERLAKU'],
	  'RMP_PENYESUAIAN_HARGA_KB_TANGGAL_BERAKHIR' => $input['QUALITED_HARGA_TANGGAL_BERAKHIR'],

	  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
	  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
	  'RECORD_STATUS' => "A"
	);
$this->MYSQL = new MYSQL;
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->tabel = "RMP_PENYESUAIAN_HARGA_KB";
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
