<script src="asset/js_80/jquery.form.js"></script>
<?php
$RMP_CONFIG=new RMP_CONFIG();
$SISTEM_CONFIG=new SISTEM_CONFIG();
$no_rekening_id_supplier = $RMP_CONFIG->no_rekening_id();
// $id = waktu_decimal(Date("Y-m-d H:i:s"));
if ($d3 == "")
{
  $id = waktu_decimal(Date("Y-m-d H:i:s"));
  $title = "Tambah Petani";
}
else
{
  $id = $d3;
  $title = "Personal File Petani";
}
$data=array(
  'ID_SUPPLIER'=>$d3,
);

$cr_data=array(
  'case'=>"nonlogin_data_443_detail",
  'batas'=>1,
  'halaman'=>1,
  'user_privileges_data'=>$_COOKIE['data_http'],
  'data'=>$data,
);

$SW=new SWITCH_DATA();
$SW->data_location="local"; //local,external
$SW->cr_data=$cr_data;
$SW->CLS=new RMP_MODULES(); //nama class -> khusus untuk local data.
$SW->ref="RMP_MODULES"; //nama file --> khusus untuk external data
$da=$SW->output();
// echo "<pre>".print_r($da,true)."</pre>";

foreach($da['refs'] as $r)
{
  $id_supplier[]=$r;
}
?>

<style>

.modalMD
{
  width: 1000px;
}
.modal
{
    overflow-y: auto;
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
  0%
  {
    -webkit-transform: rotate(0deg);
  }
  100%
  {
    -webkit-transform: rotate(360deg);
  }
}

@keyframes spin
{
  0%
  {
    transform: rotate(0deg);
  }
  100%
  {
    transform: rotate(360deg);
  }
}
</style>
<!-- <?php echo $id; ?> -->
<!-- <?php echo $id_supplier[0]['RMP_MASTER_PERSONAL_KABUPATEN']; ?> -->
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="list-group">
			<div class="list-group-item">
				<div class="row">
					<div class="col-md-8">
						<h3><i class="fa fa-user-circle-o"></i> <?php echo $title; ?></h3>
						<hr>
					</div>
					<div class="col-md-4 text-right">
            <h3><a href="?show=rmp/supplier/master_supplier" class="btn btn-primary btn-sm" type="button"><i aria-hidden="true" class="fa fa-list"></i></a></h3>
            </div>
				</div><!--/.row-->
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active">
							<a data-toggle="tab" href="#personal">Data Personal</a>
						</li>
            <li>
							<a data-toggle="tab" href="#rekening_relasi">Rekening Relasi</a>
						</li>
            <li>
							<a data-toggle="tab" href="#wilayah">Wilayah Kebun</a>
						</li>
						<li>
							<a data-toggle="tab" href="#asisten">Data Asisten</a>
						</li>
						<li>
							<a data-toggle="tab" href="#rekening">Rekening Bank</a>
						</li>
						<!-- <li>
							<a data-toggle="tab" href="#qualited_harga">Kualitet dan Harga</a>
						</li> -->
						<li>
							<a data-toggle="tab" href="#toleransi_mutu">Toleransi Mutu</a>
						</li>
						<li>
							<a data-toggle="tab" href="#kontak">Kontak</a>
						</li>
						<li>
							<a data-toggle="tab" href="#keluarga">Keluarga</a>
						</li>
						<li>
							<a data-toggle="tab" href="#dokumen">Dokumen</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="personal">
							<br>
							<form action="?show=/upload/local_dir/" method="POST" enctype="multipart/form-data" class="formPersonal" id="formPersonal" name="formPersonal">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Nama Lengkap</label>
                      <input autocomplete="off" class="form-control ID_SUPPLIER" id="ID_SUPPLIER" name="ID_SUPPLIER" placeholder="ID_SUPPLIER LENGKAP" type="hidden" value="<?php echo $id; ?>">
                        <input autocomplete="off" class="form-control FOTO_SUPPLIER" id="FOTO_SUPPLIER" name="FOTO_SUPPLIER" placeholder="FOTO_SUPPLIER LENGKAP" type="hidden" value="<?php echo $id_supplier[0]['RMP_MASTER_PERSONAL_FOTO'] ?>">
                      <input autocomplete="off" class="form-control NAMA" id="NAMA" name="NAMA" placeholder="NAMA LENGKAP" value="<?php echo $id_supplier[0]['RMP_MASTER_PERSONAL_NAMA'] ?>" type="text">
											<p class="help-block">Isi sesuai kartu identitas anda.</p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="exampleInputEmail1">No. KTP</label> <input autocomplete="off" class="form-control KTP" id="KTP" name="KTP" placeholder="Nomor KTP" value="<?php echo $id_supplier[0]['RMP_MASTER_PERSONAL_KTP'] ?>" type="text">
											<p class="help-block">Isi sesuai kartu identitas anda.</p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="exampleInputEmail1">NPWP</label> <input autocomplete="off" class="form-control NPWP" id="NPWP" name="NPWP" placeholder="NPWP" value="<?php echo $id_supplier[0]['RMP_MASTER_PERSONAL_NPWP'] ?>" type="text">
											<p class="help-block">Nomor Pokok Wajib Pajak.</p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Tanggal Pendaftaran</label> <input autocomplete="off" class="form-control datepicker TANGGAL_DAFTAR" data-date-format="yyyy/mm/dd" id="TANGGAL_DAFTAR" name="TANGGAL_DAFTAR" value="<?php echo $id_supplier[0]['RMP_MASTER_PERSONAL_TANGGAL_DAFTAR'] ?>" type="text" value="">
											<p class="help-block">Tanggap Pendaftaran, Format tanggal (YYYY/MM/DD).</p>
										</div>
									</div>
                  <div class="col-md-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Suku</label>
                      <input autocomplete="off" class="form-control SUKU" id="SUKU" name="SUKU" placeholder="SUKU" value="<?php echo $id_supplier[0]['RMP_MASTER_PERSONAL_SUKU'] ?>" type="text">
											<p class="help-block"></p>
										</div>
									</div>
                  <div class="col-md-4">
      							<div class="form-group">
      								<label for="exampleInputEmail1">Jenis Supplier</label>
                      <select id="JENIS_KONTAK" name="JENIS_SUPPLIER"  type="text" class="col-sm-2 form-control JENIS_SUPPLIER" autocomplete="off" >
                        <option value="">--Pilih--</option>
                        <?php foreach($RMP_CONFIG->user()->jenis_supplier as $key=>$val)
                        {

                          if($id_supplier[0]['RMP_MASTER_PERSONAL_ROLE']==$key)
                            {
                              $sel="selected";
                            }
                            else
                              {
                                $sel="";
                              }
                              echo"<option value='$key' $sel>$val</option>";
                            } ?>
                      </select>
      								<p class="help-block">Isi sesuai kartu identitas anda.</p>
      							</div>
      						</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Provinsi</label>
                      <select class="form-control PROVINSI" id="PROVINSI" name="PROVINSI" onchange="provinsi()">
												<option value="">
													--Pilih Provinsi--
												</option><?php
                        $data = $RMP_CONFIG->provinsi();
                              foreach ($data['rasult'] as $key => $value)
                                {
                                  foreach ($value as $data => $isi)       {
                                  if($id_supplier[0]['RMP_MASTER_PERSONAL_PROVINSI']==$isi['INDONESIA_PROVINSI_ID'])
                                                 {
                                                   $sel="selected";
                                                 }
                                                 else
                                                   {
                                                     $sel="";
                                                   }

                                  ?>


												<option value="<?php echo $isi['INDONESIA_PROVINSI_ID']; ?>" <?php echo $sel; ?>>
													<?php  echo $isi['INDONESIA_PROVINSI'];?>
												</option><?php   }}      ?>
											</select>
											<p class="help-block">Isi sesuai kartu identitas anda.</p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Kabupaten</label>
                      <select id="KABUPATEN" name="KABUPATEN"  type="text" class="col-sm-2 form-control KABUPATEN"  autocomplete="off"  onchange="kabupaten()" >
                        <?php
                        $params = $id_supplier[0]['RMP_MASTER_PERSONAL_PROVINSI'];
                        $data = $RMP_CONFIG->kabupaten($params);
                        foreach ($data['rasult'] as $key => $value) {
                          foreach ($value as $data => $isi) {
                            if($id_supplier[0]['RMP_MASTER_PERSONAL_KABUPATEN']==$isi['INDONESIA_KABUPATEN_ID'])
                            {
                              $sel="selected";
                            }
                            else
                              {
                                $sel="";
                              }
                ?>
                <option value="<?php echo $isi['INDONESIA_KABUPATEN_ID']; ?>" <?php echo $sel; ?> > <?php  echo $isi['INDONESIA_KABUPATEN'];?></option>
                <?php

              }

            }?>
                      </select>
											<p class="help-block">Isi sesuai kartu identitas anda.</p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Kecamatan</label>
                      <select id="KECAMATAN" name="KECAMATAN"  type="text" class="col-sm-2 form-control KECAMATAN"  autocomplete="off"  onchange="kecamatan()" >
                        <?php
                        $params = $id_supplier[0]['RMP_MASTER_PERSONAL_KABUPATEN'];
                        $data = $RMP_CONFIG->kecamatan($params);
                        foreach ($data['rasult'] as $key => $value) {
                          foreach ($value as $data => $isi) {
                            if($id_supplier[0]['RMP_MASTER_PERSONAL_KECAMATAN']==$isi['INDONESIA_KECAMATAN_ID'])
                            {
                              $sel="selected";
                            }
                            else
                              {
                                $sel="";
                              }
                ?>
                <option value="<?php echo $isi['INDONESIA_KECAMATAN_ID']; ?>" <?php echo $sel; ?> > <?php  echo $isi['INDONESIA_KECAMATAN'];?></option>
                <?php

              }

            }?>
                      </select>
											<p class="help-block">Isi sesuai kartu identitas anda.</p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Desa</label>
                      <select id="DESA" name="DESA"  type="text" class="col-sm-2 form-control DESA"  autocomplete="off" >
                        <?php
                        $params = $id_supplier[0]['RMP_MASTER_PERSONAL_KECAMATAN'];
                        $data = $RMP_CONFIG->desa($params);
                        foreach ($data['rasult'] as $key => $value) {
                          foreach ($value as $data => $isi) {
                            if($id_supplier[0]['RMP_MASTER_PERSONAL_DESA']==$isi['INDONESIA_DESA_ID'])
                            {
                              $sel="selected";
                            }
                            else
                              {
                                $sel="";
                              }
                ?>
                <option value="<?php echo $isi['INDONESIA_DESA_ID']; ?>" <?php echo $sel; ?> > <?php  echo $isi['INDONESIA_DESA'];?></option>
                <?php

              }

            }?>
                      </select>
											<p class="help-block">Isi sesuai kartu identitas anda.</p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Alamat</label>
                      <input autocomplete="off" class="form-control ALAMAT_PERSONAL" name="ALAMAT_PERSONAL" id="ALAMAT_PERSONAL" placeholder="" type="text" value="<?php echo $id_supplier[0]['RMP_MASTER_PERSONAL_ALAMAT'] ?>">
											<p class="help-block">Isi sesuai kartu identitas anda.</p>
										</div>
									</div>
                  <div class="col-md-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Wilayah</label>
                      <select id="WILAYAH_SUPPLIER" name="WILAYAH_SUPPLIER" type="text" class="col-sm-2 form-control WILAYAH_SUPPLIER"  autocomplete="off" onchange="wilayah_supplier()">
                        <option value="">--Pilih Wilayah--</option>
                        <?php
                        $params = $id_supplier[0]['RMP_MASTER_PERSONAL_ID'];
                        $data = $RMP_CONFIG->wilayah($params);
                        foreach ($data['rasult'] as $key => $value) {
                          foreach ($value as $data => $isi) {
                            if($id_supplier[0]['RMP_MASTER_WILAYAH_ID']==$isi['RMP_MASTER_WILAYAH_ID'])
                            {
                              $sel="selected";
                            }
                            else
                              {
                                $sel="";
                              }
                ?>
                <option value="<?php echo $isi['RMP_MASTER_WILAYAH_ID']; ?>" KODE_WILAYAH="<?php echo $isi['RMP_MASTER_WILAYAH_KODE']; ?>" <?php echo $sel; ?> > <?php  echo $isi['RMP_MASTER_WILAYAH'];?></option>
                <?php

              }

            }?>
                      </select>
											<p class="help-block">Isi sesuai kartu identitas anda.</p>
										</div>
									</div>
                  <div class="col-md-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Lokasi</label>
                      <select id="SUB_WILAYAH_SUPPLIER" name="SUB_WILAYAH_SUPPLIER" type="text" class="col-sm-2 form-control SUB_WILAYAH_SUPPLIER"  autocomplete="off">
                        <option value="">--Pilih Wilayah--</option>
                                <?php
                                $params = $id_supplier[0]['RMP_MASTER_WILAYAH_ID'];
                                $data = $RMP_CONFIG->sub_wilayah_id($params);
                                foreach ($data['rasult'] as $key => $value) {
                                  foreach ($value as $data => $isi) {
                                    if($id_supplier[0]['SUB_WILAYAH_ID']==$isi['RMP_MASTER_WILAYAH_ID'])
                                    {
                                      $sel="selected";
                                    }
                                    else
                                      {
                                        $sel="";
                                      }
                        ?>
                        <option value="<?php echo $isi['RMP_MASTER_WILAYAH_ID']; ?>" KODE_WILAYAH="<?php echo $isi['RMP_MASTER_WILAYAH_KODE']; ?>" <?php echo $sel; ?> > <?php  echo $isi['RMP_MASTER_WILAYAH'];?></option>
                        <?php

                      }

                    }?>
                            </select>
											<p class="help-block">Isi sesuai kartu identitas anda.</p>
										</div>
									</div>

									<div class="col-md-8">
                    <div class="row">
          <div class="col-md-3">

            <img class="PRIVIEW_SUPPLIER_FOTO img-thumbnail" src="cloud/relasi_a/<?php echo $id_supplier[0]['RMP_MASTER_PERSONAL_FOTO'] ?>" onerror="imgError(this);">

          </div>
          <div class="col-md-9">
          <strong>Ketentuan Upload Foto</strong>
          <ol>
            <li>Gunakan foto format : JPG, PNG, GIF, JPEG.</li>
            <li>Foto yang diupload sebaiknya sudah diresize menjadi ukuran 3x4 cm.</li>
            <li>Ukuran maksimal foto yang boleh diupload adalah 1MB.</li>
          </ol>
          <a class="link uploadfotobtn"><i class="fa fa-camera"></i> Upload Foto</a>
          <div class="notifikasi-perubahan-foto"></div>
          </div>
        </div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 text-right">
										<a class="btn btn-success simpanPersonal" id="simpanPersonal">Simpan</a>
									</div>
								</div>
							</form>
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="asisten">
							<button class="btn btn-primary btn-sm tambah_asisten" type="button"><i aria-hidden="true" class="fa fa-plus-square"></i> Tambah Asisten</button><br>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
                    <th></th>
										<th>Nama</th>
										<th>No. HP</th>
										<th>Alamat</th>
									</tr>
								</thead>
								<tbody id="data_asisten">
									<tr>
										<td colspan="9">
											<center>
												<div class="loader"></div>
											</center>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="wilayah">
							<button class="btn btn-primary btn-sm tambah_wilayah" type="button"><i aria-hidden="true" class="fa fa-plus-square"></i> Tambah Wilayah</button><br>
							<table class="table table-bordered table-hover">
                <thead>
									<tr>
										<th>No.</th>
										<th>Alamat</th>
										<th>Baris & Naik</th>
										<th>Estimasi Luas</th>
										<th>Panjang & Lebar</th>
										<th>Luas</th>
									</tr>
								</thead>
								<tbody id="data_wilayah">
									<tr>
										<td colspan="9">
											<center>
												<div class="loader"></div>
											</center>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="rekening">
							<button class="btn btn-primary btn-sm tambah_rekening" type="button"><i aria-hidden="true" class="fa fa-plus-square"></i> Tambah Rekening</button><br>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Kode Bank</th>
										<th>Bank</th>
										<th>Nomor Rekening</th>
										<th>Nama Pemilik</th>
									</tr>
								</thead>
								<tbody id="data_rekening">
									<tr>
										<td colspan="9">
											<center>
												<div class="loader"></div>
											</center>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="keluarga">
							<button class="btn btn-primary btn-sm tambah_keluarga" type="button"><i aria-hidden="true" class="fa fa-plus-square"></i> Tambah Keluarga</button><br>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Nama</th>
										<th>Status Keluarga</th>
										<th>Alamat</th>
									</tr>
								</thead>
								<tbody id="data_keluarga">
									<tr>
										<td colspan="9">
											<center>
												<div class="loader"></div>
											</center>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="rekening_relasi">
							<button class="btn btn-primary btn-sm tambah_rekeningrelasi" type="button"><i aria-hidden="true" class="fa fa-plus-square"></i> Tambah Rekening Relasi</button><br>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Rekening Relasi</th>
										<th>Material</th>
										<th>Wilayah</th>
										<th>Lokasi</th>

									</tr>
								</thead>
								<tbody id="data_rekening_relasi">
									<tr>
										<td colspan="9">
											<center>
												<div class="loader"></div>
											</center>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="qualited_harga">
							<button class="btn btn-primary btn-sm tambah_qualited_harga" type="button"><i aria-hidden="true" class="fa fa-plus-square"></i> Tambah Kualitet dan Harga</button><br>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Material</th>
										<th>Kualitet</th>
										<th>Harga</th>
                    <th>Tanggal Berlaku</th>
                    <th>Tanggal Berakhir</th>
									</tr>
								</thead>
								<tbody id="data_qualited_harga">
									<tr>
										<td colspan="9">
											<center>
												<div class="loader"></div>
											</center>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="toleransi_mutu">
							<button class="btn btn-primary btn-sm tambah_toleransi_mutu" type="button"><i aria-hidden="true" class="fa fa-plus-square"></i> Tambah Toleransi Mutu</button><br>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Nilai Min</th>
										<th>Nilai Max</th>
										<th>Tanggal Berlaku</th>
										<th>Tanggal Berakhir</th>
									</tr>
								</thead>
								<tbody id="data_toleransi_mutu">
									<tr>
										<td colspan="9">
											<center>
												<div class="loader"></div>
											</center>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- /.tab-pane -->
            <div class="tab-pane" id="kontak">
							<button class="btn btn-primary btn-sm tambah_kontak" type="button"><i aria-hidden="true" class="fa fa-plus-square"></i> Tambah Rekening</button><br>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Jenis Kontak</th>
										<th>Kontak</th>
										<th>Status</th>
										<th>Tanggal Entri</th>

									</tr>
								</thead>
								<tbody id="data_kontak">
									<tr>
										<td colspan="9">
											<center>
												<div class="loader"></div>
											</center>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- /.tab-pane -->
            <div class="tab-pane" id="dokumen">
							<button class="btn btn-primary btn-sm tambah_dokumen" type="button"><i aria-hidden="true" class="fa fa-plus-square"></i> Tambah Rekening</button><br>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Dokumen</th>
										<th>Jenis Dokumen</th>
										<th>Status Berlaku</th>
										<th>Tanggal Expired</th>
									</tr>
								</thead>
								<tbody id="data_dokumen">
									<tr>
										<td colspan="9">
											<center>
												<div class="loader"></div>
											</center>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- /.tab-pane -->
					</div><!-- /.tab-content -->
				</div><!-- nav-tabs-custom -->
			</div>
		</div>
	</div>
