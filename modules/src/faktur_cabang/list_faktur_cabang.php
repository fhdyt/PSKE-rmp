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

// if (empty($input['keyword']) or $input['keyword'] == "")
//     {
//     $filter_a = "";
//     }
//   else
//     {
//     $filter_a = "AND (RMP_MASTER_MATERIAL like '%" . $input['keyword'] . "%')";
//     }

$sql = "SELECT * FROM RMP_REKAP_FC AS FC
        LEFT JOIN RMP_MASTER_PERSONAL AS P
        ON
          FC.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
        WHERE FC.RECORD_STATUS='A'
        AND P.RECORD_STATUS='A'
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
    $r['TANGGAL']=tanggal_format(Date("Y-m-d",strtotime($r['RMP_REKAP_FC_TANGGAL'])));

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
