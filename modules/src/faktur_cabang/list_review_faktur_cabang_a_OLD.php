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
$result_nb = $this->MYSQL->data();
$qty_pske_a = $result_nb[0]['RMP_REKAP_FC_QTY_PSKE_A'];
$qty_pske_b = $result_nb[0]['RMP_REKAP_FC_QTY_PSKE_B'];
$qty_pske_c = $result_nb[0]['RMP_REKAP_FC_QTY_PSKE_C'];
$jeniskb = $result_nb[0]['RMP_REKAP_FC_JENIS_KB'];
$tambang = round($result_nb[0]['RMP_REKAP_FC_TAMBANG']/$qty_pske_a);
$biaya = round($result_nb[0]['RMP_REKAP_FC_BIAYA']/$result_nb[0]['RMP_REKAP_FC_QTY_PSKE_A']);
$total_qty_terima_pske = $qty_pske_a + $qty_pske_b + $qty_pske_c;
$id_supplier = $result_nb[0]['RMP_MASTER_PERSONAL_ID'];
$material = $result_nb[0]['RMP_REKAP_FC_JENIS_KB'];
$persen_potongan_a = $result_nb[0]['RMP_REKAP_FC_POTONGAN_A'];
$persen_potongan_b = $result_nb[0]['RMP_REKAP_FC_POTONGAN_B'];

//AMBIL TOTAL RUPIAH B///////////////////////////////////////////////////////////////////////////////
$sqlc = "SELECT
            SUM(RMP_REKAP_FC_DETAIL_BRUTO) AS BRUTO,
            SUM(RMP_REKAP_FC_DETAIL_POTONGAN) AS POTONGAN,
            SUM(RMP_REKAP_FC_DETAIL_NETTO) AS NETTO,
            SUM(RMP_REKAP_FC_DETAIL_RP_KG) AS RP_KG,
            SUM(RMP_REKAP_FC_DETAIL_RUPIAH) AS RUPIAH
        FROM
              RMP_REKAP_FC_DETAIL
              WHERE RMP_REKAP_FC_DETAIL_JENIS = '".$jeniskb."-B'
              AND RECORD_STATUS='A'
              AND RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sqlc ;
$total_timbang_b_cabang = $this->MYSQL->data();
$total_timbang_b_cabang2 = $total_timbang_b_cabang[0]['BRUTO'];

//Ambiil data supplier KB GL
$sql2 = "SELECT *
        FROM
              RMP_REKAP_FC_DETAIL
              WHERE RMP_REKAP_FC_DETAIL_JENIS = '".$jeniskb."-B'
              AND RECORD_STATUS='A'
              AND RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
              ORDER BY RMP_REKAP_FC_DETAIL_INDEX ASC
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql2 ;
$data_b = $this->MYSQL->data();

