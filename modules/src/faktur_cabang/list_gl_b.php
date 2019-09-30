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
              RMP_REKAP_FC_DETAIL
              WHERE RMP_REKAP_FC_DETAIL_JENIS = '".$input['JENIS_KB']."'
              AND RECORD_STATUS='A'
              AND RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
              ORDER BY RMP_REKAP_FC_DETAIL_INDEX ASC
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql ;
$result_x = $this->MYSQL->data();
$no = $posisi + 1;
foreach($result_x as $r)
    {
    $r['NO'] = $no;
    $result_b[] = $r;
    $no++;
    }

// TOTAL GELONDONG A
$sql2 = "SELECT
            SUM(FC.RMP_REKAP_FC_DETAIL_BRUTO) AS BRUTO,
            SUM(FC.RMP_REKAP_FC_DETAIL_POTONGAN) AS POTONGAN,
            SUM(FC.RMP_REKAP_FC_DETAIL_NETTO) AS NETTO,
            SUM(FC.RMP_REKAP_FC_DETAIL_RP_KG) AS RP_KG,
            SUM(FC.RMP_REKAP_FC_DETAIL_RUPIAH) AS RUPIAH
        FROM
              RMP_REKAP_FC_DETAIL AS FC
              LEFT JOIN RMP_MASTER_PERSONAL AS P
              ON FC.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
              WHERE FC.RMP_REKAP_FC_DETAIL_JENIS = '".$input['JENIS_KB']."'
              AND FC.RECORD_STATUS='A' AND P.RECORD_STATUS='A'
              AND FC.RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql2 ;
$result_b_total = $this->MYSQL->data();
$no = $posisi + 1;
foreach($result_b_total as $t)
    {
    $result_total_b[] = $t;
    }
// END TOTAL GELONDAONG A
/////////////////////////////////////////////////////// END GELODONG A/////////////////////

if (empty($result_b))
    {
      $this->callback['respon']['pesan'] = "gagal";
      $this->callback['respon']['text_msg'] = print_r($result_total_b, true);
      $this->callback['filter'] = $params;
      $this->callback['result_b'] = $result_b;
      $this->callback['result_total_b'] = $result_total_b;
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = print_r($result_total_b, true);
    $this->callback['filter'] = $params;
    $this->callback['result_b'] = $result_b;
    $this->callback['result_total_b'] = $result_total_b;
    }

?>
