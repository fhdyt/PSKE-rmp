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

$sql = "SELECT
            P.RMP_MASTER_PERSONAL_NAMA AS RMP_MASTER_PERSONAL_NAMA,
            RR.RMP_MASTER_WILAYAH_KODE AS RMP_MASTER_WILAYAH_KODE,
            F.RMP_FAKTUR_ALAMAT AS RMP_FAKTUR_ALAMAT,
            F.RMP_FAKTUR_POTONGAN AS RMP_FAKTUR_POTONGAN,
            F.RMP_FAKTUR_GONI AS RMP_FAKTUR_GONI,
            F.RMP_FAKTUR_KUALITET AS RMP_FAKTUR_KUALITET,
            F.RMP_FAKTUR_NAMA_SUB AS RMP_FAKTUR_NAMA_SUB,
            RR.RMP_REKENING_RELASI AS RMP_REKENING_RELASI,
            F.RMP_FAKTUR_NO_FAKTUR AS RMP_FAKTUR_NO_FAKTUR
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
          F.RMP_FAKTUR_TANGGAL = '".$input['tanggal']."'
          AND F.RMP_FAKTUR_JENIS_MATERIAL='KOPRA'
          AND F.RECORD_STATUS ='A'
          AND
          P.RECORD_STATUS='A'
          AND
          RR.RECORD_STATUS='A'
          AND F.RMP_FAKTUR_NO_FAKTUR NOT IN (SELECT RMP_FAKTUR_NO_FAKTUR FROM RMP_FAKTUR_PURCHASER WHERE NOT RECORD_STATUS='E')
          GROUP BY F.RMP_FAKTUR_NO_FAKTUR
        ";

$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql;
$result_a = $this->MYSQL->data();

// -- >>

$no = $posisi + 1;

foreach($result_a as $r)
    {
    $r['NO'] = $no;
    $r['TOTAL_BRUTO'] += $r['RMP_FAKTUR_PURCHASER_BRUTO'];
    $r['RMP_MASTER_WILAYAH_KODE']=$r['RMP_MASTER_WILAYAH_KODE'];
    $r['MASTER_WILAYAH']=$r['RMP_FAKTUR_ALAMAT'];
    $potongan = $r['RMP_FAKTUR_POTONGAN'];

    $sqlfaktur = "SELECT SUM(FD.RMP_FAKTUR_DETAIL_NETTO) AS KG_BASAH FROM
             RMP_FAKTUR_DETAIL AS FD LEFT JOIN RMP_FAKTUR AS F
             ON FD.RMP_FAKTUR_NO_FAKTUR=F.RMP_FAKTUR_NO_FAKTUR
             WHERE
             FD.RMP_FAKTUR_NO_FAKTUR='".$r['RMP_FAKTUR_NO_FAKTUR']."'
             AND
             FD.RECORD_STATUS='A'
             AND
             F.RECORD_STATUS='A'
             ";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sqlfaktur ;
    $result_faktur= $this->MYSQL->data();
    $r['KG_BASAH'] = $result_faktur[0]['KG_BASAH'];
    $r['GONI'] = $r['RMP_FAKTUR_GONI'];

      if ($r['RMP_FAKTUR_KUALITET'] <= 75)
    	{
    		$r['KUALITET'] = $r['RMP_FAKTUR_KUALITET'] - 2;

    	}
      else{
        $r['KUALITET'] = $r['RMP_FAKTUR_KUALITET'];
      }

      $r['KG_KERING']=round(($r['KG_BASAH']*$r['RMP_FAKTUR_KUALITET'])/100);
      $r['RP_KERING']=round(($r['RMP_FAKTUR_PURCHASER_RP_KELAPA']/$r['KG_KERING']));
      $r['TOTAL'] = $r['RMP_FAKTUR_PURCHASER_TOTAL_FAKTUR'];
      $r['RMP_FAKTUR_PURCHASER_RP_KG'] = $r['RMP_FAKTUR_PURCHASER_RP_KG'];
      $r['PURCHASER_STATUS'] = $r['PURCHASER_STATUS'];

    if (empty($r['RMP_FAKTUR_NAMA_SUB']))
    {
      $r['RMP_MASTER_PERSONAL_NAMA']=$r['RMP_MASTER_PERSONAL_NAMA'];
    }
    else {
      $r['RMP_MASTER_PERSONAL_NAMA']=$r['RMP_MASTER_PERSONAL_NAMA'].' / '.$r['RMP_FAKTUR_NAMA_SUB'];
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
    $this->callback['respon']['text_msg'] = $sqlsum_bulan;
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    }

?>
