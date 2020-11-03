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
						<h3><i class="fa fa-money"></i> Periode Pembayaran</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right">

          </div>
				</div><!--/.row-->

        <br>
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tanggal</th>
                  <th>Dana Material</th>
                  <th>Sisa</th>
                  <th>ID Periode</th>
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
            <label>Jumlah Baris Per Halaman</label> <input class="form-control" id="REC_PER_HALAMAN" max='1000' min="1" name="REC_PER_HALAMAN" required="" type="number" value="150">
            </div>
            </div><!--/row-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>


$(".tambah_periode").on("click", function(){
    $(".modalPeriode").modal("show")
})

$(function()
{
	$(".datepicker").datepicker().on('changeDate', function(ev)
	{
		$('.datepicker').datepicker('hide');
	});
});

function filter(){
  console.log("filter")
$("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
faktur_list('1')
}

function dana_material_list(curPage)
{
  console.log("run")
  console.log($(".FILTER_PROSES").val())
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
    data: 'ref=periode_list&batas=' + $('input#REC_PER_HALAMAN').val() + '&halaman=' + curPage + '&keyword=' + $("input#keyword").val() + '&material=' + $(".FILTER_MATERIAL").val() + '&bulan=' + $(".FILTER_BULAN").val() + '&tanggal=' + $(".FILTER_TANGGAL").val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        //alert(data.respon.text_msg)
        console.log(data.result)
        $("tbody#zone_data").empty();
        $('#tujuan-light-pagination').pagination({
          pages: data.result_option.jml_halaman,
          cssStyle: 'light-theme',
          currentPage: curPage,
        });
        for (i = 0; i < data.result.length; i++) {
          if(data.result[i].FINANCE_DANA_MATERIAL_STATUS == "AKTIF")
          {
            var tr = "success"
          }
          else
          {
            var tr = "default"
          }
          $("tbody#zone_data").append("<tr class="+tr+">" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td >" + data.result[i].TANGGAL + "</td>" +
					"<td >" + data.result[i].DANA + "</td>" +
					"<td >" + data.result[i].SISA + "</td>" +
					"<td >" + data.result[i].FINANCE_DANA_MATERIAL_ID + "</td>" +
          "<td><a class='btn btn-success btn-sm' href='?show=rmp/pengajuan_pembayaran/detail/"+ data.result[i].FINANCE_DANA_MATERIAL_ID +"'><span class='fa fa-calculator' aria-hidden='true'></span></a></td>" +


          "</tr>");
					}
      } else if (data.respon.pesan == "gagal") {
        //alert(data.respon.text_msg)
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
  dana_material_list('1');
});
$(window).on('hashchange', function(e) {
  $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  dana_material_list('1');
});
$("input#REC_PER_HALAMAN").on('change', function() {
  $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  dana_material_list('1')
});

function search() {
  $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  dana_material_list('1');
}


</script>
