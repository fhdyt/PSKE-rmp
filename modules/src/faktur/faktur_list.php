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

if(!empty($input['D2']))
{
  $d2="";
}
else {
  $d2="AND NOT RECORD_STATUS='A'";
}

if(empty($input['NO_FAKTUR']))
{
  $no_faktur="";
}
else {
  $no_faktur="AND RMP_FAKTUR_NO_FAKTUR='".$input['NO_FAKTUR']."'";
}

if(empty($input['NO_NOTA']))
{
  $no_nota="";
}
else if ($input['NO_NOTA'] == "undefined")
{
  $no_nota="";
}
else {
  $no_nota="AND RMP_FAKTUR_DETAIL_NO_NOTA='".$input['NO_NOTA']."'";
}

$sql = "SELECT * FROM RMP_FAKTUR_DETAIL
        WHERE
        NOT RECORD_STATUS='D' ".$no_nota." ".$no_faktur." ".$d2."";

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
