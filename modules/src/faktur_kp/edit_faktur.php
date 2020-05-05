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

$sql = "SELECT * FROM RMP_FAKTUR AS F
        LEFT JOIN RMP_MASTER_PERSONAL AS P
        ON F.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
        LEFT JOIN RMP_FAKTUR_DETAIL AS FD
        ON F.RMP_FAKTUR_NO_FAKTUR=FD.RMP_FAKTUR_NO_FAKTUR
        LEFT JOIN PERSONAL AS PERSONAL
        ON F.RMP_FAKTUR_OPERATOR_TIMBANG=PERSONAL.PERSONAL_NIK
        WHERE
        F.RECORD_STATUS='A'
        AND FD.RECORD_STATUS='A'
        AND P.RECORD_STATUS='A'
        AND PERSONAL.RECORD_STATUS='A'
        AND F.RMP_FAKTUR_ID='".$input['FAKTUR_ID']."'";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql ;
$result_a = $this->MYSQL->data();
$no_faktur = $result_a[0]['RMP_FAKTUR_NO_FAKTUR'];

$sql2 = "SELECT * FROM RMP_FAKTUR AS F
        LEFT JOIN PERSONAL AS PERSONAL
        ON F.RMP_FAKTUR_QC=PERSONAL.PERSONAL_NIK
        WHERE
        F.RECORD_STATUS='A'
        AND PERSONAL.RECORD_STATUS='A'
        AND F.RMP_FAKTUR_ID='".$input['FAKTUR_ID']."'";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql2 ;
$result_a2 = $this->MYSQL->data();


$sql28 = "SELECT * FROM RMP_FAKTUR_PURCHASER
        WHERE RMP_FAKTUR_NO_FAKTUR='".$no_faktur."' AND RECORD_STATUS='A'";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql28 ;
$result_a28 = $this->MYSQL->data();
if (empty($result_a28))
    {
      $purchaser_proses = "TERSEDIA";
    }
  else
    {
      $purchaser_proses = "TIDAK TERSEDIA";
    }
// -- >>

$no = $posisi + 1;

foreach($result_a as $r)
    {
    $r['NO'] = $no;
    $result[] = $r;
    $no++;
    }

foreach($result_a2 as $r2)
    {
    $result2[] = $r2;
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
    $this->callback['respon']['text_msg'] = "OK..".$result2;
    $this->callback['respon']['total_kg'] = $total_kg;
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result2'] = $result2;
    $this->callback['purchaser_proses'] = $purchaser_proses;

    }

?>
