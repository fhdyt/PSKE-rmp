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

if (empty($input['JENIS_KELAPA']) or $input['JENIS_KELAPA'] == "")
    {
    $filter_a = "";
    }
  else
    {
    $filter_a = "AND N.jenis_kelapa='".$input['JENIS_KELAPA']."'";
    }

$tanggalnota = date("mY");
$sql = "SELECT * FROM
pkb.nota_".$tanggalnota." AS N
LEFT JOIN
RMP_FAKTUR_DETAIL AS F ON N.id=F.id_nota WHERE N.notr='".$input['NO_NOTA']."' ".$filter_a."";
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

    }

?>