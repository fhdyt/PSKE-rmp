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
      <th colspan="5"><center>KB-A</center></th>

      <th colspan="5"><center>KB-B</center></th>

    </tr>
    <tr>
      <th><center>Kg BRUTO</center></th>
      <th><center>%</center></th>
      <th><center>Kg NETTO</center></th>
      <th id="td_rp_a">@Rp</th>
      <th><center>Rp</center></th>

      <th><center>Kg BRUTO</center></th>
      <th><center>%</center></th>
      <th><center>Kg NETTO</center></th>
      <th id="td_rp_b">@Rp</th>
      <th><center>Rp</center></th>

    </tr>
  </thead>
  <tbody id="zone_data_02"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_02">
    <tr>
      <td colspan="5" style="text-align:right"># (02)</td>
      <td id="02_SUM_BRUTO_A"></td>
      <td id="02_SUM_PERSEN_A"></td>
      <td id="02_SUM_NETTO_A"></td>
      <td id="02_SUM_RP_KG_A"></td>
      <td id="02_SUM_RP_A"></td>

      <td id="02_SUM_BRUTO_B"></td>
      <td id="02_SUM_PERSEN_B"></td>
      <td id="02_SUM_NETTO_B"></td>
      <td id="02_SUM_RP_KG_B"></td>
      <td id="02_SUM_RP_B"></td>
    </tr></tfooter>

  <tbody id="zone_data_03"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_03">
    <tr>
      <td colspan="5" style="text-align:right"># (03)</td>
      <td id="03_SUM_BRUTO_A"></td>
      <td id="03_SUM_PERSEN_A"></td>
      <td id="03_SUM_NETTO_A"></td>
      <td id="03_SUM_RP_KG_A"></td>
      <td id="03_SUM_RP_A"></td>

      <td id="03_SUM_BRUTO_B"></td>
      <td id="03_SUM_PERSEN_B"></td>
      <td id="03_SUM_NETTO_B"></td>
      <td id="03_SUM_RP_KG_B"></td>
      <td id="03_SUM_RP_B"></td>
    </tr></tfooter>

  <tbody id="zone_data_04"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_04">
    <tr>
      <td colspan="5" style="text-align:right"># (04)</td>
      <td id="04_SUM_BRUTO_A"></td>
      <td id="04_SUM_PERSEN_A"></td>
      <td id="04_SUM_NETTO_A"></td>
      <td id="04_SUM_RP_KG_A"></td>
      <td id="04_SUM_RP_A"></td>

      <td id="04_SUM_BRUTO_B"></td>
      <td id="04_SUM_PERSEN_B"></td>
      <td id="04_SUM_NETTO_B"></td>
      <td id="04_SUM_RP_KG_B"></td>
      <td id="04_SUM_RP_B"></td>
    </tr></tfooter>

  <tbody id="zone_data_05"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_05">
    <tr>
      <td colspan="5" style="text-align:right"># (05)</td>
      <td id="05_SUM_BRUTO_A"></td>
      <td id="05_SUM_PERSEN_A"></td>
      <td id="05_SUM_NETTO_A"></td>
      <td id="05_SUM_RP_KG_A"></td>
      <td id="05_SUM_RP_A"></td>

      <td id="05_SUM_BRUTO_B"></td>
      <td id="05_SUM_PERSEN_B"></td>
      <td id="05_SUM_NETTO_B"></td>
      <td id="05_SUM_RP_KG_B"></td>
      <td id="05_SUM_RP_B"></td>
    </tr></tfooter>

  <tbody id="zone_data_06"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_06">
    <tr>
      <td colspan="5" style="text-align:right"># (06)</td>
      <td id="06_SUM_BRUTO_A"></td>
      <td id="06_SUM_PERSEN_A"></td>
      <td id="06_SUM_NETTO_A"></td>
      <td id="06_SUM_RP_KG_A"></td>
      <td id="06_SUM_RP_A"></td>

      <td id="06_SUM_BRUTO_B"></td>
      <td id="06_SUM_PERSEN_B"></td>
      <td id="06_SUM_NETTO_B"></td>
      <td id="06_SUM_RP_KG_B"></td>
      <td id="06_SUM_RP_B"></td>
    </tr></tfooter>

  <tbody id="zone_data_07"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_07">
    <tr>
      <td colspan="5" style="text-align:right"># (07)</td>
      <td id="07_SUM_BRUTO_A"></td>
      <td id="07_SUM_PERSEN_A"></td>
      <td id="07_SUM_NETTO_A"></td>
      <td id="07_SUM_RP_KG_A"></td>
      <td id="07_SUM_RP_A"></td>

      <td id="07_SUM_BRUTO_B"></td>
      <td id="07_SUM_PERSEN_B"></td>
      <td id="07_SUM_NETTO_B"></td>
      <td id="07_SUM_RP_KG_B"></td>
      <td id="07_SUM_RP_B"></td>
    </tr></tfooter>

  <tbody id="zone_data_08"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_08">
    <tr>
      <td colspan="5" style="text-align:right"># (08)</td>
      <td id="08_SUM_BRUTO_A"></td>
      <td id="08_SUM_PERSEN_A"></td>
      <td id="08_SUM_NETTO_A"></td>
      <td id="08_SUM_RP_KG_A"></td>
      <td id="08_SUM_RP_A"></td>

      <td id="08_SUM_BRUTO_B"></td>
      <td id="08_SUM_PERSEN_B"></td>
      <td id="08_SUM_NETTO_B"></td>
      <td id="08_SUM_RP_KG_B"></td>
      <td id="08_SUM_RP_B"></td>
    </tr></tfooter>

  <tbody id="zone_data_09"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_09">
    <tr>
      <td colspan="5" style="text-align:right"># (09)</td>
      <td id="09_SUM_BRUTO_A"></td>
      <td id="09_SUM_PERSEN_A"></td>
      <td id="09_SUM_NETTO_A"></td>
      <td id="09_SUM_RP_KG_A"></td>
      <td id="09_SUM_RP_A"></td>

      <td id="09_SUM_BRUTO_B"></td>
      <td id="09_SUM_PERSEN_B"></td>
      <td id="09_SUM_NETTO_B"></td>
      <td id="09_SUM_RP_KG_B"></td>
      <td id="09_SUM_RP_B"></td>
    </tr></tfooter>

  <tbody id="zone_data_10"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_10">
    <tr>
      <td colspan="5" style="text-align:right"># (10)</td>
      <td id="10_SUM_BRUTO_A"></td>
      <td id="10_SUM_PERSEN_A"></td>
      <td id="10_SUM_NETTO_A"></td>
      <td id="10_SUM_RP_KG_A"></td>
      <td id="10_SUM_RP_A"></td>

      <td id="10_SUM_BRUTO_B"></td>
      <td id="10_SUM_PERSEN_B"></td>
      <td id="10_SUM_NETTO_B"></td>
      <td id="10_SUM_RP_KG_B"></td>
      <td id="10_SUM_RP_B"></td>
    </tr></tfooter>

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
</div>
<!--/row-->

