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
$result_sum_hari = $this->MYSQL->data();

$no = $posisi + 1;

foreach($result_sum_hari as $r)
    {
    $r['TANGGAL'] = tanggal_format(Date("Y-m-d",strtotime($input['tanggal'])));
    $r['TOTAL_SUM_BRUTO_A']=number_format($result_sum_hari[0]['TOTAL_SUM_BRUTO'],0,",",".");
    $r['TOTAL_SUM_PERSEN_A'] = round((($result_sum_hari[0]['TOTAL_SUM_BRUTO']-$result_sum_hari[0]['TOTAL_SUM_NETTO'])/$result_sum_hari[0]['TOTAL_SUM_BRUTO'])*100);
    $r['TOTAL_SUM_NETTO_A']=number_format($result_sum_hari[0]['TOTAL_SUM_NETTO'],0,",",".");
    $r['TOTAL_SUM_RP_A']=number_format($result_sum_hari[0]['TOTAL_SUM_RP'],0,",",".");
    $r['TOTAL_SUM_RP_KG_A']=number_format($result_sum_hari[0]['TOTAL_SUM_RP']/$result_sum_hari[0]['TOTAL_SUM_NETTO'],0,",",".");
    $result[] = $r;
    $no++;
    }

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

foreach($result_sum_hari_b as $r)
    {
    $r['TOTAL_SUM_BRUTO_B']=number_format($result_sum_hari_b[0]['TOTAL_SUM_BRUTO'],0,",",".");
    $r['TOTAL_SUM_PERSEN_B'] = round((($result_sum_hari_b[0]['TOTAL_SUM_BRUTO']-$result_sum_hari_b[0]['TOTAL_SUM_NETTO'])/$result_sum_hari_b[0]['TOTAL_SUM_BRUTO'])*100);
    $r['TOTAL_SUM_NETTO_B']=number_format($result_sum_hari_b[0]['TOTAL_SUM_NETTO'],0,",",".");
    $r['TOTAL_SUM_RP_B']=number_format($result_sum_hari_b[0]['TOTAL_SUM_RP'],0,",",".");
    $r['TOTAL_SUM_RP_KG_B']=number_format($result_sum_hari_b[0]['TOTAL_SUM_RP']/$result_sum_hari_b[0]['TOTAL_SUM_NETTO'],0,",",".");
    $result_b[] = $r;
    }

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

foreach($result_sum_hari_c as $r)
    {
    $r['TOTAL_SUM_BRUTO_C']=number_format($result_sum_hari_c[0]['TOTAL_SUM_BRUTO'],0,",",".");
    $r['TOTAL_SUM_PERSEN_C'] = round((($result_sum_hari_c[0]['TOTAL_SUM_BRUTO']-$result_sum_hari_c[0]['TOTAL_SUM_NETTO'])/$result_sum_hari_c[0]['TOTAL_SUM_BRUTO'])*100);
    $r['TOTAL_SUM_NETTO_C']=number_format($result_sum_hari_c[0]['TOTAL_SUM_NETTO'],0,",",".");
    $r['TOTAL_SUM_RP_C']=number_format($result_sum_hari_c[0]['TOTAL_SUM_RP'],0,",",".");
    $r['TOTAL_SUM_RP_KG_C']=number_format($result_sum_hari_c[0]['TOTAL_SUM_RP']/$result_sum_hari_c[0]['TOTAL_SUM_NETTO'],0,",",".");

    $result_c[] = $r;
    }


//////////////////// Bulan Ini
$bulan = date("m",strtotime($input['tanggal']));
$tahun = date("Y",strtotime($input['tanggal']));
$mulai_bulan = $tahun.'-'.$bulan.'-01';
$sqlsum_bulan = "SELECT
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
$this->MYSQL->queri = $sqlsum_bulan ;
$result_sum_bulan = $this->MYSQL->data();

$no = $posisi + 1;

foreach($result_sum_bulan as $r)
    {
    $r['TANGGAL'] = tanggal_format(Date("Y-m-d",strtotime($input['tanggal'])));
    $r['TOTAL_BULAN_SUM_BRUTO_A']=number_format($result_sum_bulan[0]['TOTAL_BULAN_SUM_BRUTO'],0,",",".");
    $r['TOTAL_BULAN_SUM_PERSEN_A'] = round((($result_sum_bulan[0]['TOTAL_BULAN_SUM_BRUTO']-$result_sum_bulan[0]['TOTAL_BULAN_SUM_NETTO'])/$result_sum_bulan[0]['TOTAL_BULAN_SUM_BRUTO'])*100);
    $r['TOTAL_BULAN_SUM_NETTO_A']=number_format($result_sum_bulan[0]['TOTAL_BULAN_SUM_NETTO'],0,",",".");
    $r['TOTAL_BULAN_SUM_RP_A']=number_format($result_sum_bulan[0]['TOTAL_BULAN_SUM_RP'],0,",",".");
    $r['TOTAL_BULAN_SUM_RP_KG_A']=number_format($result_sum_bulan[0]['TOTAL_BULAN_SUM_RP']/$result_sum_bulan[0]['TOTAL_BULAN_SUM_NETTO'],0,",",".");
    $result_bulan[] = $r;
    $no++;
    }

