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

$sql = "SELECT
          P.RMP_MASTER_PERSONAL_NAMA AS RMP_MASTER_PERSONAL_NAMA,
          F.RMP_FAKTUR_ALAMAT AS RMP_FAKTUR_ALAMAT,
          F.RMP_FAKTUR_JENIS_MATERIAL AS RMP_FAKTUR_JENIS_MATERIAL,
          F.RMP_FAKTUR_POTONGAN AS RMP_FAKTUR_POTONGAN,
          F.RMP_FAKTUR_NO_FAKTUR AS RMP_FAKTUR_NO_FAKTUR,
          RR.RMP_REKENING_RELASI AS RMP_REKENING_RELASI,
          F.RMP_FAKTUR_ID AS RMP_FAKTUR_ID,
          F.RMP_FAKTUR_STATUS AS RMP_FAKTUR_STATUS,
          F.RMP_FAKTUR_NAMA_SUB AS RMP_FAKTUR_NAMA_SUB
        FROM
        RMP_FAKTUR AS F LEFT JOIN
        RMP_MASTER_PERSONAL AS P
        ON
        P.RMP_MASTER_PERSONAL_ID=F.RMP_MASTER_PERSONAL_ID
        LEFT JOIN
        RMP_REKENING_RELASI AS RR
        ON
        F.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
        WHERE
        RR.RMP_REKENING_RELASI_MATERIAL LIKE '%".$input['material']."%'
        AND
        F.RMP_FAKTUR_TANGGAL LIKE '%".$input['tanggal']."%'
        AND
        RR.RMP_MASTER_WILAYAH_KODE = '".$input['wilayah']."'
        AND
        F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%".$input['material']."%'
        AND
        F.RECORD_STATUS='A'
        AND
        P.RECORD_STATUS='A'
        AND
        RR.RECORD_STATUS='A'
        ORDER BY F.RMP_MASTER_PERSONAL_ID ASC
        ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql;
$result_a = $this->MYSQL->data();

// -- >>

$no = $posisi + 1;

