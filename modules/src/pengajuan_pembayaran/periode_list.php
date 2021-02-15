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
$date = date("Y-m-d");
$sql = "SELECT *
                FROM FINANCE_DANA_MATERIAL WHERE RECORD_STATUS='A' ORDER BY FINANCE_DANA_MATERIAL_TANGGAL DESC
                            ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql;
$result_a = $this->MYSQL->data();



//-- >>
$no = $posisi + 1;
foreach ($result_a as $r)
{
  $sql_kasir = "SELECT * FROM FINANCE_PEMBAGIAN_DANA_DETAIL WHERE FINANCE_DANA_MATERIAL_ID='".$r['FINANCE_DANA_MATERIAL_ID']."' AND RECORD_STATUS='A' AND  FINANCE_PEMBAGIAN_DANA_DETAIL_MASTER='kasir'";
  $this->MYSQL = new MYSQL();
  $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
  $this->MYSQL->queri = $sql_kasir;
  $result_kasir = $this->MYSQL->data();

  $sql_cabang = "SELECT * FROM FINANCE_PEMBAGIAN_DANA_DETAIL WHERE FINANCE_DANA_MATERIAL_ID='".$r['FINANCE_DANA_MATERIAL_ID']."' AND RECORD_STATUS='A' AND  FINANCE_PEMBAGIAN_DANA_DETAIL_MASTER='cabang'";
  $this->MYSQL = new MYSQL();
  $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
  $this->MYSQL->queri = $sql_cabang;
  $result_cabang = $this->MYSQL->data();


  $sql_jurnal = "SELECT SUM(RMP_JURNAL_RUPIAH_PENGAJUAN) AS TOTAL_PENGAJUAN FROM RMP_JURNAL WHERE FINANCE_DANA_MATERIAL_ID='".$r['FINANCE_DANA_MATERIAL_ID']."' AND RECORD_STATUS='A' LIMIT 1";
  $this->MYSQL = new MYSQL();
  $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
  $this->MYSQL->queri = $sql_jurnal;
  $result_jurnal = $this->MYSQL->data();

  $sql_pembagian = "SELECT * FROM FINANCE_PEMBAGIAN_DANA WHERE FINANCE_DANA_MATERIAL_ID='".$r['FINANCE_DANA_MATERIAL_ID']."' AND RECORD_STATUS='A' ORDER BY FINANCE_PEMBAGIAN_DANA_INDEX DESC LIMIT 1";
  $this->MYSQL = new MYSQL();
  $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
  $this->MYSQL->queri = $sql_pembagian;
  $result_pembagian = $this->MYSQL->data() ? : array() ;


    $r['NO'] = $no;
    $r['TANGGAL'] = tanggal_format(Date("Y-m-d", strtotime($r['FINANCE_DANA_MATERIAL_TANGGAL'])));
    $r['DANA'] = 'Rp. '.number_format($r['FINANCE_DANA_MATERIAL_DANA'],0,",",".");
    $r['SISA'] = 'Rp. '.number_format($result_pembagian[0]['FINANCE_PEMBAGIAN_DANA_DANA_FAKTUR']-$result_jurnal[0]['TOTAL_PENGAJUAN'],0,",",".");
    $r['DANA_KASIR'] = 'Rp. '.number_format($result_pembagian[0]['FINANCE_PEMBAGIAN_DANA_DANA_KASIR'],0,",",".");
    $r['DANA_CABANG'] = 'Rp. '.number_format($result_pembagian[0]['FINANCE_PEMBAGIAN_DANA_DANA_CABANG'],0,",",".");
    $r['DANA_FAKTUR'] = 'Rp. '.number_format($result_pembagian[0]['FINANCE_PEMBAGIAN_DANA_DANA_FAKTUR'],0,",",".");
    $r['DETAIL_DANA_KASIR'] = $result_kasir;
    $r['DETAIL_DANA_CABANG'] = $result_cabang;
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
