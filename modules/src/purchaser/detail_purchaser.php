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

// AMBIL JENIS Material
$sql44 = "SELECT * FROM RMP_FAKTUR AS F
            LEFT JOIN RMP_MASTER_PERSONAL AS P
            ON F.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
            LEFT JOIN RMP_FAKTUR_DETAIL AS FD
            ON F.RMP_FAKTUR_NO_FAKTUR=FD.RMP_FAKTUR_NO_FAKTUR
            WHERE F.RECORD_STATUS='A' AND P.RECORD_STATUS='A' AND FD.RECORD_STATUS='A'
            AND F.RMP_FAKTUR_ID='".$input['ID_FAKTUR']."'
            GROUP BY F.RMP_FAKTUR_NO_FAKTUR ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql44;
$result_ab = $this->MYSQL->data();
$material=substr($result_ab[0]['RMP_FAKTUR_DETAIL_JENIS_MATERIAL'],0,-2);
/////////////////////////////////////////////////////////////////////////////////////////


$sql445 = "SELECT *, FR.RECORD_STATUS AS FRRECORD_STATUS FROM RMP_FAKTUR AS F LEFT JOIN RMP_FAKTUR_PURCHASER AS FR
            ON F.RMP_FAKTUR_NO_FAKTUR=FR.RMP_FAKTUR_NO_FAKTUR LEFT JOIN RMP_MASTER_PERSONAL AS P
            ON FR.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
            WHERE
            F.RMP_FAKTUR_ID='".$input['ID_FAKTUR']."' AND F.RECORD_STATUS='A' AND (FR.RECORD_STATUS='A' OR FR.RECORD_STATUS='N' OR FR.RECORD_STATUS='V') AND P.RECORD_STATUS='A'";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql445;
$result_abc = $this->MYSQL->data();

// -- >>
$no = $posisi + 1;
    foreach($result_abc as $rrr)
        {
        $sql445d = "SELECT * FROM RMP_REKENING_RELASI
                    WHERE
                    RMP_REKENING_RELASI_MATERIAL='".$material."'
                    AND RMP_MASTER_PERSONAL_ID='".$rrr['RMP_MASTER_PERSONAL_ID']."' AND RECORD_STATUS='A'";
        $this->MYSQL = new MYSQL();
        $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
        $this->MYSQL->queri = $sql445d;
        $result_abcd = $this->MYSQL->data();
        $rrr['REKENING'] = $result_abcd[0]['RMP_REKENING_RELASI'];

        //ALAMAT RELASI
        $sqlU = "SELECT * FROM RMP_MASTER_PERSONAL AS P LEFT JOIN RMP_MASTER_WILAYAH AS W
      	ON P.SUB_WILAYAH_ID=W.RMP_MASTER_WILAYAH_ID WHERE P.RMP_MASTER_PERSONAL_ID='".$rrr['RMP_MASTER_PERSONAL_ID']."' AND P.RECORD_STATUS='A' AND W.RECORD_STATUS='A'";
      	$this->MYSQL = new MYSQL();
      	$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
      	$this->MYSQL->queri = $sqlU;
      	$result_au = $this->MYSQL->data();
      	$rrr['ALAMAT'] = $result_au[0]['RMP_MASTER_WILAYAH'];

        $resultbc[] = $rrr;
        }

if (empty($result_abc))
    {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = $sql445d;
    $this->callback['filter'] = $params;
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = $sql445d;
    $this->callback['filter'] = $params;
    $this->callback['resultbc'] = $resultbc;
    }

?>
