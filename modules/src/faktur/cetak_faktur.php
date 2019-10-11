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

$sql2="SELECT * FROM RMP_FAKTUR AS F
LEFT JOIN RMP_FAKTUR_PURCHASER AS FR ON F.RMP_FAKTUR_NO_FAKTUR=FR.RMP_FAKTUR_NO_FAKTUR
LEFT JOIN RMP_MASTER_PERSONAL AS P ON FR.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
LEFT JOIN RMP_REKENING_RELASI AS RR ON P.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
WHERE F.RMP_FAKTUR_ID='".$input['NO_FAKTUR']."'
AND RR.RMP_REKENING_RELASI_MATERIAL='".$input['MATERIAL']."'
AND F.RECORD_STATUS='A'
AND FR.RECORD_STATUS='A'
AND P.RECORD_STATUS='A'";

$this->MYSQL=new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql2;
$result_ab = $this->MYSQL->data();

$diterima = $result_ab[0]['RMP_FAKTUR_CEK_DITERIMA'];
$inspeksi = $result_ab[0]['RMP_FAKTUR_CEK_100_INSPEKSI'];
$dipisah = $result_ab[0]['RMP_FAKTUR_CEK_DIPISAH'];

$supplier = $result_ab[0]['RMP_MASTER_PERSONAL_NAMA'];
$supplier_sub = $result_ab[0]['RMP_FAKTUR_NAMA_SUB'];
$supplier_id = $result_ab[0]['RMP_MASTER_PERSONAL_ID'];
$rekening = $result_ab[0]['RMP_REKENING_RELASI'];
$tambang= $result_ab[0]['RMP_FAKTUR_PURCHASER_TAMBANG'];
$biaya = $result_ab[0]['RMP_FAKTUR_PURCHASER_BIAYA'];
$cek_tambang= $result_ab[0]['RMP_FAKTUR_CEK_TAMBANG'];
$cek_biaya = $result_ab[0]['RMP_FAKTUR_CEK_BIAYA'];



// DATA FAKTUR
$sql = "SELECT *, F.ENTRI_OPERATOR AS FENTRI_OPERATOR
FROM RMP_FAKTUR_DETAIL AS FD
LEFT JOIN RMP_FAKTUR AS F
ON FD.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
WHERE
FD.RMP_FAKTUR_NO_FAKTUR ='".$result_ab[0]['RMP_FAKTUR_NO_FAKTUR']."'
AND
FD.RECORD_STATUS='A'
AND F.RECORD_STATUS='A'
ORDER BY FD.RMP_FAKTUR_DETAIL_REF ASC";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql;
$result_a = $this->MYSQL->data();

// ALAMAT RELASI
$sqlU = "SELECT * FROM RMP_MASTER_PERSONAL AS P LEFT JOIN RMP_MASTER_WILAYAH AS W
ON P.SUB_WILAYAH_ID=W.RMP_MASTER_WILAYAH_ID WHERE P.RMP_MASTER_PERSONAL_ID='".$supplier_id."'";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sqlU;
$result_au = $this->MYSQL->data();
$lokasi = $result_au[0]['RMP_MASTER_WILAYAH'];

//NAMA OPERATOR TIMBANG
$sql3333 = "SELECT * FROM RMP_FAKTUR AS F LEFT JOIN PERSONAL AS P ON F.RMP_FAKTUR_OPERATOR_TIMBANG=P.PERSONAL_NIK
        WHERE F.RECORD_STATUS='A'
        AND P.RECORD_STATUS='A' AND F.RMP_FAKTUR_NO_FAKTUR='".$result_ab[0]['RMP_FAKTUR_NO_FAKTUR']."'";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql3333;
$result_av = $this->MYSQL->data();

$no = $posisi + 1;
foreach($result_av as $rrr)
    {
      $operatornama = $rrr['PERSONAL_NAME'];
      $result_av[] = $rrr;
    }

// NAMA INSPECTUR MUTU
$sql3333444 = "SELECT * FROM RMP_FAKTUR AS F LEFT JOIN PERSONAL AS P ON F.RMP_FAKTUR_QC=P.PERSONAL_NIK
        WHERE F.RECORD_STATUS='A'
        AND P.RECORD_STATUS='A' AND F.RMP_FAKTUR_NO_FAKTUR='".$result_ab[0]['RMP_FAKTUR_NO_FAKTUR']."'";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql3333444;
