<?php
//---AJAX ---//
$ref=anti_injection($_POST['ref']);
switch($ref){
			case 'sel_kabupaten':
				require_once("ajax/supplier/sel_kabupaten.php");
			break;
			case 'sel_kecamatan':
				require_once("ajax/supplier/sel_kecamatan.php");
			break;
			case 'sel_desa':
				require_once("ajax/supplier/sel_desa.php");
			break;
			case 'add_personal':
				require_once("ajax/supplier/add_personal.php");
			break;
			case 'supplier_list':
				require_once("ajax/supplier/supplier_list.php");
			break;
			case 'master_supplier_list':
				require_once("ajax/supplier/master_supplier_list.php");
			break;
			case 'add_pengirim':
				require_once("ajax/supplier/add_pengirim.php");
			break;
			case 'pengirim_list':
				require_once("ajax/supplier/pengirim_list.php");
			break;
			case 'add_pengepul':
				require_once("ajax/supplier/add_pengepul.php");
			break;
			case 'pengepul_list':
				require_once("ajax/supplier/pengepul_list.php");
			break;
			case 'add_wilayah':
				require_once("ajax/supplier/add_wilayah.php");
			break;
			case 'wilayah_list':
				require_once("ajax/supplier/wilayah_list.php");
			break;
			case 'sub_wilayah':
				require_once("ajax/supplier/sub_wilayah.php");
			break;
			case 'add_rekening':
				require_once("ajax/supplier/add_rekening.php");
			break;
			case 'add_rekening_relasi':
				require_once("ajax/supplier/add_rekening_relasi.php");
			break;
			case 'hapus_rekening_relasi':
				require_once("ajax/supplier/hapus_rekening_relasi.php");
			break;
			case 'hapus_rekening':
				require_once("ajax/supplier/hapus_rekening.php");
			break;
			case 'hapus_wilayah':
				require_once("ajax/supplier/hapus_wilayah.php");
			break;
			case 'hapus_asisten':
				require_once("ajax/supplier/hapus_asisten.php");
			break;
			case 'hapus_toleransi_mutu':
				require_once("ajax/supplier/hapus_toleransi_mutu.php");
			break;
			case 'hapus_kontak':
				require_once("ajax/supplier/hapus_kontak.php");
			break;
			case 'hapus_relasi_cabang':
				require_once("ajax/supplier/hapus_relasi_cabang.php");
			break;
			case 'hapus_keluarga':
				require_once("ajax/supplier/hapus_keluarga.php");
			break;
			case 'rekening_list':
				require_once("ajax/supplier/rekening_list.php");
			break;
			case 'rekening_relasi_list':
				require_once("ajax/supplier/rekening_relasi_list.php");
			break;
			case 'toleransi_mutu_list':
				require_once("ajax/supplier/toleransi_mutu_list.php");
			break;
			case 'add_penyesuaian_harga_kb':
				require_once("ajax/penyesuaian_harga/add_penyesuaian_harga_kb.php");
			break;
			case 'add_toleransi_mutu':
				require_once("ajax/supplier/add_toleransi_mutu.php");
			break;
			case 'add_kontak':
				require_once("ajax/supplier/add_kontak.php");
			break;
			case 'add_relasi_cabang':
				require_once("ajax/supplier/add_relasi_cabang.php");
			break;
			case 'kontak_list':
				require_once("ajax/supplier/kontak_list.php");
			break;
			case 'relasi_cabang_list':
				require_once("ajax/supplier/relasi_cabang_list.php");
			break;
			case 'asisten_list':
				require_once("ajax/supplier/asisten_list.php");
			break;
			case 'data_personal_supplier':
				require_once("ajax/supplier/data_personal_supplier.php");
			break;
			case 'data_personal_detail':
				require_once("ajax/supplier/data_personal_detail.php");
			break;
			case 'add_asisten':
				require_once("ajax/supplier/add_asisten.php");
			break;
			case 'asisten_list':
				require_once("ajax/supplier/asisten_list.php");
			break;
			case 'add_keluarga':
				require_once("ajax/supplier/add_keluarga.php");
			break;
			case 'keluarga_list':
				require_once("ajax/supplier/keluarga_list.php");
			break;
			case 'dokumen_list':
				require_once("ajax/supplier/dokumen_list.php");
			break;
			case 'add_dokumen':
				require_once("ajax/supplier/add_dokumen.php");
			break;
			case 'relasi_master':
				require_once("ajax/supplier/relasi_master.php");
			break;




			case 'konfigurasi_wilayah_list':
				require_once("ajax/konfigurasi/konfigurasi_wilayah_list.php");
			break;
			case 'konfigurasi_add_wilayah':
				require_once("ajax/konfigurasi/konfigurasi_add_wilayah.php");
			break;
			case 'konfigurasi_add_sub_wilayah':
				require_once("ajax/konfigurasi/konfigurasi_add_sub_wilayah.php");
			break;
			case 'konfigurasi_add_harga':
				require_once("ajax/konfigurasi/konfigurasi_add_harga.php");
			break;
			case 'konfigurasi_material_list':
				require_once("ajax/konfigurasi/konfigurasi_material_list.php");
			break;
			case 'konfigurasi_harga_list':
				require_once("ajax/konfigurasi/konfigurasi_harga_list.php");
			break;
			case 'konfigurasi_harga_fc_list':
				require_once("ajax/konfigurasi/konfigurasi_harga_fc_list.php");
			break;
			case 'konfigurasi_add_material':
				require_once("ajax/konfigurasi/konfigurasi_add_material.php");
			break;
			case 'konfigurasi_harga_fc_add':
				require_once("ajax/konfigurasi/konfigurasi_harga_fc_add.php");
			break;
			case 'sub_wilayah_list':
				require_once("ajax/konfigurasi/sub_wilayah_list.php");
			break;
			case 'petugas_list':
				require_once("ajax/konfigurasi/petugas_list.php");
			break;
			case 'petugas_add':
				require_once("ajax/konfigurasi/petugas_add.php");
			break;
			case 'sel_nama_karyawan':
				require_once("ajax/konfigurasi/sel_nama_karyawan.php");
			break;









			case 'pilih_no_nota':
				require_once("ajax/faktur/pilih_no_nota.php");
			break;
			case 'hasil_timbang_list':
				require_once("ajax/faktur/hasil_timbang_list.php");
			break;
			case 'kirim_hasil_timbang':
				require_once("ajax/faktur/kirim_hasil_timbang.php");
			break;
			case 'kembali_hasil_timbang':
				require_once("ajax/faktur/kembali_hasil_timbang.php");
			break;
			case 'faktur_list':
				require_once("ajax/faktur/faktur_list.php");
			break;
			case 'simpan_faktur':
				require_once("ajax/faktur/simpan_faktur.php");
			break;
			case 'sel_nama_supplier':
				require_once("ajax/faktur/sel_nama_supplier.php");
			break;
			case 'sel_operator_timbang':
				require_once("ajax/faktur/sel_operator_timbang.php");
			break;
			case 'sel_inspektur_mutu':
				require_once("ajax/faktur/sel_inspektur_mutu.php");
			break;
			case 'sel_id_faktur_cabang':
				require_once("ajax/faktur/sel_id_faktur_cabang.php");
			break;
			case 'lihat_faktur':
				require_once("ajax/faktur/lihat_faktur.php");
			break;
			case 'lihat_faktur_kp':
				require_once("ajax/faktur_kp/lihat_faktur_kp.php");
			break;
			case 'edit_faktur':
				require_once("ajax/faktur/edit_faktur.php");
			break;
			case 'simpan_manual_nota':
				require_once("ajax/faktur/simpan_manual_nota.php");
			break;
			case 'simpan_manual_nota_kp':
				require_once("ajax/faktur_kp/simpan_manual_nota_kp.php");
			break;
			case 'simpan_edit_nota':
				require_once("ajax/faktur_kp/simpan_edit_nota.php");
			break;
			case 'cek_nomor_faktur':
				require_once("ajax/faktur/cek_nomor_faktur.php");
			break;



			case 'pilih_no_nota_kp':
				require_once("ajax/faktur_kp/pilih_no_nota_kp.php");
			break;
			case 'hasil_timbang_list_kp':
				require_once("ajax/faktur_kp/hasil_timbang_list_kp.php");
			break;
			case 'kirim_hasil_timbang_kp':
				require_once("ajax/faktur_kp/kirim_hasil_timbang_kp.php");
			break;
			case 'kembali_hasil_timbang_kp':
				require_once("ajax/faktur_kp/kembali_hasil_timbang_kp.php");
			break;
			case 'faktur_list_kp':
				require_once("ajax/faktur_kp/faktur_list_kp.php");
			break;
			case 'simpan_faktur_kp':
				require_once("ajax/faktur_kp/simpan_faktur_kp.php");
			break;
			case 'new_no_faktur_kp':
				require_once("ajax/faktur_kp/new_no_faktur_kp.php");
			break;
			// case 'sel_nama_supplier':
			// 	require_once("ajax/faktur/sel_nama_supplier.php");
			// break;
			// case 'sel_operator_timbang':
			// 	require_once("ajax/faktur/sel_operator_timbang.php");
			// break;
			// case 'sel_inspektur_mutu':
			// 	require_once("ajax/faktur/sel_inspektur_mutu.php");
			// break;
			// case 'sel_id_faktur_cabang':
			// 	require_once("ajax/faktur/sel_id_faktur_cabang.php");
			// break;
			// case 'lihat_faktur':
			// 	require_once("ajax/faktur/lihat_faktur.php");
			// break;
			// case 'edit_faktur':
			// 	require_once("ajax/faktur/edit_faktur.php");
			// break;
			// case 'simpan_manual_nota':
			// 	require_once("ajax/faktur/simpan_manual_nota.php");
			// break;
			// case 'cek_nomor_faktur':
			// 	require_once("ajax/faktur/cek_nomor_faktur.php");
			// break;







			case 'sel_material':
				require_once("ajax/penyesuaian_harga/sel_material.php");
			break;
			case 'penyesuaian_harga_kb_list':
				require_once("ajax/penyesuaian_harga/penyesuaian_harga_kb_list.php");
			break;
			case 'hapus_penyesuaian_harga_gl':
				require_once("ajax/penyesuaian_harga/hapus_penyesuaian_harga_gl.php");
			break;
			case 'supplier_list_kb':
				require_once("ajax/penyesuaian_harga/supplier_list_kb.php");
			break;
			case 'perbarui_harga':
				require_once("ajax/penyesuaian_harga/perbarui_harga.php");
			break;


			case 'list_gl_a':
				require_once("ajax/faktur_cabang/list_gl_a.php");
			break;
			case 'list_gl_b':
				require_once("ajax/faktur_cabang/list_gl_b.php");
			break;
			case 'list_gl_c':
				require_once("ajax/faktur_cabang/list_gl_c.php");
			break;
			case 'add_gl_a':
				require_once("ajax/faktur_cabang/add_gl_a.php");
			break;
			case 'nama_supplier':
				require_once("ajax/faktur_cabang/nama_supplier.php");
			break;
			case 'add_faktur_cabang':
				require_once("ajax/faktur_cabang/add_faktur_cabang.php");
			break;
			case 'list_faktur_cabang':
				require_once("ajax/faktur_cabang/list_faktur_cabang.php");
			break;
			case 'list_review_faktur_cabang_c':
				require_once("ajax/faktur_cabang/list_review_faktur_cabang_c.php");
			break;
			case 'list_review_faktur_cabang_b':
				require_once("ajax/faktur_cabang/list_review_faktur_cabang_b.php");
			break;
			case 'list_review_faktur_cabang_a':
				require_once("ajax/faktur_cabang/list_review_faktur_cabang_a.php");
			break;
			case 'hapus_detail_rekap':
				require_once("ajax/faktur_cabang/hapus_detail_rekap.php");
			break;
			case 'simpanreview':
				require_once("ajax/faktur_cabang/simpanreview.php");
			break;
			case 'list_cabang_proses_a':
				require_once("ajax/faktur_cabang/list_cabang_proses_a.php");
			break;
			case 'list_cabang_proses_b':
				require_once("ajax/faktur_cabang/list_cabang_proses_b.php");
			break;
			case 'list_cabang_proses_c':
				require_once("ajax/faktur_cabang/list_cabang_proses_c.php");
			break;
			case 'ambil_data_proses':
				require_once("ajax/faktur_cabang/ambil_data_proses.php");
			break;
			case 'simpan_edit_proses':
				require_once("ajax/faktur_cabang/simpan_edit_proses.php");
			break;
			case 'hapus_proses':
				require_once("ajax/faktur_cabang/hapus_proses.php");
			break;



			case 'faktur_list_purchaser':
				require_once("ajax/purchaser/faktur_list_purchaser.php");
			break;
			case 'faktur_detail_list':
				require_once("ajax/purchaser/faktur_detail_list.php");
			break;
			case 'sel_nama_supplier_rek':
				require_once("ajax/purchaser/sel_nama_supplier_rek.php");
			break;
			case 'sel_nama_supplier_rek_kp':
				require_once("ajax/purchaser/sel_nama_supplier_rek_kp.php");
			break;
			case 'add_faktur_purchaser':
				require_once("ajax/purchaser/add_faktur_purchaser.php");
			break;
			case 'add_faktur_purchaser_kp':
				require_once("ajax/purchaser/add_faktur_purchaser_kp.php");
			break;
			case 'batalkan_kalkulasi':
				require_once("ajax/purchaser/batalkan_kalkulasi.php");
			break;
			case 'add_verifikasi_harga':
				require_once("ajax/purchaser/add_verifikasi_harga.php");
			break;
			case 'detail_purchaser':
				require_once("ajax/purchaser/detail_purchaser.php");
			break;





			case 'verifikasi_harga_list':
				require_once("ajax/verifikasi_harga/verifikasi_harga_list.php");
			break;
			case 'verifikasi_action':
				require_once("ajax/verifikasi_harga/verifikasi_action.php");
			break;

			case 'laporan_faktur':
				require_once("ajax/laporan/laporan_faktur.php");
			break;
			case 'laporan_faktur_kp':
				require_once("ajax/laporan_kp/laporan_faktur_kp.php");
			break;
			case 'laporan_faktur_kp_00':
				require_once("ajax/laporan_kp/laporan_faktur_kp_00.php");
			break;
			case 'total_laporan':
				require_once("ajax/laporan/total_laporan.php");
			break;
			case 'total_laporan_kp':
				require_once("ajax/laporan_kp/total_laporan_kp.php");
			break;
			case 'kirim_pembukuan':
				require_once("ajax/laporan/kirim_pembukuan.php");
			break;





			case 'list_faktur_cabang_a':
				require_once("ajax/faktur_cabang_adm/list_faktur_cabang_a.php");
			break;
			case 'list_faktur_cabang_b':
				require_once("ajax/faktur_cabang_adm/list_faktur_cabang_b.php");
			break;
			case 'list_faktur_cabang_c':
				require_once("ajax/faktur_cabang_adm/list_faktur_cabang_c.php");
			break;




			case 'sel_nama_supplier_with_rek':
				require_once("ajax/laporan_relasi/sel_nama_supplier_with_rek.php");
			break;
			case 'laporan_relasi_faktur':
				require_once("ajax/laporan_relasi/laporan_relasi_faktur.php");
			break;
			case 'laporan_relasi_faktur_kp':
				require_once("ajax/laporan_relasi/laporan_relasi_faktur_kp.php");
			break;





			case 'periode_list':
				require_once("ajax/pengajuan_pembayaran/periode_list.php");
			break;
			case 'detail_periode':
				require_once("ajax/pengajuan_pembayaran/detail_periode.php");
			break;
			case 'periode_tersedia':
				require_once("ajax/pengajuan_pembayaran/periode_tersedia.php");
			break;
			case 'kirim_pengajuan_pembayaran':
				require_once("ajax/pengajuan_pembayaran/kirim_pengajuan_pembayaran.php");
			break;
			case 'jurnal_list':
				require_once("ajax/pengajuan_pembayaran/jurnal_list.php");
			break;
			case 'verifikasi_pengajuan':
				require_once("ajax/pengajuan_pembayaran/verifikasi_pengajuan.php");
			break;
			case 'verifikasi_tolak':
				require_once("ajax/pengajuan_pembayaran/verifikasi_tolak.php");
			break;


//--------------Handle Error Page-----------------------------------
	// default:
	// 	$callback['pesan']="gagal";
	// 	$callback['text_msg']="CCCCase ajax not found {$ref}";
	// 	echo json_encode($callback);
	// 	exit;
	// break;

}
?>
