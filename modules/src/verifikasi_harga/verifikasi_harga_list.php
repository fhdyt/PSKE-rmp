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

$sql = "SELECT *, F.ENTRI_WAKTU AS FENTRI_WAKTU, F.RECORD_STATUS AS FRECORD_STATUS
        FROM
        RMP_FAKTUR_PURCHASER AS F
        LEFT JOIN
        RMP_MASTER_PERSONAL AS P
        LEFT JOIN RMP_MASTER_WILAYAH AS W
        ON P.SUB_WILAYAH_ID=W.RMP_MASTER_WILAYAH_ID
        ON F.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
        WHERE F.RMP_FAKTUR_PURCHASER_VERIFIKASI_STATUS='VERIFIKASI'
        AND P.RECORD_STATUS='A'
        ORDER BY F.RMP_FAKTUR_PURCHASER_INDEX DESC
                        ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql . " limit " . $posisi . "," . $batas;
$result_a = $this->MYSQL->data();
$no_faktur = $result_a[0]['RMP_FAKTUR_NO_FAKTUR'];

$sql222222 = "SELECT * FROM RMP_FAKTUR AS F LEFT JOIN RMP_FAKTUR_DETAIL AS FD ON F.RMP_FAKTUR_NO_FAKTUR=FD.RMP_FAKTUR_NO_FAKTUR WHERE F.RMP_FAKTUR_NO_FAKTUR='".$no_faktur."'";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql222222;
$result_faktur = $this->MYSQL->data();
$material = $result_faktur[0]['RMP_FAKTUR_DETAIL_JENIS_MATERIAL'];
// -- >>

$no = $posisi + 1;

foreach($result_a as $r)
    {
    $r['NO'] = $no;
    $r['TANGGAL']=tanggal_format(Date("Y-m-d",strtotime($r['FENTRI_WAKTU'])));

    $sql445d = "SELECT * FROM PERSONAL WHERE PERSONAL_NIK='".$r['RMP_FAKTUR_PURCHASER_PURCHASER_NIK']."' AND RECORD_STATUS='A'";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sql445d;
    $result_abcd = $this->MYSQL->data();
    $r['PURCHASER'] = $result_abcd[0]['PERSONAL_NAME'];
    $r['MATERIAL'] = substr($material,0,-2);;

    $sql2B = "SELECT * FROM
               RMP_REKENING_RELASI AS RR LEFT JOIN
               RMP_MASTER_WILAYAH AS W
               ON RR.SUB_WILAYAH_KODE=W.RMP_MASTER_WILAYAH_KODE
               WHERE
              	RR.RECORD_STATUS='A'
  				 AND W.RECORD_STATUS='A'
  				 AND RR.RMP_MASTER_PERSONAL_ID='".$r['RMP_MASTER_PERSONAL_ID']."'
  				 AND RR.RMP_REKENING_RELASI_MATERIAL='".$r['MATERIAL']."'";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sql2B ;
    $result_bB = $this->MYSQL->data();

    $r['REKENING'] = $result_bB[0]['RMP_REKENING_RELASI'];
    $sub_wilayah_id = $result_bB[0]['ID_SUB_WILAYAH'];


    $sql2 = "SELECT * FROM
             RMP_MASTER_WILAYAH
             WHERE
             RMP_MASTER_WILAYAH_ID='".$sub_wilayah_id."' AND RECORD_STATUS='A'";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sql2 ;
    $result_b = $this->MYSQL->data();
    $r['LOKASI'] = $result_b[0]['RMP_MASTER_WILAYAH'];
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