$result_avc = $this->MYSQL->data();

foreach($result_avc as $rrrv)
    {
      $qcnama = $rrrv['PERSONAL_NAME'];
      $result_avc[] = $rrrv;
    }

// NAMA ADMIN PKB
$sql3333444CCC = "SELECT * FROM RMP_FAKTUR AS F LEFT JOIN PERSONAL AS P ON F.ENTRI_OPERATOR=P.PERSONAL_NIK
        WHERE F.RECORD_STATUS='A'
        AND P.RECORD_STATUS='A' AND F.RMP_FAKTUR_NO_FAKTUR='".$result_ab[0]['RMP_FAKTUR_NO_FAKTUR']."'";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql3333444CCC;
$result_avcc = $this->MYSQL->data();

foreach($result_avcc as $rrrx)
    {
      $admnama = $rrrx['PERSONAL_NAME'];
      $result_avcc[] = $rrrx;
    }

// NAMA PURCHASER
$sql3333444CCCX = "SELECT *, F.ENTRI_OPERATOR AS PURCHASER FROM RMP_FAKTUR_PURCHASER AS F LEFT JOIN PERSONAL AS P ON F.RMP_FAKTUR_PURCHASER_PURCHASER_NIK=P.PERSONAL_NIK
        WHERE F.RECORD_STATUS='A'
        AND P.RECORD_STATUS='A' AND F.RMP_FAKTUR_NO_FAKTUR='".$result_ab[0]['RMP_FAKTUR_NO_FAKTUR']."'";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql3333444CCCX;
$result_avccb = $this->MYSQL->data();

foreach($result_avccb as $rrrxvvvvvv)
    {
      $purchaser = $rrrxvvvvvv['PURCHASER'];
      $purchasernama = $rrrxvvvvvv['PERSONAL_NAME'];
      $result_avccx[] = $rrrxvvvvvv;
    }


foreach($result_a as $rr)
    {
        $rr['NO'] = $no;
        $total_kg +=$rr['RMP_FAKTUR_DETAIL_BRUTO'];
        $jenis = $rr['jenis_kelapa'];
        $relasi = $rr['RMP_MASTER_PERSONAL_NAMA'];
        $alamat = $rr['alamat'];
        $catatan_supplier = $rr['RMP_FAKTUR_CATATAN_SUPPLIER'];
        $catatan_purchaser = $rr['RMP_FAKTUR_CATATAN_PURCHASER'];
        $potongan = $rr['RMP_FAKTUR_POTONGAN'];
        $operator = $rr['RMP_FAKTUR_OPERATOR_TIMBANG'];
        $qc = $rr['RMP_FAKTUR_QC'];
        $adm = $rr['FENTRI_OPERATOR'];
        $result[] = $rr;
        $no++;
    }

if (empty($result_a))
    {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Data tidak ada";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = "OK..".$total_kg;
    $this->callback['respon']['total_kg'] = $total_kg;
    $this->callback['respon']['potongan'] = $potongan;
    $this->callback['respon']['adm'] = $adm;
    $this->callback['respon']['admnama'] = $admnama;
    $this->callback['respon']['operator'] = $operator;
    $this->callback['respon']['operatornama'] = $operatornama;
    $this->callback['respon']['qc'] = $qc;
    $this->callback['respon']['qcnama'] = $qcnama;
    $this->callback['respon']['purchaser'] = $purchaser;
    $this->callback['respon']['purchasernama'] = $purchasernama;
    $this->callback['respon']['relasi'] = $relasi;
    $this->callback['respon']['catatan_supplier'] = $catatan_supplier;
    $this->callback['respon']['catatan_purchaser'] = $catatan_purchaser;
    $this->callback['respon']['lokasi'] = $lokasi;
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['diterima'] = $diterima;
    $this->callback['inspeksi'] = $inspeksi;
    $this->callback['dipisah'] = $dipisah;
    $this->callback['supplier'] = $supplier;
    $this->callback['supplier_sub'] = $supplier_sub;
    $this->callback['rekening'] = $rekening;
    $this->callback['tambang'] = $tambang;
    $this->callback['biaya'] = $biaya;
    $this->callback['cek_tambang'] = $cek_tambang;
    $this->callback['cek_biaya'] = $cek_biaya;

    }

?>
