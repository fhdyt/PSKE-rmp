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

if (empty($input['material']) or $input['material'] == "")
    {
    $filter_b = "";
    }
  else
    {
    $filter_b = "AND FD.RMP_FAKTUR_DETAIL_JENIS_MATERIAL like '%" . $input['material'] . "%' ";
    }

if (empty($input['tanggal']) or $input['tanggal'] == "")
    {
    $filter_c = "";
    }
  else
    {
    $filter_c = "AND F.RMP_FAKTUR_TANGGAL = '" . $input['tanggal'] . "' ";
    }

$sql = "SELECT * FROM RMP_FAKTUR AS F
            LEFT JOIN RMP_MASTER_PERSONAL AS P
            ON F.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
            LEFT JOIN RMP_FAKTUR_DETAIL AS FD
            ON F.RMP_FAKTUR_NO_FAKTUR=FD.RMP_FAKTUR_NO_FAKTUR
            LEFT JOIN RMP_MASTER_WILAYAH AS W
            ON P.SUB_WILAYAH_ID=W.RMP_MASTER_WILAYAH_ID
            WHERE F.RECORD_STATUS='A' AND P.RECORD_STATUS='A' AND FD.RECORD_STATUS='A'
            AND
            W.RECORD_STATUS='A' " . $filter_b . " " . $filter_c . "
             GROUP BY F.RMP_FAKTUR_NO_FAKTUR ORDER BY F.RMP_FAKTUR_INDEX DESC
                        ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql . " limit " . $posisi . "," . $batas;
$result_a = $this->MYSQL->data();

// -- >>

$no = $posisi + 1;

foreach($result_a as $r)
    {
    $r['NO'] = $no;
    $r['TANGGAL']=tanggal_format(Date("Y-m-d",strtotime($r['RMP_FAKTUR_TANGGAL'])));
    $sql2 = "SELECT * FROM
             RMP_MASTER_WILAYAH
             WHERE
             RMP_MASTER_WILAYAH_ID='".$r['RMP_MASTER_WILAYAH_PREV_LINK']."' AND RECORD_STATUS='A'";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sql2 ;
    $result_b = $this->MYSQL->data();

    foreach($result_b as $rb)
    {
      $r['MASTER_WILAYAH']=$rb['RMP_MASTER_WILAYAH'];
    }
    $sql445d = "SELECT *, PC.RECORD_STATUS AS PCRECORD_STATUS FROM RMP_FAKTUR_PURCHASER AS PC LEFT JOIN RMP_MASTER_PERSONAL AS P
                ON PC.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
                WHERE
                PC.RMP_FAKTUR_NO_FAKTUR='".$r['RMP_FAKTUR_NO_FAKTUR']."' AND (PC.RECORD_STATUS='A' OR PC.RECORD_STATUS='N' OR PC.RECORD_STATUS='V') AND P.RECORD_STATUS='A'";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sql445d;
    $result_abcd = $this->MYSQL->data();

    $r['STATUS_PURCHASAER'] = $result_abcd[0]['PCRECORD_STATUS'];
    $r['NAMA_SUPPLIER_FAKTUR'] = $result_abcd[0]['RMP_MASTER_PERSONAL_NAMA'];
    $result[] = $r;
    $no++;
    }

if (empty($result_a))
    {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Data tidak ada.";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = $input['tanggal'];
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result_option']['jml_halaman'] = $this->pagging(array(
        'sql' => $sql,
        'batas' => $batas
    ))->jmlhalaman;
    }

?>
