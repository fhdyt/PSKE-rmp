<?php
//---AJAX ---//
switch($d2){
	case 'cetak_faktur':
		require("pdf/cetak_faktur.php");
		break;
	case 'cetak_faktur_kp':
		require("pdf/cetak_faktur_kp.php");
		break;
	case 'cetak_faktur_adm':
		require("pdf/cetak_faktur_adm.php");
		break;
	case 'cetak_faktur_adm_kp':
		require("pdf/cetak_faktur_adm_kp.php");
		break;
	case 'cetak_laporan_harian':
		require("pdf/cetak_laporan_harian.php");
		break;
	//--------------Handle Error Page-----------------------------------
	default:
		$callback['pesan']="gagal";
		$callback['text_msg']="Case ajax not found {$ref}";
		echo json_encode($callback);
		exit;
	break;
}//---end switch
?>
