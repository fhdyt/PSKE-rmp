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
						<h3><i class="fa fa-cubes"></i> Master Pengepul</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right"></div>
				</div><!--/.row-->
				<a class="btn btn-primary btn-sm" href="?show=rmp/supplier/add_pengepul">Tambah Pengepul</a> <!-- <button class="btn btn-primary btn-sm tambah" type="button"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Inventori</button> -->
				<table class="table table-hover">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama</th>
							<th>Tanggal Daftar</th>
							<th>Nomor HP</th>
							<th>Telp/Fax</th>
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

<script>
function pengepul_list(curPage)
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
    data: 'ref=pengepul_list&batas=' + $('input#REC_PER_HALAMAN').val() + '&halaman=' + curPage + '&keyword=' + $("input#keyword").val(),
    success: function(data) {
			console.log("List");
      if (data.respon.pesan == "sukses") {
        $("tbody#zone_data").empty();
        $('#tujuan-light-pagination').pagination({
          pages: data.result_option.jml_halaman,
          cssStyle: 'light-theme',
          currentPage: curPage,
        });
        for (i = 0; i < data.result.length; i++) {
          $("tbody#zone_data").append("<tr class='detailLogId'  detailLogId='" + data.result[i].ICD_BARANG_INDEX + "'>" + "<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_MASTER_PENGEPUL_NAMA + "</td>" +
					"<td>" + data.result[i].TANGGAL_DAFTAR + "</td>" +
					"<td>" + data.result[i].RMP_MASTER_PENGEPUL_HP + "</td>" +
					"<td>" + data.result[i].RMP_MASTER_PENGEPUL_TELP + "</td>" +
					"<td></td>" + "</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#zone_data").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      error_handler_json(x, e, '=> barang_kamus_list()');
    } //end error
  });
}
$(function() {
  pengepul_list('1');
});
$(window).on('hashchange', function(e) {
  pengepul_list('1');
});
$("input#REC_PER_HALAMAN").on('change', function() {
  pengepul_list('1')
});

function search() {
  pengepul_list('1');
}

</script>
