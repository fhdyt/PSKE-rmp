<?php
  $RMP_CONFIG=new RMP_CONFIG();
  $SISTEM_CONFIG=new SISTEM_CONFIG();
?>

 <style>
 .table-small
 {
 	font-size: 12px;
 }

 .loader
 {
   border: 5px solid #f3f3f3;
   border-radius: 50%;
   border-top: 5px solid #3498db;
   width: 40px;
   height: 40px;
   -webkit-animation: spin 2s linear infinite; /* Safari */
   animation: spin 2s linear infinite;
 }

 /* Safari */
 @-webkit-keyframes spin
 {
   0% { -webkit-transform: rotate(0deg); }
   100% { -webkit-transform: rotate(360deg); }
 }

 @keyframes spin
 {
   0% { transform: rotate(0deg); }
   100% { transform: rotate(360deg); }
 }

 /* table{
 font-size: 12px;
 }
 table-detail{
 font-size: 9px;
 } */

 .modalMD
 {
   width:1000px;
 }
 .modalFakturList
 {
   width:1200px;
 }



 </style>
 <div class="row">
 	<div class="col-lg-12 col-md-12">
 		<div class="list-group">


      <div class="box box-solid form_faktur">
        <div class="box-body">
      <div class="row">

      	<div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <h2>Kopra</h2>
              <hr>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <a class="btn btn-warning lihat_faktur btn-sm" type="button"><i class="fa fa-list-ol" aria-hidden="true"></i> Faktur</a>
              <a class="btn btn-success buat_faktur_baru btn-sm" type="button" style="display:none;" href="?show=rmp/faktur"><i class="fa fa-plus" aria-hidden="true"></i> Buat Faktur Baru</a>
              <a class="btn btn-default cetak_faktur btn-sm" type="button" style="display:none;"><i class="fa fa-print" aria-hidden="true"></i> Cetak Faktur</a>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <div class="callout callout-warning warning_faktur" hidden>
                  <h4>Faktur telah diproses oleh Purchaser!</h4>

                  <p>Anda tidak dapat melakukan perubahan.</p>
                </div>
            </div>
          </div>

      		<div class="row form_faktur_hasil_timbang">

      			<div class="col-md-6">
      				<div class="small-box bg-aqua">
      					<div class="inner">
      						<p class="NO_FAKTUR" style="font-size:40px">-</p>
      						<p>No. Faktur</p>
      					</div>
      					<div class="icon">
      						<i class="fa fa-file-text"></i>
      					</div>
      				</div>
      			</div>
      			<div class="col-md-6">
      				<div class="small-box bg-green">
      					<div class="inner">
      						<p class="NO_NOTA_INPUT" style="font-size:40px">0</p>
      						<p>No. Nota</p>
      					</div>
      					<div class="icon">
      						<i class="fa fa-file-text-o"></i>
      					</div>
      				</div>
      			</div>
      		</div>
          <form id="faktur_detail">
      		<div class="row">

            <!-- <div class="form_faktur_cabang" hidden>
            <div class="col-md-4">
            <div class="form-group" >
              <label for="exampleInputEmail1">ID Faktur Cabang</label> <select class="ID_FAKTUR_CABANG selectpicker with-ajax-personal form-control" data-live-search="true" id="ID_FAKTUR_CABANG" name="ID_FAKTUR_CABANG" onchange="id_faktur_cabang()">
              </select>
              <p class="help-block">Pilih ID Faktur Cabang Purchaser.</p>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group" >
              <label for="exampleInputEmail1">PS Cabang</label><input autocomplete="off" class="form-control PS_CABANG" id="PS_CABANG" name="PS_CABANG" placeholder="PS_CABANG" type="text" readonly>
              <p class="help-block">Pilih ID Faktur Cabang Purchaser.</p>
            </div>
            </div>
            <div class="col-md-4">
              <div class="form-group" >
                <label for="exampleInputEmail1">Tanggal</label><input autocomplete="off" class="form-control TANGGAL_REKAP_FAKTUR_CABANG" id="TANGGAL_REKAP_FAKTUR_CABANG" name="TANGGAL_REKAP_FAKTUR_CABANG" placeholder="TANGGAL_REKAP_FAKTUR_CABANG" type="text" readonly>
                <p class="help-block">Tanggal rekap faktur cabang.</p>
              </div>
            </div>
            </div> -->

            <div class="form_faktur_hasil_timbang">
              <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Bulan</label>
                <select class="form-control BULAN_NOTA" onchange="onchange_pilih_nota()">
                  <option value="01" <?php if (date("m")=="01"){echo "selected";} ?>>Januari</option>
                  <option value="02" <?php if (date("m")=="02"){echo "selected";} ?>>Februari</option>
                  <option value="03" <?php if (date("m")=="03"){echo "selected";} ?>>Maret</option>
                  <option value="04" <?php if (date("m")=="04"){echo "selected";} ?>>April</option>
                  <option value="05" <?php if (date("m")=="05"){echo "selected";} ?>>Mei</option>
                  <option value="06" <?php if (date("m")=="06"){echo "selected";} ?>>Juni</option>
                  <option value="07" <?php if (date("m")=="07"){echo "selected";} ?>>Juli</option>
                  <option value="08" <?php if (date("m")=="08"){echo "selected";} ?>>Agusutus</option>
                  <option value="09" <?php if (date("m")=="09"){echo "selected";} ?>>September</option>
                  <option value="10" <?php if (date("m")=="10"){echo "selected";} ?>>Oktober</option>
                  <option value="11" <?php if (date("m")=="11"){echo "selected";} ?>>November</option>
                  <option value="12" <?php if (date("m")=="12"){echo "selected";} ?>>Desember</option>
                </select>
                <p class="help-block">Bulan Nota.</p>
              </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tahun</label>
                <select class="form-control TAHUN_NOTA" onchange="onchange_pilih_nota()">
                  <option value="2018" <?php if (date("Y")=="2018"){echo "selected";} ?> >2018</option>
                  <option value="2019" <?php if (date("Y")=="2019"){echo "selected";} ?> >2019</option>
                  <option value="2020" <?php if (date("Y")=="2020"){echo "selected";} ?> >2020</option>
                  <option value="2021" <?php if (date("Y")=="2021"){echo "selected";} ?> >2021</option>
                  <option value="2022" <?php if (date("Y")=="2022"){echo "selected";} ?> >2022</option>
                  <option value="2033" <?php if (date("Y")=="2023"){echo "selected";} ?> >2023</option>
                  <option value="2024" <?php if (date("Y")=="2024"){echo "selected";} ?> >2024</option>
                  <option value="2025" <?php if (date("Y")=="2025"){echo "selected";} ?> >2025</option>
                </select>
                <p class="help-block">Tahun Nota.</p>
              </div>
              </div>
            <div class="col-md-3">
            <div class="form-group">
              <label for="exampleInputEmail1">No. Faktur</label>
              <input autocomplete="off" class="form-control NO_FAKTUR" id="NO_FAKTUR" name="NO_FAKTUR" placeholder="NO_FAKTUR" onkeyup="no_faktur_keyup()" type="text" >
              <p class="help-block ck_no_faktur">Jika kosong no faktur otomatis muncul.</p>
            </div>
            </div>
            <div class="col-md-3">
            <div class="form-group">
              <label for="exampleInputEmail1">Nomor Nota</label>
              <select class="NO_NOTA form-control select2" style="width: 100%;" id="NO_NOTA" name="NO_NOTA" onchange="no_nota()">
              </select>
              <p class="help-block"><a href="https://isea-trial.sambu.co.id/cron/timbangan_pkb.php">Ambil data Timbang</a></p>
            </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Nota</label>
                <input autocomplete="off" class="form-control NAMA_NOTA" id="NAMA_NOTA" name="NAMA_NOTA" type="text" readonly>
                <input autocomplete="off" class="form-control ID_FAKTUR" id="ID_FAKTUR" name="ID_FAKTUR" placeholder="ID_FAKTUR" type="hidden" >
                <input autocomplete="off" class="form-control JENIS_KELAPA" id="JENIS_KELAPA" name="JENIS_KELAPA" placeholder="JENIS_KELAPA" type="hidden" value="KOPRA" >
                <input autocomplete="off" class="form-control JENIS_FAKTUR" id="JENIS_FAKTUR" name="JENIS_FAKTUR" placeholder="JENIS_FAKTUR" type="hidden" >

                <p class="help-block">Nama Supplier Pada Nota Timbang.</p>
              </div>

          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="exampleInputEmail1">Kapal</label>
              <input autocomplete="off" class="form-control KAPAL_FAKTUR" id="KAPAL_FAKTUR" name="KAPAL_FAKTUR" placeholder="KAPAL_FAKTUR" type="text" >
              <p class="help-block">Nama Kapal.</p>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Supplier</label>
              <select class="NAMA_SUPPLIER with-ajax-personal form-control" data-live-search="true" id="NAMA_SUPPLIER" name="NAMA_SUPPLIER" onchange="sel_nama_supplier()">
              </select>
              <p class="help-block">Nama Supplier Untuk Faktur.</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Petani</label>
              <input autocomplete="off" class="form-control NAMA_PETANI" id="NAMA_PETANI" name="NAMA_PETANI"  type="text" >
              <p class="help-block">Nama Petani Untuk Faktur.</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="exampleInputEmail1">Alamat</label>
              <input autocomplete="off" class="form-control ALAMAT_SUPPLIER" id="ALAMAT_SUPPLIER" name="ALAMAT_SUPPLIER"  type="text" >
              <p class="help-block">Alamat Petani Untuk Faktur.</p>
            </div>
          </div>

            </div>
      		</div>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="exampleInputEmail1">Tanggal</label>
                <input autocomplete="off" class="form-control TANGGAL_FAKTUR datepicker" id="TANGGAL_FAKTUR" name="TANGGAL_FAKTUR" placeholder="" type="text" value="<?php echo date("Y/m/d"); ?>">
                <p class="help-block">Tanggal faktur.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="exampleInputEmail1">Operator Timbang</label><select class="OPERATOR_TIMBANG with-ajax-personal form-control" data-live-search="true" id="OPERATOR_TIMBANG" name="OPERATOR_TIMBANG" onchange="sel_operator_timbang()">
                </select>
                <p class="help-block">Nama Operator Timbang.</p>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="exampleInputEmail1">Inspektur Mutu</label><select class="INSPEKTUR_MUTU with-ajax-personal form-control" data-live-search="true" id="INSPEKTUR_MUTU" name="INSPEKTUR_MUTU" onchange="sel_inspektur_mutu()">
                </select>
                <p class="help-block">Nama Inspektur Mutu.</p>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="exampleInputEmail1">Kualitet</label> <input autocomplete="off" class="form-control KUALITET" id="KUALITET" name="KUALITET" placeholder="POTONGAN" value="0" type="number">
                <p class="help-block">Kualitet %</p>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="exampleInputEmail1">Goni</label> <input autocomplete="off" class="form-control GONI" id="GONI" name="GONI" placeholder="GONI" value="0" type="number">
                <p class="help-block">Total Goni</p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2">
              <!-- <input type="checkbox" name="CEK_DITERIMA"> Bisa Diterima
              <input type="checkbox" name="CEK_100_INSPEKSI"> 100 % Inspeksi
              <input type="checkbox" name="CEK_DIPISAH"> Dipisah -->
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="CEK_DITERIMA" class="CEK_DITERIMA"> Bisa Diterima
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="CEK_KOTORAN" class="CEK_KOTORAN"> Kotoran KG/Goni
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="CEK_100_INSPEKSI" class="CEK_100_INSPEKSI"> 100 % Inspeksi
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="CEK_LANGSUNG_PROSES" class="CEK_LANGSUNG_PROSES"> Langsung Proses
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="CEK_DIPISAH" class="CEK_DIPISAH"> Dipisah
                </label>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="exampleInputEmail1">Catatan Purchaser</label>
                <textarea class="CATATAN_PURCHASER form-control" id="CATATAN_PURCHASER" rows="3" name="CATATAN_PURCHASER"></textarea>
                <p class="help-block">Catatan untuk Purchaser.</p>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="exampleInputEmail1">Catatan Supplier</label>
                <textarea class="CATATAN_SUPPLIER form-control" id="CATATAN_SUPPLIER" rows="3" name="CATATAN_SUPPLIER"></textarea>
                <p class="help-block">Catatan untuk Supplier.</p>
              </div>
            </div>
          </div>
        </form>
      	</div>
      </div>
      </div>
      </div>



      <div class="row form_faktur_hasil_timbang">
      	<div class="col-md-6">
      		<div class="box box-solid">
      			<div class="box-body">
      				<div class="box box-default">
      					<div class="box-header with-border">
      						<h3 class="box-title">Hasil Timbang</h3>
      					</div>
      					<div class="box-body">

      						<div class="form-group" hidden="">
      							<label for="TANGGAL">Tanggal</label> <input autocomplete="off" class="form-control TANGGAL_NOTA datepicker" id="TANGGAL_NOTA" name="TANGGAL_NOTA" onchange="onchange_pilih_nota()" placeholder="TANGGAL" type="text" value="<?php echo date('Y-m-d'); ?>"> <small class="help-block">Tanggal No Nota</small>
      						</div>
      						<!-- <div class="small-box bg-yellow">
      							<div class="inner">
      								<p class="total_timbang" style="font-size:40px">0</p>
      								<p>Total</p>
      							</div>
      							<div class="icon">
      								<i class="fa fa-balance-scale"></i>
      							</div>
      						</div> -->
      							<table class="table table-small table-bordered">
      								<thead>
      									<tr>
      										<th>No.</th>
      										<th>Tanggal / Jam</th>
      										<th>Gross</th>
      										<th>Jenis Kelapa</th>
      										<th>Ponton</th>
      									</tr>
      								</thead>
      								<tbody id="zone_data">
      									<tr>
      										<td colspan="9">
      											<center>
      												<div class="loader"></div>
      											</center>
      										</td>
      									</tr>
      								</tbody>
      							</table>
      						<!-- <div class="text-left">
      							<a class="btn btn-success buat_faktur">Buat Faktur</a>
      						</div> -->
      					</div>
      				</div>
      			</div>
      		</div>
      	</div>
      	<div class="col-md-6">
      		<div class="box box-solid">
      			<div class="box-body">
      				<div class="box box-default">
      					<div class="box-header with-border">
      						<h3 class="box-title">Faktur</h3>
      					</div>
      					<div class="box-body">
      						<div class="small-box bg-yellow">
      							<div class="inner">
      								<p class="total_timbang" style="font-size:40px">0</p>
      								<p>Total</p>
      							</div>
      							<div class="icon">
      								<i class="fa fa-balance-scale"></i>
      							</div>
      						</div>
                  <a class="btn btn-primary btn-sm tambah_manual_nota"><i class="fa fa-plus"></i> Tambah Data Faktur</a>
                </br>
                </br>
      						<table id="faktur" class="table table-small table-bordered">
      							<thead>
      								<tr>
      									<th>No.</th>
      									<th>Tanggal / Jam</th>
      									<th>Gross</th>
      									<th>Jenis Kelapa</th>
      									<th></th>
      								</tr>
      							</thead>
      							<tbody id="zone_data_faktur">
      								<tr>
      									<td colspan="9">
      										<center>
      											<div class="loader"></div>
      										</center>
      									</td>
      								</tr>
      							</tbody>
      						</table>
                  <br>
      						<div class="text-left">
      							 <button class="btn btn-success simpan_faktur" type="button">Simpan Faktur</button>
                     <!-- <a class="btn btn-default btn_lihat_faktur" style="display:none;"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a> -->
                     <a class="btn btn-default btn_cetak_faktur" style="display:none;"><i class="fa fa-print" aria-hidden="true"></i> Cetak</a>
      						</div>
      					</div>
      				</div>
      			</div>
      		</div>
      	</div>
      </div>
 		</div>
 	</div>
 </div>



 <div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalLihatFaktur" role="dialog" tabindex="-1">
 	<div class="modal-dialog modalFakturList" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
 				<h4 class="modal-title" id="myModalLabel">Faktur</h4>
 			</div>
 			<div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <p class="TOTAL_KELAPA_A" style="font-size:40px">0</p>
                <p>Kelapa A</p>
              </div>
              <div class="icon">
                <i>A</i>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="small-box bg-green">
              <div class="inner">
                <p class="TOTAL_KELAPA_B" style="font-size:40px">0</p>
                <p>Kelapa B</p>
              </div>
              <div class="icon">
                <i>B</i>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="small-box bg-yellow">
              <div class="inner">
                <p class="TOTAL_KELAPA_C" style="font-size:40px">0</p>
                <p>Kelapa C</p>
              </div>
              <div class="icon">
                <i>C</i>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-right">
            <form id="form_filter" class="form-inline" method="POST" action="javascript:filter();">
              <div class="form-group">
            <select id="FILTER_MATERIAL" name="FILTER_MATERIAL" type="text" class=" form-control FILTER_MATERIAL"  autocomplete="off" onchange="filter_tanggal_list()">
            <option value="ITD">--Pilih Material--</option>
            <option value="JAMBUL">JAMBUL</option>
            <option value="GELONDONG">GELONDONG</option>
            <option value="LICIN">LICIN</option>
                  </select>
                </div>
					<div class="form-group">
              <input type="date" id="FILTER_TANGGAL_LIST" class="form-control FILTER_TANGGAL_LIST" name="FILTER_TANGGAL" onchange="filter_tanggal_list()" value="<?php echo date("Y-m-d"); ?>"/>
          </div>
        </form>
          </div>
				</div>
        <br>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>No. Faktur</th>
              <th>No. Nota</th>
              <th>Nama</th>
              <th>Kelapa</th>
              <th>Bruto</th>
              <th>Potongan</th>
              <th>Netto</th>
              <th>Tanggal</th>
              <th></th>
              <th></th>

            </tr>
          </thead>
          <tbody id="zone_lihat_faktur">
            <tr>
              <td colspan="9">
                <center>
                  <div class="loader"></div>
                </center>
              </td>
            </tr>
          </tbody>
        </table>
 		</div>
 	</div>
 </div>
 </div>

 <!-- MODAL EDIT PROSES DATA -->
 <div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalManualNota" role="dialog" tabindex="-1">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
 				<h4 class="modal-title" id="myModalLabel">Tambah Data Faktur</h4>
 			</div>
 			<div class="modal-body">

 				<form action="javascript:download();" class="fDataManualNota form-horizontal" id="fDataManualNota" name="fDataManualNota">
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">No. Faktur</label>
                 <div class="col-sm-8">
                 <input autocomplete="off" class="form-control MANUAL_NO_FAKTUR form-control" id="MANUAL_NO_FAKTUR" name="MANUAL_NO_FAKTUR" placeholder="" type="text">
               </div>
               </div>
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">No. Nota Timbang</label>
                 <div class="col-sm-8">
                 <input autocomplete="off" class="form-control MANUAL_NO_NOTA" id="MANUAL_NO_NOTA" name="MANUAL_NO_NOTA" placeholder="" type="text">
               </div>
             </div>
             <div class="form-group">
               <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Tanggal</label>
               <div class="col-sm-8">
               <input autocomplete="off" class="form-control MANUAL_TANGGAL datepicker" id="MANUAL_TANGGAL" name="MANUAL_TANGGAL" placeholder="" type="text" value="<?php echo date("Y/m/d"); ?>">
             </div>
           </div>
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Material</label>
                 <div class="col-sm-8">
                 <select class="form-control MANUAL_MATERIAL" name="MANUAL_MATERIAL" id="MANUAL_MATERIAL">
                   <option value="JAMBUL">JAMBUL</option>
                   <option value="GELONDONG">GELONDONG</option>
                   <option value="LICIN">LICIN</option>
                 </select>
               </div>
             </div>
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Grade</label>
                 <div class="col-sm-8">
                   <select class="form-control MANUAL_GRADE" name="MANUAL_GRADE" id="MANUAL_GRADE">
                     <option value="A">A</option>
                     <option value="B">B</option>
                     <option value="C">C</option>
                   </select>
               </div>
             </div>
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Referensi</label>
                 <div class="col-sm-8">
                 <input autocomplete="off" class="form-control MANUAL_REF" id="MANUAL_REF" name="MANUAL_REF" placeholder="" type="number" value="" >
               </div>
             </div>
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Timbang</label>
                 <div class="col-sm-8">
                   <select class="form-control MANUAL_TIMBANG" name="MANUAL_TIMBANG" id="MANUAL_TIMBANG">
                     <option value="PTN-1">PTN-1</option>
                     <option value="PTN-2">PTN-2</option>
                     <option value="PTN-2">PTN-3</option>
                   </select>
               </div>
             </div>
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Gross</label>
                 <div class="col-sm-8">
                 <input autocomplete="off" class="form-control MANUAL_GROSS" id="MANUAL_GROSS" name="MANUAL_GROSS" placeholder="" type="number" onkeyup="kalkulasi_manual()">
               </div>
             </div>
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Tara</label>
                 <div class="col-sm-8">
                 <input autocomplete="off" class="form-control MANUAL_TARA" id="MANUAL_TARA" name="MANUAL_TARA" placeholder="" type="number" onkeyup="kalkulasi_manual()">
               </div>
             </div>
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Bruto</label>
                 <div class="col-sm-8">
                 <input autocomplete="off" class="form-control MANUAL_BRUTO" id="MANUAL_BRUTO" name="MANUAL_BRUTO" placeholder="" type="number" onkeyup="kalkulasi_manual()">
               </div>
             </div>
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Potongan</label>
                 <div class="col-sm-8">
                 <input autocomplete="off" class="form-control MANUAL_POTONGAN" id="MANUAL_POTONGAN" name="MANUAL_POTONGAN" placeholder="" type="number" onkeyup="kalkulasi_manual()">
               </div>
             </div>
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Netto</label>
                 <div class="col-sm-8">
                 <input autocomplete="off" class="form-control MANUAL_NETTO" id="MANUAL_NETTO" name="MANUAL_NETTO" placeholder="" type="number" onkeyup="kalkulasi_manual()">
               </div>
             </div>

               </form>

           <div class="row">
             <div class="col-md-12 text-right">
               <div class="form-group">
     						<button class="btn btn-success btn-sm SIMPAN_MANUAL_PROSES">Simpan</button>
     					</div>
             </div>
           </div>
 		</div>
 	</div>
 </div>
 </div>
 <!-- MODAL EDIT PROSES DATA -->

