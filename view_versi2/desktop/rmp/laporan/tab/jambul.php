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

table{
font-size: 12px;
}
</style>
<div class="row">
  <div class="col-md-8">
  </div>
  <div class="col-md-4 ">
    <form id="form_filter" method="POST">
      <input type="date" id="FILTER_TANGGAL" class="form-control FILTER_TANGGAL" name="FILTER_TANGGAL" onchange="filter_tanggal()" value="<?php echo date("Y-m-d"); ?>"/>
          <p class="help-block">Tanggal.</p>
        </form>
  </div>
</div><!--/.row-->
<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th rowspan="2">No.</th>
      <th rowspan="2">Nama</th>
      <th rowspan="2">Alamat</th>
      <th rowspan="2">Rekening</th>
      <th rowspan="2">Nomor Faktur</th>
      <th colspan="3"><center>KB-A</center></th>

      <th colspan="3"><center>KB-B</center></th>

    </tr>
    <tr>
      <th>Kg NETTO</th>
      <th id="td_rp_a">@Rp</th>
      <th>Rp</th>
      <th>Kg NETTO</th>
      <th id="td_rp_b">@Rp</th>
      <th>Rp</th>

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

<script>

$(function() {
  $('a.sidebar-toggle').click()
});

function laporan_faktur_list(curPage)
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
    data: 'ref=laporan_faktur&batas=' + $('input#REC_PER_HALAMAN').val() + '&halaman=' + curPage + '&keyword=' + $("input#keyword").val()+ '&tanggal=' + $(".FILTER_TANGGAL").val()+ '&material=jambul',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log("Sukses");
        $("tbody#zone_data").empty();
        $('#tujuan-light-pagination').pagination({
          pages: data.result_option.jml_halaman,
          cssStyle: 'light-theme',
          currentPage: curPage,
        });
        console.log(data.result.length)
        for (i = 0; i < data.result.length; i++) {
          var jumlah_data = data.result.length;
          var nomor = i;
          // console.log(nomor);
          $("tbody#zone_data").append("<tr class='detailLogId' id='list_laporan' >" +
					"<td >" + data.result[i].NO + ".</td>" +
				//	"<td>" + data.result[i+1].RMP_MASTER_WILAYAH_KODE + "</td>" +
					"<td>" + data.result[i].RMP_MASTER_PERSONAL_NAMA + "</td>" +
					"<td>" + data.result[i].MASTER_WILAYAH + "</td>" +
					"<td>" + data.result[i].RMP_REKENING_RELASI + "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_NO_FAKTUR + "</td>" +
					"<td>" + data.result[i].NETTO_A + "</td>" +
          "<td>" + data.result[i].RP_KG_A + "</td>" +
          "<td>" + data.result[i].RP_A + "</td>" +
					"<td>" + data.result[i].NETTO_B + "</td>" +
          "<td>" + data.result[i].RP_KG_B + "</td>" +
          "<td>" + data.result[i].RP_B + "</td>" +
					// "<td>" + data.result[i].NETTO_C + "</td>" +
          // "<td>" + data.result[i].RP_KG_C + "</td>" +
          // "<td>" + data.result[i].RP_C + "</td>" +
          "</tr>");
          if(data.result[i].RMP_MASTER_WILAYAH_KODE != data.result[i+1].RMP_MASTER_WILAYAH_KODE)
          {
            $("tbody#zone_data").append("<tr class='detailLogId' id='list_laporan' >" +
            "<td >Total</td>" +
            "</tr>");
          }
          else if(data.result[i].NO === jumlah_data)
          {
             alert("berhasil")
            $("tbody#zone_data").append("<tr class='detailLogId' id='list_laporan' >" +
            "<td >Total</td>" +
            "</tr>");
					}
          console.log(data.result[i].NO)
        }
      } else if (data.respon.pesan == "gagal") {
        console.log("Gagal");
        console.log(data.respon.text_msg)
        $("tbody#zone_data").html("<tr><td colspan='25'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}
$(function() {
  console.log("function");
  laporan_faktur_list('1');
});
$(window).on('hashchange', function(e) {
  laporan_faktur_list('1');
});
$("input#REC_PER_HALAMAN").on('change', function() {
  laporan_faktur_list('1')
});

function search() {
  laporan_faktur_list('1');
}

function filter_tanggal(){
  laporan_faktur_list('1');
}
</script>