</div>

<!-- -------------------------------------------------------- MODAL TAMBAH WILAYAH -->
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalWilayah" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content ">
			<div class="modal-header ">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Wilayah Kebun Supplier</h4>
			</div>
			<div class="modal-body ">
				<form action="javascript:download();" class="fDataWilayah" id="fDataWilayah" name="fDataWilayah">
          <div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Provinsi</label>
								<select class="form-control PROVINSI2" id="PROVINSI2" name="PROVINSI2" onchange="provinsi2()">
									<option value="">
										--Pilih Provinsi--
									</option><?php  $data = $RMP_CONFIG->provinsi(); foreach ($data['rasult'] as $key => $value) {   foreach ($value as $data => $isi)       { ?>
									<option value="<?php echo $isi['INDONESIA_PROVINSI_ID']; ?>">
										<?php  echo $isi['INDONESIA_PROVINSI'];?>
									</option><?php   }}      ?>
								</select>
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Kabupaten</label> <select class="form-control KABUPATEN2" id="KABUPATEN2" name="KABUPATEN2" onchange="kabupaten2()">
									<option value="">
										--Pilih Kabupaten--
									</option>
								</select>
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Kecamatan</label> <select class="form-control KECAMATAN2" id="KECAMATAN2" name="KECAMATAN2" onchange="kecamatan2()">
									<option value="">
										--Pilih Kecamatan--
									</option>
								</select>
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Desa</label> <select class="form-control DESA2" id="DESA2" name="DESA2">
									<option value="">
										--Pilih Desa--
									</option>
								</select>
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label for="exampleInputEmail1">Alamat</label>
                <input autocomplete="off" class="form-control ALAMAT2" id="ALAMAT2" name="ALAMAT2" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
          </div>
          <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-superscript" aria-hidden="true"></i> Luas Kebun</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-3">
                <label for="exampleInputEmail1">Baris</label>
                <input autocomplete="off" class="form-control BARIS_WILAYAH" id="BARIS_WILAYAH" name="BARIS_WILAYAH" placeholder="" type="number">
                  <p class="help-block"></p>
              </div>
              <div class="col-md-3">
                <label for="exampleInputEmail1">Naik</label>
                <input autocomplete="off" class="form-control NAIK_WILAYAH" id="NAIK_WILAYAH" name="NAIK_WILAYAH" placeholder="" type="number">
                <p class="help-block"></p>
              </div>
              <div class="col-md-6">
                <label for="exampleInputEmail1">Estimasi Luas</label>
                <input autocomplete="off" class="form-control LUAS_BARIS_NAIK_WILAYAH" id="LUAS_BARIS_NAIK_WILAYAH" name="LUAS_BARIS_NAIK_WILAYAH" placeholder="" type="number" readonly>
                <p class="help-block">Satuan m&#178;</p>
              </div>
              </div>
              <div class="row">
              <div class="col-md-3">
                <label for="exampleInputEmail1">Panjang</label>
                <input autocomplete="off" class="form-control PANJANG_WILAYAH" id="PANJANG_WILAYAH" name="PANJANG_WILAYAH" placeholder="" type="number">
                <p class="help-block">Satuan m&#178;</p>
              </div>
              <div class="col-md-3">
                <label for="exampleInputEmail1">Lebar</label>
                <input autocomplete="off" class="form-control LEBAR_WILAYAH" id="LEBAR_WILAYAH" name="LEBAR_WILAYAH" placeholder="" type="number">
                <p class="help-block">Satuan m&#178;</p>
              </div>
              <div class="col-md-6">
                <label for="exampleInputEmail1">Luas</label>
                <input autocomplete="off" class="form-control LUAS_WILAYAH" id="LUAS_WILAYAH" name="LUAS_WILAYAH" placeholder="" type="number" readonly>
                <p class="help-block">Satuan m&#178;</p>
              </div>
            </div>

          </div>
          <!-- /.box-body -->
        </div>
      </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
    						<button class="btn btn-success btn-sm FormKirimWilayah">Simpan</button> <button class="btn btn-default btn-sm BatalWilayah">Batal</button>
    					</div>
            </div>
          </div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- -------------------------------------------------------- END MODAL TAMBAH WILAYAH -->
<!-- -------------------------------------------------------- MODAL TAMBAH REKENING -->
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalRekening" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Rekening Supplier</h4>
			</div>
			<div class="modal-body">
				<form action="javascript:download();" class="fDataRekening" id="fDataRekening" name="fDataRekening">
          <div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Bank</label>
								<select class="form-control BANK" id="BANK" name="BANK">
									<option value="">
										--Pilih Bank--
									</option><?php  $data = $RMP_CONFIG->bank(); foreach ($data['rasult'] as $key => $value) {   foreach ($value as $data => $isi)       { ?>
									<option value="<?php echo $isi['MASTER_BANK_KODE']; ?>">
										<?php  echo $isi['MASTER_BANK_NAMA'];?>
									</option><?php   }}      ?>
								</select>
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Rekening</label>
                <input autocomplete="off" class="form-control NO_REKENING" id="NO_REKENING" name="NO_REKENING" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama Pemilik</label>
                <input autocomplete="off" class="form-control NAMA_REKENING" id="NAMA_REKENING" name="NAMA_REKENING" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
    						<button class="btn btn-success btn-sm FormKirimRekening">Simpan</button> <button class="btn btn-default btn-sm BatalRekening">Batal</button>
    					</div>
            </div>
          </div>
				</form>
		</div>
	</div>
</div>
</div>
<!-- -------------------------------------------------------- END MODAL TAMBAH REKENING -->
<!-- -------------------------------------------------------- MODAL TAMBAH REKENING RELASI -->
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalRekeningRelasi" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Rekening Relasi</h4>
			</div>
			<div class="modal-body">
				<form action="javascript:download();" class="fDataRekeningRelasi" id="fDataRekeningRelasi" name="fDataRekeningRelasi">
          <div class="row">
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Material </label>
								<select class="form-control JENIS_REKENING" id="JENIS_REKENING" name="JENIS_REKENING" onchange="jenis_rekening()">
									<option value="">
										--Pilih Bank--
									</option><?php  $data = $RMP_CONFIG->material(); foreach ($data['rasult'] as $key => $value) {   foreach ($value as $data => $isi)       { ?>
									<option value="<?php echo $isi['RMP_MASTER_MATERIAL_ID']; ?>" nama_material="<?php  echo $isi['RMP_MASTER_MATERIAL'];?>">
										<?php  echo $isi['RMP_MASTER_MATERIAL'];?>
									</option><?php   }}      ?>
								</select>
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-8">
							<div class="form-group">
								<label for="exampleInputEmail1">Rekening</label>
                <div class="row">
                  <div class="col-md-3">
                    <input autocomplete="off" class="form-control KODE_JENIS_REKENING" id="KODE_JENIS_REKENING" name="KODE_JENIS_REKENING" placeholder="" type="text" readonly>
                    <input autocomplete="off" class="form-control MATERIAL_NAMA" id="MATERIAL_NAMA" name="MATERIAL_NAMA" placeholder="" type="hidden" readonly>
                    <p class="help-block">Material.</p>
                  </div>
                  <div class="col-md-3">
                    <input autocomplete="off" class="form-control NO_REKENING_KODE_WILAYAH" id="NO_REKENING_KODE_WILAYAH" name="NO_REKENING_KODE_WILAYAH" placeholder="" type="text" >
                    <p class="help-block">Wilayah.</p>
                  </div>
                  <div class="col-md-3">
                    <input autocomplete="off" class="form-control NO_REKENING_SUB_WILAYAH" id="NO_REKENING_SUB_WILAYAH" name="NO_REKENING_SUB_WILAYAH" placeholder="" type="text">
                    <input autocomplete="off" class="form-control NO_REKENING_ID_SUB_WILAYAH" id="NO_REKENING_ID_SUB_WILAYAH" name="NO_REKENING_ID_SUB_WILAYAH" placeholder="" type="hidden">
                    <p class="help-block">Lokasi.</p>
                  </div>
                  <div class="col-md-3">
                    <input autocomplete="off" class="form-control NO_REKENING_ID_RELASI" id="NO_REKENING_ID_RELASI" name="NO_REKENING_ID_RELASI" placeholder="" type="text" >
                    <p class="help-block">ID Rekening.</p>
                  </div>
                </div>

								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>

          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
    						<button class="btn btn-success btn-sm FormKirimRekeningRelasi">Simpan</button> <button class="btn btn-default btn-sm BatalRekeningRelasi">Batal</button>
    					</div>
            </div>
          </div>
				</form>
		</div>
	</div>