<script>
var delay = (function()
  {
    var timer = 0;
    return function(callback, ms)
    {
      clearTimeout(timer);
      timer = setTimeout(callback, ms);
    };
  })();

function no_faktur_keyup()
{
  var no_faktur = $("input.NO_FAKTUR").val()
    $(".simpan_faktur").attr("disabled", "disabled");
      $(".ck_no_faktur").html("<span class='text-danger'>Proses...</span>");
      delay(function()
      {
        //pad(NIKBH, 6);
        cek_no_faktur(no_faktur);
      }, 500);

  $("p.NO_FAKTUR").html(no_faktur)
  faktur_list()
}

function cek_no_faktur(no_faktur)
  {
    $.ajax({
      type: 'POST',
      url: refseeAPI,
      dataType: 'json',
      data: 'ref=cek_nomor_faktur&NO_FAKTUR=' + no_faktur,
      success: function(data)
      {
        if (data.respon.pesan == "sukses")
        {
          for (i = 0; i < data.result.length; i++)
          {
            $(".simpan_faktur").attr("disabled", "disabled");
            $(".ck_no_faktur").html("<span class='text-danger'><i class='fa fa-close' aria-hidden='true'></i> No Faktur Terdaftar, Coba Lagi</span>");
            }
        }
        else
        {
          $(".simpan_faktur").removeAttr("disabled");
          $(".ck_no_faktur").html("<span class='text-success'><i class='fa fa-check' aria-hidden='true'></i> No Faktur Dapat Digunakan</success>");
        }
      },
      error: function(x, e) {
        console.log("Error Ajax");
      } //end error
    });
  }

