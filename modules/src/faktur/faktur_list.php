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

$sql = "SELECT * FROM RMP_FAKTUR_DETAIL
        WHERE
    RMP_FAKTUR_DETAIL_NO_NOTA='".$input['NO_NOTA']."' AND NOT RECORD_STATUS='D'";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql ;
$result_a = $this->MYSQL->data();

// -- >>

$no = $posisi + 1;

foreach($result_a as $r)
    {
    $r['NO'] = $no;
    $r['ENTRI']=tanggal_format(Date("Y-m-d",strtotime($r['ENTRI_WAKTU'])));
    $total_kg += $r['RMP_FAKTUR_DETAIL_NETTO'] ;
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
    $this->callback['respon']['text_msg'] = "OK..".$total_kg;
    $this->callback['respon']['total_kg'] = $total_kg;
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;

    }

?>
