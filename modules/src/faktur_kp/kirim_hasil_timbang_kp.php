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

$sql_2 = "SELECT * FROM RMP_FAKTUR_PURCHASER
        WHERE
    RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."' AND RECORD_STATUS='A' ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql_2 ;
$result_abx = $this->MYSQL->data();

foreach($result_abx as $r)
    {
    }

if (empty($result_abx))
{
				$tanggalnota = $input['TANGGAL_NOTA'];
				$sql33 = "SELECT * FROM relasi.kopra_".$tanggalnota." WHERE recno='".$input['ID_TIMBANG']."' LIMIT 1";
				$this->MYSQL = new MYSQL();
				$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama_relasi_isea;
				$this->MYSQL->queri = $sql33 ;
				$result_a = $this->MYSQL->data();

				$jenis_kelapa = $result_a[0]['jenis_kelapa'];
				$ponton = $result_a[0]['jenis_kelapa'];
				if(empty($input['NO_FAKTUR']))
				{
					$buat_nomor_faktur=$RMP_CONFIG->buat_nomor_faktur_kopra($tanggalnota,$ponton)->callback['nomor'];
				}
				else {
					$buat_nomor_faktur = $input['NO_FAKTUR'];
				}

				$data_detail2 = array(
					'RMP_FAKTUR_DETAIL_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
					'id_nota' => $result_a[0]['recno'],
					'RMP_FAKTUR_DETAIL_REF' => $result_a[0]['ref'],
					'RMP_FAKTUR_DETAIL_ID_TIMBANG' => $result_a[0]['id'],
					'RMP_FAKTUR_NO_FAKTUR' => $buat_nomor_faktur,
					'RMP_FAKTUR_DETAIL_JENIS_MATERIAL' => "KOPRA",
					'RMP_FAKTUR_DETAIL_NO_NOTA' => $result_a[0]['relasi'],
					'RMP_FAKTUR_DETAIL_GROSS' => $result_a[0]['gross'],
					'RMP_FAKTUR_DETAIL_TARA' => $result_a[0]['tar'],
					'RMP_FAKTUR_DETAIL_BRUTO' => $result_a[0]['gross']-$result_a[0]['tar'],
					'RMP_FAKTUR_DETAIL_POTONGAN' => '0',
					'RMP_FAKTUR_DETAIL_NETTO' => $result_a[0]['gross']-$result_a[0]['tar'],
					'RMP_FAKTUR_DETAIL_TANGGAL' => $result_a[0]['tgl'],
				  'ENTRI_WAKTU' => date("Y-m-d H:i:s") ,
				  'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
				  'RECORD_STATUS' => "N"
				);

				$this->MYSQL = new MYSQL;
				$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
				$this->MYSQL->tabel = "RMP_FAKTUR_DETAIL";
				$this->MYSQL->record = $data_detail2;
				if ($this->MYSQL->simpan() == true)
					{
					$this->callback['respon']['pesan'] = "sukses";
					$this->callback['respon']['text_msg'] = $result_a[0]['relasi'];
					$this->callback['respon']['no_faktur'] = $buat_nomor_faktur;
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
	$this->callback['respon']['text_msg'] = $input['NO_FAKTUR'];
	$this->callback['filter'] = $params;
	$this->callback['result'] = $result;
}

?>