$(function () {
  //Initialize Select2 Elements
  $('.select2').select2()
})

$(function()
{
	$(".datepicker").datepicker().on('changeDate', function(ev)
	{
		$('.datepicker').datepicker('hide');
	});
});

var d2 = "<?php echo $d2; ?>";

if(d2 == "")
{
  $(function()
  {
    var no_nota = $('.NO_NOTA').val()
    faktur_list(no_nota);
    sel_operator_timbang();
    sel_inspektur_mutu();
    sel_nama_supplier();
    onchange_pilih_nota();
    hasil_timbang();
  });
}

else {
  $(function()
  {
    edit_faktur(d2)
    $(".CHANGE_JENIS_FAKTUR").attr("disabled", true)
  })

  $(".buat_faktur_baru").removeAttr("style")
  $(".cetak_faktur").removeAttr("style")
  //hasil_timbang(no_nota)
}

$('.lihat_faktur').on('click', function()
{
	$(".modalLihatFaktur").modal('show');
  lihat_faktur()
});

$(function() {
  $('a.sidebar-toggle').click()
});


$(function()
{
	$(".datepicker").datepicker().on('changeDate', function(ev)
  {
		$('.datepicker').datepicker('hide');
	});
});

function onchange_pilih_nota()
{

  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=pilih_no_nota_kp&TANGGAL_NOTA='+$(".BULAN_NOTA").val()+''+$(".TAHUN_NOTA").val()+'',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
          $("select.NO_NOTA").empty()
          $("select.NO_NOTA").append("<option value='' >Pilih No Nota</option>");
        for (i = 0; i < data.result.length; i++) {
          $("select.NO_NOTA").append("<option value='"+ data.result[i].no_nota +"' >"+ data.result[i].no_nota +"</option>");
					}
      } else if (data.respon.pesan == "gagal") {
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });

  // var tanggal = $(".BULAN_NOTA").val()+""+$(".TAHUN_NOTA").val();
  // console.log(tanggal)
  // var options =
  // {
  //   ajax: {
  //     url: refseeAPI,
  //     type: 'POST',
  //     dataType: 'json',
  //     data: {
  //       q: '{{{q}}}',
  //       TANGGAL_NOTA: tanggal,
  //       ref: 'pilih_no_nota',
  //     }
  //   },
  //   locale:
  //   {
  //     emptyTitle: 'Pilih Nota Timbang'
  //   },
  //   log: 3,
  //   preprocessData: function(data)
  //   {
  //
  //     var i, l = data.result.length,
  //       array = [];
  //
  //     if (l)
  //     {
  //       alert(data.respon.text_msg)
  //       for (i = 0; i < l; i++)
  //       {
  //         array.push($.extend(true, data.result[i],
  //         {
  //           // text: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
  //           // value: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
  //           text: data.result[i].notr,
  //           value: data.result[i].notr,
  //           kapal: data.result[i].kapal,
  //           data:
  //           {
  //             subtext: ''
  //           }
  //         }));
  //       }
  //     }
  //     else
  //     {
  //       //console.log(data.respon.text_msg)
  //     }
  //     return array;
  //   }
  // };
  // $('.selectpicker').selectpicker().filter('.with-ajax-personal').ajaxSelectPicker(options);
}