</div>
</div>
<!-- -------------------------------------------------------- END MODAL TAMBAH REKENING RELASI -->
<!-- -------------------------------------------------------- MODAL TAMBAH QUALITED DAN HARGA -->
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalQualitedHarga" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Rekening Relasi</h4>
			</div>
			<div class="modal-body">
				<form action="javascript:download();" class="fDataQualitedHarga" id="fDataQualitedHarga" name="fDataQualitedHarga">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Material</label>
                <select class="form-control QUALITED_JENIS_MATERIAL" id="QUALITED_JENIS_MATERIAL" name="QUALITED_JENIS_MATERIAL" onchange="onchange_qualited()">
									<option value="">
										--Pilih Material--
									</option><?php  $data = $RMP_CONFIG->material(); foreach ($data['rasult'] as $key => $value) {   foreach ($value as $data => $isi)       { ?>
									<option value="<?php echo $isi['RMP_MASTER_MATERIAL_ID']; ?>" QUALITED="<?php echo $isi['RMP_MASTER_MATERIAL_QUALITED']; ?>">
										<?php  echo $isi['RMP_MASTER_MATERIAL'];?>
									</option><?php   }}      ?>
								</select>
								<p class="help-block"></p>
              </div>
            </div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Kualitet</label>
                <input autocomplete="off" class="form-control QUALITED_HARGA_QUALITED" id="QUALITED_HARGA_QUALITED" name="QUALITED_HARGA_QUALITED" placeholder="" type="text">
								<p class="help-block QUALITED_WARNING text-danger"></p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga</label>
                <input autocomplete="off" class="form-control QUALITED_HARGA_HARGA" id="QUALITED_HARGA_HARGA" name="QUALITED_HARGA_HARGA" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal Berlaku</label>
                <input autocomplete="off" class="form-control datepicker QUALITED_HARGA_TANGGAL_BERLAKU" data-date-format="yyyy/mm/dd" id="QUALITED_HARGA_TANGGAL_BERLAKU" name="QUALITED_HARGA_TANGGAL_BERLAKU" type="text" value="">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal Berakhir</label>
              <input autocomplete="off" class="form-control datepicker QUALITED_HARGA_TANGGAL_BERAKHIR" data-date-format="yyyy/mm/dd" id="QUALITED_HARGA_TANGGAL_BERAKHIR" name="QUALITED_HARGA_TANGGAL_BERAKHIR" type="text" value="">
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
    						<button class="btn btn-success btn-sm FormKirimQualitedHarga">Simpan</button> <button class="btn btn-default btn-sm BatalQualitedHarga">Batal</button>
    					</div>
            </div>
          </div>
				</form>
		</div>
	</div>
</div>
</div>
<!-- -------------------------------------------------------- END MODAL TAMBAH QUALITED DAN HARGA -->
<!-- -------------------------------------------------------- MODAL TAMBAH TOLERANSI MUTU -->
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalToleransiMutu" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Toleransi Mutu</h4>
			</div>
			<div class="modal-body">
				<form action="javascript:download();" class="fDataToleransiMutu" id="fDataToleransiMutu" name="fDataToleransiMutu">
          <div class="row">
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Nilai Min</label>
                <input autocomplete="off" class="form-control TOLERANSI_MUTU_NILAI_MIN" id="TOLERANSI_MUTU_NILAI_MIN" name="TOLERANSI_MUTU_NILAI_MIN" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Nilai Max</label>
                <input autocomplete="off" class="form-control TOLERANSI_MUTU_NILAI_MAX" id="TOLERANSI_MUTU_NILAI_MAX" name="TOLERANSI_MUTU_NILAI_MAX" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal Berlaku</label>
                <input autocomplete="off" class="form-control datepicker TOLERANSI_MUTU_TANGGAL_BERLAKU" data-date-format="yyyy/mm/dd" id="TOLERANSI_MUTU_TANGGAL_BERLAKU" name="TOLERANSI_MUTU_TANGGAL_BERLAKU" type="text" value="">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal Berakhir</label>
              <input autocomplete="off" class="form-control datepicker TOLERANSI_MUTU_TANGGAL_BERAKHIR" data-date-format="yyyy/mm/dd" id="TOLERANSI_MUTU_TANGGAL_BERAKHIR" name="TOLERANSI_MUTU_TANGGAL_BERAKHIR" type="text" value="">
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
    						<button class="btn btn-success btn-sm FormKirimToleransiMutu">Simpan</button> <button class="btn btn-default btn-sm BatalToleransiMutu">Batal</button>
    					</div>
            </div>
          </div>
				</form>
		</div>
	</div>
</div>
</div>
<!-- -------------------------------------------------------- END MODAL TAMBAH TOLERANASI MUTU -->
<!-- -------------------------------------------------------- MODAL TAMBAH DOKUMEN -->
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalDokumen" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Dokumen</h4>
			</div>
			<div class="modal-body">
				<form action="javascript:download();" class="fDataDokumen" id="fDataDokumen" name="fDataDokumen">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Jenis Dokumen</label>
                <input autocomplete="off" class="form-control FOTO_DOKUMEN" id="FOTO_DOKUMEN" name="FOTO_DOKUMEN" placeholder="FOTO_ASISTEN LENGKAP" type="hidden" >
                <select class="form-control JENIS_DOKUMEN" id="JENIS_DOKUMEN" name="JENIS_DOKUMEN" onchange="provinsi_keluarga()">
                  <option value="">
                    --Pilih Status--
                  </option>
                <?php foreach($RMP_CONFIG->user()->jenis_dokumen as $key=>$val){ echo"<option value='$key' >$val</option>"; } ?>
                </select>
								<p class="help-block">Jenis Dokumen.</p>
              </div>
            </div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Status Berlaku</label>
                <select class="form-control STATUS_BERLAKU" id="STATUS_BERLAKU" name="STATUS_BERLAKU" onchange="provinsi_keluarga()">
                  <option value="">
                    --Pilih Status--
                  </option>
                <?php foreach($RMP_CONFIG->user()->status_berlaku as $key=>$val){ echo"<option value='$key' >$val</option>"; } ?>
                </select>
								<p class="help-block text-danger">Status berlaku dokumen.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal Berlaku</label>
                <input autocomplete="off" class="form-control datepicker TANGGAL_BERLAKU_DOKUMEN" data-date-format="yyyy/mm/dd" id="TANGGAL_BERLAKU_DOKUMEN" name="TANGGAL_BERLAKU_DOKUMEN" type="text" value="">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-8">
              <div class="form-group">
              <img class="PRIVIEW_DOKUMEN_FOTO" height="200px" src="cloud/relasi_a" onerror="imgError(this);">
							<a class="link uploaddokumen"><i class="fa fa-upload"></i> Upload Dokumen</a>
            </div>
						</div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
    						<button class="btn btn-success btn-sm FormKirimDokumen">Simpan</button> <button class="btn btn-default btn-sm BatalDokumen">Batal</button>
    					</div>
            </div>
          </div>
				</form>
		</div>
	</div>
</div>
</div>
<!-- -------------------------------------------------------- END MODAL TAMBAH DOKUMEN -->
<!-- -------------------------------------------------------- MODAL TAMBAH KONTAK -->
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalKontak" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Kontak Supplier</h4>
			</div>
			<div class="modal-body">
				<form action="javascript:download();" class="fDataKontak" id="fDataKontak" name="fDataKontak">
          <div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Jenis Kontak</label>
                <select id="JENIS_KONTAK" name="JENIS_KONTAK"  type="text" class="col-sm-2 form-control JENIS_KONTAK" autocomplete="off" >
                  <option value="">--Pilih--</option>
                  <?php foreach($RMP_CONFIG->user()->jenis_kontak as $key=>$val)
                  {
                        echo"<option value='$key' >$val</option>";
                      } ?>
                </select>
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Kontak</label>
                <input autocomplete="off" class="form-control KONTAK" id="KONTAK" name="KONTAK" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>

            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Status Kontak</label>
                <select class="form-control STATUS_KONTAK" id="STATUS_KONTAK" name="STATUS_KONTAK">
                  <option value="">
                    --Pilih Status--
                  </option>
                <?php foreach($RMP_CONFIG->user()->status_berlaku as $key=>$val){ echo"<option value='$key' >$val</option>"; } ?>
                </select>
								<p class="help-block"></p>
							</div>
						</div>

          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
    						<button class="btn btn-success btn-sm FormKirimKontak">Simpan</button> <button class="btn btn-default btn-sm BatalKontak">Batal</button>
    					</div>
            </div>
          </div>
				</form>
		</div>
	</div>
</div>
</div>
<!-- -------------------------------------------------------- END MODAL TAMBAH KONTAK -->
<!-- -------------------------------------------------------- MODAL TAMBAH KELUARGA -->
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalKeluarga" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Keluarga</h4>
			</div>
			<div class="modal-body">
        <form action="javascript:download();" class="formPersonalKeluarga" id="formPersonalKeluarga" name="formPersonalKeluarga">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Lengkap</label>
                <input autocomplete="off" class="form-control NAMA_KELUARGA" id="NAMA_KELUARGA" name="NAMA_KELUARGA" placeholder="NAMA LENGKAP" type="text">
                <input autocomplete="off" class="form-control FOTO_KELUARGA" id="FOTO_KELUARGA" name="FOTO_KELUARGA" placeholder="FOTO_KELUARGA LENGKAP" type="hidden" >
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">No. KTP</label> <input autocomplete="off" class="form-control KTP_KELUARGA" id="KTP_KELUARGA" name="KTP_KELUARGA" placeholder="Nomor KTP" type="text">
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">NPWP</label> <input autocomplete="off" class="form-control NPWP_KELUARGA" id="NPWP_KELUARGA" name="NPWP_KELUARGA" placeholder="NPWP" type="text">
                <p class="help-block">Nomor Pokok Wajib Pajak.</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">No. Handphone</label>
                <input autocomplete="off" class="form-control HP_KELUARGA" id="HP_KELUARGA" name="HP_KELUARGA" placeholder="HP" type="text">
                <p class="help-block"></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Suku</label>
                <input autocomplete="off" class="form-control SUKU_KELUARGA" id="SUKU_KELUARGA" name="SUKU_KELUARGA" placeholder="SUKU"  type="text">
                <p class="help-block"></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Status Hubungan</label>
                <select class="form-control STATUS_HUBUNGAN_KELUARGA" id="STATUS_HUBUNGAN_KELUARGA" name="STATUS_HUBUNGAN_KELUARGA" onchange="provinsi_keluarga()">
                  <option value="">
                    --Pilih Status--
                  </option>
                <?php foreach($RMP_CONFIG->user()->status_keluarga as $key=>$val){ echo"<option value='$key' >$val</option>"; } ?>
                </select>
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Provinsi</label>
                <select class="form-control PROVINSI_KELUARGA" id="PROVINSI_KELUARGA" name="PROVINSI_KELUARGA" onchange="provinsi_keluarga()">
                  <option value="">
                    --Pilih Provinsi--
                  </option>
                </option><?php  $data = $RMP_CONFIG->provinsi(); foreach ($data['rasult'] as $key => $value) {   foreach ($value as $data => $isi)       { ?>
                <option value="<?php echo $isi['INDONESIA_PROVINSI_ID']; ?>">
                  <?php  echo $isi['INDONESIA_PROVINSI'];?>
                </option><?php   }}      ?>
                </select>
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Kabupaten</label>
                <select id="KABUPATEN_KELUARGA" name="KABUPATEN_KELUARGA"  type="text" class="col-sm-2 form-control KABUPATEN_KELUARGA"  autocomplete="off"  onchange="kabupaten_keluarga()" >
                </select>
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Kecamatan</label>
                <select id="KECAMATAN_KELUARGA" name="KECAMATAN_KELUARGA"  type="text" class="col-sm-2 form-control KECAMATAN_KELUARGA"  autocomplete="off"  onchange="kecamatan_keluarga()" >
                </select>
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Desa</label>
                <select id="DESA_KELUARGA" name="DESA_KELUARGA"  type="text" class="col-sm-2 form-control DESA_KELUARGA"  autocomplete="off" >
                </select>
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <input autocomplete="off" class="form-control ALAMAT_PERSONAL_KELUARGA" name="ALAMAT_PERSONAL_KELUARGA" id="ALAMAT_PERSONAL_KELUARGA" placeholder="" type="text">
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
            <!-- <div class="col-md-8">
              <div class="row">
    <div class="col-md-3">

      <img class="PRIVIEW_KELUARGA_FOTO img-thumbnail" src="cloud/relasi_a" onerror="imgError(this);">

    </div>
    <div class="col-md-9">
    <strong>Ketentuan Upload Foto</strong>
    <ol>
      <li>Gunakan foto format : JPG, PNG, GIF, JPEG.</li>
      <li>Foto yang diupload sebaiknya sudah diresize menjadi ukuran 3x4 cm.</li>
      <li>Ukuran maksimal foto yang boleh diupload adalah 1MB.</li>
    </ol>
    <a class="link uploadfotobtnkeluarga"><i class="fa fa-camera"></i> Upload Foto</a>
    <div class="notifikasi-perubahan-foto"></div>
    </div>
  </div>
            </div> -->
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
    						<button class="btn btn-success btn-sm FormKirimKeluarga">Simpan</button> <button class="btn btn-default btn-sm BatalKeluarga">Batal</button>
    					</div>
            </div>
          </div>
        </form>
		</div>
	</div>
