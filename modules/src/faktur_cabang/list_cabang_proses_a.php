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
/////////////////////////////////////////////////////// GELODONG A/////////////////////
$sql = "SELECT *
        FROM
              RMP_REKAP_FC_PROSES
              WHERE RMP_REKAP_FC_PROSES_JENIS = '".$input['JENIS_KB']."'
              AND RECORD_STATUS='A'
              AND RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
              ORDER BY RMP_REKAP_FC_PROSES_INDEX ASC
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql ;
$result_x = $this->MYSQL->data();
$no = $posisi + 1;
foreach($result_x as $r)
    {
    $r['NO'] = $no;
    $result_a[] = $r;
    $no++;
    }

// TOTAL GELONDONG A
$sql2 = "SELECT
            SUM(RMP_REKAP_FC_PROSES_BRUTO) AS BRUTO,
            SUM(RMP_REKAP_FC_PROSES_POTONGAN) AS POTONGAN,
            SUM(RMP_REKAP_FC_PROSES_NETTO) AS NETTO,
            SUM(RMP_REKAP_FC_PROSES_RUPIAH_KB) AS RUPIAH_KB,
            SUM(RMP_REKAP_FC_PROSES_TAMBANG) AS TAMBANG,
            SUM(RMP_REKAP_FC_PROSES_BIAYA) AS BIAYA,
            SUM(RMP_REKAP_FC_PROSES_RUPIAH_TOTAL) AS TOTAL_RUPIAH
        FROM
              RMP_REKAP_FC_PROSES
              WHERE RMP_REKAP_FC_PROSES_JENIS = '".$input['JENIS_KB']."'
              AND RECORD_STATUS='A'
              AND RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql2 ;
$result_a_total = $this->MYSQL->data();
$no = $posisi + 1;
foreach($result_a_total as $t)
    {
    $result_total_a[] = $t;
    }
// END TOTAL GELONDAONG A
/////////////////////////////////////////////////////// END GELODONG A/////////////////////

if (empty($result_a))
    {
      $this->callback['respon']['pesan'] = "gagal";
      $this->callback['respon']['text_msg'] = print_r($result_total_a, true);
      $this->callback['filter'] = $params;
      $this->callback['result_a'] = $result_a;
      $this->callback['result_total_a'] = $result_total_a;
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = print_r($result_total_a, true);
    $this->callback['filter'] = $params;
    $this->callback['result_a'] = $result_a;
    $this->callback['result_total_a'] = $result_total_a;
    }

?>
