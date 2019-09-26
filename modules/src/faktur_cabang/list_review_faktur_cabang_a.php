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
$result_nb = $this->MYSQL->data();
$qty_pske_a = $result_nb[0]['RMP_REKAP_FC_QTY_PSKE_A'];
$qty_pske_b = $result_nb[0]['RMP_REKAP_FC_QTY_PSKE_B'];
$qty_pske_c = $result_nb[0]['RMP_REKAP_FC_QTY_PSKE_C'];
$jeniskb = $result_nb[0]['RMP_REKAP_FC_JENIS_KB'];
$tambang = $result_nb[0]['RMP_REKAP_FC_TAMBANG']/$qty_pske_a;
$biaya = $result_nb[0]['RMP_REKAP_FC_BIAYA']/$result_nb[0]['RMP_REKAP_FC_QTY_PSKE_A'];
$total_qty_terima_pske = $qty_pske_a + $qty_pske_b + $qty_pske_c;


//AMBIL TOTAL RUPIAH B///////////////////////////////////////////////////////////////////////////////
$sqlc = "SELECT
            SUM(FC.RMP_REKAP_FC_DETAIL_BRUTO) AS BRUTO,
            SUM(FC.RMP_REKAP_FC_DETAIL_POTONGAN) AS POTONGAN,
            SUM(FC.RMP_REKAP_FC_DETAIL_NETTO) AS NETTO,
            SUM(FC.RMP_REKAP_FC_DETAIL_RP_KG) AS RP_KG,
            SUM(FC.RMP_REKAP_FC_DETAIL_RUPIAH) AS RUPIAH
        FROM
              RMP_REKAP_FC_DETAIL AS FC
              LEFT JOIN RMP_MASTER_PERSONAL AS P
              ON FC.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
              WHERE FC.RMP_REKAP_FC_DETAIL_JENIS = '".$jeniskb."-B'
              AND FC.RECORD_STATUS='A' AND P.RECORD_STATUS='A'
              AND FC.RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sqlc ;
$total_timbang_b_cabang = $this->MYSQL->data();
$total_timbang_b_cabang2 = $total_timbang_b_cabang[0]['BRUTO'];

//Ambiil data supplier KB GL
$sql2 = "SELECT *
        FROM
              RMP_REKAP_FC_DETAIL AS FC
              LEFT JOIN RMP_MASTER_PERSONAL AS P
              ON FC.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
              WHERE FC.RMP_REKAP_FC_DETAIL_JENIS = '".$jeniskb."-B'
              AND P.RECORD_STATUS='A'
              AND FC.RECORD_STATUS='A'
              AND FC.RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
              ORDER BY FC.RMP_REKAP_FC_DETAIL_INDEX ASC
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql2 ;
$data_b = $this->MYSQL->data();

