<?php
$RMP_CONFIG=new RMP_CONFIG();
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

// AMBIL NILAI QTY KG TERIMA PSKE
$sql = "SELECT * FROM RMP_REKAP_FC WHERE RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."' AND RECORD_STATUS='A'";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql;
$result_a = $this->MYSQL->data();
$qty_pske_a = $result_a[0]['RMP_REKAP_FC_QTY_PSKE_A'];
$qty_pske_b = $result_a[0]['RMP_REKAP_FC_QTY_PSKE_B'];
$qty_pske_c = $result_a[0]['RMP_REKAP_FC_QTY_PSKE_C'];
$jeniskb = $result_a[0]['RMP_REKAP_FC_JENIS_KB'];
$total_qty_terima_pske = $qty_pske_a + $qty_pske_b + $qty_pske_c;
$id_supplier = $result_a[0]['RMP_MASTER_PERSONAL_ID'];
$material = $result_a[0]['RMP_REKAP_FC_JENIS_KB'];
//AMBIL SUM TIMBANG DARI CABANG C
$sqlc = "SELECT
            SUM(RMP_REKAP_FC_DETAIL_BRUTO) AS BRUTO,
            SUM(RMP_REKAP_FC_DETAIL_POTONGAN) AS POTONGAN,
            SUM(RMP_REKAP_FC_DETAIL_NETTO) AS NETTO,
            SUM(RMP_REKAP_FC_DETAIL_RP_KG) AS RP_KG,
            SUM(RMP_REKAP_FC_DETAIL_RUPIAH) AS RUPIAH
        FROM
              RMP_REKAP_FC_DETAIL
              WHERE RMP_REKAP_FC_DETAIL_JENIS = '".$jeniskb."-C'
              AND RECORD_STATUS='A'
              AND RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sqlc ;
$total_timbang_c_cabang = $this->MYSQL->data();
$total_timbang_c_cabang2 = $total_timbang_c_cabang[0]['BRUTO'];

//Ambiil data supplier KB GL case
$sql2 = "SELECT *
        FROM
              RMP_REKAP_FC_DETAIL
              WHERE RMP_REKAP_FC_DETAIL_JENIS = '".$jeniskb."-C'
              AND RECORD_STATUS='A'
              AND RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
              ORDER BY RMP_REKAP_FC_DETAIL_INDEX ASC
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql2 ;
$data_c = $this->MYSQL->data();
$no = $posisi + 1;
foreach($data_c as $r)
    {
    $r['NO'] = $no;
    $tanggal = date("Y-m-d");
    $sqly = "SELECT *
              FROM RMP_MASTER_PERSONAL AS P
              LEFT JOIN RMP_REKENING_RELASI AS R
    					ON P.RMP_MASTER_PERSONAL_ID=R.RMP_MASTER_PERSONAL_ID
    					LEFT JOIN RMP_PENYESUAIAN_HARGA_KB AS PH ON P.RMP_MASTER_PERSONAL_ID=PH.RMP_MASTER_PERSONAL_ID
    					WHERE
              R.RMP_REKENING_RELASI_MATERIAL='".$input['material']."'
							AND (PH.RMP_PENYESUAIAN_HARGA_KB_TANGGAL_BERLAKU<='".$tanggal."'
              AND PH.RMP_PENYESUAIAN_HARGA_KB_TANGGAL_BERAKHIR>='".$tanggal."')
							OR (PH.RMP_PENYESUAIAN_HARGA_KB_TANGGAL_BERLAKU<='".$tanggal."'
              AND PH.RMP_PENYESUAIAN_HARGA_KB_TANGGAL_BERAKHIR='0000-00-00')
							AND PH.RMP_PENYESUAIAN_HARGA_KB_JENIS_MATERIAL='".$material."'
							AND R.RMP_REKENING_RELASI_MATERIAL='".$material."'
							AND P.RECORD_STATUS='A'
							AND PH.RECORD_STATUS='A'
							AND R.RECORD_STATUS='A'
							AND P.RMP_MASTER_PERSONAL_ID LIKE '%".$id_supplier."%'
    ";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sqly ;
    $result_acd = $this->MYSQL->data();


    //$r['BRUTO_C_SUPPLIER'] = $RMP_CONFIG->pembulatan($qty_pske_c / $total_timbang_c_cabang2 * $r['RMP_REKAP_FC_DETAIL_BRUTO'])->callback['nomor'];
    $r['BRUTO_C_SUPPLIER'] = round($qty_pske_c / $total_timbang_c_cabang2 * $r['RMP_REKAP_FC_DETAIL_BRUTO']);
    $r['NETTO_C_SUPPLIER'] = $r['BRUTO_C_SUPPLIER']-$r['RMP_REKAP_FC_DETAIL_POTONGAN'] ;
    $r['RP_KG_C'] = $result_acd[0]['RMP_PENYESUAIAN_HARGA_KB_C'];
    $r['RUPIAH_C'] = number_format($r['RP_KG_C']*$r['NETTO_C_SUPPLIER'],0,",",".");
    $total_bruto += $r['BRUTO_C_SUPPLIER'];
    $total_potongan += $r['RMP_REKAP_FC_DETAIL_POTONGAN'];
    $total_netto += $r['NETTO_C_SUPPLIER'];
    $total_rupiah += $r['RP_KG_C']*$r['NETTO_C_SUPPLIER'];
    $result_c[] = $r;
    $no++;
    }


if (empty($result_a))
    {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Data tidak ada";
    }
  else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = print_r($result_c, true);
    $this->callback['result_c']= $result_c;
    $this->callback['total_rupiah']= number_format($total_rupiah,0,",",".");
    $this->callback['total_bruto']= $total_bruto;
    $this->callback['total_potongan']= $total_potongan;
    $this->callback['total_netto']= $total_netto;
    }

?>
