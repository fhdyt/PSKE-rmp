<?php
$RMP_CONFIG=new RMP_CONFIG();
 ?>
<style>
.modalPersonal {
  width: 1300px;
}

.modalIMG {
  width: 1000px;
}

.modal{
    overflow-y: auto;
}

.loader {
	border: 5px solid #f3f3f3;
	border-radius: 50%;
	border-top: 5px solid #3498db;
	width: 40px;
	height: 40px;
	-webkit-animation: spin 2s linear infinite;
	/* Safari */
	animation: spin 2s linear infinite;
}
/* Safari */

@-webkit-keyframes spin {
	0% {
		-webkit-transform: rotate(0deg);
	}
	100% {
		-webkit-transform: rotate(360deg);
	}
}
@keyframes spin {
	0% {
		transform: rotate(0deg);
	}
	100% {
		transform: rotate(360deg);
	}
}
table {
	font-size: 12px;
}
table-detail {
	font-size: 9px;
}
.modal-gudang {
	width: 1300px;
}
</style>

<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="list-group">
			<div class="list-group-item">
				<div class="row">
					<div class="col-md-8">
						<h3><i class="fa fa-user-circle-o"></i> Master Supplier</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right"></div>
				</div><!--/.row-->
				<div class="row">
					<div class="col-md-4">
						<a class="btn btn-primary btn-sm" href="?show=rmp/supplier/add_supplier">Tambah Supplier</a>
					</div>
					<div class="col-md-4 ">
            <form id="form_filter" method="POST">
            <select id="FILTER_WILAYAH_SUPPLIER" name="FILTER_WILAYAH_SUPPLIER" type="text" class=" form-control FILTER_WILAYAH_SUPPLIER"  autocomplete="off" onchange="filter_wilayah()">
                    <option value="">--Semua Lokasi--</option>
                    <?php
                    $params = $id_supplier[0]['RMP_MASTER_PERSONAL_ID'];
                    $data = $RMP_CONFIG->sub_wilayah_filter($params);
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
                  <p class="help-block">Filter Lokasi.</p>
          </div>
					<div class="col-md-4 ">
            <select id="FILTER_MATERIAL" name="FILTER_MATERIAL" type="text" class=" form-control FILTER_MATERIAL"  autocomplete="off" onchange="filter_material()">
                    <?php
                    $data = $RMP_CONFIG->material();
                    foreach ($data['rasult'] as $key => $value) {
                      foreach ($value as $data => $isi) {
            ?>
            <option value="<?php echo $isi['RMP_MASTER_MATERIAL']; ?>"> <?php  echo $isi['RMP_MASTER_MATERIAL'];?></option>
            <?php

          }

        }?>
                  </select>
                  <p class="help-block">Rekening Relasi.</p>
                </form>
          </div>
				</div><!--/.row-->
				 <!-- <button class="btn btn-primary btn-sm tambah" type="button"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Inventori</button> -->
				<table class="table table-hover">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama</th>
							<th>Rekening Relasi</th>
							<th>Wilayah</th>
							<th>Lokasi</th>
							<th>Aksi</th>
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
				<div class="row">
  <div class="col-md-9">
    <div class="pagination-holder clearfix">
      <div class="pagination" id="tujuan-light-pagination"></div>
    </div>
  </div>
  <div class="col-md-3 text-right">
    <label>Jumlah Baris Per Halaman</label> <input class="form-control" id="REC_PER_HALAMAN" max='1000' min="1" name="REC_PER_HALAMAN" required="" type="number" value="10">
  </div>
</div><!--/row-->
			</div>
		</div>
	</div>
</div>

