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
						<h3><i class="fa fa-calculator"></i> Pemberian Harga Faktur oleh Purchaser</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right"></div>
				</div><!--/.row-->
        <div class="row">
          <div class="col-md-12 text-right">
            <form id="form_filter" class="form-inline" method="POST" action="javascript:filter();">
              <div class="form-group">
            <!-- <select id="FILTER_PROSES" name="FILTER_PROSES" type="text" class=" form-control FILTER_PROSES"  autocomplete="off" onchange="filter_material()">
            <option value="">--Semua--</option>
            <option value="BELUM_PROSES">Belum diproses</option>
            <option value="TELAH_PROSES">Telah diproses</option>
                  </select> -->

            <select id="FILTER_MATERIAL" onchange="filter()" name="FILTER_MATERIAL" type="text" class=" form-control FILTER_MATERIAL"  autocomplete="off" onchange="filter_material()">
            <option value="">--Semua Material--</option>
            <option value="GELONDONG">GELONDONG</option>
            <option value="JAMBUL">JAMBUL</option>
            <option value="LICIN">LICIN</option>
            <option value="KOPRA">KOPRA</option>
                  </select>

            <select id="FILTER_BULAN" onchange="filter()" name="FILTER_BULAN" type="text" class=" form-control FILTER_BULAN"  autocomplete="off" onchange="filter_material()">
            <option value="">--Bulan--</option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
                  </select>
                </div>
					<div class="form-group">
              <input type="text" onchange="filter()" id="FILTER_TANGGAL" class="form-control FILTER_TANGGAL datepicker" name="FILTER_TANGGAL" value="<?php echo date("Y/m/d") ?>"/>
          </div>
					<div class="form-group">
            <button type="submit" class="btn btn-success filter"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
          </div>
          </div>
				</div><!--/.row-->
        <br>
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nomor Faktur</th>
                  <th>Nama Supplier <small><i>(Admin)</i></small></th>
                  <th>Nama Supplier <small><i>(Purchaser)</i></small></th>
                  <th>Alamat</th>
                  <th>Material</th>
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

function faktur_list(curPage)
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
    data: 'ref=faktur_list_purchaser&batas=' + $('input#REC_PER_HALAMAN').val() + '&halaman=' + curPage + '&keyword=' + $("input#keyword").val() + '&material=' + $(".FILTER_MATERIAL").val() + '&bulan=' + $(".FILTER_BULAN").val() + '&tanggal=' + $(".FILTER_TANGGAL").val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        //alert(data.respon.text_msg)
        $("tbody#zone_data").empty();
        $('#tujuan-light-pagination').pagination({
          pages: data.result_option.jml_halaman,
          cssStyle: 'light-theme',
          currentPage: curPage,
        });
        for (i = 0; i < data.result.length; i++) {
          if(data.result[i].STATUS_PURCHASAER == "A")
          {
            var tr = '#66bb6a'
            var verifikasi = ''
          }
          else if(data.result[i].STATUS_PURCHASAER == "V")
          {
            var tr = '#cddc39'
            var verifikasi = '<p class="text-danger"><small><i>Menunggu Verifikasi...</i></small></p>'
          }
          else
          {
            var tr = '#c8e6c9'
            var verifikasi = ''
          }

          if (data.result[i].NAMA_SUPPLIER_FAKTUR == null)
          {
            var nama_supplier = "<p class='text-danger'><i>Tidak Terdaftar</i></p>"
          }
          else
          {
            var nama_supplier = data.result[i].NAMA_SUPPLIER_FAKTUR
          }
          if (data.result[i].RMP_FAKTUR_NAMA_SUB == "" )
          {
            var supplier = data.result[i].RMP_MASTER_PERSONAL_NAMA
          }
          else
          {
            var supplier = data.result[i].RMP_MASTER_PERSONAL_NAMA +" / <b>"+ data.result[i].RMP_FAKTUR_NAMA_SUB +"</b>"
          }
          if (data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "KOPRA")
          {
            var detail_faktur = "detail_faktur_kp"
          }
          else {
            var detail_faktur = "detail_faktur"
          }
          $("tbody#zone_data").append("<tr bgcolor='"+tr+"'  >" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_NO_FAKTUR + "</td>" +
					"<td>" + supplier + "</td>" +
					"<td>" + nama_supplier + "" + verifikasi + "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_ALAMAT + "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_JENIS_MATERIAL + "</td>" +
					"<td>" + data.result[i].TANGGAL + "</td>" +
					//"<td>" + data.result[i].STATUS_PURCHASAERs + "</td>" +
          "<td><a class='btn btn-default btn-sm' href='?show=rmp/purchaser/"+detail_faktur+"/"+ data.result[i].RMP_FAKTUR_ID +"'><span class='fa fa-calculator' aria-hidden='true'></span></a></td>" +


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

setInterval(function(){
    faktur_list('1')
}, 9000);

$(function() {
  console.log("function");
  faktur_list('1');
});
$(window).on('hashchange', function(e) {
  $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  faktur_list('1');
});
$("input#REC_PER_HALAMAN").on('change', function() {
  $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  faktur_list('1')
});

function search() {
  $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  faktur_list('1');
}
</script>