function sel_nama_supplier()
{
  //console.log("sel_nama_supplier")
  var options =
  {
    ajax: {
      url: refseeAPI,
      type: 'POST',
      dataType: 'json',
      data: {
        q: '{{{q}}}',
        ref: 'sel_nama_supplier',
      }
    },
    locale:
    {
      emptyTitle: 'Pilih Nama'
    },
    log: 3,
    preprocessData: function(data)
    {
      var i, l = data.result.length,
        array = [];
      if (l)
      {
        for (i = 0; i < l; i++)
        {
          array.push($.extend(true, data.result[i],
          {
            // text: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
            // value: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
            text: data.result[i].RMP_MASTER_PERSONAL_NAMA,
            value: data.result[i].RMP_MASTER_PERSONAL_ID,
            data:
            {
              subtext: ''
            }
          }));
        }
      }
      else
      {
      }
      return array;
    }
  };
  $('.NAMA_SUPPLIER').selectpicker().filter('.with-ajax-personal').ajaxSelectPicker(options);
}

function sel_operator_timbang()
{
  var options =
  {
    ajax: {
      url: refseeAPI,
      type: 'POST',
      dataType: 'json',
      data: {
        q: '{{{q}}}',
        ref: 'sel_operator_timbang',
      }
    },
    locale:
    {
      emptyTitle: 'Pilih Nama'
    },
    log: 3,
    preprocessData: function(data)
    {
      var i, l = data.result.length,
        array = [];
      if (l)
      {
        for (i = 0; i < l; i++)
        {
          array.push($.extend(true, data.result[i],
          {
            // text: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
            // value: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
            text: data.result[i].RMP_KONFIGURASI_PETUGAS_NAMA,
            value: data.result[i].RMP_KONFIGURASI_PETUGAS_NIK,
            data:
            {
              subtext: ''
            }
          }));
        }
      }
      else
      {
      }$(function() {
  sel_nama_supplier();
});
      return array;
    }
  };
  $('.OPERATOR_TIMBANG').selectpicker().filter('.with-ajax-personal').ajaxSelectPicker(options);
}

