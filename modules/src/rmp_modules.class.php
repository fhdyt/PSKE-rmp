<?php
/**
 * Cara melakukan bypass privileges modul gunakan kata 'open' pada case modul
 * Misal : open_data_443
 *
 *
 */
CLASS RMP_MODULES extends USER_PRIVILEGES
	{
	public function __construct()
		{
		$this->CONFIG = new CONFIG();
		$this->RMP_CONFIG = new RMP_CONFIG();
		$this->PAGING = new Paging();
		$this->MYSQL = new MYSQL();
		$this->SISTEM = new SISTEM();
		}

	// ######################################################
	// Model penulisan  code develop versi  Oktober 2016

	private	function control($params)
		{
		$result = $this->user_login($params['data_http']);
		if (empty($result['USER_NAME']) and (!in_array('nonlogin', explode('_', $params['case']))))
			{
			$this->text_msg = "Pengguna tidak dikenal";
			$this->pesan = "gagal";
			return $this;
			exit();
			}

		// --PRIVILEGES CEK---//

		$user_privileges = $this->user_privileges($params['data_http'], strtolower(get_class($this)) , $params['case']);
		if ($user_privileges['pesan'] == "gagal")
			{
			$this->text_msg = $user_privileges['text_msg'];
			$this->pesan = $user_privileges['pesan'];
			$this->queries = $user_privileges['queries'];
			$this->queries['modul'] = $user_privileges['queries']['modul'];
			}
		  else
			{
			$this->text_msg = "OK";
			$this->pesan = "sukses";
			}

		return $this;
		exit;

		// --END PRIVILEGES CEK---//

		}
		private function pagging($params){
			//--PAGGING BOTTON-->
			if(empty($params['sql']))
			{
				$this->MYSQL=new MYSQL();
				$this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
				$this->MYSQL->tabel=$params['tabel'];
				$this->MYSQL->kolom="count(RECORD_STATUS) as JUMLAH";
				$this->MYSQL->dimana=$params['dimana_default'];
				$result=$this->MYSQL->data()[0];
				$this->jmlhalaman = $this->PAGING->jumlahHalaman($result['JUMLAH'], $params['batas']);
			}else
			{
				$this->MYSQL=new MYSQL();
				$this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
				$this->MYSQL->queri=$params['sql'];
				$result=$this->MYSQL->data();
				$this->jmlhalaman = $this->PAGING->jumlahHalaman(count($result), $params['batas']);
			}
			return $this;
		}//end pagging

		private function auto_increatement_number($params){
 	 	$n=new auto_nomor();
 	 	$n->no_aktif=$params['aktif'];
 	 	$n->panjang=4;
 	 	$no=$n->nomor_urut();
 	 	return $no;
 	 }

		private function buat_nomor_faktur($params){

			$jenis_barang=$params['ICD_BARANG_JENIS'];
			$tanggal=Date('mY');
				$this->MYSQL=new MYSQL();
				$this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
				$this->MYSQL->queri="select RMP_FAKTUR_NO_FAKTUR from RMP_FAKTUR where (RMP_FAKTUR_NO_FAKTUR like'%".$tahunWo."%' and RMP_FAKTUR_NO_FAKTUR like'%KB%') and RECORD_STATUS='A' order by RMP_FAKTUR_NO_FAKTUR desc";
				$cek_nomor=$this->MYSQL->data();
				if(empty($cek_nomor))
				{
					$nomor='0001/KB/'.$tanggal;
				}else
				{
					//CEK NOMOR TERAKHIR DI TAHUN YANG SAMA
					$this->MYSQL=new MYSQL();
					$this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
					$this->MYSQL->queri="select RMP_FAKTUR_NO_FAKTUR from RMP_FAKTUR where (RMP_FAKTUR_NO_FAKTUR like'%".$tanggal."%' and RMP_FAKTUR_NO_FAKTUR like'%KB%') and RECORD_STATUS='A' order by RMP_FAKTUR_NO_FAKTUR desc LIMIT 1";
					$cek_nomor2=$this->MYSQL->data();
					$nomorBaru=explode("/",$cek_nomor2[0]['RMP_FAKTUR_NO_FAKTUR']);
					$nomorBaruNya=($nomorBaru[0])+1;
					$nomor=$this->auto_increatement_number(array('aktif'=>$nomorBaruNya)).'/KB/'.$tanggal;
				}
			/*
			}
			*/
			$this->callback['nomor']=$nomor;
			return $this;
		}//end presensi_proposal_nomor_create()

	// nomor urut pkp

	private	function module($params)
		{

		$user_login = $this->SISTEM->user(array(
			'data_http' => $params['data_http']
		))->login_info;
		$input = $params['input_option'];

		switch (strtolower($params['case']))
			{
		case 'nonlogin_sel_kabupaten':
			require_once ("supplier/sel_kabupaten.php");
		break;

		case 'nonlogin_sel_kecamatan':
			require_once ("supplier/sel_kecamatan.php");
		break;
		case 'nonlogin_sel_desa':
			require_once ("supplier/sel_desa.php");
		break;
		case 'nonlogin_add_personal':
			require_once ("supplier/add_personal.php");
		break;
		case 'nonlogin_add_asisten':
			require_once ("supplier/add_asisten.php");
		break;
		case 'nonlogin_supplier_list':
			require_once ("supplier/supplier_list.php");
		break;
		case 'nonlogin_master_supplier_list':
			require_once ("supplier/master_supplier_list.php");
		break;
		case 'nonlogin_add_pengirim':
			require_once ("supplier/add_pengirim.php");
		break;
		case 'nonlogin_pengirim_list':
			require_once ("supplier/pengirim_list.php");
		break;
		case 'nonlogin_add_pengepul':
			require_once ("supplier/add_pengepul.php");
		break;
		case 'nonlogin_pengepul_list':
			require_once ("supplier/pengepul_list.php");
		break;
		case 'nonlogin_add_wilayah':
			require_once ("supplier/add_wilayah.php");
		break;
		case 'nonlogin_wilayah_list':
			require_once ("supplier/wilayah_list.php");
		break;
		case 'nonlogin_add_rekening':
			require_once ("supplier/add_rekening.php");
		break;
		case 'nonlogin_add_rekening_relasi':
			require_once ("supplier/add_rekening_relasi.php");
		break;
		case 'nonlogin_hapus_rekening_relasi':
			require_once ("supplier/hapus_rekening_relasi.php");
		break;
		case 'nonlogin_hapus_rekening':
			require_once ("supplier/hapus_rekening.php");
		break;
		case 'nonlogin_hapus_wilayah':
			require_once ("supplier/hapus_wilayah.php");
		break;
		case 'nonlogin_hapus_asisten':
			require_once ("supplier/hapus_asisten.php");
		break;
		case 'nonlogin_hapus_toleransi_mutu':
			require_once ("supplier/hapus_toleransi_mutu.php");
		break;
		case 'nonlogin_hapus_kontak':
			require_once ("supplier/hapus_kontak.php");
		break;
		case 'nonlogin_hapus_keluarga':
			require_once ("supplier/hapus_keluarga.php");
		break;
		case 'nonlogin_rekening_list':
			require_once ("supplier/rekening_list.php");
		break;
		case 'nonlogin_rekening_relasi_list':
			require_once ("supplier/rekening_relasi_list.php");
		break;
		case 'nonlogin_add_kontak':
			require_once ("supplier/add_kontak.php");
		break;
		case 'nonlogin_kontak_list':
			require_once ("supplier/kontak_list.php");
		break;
		case 'nonlogin_add_keluarga':
			require_once ("supplier/add_keluarga.php");
		break;
		case 'nonlogin_keluarga_list':
			require_once ("supplier/keluarga_list.php");
		break;
		case 'nonlogin_asisten_list':
			require_once ("supplier/asisten_list.php");
		break;
		case 'nonlogin_dokumen_list':
			require_once ("supplier/dokumen_list.php");
		break;
		case 'nonlogin_toleransi_mutu_list':
			require_once ("supplier/toleransi_mutu_list.php");
		break;
		case 'nonlogin_add_penyesuaian_harga_gl':
			require_once ("penyesuaian_harga/add_penyesuaian_harga_gl.php");
		break;
		case 'nonlogin_add_penyesuaian_harga_kb':
			require_once ("penyesuaian_harga/add_penyesuaian_harga_kb.php");
		break;
		case 'nonlogin_add_penyesuaian_harga_licin':
			require_once ("penyesuaian_harga/add_penyesuaian_harga_licin.php");
		break;
		case 'nonlogin_add_toleransi_mutu':
			require_once ("supplier/add_toleransi_mutu.php");
		break;
		case 'nonlogin_data_personal_supplier':
			require_once ("supplier/data_personal_supplier.php");
		break;
		case 'nonlogin_data_personal_detail':
			require_once ("supplier/data_personal_detail.php");
		break;
		case 'nonlogin_sub_wilayah':
			require_once ("supplier/sub_wilayah.php");
		break;
		case 'nonlogin_add_dokumen':
			require_once ("supplier/add_dokumen.php");
		break;






		case 'nonlogin_konfigurasi_wilayah_list':
			require_once ("konfigurasi/konfigurasi_wilayah_list.php");
		break;
		case 'nonlogin_konfigurasi_add_wilayah':
			require_once ("konfigurasi/konfigurasi_add_wilayah.php");
		break;
		case 'nonlogin_konfigurasi_add_sub_wilayah':
			require_once ("konfigurasi/konfigurasi_add_sub_wilayah.php");
		break;
		case 'nonlogin_konfigurasi_material_list':
			require_once ("konfigurasi/konfigurasi_material_list.php");
		break;
		case 'nonlogin_konfigurasi_harga_list':
			require_once ("konfigurasi/konfigurasi_harga_list.php");
		break;
		case 'nonlogin_konfigurasi_harga_fc_list':
			require_once ("konfigurasi/konfigurasi_harga_fc_list.php");
		break;
		case 'nonlogin_konfigurasi_add_material':
			require_once ("konfigurasi/konfigurasi_add_material.php");
		break;
		case 'nonlogin_konfigurasi_add_harga':
			require_once ("konfigurasi/konfigurasi_add_harga.php");
		break;
		case 'nonlogin_konfigurasi_harga_fc_add':
			require_once ("konfigurasi/konfigurasi_harga_fc_add.php");
		break;
		case 'nonlogin_sub_wilayah_list':
			require_once ("konfigurasi/sub_wilayah_list.php");
		break;
		case 'nonlogin_petugas_list':
			require_once ("konfigurasi/petugas_list.php");
		break;
		case 'nonlogin_petugas_add':
			require_once ("konfigurasi/petugas_add.php");
		break;
		case 'nonlogin_sel_nama_karyawan':
			require_once ("konfigurasi/sel_nama_karyawan.php");
		break;










		case 'nonlogin_pilih_no_nota':
			require_once ("faktur/pilih_no_nota.php");
		break;
		case 'nonlogin_hasil_timbang_list':
			require_once ("faktur/hasil_timbang_list.php");
		break;
		case 'nonlogin_kirim_hasil_timbang':
			require_once ("faktur/kirim_hasil_timbang.php");
		break;
		case 'nonlogin_kembali_hasil_timbang':
			require_once ("faktur/kembali_hasil_timbang.php");
		break;
		case 'nonlogin_faktur_list':
			require_once ("faktur/faktur_list.php");
		break;
		case 'nonlogin_simpan_faktur':
			require_once ("faktur/simpan_faktur.php");
		break;
		case 'nonlogin_cetak_faktur':
			require_once ("faktur/cetak_faktur.php");
		break;
		case 'nonlogin_cetak_faktur_adm':
			require_once ("faktur/cetak_faktur_adm.php");
		break;
		case 'nonlogin_cetak_faktur_kp':
			require_once ("faktur_kp/cetak_faktur_kp.php");
		break;

		case 'nonlogin_sel_nama_supplier':
			require_once ("faktur/sel_nama_supplier.php");
		break;
		case 'nonlogin_sel_operator_timbang':
			require_once ("faktur/sel_operator_timbang.php");
		break;
		case 'nonlogin_sel_inspektur_mutu':
			require_once ("faktur/sel_inspektur_mutu.php");
		break;
		case 'nonlogin_sel_id_faktur_cabang':
			require_once ("faktur/sel_id_faktur_cabang.php");
		break;
		case 'nonlogin_lihat_faktur':
			require_once ("faktur/lihat_faktur.php");
		break;
		case 'nonlogin_edit_faktur':
			require_once ("faktur/edit_faktur.php");
		break;
		case 'nonlogin_simpan_manual_nota':
			require_once ("faktur/simpan_manual_nota.php");
		break;
		case 'nonlogin_cek_nomor_faktur':
			require_once ("faktur/cek_nomor_faktur.php");
		break;


		case 'nonlogin_pilih_no_nota_kp':
			require_once ("faktur_kp/pilih_no_nota_kp.php");
		break;
		case 'nonlogin_hasil_timbang_list_kp':
			require_once ("faktur_kp/hasil_timbang_list_kp.php");
		break;
		case 'nonlogin_kirim_hasil_timbang_kp':
			require_once ("faktur_kp/kirim_hasil_timbang_kp.php");
		break;
		case 'nonlogin_kembali_hasil_timbang_kp':
			require_once ("faktur_kp/kembali_hasil_timbang_kp.php");
		break;
		case 'nonlogin_faktur_list_kp':
			require_once ("faktur_kp/faktur_list_kp.php");
		break;
		case 'nonlogin_simpan_faktur_kp':
			require_once ("faktur_kp/simpan_faktur_kp.php");
		break;
		// case 'nonlogin_cetak_faktur':
		// 	require_once ("faktur/cetak_faktur.php");
		// break;
		// case 'nonlogin_cetak_faktur_adm':
		// 	require_once ("faktur/cetak_faktur_adm.php");
		// break;
		//
		// case 'nonlogin_sel_nama_supplier':
		// 	require_once ("faktur/sel_nama_supplier.php");
		// break;
		// case 'nonlogin_sel_operator_timbang':
		// 	require_once ("faktur/sel_operator_timbang.php");
		// break;
		// case 'nonlogin_sel_inspektur_mutu':
		// 	require_once ("faktur/sel_inspektur_mutu.php");
		// break;
		// case 'nonlogin_sel_id_faktur_cabang':
		// 	require_once ("faktur/sel_id_faktur_cabang.php");
		// break;
		// case 'nonlogin_lihat_faktur':
		// 	require_once ("faktur/lihat_faktur.php");
		// break;
		// case 'nonlogin_edit_faktur':
		// 	require_once ("faktur/edit_faktur.php");
		// break;
		// case 'nonlogin_simpan_manual_nota':
		// 	require_once ("faktur/simpan_manual_nota.php");
		// break;
		// case 'nonlogin_cek_nomor_faktur':
		// 	require_once ("faktur/cek_nomor_faktur.php");
		// break;



		case 'nonlogin_sel_material':
			require_once ("penyesuaian_harga/sel_material.php");
		break;
		case 'nonlogin_penyesuaian_harga_gl_list':
			require_once ("penyesuaian_harga/penyesuaian_harga_gl_list.php");
		break;
		case 'nonlogin_penyesuaian_harga_kb_list':
			require_once ("penyesuaian_harga/penyesuaian_harga_kb_list.php");
		break;
		case 'nonlogin_penyesuaian_harga_licin_list':
			require_once ("penyesuaian_harga/penyesuaian_harga_licin_list.php");
		break;
		case 'nonlogin_hapus_penyesuaian_harga_gl':
			require_once ("penyesuaian_harga/hapus_penyesuaian_harga_gl.php");
		break;
		case 'nonlogin_supplier_list_gl':
			require_once ("penyesuaian_harga/supplier_list_gl.php");
		break;
		case 'nonlogin_supplier_list_kb':
			require_once ("penyesuaian_harga/supplier_list_kb.php");
		break;
		case 'nonlogin_supplier_list_licin':
			require_once ("penyesuaian_harga/supplier_list_licin.php");
		break;
		case 'nonlogin_perbarui_harga':
			require_once ("penyesuaian_harga/perbarui_harga.php");
		break;



		case 'nonlogin_list_gl_a':
			require_once ("faktur_cabang/list_gl_a.php");
		break;
		case 'nonlogin_list_gl_b':
			require_once ("faktur_cabang/list_gl_b.php");
		break;
		case 'nonlogin_list_gl_c':
			require_once ("faktur_cabang/list_gl_c.php");
		break;
		case 'nonlogin_add_gl_a':
			require_once ("faktur_cabang/add_gl_a.php");
		break;
		case 'nonlogin_nama_supplier':
			require_once ("faktur_cabang/nama_supplier.php");
		break;
		case 'nonlogin_add_faktur_cabang':
			require_once ("faktur_cabang/add_faktur_cabang.php");
		break;
		case 'nonlogin_list_faktur_cabang':
			require_once ("faktur_cabang/list_faktur_cabang.php");
		break;
		case 'nonlogin_list_review_faktur_cabang_a':
			require_once ("faktur_cabang/list_review_faktur_cabang_a.php");
		break;
		case 'nonlogin_list_review_faktur_cabang_b':
			require_once ("faktur_cabang/list_review_faktur_cabang_b.php");
		break;
		case 'nonlogin_list_review_faktur_cabang_c':
			require_once ("faktur_cabang/list_review_faktur_cabang_c.php");
		break;
		case 'nonlogin_hapus_detail_rekap':
			require_once ("faktur_cabang/hapus_detail_rekap.php");
		break;
		case 'nonlogin_simpanreview':
			require_once ("faktur_cabang/simpanreview.php");
		break;
		case 'nonlogin_list_cabang_proses_a':
			require_once ("faktur_cabang/list_cabang_proses_a.php");
		break;
		case 'nonlogin_list_cabang_proses_b':
			require_once ("faktur_cabang/list_cabang_proses_b.php");
		break;
		case 'nonlogin_list_cabang_proses_c':
			require_once ("faktur_cabang/list_cabang_proses_c.php");
		break;
		case 'nonlogin_ambil_data_proses':
			require_once ("faktur_cabang/ambil_data_proses.php");
		break;
		case 'nonlogin_simpan_edit_proses':
			require_once ("faktur_cabang/simpan_edit_proses.php");
		break;
		case 'nonlogin_hapus_proses':
			require_once ("faktur_cabang/hapus_proses.php");
		break;








		case 'nonlogin_faktur_list_purchaser':
			require_once ("purchaser/faktur_list_purchaser.php");
		break;
		case 'nonlogin_faktur_detail_list':
			require_once ("purchaser/faktur_detail_list.php");
		break;
		case 'nonlogin_sel_nama_supplier_rek':
			require_once ("purchaser/sel_nama_supplier_rek.php");
		break;
		case 'nonlogin_sel_nama_supplier_rek_kp':
			require_once ("purchaser/sel_nama_supplier_rek_kp.php");
		break;
		case 'nonlogin_add_faktur_purchaser':
			require_once ("purchaser/add_faktur_purchaser.php");
		break;
		case 'nonlogin_add_faktur_purchaser_kp':
			require_once ("purchaser/add_faktur_purchaser_kp.php");
		break;
		case 'nonlogin_batalkan_kalkulasi':
			require_once ("purchaser/batalkan_kalkulasi.php");
		break;
		case 'nonlogin_add_verifikasi_harga':
			require_once ("purchaser/add_verifikasi_harga.php");
		break;
		case 'nonlogin_detail_purchaser':
			require_once ("purchaser/detail_purchaser.php");
		break;




		case 'nonlogin_verifikasi_harga_list':
			require_once ("verifikasi_harga/verifikasi_harga_list.php");
		break;
		case 'nonlogin_verifikasi_action':
			require_once ("verifikasi_harga/verifikasi_action.php");
		break;



		case 'nonlogin_laporan_faktur':
			require_once ("laporan/laporan_faktur.php");
		break;
		case 'nonlogin_total_laporan':
			require_once ("laporan/total_laporan.php");
		break;
		case 'nonlogin_kirim_pembukuan':
			require_once ("laporan/kirim_pembukuan.php");
		break;





		case 'nonlogin_list_faktur_cabang_a':
			require_once ("faktur_cabang_adm/list_faktur_cabang_a.php");
		break;
		case 'nonlogin_list_faktur_cabang_b':
			require_once ("faktur_cabang_adm/list_faktur_cabang_b.php");
		break;
		case 'nonlogin_list_faktur_cabang_c':
			require_once ("faktur_cabang_adm/list_faktur_cabang_c.php");
		break;





		case 'nonlogin_cetak_laporan_harian_02':
			require_once ("laporan/cetak_laporan_harian_02.php");
		break;
		case 'nonlogin_cetak_laporan_harian_03':
			require_once ("laporan/cetak_laporan_harian_03.php");
		break;
			// ---------------------end case-----------------------------//

		default:
			$this->callback['respon']['pesan'] = "gagal";
			$this->callback['respon']['text_msg'] = "Case tidak ditemukan ";
			$this->callback['respon']['help'] = "Sistem tidak menemukan case " . $params['case'];
			break;
			}
		return $this;
		}
	public function load($params)
		{
		if ($this->control($params)->pesan == 'sukses')
			{

			$result = $this->module($params)->callback;
			}
		  else
			{

			$result['respon']['pesan'] = $this->control($params)->pesan;
			$result['respon']['text_msg'] = $this->control($params)->text_msg;
			}

		return $result;
		}


		public function show()
			{
				$cf=$GLOBALS['cf'];

				//--extraxt cr_data--//
				$cr_data=json_decode($this->post_cr_data,true);

				//--data opsional--//
				$case=$cr_data['case'];
				$batas=$cr_data['batas'];
				$halaman=$cr_data['halaman'];
				$data_array=$cr_data['data'];

				//--data kontroler untuk halaman--//
				if(empty($halaman) OR $halaman=="undefined"){ $halaman=1; }else{ $halaman=$halaman; }

				//--PRIVILEGES CEK---//
				$user_privileges=$this->user_privileges($cr_data['user_privileges_data'],strtolower(get_class($this)),$case);
				if($user_privileges['pesan']=="gagal")
				{
					$callback['text_msg']=$user_privileges['text_msg'];
					$callback['pesan']=$user_privileges['pesan'];
					$callback['queries']=$user_privileges['queries'];
					$callback['queries']['modul']=$user_privileges['queries']['modul'];
					return $callback;
					exit();
				}
				//--END PRIVILEGES CEK---//


				//info user login
				$user_login=$this->user_login($cr_data['user_privileges_data']);


				//--CASE MODUL--//
				switch($case){
					case 'nonlogin_data_443_detail' :

						//--setting--//
						$tabel="RMP_MASTER_PERSONAL";
						$dimana_default="WHERE RMP_MASTER_PERSONAL_ID='".$data_array['ID_SUPPLIER']."' AND RECORD_STATUS='A'";

						$db=new db();
						$db->database=$cf['db_nama'];
						$db->tabel=$tabel;
						$db->kolom="*";
						$db->dimana=$dimana_default;
						//$db->batas="LIMIT $posisi,$batas";
						//$db->urut="ORDER BY a.JUMLAH_SUARA_SAH DESC";
						$refs=$db->data();
						$no=$posisi+1;
						foreach($refs as $r){

						$r['NO']=$no;
						$refsee[]=$r;
						$no++;
						}//--end foreach


						if(empty($refs)){
							$pesan="gagal";
							$text_msg="Data Tidak ada";
						}else{
							$pesan="sukses";
							$text_msg="Load..";
						}

				break;
					case 'nonlogin_detail_faktur_cabang' :

						//--setting--//
						$tabel="RMP_REKAP_FC";
						$dimana_default="WHERE RMP_REKAP_FC_ID='".$data_array['ID_FAKTUR_CABANG']."' AND RECORD_STATUS='A'";

						$db=new db();
						$db->database=$cf['db_nama'];
						$db->tabel=$tabel;
						$db->kolom="*";
						$db->dimana=$dimana_default;
						//$db->batas="LIMIT $posisi,$batas";
						//$db->urut="ORDER BY a.JUMLAH_SUARA_SAH DESC";
						$refs=$db->data();
						$no=$posisi+1;
						foreach($refs as $r){

						$r['NO']=$no;
						$refsee[]=$r;
						$no++;
						}//--end foreach


						if(empty($refs)){
							$pesan="gagal";
							$text_msg="Data Tidak ada";
						}else{
							$pesan="sukses";
							$text_msg="Load..";
						}

				break;
				}
						//---JSON DATA----//
				$callback['text_msg']=$text_msg;
				$callback['pesan']=$pesan;
				$callback['header_location']=$header_location;
				$callback['queries']=$cr_data;
				$callback['refs']=$refsee;
				$callback['user_privileges']=$user_privileges;
				$callback['user_login']=$user_login;
				$callback['jml_halaman']=$jmlhalaman;

				return $callback; //--output
			}

	}

?>