<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalPersonalFile" role="dialog" tabindex="-1">
	<div class="modal-dialog modalPersonal" role="document">
		<div class="modal-content">
			<div class="modal-body">
          <div class="row">
						<div class="col-md-4">
							<div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Data Personal</h3>
	          </div>
            <div class="box-body">
              <img class="img-thumbnail FOTO_SUPPLIER" onerror="imgError(this);"/>
            </div>
	          <div class="box-body">
	            <table class="table">
	            	<tr>
	            		<td><b>Nama</b></td>
									<td>:</td>
									<td><p class="nama"></p></td>
	            	</tr>
								<tr>
	            		<td><b>No. KTP</b></td>
									<td>:</td>
									<td><p class="ktp"></p></td>
	            	</tr>
								<tr>
	            		<td><b>NPWP</b></td>
									<td>:</td>
									<td><p class="npwp"></p></td>
	            	</tr>
								<tr>
	            		<td><b>Tanggal Pendaftaran</b></td>
									<td>:</td>
									<td><p class="tgl_daftar"></p></td>
	            	</tr>
								<tr>
	            		<td><b>Suku</b></td>
									<td>:</td>
									<td><p class="suku"></p></td>
	            	</tr>
								<tr>
	            		<td><b>Alamat</b></td>
									<td>:</td>
									<td><p class="alamat"></p></td>
	            	</tr>
	            </table>
	          </div>
	          <!-- /.box-body -->
	        </div>
          </div>
						<div class="col-md-8">
              <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title"><i class="fa fa-credit-card" aria-hidden="true"></i> Rekening Relasi</h3>
	          </div>
	          <div class="box-body">
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
	          </div>
	          <!-- /.box-body -->
	        </div>
							<div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title"><i class="fa fa-map-marker" aria-hidden="true"></i> Wilayah</h3>
	          </div>
	          <div class="box-body">
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
	          </div>
	          <!-- /.box-body -->
	        </div>
							<div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title"><i class="fa fa-male" aria-hidden="true"></i> Asisten</h3>
	          </div>
	          <div class="box-body">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Foto</th>
										<th>Nama</th>
										<th>No. HP</th>
										<th>Alamat</th>
										<th></th>
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
	          </div>
	          <!-- /.box-body -->
	        </div>
							<div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title"><i class="fa fa-id-card" aria-hidden="true"></i> Rekening</h3>
	          </div>
	          <div class="box-body">
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
	          </div>
	          <!-- /.box-body -->
							<!-- <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title"><i class="fa fa-percent" aria-hidden="true"></i> Kualitet dan Harga</h3>
	          </div>
	          <div class="box-body">
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
	          </div>
	        </div> -->
							<!-- <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title"><i class="fa fa-gavel" aria-hidden="true"></i> Toleransi Mutu</h3>
	          </div>
	          <div class="box-body">
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
	          </div>
	        </div> -->
							<div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title"><i class="fa fa-address-book-o" aria-hidden="true"></i> Kontak</h3>
	          </div>
	          <div class="box-body">
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
	          </div>
	          <!-- /.box-body -->
	        </div>
							<div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title"><i class="fa fa-users" aria-hidden="true"></i> Keluarga</h3>
	          </div>
	          <div class="box-body">
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
	          </div>
	          <!-- /.box-body -->
	        </div>
							<div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title"><i class="fa fa-file-o" aria-hidden="true"></i> Dokumen</h3>
	          </div>
	          <div class="box-body">
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
	          </div>
	          <!-- /.box-body -->
	        </div>
          </div>
          </div>

		</div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <button class="btn btn-default btn-sm TutupModalPersonalFile">Tutup</button>
        </div>
      </div>
    </div>
	</div>
</div>
</div>

<!-- ---------------------------------------------------------------------------------- -->
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalDetailPersonal" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content">
			<div class="modal-body">
        <div class="row">
          <div class="col-md-12">
        <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Data Personal</h3>
      </div>
      <div class="box-body">
        <center><img class="FOTO_SUPPLIER_PERSONAL img_detail" height="150px"/></center>
      </div>
      <div class="box-body">
        <table class="table">
          <tr>
            <td><b>Nama</b></td>
            <td>:</td>
            <td><p class="nama_personal"></p></td>
          </tr>
          <tr>
            <td><b>No. KTP</b></td>
            <td>:</td>
            <td><p class="ktp_personal"></p></td>
          </tr>
          <tr>
            <td><b>NPWP</b></td>
            <td>:</td>
            <td><p class="npwp_personal"></p></td>
          </tr>
          <tr>
            <td><b>No. HP</b></td>
            <td>:</td>
            <td><p class="hp_personal"></p></td>
          </tr>
          <tr>
            <td><b>Suku</b></td>
            <td>:</td>
            <td><p class="suku_personal"></p></td>
          </tr>
          <tr>
            <td><b>Alamat</b></td>
            <td>:</td>
            <td><p class="alamat_personal"></p></td>
          </tr>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
		  </div>

		  </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <button class="btn btn-default btn-sm TutupModalPersonalDetail">Tutup</button>
          </div>
        </div>
      </div>
	</div>