</div>
</div>
<!-- -------------------------------------------------------- END MODAL TAMBAH KELUARGA -->
<!-- -------------------------------------------------------- MODAL TAMBAH ASISTEN -->
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalAsisten" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Asisten</h4>
			</div>
			<div class="modal-body">
        <form action="javascript:download();" class="formPersonalAsisten" id="formPersonalAsisten" name="formPersonalAsisten">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Lengkap</label>
                <input autocomplete="off" class="form-control NAMA_ASISTEN" id="NAMA_ASISTEN" name="NAMA_ASISTEN" placeholder="NAMA LENGKAP" type="text">
                <input autocomplete="off" class="form-control FOTO_ASISTEN" id="FOTO_ASISTEN" name="FOTO_ASISTEN" placeholder="FOTO_ASISTEN LENGKAP" type="hidden" >
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">No. KTP</label> <input autocomplete="off" class="form-control KTP_ASISTEN" id="KTP_ASISTEN" name="KTP_ASISTEN" placeholder="Nomor KTP" type="text">
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">NPWP</label> <input autocomplete="off" class="form-control NPWP_ASISTEN" id="NPWP_ASISTEN" name="NPWP_ASISTEN" placeholder="NPWP" type="text">
                <p class="help-block">Nomor Pokok Wajib Pajak.</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">No. Handphone</label>
                <input autocomplete="off" class="form-control HP_ASISTEN" id="HP_ASISTEN" name="HP_ASISTEN" placeholder="HP" type="text">
                <p class="help-block"></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Suku</label>
                <input autocomplete="off" class="form-control SUKU_ASISTEN" id="SUKU_ASISTEN" name="SUKU_ASISTEN" placeholder="SUKU"  type="text">
                <p class="help-block"></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Provinsi</label>
                <select class="form-control PROVINSI_ASISTEN" id="PROVINSI_ASISTEN" name="PROVINSI_ASISTEN" onchange="provinsi_asisten()">
                  <option value="">
                    --Pilih Provinsi--
                  </option>
                </option><?php  $data = $RMP_CONFIG->provinsi(); foreach ($data['rasult'] as $key => $value) {   foreach ($value as $data => $isi)       { ?>
                <option value="<?php echo $isi['INDONESIA_PROVINSI_ID']; ?>">
                  <?php  echo $isi['INDONESIA_PROVINSI'];?>
                </option><?php   }}      ?>
                </select>
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Kabupaten</label>
                <select id="KABUPATEN_ASISTEN" name="KABUPATEN_ASISTEN"  type="text" class="col-sm-2 form-control KABUPATEN_ASISTEN"  autocomplete="off"  onchange="kabupaten_asisten()" >
                </select>
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Kecamatan</label>
                <select id="KECAMATAN_ASISTEN" name="KECAMATAN_ASISTEN"  type="text" class="col-sm-2 form-control KECAMATAN_ASISTEN"  autocomplete="off"  onchange="kecamatan_asisten()" >
                </select>
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Desa</label>
                <select id="DESA_ASISTEN" name="DESA_ASISTEN"  type="text" class="col-sm-2 form-control DESA_ASISTEN"  autocomplete="off" >
                </select>
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <input autocomplete="off" class="form-control ALAMAT_PERSONAL_ASISTEN" name="ALAMAT_PERSONAL_ASISTEN" id="ALAMAT_PERSONAL_ASISTEN" placeholder="" type="text">
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="row">
    <div class="col-md-3">

      <img class="PRIVIEW_ASISTEN_FOTO img-thumbnail" src="cloud/relasi_a" onerror="imgError(this);">

    </div>
    <div class="col-md-9">
    <strong>Ketentuan Upload Foto</strong>
    <ol>
      <li>Gunakan foto format : JPG, PNG, GIF, JPEG.</li>
      <li>Foto yang diupload sebaiknya sudah diresize menjadi ukuran 3x4 cm.</li>
      <li>Ukuran maksimal foto yang boleh diupload adalah 1MB.</li>
    </ol>
    <a class="link uploadfotobtnasisten"><i class="fa fa-camera"></i> Upload Foto</a>
    <div class="notifikasi-perubahan-foto"></div>
    </div>
  </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
    						<button class="btn btn-success btn-sm FormKirimAsisten">Simpan</button> <button class="btn btn-default btn-sm BatalAsisten">Batal</button>
    					</div>
            </div>
          </div>
        </form>
		</div>
	</div>
</div>
</div>
<!-- -------------------------------------------------------- END MODAL TAMBAH ASISTEN -->

<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg uploadFotoModal" role="dialog" tabindex="-1">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Upload Foto</h4>
			</div>
      <form action="?show=/upload/local_dir/" method="POST" enctype="multipart/form-data" id="f-upload1">
      <div class="modal-body">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
					<div class="input-group input-group-lg">
						<input type="file" name="image" id="image">
						<!-- <span class="btn btn-default  btn-file input-group-addon" id="galeri_list"><span id="load_galeri"><i class="glyphicon glyphicon-globe"></i> Pilih Dari Drive </span></span> -->
						<input type="hidden" name="TOOL_FILES_GROUP" id="TOOL_FILES_GROUP" value="PERSONAL_FOTO">
					</div>

				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
					<div id="load_img"><small><a href="javascript:;" data-toggle="popover" data-placement="top" title="Tambahkan Gambar" data-content="Silahkan pilih lokasi gambar yang akan ditambahkan. Kemudian klik Start Upload">Help</a></small></div>
					<ul class="row" id="tool_files_list" style="list-style:none;padding:0">
						<!---file list-->
					</ul>
					<button class="btn btn-default btn-sm col-md-12 hidden" id="btn-more-files" type="button">Load More</button>
				</div>
			</div>
      </div>

      <div class="modal-footer">
		<div id="error-msg"></div>
		<div class="row">
			<div class="col-md-7">
				 <div class="input-group hidden" id="tool_files_search">
				  <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Pencarian...">
				  <span class="input-group-btn">
					<button class="btn btn-danger" type="button" id="btn-tool_files_search">Cari</button>
				  </span>
				</div><!-- /input-group -->

				<div id="lokasi_file">
				  <div class="checkbox">
					<input type="hidden"   name="TOOL_FILES_DIRECTORY" id="TOOL_FILES_DIRECTORY" value="cloud/relasi_a/">
				  </div>
				</div><!-- /input-group -->
			</div>
			<div class="col-md-5">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-success btn-sm" id="upload">Upload</button>
			</div>
        </div><!--/row-->
      </div><!--/modal-footer-->
      </form><!--/ form-->
	</div>
</div>
</div>
<!-------------------------------------------------------------------------------------- -->
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg uploadFotoModalAsisten" role="dialog" tabindex="-1">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Upload Foto Asisten</h4>
			</div>
      <form action="?show=/upload/local_dir/" method="POST" enctype="multipart/form-data" id="f-upload1_asisten">
      <div class="modal-body">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
					<div class="input-group input-group-lg">
						<input type="file" name="image" id="image">
						<!-- <span class="btn btn-default  btn-file input-group-addon" id="galeri_list"><span id="load_galeri"><i class="glyphicon glyphicon-globe"></i> Pilih Dari Drive </span></span> -->
						<input type="hidden" name="TOOL_FILES_GROUP" id="TOOL_FILES_GROUP" value="PERSONAL_FOTO">
					</div>

				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
					<div id="load_img_asisten"><small><a href="javascript:;" data-toggle="popover" data-placement="top" title="Tambahkan Gambar" data-content="Silahkan pilih lokasi gambar yang akan ditambahkan. Kemudian klik Start Upload">Help</a></small></div>
					<ul class="row" id="tool_files_list" style="list-style:none;padding:0">
						<!---file list-->
					</ul>
					<button class="btn btn-default btn-sm col-md-12 hidden" id="btn-more-files" type="button">Load More</button>
				</div>
			</div>
      </div>

      <div class="modal-footer">
		<div id="error-msg"></div>
		<div class="row">
			<div class="col-md-7">
				 <div class="input-group hidden" id="tool_files_search">
				  <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Pencarian...">
				  <span class="input-group-btn">
					<button class="btn btn-danger" type="button" id="btn-tool_files_search">Cari</button>
				  </span>
				</div><!-- /input-group -->

				<div id="lokasi_file">
				  <div class="checkbox">
					<input type="hidden" name="TOOL_FILES_DIRECTORY" id="TOOL_FILES_DIRECTORY" value="cloud/relasi_a/">
				  </div>
				</div><!-- /input-group -->
			</div>
			<div class="col-md-5">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-success btn-sm" id="uploadasisten">Upload</button>
			</div>
        </div><!--/row-->
      </div><!--/modal-footer-->
      </form><!--/ form-->
	</div>
</div>
</div>
<!-------------------------------------------------------------------------------------- -->
<!-------------------------------------------------------------------------------------- -->
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg uploadFotoModalDokumen" role="dialog" tabindex="-1">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Upload Dokumen</h4>
			</div>
      <form action="?show=/upload/local_dir/" method="POST" enctype="multipart/form-data" id="f-upload1_dokumen">
      <div class="modal-body">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
					<div class="input-group input-group-lg">
						<input type="file" name="image" id="image">
						<!-- <span class="btn btn-default  btn-file input-group-addon" id="galeri_list"><span id="load_galeri"><i class="glyphicon glyphicon-globe"></i> Pilih Dari Drive </span></span> -->
						<input type="hidden" name="TOOL_FILES_GROUP" id="TOOL_FILES_GROUP" value="PERSONAL_FOTO">
					</div>

				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
					<div id="load_img_dokumen"><small><a href="javascript:;" data-toggle="popover" data-placement="top" title="Tambahkan Gambar" data-content="Silahkan pilih lokasi gambar yang akan ditambahkan. Kemudian klik Start Upload">Help</a></small></div>
					<ul class="row" id="tool_files_list" style="list-style:none;padding:0">
						<!---file list-->
					</ul>
					<button class="btn btn-default btn-sm col-md-12 hidden" id="btn-more-files" type="button">Load More</button>
				</div>
			</div>
      </div>

      <div class="modal-footer">
		<div id="error-msg"></div>
		<div class="row">
			<div class="col-md-7">
				 <div class="input-group hidden" id="tool_files_search">
				  <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Pencarian...">
				  <span class="input-group-btn">
					<button class="btn btn-danger" type="button" id="btn-tool_files_search">Cari</button>
				  </span>
				</div><!-- /input-group -->

				<div id="lokasi_file">
				  <div class="checkbox">
					<input type="hidden" name="TOOL_FILES_DIRECTORY" id="TOOL_FILES_DIRECTORY" value="cloud/relasi_a/">
				  </div>
				</div><!-- /input-group -->
			</div>
			<div class="col-md-5">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-success btn-sm" id="uploaddokumen">Upload</button>
			</div>
        </div><!--/row-->
      </div><!--/modal-footer-->
      </form><!--/ form-->
	</div>
</div>
</div>
<!-------------------------------------------------------------------------------------- -->
<script>

function imgError(image) {
    image.onerror = "";
    image.src = "/cloud/no_image.png";
    return true;
}

$('.tambah_wilayah').on('click', function()
{
	$(".modalWilayah").modal('show');
});
$('.BatalWilayah').on('click', function()
{
	$(".modalWilayah").modal('hide');
});

$('.tambah_asisten').on('click', function()
{
	$(".modalAsisten").modal('show');
});
$('.BatalAsisten').on('click', function()
{
	$(".modalAsisten").modal('hide');
});

$('.tambah_rekening').on('click', function()
{
	$(".modalRekening").modal('show');
});
$('.BatalRekening').on('click', function()
{
	$(".modalRekening").modal('hide');
});

$('.tambah_rekeningrelasi').on('click', function()
{
  var kode_wilayah = $('select.WILAYAH_SUPPLIER option:selected').attr('KODE_WILAYAH');
  console.log(kode_wilayah);
  $("input.NO_REKENING_KODE_WILAYAH").val(kode_wilayah);


  var kode_sub_wilayah = $('select.SUB_WILAYAH_SUPPLIER option:selected').attr('KODE_WILAYAH');
  var id_sub_wilayah= $('select.SUB_WILAYAH_SUPPLIER').val();
  console.log(kode_sub_wilayah);
  console.log(id_sub_wilayah);
  $("input.NO_REKENING_SUB_WILAYAH").val(kode_sub_wilayah);
  $("input.NO_REKENING_ID_SUB_WILAYAH").val(id_sub_wilayah);

	$(".modalRekeningRelasi").modal('show');
});

$('.BatalRekeningRelasi').on('click', function()
{
	$(".modalRekeningRelasi").modal('hide');
});

$('.tambah_kontak').on('click', function()
{
	$(".modalKontak").modal('show');
});
$('.BatalKontak').on('click', function()
{
	$(".modalKontak").modal('hide');
});

$('.tambah_keluarga').on('click', function()
{
	$(".modalKeluarga").modal('show');
});
$('.BatalKeluarga').on('click', function()
{
	$(".modalKeluarga").modal('hide');
});

$('.tambah_qualited_harga').on('click', function()
{
	$(".modalQualitedHarga").modal('show');
});
$('.BatalQualitedHarga').on('click', function()
{
	$(".modalQualitedHarga").modal('hide');
});

$('.tambah_toleransi_mutu').on('click', function()
{
	$(".modalToleransiMutu").modal('show');
});
$('.BatalToleransiMutu').on('click', function()
{
	$(".modalToleransiMutu").modal('hide');
});


$('.tambah_dokumen').on('click', function()
{
	$(".modalDokumen").modal('show');
});
$('.BatalDokumen').on('click', function()
{
	$(".modalDokumen").modal('hide');
});



