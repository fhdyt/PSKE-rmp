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
	'case'=>"nonlogin_cetak_laporan_harian_kp",
	'batas'=>1000,
	'halaman'=>1,
	'data_http'=>$_COOKIE['data_http'],
	'input_option'=>$input_option,
);
$respon=$RMP->rmp_modules($params)->load->module;
$no = 1;
foreach($respon['result_02'] as $r){
	$laporan_2 .='
	<tr>
	<td>'.$no++.'</td>
	<td>'.$r['RMP_MASTER_PERSONAL_NAMA'].'</td>
	<td>'.$r['RMP_FAKTUR_ALAMAT'].'</td>
	<td>'.$r['RMP_REKENING_RELASI'].'</td>
	<td>'.$r['RMP_FAKTUR_NO_FAKTUR'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_GONI'].'</td>
	<td>'.$r['KG_BASAH'].'</td>
	<td>'.$r['KUALITET'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_RP_KG'].'</td>
	<td>'.$r['KG_KERING'].'</td>
	<td>'.$r['RP_KERING'].'</td>
	<td>'.$r['TOTAL'].'</td>
	</tr>
	';
}
foreach($respon['result_03'] as $r){
	$laporan_3 .='
	<tr>
	<td>'.$no++.'</td>
	<td>'.$r['RMP_MASTER_PERSONAL_NAMA'].'</td>
	<td>'.$r['RMP_FAKTUR_ALAMAT'].'</td>
	<td>'.$r['RMP_REKENING_RELASI'].'</td>
	<td>'.$r['RMP_FAKTUR_NO_FAKTUR'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_GONI'].'</td>
	<td>'.$r['KG_BASAH'].'</td>
	<td>'.$r['KUALITET'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_RP_KG'].'</td>
	<td>'.$r['KG_KERING'].'</td>
	<td>'.$r['RP_KERING'].'</td>
	<td>'.$r['TOTAL'].'</td>
	</tr>
	';
}
foreach($respon['result_04'] as $r){
	$laporan_4 .='
	<tr>
	<td>'.$no++.'</td>
	<td>'.$r['RMP_MASTER_PERSONAL_NAMA'].'</td>
	<td>'.$r['RMP_FAKTUR_ALAMAT'].'</td>
	<td>'.$r['RMP_REKENING_RELASI'].'</td>
	<td>'.$r['RMP_FAKTUR_NO_FAKTUR'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_GONI'].'</td>
	<td>'.$r['KG_BASAH'].'</td>
	<td>'.$r['KUALITET'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_RP_KG'].'</td>
	<td>'.$r['KG_KERING'].'</td>
	<td>'.$r['RP_KERING'].'</td>
	<td>'.$r['TOTAL'].'</td>
	</tr>
	';
}
foreach($respon['result_05'] as $r){
	$laporan_5 .='
	<tr>
	<td>'.$no++.'</td>
	<td>'.$r['RMP_MASTER_PERSONAL_NAMA'].'</td>
	<td>'.$r['RMP_FAKTUR_ALAMAT'].'</td>
	<td>'.$r['RMP_REKENING_RELASI'].'</td>
	<td>'.$r['RMP_FAKTUR_NO_FAKTUR'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_GONI'].'</td>
	<td>'.$r['KG_BASAH'].'</td>
	<td>'.$r['KUALITET'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_RP_KG'].'</td>
	<td>'.$r['KG_KERING'].'</td>
	<td>'.$r['RP_KERING'].'</td>
	<td>'.$r['TOTAL'].'</td>
	</tr>
	';
}
foreach($respon['result_06'] as $r){
	$laporan_6 .='
	<tr>
	<td>'.$no++.'</td>
	<td>'.$r['RMP_MASTER_PERSONAL_NAMA'].'</td>
	<td>'.$r['RMP_FAKTUR_ALAMAT'].'</td>
	<td>'.$r['RMP_REKENING_RELASI'].'</td>
	<td>'.$r['RMP_FAKTUR_NO_FAKTUR'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_GONI'].'</td>
	<td>'.$r['KG_BASAH'].'</td>
	<td>'.$r['KUALITET'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_RP_KG'].'</td>
	<td>'.$r['KG_KERING'].'</td>
	<td>'.$r['RP_KERING'].'</td>
	<td>'.$r['TOTAL'].'</td>
	</tr>
	';
}
foreach($respon['result_07'] as $r){
	$laporan_7 .='
	<tr>
	<td>'.$no++.'</td>
	<td>'.$r['RMP_MASTER_PERSONAL_NAMA'].'</td>
	<td>'.$r['RMP_FAKTUR_ALAMAT'].'</td>
	<td>'.$r['RMP_REKENING_RELASI'].'</td>
	<td>'.$r['RMP_FAKTUR_NO_FAKTUR'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_GONI'].'</td>
	<td>'.$r['KG_BASAH'].'</td>
	<td>'.$r['KUALITET'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_RP_KG'].'</td>
	<td>'.$r['KG_KERING'].'</td>
	<td>'.$r['RP_KERING'].'</td>
	<td>'.$r['TOTAL'].'</td>
	</tr>
	';
}
foreach($respon['result_08'] as $r){
	$laporan_8 .='
	<tr>
	<td>'.$no++.'</td>
	<td>'.$r['RMP_MASTER_PERSONAL_NAMA'].'</td>
	<td>'.$r['RMP_FAKTUR_ALAMAT'].'</td>
	<td>'.$r['RMP_REKENING_RELASI'].'</td>
	<td>'.$r['RMP_FAKTUR_NO_FAKTUR'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_GONI'].'</td>
	<td>'.$r['KG_BASAH'].'</td>
	<td>'.$r['KUALITET'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_RP_KG'].'</td>
	<td>'.$r['KG_KERING'].'</td>
	<td>'.$r['RP_KERING'].'</td>
	<td>'.$r['TOTAL'].'</td>
	</tr>
	';
}
foreach($respon['result_09'] as $r){
	$laporan_9 .='
	<tr>
	<td>'.$no++.'</td>
	<td>'.$r['RMP_MASTER_PERSONAL_NAMA'].'</td>
	<td>'.$r['RMP_FAKTUR_ALAMAT'].'</td>
	<td>'.$r['RMP_REKENING_RELASI'].'</td>
	<td>'.$r['RMP_FAKTUR_NO_FAKTUR'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_GONI'].'</td>
	<td>'.$r['KG_BASAH'].'</td>
	<td>'.$r['KUALITET'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_RP_KG'].'</td>
	<td>'.$r['KG_KERING'].'</td>
	<td>'.$r['RP_KERING'].'</td>
	<td>'.$r['TOTAL'].'</td>
	</tr>
	';
}
foreach($respon['result_10'] as $r){
	$laporan_10 .='
	<tr>
	<td>'.$no++.'</td>
	<td>'.$r['RMP_MASTER_PERSONAL_NAMA'].'</td>
	<td>'.$r['RMP_FAKTUR_ALAMAT'].'</td>
	<td>'.$r['RMP_REKENING_RELASI'].'</td>
	<td>'.$r['RMP_FAKTUR_NO_FAKTUR'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_GONI'].'</td>
	<td>'.$r['KG_BASAH'].'</td>
	<td>'.$r['KUALITET'].'</td>
	<td>'.$r['RMP_FAKTUR_PURCHASER_RP_KG'].'</td>
	<td>'.$r['KG_KERING'].'</td>
	<td>'.$r['RP_KERING'].'</td>
	<td>'.$r['TOTAL'].'</td>
	</tr>
	';
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
						KELAPA KOPRA
					</td>
				</tr>
			</table>
		</td>
		<td style="padding-left: 550px;">
		<table>
			<tr>
				<td>
					Tanggal
				</td>
				<td>
					:
				</td>
				<td>
					'.$tanggal.'
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
		<tr>
			<td>No.</td>
			<td>Nama</td>
			<td>Alamat</td>
			<td>Rekening</td>
			<td>Nomor Faktur</td>
			<td>Goni</td>
			<td>Kg Basah</td>
			<td>%</td>
			<td>@Rp Basah</td>
			<td>Kg Kering</td>
			<td>@Rp Kering</td>
			<td>Rp</td>
		</tr>
		'.$laporan_2.'
		<tr><td>02</td></tr>
		'.$laporan_3.'
		<tr><td>03</td></tr>
		'.$laporan_4.'
		<tr><td>04</td></tr>
		'.$laporan_5.'
		<tr><td>05</td></tr>
		'.$laporan_6.'
		<tr><td>06</td></tr>
		'.$laporan_7.'
		<tr><td>07</td></tr>
		'.$laporan_8.'
		<tr><td>08</td></tr>
		'.$laporan_9.'
		<tr><td>09</td></tr>
		'.$laporan_10.'
		<tr><td>10</td></tr>
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
