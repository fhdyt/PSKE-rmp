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

$bulan = date("m",strtotime($input['tanggal']));
$tahun = date("Y",strtotime($input['tanggal']));
$tanggalterakhir = date("Y-m-t", strtotime($input['tanggal']));

$sql = "SELECT *
                FROM RMP_AMBIL_SETOR
                WHERE RMP_AMBIL_SETOR_REKENING='".$input['rekening']."'
                AND RMP_AMBIL_SETOR_TANGGAL >= '".$tahun."-".$bulan."-01'
                AND RMP_AMBIL_SETOR_TANGGAL <= '".$tanggalterakhir."'
                AND RMP_AMBIL_SETOR_JENIS= '".$input['jenis']."'
                AND RECORD_STATUS='A' ORDER BY RMP_AMBIL_SETOR_TANGGAL ASC";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql;
$result_a = $this->MYSQL->data();
//-- >>
$no = $posisi + 1;
foreach ($result_a as $r)
{
    $r['NO'] = $no;
    $r['TANGGAL'] = tanggal_format(Date("Y-m-d", strtotime($r['RMP_AMBIL_SETOR_TANGGAL'])));
    $result[] = $r;
    $no++;
}
if (empty($result_a))
{
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Belum ada Pengambilan dan Penyetoran.";
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