</div>
</div>
</div>

<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalDokumen" role="dialog" tabindex="-1">
	<div class="modal-dialog modalIMG" role="document">
		<div class="modal-content">
			<div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-file-o" aria-hidden="true"></i> Dokumen</h3>
          </div>
          <div class="box-body">
            <center><img class="FOTO_DOKUMEN img_dokumen" height="370px"/></center>
          </div>
          <!-- /.box-body -->
        </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <button class="btn btn-default btn-sm TutupModalIMG">Tutup</button>
            </div>
          </div>
        </div>
	</div>
</div>
</div>
</div>
<script>

$(".img_detail").on("error", function() {
  $(this).hide();
});

function imgError(image) {
    image.onerror = "";
    image.src = "/cloud/no_image.png";
    return true;
}

$("tbody").on('click','a.lihat', function()
{
	var id_supplier = $(this).attr('ID_SUPPLIER');
	data_personal_supplier(id_supplier);
	wilayah_list(id_supplier);
	asisten_list(id_supplier);
	kontak_list(id_supplier);
	rekening_list(id_supplier);
	rekening_relasi_list(id_supplier);
	qualited_harga_list(id_supplier);
	keluarga_list(id_supplier);
	dokumen_list(id_supplier);
  //toleransi_mutu_list(id_supplier);

	$(".modalPersonalFile").modal('show');
});
$('.TutupModalPersonalFile').on('click', function()
{
	$(".modalPersonalFile").modal('hide');
});



function supplier_list(curPage)
{
  var url = window.location.href;
  var pageA = url.split("#");
  if (pageA[1] == undefined) {} else
  {
    var pageB = pageA[1].split("page-");
    if (pageB[1] == '')
    {
      var curPage = curPage;
    } else
    {
      var curPage = pageB[1];
    }
  }
  var filter = $("#form_filter").serialize();
	console.log(filter);
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=master_supplier_list&batas=' + $('input#REC_PER_HALAMAN').val() + '&halaman=' + curPage + '&keyword=' + $("input#keyword").val() + '&' + filter,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log(data.respon.text_msg);
        $("tbody#zone_data").empty();
        $('#tujuan-light-pagination').pagination({
          pages: data.result_option.jml_halaman,
          cssStyle: 'light-theme',
          currentPage: curPage,
        });
        for (i = 0; i < data.result.length; i++) {
          if (data.result[i].REKENING_RELASI == undefined)
          {
            var rekening_relasi = "<p class='text-danger'><i>Tidak Tersedia</i></p>"
          }
          else {
            var rekening_relasi = data.result[i].REKENING_RELASI
          }
          $("tbody#zone_data").append("<tr class='detailLogId'  detailLogId='" + data.result[i].RMP_MASTER_PERSONAL_ID + "'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_MASTER_PERSONAL_NAMA + "</td>" +
					"<td>" + rekening_relasi + "</td>" +
					"<td>" + data.result[i].MASTER_WILAYAH + "</td>" +
					"<td>" + data.result[i].RMP_MASTER_WILAYAH + "</td>" +
					"<td><a class='btn btn-primary btn-sm' href='?show=rmp/supplier/add_supplier/" + data.result[i].RMP_MASTER_PERSONAL_ID + "'><i class='fa fa-pencil' aria-hidden='true'></i> Edit</a> <a class='lihat btn btn-success btn-sm' ID_SUPPLIER='" + data.result[i].RMP_MASTER_PERSONAL_ID + "'><i class='fa fa-eye' aria-hidden='true'></i> Lihat</a></td>" + "</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#zone_data").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
    } //end error
  });
}
$(function() {
  $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  supplier_list('1');
});
$(window).on('hashchange', function(e) {
  $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  supplier_list('1');
});
$("input#REC_PER_HALAMAN").on('change', function() {
  $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  supplier_list('1')
});

