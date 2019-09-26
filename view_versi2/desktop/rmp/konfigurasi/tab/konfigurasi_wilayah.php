<?php
$RMP_CONFIG=new RMP_CONFIG();
 ?>
<style>
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
</style>
<a class="btn btn-primary btn-sm tambah_wilayah">Tambah Wilayah</a> <!-- <button class="btn btn-primary btn-sm tambah" type="button"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Inventori</button> -->
<table class="table table-hover">
  <thead>
    <tr>
      <th>No.</th>
      <th>Kode Wilayah</th>
      <th>Nama Wilayah</th>

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
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalWilayah" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content ">
			<div class="modal-header ">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Wilayah</h4>
			</div>
			<div class="modal-body ">
				<form action="javascript:download();" class="fDataWilayah" id="fDataWilayah" name="fDataWilayah">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Kode Wilayah</label>
                <input autocomplete="off" class="form-control KODE_WILAYAH" id="KODE_WILAYAH" name="KODE_WILAYAH" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label for="exampleInputEmail1">Wilayah</label>
                <input autocomplete="off" class="form-control WILAYAH" id="WILAYAH" name="WILAYAH" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
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
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalSubWilayah" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content ">
			<div class="modal-header ">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Lokasi</h4>
			</div>
			<div class="modal-body ">
				<form action="javascript:download();" class="fDataSubWilayah" id="fDataSubWilayah" name="fDataSubWilayah">
          <input autocomplete="off" class="form-control ID_MASTER_WILAYAH" id="ID_MASTER_WILAYAH" name="ID_MASTER_WILAYAH" placeholder="" type="hidden">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Jenis Material</label>
                <select class="form-control MATERIAL" id="MATERIAL" name="MATERIAL" onchange="jenis_rekening()">
									<option value="">
										--Pilih Bank--
									</option><?php  $data = $RMP_CONFIG->material(); foreach ($data['rasult'] as $key => $value) {   foreach ($value as $data => $isi)       { ?>
									<option value="<?php echo $isi['RMP_MASTER_MATERIAL_ID']; ?>">
										<?php  echo $isi['RMP_MASTER_MATERIAL'];?>
									</option><?php   }}      ?>
								</select>
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Kode Lokasi</label>
                <input autocomplete="off" class="form-control KODE_WILAYAH" id="KODE_WILAYAH" name="KODE_WILAYAH" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Lokasi</label>
                <input autocomplete="off" class="form-control WILAYAH" id="WILAYAH" name="WILAYAH" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
    						<button class="btn btn-success btn-sm FormKirimSubWilayah">Simpan</button> <button class="btn btn-default btn-sm BatalSubWilayah">Batal</button>
    					</div>
            </div>
          </div>
				</form>
			</div>
		</div>
	</div>
</div>

<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalSubWilayahList" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content ">
			<div class="modal-header ">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Lokasi</h4>
			</div>
			<div class="modal-body ">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Material</th>
              <th>Kode Lokasi</th>
              <th>Nama Lokasi</th>

            </tr>
          </thead>
          <tbody id="zone_sub_wilayah">
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
<script>
$('.tambah_wilayah').on('click', function()
{
	$(".modalWilayah").modal('show');
});
$('.BatalWilayah').on('click', function()
{
	$(".modalWilayah").modal('hide');
});


$('.BatalSubWilayah').on('click', function()
{
	$(".modalSubWilayah").modal('hide');
});




