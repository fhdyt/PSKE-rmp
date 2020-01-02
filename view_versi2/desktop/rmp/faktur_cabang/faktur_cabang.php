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
table{
font-size: 12px;
}
</style>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="list-group">
			<div class="list-group-item">
				<div class="row">
					<div class="col-md-8">
						<h3><i class="fa fa-calculator"></i>Faktur Cabang</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right"></div>
				</div><!--/.row-->
        <div class="row">
          <div class="col-md-12">
            <a class="btn btn-primary btn-sm" href="?show=rmp/faktur_cabang/tambah_faktur_cabang">Tambah Faktur Cabang</a>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>ID Faktur Cabang</th>
                  <th>PS Cabang</th>
                  <th>Material</th>
                  <th>Kapal</th>
                  <th>Tanggal</th>
                  <th></th>
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
  </div>
</div>
<script>
function lisst_faktur_cabang(curPage)
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
    data: 'ref=list_faktur_cabang&batas=' + $('input#REC_PER_HALAMAN').val() + '&halaman=' + curPage + '&keyword=' + $("input#keyword").val(),
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
          if(data.result[i].RMP_REKAP_FC_PROSES_ADM_PKB == "Yes")
          {
            var tr = "success"
          }
          else {
            var tr = "default"
          }
          $("tbody#zone_data").append("<tr class='"+tr+"'  >" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_REKAP_FC_ID + "</td>" +
					"<td>" + data.result[i].RMP_MASTER_PERSONAL_NAMA + "</td>" +
					"<td>" + data.result[i].RMP_REKAP_FC_JENIS_KB + "</td>" +
					"<td>" + data.result[i].RMP_REKAP_FC_KAPAL + "</td>" +
					"<td>" + data.result[i].TANGGAL + "</td>" +
          "<td><a class='btn btn-default btn-sm' href='?show=rmp/faktur_cabang/tambah_faktur_cabang/"+ data.result[i].RMP_REKAP_FC_ID +"'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</a></td>" +


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
  lisst_faktur_cabang('1');
});
$(window).on('hashchange', function(e) {
  lisst_faktur_cabang('1');
});
$("input#REC_PER_HALAMAN").on('change', function() {
  lisst_faktur_cabang('1')
});

function search() {
  lisst_faktur_cabang('1');
}
</script>
