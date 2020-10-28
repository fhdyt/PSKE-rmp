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
$bulan = $d4;
$tahun = $d5;
$supplier = $d6;

$input_option=array(
	'material'=>$d3,
	'bulan'=>$bulan,
	'tahun'=>$tahun,
	'supplier'=>$supplier
);


$params=array(
	//'case'=>"presensi_lembur_spl_pdf_nonlogin",
	'case'=>"nonlogin_laporan_relasi_faktur_kp",
	'batas'=>1000,
	'halaman'=>1,
	'data_http'=>$_COOKIE['data_http'],
	'input_option'=>$input_option,
);
$respon=$RMP->rmp_modules($params)->load->module;
$no = 1;
foreach($respon['result'] as $r){
	$laporan_relasi .='
	<tr>
	<td>'.$no++.'</td>
	<td>'.$r['RMP_FAKTUR_TANGGAL'].'</td>
	<td>'.$r['RMP_FAKTUR_NO_FAKTUR'].'</td>
	<td>'.$r['RMP_FAKTUR_KAPAL'].'</td>
	<td style="text-align:right">'.$r['RMP_FAKTUR_GONI'].'</td>
	<td style="text-align:right">'.$r['BRUTO_KG'].'</td>
	<td style="text-align:right">0</td>
	<td style="text-align:right">'.$r['NETTO_KG'].'</td>
	<td style="text-align:right">'.$r['KUALITET_QC'].'</td>
	<td style="text-align:right">'.$r['KUALITET_FAKTUR'].'</td>
	<td style="text-align:right">'.$r['RP_KG'].'</td>
	<td style="text-align:right">'.$r['RP_KELAPA'].'</td>
	<td style="text-align:right">'.$r['GONI_RP'].'</td>
	<td style="text-align:right">'.$r['TAMBANG_RP'].'</td>
	<td style="text-align:right">'.$r['KERING_KG'].'</td>
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
						LAPORAN BULANAN RELASI KOPRA<br>
					</td>
				</tr>
			</table>
		</td>
		<td style="padding-left: 550px;">
		<table>
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
		<td>Tanggal</td>
		<td>No. Faktur</td>
		<td>Kapal</td>
		<td><center>Goni</center></td>
		<td><center>Bruto KG</center></td>
		<td><center>Goni KG</center></td>
		<td><center>Netto KG</center></td>
		<td><center>QC %</center></td>
		<td><center>Faktur %</center></td>
		<td><center>Harga / KG RP</center></td>
		<td><center>Kopra RP</center></td>
		<td><center>Goni RP</center></td>
		<td><center>Tambang RP</center></td>
		<td><center>K.Kering KG</center></td>
		</tr>
		'.$laporan_relasi.'
		<tr class="warning">
      <td colspan="4" style="text-align:right ;font-weight: bold;"></td>
      <td style="text-align:right ;font-weight: bold;">'.$respon['result_total'][0]['TOTAL_GONI'].'</td>
      <td  style="text-align:right ;font-weight: bold;">'.$respon['result_total'][0]['TOTAL_BRUTO'].'</td>
      <td  style="text-align:right ;font-weight: bold;">0</td>
      <td  style="text-align:right ;font-weight: bold;">'.$respon['result_total'][0]['TOTAL_NETTO'].'</td>
      <td  style="text-align:right ;font-weight: bold;"></td>
      <td  style="text-align:right ;font-weight: bold;"></td>
      <td  style="text-align:right ;font-weight: bold;"></td>
      <td  style="text-align:right ;font-weight: bold;">'.$respon['result_total'][0]['TOTAL_KELAPA'].'</td>
      <td  style="text-align:right ;font-weight: bold;">'.$respon['result_total'][0]['TOTAL_GONI_RP'].'</td>
      <td  style="text-align:right ;font-weight: bold;">'.$respon['result_total'][0]['TOTAL_TAMBANG'].'</td>
      <td  style="text-align:right ;font-weight: bold;">'.$respon['result_total'][0]['TOTAL_KERING_KG'].'</td>
      <td></tr>
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