$(function()
{
	$(".datepicker").datepicker().on('changeDate', function(ev)
  {
		$('.datepicker').datepicker('hide');
	});
});

var KABUPATEN = function()
{
	var PROVINSI_VAL = $('select.PROVINSI').val();
	$.ajax({
		type: 'POST',
		url: refseeAPI,
		dataType: 'json',
		data: 'ref=sel_kabupaten&PROVINSI=' + PROVINSI_VAL,
		success: function(data)
    {
			if (data.respon.pesan == "sukses")
      {
				$('select.KABUPATEN').empty();
				for (s = 0; s < data.result.length; s++)
        {
					$('select.KABUPATEN').append('<option value="' + data.result[s].INDONESIA_KABUPATEN_ID + '">' + data.result[s].INDONESIA_KABUPATEN + '</option>');
				}
			} else if (data.respon.pesan == "gagal")
      {

			}
		}, //end success
		error: function(x, e)
    {
		} //end error
	});
}

function provinsi()
{
	var send = new KABUPATEN();
	$('select.KECAMATAN').empty();
	$('select.DESA').empty();
};

var KECAMATAN = function()
{
	var KABUPATEN_VAL = $('select.KABUPATEN').val();
	$.ajax({
		type: 'POST',
		url: refseeAPI,
		dataType: 'json',
		data: 'ref=sel_kecamatan&KABUPATEN=' + KABUPATEN_VAL,
		success: function(data) {
			if (data.respon.pesan == "sukses")
      {
				$('select.KECAMATAN').empty();
				for (s = 0; s < data.result.length; s++)
        {
					$('select.KECAMATAN').append('<option value="' + data.result[s].INDONESIA_KECAMATAN_ID + '">' + data.result[s].INDONESIA_KECAMATAN + '</option>');
				}
			} else if (data.respon.pesan == "gagal")
      {
			}
		}, //end success
		error: function(x, e)
    {
		} //end error
	});
}

function kabupaten()
{
	var send = new KECAMATAN();
	$('select.DESA').empty();
};


var DESA = function()
{
	var KECAMATAN_VAL = $('select.KECAMATAN').val();
	console.log(KECAMATAN_VAL);
	$.ajax({
		type: 'POST',
		url: refseeAPI,
		dataType: 'json',
		data: 'ref=sel_desa&KECAMATAN=' + KECAMATAN_VAL,
		success: function(data)
    {
			if (data.respon.pesan == "sukses")
      {
				$('select.DESA').empty();
				for (s = 0; s < data.result.length; s++)
        {
					$('select.DESA').append('<option value="' + data.result[s].INDONESIA_DESA_ID + '">' + data.result[s].INDONESIA_DESA + '</option>');
				}
			} else if (data.respon.pesan == "gagal")
      {
				console.log(data.respon.text_msg);
			}
		}, //end success
		error: function(x, e)
    {
			console.log("Error Ajax");
		} //end error
	});
}

function kecamatan()
{
	var send = new DESA();
};

var SUB_WILAYAH = function()
{
  var WILAYAH = $('select.WILAYAH_SUPPLIER').val();
  //console.log(KECAMATAN_VAL2);
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=sub_wilayah&WILAYAH=' + WILAYAH,
    success: function(data)
    {
      if (data.respon.pesan == "sukses")
      {
        console.log("Sukses");
        $('select.SUB_WILAYAH_SUPPLIER').empty();
        for (s = 0; s < data.result.length; s++)
        {
          //'console.info(data.result[s].INDONESIA_DESA);
          $('select.SUB_WILAYAH_SUPPLIER').append('<option value="' + data.result[s].RMP_MASTER_WILAYAH_ID + '" KODE_WILAYAH="' + data.result[s].RMP_MASTER_WILAYAH_KODE + '">' + data.result[s].RMP_MASTER_WILAYAH + '</option>');
        }
      } else if (data.respon.pesan == "gagal")
      {
        console.log(data.respon.text_msg);
      }
    }, //end success
    error: function(x, e)
    {
      console.log("Error Ajax");
    } //end error
  });
}

function wilayah_supplier()
{
  console.log("ONCHANGE")
  var send = new SUB_WILAYAH();
};

$('.simpanPersonal').on('click',function()
{
// $('.simpanPersonal').html('Loading...');
// $('.simpanPersonal').attr('disabled', true);
var formPersonal = $('form.formPersonal').serialize();
console.log(formPersonal);

if ($('.NAMA').val() == "")
{
  alert ("Nama Tidak Boleh Kosong");
}
else if ($('.KTP').val() == "")
{
  alert ("Nomor KTP Tidak Boleh Kosong");
}
else if ($('.TANGGAL_DAFTAR').val() == "")
{
  alert ("Tanggal Pendaftaran Tidak Boleh Kosong");
}
else if ($('.JENIS_SUPPLIER').val() == "")
{
  alert ("Jenis Supplier Harus Dipilih");
}
else if ($('.PROVINSI').val() == "")
{
  alert ("Provinsi Harus Dipilih");
}
else if ($('.KABUPATEN').val() == "")
{
  alert ("Kabupaten Harus Dipilih");
}
else if ($('.ALAMAT_PERSONAL').val() == "")
{
  alert ("Alamat Tidak Boleh Kosong");
}
else if ($('.WILAYAH_SUPPLIER').val() == "")
{
  alert ("Wilayah Supplier Harus Dipilih");
}
else if ($('.SUB_WILAYAH_SUPPLIER').val() == "")
{
  alert ("Lokasi Harus Dipilih");
}
else {
  $('.simpanPersonal').html('Loading...');
  $('.simpanPersonal').attr('disabled', true);

        $.ajax({
        	type: 'POST',
        	url: refseeAPI,
        	dataType: 'json',
        	data: 'ref=add_personal&' + formPersonal,
        	success: function(data)
          {
        		if (data.respon.pesan == "sukses")
        		{
        			console.log(data.respon.text_msg);
              alert ("Berhasil");
        			window.location.href = "?show=rmp/supplier/master_supplier";
        		}
        		else if (data.respon.pesan == "gagal")
        		{
        			console.log(data.respon.text_msg);
        			alert("Gagal Menyimpan");
        		}
        	}, //end success
        	error: function(x, e)
          {
        		console.log("Error Ajax");
        	} //end error
        });
      }
})



////////////////////////////////////// TAMBAH WILAYAH /////////////////////////////////////
////////////////////////////////////// TAMBAH ASISTEN /////////////////////////////////////
var KABUPATEN_ASISTEN = function() {
	var PROVINSI_VAL_ASISTEN = $('select.PROVINSI_ASISTEN').val();
	//console.log(PROVINSI_VAL);
	$.ajax({
		type: 'POST',
		url: refseeAPI,
		dataType: 'json',
		data: 'ref=sel_kabupaten&PROVINSI=' + PROVINSI_VAL_ASISTEN,
		success: function(data) {
			if (data.respon.pesan == "sukses") {
				//console.log("Sukses");
				$('select.KABUPATEN_ASISTEN').empty();
				for (s = 0; s < data.result.length; s++) {
					//console.log(data.result[s].INDONESIA_KABUPATEN);
					$('select.KABUPATEN_ASISTEN').append('<option value="' + data.result[s].INDONESIA_KABUPATEN_ID + '">' + data.result[s].INDONESIA_KABUPATEN + '</option>');
				}
			} else if (data.respon.pesan == "gagal") {
				//console.log("Gagal");
			}
		}, //end success
		error: function(x, e) {
			//console.log("Error Ajax");
		} //end error
	});
}

function provinsi_asisten() {
	//console.log("ONCHANGE")
	var send = new KABUPATEN_ASISTEN();
	$('select.KECAMATAN_ASISTEN').empty();
	$('select.DESA_ASISTEN').empty();
};



var KECAMATAN_ASISTEN = function() {
	var KABUPATEN_VAL_ASISTEN = $('select.KABUPATEN_ASISTEN').val();
	//console.log(KABUPATEN_VAL);
	$.ajax({
		type: 'POST',
		url: refseeAPI,
		dataType: 'json',
		data: 'ref=sel_kecamatan&KABUPATEN=' + KABUPATEN_VAL_ASISTEN,
		success: function(data) {
			if (data.respon.pesan == "sukses") {
				//console.log("Sukses");
				$('select.KECAMATAN_ASISTEN').empty();
				for (s = 0; s < data.result.length; s++) {
					//console.log(data.result[s].INDONESIA_KECAMATAN);
					$('select.KECAMATAN_ASISTEN').append('<option value="' + data.result[s].INDONESIA_KECAMATAN_ID + '">' + data.result[s].INDONESIA_KECAMATAN + '</option>');
				}
			} else if (data.respon.pesan == "gagal") {
				//console.log("Gagal");
			}
		}, //end success
		error: function(x, e) {
			//console.log("Error Ajax");
		} //end error
	});
}

function kabupaten_asisten() {
	//console.log("ONCHANGE")
	var send = new KECAMATAN_ASISTEN();
	$('select.DESA_ASISTEN').empty();
};


var DESA_ASISTEN = function() {
	var KECAMATAN_VAL_ASISTEN = $('select.KECAMATAN_ASISTEN').val();
	console.log(KECAMATAN_VAL_ASISTEN);
	$.ajax({
		type: 'POST',
		url: refseeAPI,
		dataType: 'json',
		data: 'ref=sel_desa&KECAMATAN=' + KECAMATAN_VAL_ASISTEN,
		success: function(data) {
			if (data.respon.pesan == "sukses") {
				//'console.log("Sukses");
				$('select.DESA_ASISTEN').empty();
				for (s = 0; s < data.result.length; s++) {
					//'console.info(data.result[s].INDONESIA_DESA);
					$('select.DESA_ASISTEN').append('<option value="' + data.result[s].INDONESIA_DESA_ID + '">' + data.result[s].INDONESIA_DESA + '</option>');
				}
			} else if (data.respon.pesan == "gagal") {
				console.log(data.respon.text_msg);
			}
		}, //end success
		error: function(x, e) {
			console.log("Error Ajax");
		} //end error
	});
}

function kecamatan_asisten() {
	//'console.log("ONCHANGE");
	var send = new DESA_ASISTEN();
};