function search() {
  $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  supplier_list('1');
}

function filter_wilayah(){
  $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  supplier_list('1');
}
function filter_material(){
  supplier_list('1');
}

$("tbody").on('click','a#relasi', function(){
	var relasi = $(this).attr('RMP_MASTER_PERSONAL_ID');
	console.log(relasi);
	window.open('?show=rmp/supplier/relasi_supplier/' + relasi + '', '_blank');
})

function wilayah_list(id_supplier)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=wilayah_list&ID_SUPPLIER=' + id_supplier,
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

function asisten_list(id_supplier)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=asisten_list&ID_SUPPLIER=' + id_supplier,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log(data.respon.text_msg);
        $("tbody#data_asisten").empty();
        for (i = 0; i < data.result.length; i++) {
          $("tbody#data_asisten").append("<tr class='detailLogId'>" +
					"<td >" + data.result[i].NO + ".</td>" +
          "<td><img height='70' src='cloud/relasi_a/"+ data.result[i].RMP_MASTER_PERSONAL_FOTO +"' onerror='imgError(this);' /></td>" +
          "<td>" + data.result[i].RMP_MASTER_PERSONAL_NAMA + "</td>" +
          "<td>" + data.result[i].RMP_MASTER_PERSONAL_HP + "</td>" +
          "<td>" + data.result[i].RMP_MASTER_PERSONAL_ALAMAT + ", " + data.result[i].INDONESIA_DESA + ", " + data.result[i].INDONESIA_KECAMATAN + ", " + data.result[i].INDONESIA_KABUPATEN + ", " + data.result[i].INDONESIA_PROVINSI + "</td>" +
          "<td><a class='btn_modalpersonal' ID_PERSONAL='"+data.result[i].RMP_MASTER_PERSONAL_ID+"'>Show</a></td>" +
					"</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#data_asisten").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      //error_handler_json(x, e, '=> barang_kamus_list()');
    } //end error
  });
}

function kontak_list(id_supplier)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=kontak_list&ID_SUPPLIER=' + id_supplier,
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
					"<td></td>" + "</tr>");
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

function keluarga_list(id_supplier)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=keluarga_list&ID_SUPPLIER=' + id_supplier,
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
          "<td><a class='btn_modalpersonal' ID_PERSONAL='"+data.result[i].RMP_MASTER_PERSONAL_ID+"'>Show</a></td>" +
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

function rekening_list(id_supplier)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=rekening_list&ID_SUPPLIER=' + id_supplier,
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

					"<td></td>" + "</tr>");
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


function rekening_relasi_list(id_supplier)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=rekening_relasi_list&ID_SUPPLIER=' + id_supplier,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log(data.respon.text_msg);
        $("tbody#data_rekening_relasi").empty();
        for (i = 0; i < data.result.length; i++) {
          $("tbody#data_rekening_relasi").append("<tr class='detailLogId'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_REKENING_RELASI +  "</td>" +
					"<td>" + data.result[i].RMP_MASTER_MATERIAL +  "</td>" +
					"<td>" + data.result[i].MASTER_WILAYAH +  "</td>" +
					"<td>" + data.result[i].RMP_MASTER_WILAYAH +  "</td>" +
					"<td></td>" + "</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#data_rekening_relasi").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      //error_handler_json(x, e, '=> barang_kamus_list()');
    } //end error
  });
}
function qualited_harga_list(id_supplier)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=qualited_harga_list&ID_SUPPLIER=' + id_supplier,
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


					"<td></td>" + "</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#data_qualited_harga").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      //error_handler_json(x, e, '=> barang_kamus_list()');
    } //end error
  });
}

function toleransi_mutu_list(id_supplier)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=toleransi_mutu_list&ID_SUPPLIER=' + id_supplier,
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