function sel_inspektur_mutu()
{
  var options =
  {
    ajax: {
      url: refseeAPI,
      type: 'POST',
      dataType: 'json',
      data: {
        q: '{{{q}}}',
        ref: 'sel_inspektur_mutu',
      }
    },
    locale:
    {
      emptyTitle: 'Pilih Nama'
    },
    log: 3,
    preprocessData: function(data)
    {
      var i, l = data.result.length,
        array = [];
      if (l)
      {
        for (i = 0; i < l; i++)
        {
          array.push($.extend(true, data.result[i],
          {
            // text: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
            // value: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
            text: data.result[i].RMP_KONFIGURASI_PETUGAS_NAMA,
            value: data.result[i].RMP_KONFIGURASI_PETUGAS_NIK,
            data:
            {
              subtext: ''
            }
          }));
        }
      }
      else
      {
      }$(function() {
  sel_nama_supplier();
});
      return array;
    }
  };
  $('.INSPEKTUR_MUTU').selectpicker().filter('.with-ajax-personal').ajaxSelectPicker(options);
}

// $(function() {
//   sel_nama_karyawan();
// });
//
// $(function() {
//   sel_nama_supplier();
// });
// $(function() {
//   onchange_pilih_nota();
// });


function no_nota()
{
  var no_nota = $('.NO_NOTA').val();
  //console.log(no_nota)
  hasil_timbang(no_nota);
  faktur_list(no_nota);
}

function hasil_timbang(no_nota)
{
  var jenis_kelapa = $(".JENIS_KELAPA").val()
  var data = "JENIS_KELAPA="+jenis_kelapa+"&NO_NOTA="+no_nota+"&TANGGAL_NOTA="+$(".BULAN_NOTA").val()+""+$(".TAHUN_NOTA").val()+"";
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=hasil_timbang_list_kp&'+data,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        $("tbody#zone_data").empty();
        for (i = 0; i < data.result.length; i++)
        {
          //console.log(data.result[i].nama_relasi)
          $('.NAMA_NOTA').val(data.result[i].nama)
          // $('p.TANGGAL').html(data.result[i].RMP_HASIL_TIMBANG_TANGGAL)
          $('p.TANGGAL').html(data.result[i].tgl)
          // $('p.KAPAL').html(data.result[i].RMP_HASIL_TIMBANG_KAPAL)
          // $('p.KAPAL').html(data.result[i].RMP_FAKTUR_KAPAL)
          // $('p.NO_NOTA_INPUT').html(data.result[i].RMP_HASIL_TIMBANG_NO_NOTA)
          $('p.NO_NOTA_INPUT').html(data.result[i].relasi)
          $('input.idnota').html(data.result[i].id)

          if(data.result[i].RECORD_STATUS=='N')
          {
            var a = ""
            var tr = "danger"
          }
          else if(data.result[i].RECORD_STATUS=='A')
          {
            var a = ""
            var tr = "danger"
          }
          else
          {
            // var a = "<a class='btn btn-default btn-sm kirim_hasil_timbang' ID_HASIL_TIMBANG='" + data.result[i].RMP_HASIL_TIMBANG_ID +  "' NO_NOTA='" + data.result[i].RMP_HASIL_TIMBANG_NO_NOTA +  "'><i aria-hidden='true' class='fa fa-external-link'></i></a>"
            // var tr = ""
            var a = "<button class='btn btn-success btn-xs kirim_hasil_timbang' ID_HASIL_TIMBANG='" + data.result[i].recno +  "' NO_NOTA='" + data.result[i].relasi +  "'   BRUTO='" + data.result[i].gross + "' PONTON='" + data.result[i].id + "' JENIS_KELAPA='" + data.result[i].jenis_kelapa + "'><i aria-hidden='true' class='fa fa-plus'></i></button>"
            var tr= ""
          }

          $("tbody#zone_data").append("<tr class='"+tr+"'  detailLogId='" + data.result[i].ICD_BARANG_KODE_INVENTORI + "'>" +
            "<td >" + data.result[i].NO + ".<input type='hidden' class='idnota'></td>" +
            // "<td>" + data.result[i].RMP_HASIL_TIMBANG_TANGGAL + "</td>" +
            //"<td>" + data.result[i].id + "</td>"+
            "<td>" + data.result[i].tgl + "</td>"+
            // "<td>" + data.result[i].RMP_HASIL_TIMBANG_KG + "</td>" +
            "<td>" + data.result[i].gross + "</td>"+
            "<td>KOPRA</td>"+
            "<td>" + data.result[i].id + "</td>"+
            "<td>"+ a +"</td>" +
            "</tr>");
        }
      }
      else if (data.respon.pesan == "gagal") {
        $("tbody#zone_data").html("<tr><td colspan='10'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e)
    {
      error_handler_json(x, e, '=> barang_kamus_list()');
    } //end error
  });
}