$('.FormKirimAsisten').on('click',function(){
var id_supplier = "ID_SUPPLIER="+$('.ID_SUPPLIER').val();
var formPersonalAsisten = $('form.formPersonalAsisten').serialize();
var fDataAsisten = id_supplier +"&"+formPersonalAsisten;
console.log(fDataAsisten);
if ($('.NAMA_ASISTEN').val() == "")
{
  alert ("Nama Tidak Boleh Kosong");
}
else if ($('.HP_ASISTEN').val() == "")
{
  alert ("Nomor Handphone Tidak Boleh Kosong");
}
else
{
$.ajax({
	type: 'POST',
	url: refseeAPI,
	dataType: 'json',
	data: 'ref=add_asisten&' + fDataAsisten ,
	success: function(data) {
		if (data.respon.pesan == "sukses")
		{
			console.log(data.respon.text_msg);

      	$(".modalAsisten").modal('hide');
        asisten_list();
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
}
})

function asisten_list(curPage)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=asisten_list&ID_SUPPLIER=' + $('input#ID_SUPPLIER').val(),
    success: function(data)
    {
      if (data.respon.pesan == "sukses")
      {
				console.log(data.respon.text_msg);
        $("tbody#data_asisten").empty();
        for (i = 0; i < data.result.length; i++)
        {
          $("tbody#data_asisten").append("<tr class='detailLogId'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td><img  height='70' src='cloud/relasi_a/"+ data.result[i].RMP_MASTER_PERSONAL_FOTO +"' onerror='imgError(this);'/></td>" +
					"<td>" + data.result[i].RMP_MASTER_PERSONAL_NAMA +  "</td>" +
					"<td>" + data.result[i].RMP_MASTER_PERSONAL_HP +  "</td>" +
					"<td>" + data.result[i].RMP_MASTER_PERSONAL_ALAMAT + ", " + data.result[i].INDONESIA_DESA + ", " + data.result[i].INDONESIA_KECAMATAN + ", " + data.result[i].INDONESIA_KABUPATEN + ", " + data.result[i].INDONESIA_PROVINSI + "</td>" +
          "<td><a class='btn btn-danger btn-sm hapus_asisten' ID_ASISTEN='" + data.result[i].RMP_ASISTEN_ID +  "'><i aria-hidden='true' class='fa fa-trash'></i></a></td>" +
        "</tr>");
        }
      }
      else if (data.respon.pesan == "gagal")
      {
        $("tbody#data_asisten").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e)
    {
      //error_handler_json(x, e, '=> barang_kamus_list()');
    } //end error
  });
}

$(function() {
  asisten_list();
});

$("tbody#data_asisten").on('click','a.hapus_asisten', function()
{
  var id = $(this).attr('ID_ASISTEN');
  console.log(id);
  if(confirm('Apakah anda sudah yakin menghapus data ?')) {
		hapus_asisten(id)
	}
})

function hapus_asisten(id)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=hapus_asisten&ID=' + id ,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        console.log(data.respon.text_msg);
          asisten_list();
      }
      else if (data.respon.pesan == "gagal")
      {
        console.log(data.respon.text_msg);
        alert("Gagal Menghapus");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}
////////////////////////////////////// END TAMBAH ASISTEN /////////////////////////////////////
var KABUPATEN2 = function() {
	var PROVINSI_VAL2 = $('select.PROVINSI2').val();
	//console.log(PROVINSI_VAL);
	$.ajax({
		type: 'POST',
		url: refseeAPI,
		dataType: 'json',
		data: 'ref=sel_kabupaten&PROVINSI=' + PROVINSI_VAL2,
		success: function(data) {
			if (data.respon.pesan == "sukses") {
				//console.log("Sukses");
				$('select.KABUPATEN2').empty();
				for (s = 0; s < data.result.length; s++) {
					//console.log(data.result[s].INDONESIA_KABUPATEN);
					$('select.KABUPATEN2').append('<option value="' + data.result[s].INDONESIA_KABUPATEN_ID + '">' + data.result[s].INDONESIA_KABUPATEN + '</option>');
				}
			} else if (data.respon.pesan == "gagal") {
				//console.log("Gagal");
			}
		}, //end success
		error: function(x, e) {
			//console.log("Error Ajax");
		} //end error
	});
}

function provinsi2() {
	//console.log("ONCHANGE")
	var send = new KABUPATEN2();
	$('select.KECAMATAN2').empty();
	$('select.DESA2').empty();
};



var KECAMATAN2 = function() {
	var KABUPATEN_VAL2 = $('select.KABUPATEN2').val();
	//console.log(KABUPATEN_VAL);
	$.ajax({
		type: 'POST',
		url: refseeAPI,
		dataType: 'json',
		data: 'ref=sel_kecamatan&KABUPATEN=' + KABUPATEN_VAL2,
		success: function(data) {
			if (data.respon.pesan == "sukses") {
				//console.log("Sukses");
				$('select.KECAMATAN2').empty();
				for (s = 0; s < data.result.length; s++) {
					//console.log(data.result[s].INDONESIA_KECAMATAN);
					$('select.KECAMATAN2').append('<option value="' + data.result[s].INDONESIA_KECAMATAN_ID + '">' + data.result[s].INDONESIA_KECAMATAN + '</option>');
				}
			} else if (data.respon.pesan == "gagal") {
				//console.log("Gagal");
			}
		}, //end success
		error: function(x, e) {
			//console.log("Error Ajax");
		} //end error
	});
}

function kabupaten2() {
	//console.log("ONCHANGE")
	var send = new KECAMATAN2();
	$('select.DESA2').empty();
};


var DESA2 = function() {
	var KECAMATAN_VAL2 = $('select.KECAMATAN2').val();
	console.log(KECAMATAN_VAL2);
	$.ajax({
		type: 'POST',
		url: refseeAPI,
		dataType: 'json',
		data: 'ref=sel_desa&KECAMATAN=' + KECAMATAN_VAL2,
		success: function(data) {
			if (data.respon.pesan == "sukses") {
				//'console.log("Sukses");
				$('select.DESA2').empty();
				for (s = 0; s < data.result.length; s++) {
					//'console.info(data.result[s].INDONESIA_DESA);
					$('select.DESA2').append('<option value="' + data.result[s].INDONESIA_DESA_ID + '">' + data.result[s].INDONESIA_DESA + '</option>');
				}
			} else if (data.respon.pesan == "gagal") {
				console.log(data.respon.text_msg);
			}
		}, //end success
		error: function(x, e) {
			console.log("Error Ajax");
		} //end error
	});
}

function kecamatan2() {
	//'console.log("ONCHANGE");
	var send = new DESA2();
};

$('.FormKirimWilayah').on('click',function(){
var id_supplier = "ID_SUPPLIER="+$('.ID_SUPPLIER').val();
var formwilayah = $('form.fDataWilayah').serialize();
var fDataWilayah = id_supplier +"&"+formwilayah;
console.log(fDataWilayah);

$.ajax({
	type: 'POST',
	url: refseeAPI,
	dataType: 'json',
	data: 'ref=add_wilayah&' + fDataWilayah ,
	success: function(data) {
		if (data.respon.pesan == "sukses")
		{
			console.log(data.respon.text_msg);
			//window.location.href = "?show=rmp/supplier/MASTER_PERSONAL";
      	$(".modalWilayah").modal('hide');
        wilayah_list();
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

function wilayah_list(curPage)
{

  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=wilayah_list&ID_SUPPLIER=' + $('input#ID_SUPPLIER').val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log(data.respon.text_msg);
        $("tbody#data_wilayah").empty();
        for (i = 0; i < data.result.length; i++) {
          var estimasi_luas_naik_baris = data.result[i].RMP_WILAYAH_LUAS_BARIS_NAIK + "m&#178;";
          var panjang_lebar = data.result[i].RMP_WILAYAH_PANJANG_WILAYAH + "m&#178; x " + data.result[i].RMP_WILAYAH_LEBAR_WILAYAH + "m&#178;";
          var luas = data.result[i].RMP_WILAYAH_LUAS + "m&#178;" ;
          $("tbody#data_wilayah").append("<tr class='detailLogId'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_WILAYAH_ALAMAT + ", " + data.result[i].INDONESIA_DESA + ", " + data.result[i].INDONESIA_KECAMATAN + ", " + data.result[i].INDONESIA_KABUPATEN + ", " + data.result[i].INDONESIA_PROVINSI + "</td>" +
          "<td>" + data.result[i].RMP_WILAYAH_BARIS_WILAYAH + " & " + data.result[i].RMP_WILAYAH_NAIK_WILAYAH + "</td>" +
          "<td>" + estimasi_luas_naik_baris + "</td>" +
          "<td>" + panjang_lebar + "</td>" +
          "<td>" + luas + "</td>" +
          "<td><a class='btn btn-danger btn-sm hapus_wilayah' ID_WILAYAH='" + data.result[i].RMP_WILAYAH_ID +  "'><i aria-hidden='true' class='fa fa-trash'></i></a></td>" +
					"<td></td>" + "</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#data_wilayah").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      //error_handler_json(x, e, '=> barang_kamus_list()');
    } //end error
  });
}

$(function() {
  wilayah_list();
});


$("tbody#data_wilayah").on('click','a.hapus_wilayah', function()
{
  var id = $(this).attr('ID_WILAYAH');
  console.log(id);
  if(confirm('Apakah anda sudah yakin menghapus data ?')) {
		hapus_wilayah(id)
	}
})

function hapus_wilayah(id)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=hapus_wilayah&ID=' + id ,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        console.log(data.respon.text_msg);
          wilayah_list();
      }
      else if (data.respon.pesan == "gagal")
      {
        console.log(data.respon.text_msg);
        alert("Gagal Menghapus");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}
////////////////////////////////////// END TAMBAH WILAYAH /////////////////////////////////////
////////////////////////////////////// TAMBAH REKENING /////////////////////////////////////
$('.FormKirimRekening').on('click',function(){
var id_supplier = "ID_SUPPLIER="+$('.ID_SUPPLIER').val();
var formrekening = $('form.fDataRekening').serialize();
var fDataRekening = id_supplier +"&"+formrekening;
console.log(fDataRekening);
if ($('.BANK').val() == "")
{
  alert ("Bank harus dipilih.");
}
else if ($('.NO_REKENING').val() == "")
{
  alert ("Nomor rekening tidak boleh kosong.");
}
else if ($('.NAMA_REKENING').val() == "")
{
  alert ("Nama pemilik rekening tidak boleh kosong.");
}
else
{
$.ajax({
	type: 'POST',
	url: refseeAPI,
	dataType: 'json',
	data: 'ref=add_rekening&' + fDataRekening ,
	success: function(data) {
		if (data.respon.pesan == "sukses")
		{
			console.log(data.respon.text_msg);
      	$(".modalRekening").modal('hide');
        rekening_list();
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
}
})

function rekening_list(curPage)
{

  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=rekening_list&ID_SUPPLIER=' + $('input#ID_SUPPLIER').val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log(data.respon.text_msg);
        $("tbody#data_rekening").empty();
        for (i = 0; i < data.result.length; i++) {
          $("tbody#data_rekening").append("<tr class='detailLogId'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_REKENING_KODE_BANK +  "</td>" +
					"<td>" + data.result[i].MASTER_BANK_NAMA +  "</td>" +
					"<td>" + data.result[i].RMP_REKENING +  "</td>" +
					"<td>" + data.result[i].RMP_REKENING_NAMA +  "</td>" +
          "<td><a class='btn btn-danger btn-sm hapus_rekening' ID_REKENING='" + data.result[i].RMP_REKENING_ID +  "'><i aria-hidden='true' class='fa fa-trash'></i></a></td>" +
          "</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#data_rekening").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      //error_handler_json(x, e, '=> barang_kamus_list()');
    } //end error
  });
}

$(function() {
  rekening_list();
});


$("tbody#data_rekening").on('click','a.hapus_rekening', function()
{
  var id = $(this).attr('ID_REKENING');
  console.log(id);
  if(confirm('Apakah anda sudah yakin menghapus data ?')) {
		hapus_rekening(id)
	}
})

function hapus_rekening(id)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=hapus_rekening&ID=' + id ,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        console.log(data.respon.text_msg);
          rekening_list();
      }
      else if (data.respon.pesan == "gagal")
      {
        console.log(data.respon.text_msg);
        alert("Gagal Menghapus");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}
////////////////////////////////////// END TAMBAH REKENING /////////////////////////////////////
////////////////////////////////////// TAMBAH REKENING RELASI /////////////////////////////////////
$('.FormKirimRekeningRelasi').on('click',function(){
var id_supplier = "ID_SUPPLIER="+$('.ID_SUPPLIER').val();
var formrekeningrelasi = $('form.fDataRekeningRelasi').serialize();
var fDataRekeningRelasi = id_supplier +"&"+formrekeningrelasi;
console.log(fDataRekeningRelasi);

if ($('.JENIS_REKENING').val() == "")
{
  alert ("Jenis Material Harus Dipilih");
}
else if ($('.NO_REKENING_KODE_WILAYAH').val() == "")
{
  alert ("Wilayah Supplier Harus Dipilih pada Tab Data Personal");
}
else if ($('.NO_REKENING_SUB_WILAYAH').val() == "")
{
  alert ("Wilayah Supplier Harus Dipilih pada Tab Data Personal");
}
else {
$.ajax({
	type: 'POST',
	url: refseeAPI,
	dataType: 'json',
	data: 'ref=add_rekening_relasi&' + fDataRekeningRelasi ,
	success: function(data) {
		if (data.respon.pesan == "sukses")
		{
			console.log(data.respon.text_msg);
      	$(".modalRekeningRelasi").modal('hide');
        rekening_relasi_list();
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
}
})

function rekening_relasi_list(curPage)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=rekening_relasi_list&ID_SUPPLIER=' + $('input#ID_SUPPLIER').val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log(data.respon.text_msg);
        $("tbody#data_rekening_relasi").empty();
        for (i = 0; i < data.result.length; i++) {
          $("tbody#data_rekening_relasi").append("<tr class='detailLogId'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_REKENING_RELASI +  "</td>" +
					"<td>" + data.result[i].RMP_REKENING_RELASI_MATERIAL +  "</td>" +

					"<td>" + data.result[i].RMP_MASTER_WILAYAH +  "</td>" +
          "<td>" + data.result[i].MASTER_WILAYAH +  "</td>" +
					"<td><a class='btn btn-danger btn-sm hapus_rekening_relasi' ID_REKENING_RELASI='" + data.result[i].RMP_REKENING_RELASI_ID +  "'><i aria-hidden='true' class='fa fa-trash'></i></a></td>" +

					"</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#data_rekening_relasi").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
    } //end error
  });
}

$(function() {
  rekening_relasi_list();
});

$("tbody#data_rekening_relasi").on('click','a.hapus_rekening_relasi', function()
{
  var id = $(this).attr('ID_REKENING_RELASI');
  console.log(id);
  if(confirm('Apakah anda sudah yakin menghapus data ?')) {
		hapus_rekening_relasi(id)
	}
})

function hapus_rekening_relasi(id)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=hapus_rekening_relasi&ID=' + id ,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        console.log(data.respon.text_msg);
          rekening_relasi_list();
      }
      else if (data.respon.pesan == "gagal")
      {
        console.log(data.respon.text_msg);
        alert("Gagal Menghapus");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}


////////////////////////////////////// END TAMBAH REKENING RELASI /////////////////////////////////////
////////////////////////////////////// TAMBAH QUALITED HARGA /////////////////////////////////////
function onchange_qualited(){
  var qualited = $("#QUALITED_JENIS_MATERIAL option:selected").attr("QUALITED");
  console.log(qualited);
  if (qualited == 'ALLOW')
  {
    $('.QUALITED_HARGA_QUALITED').attr('readonly', false);
    $('.QUALITED_HARGA_QUALITED').val('');
    $('p.QUALITED_WARNING').html('');
  }
  else if(qualited == 0)
  {
    $('.QUALITED_HARGA_QUALITED').attr('readonly', true);
    $('.QUALITED_HARGA_QUALITED').val('');
    $('p.QUALITED_WARNING').html('Tidak diizinkan untuk material ini.');
    $('p.QUALITED_WARNING').attr('style',  'color:red');
  }
  else {
    $('.QUALITED_HARGA_QUALITED').attr('readonly', true);
    $('.QUALITED_HARGA_QUALITED').val('');
    $('p.QUALITED_WARNING').html('Tidak diizinkan untuk material ini.');
    $('p.QUALITED_WARNING').attr('style',  'color:red');
  }
}

$('.FormKirimQualitedHarga').on('click',function(){
var id_supplier = "ID_SUPPLIER="+$('.ID_SUPPLIER').val();
var formqualitedharga = $('form.fDataQualitedHarga').serialize();
var fDataQualitedHarga = id_supplier +"&"+formqualitedharga;
console.log(fDataQualitedHarga);

if ($('.QUALITED_JENIS_MATERIAL').val() == "")
{
  alert ("Jenis material harus dipilih.");
}
else if ($('.QUALITED_HARGA_HARGA').val() == "")
{
  alert ("Harga tidak boleh kosong.");
}
else if ($('.QUALITED_HARGA_TANGGAL_BERLAKU').val() == "")
{
  alert ("Tanggal berlaku tidak boleh kosong.");
}
else if ($('.QUALITED_HARGA_TANGGAL_BERAKHIR').val() == "")
{
  alert ("Tanggal berakhir tidak boleh kosong.");
}
else
{
  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=add_qualited_harga&' + fDataQualitedHarga ,
  	success: function(data) {
  		if (data.respon.pesan == "sukses")
  		{
  			console.log(data.respon.text_msg);
        	$(".modalQualitedHarga").modal('hide');
          qualited_harga_list();
  		}
  		else if (data.respon.pesan == "gagal")
  		{
  			console.log(data.respon.text_msg);
  			alert("Gagal Menyimpan");
  		}
  	}, //end success
  	error: function(x, e) {
  		console.log("Error Ajax QUALITED");
  	} //end error
  });
}

})

function qualited_harga_list(curPage)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=qualited_harga_list&ID_SUPPLIER=' + $('input#ID_SUPPLIER').val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log(data.respon.text_msg);
        $("tbody#data_qualited_harga").empty();
        for (i = 0; i < data.result.length; i++) {
          $("tbody#data_qualited_harga").append("<tr class='detailLogId'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_MASTER_MATERIAL +  "</td>" +
					"<td>" + data.result[i].RMP_QUALITED_HARGA_QUALITED +  "</td>" +
					"<td>" + data.result[i].RMP_QUALITED_HARGA_HARGA +  "</td>" +
					"<td>" + data.result[i].TANGGAL_BERLAKU +  "</td>" +
					"<td>" + data.result[i].TANGGAL_BERAKHIR +  "</td>" +
          "<td><a class='btn btn-danger btn-sm hapus_qualited_harga' ID_QUALITED_HARGA='" + data.result[i].RMP_QUALITED_HARGA_ID +  "'><i aria-hidden='true' class='fa fa-trash'></i></a></td>" +
          "</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#data_qualited_harga").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
    } //end error
  });
}

