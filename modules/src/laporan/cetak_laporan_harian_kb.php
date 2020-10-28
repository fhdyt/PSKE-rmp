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
$input = $params['input_option'];

$kode_wilayah = array('02','03','04','05','06','07','08','09','10');
foreach ($kode_wilayah as $kode)
{
${sql_.$kode} = "SELECT
          P.RMP_MASTER_PERSONAL_NAMA AS RMP_MASTER_PERSONAL_NAMA,
          F.RMP_FAKTUR_ALAMAT AS RMP_FAKTUR_ALAMAT,
          F.RMP_FAKTUR_JENIS_MATERIAL AS RMP_FAKTUR_JENIS_MATERIAL,
          F.RMP_FAKTUR_POTONGAN AS RMP_FAKTUR_POTONGAN,
          F.RMP_FAKTUR_NO_FAKTUR AS RMP_FAKTUR_NO_FAKTUR,
          RR.RMP_REKENING_RELASI AS RMP_REKENING_RELASI,
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
        RR.RMP_MASTER_WILAYAH_KODE = '".$kode."'
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
$this->MYSQL->queri = ${sql_.$kode};
${result_a_.$kode} = $this->MYSQL->data();

foreach(${result_a_.$kode} as $r)
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

        foreach($result_b3 as $rb3)
        {
          $r['PURCHASER_RP_KG'] = $rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR']/$rb3['RMP_FAKTUR_PURCHASER_NETTO'];
          $r['RP_A'] =$rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'];
          $r['RP_B'] ="";
          $r['RP_C'] ="";

          $r['BRUTO_A'] =$rb3['RMP_FAKTUR_PURCHASER_BRUTO'];
          $r['BRUTO_B'] ="";
          $r['BRUTO_C'] ="";

          $r['PERSEN_A'] =$rb3['RMP_FAKTUR_POTONGAN'];
          $r['PERSEN_B'] ="";
          $r['PERSEN_C'] ="";

          $r['NETTO_A'] =$rb3['RMP_FAKTUR_PURCHASER_NETTO'];
          $r['NETTO_B'] ="";
          $r['NETTO_C'] ="";

          $r['RP_KG_A']=$r['PURCHASER_RP_KG'];
          $r['RP_KG_B']="";
          $r['RP_KG_C']="";
        }
      }
      else if($grade_kelapa =='B')
      {
        foreach($result_b3 as $rb3)
        {
          $r['PURCHASER_RP_KG'] = $rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR']/$rb3['RMP_FAKTUR_PURCHASER_NETTO'];
          $r['RP_B'] =$rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'];
          $r['RP_A'] ="";
          $r['RP_C'] ="";

          $r['BRUTO_B'] =$rb3['RMP_FAKTUR_PURCHASER_BRUTO'];
          $r['BRUTO_A'] ="";
          $r['BRUTO_C'] ="";

          $r['PERSEN_B'] =$rb3['RMP_FAKTUR_POTONGAN'];
          $r['PERSEN_A'] ="";
          $r['PERSEN_C'] ="";

          $r['NETTO_B'] =$rb3['RMP_FAKTUR_PURCHASER_NETTO'];
          $r['NETTO_A'] ="";
          $r['NETTO_C'] ="";

          $r['RP_KG_B']=$r['PURCHASER_RP_KG'];
          //$r['RP_KG_B']=$rb3['RMP_FAKTUR_PURCHASER_RP_KG'];
          $r['RP_KG_A']="";
          $r['RP_KG_C']="";
        }
      }

      else if($grade_kelapa =='C')
      {
        foreach($result_b3 as $rb3)
        {
          $r['PURCHASER_RP_KG'] = $rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR']/$rb3['RMP_FAKTUR_PURCHASER_NETTO'];
          $r['RP_C'] =$rb3['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'];
          $r['RP_A'] ="";
          $r['RP_B'] ="";

          $r['BRUTO_C'] =$rb3['RMP_FAKTUR_PURCHASER_BRUTO'];
          $r['BRUTO_A'] ="";
          $r['BRUTO_B'] ="";

          $r['PERSEN_C'] =$rb3['RMP_FAKTUR_POTONGAN'];
          $r['PERSEN_A'] ="";
          $r['PERSEN_B'] ="";

          $r['NETTO_C'] =$rb3['RMP_FAKTUR_PURCHASER_NETTO'];
          $r['NETTO_A'] ="";
          $r['NETTO_B'] ="";

          $r['RP_KG_C']=$r['PURCHASER_RP_KG'];
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

    ${result_.$kode}[] = $r;
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
          RR.RMP_MASTER_WILAYAH_KODE = '".$kode."'
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
$x['SUM_BRUTO_A_BULAN']=$result_sum_bulan_a[0]['SUM_BRUTO_BULAN'];
$x['SUM_PERSEN_A_BULAN']=round((($result_sum_bulan_a[0]['SUM_BRUTO_BULAN']-$result_sum_bulan_a[0]['SUM_NETTO_BULAN'])/$result_sum_bulan_a[0]['SUM_BRUTO_BULAN'])*100);
$x['SUM_NETTO_A_BULAN']=$result_sum_bulan_a[0]['SUM_NETTO_BULAN'];
$x['SUM_RP_A_BULAN']=$result_sum_bulan_a[0]['SUM_RP_BULAN'];
$x['SUM_RP_KG_A_BULAN']=$result_sum_bulan_a[0]['SUM_RP_BULAN']/$result_sum_bulan_a[0]['SUM_NETTO_BULAN'];

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
          RR.RMP_MASTER_WILAYAH_KODE = '".$kode."'
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
$x['SUM_BRUTO_B_BULAN']=$result_sum_bulan_b[0]['SUM_BRUTO_BULAN'];
$x['SUM_PERSEN_B_BULAN']=round((($result_sum_bulan_b[0]['SUM_BRUTO_BULAN']-$result_sum_bulan_b[0]['SUM_NETTO_BULAN'])/$result_sum_bulan_b[0]['SUM_BRUTO_BULAN'])*100);
$x['SUM_NETTO_B_BULAN']=$result_sum_bulan_b[0]['SUM_NETTO_BULAN'];
$x['SUM_RP_B_BULAN']=$result_sum_bulan_b[0]['SUM_RP_BULAN'];
$x['SUM_RP_KG_B_BULAN']=$result_sum_bulan_b[0]['SUM_RP_BULAN']/$result_sum_bulan_b[0]['SUM_NETTO_BULAN'];

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
          RR.RMP_MASTER_WILAYAH_KODE = '".$kode."'
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
$x['SUM_BRUTO_C_BULAN']=$result_sum_bulan_c[0]['SUM_BRUTO_BULAN'];
$x['SUM_PERSEN_C_BULAN']=round((($result_sum_bulan_c[0]['SUM_BRUTO_BULAN']-$result_sum_bulan_c[0]['SUM_NETTO_BULAN'])/$result_sum_bulan_c[0]['SUM_BRUTO_BULAN'])*100);
$x['SUM_NETTO_C_BULAN']=$result_sum_bulan_c[0]['SUM_NETTO_BULAN'];
$x['SUM_RP_C_BULAN']=$result_sum_bulan_c[0]['SUM_RP_BULAN'];
$x['SUM_RP_KG_C_BULAN']=$result_sum_bulan_c[0]['SUM_RP_BULAN']/$result_sum_bulan_c[0]['SUM_NETTO_BULAN'];

${result_bulan_.$kode}[] = $x;
}




////////////////TOTALLLLLLLLLLL/////////////////////////////////////////////////////////////////////////
// Hari ini /////////////////////////
$sqlsum_hari = "SELECT
                  SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS TOTAL_SUM_BRUTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS TOTAL_SUM_NETTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS TOTAL_SUM_RP
          FROM
          RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
          ON
          FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
          WHERE
          F.RMP_FAKTUR_TANGGAL LIKE '%".$input['tanggal']."%'
          AND
          F.RMP_FAKTUR_JENIS_MATERIAL = '".$input['material']."-A'
          AND
          FP.RECORD_STATUS='A'
          AND
          F.RECORD_STATUS='A'
         ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sqlsum_hari ;
$result_sum_hari_a = $this->MYSQL->data();
$y['TANGGAL'] = tanggal_format(Date("Y-m-d",strtotime($input['tanggal'])));
$y['TOTAL_SUM_BRUTO_A']=$result_sum_hari_a[0]['TOTAL_SUM_BRUTO'];
$y['TOTAL_SUM_PERSEN_A']=round((($result_sum_hari_a[0]['TOTAL_SUM_BRUTO']-$result_sum_hari_a[0]['TOTAL_SUM_NETTO'])/$result_sum_hari_a[0]['TOTAL_SUM_BRUTO'])*100);
$y['TOTAL_SUM_NETTO_A']=$result_sum_hari_a[0]['TOTAL_SUM_NETTO'];
$y['TOTAL_SUM_RP_A']=$result_sum_hari_a[0]['TOTAL_SUM_RP'];

$sqlsum_hari_b = "SELECT
                  SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS TOTAL_SUM_BRUTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS TOTAL_SUM_NETTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS TOTAL_SUM_RP
          FROM
          RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
          ON
          FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
          WHERE
          F.RMP_FAKTUR_TANGGAL LIKE '%".$input['tanggal']."%'
          AND
          F.RMP_FAKTUR_JENIS_MATERIAL = '".$input['material']."-B'
          AND
          FP.RECORD_STATUS='A'
          AND
          F.RECORD_STATUS='A'
         ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sqlsum_hari_b ;
$result_sum_hari_b = $this->MYSQL->data();

$y['TOTAL_SUM_BRUTO_B']=$result_sum_hari_b[0]['TOTAL_SUM_BRUTO'];
$y['TOTAL_SUM_PERSEN_B']=round((($result_sum_hari_b[0]['TOTAL_SUM_BRUTO']-$result_sum_hari_b[0]['TOTAL_SUM_NETTO'])/$result_sum_hari_b[0]['TOTAL_SUM_BRUTO'])*100);
$y['TOTAL_SUM_NETTO_B']=$result_sum_hari_b[0]['TOTAL_SUM_NETTO'];
$y['TOTAL_SUM_RP_B']=$result_sum_hari_b[0]['TOTAL_SUM_RP'];

$sqlsum_hari_c = "SELECT
                  SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS TOTAL_SUM_BRUTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS TOTAL_SUM_NETTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS TOTAL_SUM_RP
          FROM
          RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
          ON
          FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
          WHERE
          F.RMP_FAKTUR_TANGGAL LIKE '%".$input['tanggal']."%'
          AND
          F.RMP_FAKTUR_JENIS_MATERIAL = '".$input['material']."-C'
          AND
          FP.RECORD_STATUS='A'
          AND
          F.RECORD_STATUS='A'
         ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sqlsum_hari_c ;
$result_sum_hari_c = $this->MYSQL->data();

$y['TOTAL_SUM_BRUTO_C']=$result_sum_hari_c[0]['TOTAL_SUM_BRUTO'];
$y['TOTAL_SUM_PERSEN_C']=round((($result_sum_hari_c[0]['TOTAL_SUM_BRUTO']-$result_sum_hari_c[0]['TOTAL_SUM_NETTO'])/$result_sum_hari_c[0]['TOTAL_SUM_BRUTO'])*100);
$y['TOTAL_SUM_NETTO_C']=$result_sum_hari_c[0]['TOTAL_SUM_NETTO'];
$y['TOTAL_SUM_RP_C']=$result_sum_hari_c[0]['TOTAL_SUM_RP'];


//////////////////// Bulan Ini
$bulan = date("m",strtotime($input['tanggal']));
$tahun = date("Y",strtotime($input['tanggal']));
$mulai_bulan = $tahun.'-'.$bulan.'-01';
$sqlsum_bulan_ini = "SELECT
                  SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS TOTAL_BULAN_SUM_BRUTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS TOTAL_BULAN_SUM_NETTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS TOTAL_BULAN_SUM_RP
          FROM
          RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
          ON
          FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
          WHERE
          (RMP_FAKTUR_TANGGAL BETWEEN '".$mulai_bulan."'AND '".$input['tanggal']."')
          AND
          F.RMP_FAKTUR_JENIS_MATERIAL = '".$input['material']."-A'
          AND
          FP.RECORD_STATUS='A'
          AND
          F.RECORD_STATUS='A'
         ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sqlsum_bulan_ini ;
$result_sum_bulan_a = $this->MYSQL->data();

$y['TOTAL_BULAN_SUM_BRUTO_A']=$result_sum_bulan_a[0]['TOTAL_BULAN_SUM_BRUTO'];
$y['TOTAL_BULAN_SUM_PERSEN_A']=round((($result_sum_bulan_a[0]['TOTAL_BULAN_SUM_BRUTO']-$result_sum_bulan_a[0]['TOTAL_BULAN_SUM_NETTO'])/$result_sum_bulan_a[0]['TOTAL_BULAN_SUM_BRUTO'])*100);
$y['TOTAL_BULAN_SUM_NETTO_A']=$result_sum_bulan_a[0]['TOTAL_BULAN_SUM_NETTO'];
$y['TOTAL_BULAN_SUM_RP_A']=$result_sum_bulan_a[0]['TOTAL_BULAN_SUM_RP'];

$sqlsum_bulan_ini_b = "SELECT
                  SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS TOTAL_BULAN_SUM_BRUTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS TOTAL_BULAN_SUM_NETTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS TOTAL_BULAN_SUM_RP
          FROM
          RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
          ON
          FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
          WHERE
          (RMP_FAKTUR_TANGGAL BETWEEN '".$mulai_bulan."'AND '".$input['tanggal']."')
          AND
          F.RMP_FAKTUR_JENIS_MATERIAL = '".$input['material']."-B'
          AND
          FP.RECORD_STATUS='A'
          AND
          F.RECORD_STATUS='A'
         ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sqlsum_bulan_ini_b ;
$result_sum_bulan_b = $this->MYSQL->data();

$y['TOTAL_BULAN_SUM_BRUTO_B']=$result_sum_bulan_b[0]['TOTAL_BULAN_SUM_BRUTO'];
$y['TOTAL_BULAN_SUM_PERSEN_B']=round((($result_sum_bulan_b[0]['TOTAL_BULAN_SUM_BRUTO']-$result_sum_bulan_b[0]['TOTAL_BULAN_SUM_NETTO'])/$result_sum_bulan_b[0]['TOTAL_BULAN_SUM_BRUTO'])*100);
$y['TOTAL_BULAN_SUM_NETTO_B']=$result_sum_bulan_b[0]['TOTAL_BULAN_SUM_NETTO'];
$y['TOTAL_BULAN_SUM_RP_B']=$result_sum_bulan_b[0]['TOTAL_BULAN_SUM_RP'];


$sqlsum_bulan_ini_c = "SELECT
                  SUM(FP.RMP_FAKTUR_PURCHASER_BRUTO) AS TOTAL_BULAN_SUM_BRUTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_NETTO) AS TOTAL_BULAN_SUM_NETTO,
                  SUM(FP.RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR) AS TOTAL_BULAN_SUM_RP
          FROM
          RMP_FAKTUR_PURCHASER AS FP LEFT JOIN RMP_FAKTUR AS F
          ON
          FP.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
          WHERE
          (RMP_FAKTUR_TANGGAL BETWEEN '".$mulai_bulan."'AND '".$input['tanggal']."')
          AND
          F.RMP_FAKTUR_JENIS_MATERIAL = '".$input['material']."-C'
          AND
          FP.RECORD_STATUS='A'
          AND
          F.RECORD_STATUS='A'
         ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sqlsum_bulan_ini_c ;