// $(function() {
//   hasil_timbang();
// });

$("tbody#zone_data").on('click','button.kirim_hasil_timbang', function()
{
  //$("button.kirim_hasil_timbang").attr("style","display:none;")
  var id_timbang = $(this).attr('ID_HASIL_TIMBANG');
  var no_nota = $(this).attr('NO_NOTA');
  var jenis_kelapa = $(this).attr('JENIS_KELAPA');
  var no_faktur = $("input.NO_FAKTUR").val();

  var data = 'ID_TIMBANG='+id_timbang+'&NO_NOTA='+no_nota+'&NO_FAKTUR='+no_faktur+"&TANGGAL_NOTA="+$(".BULAN_NOTA").val()+""+$(".TAHUN_NOTA").val()+"";
  $(".JENIS_KELAPA").val("KOPRA");
    kirim_hasil_timbang(data)
    var no_faktur = $('.NO_FAKTUR').val()
    //console.log("NOMOR FAKTUR::::::::::::::::::"+no_faktur)

})

function kirim_hasil_timbang(data)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=kirim_hasil_timbang_kp&' + data ,
    success: function(data)
    {
      if (data.respon.pesan == "sukses")
      {
        //console.log(data.respon.text_msg);
        $(".NO_FAKTUR").val(data.respon.no_faktur)
        $("p.NO_FAKTUR").html(data.respon.no_faktur)
        //faktur_list(data.respon.text_msg);
        var no_nota = $('.NO_NOTA').val();
        hasil_timbang(no_nota);
        faktur_list(no_nota)
      }
      else if (data.respon.pesan == "gagal")
      {
        //console.log(data.respon.text_msg);
        alert("Gagal Menghapus");
      }
      else if (data.respon.pesan == "gagal_purchaser")
      {
        console.log(data.respon.text_msg);
        alert("Faktur Telah Diproses oleh Purchaser");
      }
    }, //end success
    error: function(x, e)
    {
      console.log("Error Ajaxxxxxxxxxxxxx");
    } //end error
  });
}

function faktur_list(no_nota)
{
  var no_faktur = $("input.NO_FAKTUR").val()
  //alert(no_nota)
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=faktur_list_kp&NO_NOTA='+no_nota+'&NO_FAKTUR='+no_faktur+'&D2=<?php echo $d2; ?>',
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        $('p.total_timbang').html(data.respon.total_kg)
        $("tbody#zone_data_faktur").empty();
        for (i = 0; i < data.result.length; i++)
        {
          if(data.result[i].RECORD_STATUS=='D')
          {
            var a = ""
          }
          else if(data.result[i].RECORD_STATUS=='A')
          {
            var a = "<button class='btn btn-danger btn-xs kembali_hasil_timbang' ID_HASIL_TIMBANG='" + data.result[i].RMP_FAKTUR_DETAIL_ID +  "' NO_NOTA='" + data.result[i].RMP_FAKTUR_DETAIL_NO_NOTA +  "' ><i aria-hidden='true' class='fa fa-trash'></i></button>"
          }
          else
          {
            // var a = "<button class='btn btn-default btn-sm kembali_hasil_timbang' ID_HASIL_TIMBANG='" + data.result[i].RMP_HASIL_TIMBANG_ID +  "' NO_NOTA='" + data.result[i].RMP_HASIL_TIMBANG_NO_NOTA +  "' ><i aria-hidden='true' class='fa fa-external-link'></i></button>"
            var a = "<button class='btn btn-danger btn-xs kembali_hasil_timbang' ID_HASIL_TIMBANG='" + data.result[i].RMP_FAKTUR_DETAIL_ID +  "' NO_NOTA='" + data.result[i].RMP_FAKTUR_DETAIL_NO_NOTA +  "' ><i aria-hidden='true' class='fa fa-trash'></i></button>"
          }
          $("tbody#zone_data_faktur").append("<tr class='default'  detailLogId='" + data.result[i].ICD_BARANG_KODE_INVENTORI + "'>" +
            "<td >" + data.result[i].NO + ".</td>" +
            "<td>" + data.result[i].RMP_FAKTUR_DETAIL_TANGGAL + "</td>" +
            "<td>" + data.result[i].RMP_FAKTUR_DETAIL_NETTO + "</td>" +
            "<td>" + data.result[i].RMP_FAKTUR_DETAIL_JENIS_MATERIAL + "</td>" +
            "<td>"+ a +"</td>" +
            "</tr>");
        }
      }
      else if (data.respon.pesan == "gagal")
      {
        $('p.total_timbang').html('0')
        $("tbody#zone_data_faktur").html("<tr><td colspan='10'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e)
    {
      console.log("Gagal Ajax")
    } //end error
  });
}

$(function()
{
  var no_nota = $('.NO_NOTA').val()
  faktur_list(no_nota);
});

function simpan_faktur()
{
  var fData = $("#faktur_detail").serialize();
  //console.log(fData)
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=simpan_faktur_kp&' + fData,
    success: function(data)
    {
      if (data.respon.pesan == "sukses")
      {
        alert("Berhasil Disimpan")
        //$('.btn_cetak_faktur').removeAttr('style');
        for (i = 0; i < data.result.length; i++) {
          var id_faktur = data.result[i].RMP_FAKTUR_ID
          $('.ID_FAKTUR').val(id_faktur);
        }
        $('.btn_lihat_faktur').removeAttr('style');
        for (i = 0; i < data.result.length; i++) {
          var id_faktur = data.result[i].RMP_FAKTUR_ID
          $('.ID_FAKTUR').val(id_faktur);

        }
        location.reload()

      }
      else if (data.respon.pesan == "gagal")
      {
        //console.log(data.respon.text_msg);
        alert("Gagal Menghapus");
      }
    }, //end success
    error: function(x, e)
    {
      console.log("Error Ajax");
    } //end error
  });
}

$('.simpan_faktur').on('click', function()
{
  if($('.POTONGAN').val() == '')
  {
    alert("Potongan Tidak Boleh Kosong")
  }
  // else if($('.NO_NOTA').val() == null)
  // {
  //   alert("Pilih Nomor Nota")
  // }
  else if($('.NAMA_SUPPLIER').val() == null)
  {
    alert("Pilih Nama Supplier")
  }
  else if($('.OPERATOR_TIMBANG').val() == null)
  {
    alert("Pilih Nama Operator Timbang")
  }
  else if($('.INSPEKTUR_MUTU').val() == null)
  {
    alert("Pilih Nama Inspektur Mutu")
  }
  else if($('.CATATAN_PURCHASER').val() == '')
  {
    alert("Catatan Harus Diisi")
  }
  else if($('.CATATAN_SUPPLIER').val() == '')
  {
    alert("Catatan Harus Diisi")
  }
  else
  {
  $(this).attr('disabled', 'disabled');
  var no_nota = $('.NO_NOTA').val();
  hasil_timbang(no_nota);
  var no_nota = $('.NO_NOTA').val();
  simpan_faktur();
  faktur_list(no_nota);
  }
})

