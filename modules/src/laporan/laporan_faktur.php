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
    $filter_a = "AND (RMP_MASTER_MATERIAL like '%" . $input['keyword'] . "%')";
    }

$sql = "SELECT * FROM
        RMP_FAKTUR AS F LEFT JOIN
        RMP_FAKTUR_PURCHASER AS FP
        ON F.RMP_FAKTUR_NO_FAKTUR=FP.RMP_FAKTUR_NO_FAKTUR
        LEFT JOIN
        RMP_MASTER_PERSONAL AS P
        ON
        P.RMP_MASTER_PERSONAL_ID=FP.RMP_MASTER_PERSONAL_ID
        LEFT JOIN
        RMP_MASTER_WILAYAH AS W
        ON
        P.SUB_WILAYAH_ID=W.RMP_MASTER_WILAYAH_ID
        LEFT JOIN
        RMP_REKENING_RELASI AS RR
        ON
        FP.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
        WHERE
        F.RECORD_STATUS='A'
        AND
        FP.RECORD_STATUS='A'
        AND
        P.RECORD_STATUS='A'
        AND
        RR.RECORD_STATUS='A'
        AND
        RR.RMP_REKENING_RELASI_MATERIAL LIKE '%".$input['material']."%'
        AND
        F.RMP_FAKTUR_TANGGAL LIKE '%".$input['tanggal']."%'
        AND
        F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%".$input['material']."%'
        ORDER BY RR.RMP_MASTER_WILAYAH_KODE ASC
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
    $r['RMP_MASTER_WILAYAH_KODE']=$r['RMP_MASTER_WILAYAH_KODE'];
    $grade_kelapa = substr($r['RMP_FAKTUR_JENIS_MATERIAL'],-1);
    $potongan = $r['RMP_FAKTUR_POTONGAN'];
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

    $sql23 = "SELECT *,SUM(RMP_FAKTUR_DETAIL_NETTO) AS SUM FROM
             RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR_DETAIL AS FD
             ON FP.RMP_FAKTUR_NO_FAKTUR=FD.RMP_FAKTUR_NO_FAKTUR
             WHERE
             FP.RMP_FAKTUR_NO_FAKTUR='".$r['RMP_FAKTUR_NO_FAKTUR']."'
             AND FP.RECORD_STATUS='A'
             AND FD.RECORD_STATUS='A'
             GROUP BY FP.RMP_FAKTUR_NO_FAKTUR
             ";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sql23 ;
    $result_b3 = $this->MYSQL->data();

    if($grade_kelapa =='A')
    {
      foreach($result_b3 as $rb3)
      {
        $r['RP_A'] =number_format($rb3['RMP_FAKTUR_PURCHASER_RP_KG']*($rb3['SUM']-(round(($rb3['SUM']*$potongan)/100))),0,",",".");
        $r['RP_B'] ="";
        $r['RP_C'] ="";

        $r['NETTO_A'] =$rb3['SUM']-(round(($rb3['SUM']*$potongan)/100));
        $r['NETTO_B'] ="";
        $r['NETTO_C'] ="";

        $r['RP_KG_A']=$rb3['RMP_FAKTUR_PURCHASER_RP_KG'];
        $r['RP_KG_B']="";
        $r['RP_KG_C']="";
      }
    }
    else if($grade_kelapa =='B')
    {
      foreach($result_b3 as $rb3)
      {
        $r['RP_A'] ="";
        $r['RP_B'] =number_format($rb3['RMP_FAKTUR_PURCHASER_RP_KG']*($rb3['SUM']-(round(($rb3['SUM']*$potongan)/100))),0,",",".");
        $r['RP_C'] ="";

        $r['NETTO_A'] ="";
        $r['NETTO_B'] =$rb3['SUM']-(round(($rb3['SUM']*$potongan)/100));
        $r['NETTO_C'] ="";

        $r['RP_KG_A']="";
        $r['RP_KG_B']=$rb3['RMP_FAKTUR_PURCHASER_RP_KG'];
        $r['RP_KG_C']="";
      }
    }
    else if($grade_kelapa =='C')
    {
      foreach($result_b3 as $rb3)
      {
        $r['RP_A'] ="";
        $r['RP_B'] ="";
        $r['RP_C'] =number_format($rb3['RMP_FAKTUR_PURCHASER_RP_KG']*($rb3['SUM']-(round(($rb3['SUM']*$potongan)/100))),0,",",".");

        $r['NETTO_A'] ="";
        $r['NETTO_B'] ="";
        $r['NETTO_C'] =$rb3['SUM']-(round(($rb3['SUM']*$potongan)/100));

        $r['RP_KG_A']="";
        $r['RP_KG_B']="";
        $r['RP_KG_C']=$rb3['RMP_FAKTUR_PURCHASER_RP_KG'];
      }
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
