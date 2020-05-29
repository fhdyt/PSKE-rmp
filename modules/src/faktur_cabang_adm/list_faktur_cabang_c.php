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

$sql_0 = "SELECT * FROM RMP_REKAP_FC WHERE RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."' AND RECORD_STATUS='A'";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql_0;
$result_nb = $this->MYSQL->data();
$jeniskb = $result_nb[0]['RMP_REKAP_FC_JENIS_KB'];


$sql = "SELECT * FROM RMP_REKAP_FC_PROSES
        WHERE RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
        AND RMP_REKAP_FC_PROSES_JENIS = '".$jeniskb."-C'
        AND RECORD_STATUS='A'
        ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql;
$result_c = $this->MYSQL->data();

// -- >>

$no = $posisi + 1;

foreach($result_c as $r)
    {
    $r['NO'] = $no;
    $total_bruto_c += $r['RMP_REKAP_FC_PROSES_BRUTO'];
    $total_potongan_c += $r['RMP_REKAP_FC_PROSES_POTONGAN'];
    $total_netto_c += $r['RMP_REKAP_FC_PROSES_NETTO'];
    $result[] = $r;
    $no++;
    }

if (empty($result_c))
    {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Data tidak ada";
    $this->callback['filter'] = $params;
    $this->callback['result_c'] = $result;
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = "OK..";
    $this->callback['filter'] = $params;
    $this->callback['result_c'] = $result;
    $this->callback['total_bruto_c'] = $total_bruto_c;
    $this->callback['total_potongan_c'] = $total_potongan_c;
    $this->callback['total_netto_c'] = $total_netto_c;
    $this->callback['result_option']['jml_halaman'] = $this->pagging(array(
        'sql' => $sql,
        'batas' => $batas
    ))->jmlhalaman;
    }

?>
