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
/////////////////////////////////////////////////////// GELODONG C/////////////////////
$sql = "SELECT *
        FROM
              RMP_REKAP_FC_DETAIL
              WHERE RMP_REKAP_FC_DETAIL_JENIS = '".$input['JENIS_KB']."'
              AND RECORD_STATUS='A'
              AND RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
              ORDER BY RMP_REKAP_FC_DETAIL_INDEX ASC
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql ;
$result_xxx = $this->MYSQL->data();
$no = $posisi + 1;
foreach($result_xxx as $r)
    {
    $r['NO'] = $no;
    $result_c[] = $r;
    $no++;
    }

// TOTAL GELONDONG C
$sql2 = "SELECT
            SUM(RMP_REKAP_FC_DETAIL_BRUTO) AS BRUTO,
            SUM(RMP_REKAP_FC_DETAIL_POTONGAN) AS POTONGAN,
            SUM(RMP_REKAP_FC_DETAIL_NETTO) AS NETTO,
            SUM(RMP_REKAP_FC_DETAIL_RP_KG) AS RP_KG,
            SUM(RMP_REKAP_FC_DETAIL_RUPIAH) AS RUPIAH
        FROM
              RMP_REKAP_FC_DETAIL
              WHERE RMP_REKAP_FC_DETAIL_JENIS = '".$input['JENIS_KB']."'
              AND RECORD_STATUS='A'
              AND RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql2 ;
$result_c_total = $this->MYSQL->data();
$no = $posisi + 1;
foreach($result_c_total as $t)
    {
    $result_total_c[] = $t;
    }
// END TOTAL GELONDAONG C
/////////////////////////////////////////////////////// END GELODONG C/////////////////////

if (empty($result_c))
    {
      $this->callback['respon']['pesan'] = "gagal";
      $this->callback['respon']['text_msg'] = print_r($result_total_c, true);
      $this->callback['filter'] = $params;
      $this->callback['result_c'] = $result_c;
      $this->callback['result_total_c'] = $result_total_c;
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = print_r($result_total_c, true);
    $this->callback['filter'] = $params;
    $this->callback['result_c'] = $result_c;
    $this->callback['result_total_c'] = $result_total_c;
    }

?>