function dokumen_list(id_supplier)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=dokumen_list&ID_SUPPLIER=' + id_supplier,
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
					"<td><a class='btn_img_dokumen' IMG='"+data.result[i].RMP_DOKUMEN_FOTO+"'><i class='fa fa-search-plus' aria-hidden='true'></i> Show</a></td>" + "</tr>");
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


function data_personal_supplier(id_supplier)
{

  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=data_personal_supplier&ID_SUPPLIER=' + id_supplier,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log("DATA PERSONAL");
        for (i = 0; i < data.result.length; i++) {
          $('p.nama').html(data.result[0].RMP_MASTER_PERSONAL_NAMA)
          $('p.ktp').html(data.result[0].RMP_MASTER_PERSONAL_KTP)
          $('p.npwp').html(data.result[0].RMP_MASTER_PERSONAL_NPWP)
          $('p.tgl_daftar').html(data.result[0].TANGGAL_DAFTAR)
          $('p.suku').html(data.result[0].RMP_MASTER_PERSONAL_SUKU)
          $('p.alamat').html(data.result[0].RMP_MASTER_PERSONAL_ALAMAT+ ", " + data.result[0].INDONESIA_DESA+ ", " + data.result[0].INDONESIA_KECAMATAN+ ", " + data.result[0].INDONESIA_KABUPATEN+ ", " + data.result[0].INDONESIA_PROVINSI)
          $('img.FOTO_SUPPLIER').attr('src','cloud/relasi_a/'+data.result[0].RMP_MASTER_PERSONAL_FOTO)
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


$("tbody#data_asisten").on("click", "a.btn_modalpersonal", function(){
  var id_personal = $(this).attr("ID_PERSONAL");
  data_detail_personal(id_personal);
  //$('.modalPersonalFile').modal('hide');
  $('.modalDetailPersonal').modal('show');
})
$("tbody#data_keluarga").on("click", "a.btn_modalpersonal", function(){
  var id_personal = $(this).attr("ID_PERSONAL");
  data_detail_personal(id_personal);
  //$('.modalPersonalFile').modal('hide');
  $('.modalDetailPersonal').modal('show');
})

$('.TutupModalPersonalDetail').on('click', function()
{
	$(".modalDetailPersonal").modal('hide');
});

function data_detail_personal(id_personal)
{
  //alert(id_personal)
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=data_personal_detail&ID_PERSONAL=' + id_personal,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				//alert("sukses");
        for (i = 0; i < data.result.length; i++) {
          $('p.nama_personal').html(data.result[0].RMP_MASTER_PERSONAL_NAMA)
          $('p.ktp_personal').html(data.result[0].RMP_MASTER_PERSONAL_KTP)
          $('p.npwp_personal').html(data.result[0].RMP_MASTER_PERSONAL_NPWP)
          $('p.hp_personal').html(data.result[0].RMP_MASTER_PERSONAL_HP)
          $('p.suku_personal').html(data.result[0].RMP_MASTER_PERSONAL_SUKU)
          $('p.alamat_personal').html(data.result[0].RMP_MASTER_PERSONAL_ALAMAT+ ", " + data.result[0].INDONESIA_DESA+ ", " + data.result[0].INDONESIA_KECAMATAN+ ", " + data.result[0].INDONESIA_KABUPATEN+ ", " + data.result[0].INDONESIA_PROVINSI)
          $('img.FOTO_SUPPLIER_PERSONAL').attr('src','cloud/relasi_a/'+data.result[0].RMP_MASTER_PERSONAL_FOTO)
        }
      } else if (data.respon.pesan == "gagal") {
        //alert("gagal");
        $("tbody#data_personal").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      //error_handler_json(x, e, '=> barang_kamus_list()');
    } //end error
  });
}

$("tbody#data_dokumen").on("click", "a.btn_img_dokumen", function(){
  var img = $(this).attr("IMG");
  //$('.modalPersonalFile').modal('hide');
  $('img.img_dokumen').attr('src','cloud/relasi_a/'+img)
  $('.modalDokumen').modal('show');
})

$('.TutupModalIMG').on('click', function()
{
	$(".modalDokumen").modal('hide');
});
</script>
