<?php
$RMP_CONFIG=new RMP_CONFIG();
$SISTEM_CONFIG=new SISTEM_CONFIG();
 ?>
<style>
.modalMD {
  width: 1000px;
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
table{
font-size: 12px;
}

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

.modal-large {
	width: 1000px;
}
</style>
<a class="btn btn-primary btn-sm tambah_harga_fc">Tambah Harga</a> <!-- <button class="btn btn-primary btn-sm tambah" type="button"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Inventori</button> -->
<table class="table table-hover">
  <thead>
    <tr>
      <th>No.</th>
      <th>Harga A</th>
      <th>Harga B</th>
      <th>Harga C</th>
      <th>Berlaku</th>
      <th>Berakhir</th>
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

<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalTambahHarga" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-large" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Tambah Harga Baru Faktur Cabang</h4>
			</div>
			<div class="modal-body">
        <form action="javascript:download();" class="fDataHarga" id="fDataHarga" name="fDataHarga">
          <div class="row">
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga A</label>
                <input autocomplete="off" class="form-control HARGA_A" id="HARGA_A" name="HARGA_A" placeholder="" type="text">
								<p class="help-block QUALITED_WARNING text-danger"></p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga B</label>
                <input autocomplete="off" class="form-control HARGA_B" id="HARGA_B" name="HARGA_B" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga C</label>
                <input autocomplete="off" class="form-control HARGA_C" id="HARGA_C" name="HARGA_C" placeholder="" type="text">
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
    						<button class="btn btn-success btn-sm FormKirimSimpanHarga">Simpan</button>
    					</div>
            </div>
          </div>
				</form>
		</div>
	</div>
</div>
</div>

<script>
$('.tambah_harga_fc').on('click', function()
{
	$(".modalTambahHarga").modal('show');
});

$(function() {
	$(".datepicker").datepicker().on('changeDate', function(ev) {
		$('.datepicker').datepicker('hide');
	});
});


function harga_list(curPage)
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
    data: 'ref=konfigurasi_harga_fc_list&batas=' + $('input#REC_PER_HALAMAN').val() + '&halaman=' + curPage + '&keyword=' + $("input#keyword").val(),
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
          $("tbody#zone_data").append("<tr class='detailLogId'  >" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_KONFIGURASI_HARGA_FC_A + "</td>" +
					"<td>" + data.result[i].RMP_KONFIGURASI_HARGA_FC_B + "</td>" +
					"<td>" + data.result[i].RMP_KONFIGURASI_HARGA_FC_C + "</td>" +
					"<td>" + data.result[i].TANGGAL_BERLAKU + "</td>" +
					"<td>" + data.result[i].TANGGAL_BERAKHIR + "</td>" +

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
  harga_list('1');
});
$(window).on('hashchange', function(e) {
  harga_list('1');
});
$("input#REC_PER_HALAMAN").on('change', function() {
  harga_list('1')
});

function search() {
  harga_list('1');
}


$(".FormKirimSimpanHarga").on('click', function(){
var form = $("#fDataHarga").serialize();
console.log(form)
  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=konfigurasi_harga_fc_add&' + form ,
  	success: function(data) {
  		if (data.respon.pesan == "sukses")
  		{
        $(".modalTambahHarga").modal('hide');
  			alert("Harga Tersimpan")

        harga_list('1');
  		}
  		else if (data.respon.pesan == "gagal")
  		{
  			console.log(data.respon.text_msg);
  			alert("Gagal Menyimpan");
  		}
  	}, //end success
  	error: function(x, e)
    {
  		console.log("Error Ajax QUALITED");
  	} //end error
  });
})
</script>