$sqlsum_bulan_b = "SELECT
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
$this->MYSQL->queri = $sqlsum_bulan_b ;
$result_sum_bulan_b = $this->MYSQL->data();

$no = $posisi + 1;

foreach($result_sum_bulan_b as $r)
    {
    $r['TANGGAL'] = tanggal_format(Date("Y-m-d",strtotime($input['tanggal'])));
    $r['TOTAL_BULAN_SUM_BRUTO_B']=number_format($result_sum_bulan_b[0]['TOTAL_BULAN_SUM_BRUTO'],0,",",".");
    $r['TOTAL_BULAN_SUM_PERSEN_B'] = round((($result_sum_bulan_b[0]['TOTAL_BULAN_SUM_BRUTO']-$result_sum_bulan_b[0]['TOTAL_BULAN_SUM_NETTO'])/$result_sum_bulan_b[0]['TOTAL_BULAN_SUM_BRUTO'])*100);
    $r['TOTAL_BULAN_SUM_NETTO_B']=number_format($result_sum_bulan_b[0]['TOTAL_BULAN_SUM_NETTO'],0,",",".");
    $r['TOTAL_BULAN_SUM_RP_B']=number_format($result_sum_bulan_b[0]['TOTAL_BULAN_SUM_RP'],0,",",".");
    $r['TOTAL_BULAN_SUM_RP_KG_B']=number_format($result_sum_bulan_b[0]['TOTAL_BULAN_SUM_RP']/$result_sum_bulan_b[0]['TOTAL_BULAN_SUM_NETTO'],0,",",".");
    $result_bulan_b[] = $r;
    $no++;
    }

$sqlsum_bulan_c = "SELECT
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
$this->MYSQL->queri = $sqlsum_bulan_c ;
$result_sum_bulan_c = $this->MYSQL->data();

$no = $posisi + 1;

foreach($result_sum_bulan_c as $r)
    {
    $r['TANGGAL'] = tanggal_format(Date("Y-m-d",strtotime($input['tanggal'])));
    $r['TOTAL_BULAN_SUM_BRUTO_C']=number_format($result_sum_bulan_c[0]['TOTAL_BULAN_SUM_BRUTO'],0,",",".");
    $r['TOTAL_BULAN_SUM_PERSEN_C'] = round((($result_sum_bulan_c[0]['TOTAL_BULAN_SUM_BRUTO']-$result_sum_bulan_c[0]['TOTAL_BULAN_SUM_NETTO'])/$result_sum_bulan_c[0]['TOTAL_BULAN_SUM_BRUTO'])*100);
    $r['TOTAL_BULAN_SUM_NETTO_C']=number_format($result_sum_bulan_c[0]['TOTAL_BULAN_SUM_NETTO'],0,",",".");
    $r['TOTAL_BULAN_SUM_RP_C']=number_format($result_sum_bulan_c[0]['TOTAL_BULAN_SUM_RP'],0,",",".");
    $r['TOTAL_BULAN_SUM_RP_KG_C']=number_format($result_sum_bulan_c[0]['TOTAL_BULAN_SUM_RP']/$result_sum_bulan_c[0]['TOTAL_BULAN_SUM_NETTO'],0,",",".");
    $result_bulan_c[] = $r;
    $no++;
    }



if (empty($result_sum_hari))
    {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Data tidak ada";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result_b'] = $result_b;
    $this->callback['result_c'] = $result_c;
    $this->callback['result_bulan'] = $result_bulan;
    $this->callback['result_bulan_b'] = $result_bulan_b;
    $this->callback['result_bulan_c'] = $result_bulan_c;
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = "OK..".$mulai_bulan;
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result_b'] = $result_b;
    $this->callback['result_c'] = $result_c;
    $this->callback['result_bulan'] = $result_bulan;
    $this->callback['result_bulan_b'] = $result_bulan_b;
    $this->callback['result_bulan_c'] = $result_bulan_c;
    $this->callback['result_option']['jml_halaman'] = $this->pagging(array(
        'sql' => $sql,
        'batas' => $batas
    ))->jmlhalaman;
    }

?>
