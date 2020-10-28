<?php

//==============================================================
//==============================================================
//==============================================================
include("../../main.config.php");

$tanggalsekarang=date('d F Y');
$mpdf=new mPDF('c','A4-L','','',10,10,30,40,5,5);

//==============================================================

$mpdf->pagenumPrefix = '';
$mpdf->pagenumSuffix = '';
$mpdf->nbpgPrefix = ' dari ';
$mpdf->nbpgSuffix = '';
$header = array(
	'L' => array(
	),
	'C' => array(
	),
	'R' => array(
		'content' => '{PAGENO}{nbpg}',
		'font-family' => 'sans',
		'font-style' => '',
		'font-size' => '9',	/* gives default */
	),
	'line' => 1,
);

// $ttd='asset/platform/files/ttd/'.$nik.'.png';
$material =base64_decode($d3);
$tanggal = $d4;

$input_option=array(
	'material'=>$d3,
	'tanggal'=>$tanggal
);


$params=array(
	//'case'=>"presensi_lembur_spl_pdf_nonlogin",
	'case'=>"nonlogin_cetak_laporan_harian_kb",
	'batas'=>1000,
	'halaman'=>1,
	'data_http'=>$_COOKIE['data_http'],
	'input_option'=>$input_option,
);
$respon=$RMP->rmp_modules($params)->load->module;
$no = 1;

$kode_wilayah = array('02','03','04','05','06','07','08','09','10');
foreach ($kode_wilayah as $kode)
{
foreach($respon['result_'.$kode] as $r){
	${sum_bruto_a_.$kode} += $r['BRUTO_A'];
	${sum_netto_a_.$kode} += $r['NETTO_A'];
	${sum_persen_a_.$kode} = round(((${sum_bruto_a_.$kode}-${sum_netto_a_.$kode})/${sum_bruto_a_.$kode})*100);
	${sum_rp_kg_a_.$kode} += $r['RP_KG_A'];
	${sum_rp_a_.$kode} += $r['RP_A'];
	${sum_rp_kg_a_.$kode} = ${sum_rp_a_.$kode}/${sum_netto_a_.$kode};

	${sum_bruto_b_.$kode} += $r['BRUTO_B'];
	${sum_netto_b_.$kode} += $r['NETTO_B'];
	${sum_persen_b_.$kode} = round(((${sum_bruto_b_.$kode}-${sum_netto_b_.$kode})/${sum_bruto_b_.$kode})*100);
	${sum_rp_kg_b_.$kode} += $r['RP_KG_B'];
	${sum_rp_b_.$kode} += $r['RP_B'];
	${sum_rp_kg_b_.$kode} = ${sum_rp_b_.$kode}/${sum_netto_b_.$kode};

	${sum_bruto_a_bulan_.$kode} = $r['SUM_BRUTO_A_BULAN'];

	${laporan_.$kode} .='
	<tr>
	<td>'.$no++.'</td>
	<td>'.$r['RMP_MASTER_PERSONAL_NAMA'].'</td>
	<td>'.$r['MASTER_WILAYAH'].'</td>
	<td>'.$r['RMP_REKENING_RELASI'].'</td>
	<td>'.$r['RMP_FAKTUR_NO_FAKTUR'].'</td>
	<td align="right">'.number_format($r['BRUTO_A'],0,",",".").'</td>
	<td align="right">'.number_format($r['PERSEN_A'],0,",",".").'</td>
	<td align="right">'.number_format($r['NETTO_A'],0,",",".").'</td>
	<td align="right">'.number_format($r['RP_KG_A'],0,",",".").'</td>
	<td align="right">'.number_format($r['RP_A'],0,",",".").'</td>
	<td align="right">'.number_format($r['BRUTO_B'],0,",",".").'</td>
	<td align="right">'.number_format($r['PERSEN_B'],0,",",".").'</td>
	<td align="right">'.number_format($r['NETTO_B'],0,",",".").'</td>
	<td align="right">'.number_format($r['RP_KG_B'],0,",",".").'</td>
	<td align="right">'.number_format($r['RP_B'],0,",",".").'</td>
	</tr>
	';
}
}