<script>

$(function() {
  $('a.sidebar-toggle').click()
});

function laporan_faktur_list(curPage,wilayah)
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
    data: 'ref=laporan_faktur&batas=' + $('input#REC_PER_HALAMAN').val() + '&halaman=' + curPage + '&keyword=' + $("input#keyword").val()+ '&tanggal=' + $(".FILTER_TANGGAL").val()+ '&wilayah=' + wilayah + '&material=jambul',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log("Sukses");
        $("tbody#zone_data_"+wilayah+"").empty();
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
          $("tbody#zone_data_"+wilayah+"").append("<tr class='detailLogId' id='list_laporan' >" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_MASTER_PERSONAL_NAMA + "</td>" +
					"<td>" + data.result[i].MASTER_WILAYAH + "</td>" +
					"<td>" + data.result[i].RMP_REKENING_RELASI + "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_NO_FAKTUR + "</td>" +
					"<td>" + data.result[i].BRUTO_A + "</td>" +
					"<td>" + data.result[i].PERSEN_A + "</td>" +
					"<td>" + data.result[i].NETTO_A + "</td>" +
          "<td>" + data.result[i].RP_KG_A + "</td>" +
          "<td>" + data.result[i].RP_A + "</td>" +

          "<td>" + data.result[i].BRUTO_B + "</td>" +
          "<td>" + data.result[i].PERSEN_B + "</td>" +
					"<td>" + data.result[i].NETTO_B + "</td>" +
          "<td>" + data.result[i].RP_KG_B + "</td>" +
          "<td>" + data.result[i].RP_B + "</td>" +
          "</tr>");

          $("td#"+wilayah+"_SUM_BRUTO_A").html(data.result[i].SUM_BRUTO_A)
          $("td#"+wilayah+"_SUM_NETTO_A").html(data.result[i].SUM_NETTO_A)
          $("td#"+wilayah+"_SUM_RP_A").html(data.result[i].SUM_RP_A)

          $("td#"+wilayah+"_SUM_BRUTO_B").html(data.result[i].SUM_BRUTO_B)
          $("td#"+wilayah+"_SUM_NETTO_B").html(data.result[i].SUM_NETTO_B)
          $("td#"+wilayah+"_SUM_RP_B").html(data.result[i].SUM_RP_B)
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#zone_data_"+wilayah+"").html("");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}
$(function() {
  console.log("function");
  laporan_faktur_list('1','02');
  laporan_faktur_list('1','03');
  laporan_faktur_list('1','04');
  laporan_faktur_list('1','05');
  laporan_faktur_list('1','06');
  laporan_faktur_list('1','07');
  laporan_faktur_list('1','08');
  laporan_faktur_list('1','09');
  laporan_faktur_list('1','10');
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
  laporan_faktur_list('1','02');
  laporan_faktur_list('1','03');
  laporan_faktur_list('1','04');
  laporan_faktur_list('1','05');
  laporan_faktur_list('1','06');
  laporan_faktur_list('1','07');
  laporan_faktur_list('1','08');
  laporan_faktur_list('1','09');
  laporan_faktur_list('1','10');

}
</script>
