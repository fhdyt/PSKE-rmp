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
    $sqly = "SELECT * FROM RMP_KONFIGURASI_HARGA_FC
                        WHERE
                          (RMP_KONFIGURASI_HARGA_FC_TANGGAL_BERLAKU<='".$tanggal."'
                        AND
                          RMP_KONFIGURASI_HARGA_FC_TANGGAL_BERAKHIR>='".$tanggal."')
                        OR
                          (RMP_KONFIGURASI_HARGA_FC_TANGGAL_BERLAKU<='".$tanggal."'
                        AND
                          RMP_KONFIGURASI_HARGA_FC_TANGGAL_BERAKHIR='0000-00-00')
                        AND
                            RECORD_STATUS='A'
                  ";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sqly ;
    $result_acd = $this->MYSQL->data();


    $r['BRUTO_C_SUPPLIER'] = round($qty_pske_c / $total_timbang_c_cabang2 * $r['RMP_REKAP_FC_DETAIL_BRUTO']) ;
    $r['NETTO_C_SUPPLIER'] = $r['BRUTO_C_SUPPLIER']-$r['RMP_REKAP_FC_DETAIL_POTONGAN'] ;
    $r['RP_KG_C'] = $result_acd[0]['RMP_KONFIGURASI_HARGA_FC_C'];
    $r['RUPIAH_C'] = number_format($r['RP_KG_C']*$r['NETTO_C_SUPPLIER']);
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
    $this->callback['total_rupiah']= number_format($total_rupiah);
    $this->callback['total_bruto']= $total_bruto;
    $this->callback['total_potongan']= $total_potongan;
    $this->callback['total_netto']= $total_netto;
    }

?>
