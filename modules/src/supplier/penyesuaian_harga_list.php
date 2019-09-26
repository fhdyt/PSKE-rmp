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

$sql = "SELECT * FROM
              RMP_PENYESUAIAN_HARGA AS Q,
              RMP_MASTER_MATERIAL AS M
          WHERE
              Q.RMP_MASTER_MATERIAL_ID=M.RMP_MASTER_MATERIAL_ID
          AND
              Q.RMP_MASTER_PERSONAL_ID='".$input['ID_SUPPLIER']."'
          AND
              Q.RECORD_STATUS='A'
          AND
              M.RECORD_STATUS='A'";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql ;
$result_a = $this->MYSQL->data();

// -- >>

$no = $posisi + 1;

foreach($result_a as $r)
    {
    $r['NO'] = $no;
    // if ($r['RMP_QUALITED_HARGA_QUALITED'] =="")
    // {
    //   $r['RMP_QUALITED_HARGA_QUALITED'] = $r['RMP_QUALITED_HARGA_QUALITED'];
    // }
    // else
    // {
    //   $r['RMP_QUALITED_HARGA_QUALITED'] = $r['RMP_QUALITED_HARGA_QUALITED']." %";
    // }
    //
    // if ($r['RMP_QUALITED_HARGA_HARGA'] =="")
    // {
    //   $r['RMP_QUALITED_HARGA_HARGA'] = $r['RMP_QUALITED_HARGA_HARGA'];
    // }
    // else
    // {
    //   $r['RMP_QUALITED_HARGA_HARGA'] = $r['RMP_QUALITED_HARGA_HARGA']." /Kg";
    // }

    $r['RMP_PENYESUAIAN_HARGA_JADI'] = $r['RMP_PENYESUAIAN_HARGA_JADI'];
    $r['RMP_PENYESUAIAN_HARGA_PATOKAN'] = $r['RMP_PENYESUAIAN_HARGA_PATOKAN'];
    $r['RMP_PENYESUAIAN_HARGA_SETENGAH_JADI'] = $r['RMP_PENYESUAIAN_HARGA_SETENGAH_JADI'];
    $r['RMP_PENYESUAIAN_HARGA_TRANSAKSI'] = $r['RMP_PENYESUAIAN_HARGA_TRANSAKSI'];
    $r['RMP_PENYESUAIAN_HARGA_KUALITET'] = $r['RMP_PENYESUAIAN_HARGA_KUALITET'];
    $r['TANGGAL_BERLAKU']=tanggal_format(Date("Y-m-d",strtotime($r['RMP_PENYESUAIAN_HARGA_TANGGAL_BERLAKU'])));
    // $r['TANGGAL_BERAKHIR']=tanggal_format(Date("Y-m-d",strtotime($r['RMP_PENYESUAIAN_HARGA_TANGGAL_BERAKHIR'])));
    if ($r['RMP_PENYESUAIAN_HARGA_TANGGAL_BERAKHIR'] == '0000-00-00')
    {
      $r['TANGGAL_BERAKHIR'] = "";
    }
    else
    {
    $r['TANGGAL_BERAKHIR']=tanggal_format(Date("Y-m-d",strtotime($r['RMP_PENYESUAIAN_HARGA_TANGGAL_BERAKHIR'])));
    }
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