foreach($result_a as $r)
    {
      $sql2_purchaser = "SELECT *, RECORD_STATUS AS PURCHASER_STATUS FROM
               RMP_FAKTUR_PURCHASER
               WHERE
               RMP_FAKTUR_NO_FAKTUR='".$r['RMP_FAKTUR_NO_FAKTUR']."' AND RECORD_STATUS='A'";
      $this->MYSQL = new MYSQL();
      $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
      $this->MYSQL->queri = $sql2_purchaser ;
      $result_purchaser = $this->MYSQL->data();

    $r['NO'] = $no;
    $r['TOTAL_BRUTO'] += $r['RMP_FAKTUR_PURCHASER_BRUTO'];
    $r['RMP_MASTER_WILAYAH_KODE']=$r['RMP_MASTER_WILAYAH_KODE'];
    $r['MASTER_WILAYAH']=$r['RMP_FAKTUR_ALAMAT'];
    $r['PURCHASER_STATUS'] = $result_purchaser[0]['PURCHASER_STATUS'];
    $grade_kelapa = substr($r['RMP_FAKTUR_JENIS_MATERIAL'],-1);
    $potongan = $r['RMP_FAKTUR_POTONGAN'];

    $sql2 = "SELECT * FROM
             RMP_MASTER_WILAYAH
             WHERE
             RMP_MASTER_WILAYAH_ID='".$r['SUB_WILAYAH_ID']."' AND RECORD_STATUS='A'";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sql2 ;
    $result_b = $this->MYSQL->data();

    foreach($result_b as $rb)
    {
      //$r['MASTER_WILAYAH']=$rb['RMP_MASTER_WILAYAH'];
    }

    $sql23 = "SELECT * FROM
             RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
             ON FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
             WHERE
             FP.RMP_FAKTUR_NO_FAKTUR='".$r['RMP_FAKTUR_NO_FAKTUR']."'
             AND
             FP.RECORD_STATUS='A'
             AND
             F.RECORD_STATUS='A'
             GROUP BY FP.RMP_FAKTUR_NO_FAKTUR
             ";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sql23 ;
    $result_b3 = $this->MYSQL->data();

    if($grade_kelapa =='A')
    {
      $bulan = date("m",strtotime($input['tanggal']));
      $tahun = date("Y",strtotime($input['tanggal']));

      $sqlsum = "SELECT
                        SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS SUM_BRUTO,
                        SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS SUM_NETTO,
                        SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS SUM_RP
                FROM
                RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
                ON
                FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
                LEFT JOIN
                RMP_REKENING_RELASI AS RR
                ON
                FP.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
                WHERE
                F.RMP_FAKTUR_TANGGAL LIKE '%".$input['tanggal']."%'
                AND
                F.RMP_FAKTUR_JENIS_MATERIAL = '".$input['material']."-A'
                AND
                RR.RMP_REKENING_RELASI_MATERIAL = '".$input['material']."'
                AND
                RR.RMP_MASTER_WILAYAH_KODE = '".$input['wilayah']."'
                AND
                FP.RECORD_STATUS='A'
                AND
                F.RECORD_STATUS='A'
                AND
                RR.RECORD_STATUS='A'
               ";
      $this->MYSQL = new MYSQL();
      $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
      $this->MYSQL->queri = $sqlsum ;
      $result_sum = $this->MYSQL->data();

      $r['SUM_BRUTO_A']=number_format($result_sum[0]['SUM_BRUTO'],0,",",".");
      $r['SUM_NETTO_A']=number_format($result_sum[0]['SUM_NETTO'],0,",",".");
      $r['SUM_PERSEN_A'] = round((($result_sum[0]['SUM_BRUTO']-$result_sum[0]['SUM_NETTO'])/$result_sum[0]['SUM_BRUTO'])*100);
      $r['SUM_RP_A']=number_format($result_sum[0]['SUM_RP'],0,",",".");
      $r['SUM_RP_KG_A'] = number_format($result_sum[0]['SUM_RP']/$result_sum[0]['SUM_NETTO'],0,",",".");


      foreach($result_b3 as $rb3)
      {
        $r['PURCHASER_RP_KG'] = $rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR']/$rb3['RMP_FAKTUR_PURCHASER_NETTO'];
        $r['RP_A'] =number_format($rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'],0,",",".");
        $r['RP_B'] ="";
        $r['RP_C'] ="";

        $r['BRUTO_A'] =number_format($rb3['RMP_FAKTUR_PURCHASER_BRUTO'],0,",",".");
        $r['BRUTO_B'] ="";
        $r['BRUTO_C'] ="";

        $r['PERSEN_A'] =number_format($rb3['RMP_FAKTUR_POTONGAN'],0,",",".");
        $r['PERSEN_B'] ="";
        $r['PERSEN_C'] ="";

        $r['NETTO_A'] =number_format($rb3['RMP_FAKTUR_PURCHASER_NETTO'],0,",",".");
        $r['NETTO_B'] ="";
        $r['NETTO_C'] ="";

        $r['RP_KG_A']=number_format($r['PURCHASER_RP_KG'],0,",",".");
        $r['RP_KG_B']="";
        $r['RP_KG_C']="";
      }
    }
    else if($grade_kelapa =='B')
    {
      $bulan = date("m",strtotime($input['tanggal']));

      $sqlsum = "SELECT
                        SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS SUM_BRUTO,
                        SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS SUM_NETTO,
                        SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS SUM_RP
                FROM
                RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
                ON
                FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
                LEFT JOIN
                RMP_REKENING_RELASI AS RR
                ON
                FP.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
                WHERE
                F.RMP_FAKTUR_TANGGAL LIKE '%".$input['tanggal']."%'
                AND
                F.RMP_FAKTUR_JENIS_MATERIAL = '".$input['material']."-B'
                AND
                RR.RMP_REKENING_RELASI_MATERIAL = '".$input['material']."'
                AND
                RR.RMP_MASTER_WILAYAH_KODE = '".$input['wilayah']."'
                AND
                FP.RECORD_STATUS='A'
                AND
                F.RECORD_STATUS='A'
                AND
                RR.RECORD_STATUS='A'
               ";
      $this->MYSQL = new MYSQL();
      $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
      $this->MYSQL->queri = $sqlsum ;
      $result_sum = $this->MYSQL->data();

      $r['SUM_BRUTO_B']=number_format($result_sum[0]['SUM_BRUTO'],0,",",".");
      $r['SUM_PERSEN_B'] = round((($result_sum[0]['SUM_BRUTO']-$result_sum[0]['SUM_NETTO'])/$result_sum[0]['SUM_BRUTO'])*100);
      $r['SUM_NETTO_B']=number_format($result_sum[0]['SUM_NETTO'],0,",",".");
      $r['SUM_RP_B']=number_format($result_sum[0]['SUM_RP'],0,",",".");
      $r['SUM_RP_KG_B'] = number_format($result_sum[0]['SUM_RP']/$result_sum[0]['SUM_NETTO'],0,",",".");

      foreach($result_b3 as $rb3)
      {
        $r['PURCHASER_RP_KG'] = $rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR']/$rb3['RMP_FAKTUR_PURCHASER_NETTO'];
        $r['RP_B'] =number_format($rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'],0,",",".");
        $r['RP_A'] ="";
        $r['RP_C'] ="";

        $r['BRUTO_B'] =number_format($rb3['RMP_FAKTUR_PURCHASER_BRUTO'],0,",",".");
        $r['BRUTO_A'] ="";
        $r['BRUTO_C'] ="";

        $r['PERSEN_B'] =number_format($rb3['RMP_FAKTUR_POTONGAN'],0,",",".");
        $r['PERSEN_A'] ="";
        $r['PERSEN_C'] ="";

        $r['NETTO_B'] =number_format($rb3['RMP_FAKTUR_PURCHASER_NETTO'],0,",",".");
        $r['NETTO_A'] ="";
        $r['NETTO_C'] ="";

        $r['RP_KG_B']=number_format($r['PURCHASER_RP_KG'],0,",",".");
        //$r['RP_KG_B']=number_format($rb3['RMP_FAKTUR_PURCHASER_RP_KG'],0,",",".");
        $r['RP_KG_A']="";
        $r['RP_KG_C']="";
      }
    }

    else if($grade_kelapa =='C')
    {
      $bulan = date("m",strtotime($input['tanggal']));
      $sqlsum = "SELECT
                        SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS SUM_BRUTO,
                        SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS SUM_NETTO,
                        SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS SUM_RP
                FROM
                RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
                ON
                FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
                LEFT JOIN
                RMP_REKENING_RELASI AS RR
                ON
                FP.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
                WHERE
                F.RMP_FAKTUR_TANGGAL LIKE '%".$input['tanggal']."%'
                AND
                F.RMP_FAKTUR_JENIS_MATERIAL = '".$input['material']."-C'
                AND
                RR.RMP_REKENING_RELASI_MATERIAL = '".$input['material']."'
                AND
                RR.RMP_MASTER_WILAYAH_KODE = '".$input['wilayah']."'
                AND
                FP.RECORD_STATUS='A'
                AND
                F.RECORD_STATUS='A'
                AND
                RR.RECORD_STATUS='A'
               ";
      $this->MYSQL = new MYSQL();
      $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
      $this->MYSQL->queri = $sqlsum ;
      $result_sum = $this->MYSQL->data();

      $r['SUM_BRUTO_C']=number_format($result_sum[0]['SUM_BRUTO'],0,",",".");
      $r['SUM_PERSEN_C'] = round((($result_sum[0]['SUM_BRUTO']-$result_sum[0]['SUM_NETTO'])/$result_sum[0]['SUM_BRUTO'])*100);
      $r['SUM_NETTO_C']=number_format($result_sum[0]['SUM_NETTO'],0,",",".");
      $r['SUM_RP_C']=number_format($result_sum[0]['SUM_RP'],0,",",".");
      $r['SUM_RP_KG_C'] = number_format($result_sum[0]['SUM_RP']/$result_sum[0]['SUM_NETTO'],0,",",".");

      foreach($result_b3 as $rb3)
      {
        $r['PURCHASER_RP_KG'] = $rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR']/$rb3['RMP_FAKTUR_PURCHASER_NETTO'];
        $r['RP_C'] =number_format($rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'],0,",",".");
        $r['RP_A'] ="";
        $r['RP_B'] ="";

        $r['BRUTO_C'] =number_format($rb3['RMP_FAKTUR_PURCHASER_BRUTO'],0,",",".");
        $r['BRUTO_A'] ="";
        $r['BRUTO_B'] ="";

        $r['PERSEN_C'] =number_format($rb3['RMP_FAKTUR_POTONGAN'],0,",",".");
        $r['PERSEN_A'] ="";
        $r['PERSEN_B'] ="";

        $r['NETTO_C'] =number_format($rb3['RMP_FAKTUR_PURCHASER_NETTO'],0,",",".");
        $r['NETTO_A'] ="";
        $r['NETTO_B'] ="";

        $r['RP_KG_C']=number_format($r['PURCHASER_RP_KG'],0,",",".");
        $r['RP_KG_A']="";
        $r['RP_KG_B']="";
      }
    }




    if (empty($r['RMP_FAKTUR_NAMA_SUB']))
    {
      $r['RMP_MASTER_PERSONAL_NAMA']=$r['RMP_MASTER_PERSONAL_NAMA'];
    }
    else {
      $r['RMP_MASTER_PERSONAL_NAMA']=$r['RMP_MASTER_PERSONAL_NAMA'].' / '.$r['RMP_FAKTUR_NAMA_SUB'];
    }
    $result[] = $r;
    $no++;
    }

    /////////////////////////////////////////////////////////////

    $bulan = date("m",strtotime($input['tanggal']));
    $tahun = date("Y",strtotime($input['tanggal']));

    $sqlsum_bulan_a = "SELECT
                      SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS SUM_BRUTO_BULAN,
                      SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS SUM_NETTO_BULAN,
                      SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS SUM_RP_BULAN
              FROM
              RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
              ON
              FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
              LEFT JOIN
              RMP_REKENING_RELASI AS RR
              ON
              FP.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
              WHERE
              F.RMP_FAKTUR_TANGGAL >= '".$tahun."-".$bulan."-01'
              AND
              F.RMP_FAKTUR_TANGGAL <= '".$input['tanggal']."'
              AND
              F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%".$input['material']."-A%'
              AND
              RR.RMP_REKENING_RELASI_MATERIAL = '".$input['material']."'
              AND
              RR.RMP_MASTER_WILAYAH_KODE = '".$input['wilayah']."'
              AND
              FP.RECORD_STATUS='A'
              AND
              F.RECORD_STATUS='A'
              AND
              RR.RECORD_STATUS='A'
             ";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sqlsum_bulan_a ;
    $result_sum_bulan_a = $this->MYSQL->data();
    $x['SUM_BRUTO_A_BULAN']=number_format($result_sum_bulan_a[0]['SUM_BRUTO_BULAN'],0,",",".");
    $x['SUM_PERSEN_A_BULAN'] = round((($result_sum_bulan_a[0]['SUM_BRUTO_BULAN']-$result_sum_bulan_a[0]['SUM_NETTO_BULAN'])/$result_sum_bulan_a[0]['SUM_BRUTO_BULAN'])*100);
    $x['SUM_NETTO_A_BULAN']=number_format($result_sum_bulan_a[0]['SUM_NETTO_BULAN'],0,",",".");
    $x['SUM_RP_A_BULAN']=number_format($result_sum_bulan_a[0]['SUM_RP_BULAN'],0,",",".");
    $x['SUM_RP_KG_A_BULAN'] = number_format($result_sum_bulan_a[0]['SUM_RP_BULAN']/$result_sum_bulan_a[0]['SUM_NETTO_BULAN'],0,",",".");

    $sqlsum_bulan_b = "SELECT
                      SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS SUM_BRUTO_BULAN,
                      SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS SUM_NETTO_BULAN,
                      SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS SUM_RP_BULAN
              FROM
              RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
              ON
              FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
              LEFT JOIN
              RMP_REKENING_RELASI AS RR
              ON
              FP.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
              WHERE
              F.RMP_FAKTUR_TANGGAL >= '".$tahun."-".$bulan."-01'
              AND
              F.RMP_FAKTUR_TANGGAL <= '".$input['tanggal']."'
              AND
              F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%".$input['material']."-B%'
              AND
              RR.RMP_REKENING_RELASI_MATERIAL = '".$input['material']."'
              AND
              RR.RMP_MASTER_WILAYAH_KODE = '".$input['wilayah']."'
              AND
              FP.RECORD_STATUS='A'
              AND
              F.RECORD_STATUS='A'
              AND
              RR.RECORD_STATUS='A'
             ";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sqlsum_bulan_b ;
    $result_sum_bulan_b = $this->MYSQL->data();
    $x['SUM_BRUTO_B_BULAN']=number_format($result_sum_bulan_b[0]['SUM_BRUTO_BULAN'],0,",",".");
    $x['SUM_PERSEN_B_BULAN'] = round((($result_sum_bulan_b[0]['SUM_BRUTO_BULAN']-$result_sum_bulan_b[0]['SUM_NETTO_BULAN'])/$result_sum_bulan_b[0]['SUM_BRUTO_BULAN'])*100);
    $x['SUM_NETTO_B_BULAN']=number_format($result_sum_bulan_b[0]['SUM_NETTO_BULAN'],0,",",".");
    $x['SUM_RP_B_BULAN']=number_format($result_sum_bulan_b[0]['SUM_RP_BULAN'],0,",",".");
    $x['SUM_RP_KG_B_BULAN'] = number_format($result_sum_bulan_b[0]['SUM_RP_BULAN']/$result_sum_bulan_b[0]['SUM_NETTO_BULAN'],0,",",".");

    $sqlsum_bulan_c = "SELECT
                      SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS SUM_BRUTO_BULAN,
                      SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS SUM_NETTO_BULAN,
                      SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS SUM_RP_BULAN
              FROM
              RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
              ON
              FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
              LEFT JOIN
              RMP_REKENING_RELASI AS RR
              ON
              FP.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
              WHERE
              F.RMP_FAKTUR_TANGGAL >= '".$tahun."-".$bulan."-01'
              AND
              F.RMP_FAKTUR_TANGGAL <= '".$input['tanggal']."'
              AND
              F.RMP_FAKTUR_JENIS_MATERIAL LIKE '%".$input['material']."-C%'
              AND
              RR.RMP_REKENING_RELASI_MATERIAL = '".$input['material']."'
              AND
              RR.RMP_MASTER_WILAYAH_KODE = '".$input['wilayah']."'
              AND
              FP.RECORD_STATUS='A'
              AND
              F.RECORD_STATUS='A'
              AND
              RR.RECORD_STATUS='A'
             ";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sqlsum_bulan_c ;
    $result_sum_bulan_c = $this->MYSQL->data();
    $x['SUM_BRUTO_C_BULAN']=number_format($result_sum_bulan_c[0]['SUM_BRUTO_BULAN'],0,",",".");
    $x['SUM_PERSEN_C_BULAN'] = round((($result_sum_bulan_c[0]['SUM_BRUTO_BULAN']-$result_sum_bulan_c[0]['SUM_NETTO_BULAN'])/$result_sum_bulan_c[0]['SUM_BRUTO_BULAN'])*100);
    $x['SUM_NETTO_C_BULAN']=number_format($result_sum_bulan_c[0]['SUM_NETTO_BULAN'],0,",",".");
    $x['SUM_RP_C_BULAN']=number_format($result_sum_bulan_c[0]['SUM_RP_BULAN'],0,",",".");
    $x['SUM_RP_KG_C_BULAN'] = number_format($result_sum_bulan_c[0]['SUM_RP_BULAN']/$result_sum_bulan_c[0]['SUM_NETTO_BULAN'],0,",",".");

    $result_bulan[] = $x;


if (empty($result_a))
    {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Data tidak ada";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result_bulan'] = $result_bulan;
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = "OK..";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result_bulan'] = $result_bulan;
    }

?>