foreach($data_b as $r)
    {
    $tanggal=date("Y-m-d");
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


    $r['BRUTO_B_SUPPLIER'] = round($qty_pske_b / $total_timbang_b_cabang2 * $r['RMP_REKAP_FC_DETAIL_BRUTO']);
    $r['POTONGAN_B'] = round($r['BRUTO_B_SUPPLIER'] * ($persen_potongan_b/100));
    $r['NETTO_B_SUPPLIER'] = $r['BRUTO_B_SUPPLIER']-$r['POTONGAN_B'] ;
    $r['RP_KG_B'] = $result_acd[0]['RMP_PENYESUAIAN_HARGA_KB_B'];
    $r['RUPIAH_B'] = $r['RP_KG_B']*$r['NETTO_B_SUPPLIER'];
    $total_bruto_b += $r['BRUTO_B_SUPPLIER'];
    $total_potongan += $r['POTONGAN_B'];
    $total_netto_b += $r['NETTO_B_SUPPLIER'];
    $total_rupiah_b += $r['RUPIAH_B'];
    $result_b[] = $r;
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////

//AMBIL TOTAL RUPIAH C////////////////////////////////////////////////////////////////////////////////
$sqlcb = "SELECT
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
$this->MYSQL->queri = $sqlcb ;
$total_timbang_c_cabang = $this->MYSQL->data();
$total_timbang_c_cabang2 = $total_timbang_c_cabang[0]['BRUTO'];

//Ambiil data supplier KB GL case
$sql2v = "SELECT *
            FROM
              RMP_REKAP_FC_DETAIL
              WHERE RMP_REKAP_FC_DETAIL_JENIS = '".$jeniskb."-C'
              AND RECORD_STATUS='A'
              AND RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
              ORDER BY RMP_REKAP_FC_DETAIL_INDEX ASC ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql2v ;
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

    $r['BRUTO_C_SUPPLIER'] = round($qty_pske_c / $total_timbang_c_cabang2 * $r['RMP_REKAP_FC_DETAIL_BRUTO']);
    $r['NETTO_C_SUPPLIER'] = $r['BRUTO_C_SUPPLIER']-$r['RMP_REKAP_FC_DETAIL_POTONGAN'] ;
    $r['RP_KG_C'] = $result_acd[0]['RMP_PENYESUAIAN_HARGA_KB_C'];
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
            SUM(RMP_REKAP_FC_DETAIL_BRUTO) AS BRUTO,
            SUM(RMP_REKAP_FC_DETAIL_POTONGAN) AS POTONGAN,
            SUM(RMP_REKAP_FC_DETAIL_NETTO) AS NETTO,
            SUM(RMP_REKAP_FC_DETAIL_RP_KG) AS RP_KG,
            SUM(RMP_REKAP_FC_DETAIL_RUPIAH) AS RUPIAH
        FROM
              RMP_REKAP_FC_DETAIL
              WHERE RMP_REKAP_FC_DETAIL_JENIS = '".$jeniskb."-A'
              AND RECORD_STATUS='A'
              AND RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sqla ;
$total_timbang_a_cabang = $this->MYSQL->data();
$total_timbang_a_cabang2 = $total_timbang_a_cabang[0]['BRUTO'];

//Ambiil data supplier KB GL A
$sql232 = "SELECT *
        FROM
              RMP_REKAP_FC_DETAIL
              WHERE RMP_REKAP_FC_DETAIL_JENIS = '".$jeniskb."-A'
              AND RECORD_STATUS='A'
              AND RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
              ORDER BY RMP_REKAP_FC_DETAIL_INDEX ASC
          ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql232 ;
$data_a = $this->MYSQL->data();
$no = $posisi + 1;
foreach($data_a as $r)
    {
    $r['NO'] = $no;
    $r['BRUTO_A_SUPPLIER'] = round($qty_pske_a / $total_timbang_a_cabang2 * $r['RMP_REKAP_FC_DETAIL_BRUTO']);
    $r['POTONGAN_A'] = round($r['BRUTO_A_SUPPLIER'] * ($persen_potongan_a/100));
    $r['NETTO_A_SUPPLIER'] = $r['BRUTO_A_SUPPLIER']-$r['POTONGAN_A'] ;
    $r['TAMBANG'] = $tambang*$r['NETTO_A_SUPPLIER'];
    $r['TAMBANGA'] = $tambang*$r['NETTO_A_SUPPLIER'];
    $r['BIAYA'] = $biaya*$r['BRUTO_A_SUPPLIER'];
    $r['BIAYAA'] =$biaya*$r['BRUTO_A_SUPPLIER'];
    $r['RUPIAH_A'] = round(($total_rupiah_a/$qty_pske_a)*$r['NETTO_A_SUPPLIER']);
    //$r['RUPIAH_AA'] = ($total_rupiah_a/$qty_pske_a)*$r['NETTO_A_SUPPLIER'];
    $r['TOTAL_RUPIAH_A'] = round(($tambang*$r['NETTO_A_SUPPLIER'])+($biaya*$r['BRUTO_A_SUPPLIER'])+(($total_rupiah_a/$qty_pske_a)*$r['NETTO_A_SUPPLIER']));
    $r['TOTAL_RUPIAH_AA'] = ($tambang*$r['NETTO_A_SUPPLIER'])+($biaya*$r['BRUTO_A_SUPPLIER'])+(($total_rupiah_a/$qty_pske_a)*$r['NETTO_A_SUPPLIER']);
    $r['RP_KG_A'] = round($r['TOTAL_RUPIAH_A']/$r['NETTO_A_SUPPLIER']);

    $total_bruto_a += $r['BRUTO_A_SUPPLIER'];
    $total_potongan_a += $r['POTONGAN_A'];
    $total_netto_a += $r['NETTO_A_SUPPLIER'];
    $total_rupiah_a_gl += $r['RUPIAH_AA'];
    $total_biaya_a += $r['BIAYAA'];
    $total_tambang_a += $r['TAMBANGA'];
    $total_seluruh_a += $r['TOTAL_RUPIAH_AA'];

    $result_a[] = $r;
    $no++;
    }

    $editproses = "SELECT *
            FROM
                  RMP_REKAP_FC_PROSES
                  WHERE RMP_REKAP_FC_PROSES_JENIS = '".$jeniskb."-A'
                  AND RECORD_STATUS='A'
                  AND RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'
              ";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $editproses ;
    $edit_proses = $this->MYSQL->data();
    if (empty($edit_proses))
        {

        }
    else
        {
          $data_detail3 = array(
    				'RECORD_STATUS' => "E",
            'EDIT_WAKTU' => date("Y-m-d H:i:s"),
        		'EDIT_OPERATOR' => $user_login['PERSONAL_NIK']
    			);
    			$this->MYSQL = new MYSQL;
    			$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    			$this->MYSQL->tabel = "RMP_REKAP_FC_PROSES";
    			$this->MYSQL->record = $data_detail3;
    			$this->MYSQL->dimana = "WHERE RMP_REKAP_FC_PROSES_JENIS = '".$jeniskb."-A' AND RECORD_STATUS='A' AND RMP_REKAP_FC_ID='".$input['ID_FAKTUR']."'";
    			$this->MYSQL->ubah();
        }

    foreach($result_a as $key => $value)
    {
      $data_detail2 = array(
        'RMP_REKAP_FC_ID' => $input['ID_FAKTUR'],
        'RMP_REKAP_FC_PROSES_ID' => waktu_decimal(Date("Y-m-d H:i:s")),
    		'RMP_REKAP_FC_PROSES_NAMA' => $result_a[$key]['RMP_REKAP_FC_DETAIL_NAMA'],
    		'RMP_REKAP_FC_PROSES_JENIS' => $result_a[$key]['RMP_REKAP_FC_DETAIL_JENIS'],
    		'RMP_REKAP_FC_PROSES_TANGGAL' => $result_a[$key]['RMP_REKAP_FC_DETAIL_TANGGAL'],
    		'RMP_REKAP_FC_PROSES_BRUTO' => $result_a[$key]['BRUTO_A_SUPPLIER'],
    		'RMP_REKAP_FC_PROSES_POTONGAN' => $result_a[$key]['POTONGAN_A'],
    		'RMP_REKAP_FC_PROSES_NETTO' => $result_a[$key]['NETTO_A_SUPPLIER'],
    		'RMP_REKAP_FC_PROSES_RP_KG' => $result_a[$key]['RP_KG_A'],
    		'RMP_REKAP_FC_PROSES_RUPIAH_KB' => $result_a[$key]['RUPIAH_A'],
    		'RMP_REKAP_FC_PROSES_TAMBANG' => $result_a[$key]['TAMBANG'],
    		'RMP_REKAP_FC_PROSES_BIAYA' => $result_a[$key]['BIAYA'],
    		'RMP_REKAP_FC_PROSES_RUPIAH_TOTAL' => $result_a[$key]['TOTAL_RUPIAH_A'],
    		'ENTRI_WAKTU' => date("Y-m-d H:i:s"),
    		'ENTRI_OPERATOR' => $user_login['PERSONAL_NIK'],
    		'RECORD_STATUS' => "A"
    	);
    	$this->MYSQL = new MYSQL;
    	$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    	$this->MYSQL->tabel = "RMP_REKAP_FC_PROSES";
    	$this->MYSQL->record = $data_detail2;
    	$this->MYSQL->simpan();
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
    $this->callback['total_rupiah_a']= number_format($total_rupiah_a,0,",",".");
    $this->callback['total_bruto_a']= $total_bruto_a;
    $this->callback['total_potongan_a']= $total_potongan_a;
    $this->callback['total_netto_a']= $total_netto_a;
    $this->callback['total_tambang_a']= number_format($total_tambang_a,0,",",".");
    $this->callback['total_biaya_a']= number_format($total_biaya_a,0,",",".");
    $this->callback['total_seluruh_a']= number_format($total_seluruh_a,0,",",".");

    $this->callback['note_kg_a']= $total_netto_a;
    $this->callback['note_rp_kg_a']= number_format($total_rupiah_a/$total_netto_a,0,",",".");
    $this->callback['note_rupiah_a']= number_format($total_rupiah_a,0,",",".");

    $this->callback['note_kg_b']= $total_netto_b;
    $this->callback['note_rp_kg_b']= number_format($total_rupiah_b/$total_netto_b,0,",",".");
    $this->callback['note_rupiah_b']= number_format($total_rupiah_b,0,",",".");

    $this->callback['note_kg_c']= $total_netto_c;
    $this->callback['note_rp_kg_c']= number_format($total_rupiah_c/$total_netto_c,0,",",".");
    $this->callback['note_rupiah_c']= number_format($total_rupiah_c,0,",",".");
    }

?>