$(function() {
  qualited_harga_list();
});


$("tbody#data_qualited_harga").on('click','a.hapus_qualited_harga', function()
{
  var id = $(this).attr('ID_QUALITED_HARGA');
  console.log(id);
  if(confirm('Apakah anda sudah yakin menghapus data ?')) {
		hapus_qualited_harga(id)
	}
})

function hapus_qualited_harga(id)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=hapus_qualited_harga&ID=' + id ,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        console.log(data.respon.text_msg);
          qualited_harga_list();
      }
      else if (data.respon.pesan == "gagal")
      {
        console.log(data.respon.text_msg);
        alert("Gagal Menghapus");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}
////////////////////////////////////// END TAMBAH QUALITED HARGA /////////////////////////////////////
////////////////////////////////////// TAMBAH TOLERANSI MUTU /////////////////////////////////////
$('.FormKirimToleransiMutu').on('click',function(){
var id_supplier = "ID_SUPPLIER="+$('.ID_SUPPLIER').val();
var formtoleransimutu = $('form.fDataToleransiMutu').serialize();
var fDataToleransiMutu = id_supplier +"&"+formtoleransimutu;
console.log(fDataToleransiMutu);

if ($('.TOLERANSI_MUTU_NILAI_MIN').val() == "")
{
  alert ("Nilai Min tidak boleh kosong.");
}
else if ($('.TOLERANSI_MUTU_NILAI_MAX').val() == "")
{
  alert ("Nilai Max tidak boleh kosong.");
}
else if ($('.TOLERANSI_MUTU_TANGGAL_BERLAKU').val() == "")
{
  alert ("Tanggal berlaku tidak boleh kosong.");
}
else if ($('.TOLERANSI_MUTU_TANGGAL_BERAKHIR').val() == "")
{
  alert ("Tanggal berakhir tidak boleh kosong.");
}
else
{
  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=add_toleransi_mutu&' + fDataToleransiMutu ,
  	success: function(data) {
  		if (data.respon.pesan == "sukses")
  		{
  			console.log(data.respon.text_msg);
        	$(".modalToleransiMutu").modal('hide');
          toleransi_mutu_list();
  		}
  		else if (data.respon.pesan == "gagal")
  		{
  			console.log(data.respon.text_msg);
  			alert("Gagal Menyimpan");
  		}
  	}, //end success
  	error: function(x, e) {
  		console.log("Error Ajax TOLERANSI MUTU");
  	} //end error
  });
}

})
var id_supplier = $('input#ID_SUPPLIER').val();
console.log("TOLERANSI MUTU"+ id_supplier)
function toleransi_mutu_list(curPage)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=toleransi_mutu_list&ID_SUPPLIER=' + $('input#ID_SUPPLIER').val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        $("tbody#data_toleransi_mutu").empty();
        for (i = 0; i < data.result.length; i++) {
          console.log("TOLERANSI MUTU "+ data.result[i].RMP_TOLERANSI_MUTU_NILAI_MIN)
          $("tbody#data_toleransi_mutu").append("<tr class='detailLogId'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_TOLERANSI_MUTU_NILAI_MIN +  "</td>" +
					"<td>" + data.result[i].RMP_TOLERANSI_MUTU_NILAI_MAX +  "</td>" +
					"<td>" + data.result[i].TANGGAL_BERLAKU +  "</td>" +
					"<td>" + data.result[i].TANGGAL_BERAKHIR +  "</td>" +
          "<td><a class='btn btn-danger btn-sm hapus_toleransi_mutu' ID_TOLERANSI_MUTU='" + data.result[i].RMP_TOLERANSI_MUTU_ID +  "'><i aria-hidden='true' class='fa fa-trash'></i></a></td>" +
          "</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#data_toleransi_mutu").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
    } //end error
  });
}

$(function() {
  toleransi_mutu_list();
});


$("tbody#data_toleransi_mutu").on('click','a.hapus_toleransi_mutu', function()
{
  var id = $(this).attr('ID_TOLERANSI_MUTU');
  console.log(id);
  if(confirm('Apakah anda sudah yakin menghapus data ?')) {
		hapus_toleransi_mutu(id)
	}
})

function hapus_toleransi_mutu(id)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=hapus_toleransi_mutu&ID=' + id ,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        console.log(data.respon.text_msg);
          toleransi_mutu_list();
      }
      else if (data.respon.pesan == "gagal")
      {
        console.log(data.respon.text_msg);
        alert("Gagal Menghapus");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}
////////////////////////////////////// END TAMBAH TOLERANSI MUTU /////////////////////////////////////
////////////////////////////////////// TAMBAH KONTAK /////////////////////////////////////
$('.FormKirimKontak').on('click',function(){
var id_supplier = "ID_SUPPLIER="+$('.ID_SUPPLIER').val();
var formkontak = $('form.fDataKontak').serialize();
var fDataKontak = id_supplier +"&"+formkontak;
console.log(fDataKontak);

if ($('.JENIS_KONTAK').val() == "")
{
  alert ("Jenis kontak harus dipilih.");
}
else if ($('.KONTAK').val() == "")
{
  alert ("Kontak boleh kosong.");
}
else if ($('.STATUS_KONTAK').val() == "")
{
  alert ("Status kontak harus dipilih.");
}

else
{
  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=add_kontak&' + fDataKontak ,
  	success: function(data) {
  		if (data.respon.pesan == "sukses")
  		{
  			console.log(data.respon.text_msg);
  			//window.location.href = "?show=rmp/supplier/MASTER_PERSONAL";
        	$(".modalKontak").modal('hide');
          kontak_list();
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
}

})

function kontak_list(curPage)
{

  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=kontak_list&ID_SUPPLIER=' + $('input#ID_SUPPLIER').val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log(data.respon.text_msg);
        $("tbody#data_kontak").empty();
        for (i = 0; i < data.result.length; i++) {
          $("tbody#data_kontak").append("<tr class='detailLogId'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_KONTAK_JENIS_KONTAK +  "</td>" +
					"<td>" + data.result[i].RMP_KONTAK +  "</td>" +
					"<td>" + data.result[i].RMP_KONTAK_STATUS +  "</td>" +
					"<td>" + data.result[i].ENTRI +  "</td>" +
          "<td><a class='btn btn-danger btn-sm hapus_kontak' ID_KONTAK='" + data.result[i].RMP_KONTAK_ID +  "'><i aria-hidden='true' class='fa fa-trash'></i></a></td>" +
					"</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#data_kontak").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      //error_handler_json(x, e, '=> barang_kamus_list()');
    } //end error
  });
}

$(function() {
  kontak_list();
});

$("tbody#data_kontak").on('click','a.hapus_kontak', function()
{
  var id = $(this).attr('ID_KONTAK');
  console.log(id);
  if(confirm('Apakah anda sudah yakin menghapus data ?')) {
		hapus_kontak(id)
	}
})

function hapus_kontak(id)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=hapus_kontak&ID=' + id ,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        console.log(data.respon.text_msg);
          kontak_list();
      }
      else if (data.respon.pesan == "gagal")
      {
        console.log(data.respon.text_msg);
        alert("Gagal Menghapus");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}