function wilayah_list(curPage)
{
  var url = window.location.href;
  var pageA = url.split("#");
  if (pageA[1] == undefined) {} else {
    var pageB = pageA[1].split("page-");
    if (pageB[1] == '') {
      var curPage = curPage;
    } else {
      var curPage = pageB[1];
    }
  }
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=konfigurasi_wilayah_list&batas=' + $('input#REC_PER_HALAMAN').val() + '&halaman=' + curPage + '&keyword=' + $("input#keyword").val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log("Sukses");
        $("tbody#zone_data").empty();
        $('#tujuan-light-pagination').pagination({
          pages: data.result_option.jml_halaman,
          cssStyle: 'light-theme',
          currentPage: curPage,
        });
        for (i = 0; i < data.result.length; i++) {
          $("tbody#zone_data").append("<tr class='detailLogId'  detailLogId='" + data.result[i].RMP_MASTER_PERSONAL_ID + "'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_MASTER_WILAYAH_KODE + "</td>" +
					"<td>" + data.result[i].RMP_MASTER_WILAYAH + "</td>" +
          "<td><a class='btn btn-default btn-sm btn_sub_wilayah' data-toggle='tooltip' data-placement='left' title='Tambah Lokasi' ID_WILAYAH='" + data.result[i].RMP_MASTER_WILAYAH_ID + "' ><i class='fa fa-plus-square' aria-hidden='true'></i></a> <a class='btn btn-default btn-sm btn_sub_wilayah_list' ID_WILAYAH='" + data.result[i].RMP_MASTER_WILAYAH_ID + "' data-toggle='tooltip' data-placement='left' title='Daftar Lokasi' ><i class='fa fa-list' aria-hidden='true'></i></a></td>" +
          "</tr>");
					}
      } else if (data.respon.pesan == "gagal") {
        console.log("Gagal");
        $("tbody#zone_data").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}
$(function() {
  console.log("function");
  wilayah_list('1');
});
$(window).on('hashchange', function(e) {
  wilayah_list('1');
});
$("input#REC_PER_HALAMAN").on('change', function() {
  wilayah_list('1')
});

function search() {
  wilayah_list('1');
}


$('.FormKirimWilayah').on('click',function(){
var formwilayah = $('form.fDataWilayah').serialize();
$.ajax({
	type: 'POST',
	url: refseeAPI,
	dataType: 'json',
	data: 'ref=konfigurasi_add_wilayah&' + formwilayah ,
	success: function(data) {
		if (data.respon.pesan == "sukses")
		{
			console.log(data.respon.text_msg);
			//window.location.href = "?show=rmp/supplier/MASTER_PERSONAL";
      	$(".modalWilayah").modal('hide');
        wilayah_list('1');
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

$('tbody').on('click', 'a.btn_sub_wilayah', function()
{
	var wilayah_id = $(this).attr('ID_WILAYAH');
  console.log(wilayah_id);
  $(".modalSubWilayah").modal('show');
  $('.ID_MASTER_WILAYAH').val(wilayah_id);

})

$('tbody').on('click', 'a.btn_sub_wilayah_list', function()
{
	var wilayah_id = $(this).attr('ID_WILAYAH');
  //console.log(wilayah_id);
  $(".modalSubWilayahList").modal('show');
  sub_wilayah_list(wilayah_id);

})


$('.FormKirimSubWilayah').on('click',function(){
var formsubwilayah = $('form.fDataSubWilayah').serialize();
$.ajax({
	type: 'POST',
	url: refseeAPI,
	dataType: 'json',
	data: 'ref=konfigurasi_add_sub_wilayah&' + formsubwilayah ,
	success: function(data) {
		if (data.respon.pesan == "sukses")
		{
			console.log(data.respon.text_msg);
			//window.location.href = "?show=rmp/supplier/MASTER_PERSONAL";
      	$(".modalSubWilayah").modal('hide');
        wilayah_list('1');
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


function sub_wilayah_list(wilayah_id)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=sub_wilayah_list&ID_WILAYAH='+wilayah_id,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log("Sukses");
        $("tbody#zone_sub_wilayah").empty();
        for (i = 0; i < data.result.length; i++) {
          $("tbody#zone_sub_wilayah").append("<tr class='detailLogId'  detailLogId='" + data.result[i].RMP_MASTER_PERSONAL_ID + "'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_MASTER_MATERIAL  + "</td>" +
					"<td>" + data.result[i].RMP_MASTER_WILAYAH_KODE + "</td>" +
					"<td>" + data.result[i].RMP_MASTER_WILAYAH + "</td>" +
          "</tr>");
					}
      } else if (data.respon.pesan == "gagal") {
        console.log(data.respon.pesan);
        $("tbody#zone_sub_wilayah").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}
</script>