foreach($data_b as $r)
    {
    $tanggal=date("Y-m-d");
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
                            RECORD_STATUS='A'";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sqly ;
    $result_acd = $this->MYSQL->data();


    $r['BRUTO_B_SUPPLIER'] = round($qty_pske_b / $total_timbang_b_cabang2 * $r['RMP_REKAP_FC_DETAIL_BRUTO']) ;
    $r['NETTO_B_SUPPLIER'] = $r['BRUTO_B_SUPPLIER']-$r['RMP_REKAP_FC_DETAIL_POTONGAN'] ;
    $r['RP_KG_B'] = $result_acd[0]['RMP_KONFIGURASI_HARGA_FC_B'];
    $r['RUPIAH_B'] = $r['RP_KG_B']*$r['NETTO_B_SUPPLIER'];
    $total_bruto_b += $r['BRUTO_B_SUPPLIER'];
    $total_potongan_b += $r['RMP_REKAP_FC_DETAIL_POTONGAN'];
    $total_netto_b += $r['NETTO_B_SUPPLIER'];
    $total_rupiah_b += $r['RUPIAH_B'];
    $result_b[] = $r;
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////

//AMBIL TOTAL RUPIAH C////////////////////////////////////////////////////////////////////////////////
$sqlcb = "SELECT
            SUM(FC.RMP_REKAP_FC_DETAIL_BRUTO) AS BRUTO,
            SUM(FC.RMP_REKAP_FC_DETAIL_POTONGAN) AS POTONGAN,
            SUM(FC.RMP_REKAP_FC_DETAIL_NETTO) AS NETTO,
            SUM(FC.RMP_REKAP_FC_DETAIL_RP_KG) AS RP_KG,
            SUM(FC.RMP_REKAP_FC_DETAIL_RUPIAH) AS RUPIAH
        FROM
            RMP_REKAP_FC_DETAIL AS FC
            LEFT JOIN RMP_MASTER_PERSONAL AS P
            ON FC.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
            WHERE FC.RMP_REKAP_FC_DETAIL_JENIS = '".$jeniskb."-C'
            AND FC.RECORD_STATUS='A' AND P.RECORD_STATUS='A'
            AND FC.RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sqlcb ;
$total_timbang_c_cabang = $this->MYSQL->data();
$total_timbang_c_cabang2 = $total_timbang_c_cabang[0]['BRUTO'];

//Ambiil data supplier KB GL case
$sql2v = "SELECT *
            FROM
              RMP_REKAP_FC_DETAIL AS FC
              LEFT JOIN RMP_MASTER_PERSONAL AS P
              ON FC.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
              WHERE FC.RMP_REKAP_FC_DETAIL_JENIS = '".$jeniskb."-C'
              AND P.RECORD_STATUS='A'
              AND FC.RECORD_STATUS='A'
              AND FC.RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
              ORDER BY FC.RMP_REKAP_FC_DETAIL_INDEX ASC ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql2v ;
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
    $r['RUPIAH_C'] = $r['RP_KG_C']*$r['NETTO_C_SUPPLIER'];
    $total_bruto_c += $r['BRUTO_C_SUPPLIER'];
    $total_potongan_c += $r['RMP_REKAP_FC_DETAIL_POTONGAN'];
    $total_netto_c += $r['NETTO_C_SUPPLIER'];
    $total_rupiah_c += $r['RUPIAH_C'];
    $result_c[] = $r;
    $no++;
    }

///////////////////////////////////////////////////////////////////////////////////////////////////

//AMBIL SELURUH DATA KG TIMBANG Cabang
$sqlaX = "SELECT SUM(RMP_REKAP_FC_DETAIL_RUPIAH) AS RUPIAH
            FROM RMP_REKAP_FC_DETAIL
            WHERE RECORD_STATUS='A'
            AND RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sqlaX ;
$total_timbang_cabang = $this->MYSQL->data();
$total_timbang_cabanggg = $total_timbang_cabang[0]['RUPIAH'];
////////////////////////////////////////////////////////////////////////////////////

$total_rupiah_a = $total_timbang_cabang[0]['RUPIAH']-($total_rupiah_b+$total_rupiah_c);

//AMBIL SUM TIMBANG DARI CABANG A
$sqla = "SELECT
            SUM(FC.RMP_REKAP_FC_DETAIL_BRUTO) AS BRUTO,
            SUM(FC.RMP_REKAP_FC_DETAIL_POTONGAN) AS POTONGAN,
            SUM(FC.RMP_REKAP_FC_DETAIL_NETTO) AS NETTO,
            SUM(FC.RMP_REKAP_FC_DETAIL_RP_KG) AS RP_KG,
            SUM(FC.RMP_REKAP_FC_DETAIL_RUPIAH) AS RUPIAH
        FROM
              RMP_REKAP_FC_DETAIL AS FC
              LEFT JOIN RMP_MASTER_PERSONAL AS P
              ON FC.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
              WHERE FC.RMP_REKAP_FC_DETAIL_JENIS = '".$jeniskb."-A'
              AND FC.RECORD_STATUS='A' AND P.RECORD_STATUS='A'
              AND FC.RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sqla ;
$total_timbang_a_cabang = $this->MYSQL->data();
$total_timbang_a_cabang2 = $total_timbang_a_cabang[0]['BRUTO'];