////////////////////////////////////// END TAMBAH KONTAK /////////////////////////////////////
////////////////////////////////////// TAMBAH DOKUMEN /////////////////////////////////////
$('.FormKirimDokumen').on('click',function(){
var id_supplier = "ID_SUPPLIER="+$('.ID_SUPPLIER').val();
var formdokumen = $('form.fDataDokumen').serialize();
var fDataDokumens = id_supplier +"&"+formdokumen;
console.log(formdokumen);

$.ajax({
	type: 'POST',
	url: refseeAPI,
	dataType: 'json',
	data: 'ref=add_dokumen&' + fDataDokumens ,
	success: function(data) {
		if (data.respon.pesan == "sukses")
		{
			console.log(data.respon.text_msg);
			//window.location.href = "?show=rmp/supplier/MASTER_PERSONAL";
      	$(".modalDokumen").modal('hide');
        dokumen_list();
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

function dokumen_list(curPage)
{

  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=dokumen_list&ID_SUPPLIER=' + $('input#ID_SUPPLIER').val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log(data.respon.text_msg);
        $("tbody#data_dokumen").empty();
        for (i = 0; i < data.result.length; i++) {
          $("tbody#data_dokumen").append("<tr class='detailLogId'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td><img  height='100' src='cloud/relasi_a/"+ data.result[i].RMP_DOKUMEN_FOTO +"' onerror='imgError(this);'/></td>" +
					"<td>" + data.result[i].RMP_DOKUMEN_JENIS +  "</td>" +
					"<td>" + data.result[i].RMP_DOKUMEN_STATUS +  "</td>" +
					"<td>" + data.result[i].TANGGAL_BERLAKU +  "</td>" +
					"<td></td>" + "</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#data_dokumen").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      //error_handler_json(x, e, '=> barang_kamus_list()');
    } //end error
  });
}

$(function() {
  dokumen_list();
});
////////////////////////////////////// END TAMBAH DOKUMEN /////////////////////////////////////
////////////////////////////////////// TAMBAH KELUARGA /////////////////////////////////////
var KABUPATEN_KELUARGA = function() {
	var PROVINSI_VAL_KELUARGA = $('select.PROVINSI_KELUARGA').val();
	//console.log(PROVINSI_VAL);
	$.ajax({
		type: 'POST',
		url: refseeAPI,
		dataType: 'json',
		data: 'ref=sel_kabupaten&PROVINSI=' + PROVINSI_VAL_KELUARGA,
		success: function(data) {
			if (data.respon.pesan == "sukses") {
				//console.log("Sukses");
				$('select.KABUPATEN_KELUARGA').empty();
				for (s = 0; s < data.result.length; s++) {
					//console.log(data.result[s].INDONESIA_KABUPATEN);
					$('select.KABUPATEN_KELUARGA').append('<option value="' + data.result[s].INDONESIA_KABUPATEN_ID + '">' + data.result[s].INDONESIA_KABUPATEN + '</option>');
				}
			} else if (data.respon.pesan == "gagal") {
				//console.log("Gagal");
			}
		}, //end success
		error: function(x, e) {
			//console.log("Error Ajax");
		} //end error
	});
}

function provinsi_keluarga() {
	//console.log("ONCHANGE")
	var send = new KABUPATEN_KELUARGA();
	$('select.KECAMATAN_KELUARGA').empty();
	$('select.DESA_KELUARGA').empty();
};



var KECAMATAN_KELUARGA = function() {
	var KABUPATEN_VAL_KELUARGA = $('select.KABUPATEN_KELUARGA').val();
	//console.log(KABUPATEN_VAL);
	$.ajax({
		type: 'POST',
		url: refseeAPI,
		dataType: 'json',
		data: 'ref=sel_kecamatan&KABUPATEN=' + KABUPATEN_VAL_KELUARGA,
		success: function(data) {
			if (data.respon.pesan == "sukses") {
				//console.log("Sukses");
				$('select.KECAMATAN_KELUARGA').empty();
				for (s = 0; s < data.result.length; s++) {
					//console.log(data.result[s].INDONESIA_KECAMATAN);
					$('select.KECAMATAN_KELUARGA').append('<option value="' + data.result[s].INDONESIA_KECAMATAN_ID + '">' + data.result[s].INDONESIA_KECAMATAN + '</option>');
				}
			} else if (data.respon.pesan == "gagal") {
				//console.log("Gagal");
			}
		}, //end success
		error: function(x, e) {
			//console.log("Error Ajax");
		} //end error
	});
}

function kabupaten_keluarga() {
	//console.log("ONCHANGE")
	var send = new KECAMATAN_KELUARGA();
	$('select.DESA_KELUARGA').empty();
};


var DESA_KELUARGA = function() {
	var KECAMATAN_VAL_KELUARGA = $('select.KECAMATAN_KELUARGA').val();
	console.log(KECAMATAN_VAL_KELUARGA);
	$.ajax({
		type: 'POST',
		url: refseeAPI,
		dataType: 'json',
		data: 'ref=sel_desa&KECAMATAN=' + KECAMATAN_VAL_KELUARGA,
		success: function(data) {
			if (data.respon.pesan == "sukses") {
				//'console.log("Sukses");
				$('select.DESA_KELUARGA').empty();
				for (s = 0; s < data.result.length; s++) {
					//'console.info(data.result[s].INDONESIA_DESA);
					$('select.DESA_KELUARGA').append('<option value="' + data.result[s].INDONESIA_DESA_ID + '">' + data.result[s].INDONESIA_DESA + '</option>');
				}
			} else if (data.respon.pesan == "gagal") {
				console.log(data.respon.text_msg);
			}
		}, //end success
		error: function(x, e) {
			console.log("Error Ajax");
		} //end error
	});
}

function kecamatan_keluarga() {
	//'console.log("ONCHANGE");
	var send = new DESA_KELUARGA();
};

$('.FormKirimKeluarga').on('click',function(){
var id_supplier = "ID_SUPPLIER="+$('.ID_SUPPLIER').val();
var formkeluarga = $('form.formPersonalKeluarga').serialize();
var fDataKeluarga = id_supplier +"&"+formkeluarga;
console.log(fDataKeluarga);
if ($('.NAMA_KELUARGA ').val() == "")
{
  alert ("Nama Tidak Boleh Kosong");
}
else if ($('.STATUS_HUBUNGAN_KELUARGA').val() == "")
{
  alert ("Status hubungan harus dipilih.");
}
else {
$.ajax({
	type: 'POST',
	url: refseeAPI,
	dataType: 'json',
	data: 'ref=add_keluarga&' + fDataKeluarga ,
	success: function(data) {
		if (data.respon.pesan == "sukses")
		{
			console.log(data.respon.text_msg);
			//window.location.href = "?show=rmp/supplier/MASTER_PERSONAL";
      	$(".modalKeluarga").modal('hide');
        keluarga_list();
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
}
})

function keluarga_list(curPage)
{

  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=keluarga_list&ID_SUPPLIER=' + $('input#ID_SUPPLIER').val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log(data.respon.text_msg);
        $("tbody#data_keluarga").empty();
        for (i = 0; i < data.result.length; i++) {
          $("tbody#data_keluarga").append("<tr class='detailLogId'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_MASTER_PERSONAL_NAMA +  "</td>" +
					"<td>" + data.result[i].RMP_KELUARGA_STATUS +  "</td>" +
					"<td>" + data.result[i].RMP_MASTER_PERSONAL_ALAMAT + ", " + data.result[i].INDONESIA_DESA + ", " + data.result[i].INDONESIA_KECAMATAN + ", " + data.result[i].INDONESIA_KABUPATEN + ", " + data.result[i].INDONESIA_PROVINSI + "</td>" +
          "<td><a class='btn btn-danger btn-sm hapus_keluarga' ID_KELUARGA='" + data.result[i].RMP_KELUARGA_ID +  "'><i aria-hidden='true' class='fa fa-trash'></i></a></td>" +
          "</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#data_keluarga").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      //error_handler_json(x, e, '=> barang_kamus_list()');
    } //end error
  });
}

$(function() {
  keluarga_list();
});


$("tbody#data_keluarga").on('click','a.hapus_keluarga', function()
{
  var id = $(this).attr('ID_KELUARGA');
  console.log(id);
  if(confirm('Apakah anda sudah yakin menghapus data ?')) {
		hapus_keluarga(id)
	}
})

function hapus_keluarga(id)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=hapus_keluarga&ID=' + id ,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        console.log(data.respon.text_msg);
          keluarga_list();
      }
      else if (data.respon.pesan == "gagal")
      {
        console.log(data.respon.text_msg);
        alert("Gagal Menghapus");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}
////////////////////////////////////// END TAMBAH KELUARGA /////////////////////////////////////
$('.uploadfotobtn').on('click',function(){
  console.log("Tampilkan Modal");
  $(".uploadFotoModal").modal('show');
});

$('.uploadfotobtnasisten').on('click',function(){
  console.log("Tampilkan Modal");
  $(".uploadFotoModalAsisten").modal('show');
});

$('.uploaddokumen').on('click',function(){
  console.log("Tampilkan Modal");
  $(".uploadFotoModalDokumen").modal('show');
});

// $("span#galeri_list").on('click',function(){
// 	$("div#load_img").empty();
// 	$("button#upload").addClass("hidden");
// 	$("div#tool_files_search input#keyword").val('');
// 	tool_files_list();
// 	$("form#f-upload1").attr("action","javascript:search();");
// });
// $("span#perangkat").on('click',function(){
// 	$("ul#tool_files_list").empty();
// 	$("button#btn-more-files").addClass("hidden");
// 	$("button#upload").removeClass("hidden");
// 	$("div#tool_files_search").addClass("hidden");
// 	$("div#lokasi_file").removeClass("hidden");
// 	$("form#f-upload1").attr("action","?show=/upload/local_dir/");
// });

function upload_file(){
  console.log("Memulai AjaxForm");
	$("span#load").html('Sedang upload....');
	$('form#f-upload1 button#upload').html("Uploading...");
	$("#f-upload1").ajaxForm({
		target: ".preview",
		dataType:'json',
		success:function(data) {

			$("form#f-upload1 button#upload").html('Start Upload');
			$("span#load").html('<i class="glyphicon glyphicon-phone"></i> Pilih Dari Perangkat');
			if(data.pesan=="gagal"){
        console.log("Gagal Upload");
				$("div#error-msg").html("<b class='text-danger bg-warning'>"+data.text_msg+"</b>");
				$("div#error-msg b").fadeOut(2000);
			}else if(data.pesan=="sukses"){

        console.log(data.text_msg);
				$("form#f-upload1")[0].reset();
				if(data.TYPE=="image"){
					$("#load_img").html("<a class='thumbnail' id='insert_image_to_box' TOOL_FILES_NAME='"+data.input.TOOL_FILES_NAME+"' TOOL_FILES_ID='"+data.input.TOOL_FILES_ID+"' ><img class='img-responsive' src='"+data.image_cache+"'></a>");
					$("#load_img").append("<div class='text-danger'>Silahkan klik gambar untuk memilih.</div>");
				}else{
					$("#load_img").html("<a class='thumbnail' href='javascript:' id='insert_link_to_textarea' TOOL_FILES_ID='"+data.input.TOOL_FILES_ID+"' TOOL_FILES_NAME='"+data.input.TOOL_FILES_NAME+"'><img class='img-responsive' src='asset/images/pdf_icon.png'></a>");
					$("#load_img").append("<div class='text-danger'>Silahkan klik file untuk memilih.</div>");
				}
				//tinyMCE.execCommand('mceInsertContent',false,'<img class="img-responsive" src="files.php?id='+data.TOOL_FILES_ID+'&mode=rebah">');
			//	$("#upload_gambar").modal('hide');
			}

		}

	}).submit();
}//end upload_file
function upload_file_asisten(){
  console.log("Memulai AjaxForm");
	$("span#load").html('Sedang upload....');
	$('form#f-upload1_asisten button#uploadasisten').html("Uploading...");
	$("#f-upload1_asisten").ajaxForm({
		target: ".preview",
		dataType:'json',
		success:function(data) {

			$("form#f-upload1_asisten button#uploadasisten").html('Start Upload');
			$("span#load").html('<i class="glyphicon glyphicon-phone"></i> Pilih Dari Perangkat');
			if(data.pesan=="gagal"){
        console.log("Gagal Upload");
				$("div#error-msg").html("<b class='text-danger bg-warning'>"+data.text_msg+"</b>");
				$("div#error-msg b").fadeOut(2000);
			}else if(data.pesan=="sukses"){

        console.log(data.text_msg);
				$("form#f-upload1")[0].reset();
				if(data.TYPE=="image"){
					$("#load_img_asisten").html("<a class='thumbnail' id='insert_image_to_box' TOOL_FILES_NAME='"+data.input.TOOL_FILES_NAME+"' TOOL_FILES_ID='"+data.input.TOOL_FILES_ID+"' ><img class='img-responsive' src='"+data.image_cache+"'></a>");
					$("#load_img_asisten").append("<div class='text-danger'>Silahkan klik gambar untuk memilih.</div>");
				}else{
					$("#load_img_asisten").html("<a class='thumbnail' href='javascript:' id='insert_link_to_textarea' TOOL_FILES_ID='"+data.input.TOOL_FILES_ID+"' TOOL_FILES_NAME='"+data.input.TOOL_FILES_NAME+"'><img class='img-responsive' src='asset/images/pdf_icon.png'></a>");
					$("#load_img_asisten").append("<div class='text-danger'>Silahkan klik file untuk memilih.</div>");
				}
				//tinyMCE.execCommand('mceInsertContent',false,'<img class="img-responsive" src="files.php?id='+data.TOOL_FILES_ID+'&mode=rebah">');
			//	$("#upload_gambar_asisten").modal('hide');
			}

		}

	}).submit();
}//end upload_file
function upload_file_dokumen(){
  console.log("Memulai AjaxForm");
	$("span#load").html('Sedang upload....');
	$('form#f-upload1_dokumen button#uploaddokumen').html("Uploading...");
	$("#f-upload1_dokumen").ajaxForm({
		target: ".preview",
		dataType:'json',
		success:function(data) {

			$("form#f-upload1_dokumen button#uploaddokumen").html('Start Upload');
			$("span#load").html('<i class="glyphicon glyphicon-phone"></i> Pilih Dari Perangkat');
			if(data.pesan=="gagal"){
        console.log("Gagal Upload");
				$("div#error-msg").html("<b class='text-danger bg-warning'>"+data.text_msg+"</b>");
				$("div#error-msg b").fadeOut(2000);
			}else if(data.pesan=="sukses"){

        console.log(data.text_msg);
				$("form#f-upload1")[0].reset();
				if(data.TYPE=="image"){
					$("#load_img_dokumen").html("<a class='thumbnail' id='insert_image_to_box' TOOL_FILES_NAME='"+data.input.TOOL_FILES_NAME+"' TOOL_FILES_ID='"+data.input.TOOL_FILES_ID+"' ><img class='img-responsive' src='"+data.image_cache+"'></a>");
					$("#load_img_dokumen").append("<div class='text-danger'>Silahkan klik gambar untuk memilih.</div>");
				}else{
					$("#load_img_dokumen").html("<a class='thumbnail' href='javascript:' id='insert_link_to_textarea' TOOL_FILES_ID='"+data.input.TOOL_FILES_ID+"' TOOL_FILES_NAME='"+data.input.TOOL_FILES_NAME+"'><img class='img-responsive' src='asset/images/pdf_icon.png'></a>");
					$("#load_img_dokumen").append("<div class='text-danger'>Silahkan klik file untuk memilih.</div>");
				}

			}

		}

	}).submit();
}//end upload_file
//--js untuk tab 1 --//
$('form#f-upload1 button#upload').on('click', function(){
		upload_file();
});

$('form#f-upload1_asisten button#uploadasisten').on('click', function(){
		upload_file_asisten();
});

$('form#f-upload1_dokumen button#uploaddokumen').on('click', function(){
		upload_file_dokumen();
});

$('#load_img').on('click','a#insert_image_to_box',function(){
	var id=$(this).attr("TOOL_FILES_ID");
	var file_name=$(this).attr("TOOL_FILES_NAME");
  console.log(id);
  console.log(file_name);
  $(".FOTO_SUPPLIER").val(file_name);
  //cek_cache_image(file_name,id);
  $("img.PRIVIEW_SUPPLIER_FOTO").attr('src','cloud/relasi_a/'+file_name);
	$(".uploadFotoModal").modal('hide');
});

$('#load_img_asisten').on('click','a#insert_image_to_box',function(){
	var id=$(this).attr("TOOL_FILES_ID");
	var file_name=$(this).attr("TOOL_FILES_NAME");
  console.log(id);
  console.log(file_name);
  $(".FOTO_ASISTEN").val(file_name);
  $("img.PRIVIEW_ASISTEN_FOTO").attr('src','cloud/relasi_a/'+file_name);
	$(".uploadFotoModalAsisten").modal('hide');
	$(".modalAsisten").modal('hide');
	//$(".modalAsisten").modal('show');

});

$('#load_img_dokumen').on('click','a#insert_image_to_box',function(){
	var id=$(this).attr("TOOL_FILES_ID");
	var file_name=$(this).attr("TOOL_FILES_NAME");
  console.log(id);
  console.log(file_name);
  $(".FOTO_DOKUMEN").val(file_name);
  $("img.PRIVIEW_DOKUMEN_FOTO").attr('src','cloud/relasi_a/'+file_name);
	$(".uploadFotoModalDokumen").modal('hide');
	//$(".modalDokumen").modal('hide');
	//$(".modalAsisten").modal('show');

});

function jenis_rekening()
{
	console.log($('select.JENIS_REKENING').val());
  var jenis_rekening = $('select.JENIS_REKENING').val()
  $("input.KODE_JENIS_REKENING").val(jenis_rekening);
  var option = $('select.JENIS_REKENING option:selected').attr('nama_material');
  $("input.MATERIAL_NAMA").val(option);
};

$(".PANJANG_WILAYAH, .LEBAR_WILAYAH").keyup(function()
{
  var panjang = $('.PANJANG_WILAYAH').val();
  console.log(panjang);
  var lebar = $('.LEBAR_WILAYAH').val();
  console.log(lebar);
  var luas = panjang * lebar;
  console.log(luas);
  $(".LUAS_WILAYAH").val(luas);
  });

$(".BARIS_WILAYAH, .NAIK_WILAYAH").keyup(function()
{
  var baris = $('.BARIS_WILAYAH').val();
  console.log(baris);
  var baris_m = baris * 7;
  console.log(baris_m);
  var naik = $('.NAIK_WILAYAH').val();
  console.log(naik);
  var naik_m = naik * 7;
  var luas = baris_m * naik_m;
  $(".LUAS_BARIS_NAIK_WILAYAH").val(luas);
  });




</script>
