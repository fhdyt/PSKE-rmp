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

if (empty($input['keyword']) or $input['keyword'] == "")
    {
    $filter_a = "";
    }
  else
    {
    $filter_a = "AND (P.RMP_MASTER_PERSONAL_NAMA like '%" . $input['keyword'] . "%' OR W.RMP_MASTER_WILAYAH like '%" . $input['keyword'] . "%' )";
    }

if (empty($input['FILTER_WILAYAH_SUPPLIER']) or $input['FILTER_WILAYAH_SUPPLIER'] == "")
    {
    $filter_b = "";
    }
  else
    {
    $filter_b = "AND P.SUB_WILAYAH_ID like '%" . $input['FILTER_WILAYAH_SUPPLIER'] . "%' ";
    }

$sql = "SELECT * FROM RMP_MASTER_PERSONAL AS P
        LEFT JOIN RMP_MASTER_WILAYAH AS W ON P.SUB_WILAYAH_ID=W.RMP_MASTER_WILAYAH_ID
        WHERE
        P.RECORD_STATUS='A'
        AND
        W.RECORD_STATUS='A'
        AND
        (P.RMP_MASTER_PERSONAL_ROLE='PETANI' OR P.RMP_MASTER_PERSONAL_ROLE='PENGEPUL') " . $filter_a . " " . $filter_b . " GROUP BY P.RMP_MASTER_PERSONAL_ID";
// $sql = "SELECT * FROM RMP_MASTER_PERSONAL AS P
//         LEFT JOIN RMP_MASTER_WILAYAH AS W ON P.SUB_WILAYAH_ID=W.RMP_MASTER_WILAYAH_ID
//         LEFT JOIN RMP_REKENING_RELASI AS R ON P.RMP_MASTER_PERSONAL_ID=R.RMP_MASTER_PERSONAL_ID
//         WHERE
//         P.RECORD_STATUS='A'
//         AND
//         W.RECORD_STATUS='A'
//         AND
//         R.RECORD_STATUS='A'
//         AND
//         (P.RMP_MASTER_PERSONAL_ROLE='PETANI' OR P.RMP_MASTER_PERSONAL_ROLE='PENGEPUL') " . $filter_a . " " . $filter_b . " GROUP BY P.RMP_MASTER_PERSONAL_ID ORDER BY R.RMP_MASTER_WILAYAH_KODE, R.SUB_WILAYAH_KODE ASC";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql . " limit " . $posisi . "," . $batas;
$result_a = $this->MYSQL->data();

// -- >>

$no = $posisi + 1;
foreach($result_a as $r)
    {
        $r['NO'] = $no;
        $r['TANGGAL_DAFTAR']=tanggal_format(Date("Y-m-d",strtotime($r['RMP_MASTER_PERSONAL_TANGGAL_DAFTAR'])));

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

        $sql22 = "SELECT * FROM
                 RMP_REKENING_RELASI
                 WHERE
                 RMP_MASTER_PERSONAL_ID='".$r['RMP_MASTER_PERSONAL_ID']."' AND RECORD_STATUS='A' AND RMP_REKENING_RELASI_MATERIAL='".$input['FILTER_MATERIAL']."' LIMIT 1";
        $this->MYSQL = new MYSQL();
        $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
        $this->MYSQL->queri = $sql22 ;
        $result_bc = $this->MYSQL->data();

        foreach($result_bc as $rbc)
        {
          $r['REKENING_RELASI']=$rbc['RMP_REKENING_RELASI'];
        }
        $result[] = $r;
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
    $this->callback['respon']['text_msg'] = "OK..";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result_option']['jml_halaman'] = $this->pagging(array(
        'sql' => $sql,
        'batas' => $batas
    ))->jmlhalaman;
    }

?>