$headerHTML = '<table table-unbordered>
	<tr>
		<td>
			<table>
				<tr>
					<td>
						<img src="/asset/images/logo_label.png" height="52">
					</td>
					<td>
						<b>PT PULAU SAMBU (KUALA ENOK)</b><br>
						LAPORAN HARIAN KELAPA BULAT<br>
						KELAPA JAMBUL
					</td>
				</tr>
			</table>
		</td>
		<td style="padding-left: 500px;">
		<table>
			<tr>
				<td>
					Tanggal
				</td>
				<td>
					:
				</td>
				<td>
					'.$respon['total'][0]['TANGGAL'].'
				</td>
			</tr>
			<tr>
				<td>
					Halaman
				</td>
				<td>
					:
				</td>
				<td>
				 {PAGENO}{nbpg}
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>';

$html = '
	<html>
	<head>

		<title>Cetak Laporan Harian</title>
	</head>
<style>

	body {
    font-family:"Arial Black", Gadget, sans-serif;
}
	table {
    border-collapse: collapse;

}
	.table td {
border-collapse: collapse;
border-spacing: 0;
width: 100%;
border: 1px solid #ddd;
padding: 5px 5px;
}


	.table2 {
font-size: 10px;


}

tr {


}
</style>
	<body>

	<table class="table table2">
	<thead>
		<tr>
			<td rowspan="2">No.</td>
			<td rowspan="2">Nama</td>
			<td rowspan="2">Alamat</td>
			<td rowspan="2">Rekening</td>
			<td rowspan="2">Nomor Faktur</td>
			<td colspan="5"><center>KB-A</center></td>
      <td colspan="5"><center>KB-B</center></td>
		</tr>
		<tr>
      <td><center>Kg BRUTO</center></td>
      <td><center>%</center></td>
      <td><center>Kg NETTO</center></td>
      <td id="td_rp_a">@Rp</td>
      <td><center>Rp</center></td>

      <td><center>Kg BRUTO</center></td>
      <td><center>%</center></td>
      <td><center>Kg NETTO</center></td>
      <td id="td_rp_b">@Rp</td>
      <td><center>Rp</center></td>

    </tr>
		</thead>
		'.$laporan_02.'
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center># (02)</center></td>
			<td align="right">'.number_format($sum_bruto_a_02,0,",",".").'</td>
			<td align="right">'.$sum_persen_a_02.'</td>
			<td align="right">'.number_format($sum_netto_a_02,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_a_02,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_a_02,0,",",".").'</td>
			<td align="right">'.number_format($sum_bruto_b_02,0,",",".").'</td>
			<td align="right">'.$sum_persen_b_02.'</td>
			<td align="right">'.number_format($sum_netto_b_02,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_b_02,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_b_02,0,",",".").'</td>
		</tr>
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center>AKUM</center></td>
			<td align="right">'.number_format($respon['result_bulan_02'][0]['SUM_BRUTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_02'][0]['SUM_PERSEN_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_02'][0]['SUM_NETTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_02'][0]['SUM_RP_KG_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_02'][0]['SUM_RP_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_02'][0]['SUM_BRUTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_02'][0]['SUM_PERSEN_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_02'][0]['SUM_NETTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_02'][0]['SUM_RP_KG_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_02'][0]['SUM_RP_B_BULAN'],0,",",".").'</td>
		</tr>
		'.$laporan_03.'
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center># (03)</center></td>
			<td align="right">'.number_format($sum_bruto_a_03,0,",",".").'</td>
			<td align="right">'.$sum_persen_a_03.'</td>
			<td align="right">'.number_format($sum_netto_a_03,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_a_03,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_a_03,0,",",".").'</td>
			<td align="right">'.number_format($sum_bruto_b_03,0,",",".").'</td>
			<td align="right">'.$sum_persen_b_03.'</td>
			<td align="right">'.number_format($sum_netto_b_03,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_b_03,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_b_03,0,",",".").'</td>
		</tr>
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center>AKUM</center></td>
			<td align="right">'.number_format($respon['result_bulan_03'][0]['SUM_BRUTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_03'][0]['SUM_PERSEN_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_03'][0]['SUM_NETTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_03'][0]['SUM_RP_KG_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_03'][0]['SUM_RP_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_03'][0]['SUM_BRUTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_03'][0]['SUM_PERSEN_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_03'][0]['SUM_NETTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_03'][0]['SUM_RP_KG_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_03'][0]['SUM_RP_B_BULAN'],0,",",".").'</td>
		</tr>
		'.$laporan_04.'
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center># (04)</center></td>
			<td align="right">'.number_format($sum_bruto_a_04,0,",",".").'</td>
			<td align="right">'.$sum_persen_a_04.'</td>
			<td align="right">'.number_format($sum_netto_a_04,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_a_04,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_a_04,0,",",".").'</td>
			<td align="right">'.number_format($sum_bruto_b_04,0,",",".").'</td>
			<td align="right">'.$sum_persen_b_04.'</td>
			<td align="right">'.number_format($sum_netto_b_04,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_b_04,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_b_04,0,",",".").'</td>
		</tr>
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center>AKUM</center></td>
			<td align="right">'.number_format($respon['result_bulan_04'][0]['SUM_BRUTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_04'][0]['SUM_PERSEN_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_04'][0]['SUM_NETTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_04'][0]['SUM_RP_KG_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_04'][0]['SUM_RP_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_04'][0]['SUM_BRUTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_04'][0]['SUM_PERSEN_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_04'][0]['SUM_NETTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_04'][0]['SUM_RP_KG_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_04'][0]['SUM_RP_B_BULAN'],0,",",".").'</td>
		</tr>
		'.$laporan_05.'
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center># (05)</center></td>
			<td align="right">'.number_format($sum_bruto_a_05,0,",",".").'</td>
			<td align="right">'.$sum_persen_a_05.'</td>
			<td align="right">'.number_format($sum_netto_a_05,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_a_05,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_a_05,0,",",".").'</td>
			<td align="right">'.number_format($sum_bruto_b_05,0,",",".").'</td>
			<td align="right">'.$sum_persen_b_05.'</td>
			<td align="right">'.number_format($sum_netto_b_05,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_b_05,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_b_05,0,",",".").'</td>
		</tr>
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center>AKUM</center></td>
			<td align="right">'.number_format($respon['result_bulan_05'][0]['SUM_BRUTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_05'][0]['SUM_PERSEN_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_05'][0]['SUM_NETTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_05'][0]['SUM_RP_KG_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_05'][0]['SUM_RP_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_05'][0]['SUM_BRUTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_05'][0]['SUM_PERSEN_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_05'][0]['SUM_NETTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_05'][0]['SUM_RP_KG_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_05'][0]['SUM_RP_B_BULAN'],0,",",".").'</td>
		</tr>
		'.$laporan_06.'
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center># (06)</center></td>
			<td align="right">'.number_format($sum_bruto_a_06,0,",",".").'</td>
			<td align="right">'.$sum_persen_a_06.'</td>
			<td align="right">'.number_format($sum_netto_a_06,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_a_06,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_a_06,0,",",".").'</td>
			<td align="right">'.number_format($sum_bruto_b_06,0,",",".").'</td>
			<td align="right">'.$sum_persen_b_06.'</td>
			<td align="right">'.number_format($sum_netto_b_06,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_b_06,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_b_06,0,",",".").'</td>
		</tr>
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center>AKUM</center></td>
			<td align="right">'.number_format($respon['result_bulan_06'][0]['SUM_BRUTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_06'][0]['SUM_PERSEN_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_06'][0]['SUM_NETTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_06'][0]['SUM_RP_KG_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_06'][0]['SUM_RP_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_06'][0]['SUM_BRUTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_06'][0]['SUM_PERSEN_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_06'][0]['SUM_NETTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_06'][0]['SUM_RP_KG_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_06'][0]['SUM_RP_B_BULAN'],0,",",".").'</td>
		</tr>
		'.$laporan_07.'
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center># (07)</center></td>
			<td align="right">'.number_format($sum_bruto_a_07,0,",",".").'</td>
			<td align="right">'.$sum_persen_a_07.'</td>
			<td align="right">'.number_format($sum_netto_a_07,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_a_07,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_a_07,0,",",".").'</td>
			<td align="right">'.number_format($sum_bruto_b_07,0,",",".").'</td>
			<td align="right">'.$sum_persen_b_07.'</td>
			<td align="right">'.number_format($sum_netto_b_07,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_b_07,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_b_07,0,",",".").'</td>
		</tr>
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center>AKUM</center></td>
			<td align="right">'.number_format($respon['result_bulan_07'][0]['SUM_BRUTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_07'][0]['SUM_PERSEN_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_07'][0]['SUM_NETTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_07'][0]['SUM_RP_KG_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_07'][0]['SUM_RP_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_07'][0]['SUM_BRUTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_07'][0]['SUM_PERSEN_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_07'][0]['SUM_NETTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_07'][0]['SUM_RP_KG_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_07'][0]['SUM_RP_B_BULAN'],0,",",".").'</td>
		</tr>
		'.$laporan_08.'
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center># (08)</center></td>
			<td align="right">'.number_format($sum_bruto_a_08,0,",",".").'</td>
			<td align="right">'.$sum_persen_a_08.'</td>
			<td align="right">'.number_format($sum_netto_a_08,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_a_08,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_a_08,0,",",".").'</td>
			<td align="right">'.number_format($sum_bruto_b_08,0,",",".").'</td>
			<td align="right">'.$sum_persen_b_08.'</td>
			<td align="right">'.number_format($sum_netto_b_08,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_b_08,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_b_08,0,",",".").'</td>
		</tr>
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center>AKUM</center></td>
			<td align="right">'.number_format($respon['result_bulan_08'][0]['SUM_BRUTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_08'][0]['SUM_PERSEN_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_08'][0]['SUM_NETTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_08'][0]['SUM_RP_KG_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_08'][0]['SUM_RP_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_08'][0]['SUM_BRUTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_08'][0]['SUM_PERSEN_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_08'][0]['SUM_NETTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_08'][0]['SUM_RP_KG_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_08'][0]['SUM_RP_B_BULAN'],0,",",".").'</td>
		</tr>
		'.$laporan_09.'
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center># (09)</center></td>
			<td align="right">'.number_format($sum_bruto_a_09,0,",",".").'</td>
			<td align="right">'.$sum_persen_a_09.'</td>
			<td align="right">'.number_format($sum_netto_a_09,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_a_09,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_a_09,0,",",".").'</td>
			<td align="right">'.number_format($sum_bruto_b_09,0,",",".").'</td>
			<td align="right">'.$sum_persen_b_09.'</td>
			<td align="right">'.number_format($sum_netto_b_09,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_b_09,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_b_09,0,",",".").'</td>
		</tr>
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center>AKUM</center></td>
			<td align="right">'.number_format($respon['result_bulan_09'][0]['SUM_BRUTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_09'][0]['SUM_PERSEN_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_09'][0]['SUM_NETTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_09'][0]['SUM_RP_KG_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_09'][0]['SUM_RP_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_09'][0]['SUM_BRUTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_09'][0]['SUM_PERSEN_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_09'][0]['SUM_NETTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_09'][0]['SUM_RP_KG_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_09'][0]['SUM_RP_B_BULAN'],0,",",".").'</td>
		</tr>
		'.$laporan_10.'
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center># (10)</center></td>
			<td align="right">'.number_format($sum_bruto_a_10,0,",",".").'</td>
			<td align="right">'.$sum_persen_a_10.'</td>
			<td align="right">'.number_format($sum_netto_a_10,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_a_10,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_a_10,0,",",".").'</td>
			<td align="right">'.number_format($sum_bruto_b_10,0,",",".").'</td>
			<td align="right">'.$sum_persen_b_10.'</td>
			<td align="right">'.number_format($sum_netto_b_10,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_kg_b_10,0,",",".").'</td>
			<td align="right">'.number_format($sum_rp_b_10,0,",",".").'</td>
		</tr>
		<tr style="background-color:#FFFF00">
			<td colspan="5"><center>AKUM</center></td>
			<td align="right">'.number_format($respon['result_bulan_10'][0]['SUM_BRUTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_10'][0]['SUM_PERSEN_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_10'][0]['SUM_NETTO_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_10'][0]['SUM_RP_KG_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_10'][0]['SUM_RP_A_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_10'][0]['SUM_BRUTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_10'][0]['SUM_PERSEN_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_10'][0]['SUM_NETTO_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_10'][0]['SUM_RP_KG_B_BULAN'],0,",",".").'</td>
			<td align="right">'.number_format($respon['result_bulan_10'][0]['SUM_RP_B_BULAN'],0,",",".").'</td>
		</tr>



		<tr>
		<tr style="background-color:#7CFC00">
			<td colspan="5"><center>Hari ini / '.$respon['total'][0]['TANGGAL'].'</center></td>
			<td align="right">'.number_format($respon['total'][0]['TOTAL_SUM_BRUTO_A'],0,",",".").'</td>
			<td align="right">'.round((($respon['total'][0]['TOTAL_SUM_BRUTO_A']-$respon['total'][0]['TOTAL_SUM_NETTO_A'])/$respon['total'][0]['TOTAL_SUM_BRUTO_A'])*100).'</td>
			<td align="right">'.number_format($respon['total'][0]['TOTAL_SUM_NETTO_A'],0,",",".").'</td>
			<td align="right">'.number_format(($respon['total'][0]['TOTAL_SUM_RP_A']/$respon['total'][0]['TOTAL_SUM_NETTO_A']),0,",",".").'</td>
			<td align="right">'.number_format($respon['total'][0]['TOTAL_SUM_RP_A'],0,",",".").'</td>

			<td align="right">'.number_format($respon['total'][0]['TOTAL_SUM_BRUTO_B'],0,",",".").'</td>
			<td align="right">'.round((($respon['total'][0]['TOTAL_SUM_BRUTO_B']-$respon['total'][0]['TOTAL_SUM_NETTO_B'])/$respon['total'][0]['TOTAL_SUM_BRUTO_B'])*100).'</td>
			<td align="right">'.number_format($respon['total'][0]['TOTAL_SUM_NETTO_B'],0,",",".").'</td>
			<td align="right">'.number_format(($respon['total'][0]['TOTAL_SUM_RP_B']/$respon['total'][0]['TOTAL_SUM_NETTO_B']),0,",",".").'</td>
			<td align="right">'.number_format($respon['total'][0]['TOTAL_SUM_RP_B'],0,",",".").'</td>
		</tr>
		<tr style="background-color:#7CFC00">
			<td colspan="5"><center>Tanggal 01 S/D '.$respon['total'][0]['TANGGAL'].'</center></td>
			<td align="right">'.number_format($respon['total'][0]['TOTAL_BULAN_SUM_BRUTO_A'],0,",",".").'</td>
			<td align="right">'.round((($respon['total'][0]['TOTAL_BULAN_SUM_BRUTO_A']-$respon['total'][0]['TOTAL_BULAN_SUM_NETTO_A'])/$respon['total'][0]['TOTAL_BULAN_SUM_BRUTO_A'])*100).'</td>
			<td align="right">'.number_format($respon['total'][0]['TOTAL_BULAN_SUM_NETTO_A'],0,",",".").'</td>
			<td align="right">'.number_format(($respon['total'][0]['TOTAL_BULAN_SUM_RP_A']/$respon['total'][0]['TOTAL_BULAN_SUM_NETTO_A']),0,",",".").'</td>
			<td align="right">'.number_format($respon['total'][0]['TOTAL_BULAN_SUM_RP_A'],0,",",".").'</td>

			<td align="right">'.number_format($respon['total'][0]['TOTAL_BULAN_SUM_BRUTO_B'],0,",",".").'</td>
			<td align="right">'.round((($respon['total'][0]['TOTAL_BULAN_SUM_BRUTO_B']-$respon['total'][0]['TOTAL_BULAN_SUM_NETTO_B'])/$respon['total'][0]['TOTAL_BULAN_SUM_BRUTO_B'])*100).'</td>
			<td align="right">'.number_format($respon['total'][0]['TOTAL_BULAN_SUM_NETTO_B'],0,",",".").'</td>
			<td align="right">'.number_format(($respon['total'][0]['TOTAL_BULAN_SUM_RP_B']/$respon['total'][0]['TOTAL_BULAN_SUM_NETTO_B']),0,",",".").'</td>
			<td align="right">'.number_format($respon['total'][0]['TOTAL_BULAN_SUM_RP_B'],0,",",".").'</td>
		</tr>
		</tr>
	</table>
	</body>
	</html>
';


$footer = '
<table width="100%" style="vertical-align: top; font-size: 10px;"><tr>
<td width="50%" align="left"></td><td class="text-right"> {PAGENO}{nbpg} </td>
</tr></table>
';

// echo $html;
// exit;
$mpdf->SetHTMLHeader($headerHTML);
//$mpdf->SetHTMLFooter($footer);
//==============================================================
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================
//==============================================================


?>