$('.btn_cetak_faktur').on('click', function()
{
  var id_faktur = $('.ID_FAKTUR').val();
  window.open('?show=rmp/pdf/cetak_faktur/' + id_faktur + '', '_blank');
})

$('.btn_lihat_faktur').on('click', function()
{
  var id_faktur = $('.ID_FAKTUR').val();
  window.open('?show=rmp/html/faktur/' + id_faktur + '', '_blank');
})

function kembali_hasil_timbang(data)
{
//  console.log("kembali_hasil_timbang")
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=kembali_hasil_timbang_kp&' + data ,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        var no_nota = $('.NO_NOTA').val()
        hasil_timbang(no_nota)
        faktur_list(no_nota)

      }
      else if (data.respon.pesan == "gagal")
      {
        //console.log(data.respon.text_msg);
        alert("Gagal Menghapus");
      }
      else if (data.respon.pesan == "gagal_purchaser")
      {
        //console.log(data.respon.text_msg);
        alert("Faktur Telah Diproses oleh Purchaser");
      }
    }, //end success
    error: function(x, e)
    {
      console.log("Error Ajax");
    } //end error
  });
}

$("tbody#zone_data_faktur").on('click','button.kembali_hasil_timbang', function()
{
  //$("button.kembali_hasil_timbang").attr("style","display:none;")
  var id_timbang = $(this).attr('ID_HASIL_TIMBANG');
  var no_nota = $(this).attr('NO_NOTA');
  var no_faktur = $('.NO_FAKTUR').text();
  var data = 'ID_TIMBANG='+id_timbang+'&NO_NOTA='+no_nota+'&NO_FAKTUR='+no_faktur;;
  //console.log(data)
  if(no_faktur == "")
  {
    alert('Buat Faktur Terlebih Dahulu')
  }
  else
  {
    kembali_hasil_timbang(data)

  }
})


function lihat_faktur()
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=lihat_faktur&TANGGAL='+$(".FILTER_TANGGAL_LIST").val()+'&FILTER_MATERIAL='+$(".FILTER_MATERIAL").val()+'',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				//console.log(data.respon.text_msg);
        $("tbody#zone_lihat_faktur").empty();
        $("p.TOTAL_KELAPA_A").html("0")
        $("p.TOTAL_KELAPA_B").html("0")
        $("p.TOTAL_KELAPA_C").html("0")
        for (i = 0; i < data.result.length; i++) {

          if (data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "JAMBUL-A" || data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "GELONDONG-A" || data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "LICIN-A")
          {
            var kelapa =  $("p.TOTAL_KELAPA_A").text()
            //console.log(kelapa_a)
            var total_kelapa = parseInt(kelapa) + parseInt(data.result[i].NETTO)
            //console.log(data.result[i].NETTO)
            $("p.TOTAL_KELAPA_A").html(total_kelapa+" Kg")
          }

          else if (data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "JAMBUL-B" || data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "GELONDONG-B" || data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "LICIN-B")
          {
            var kelapa =  $("p.TOTAL_KELAPA_B").text()
            //console.log(kelapa_a)
            var total_kelapa = parseInt(kelapa) + parseInt(data.result[i].NETTO)
            //console.log(data.result[i].NETTO)
            $("p.TOTAL_KELAPA_B").html(total_kelapa+" Kg")
          }
          else if (data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "JAMBUL-C" || data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "GELONDONG-C" || data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "LICIN-C")
          {
            var kelapa =  $("p.TOTAL_KELAPA_C").text()
            //console.log(kelapa_a)
            var total_kelapa = parseInt(kelapa) + parseInt(data.result[i].NETTO)
            //console.log(data.result[i].NETTO)
            $("p.TOTAL_KELAPA_C").html(total_kelapa+" Kg")
          }

          if(data.result[i].RMP_FAKTUR_NAMA_SUB == "")
          {
            var nama = data.result[i].RMP_MASTER_PERSONAL_NAMA
          }
          else
          {
            var nama = "" + data.result[i].RMP_MASTER_PERSONAL_NAMA + " / " + data.result[i].RMP_FAKTUR_NAMA_SUB + ""
          }

          if(data.result[i].PURCHASER_STATUS == "BELUM DIPROSES")
          {
            var purchaser_status = ""
          }
          else
          {
            var purchaser_status = "<p class='text-success'><small><i>Telah diproses oleh Purchaser</i></small></p>"
          }
          if (data.result[i].TOTAL_A == null)
          {
            var total_a = "0"
          }
          else
          {
            var total_a = data.result[i].TOTAL_A
          }

          if (data.result[i].TOTAL_B == null)
          {
            var total_b = "0"
          }
          else
          {
            var total_b = data.result[i].TOTAL_B
          }

          if (data.result[i].TOTAL_C == null)
          {
            var total_c = "0"
          }
          else
          {
            var total_c = data.result[i].TOTAL_C
          }

          $("tbody#zone_lihat_faktur").append("<tr class='detailLogId'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_NO_FAKTUR +  " "+purchaser_status+"</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_DETAIL_NO_NOTA +  "</td>" +
					"<td>" + nama +  "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_JENIS_MATERIAL +  "</td>" +
					"<td>" + data.result[i].BRUTO +  "</td>" +
					"<td>" + data.result[i].TOTAL_POTONGAN +  "</td>" +
					"<td>" + data.result[i].NETTO +  "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_TANGGAL +  "</td>" +
					"<td><a class='btn btn-success btn-xs' href='?show=rmp/faktur/" + data.result[i].RMP_FAKTUR_ID +  "'><i aria-hidden='true' class='fa fa-pencil'></i> Lihat</a></td>"+
          "<td><a class='btn btn-warning btn-xs' href='?show=rmp/pdf/cetak_faktur_adm/" + data.result[i].RMP_FAKTUR_ID +  "/' target='_blank'><i aria-hidden='true' class='fa fa-print'></i> Cetak</a></td>" +
					"</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#zone_lihat_faktur").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
        $("p.TOTAL_KELAPA_A").html("0 Kg")
        $("p.TOTAL_KELAPA_B").html("0 Kg")
        $("p.TOTAL_KELAPA_C").html("0 Kg")
      }
    }, //end success
    error: function(x, e) {
    } //end error
  });
}

function filter_tanggal_list(){
  $("tbody#zone_lihat_faktur").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  lihat_faktur()
}

