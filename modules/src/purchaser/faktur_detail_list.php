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

// if (empty($input['keyword']) or $input['keyword'] == "")
//     {
//     $filter_a = "";
//     }
//   else
//     {
//     $filter_a = "AND (RMP_MASTER_MATERIAL like '%" . $input['keyword'] . "%')";
//     }

$sql = "SELECT * FROM RMP_FAKTUR AS F
            LEFT JOIN RMP_FAKTUR_DETAIL AS FD
            ON F.RMP_FAKTUR_NO_FAKTUR=FD.RMP_FAKTUR_NO_FAKTUR
            WHERE F.RECORD_STATUS='A' AND FD.RECORD_STATUS='A'
            AND F.RMP_FAKTUR_ID='".$input['ID_FAKTUR']."'
                        ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql;
$result_a = $this->MYSQL->data();

$sql44 = "SELECT * FROM RMP_FAKTUR AS F
            LEFT JOIN RMP_MASTER_PERSONAL AS P
            ON F.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
            LEFT JOIN RMP_FAKTUR_DETAIL AS FD
            ON F.RMP_FAKTUR_NO_FAKTUR=FD.RMP_FAKTUR_NO_FAKTUR
            WHERE F.RECORD_STATUS='A' AND P.RECORD_STATUS='A' AND FD.RECORD_STATUS='A'
            AND F.RMP_FAKTUR_ID='".$input['ID_FAKTUR']."'
            GROUP BY F.RMP_FAKTUR_NO_FAKTUR ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql44;
$result_ab = $this->MYSQL->data();

$no = $posisi + 1;

$potongan = $result_a[0]['RMP_FAKTUR_POTONGAN'];
foreach($result_a as $r)
    {
    $r['NO'] = $no;
    $r['TANGGAL']=tanggal_format(Date("Y-m-d",strtotime($r['RMP_FAKTUR_TANGGAL'])));
    $total_gross += $r['RMP_FAKTUR_DETAIL_BRUTO'];
    $total_tara += $r['RMP_FAKTUR_DETAIL_TARA'];
    $total_bruto += $r['RMP_FAKTUR_DETAIL_NETTO'];
    $result[] = $r;
    $no++;
    }

    foreach($result_ab as $rr)
        {
        $rr['TANGGAL']=tanggal_format(Date("Y-m-d",strtotime($r['RMP_FAKTUR_TANGGAL'])));
        $rr['NAMA_MATERIAL']=substr($r['RMP_FAKTUR_DETAIL_JENIS_MATERIAL'],0,-2);
        $rr['GRADE_MATERIAL']=substr($r['RMP_FAKTUR_DETAIL_JENIS_MATERIAL'],-1);
        $resultb[] = $rr;
        }

if (empty($result_a))
    {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Data tidak adaaaaaa";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['resultb'] = $resultb;
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = "OK..";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['total_gross'] = $total_gross;
    $this->callback['total_tara'] = $total_tara;
    $this->callback['total_bruto'] = $total_bruto;
    $this->callback['potongan'] = $potongan;
    $this->callback['resultb'] = $resultb;
    }

?>
