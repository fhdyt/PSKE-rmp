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
						<h3><i class="fa fa-calculator"></i> Verifikasi Harga</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right"></div>
				</div><!--/.row-->
        <div class="row">
          <div class="col-md-12">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nomor Faktur</th>
                  <th>Rekening</th>
                  <th>Material</th>
                  <th>Wilayah</th>
                  <th>Tanggal</th>
                  <th>Nama Supplier</th>
                  <th>Harga Baru</th>
                  <th>Harga Lama</th>
                  <th>Purchaser</th>
                  <th>Keterangan</th>
                  <th>Verifikasi</th>
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
$(function() {
  $('a.sidebar-toggle').click()
});
function verifikasi_harga_list(curPage)
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
    data: 'ref=verifikasi_harga_list&batas=' + $('input#REC_PER_HALAMAN').val() + '&halaman=' + curPage + '&keyword=' + $("input#keyword").val(),
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
          if(data.result[i].FRECORD_STATUS == "V")
          {
            var td = "<td><a class='btn btn-success btn-sm verifikasi_action' verifikasi='yes' no_faktur='"+data.result[i].RMP_FAKTUR_NO_FAKTUR+"'><span class='fa fa-thumbs-o-up' aria-hidden='true'></span></a> <a class='btn btn-danger btn-sm verifikasi_action' verifikasi='no' no_faktur='"+data.result[i].RMP_FAKTUR_NO_FAKTUR+"'><span class='fa fa-thumbs-o-down' aria-hidden='true'></span></a></td>"
          }
          else if (data.result[i].FRECORD_STATUS == "D")
          {
            var td = "<td><p class='text-danger'><i>Ditolak</i></p></td>"
          }
          else
          {
            var td = "<td><p class='text-success'><i>Diterima</i></p></td>"
          }
          $("tbody#zone_data").append("<tr class='detailLogId'  >" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_NO_FAKTUR + "</td>" +
					"<td>" + data.result[i].REKENING + "</td>" +
					"<td>" + data.result[i].MATERIAL + "</td>" +
					"<td>" + data.result[i].MASTER_WILAYAH + "</td>" +
					"<td>" + data.result[i].TANGGAL + "</td>" +
					"<td>" + data.result[i].RMP_MASTER_PERSONAL_NAMA + "</td>" +
					"<td class='success'>" + data.result[i].RMP_FAKTUR_PURCHASER_RP_KG + "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_PURCHASER_RP_KG_LAMA + "</td>" +
					"<td>" + data.result[i].PURCHASER + "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_PURCHASER_KET + "</td>" +
          td +
          "</tr>");
					}
      } else if (data.respon.pesan == "gagal") {
        $("tbody#zone_data").html("<tr><td colspan='20'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

$(function() {
  console.log("function");
  verifikasi_harga_list('1');
});
$(window).on('hashchange', function(e) {
  verifikasi_harga_list('1');
});
$("input#REC_PER_HALAMAN").on('change', function() {
  verifikasi_harga_list('1')
});

function search() {
  verifikasi_harga_list('1');
}

$("tbody#zone_data").on('click','a.verifikasi_action', function(){

  var status = "STATUS="+$(this).attr('verifikasi')
  var no_faktur = "NO_FAKTUR="+$(this).attr('no_faktur')
  var form = ""+status+"&"+no_faktur
  if (confirm('Apakah anda sudah yakin?.'))
      {
        $.ajax({
          type: 'POST',
          url: refseeAPI,
          dataType: 'json',
          data: 'ref=verifikasi_action&' + form ,
          success: function(data) {
            if (data.respon.pesan == "sukses")
            {
              alert("Berhasil")
              verifikasi_harga_list('1');
            }
            else if (data.respon.pesan == "gagal")
            {
              alert (data.respon.text_msg);
            }
          }, //end success
          error: function(x, e)
          {
            console.log("Error Ajax QUALITED");
          } //end error
        });
      }

})
</script>
