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
<a class="btn btn-primary btn-sm tambah_material">Tambah Jenis Material</a> <!-- <button class="btn btn-primary btn-sm tambah" type="button"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Inventori</button> -->
<table class="table table-hover">
  <thead>
    <tr>
      <th>No.</th>
      <th>Kode Material</th>
      <th>Jenis Material</th>

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
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalJenisMaterial" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content ">
			<div class="modal-header ">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Jenis Material</h4>
			</div>
			<div class="modal-body ">
				<form action="javascript:download();" class="fDataJenisMaterial" id="fDataJenisMaterial" name="fDataJenisMaterial">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Kode Material</label>
                <input autocomplete="off" class="form-control KODE_MATERIAL" id="KODE_MATERIAL" name="KODE_MATERIAL" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label for="exampleInputEmail1">Jenis Material</label>
                <input autocomplete="off" class="form-control MATERIAL" id="MATERIAL" name="MATERIAL" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
                <input class="QUALITED" id="QUALITED" name="QUALITED" type="checkbox"> Ada data Kualitet ?
							</div>
						</div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
    						<button class="btn btn-success btn-sm FormKirimJenisMaterial">Simpan</button> <button class="btn btn-default btn-sm BatalJenisMaterial">Batal</button>
    					</div>
            </div>
          </div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
$('.tambah_material').on('click', function()
{
	$(".modalJenisMaterial").modal('show');
});
$('.BatalJenisMaterial').on('click', function()
{
	$(".modalJenisMaterial").modal('hide');
});




function material_list(curPage)
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
    data: 'ref=konfigurasi_material_list&batas=' + $('input#REC_PER_HALAMAN').val() + '&halaman=' + curPage + '&keyword=' + $("input#keyword").val(),
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
					"<td>" + data.result[i].RMP_MASTER_MATERIAL_ID + "</td>" +
					"<td>" + data.result[i].RMP_MASTER_MATERIAL + "</td>" +
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
  material_list('1');
});
$(window).on('hashchange', function(e) {
  material_list('1');
});
$("input#REC_PER_HALAMAN").on('change', function() {
  material_list('1')
});

function search() {
  material_list('1');
}


$('.FormKirimJenisMaterial').on('click',function(){
var formjenismaterial = $('form.fDataJenisMaterial').serialize();
console.log(formjenismaterial);

$.ajax({
	type: 'POST',
	url: refseeAPI,
	dataType: 'json',
	data: 'ref=konfigurasi_add_material&' + formjenismaterial ,
	success: function(data) {
		if (data.respon.pesan == "sukses")
		{
			console.log(data.respon.text_msg);
			//window.location.href = "?show=rmp/supplier/MASTER_PERSONAL";
      	$(".modalJenisMaterial").modal('hide');
        material_list('1');
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
</script>