$result_sum_bulan_c = $this->MYSQL->data();

$y['TOTAL_BULAN_SUM_BRUTO_C']=$result_sum_bulan_c[0]['TOTAL_BULAN_SUM_BRUTO'];
$y['TOTAL_BULAN_SUM_PERSEN_C']=round((($result_sum_bulan_c[0]['TOTAL_BULAN_SUM_BRUTO']-$result_sum_bulan_c[0]['TOTAL_BULAN_SUM_NETTO'])/$result_sum_bulan_c[0]['TOTAL_BULAN_SUM_BRUTO'])*100);
$y['TOTAL_BULAN_SUM_NETTO_C']=$result_sum_bulan_c[0]['TOTAL_BULAN_SUM_NETTO'];
$y['TOTAL_BULAN_SUM_RP_C']=$result_sum_bulan_c[0]['TOTAL_BULAN_SUM_RP'];

$total[] = $y;

if (empty($result_a_02))
    {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Data tidak ada";
    $this->callback['filter'] = $params;
    $this->callback['result_02'] = $result_02;
    $this->callback['result_03'] = $result_03;
    $this->callback['result_04'] = $result_04;
    $this->callback['result_05'] = $result_05;
    $this->callback['result_06'] = $result_06;
    $this->callback['result_07'] = $result_07;
    $this->callback['result_08'] = $result_08;
    $this->callback['result_09'] = $result_09;
    $this->callback['result_10'] = $result_10;
    $this->callback['result_bulan_02'] = $result_bulan_02;
    $this->callback['result_bulan_03'] = $result_bulan_03;
    $this->callback['result_bulan_04'] = $result_bulan_04;
    $this->callback['result_bulan_05'] = $result_bulan_05;
    $this->callback['result_bulan_06'] = $result_bulan_06;
    $this->callback['result_bulan_07'] = $result_bulan_07;
    $this->callback['result_bulan_08'] = $result_bulan_08;
    $this->callback['result_bulan_09'] = $result_bulan_09;
    $this->callback['result_bulan_10'] = $result_bulan_10;
    $this->callback['total'] = $total;
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = "SUKSES";
    $this->callback['filter'] = $params;
    $this->callback['result_02'] = $result_02;
    $this->callback['result_03'] = $result_03;
    $this->callback['result_04'] = $result_04;
    $this->callback['result_05'] = $result_05;
    $this->callback['result_06'] = $result_06;
    $this->callback['result_07'] = $result_07;
    $this->callback['result_08'] = $result_08;
    $this->callback['result_09'] = $result_09;
    $this->callback['result_10'] = $result_10;
    $this->callback['result_bulan_02'] = $result_bulan_02;
    $this->callback['result_bulan_03'] = $result_bulan_03;
    $this->callback['result_bulan_04'] = $result_bulan_04;
    $this->callback['result_bulan_05'] = $result_bulan_05;
    $this->callback['result_bulan_06'] = $result_bulan_06;
    $this->callback['result_bulan_07'] = $result_bulan_07;
    $this->callback['result_bulan_08'] = $result_bulan_08;
    $this->callback['result_bulan_09'] = $result_bulan_09;
    $this->callback['result_bulan_10'] = $result_bulan_10;
    $this->callback['total'] = $total;
    }

?>