//Ambiil data supplier KB GL A
$sql232 = "SELECT *
        FROM
              RMP_REKAP_FC_DETAIL AS FC
              LEFT JOIN RMP_MASTER_PERSONAL AS P
              ON FC.RMP_MASTER_PERSONAL_ID=P.RMP_MASTER_PERSONAL_ID
              WHERE FC.RMP_REKAP_FC_DETAIL_JENIS = '".$jeniskb."-A'
              AND P.RECORD_STATUS='A'
              AND FC.RECORD_STATUS='A'
              AND FC.RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
              ORDER BY FC.RMP_REKAP_FC_DETAIL_INDEX ASC
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql232 ;
$data_a = $this->MYSQL->data();
$no = $posisi + 1;
foreach($data_a as $r)
    {
    $r['NO'] = $no;
    $r['BRUTO_A_SUPPLIER'] = round($qty_pske_a / $total_timbang_a_cabang2 * $r['RMP_REKAP_FC_DETAIL_BRUTO']) ;
    $r['NETTO_A_SUPPLIER'] = $r['BRUTO_A_SUPPLIER']-$r['RMP_REKAP_FC_DETAIL_POTONGAN'] ;
    $r['TAMBANG'] = number_format($tambang*$r['NETTO_A_SUPPLIER']);
    $r['TAMBANGA'] = $tambang*$r['NETTO_A_SUPPLIER'];
    $r['BIAYA'] = number_format($biaya*$r['BRUTO_A_SUPPLIER']);
    $r['BIAYAA'] =$biaya*$r['BRUTO_A_SUPPLIER'];
    $r['RUPIAH_A'] = number_format(($total_rupiah_a/$qty_pske_a)*$r['NETTO_A_SUPPLIER']);
    $r['RUPIAH_AA'] = ($total_rupiah_a/$qty_pske_a)*$r['NETTO_A_SUPPLIER'];
    $r['TOTAL_RUPIAH_A'] = number_format(($tambang*$r['NETTO_A_SUPPLIER'])+($biaya*$r['BRUTO_A_SUPPLIER'])+(($total_rupiah_a/$qty_pske_a)*$r['NETTO_A_SUPPLIER']));
    $r['TOTAL_RUPIAH_AA'] = ($tambang*$r['NETTO_A_SUPPLIER'])+($biaya*$r['BRUTO_A_SUPPLIER'])+(($total_rupiah_a/$qty_pske_a)*$r['NETTO_A_SUPPLIER']);
    $r['RP_KG_A'] = round($r['TOTAL_RUPIAH_AA']/$r['NETTO_A_SUPPLIER']);

    $total_bruto_a += $r['BRUTO_A_SUPPLIER'];
    $total_potongan_a += $r['RMP_REKAP_FC_DETAIL_POTONGAN'];
    $total_netto_a += $r['NETTO_A_SUPPLIER'];
    $total_rupiah_a_gl += $r['RUPIAH_AA'];
    $total_biaya_a += $r['BIAYAA'];
    $total_tambang_a += $r['TAMBANGA'];
    $total_seluruh_a += $r['TOTAL_RUPIAH_AA'];

    $result_a[] = $r;
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
    $this->callback['respon']['text_msg'] = print_r($total_timbang_cabang[0]['RUPIAH'], true);
    $this->callback['result_a']= $result_a;
    $this->callback['total_rupiah_a']= number_format($total_rupiah_a);
    $this->callback['total_bruto_a']= $total_bruto_a;
    $this->callback['total_potongan_a']= $total_potongan_a;
    $this->callback['total_netto_a']= $total_netto_a;
    $this->callback['total_tambang_a']= number_format($total_tambang_a);
    $this->callback['total_biaya_a']= number_format($total_biaya_a);
    $this->callback['total_seluruh_a']= number_format($total_seluruh_a);


    $this->callback['note_kg_a']= $total_netto_a;
    $this->callback['note_rp_kg_a']= number_format($total_rupiah_a/$total_netto_a);
    $this->callback['note_rupiah_a']= number_format($total_rupiah_a);

    $this->callback['note_kg_b']= $total_netto_b;
    $this->callback['note_rp_kg_b']= number_format($total_rupiah_b/$total_netto_b);
    $this->callback['note_rupiah_b']= number_format($total_rupiah_b);

    $this->callback['note_kg_c']= $total_netto_c;
    $this->callback['note_rp_kg_c']= number_format($total_rupiah_c/$total_netto_c);
    $this->callback['note_rupiah_c']= number_format($total_rupiah_c);
    }

?>
