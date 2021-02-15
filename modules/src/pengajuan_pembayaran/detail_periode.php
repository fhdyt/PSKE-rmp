<?php
//crontrol
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
$sql = "SELECT * FROM FINANCE_DANA_MATERIAL WHERE FINANCE_DANA_MATERIAL_ID='".$input['id_periode']."' AND RECORD_STATUS='A' LIMIT 1";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql;
$result_a = $this->MYSQL->data();

$sql_jurnal = "SELECT SUM(RMP_JURNAL_RUPIAH_PENGAJUAN) AS TOTAL_PENGAJUAN FROM RMP_JURNAL WHERE FINANCE_DANA_MATERIAL_ID='".$input['id_periode']."' AND RECORD_STATUS='A' LIMIT 1";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql_jurnal;
$result_jurnal = $this->MYSQL->data();

$sql_pembagian = "SELECT * FROM FINANCE_PEMBAGIAN_DANA WHERE FINANCE_DANA_MATERIAL_ID='".$input['id_periode']."' AND RECORD_STATUS='A' ORDER BY FINANCE_PEMBAGIAN_DANA_INDEX DESC LIMIT 1";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql_pembagian;
$result_pembagian = $this->MYSQL->data() ? : array() ;

//-- >>
$no = $posisi + 1;
foreach ($result_a as $r)
{
    $r['NO'] = $no;
    $r['TANGGAL'] = tanggal_format(Date("Y-m-d", strtotime($r['FINANCE_DANA_MATERIAL_TANGGAL'])));
    $r['HARI'] = nama_hari(Date("Y-m-d", strtotime($r['FINANCE_DANA_MATERIAL_TANGGAL'])));
    $r['DANA'] = $result_pembagian[0]['FINANCE_PEMBAGIAN_DANA_DANA_FAKTUR'];
    $r['TOTAL'] = $result_jurnal[0]['TOTAL_PENGAJUAN'];
    $r['SISA'] = $result_pembagian[0]['FINANCE_PEMBAGIAN_DANA_DANA_FAKTUR']-$result_jurnal[0]['TOTAL_PENGAJUAN'];
    $result[] = $r;
    $no++;
}
if (empty($result_a))
{
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Data item tidak ada.";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
}
else
{
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = "OK..";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result_option']['jml_halaman'] = $this->pagging(array(
        'sql' => $sql,
        'batas' => $batas
    ))->jmlhalaman;
}
?>