function edit_faktur(d2)
{
//  console.log("edit_faktur")
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=edit_faktur&FAKTUR_ID='+d2+'',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        for (i = 0; i < data.result.length; i++)
        {

        }
        //alert(data.purchaser_proses)
        if(data.purchaser_proses == "TIDAK TERSEDIA")
        {

          $("tbody#zone_data_faktur button.kembali_hasil_timbang").attr("disabled",true)
          $("button").attr("disabled", true)
          $("input").attr("disabled", true)
          $("select").attr("disabled", true)
          $("text").attr("disabled", true)
          $(".CATATAN_SUPPLIER").attr("disabled", true)
          $(".CATATAN_PURCHASER").attr("disabled", true)
          $("div.warning_faktur").attr("hidden", false)
          $(".FILTER_TANGGAL_LIST").attr("disabled", false)
        }
        //console.log(data.result2[0].PERSONAL_NAME)
        $("p.NO_FAKTUR").html(data.result[0].RMP_FAKTUR_NO_FAKTUR)
        $("p.NO_NOTA_INPUT").html(data.result[0].RMP_FAKTUR_DETAIL_NO_NOTA)
        $(".ID_FAKTUR").val(data.result[0].RMP_FAKTUR_ID)
        $(".NO_FAKTUR").val(data.result[0].RMP_FAKTUR_NO_FAKTUR)
        $(".TANGGAL_FAKTUR").val(data.result[0].RMP_FAKTUR_TANGGAL)
        $(".KAPAL_FAKTUR").val(data.result[0].RMP_FAKTUR_KAPAL)
        $(".JENIS_KELAPA").val(data.result[0].RMP_FAKTUR_DETAIL_JENIS_MATERIAL)
        $(".JENIS_FAKTUR").val(data.result[0].RMP_FAKTUR_JENIS)
        $('select.NO_NOTA').append('<option value="'+data.result[0].RMP_FAKTUR_DETAIL_NO_NOTA+'" selected="selected">'+data.result[0].RMP_FAKTUR_DETAIL_NO_NOTA+'</option>').selectpicker('refresh');
        hasil_timbang(data.result[0].RMP_FAKTUR_DETAIL_NO_NOTA)
        $('select.NO_NOTA').trigger('change');

        $('select.NAMA_SUPPLIER').append('<option value="'+data.result[0].RMP_MASTER_PERSONAL_ID+'" selected="selected">'+data.result[0].RMP_MASTER_PERSONAL_NAMA+'</option>').selectpicker('refresh');
        $('select.NAMA_SUPPLIER').trigger('change');
        $('select.OPERATOR_TIMBANG').append('<option value="'+data.result[0].PERSONAL_NIK+'" selected="selected">'+data.result[0].PERSONAL_NAME+'</option>').selectpicker('refresh');
        $('select.OPERATOR_TIMBANG').trigger('change');
        $(".ALAMAT_SUPPLIER").val(data.result[0].RMP_FAKTUR_ALAMAT)
        $(".POTONGAN").val(data.result[0].RMP_FAKTUR_POTONGAN)
        $(".CATATAN_PURCHASER").val(data.result[0].RMP_FAKTUR_CATATAN_PURCHASER)
        $(".CATATAN_SUPPLIER").val(data.result[0].RMP_FAKTUR_CATATAN_SUPPLIER)
        $(".NAMA_PETANI").val(data.result[0].RMP_FAKTUR_NAMA_SUB)

        if(data.result[0].RMP_FAKTUR_CEK_DITERIMA =='Y')
        {
          $('.CEK_DITERIMA').attr('checked', true);
        }
        else {
          $('.CEK_DITERIMA').attr('checked', false);
        }

        if(data.result[0].RMP_FAKTUR_CEK_100_INSPEKSI =='Y')
        {
          $('.CEK_100_INSPEKSI').attr('checked', true);
        }
        else {
          $('.CEK_100_INSPEKSI').attr('checked', false);
        }

        if(data.result[0].RMP_FAKTUR_CEK_DIPISAH =='Y')
        {
          $('.CEK_DIPISAH').attr('checked', true);
        }
        else {
          $('.CEK_DIPISAH').attr('checked', false);
        }

        hasil_timbang(data.result[0].RMP_FAKTUR_DETAIL_NO_NOTA)

        $('select.INSPEKTUR_MUTU').append('<option value="'+data.result2[0].PERSONAL_NIK+'" selected="selected">'+data.result2[0].PERSONAL_NAME+'</option>').selectpicker('refresh');
        $('select.INSPEKTUR_MUTU').trigger('change');

      }
      else if (data.respon.pesan == "gagal") {
      }
    }, //end success
    error: function(x, e) {
    } //end error
  });
}

$(".cetak_faktur").on("click", function(){
  // var no_faktur = btoa(fikri); // Enskrip
  // var no_faktur = atob(Zmlrcmk=); // Dekrip
  var s = " ";
  var rp_kg = btoa(s)
  var material = btoa($('.JENIS_KELAPA').val())
  var printed = btoa($(this).attr("PRINTED"))
  window.open("?show=rmp/pdf/cetak_faktur_adm/<?php echo $d2; ?>/"+ rp_kg +"/"+ material +"/"+ printed +"", "_blank");
})


$(".tambah_manual_nota").on("click", function(){
  var no_faktur = $("input.NO_FAKTUR").val()
  $(".MANUAL_NO_FAKTUR").val(no_faktur)
  if(no_faktur == "")
  {
    alert("Isi nomor faktur terlebih dahulu")
  }
  else {
    $(".modalManualNota").modal("show")
  }
})

$(".SIMPAN_MANUAL_PROSES").on("click", function(){
  var fData = $('.fDataManualNota').serialize();
  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=simpan_manual_nota&' + fData ,
  	success: function(data) {
  		if (data.respon.pesan == "sukses")
  		{
        var no_nota = "";
        faktur_list(no_nota)
        $("input.JENIS_KELAPA").val($(".MANUAL_MATERIAL").val()+"-"+$(".MANUAL_GRADE").val())
        $(".modalManualNota").modal("hide")
  		}

  		else if (data.respon.pesan == "gagal")
  		{
  			console.log(data.respon.text_msg);
  			alert("Gagal Menyimpan");
  		}
  	}, //end success
  	error: function(x, e) {
  		console.log("Error Ajax");
  	} //end error
  });
})

function kalkulasi_manual()
{
  var gross = $("input.MANUAL_GROSS").val()
  var tara = $("input.MANUAL_TARA").val()
  var bruto = parseInt(gross) - parseInt(tara)
  console.log(gross)
  $("input.MANUAL_BRUTO").val(parseInt(bruto))
  var potongan = $("input.MANUAL_POTONGAN").val()
  var netto = parseInt(bruto)-parseInt(potongan)
  $("input.MANUAL_NETTO").val(parseInt(netto))
}
</script>
