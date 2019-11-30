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
      <th colspan="5"><center></center></th>

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
      <th><center></center></th>

    </tr>
  </thead>
  <tbody id="zone_data_02"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_02">
    <tr class="warning">
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
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right">AKUM</td>
      <td id="02_SUM_BRUTO_A_BULAN"></td>
      <td id="02_SUM_PERSEN_A_BULAN"></td>
      <td id="02_SUM_NETTO_A_BULAN"></td>
      <td id="02_SUM_RP_KG_A_BULAN"></td>
      <td id="02_SUM_RP_A_BULAN"></td>

      <td id="02_SUM_BRUTO_B_BULAN"></td>
      <td id="02_SUM_PERSEN_B_BULAN"></td>
      <td id="02_SUM_NETTO_B_BULAN"></td>
      <td id="02_SUM_RP_KG_B_BULAN"></td>
      <td id="02_SUM_RP_B_BULAN"></td>
    </tr>

  </tfooter>

  <tbody id="zone_data_03"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_03">
    <tr class="warning">
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
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right">AKUM</td>
      <td id="03_SUM_BRUTO_A_BULAN"></td>
      <td id="03_SUM_PERSEN_A_BULAN"></td>
      <td id="03_SUM_NETTO_A_BULAN"></td>
      <td id="03_SUM_RP_KG_A_BULAN"></td>
      <td id="03_SUM_RP_A_BULAN"></td>

      <td id="03_SUM_BRUTO_B_BULAN"></td>
      <td id="03_SUM_PERSEN_B_BULAN"></td>
      <td id="03_SUM_NETTO_B_BULAN"></td>
      <td id="03_SUM_RP_KG_B_BULAN"></td>
      <td id="03_SUM_RP_B_BULAN"></td>
    </tr>
  </tfooter>

  <tbody id="zone_data_04"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_04">
    <tr class="warning">
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
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right">AKUM</td>
      <td id="04_SUM_BRUTO_A_BULAN"></td>
      <td id="04_SUM_PERSEN_A_BULAN"></td>
      <td id="04_SUM_NETTO_A_BULAN"></td>
      <td id="04_SUM_RP_KG_A_BULAN"></td>
      <td id="04_SUM_RP_A_BULAN"></td>

      <td id="04_SUM_BRUTO_B_BULAN"></td>
      <td id="04_SUM_PERSEN_B_BULAN"></td>
      <td id="04_SUM_NETTO_B_BULAN"></td>
      <td id="04_SUM_RP_KG_B_BULAN"></td>
      <td id="04_SUM_RP_B_BULAN"></td>
    </tr>
  </tfooter>

  <tbody id="zone_data_05"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_05">
    <tr class="warning">
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
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right">AKUM</td>
      <td id="05_SUM_BRUTO_A_BULAN"></td>
      <td id="05_SUM_PERSEN_A_BULAN"></td>
      <td id="05_SUM_NETTO_A_BULAN"></td>
      <td id="05_SUM_RP_KG_A_BULAN"></td>
      <td id="05_SUM_RP_A_BULAN"></td>

      <td id="05_SUM_BRUTO_B_BULAN"></td>
      <td id="05_SUM_PERSEN_B_BULAN"></td>
      <td id="05_SUM_NETTO_B_BULAN"></td>
      <td id="05_SUM_RP_KG_B_BULAN"></td>
      <td id="05_SUM_RP_B_BULAN"></td>
    </tr>
  </tfooter>

  <tbody id="zone_data_06"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_06">
    <tr class="warning">
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
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right">AKUM</td>
      <td id="06_SUM_BRUTO_A_BULAN"></td>
      <td id="06_SUM_PERSEN_A_BULAN"></td>
      <td id="06_SUM_NETTO_A_BULAN"></td>
      <td id="06_SUM_RP_KG_A_BULAN"></td>
      <td id="06_SUM_RP_A_BULAN"></td>

      <td id="06_SUM_BRUTO_B_BULAN"></td>
      <td id="06_SUM_PERSEN_B_BULAN"></td>
      <td id="06_SUM_NETTO_B_BULAN"></td>
      <td id="06_SUM_RP_KG_B_BULAN"></td>
      <td id="06_SUM_RP_B_BULAN"></td>
    </tr>
  </tfooter>

  <tbody id="zone_data_07"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_07">
    <tr class="warning">
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
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right">AKUM</td>
      <td id="07_SUM_BRUTO_A_BULAN"></td>
      <td id="07_SUM_PERSEN_A_BULAN"></td>
      <td id="07_SUM_NETTO_A_BULAN"></td>
      <td id="07_SUM_RP_KG_A_BULAN"></td>
      <td id="07_SUM_RP_A_BULAN"></td>

      <td id="07_SUM_BRUTO_B_BULAN"></td>
      <td id="07_SUM_PERSEN_B_BULAN"></td>
      <td id="07_SUM_NETTO_B_BULAN"></td>
      <td id="07_SUM_RP_KG_B_BULAN"></td>
      <td id="07_SUM_RP_B_BULAN"></td>
    </tr>
  </tfooter>

  <tbody id="zone_data_08"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_08">
    <tr class="warning">
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
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right">AKUM</td>
      <td id="08_SUM_BRUTO_A_BULAN"></td>
      <td id="08_SUM_PERSEN_A_BULAN"></td>
      <td id="08_SUM_NETTO_A_BULAN"></td>
      <td id="08_SUM_RP_KG_A_BULAN"></td>
      <td id="08_SUM_RP_A_BULAN"></td>

      <td id="08_SUM_BRUTO_B_BULAN"></td>
      <td id="08_SUM_PERSEN_B_BULAN"></td>
      <td id="08_SUM_NETTO_B_BULAN"></td>
      <td id="08_SUM_RP_KG_B_BULAN"></td>
      <td id="08_SUM_RP_B_BULAN"></td>
    </tr>
  </tfooter>

  <tbody id="zone_data_09"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_09">
    <tr class="warning">
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
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right">AKUM</td>
      <td id="09_SUM_BRUTO_A_BULAN"></td>
      <td id="09_SUM_PERSEN_A_BULAN"></td>
      <td id="09_SUM_NETTO_A_BULAN"></td>
      <td id="09_SUM_RP_KG_A_BULAN"></td>
      <td id="09_SUM_RP_A_BULAN"></td>

      <td id="09_SUM_BRUTO_B_BULAN"></td>
      <td id="09_SUM_PERSEN_B_BULAN"></td>
      <td id="09_SUM_NETTO_B_BULAN"></td>
      <td id="09_SUM_RP_KG_B_BULAN"></td>
      <td id="09_SUM_RP_B_BULAN"></td>
    </tr>
  </tfooter>

  <tbody id="zone_data_10"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_10">
    <tr class="warning">
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
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right">AKUM</td>
      <td id="10_SUM_BRUTO_A_BULAN"></td>
      <td id="10_SUM_PERSEN_A_BULAN"></td>
      <td id="10_SUM_NETTO_A_BULAN"></td>
      <td id="10_SUM_RP_KG_A_BULAN"></td>
      <td id="10_SUM_RP_A_BULAN"></td>

      <td id="10_SUM_BRUTO_B_BULAN"></td>
      <td id="10_SUM_PERSEN_B_BULAN"></td>
      <td id="10_SUM_NETTO_B_BULAN"></td>
      <td id="10_SUM_RP_KG_B_BULAN"></td>
      <td id="10_SUM_RP_B_BULAN"></td>
    </tr>
  </tfooter>

<!-- ---------------------TOTAL SELURUH FAKTUR-------------------------------------------------------------------- -->

    <tbody id="zone_data_10"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
      <tr class="success">
        <td colspan="5" id="TANGGAL_LAPORAN" style="text-align:right"></td>
        <td id="TOTAL_SUM_BRUTO_A"></td>
        <td id="TOTAL_SUM_PERSEN_A"></td>
        <td id="TOTAL_SUM_NETTO_A"></td>
        <td id="TOTAL_SUM_RP_KG_A"></td>
        <td id="TOTAL_SUM_RP_A"></td>

        <td id="TOTAL_SUM_BRUTO_B"></td>
        <td id="TOTAL_SUM_PERSEN_B"></td>
        <td id="TOTAL_SUM_NETTO_B"></td>
        <td id="TOTAL_SUM_RP_KG_B"></td>
        <td id="TOTAL_SUM_RP_B"></td>
      </tr></tfooter>

      <tr class="success">
        <td colspan="5" style="text-align:right">Bulan Ini</td>
        <td id="TOTAL_BULAN_SUM_BRUTO_A"></td>
        <td id="TOTAL_SUM_PERSEN_A"></td>
        <td id="TOTAL_BULAN_SUM_NETTO_A"></td>
        <td id="TOTAL_SUM_RP_KG_A"></td>
        <td id="TOTAL_BULAN_SUM_RP_A"></td>

        <td id="TOTAL_BULAN_SUM_BRUTO_B"></td>
        <td id="TOTAL_SUM_PERSEN_B"></td>
        <td id="TOTAL_BULAN_SUM_NETTO_B"></td>
        <td id="TOTAL_SUM_RP_KG_B"></td>
        <td id="TOTAL_BULAN_SUM_RP_B"></td>
      </tr></tbody>

</table>
<script>

$(function() {
  $('a.sidebar-toggle').click()
});

function laporan_faktur_list(curPage,wilayah)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=laporan_faktur&keyword=' + $("input#keyword").val()+ '&tanggal=' + $(".FILTER_TANGGAL").val()+ '&wilayah=' + wilayah + '&material=jambul',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log("Sukses");
        $("tbody#zone_data_"+wilayah+"").empty();

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
          "<td><a class='btn btn-success btn-sm' href='?show=rmp/purchaser/detail_faktur/"+ data.result[i].RMP_FAKTUR_ID +"'><span class='fa fa-calculator' aria-hidden='true'></span></a></td>" +
          "</tr>");

          $("td#"+wilayah+"_SUM_BRUTO_A").html(data.result[i].SUM_BRUTO_A)
          $("td#"+wilayah+"_SUM_NETTO_A").html(data.result[i].SUM_NETTO_A)
          $("td#"+wilayah+"_SUM_RP_A").html(data.result[i].SUM_RP_A)

          $("td#"+wilayah+"_SUM_BRUTO_B").html(data.result[i].SUM_BRUTO_B)
          $("td#"+wilayah+"_SUM_NETTO_B").html(data.result[i].SUM_NETTO_B)
          $("td#"+wilayah+"_SUM_RP_B").html(data.result[i].SUM_RP_B)

          $("td#"+wilayah+"_SUM_BRUTO_A_BULAN").html(data.result[i].SUM_BRUTO_A_BULAN)
          $("td#"+wilayah+"_SUM_NETTO_A_BULAN").html(data.result[i].SUM_NETTO_A_BULAN)
          $("td#"+wilayah+"_SUM_RP_A_BULAN").html(data.result[i].SUM_RP_A_BULAN)

          $("td#"+wilayah+"_SUM_BRUTO_B_BULAN").html(data.result[i].SUM_BRUTO_B_BULAN)
          $("td#"+wilayah+"_SUM_NETTO_B_BULAN").html(data.result[i].SUM_NETTO_B_BULAN)
          $("td#"+wilayah+"_SUM_RP_B_BULAN").html(data.result[i].SUM_RP_B_BULAN)
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#zone_data_"+wilayah+"").html("<tr><td colspan='16'></td></tr>");

        $("td#"+wilayah+"_SUM_BRUTO_A").html("0")
        $("td#"+wilayah+"_SUM_NETTO_A").html("0")
        $("td#"+wilayah+"_SUM_RP_A").html("0")

        $("td#"+wilayah+"_SUM_BRUTO_B").html("0")
        $("td#"+wilayah+"_SUM_NETTO_B").html("0")
        $("td#"+wilayah+"_SUM_RP_B").html("0")

        $("td#"+wilayah+"_SUM_BRUTO_A_BULAN").html("0")
        $("td#"+wilayah+"_SUM_NETTO_A_BULAN").html("0")
        $("td#"+wilayah+"_SUM_RP_A_BULAN").html("0")

        $("td#"+wilayah+"_SUM_BRUTO_B_BULAN").html("0")
        $("td#"+wilayah+"_SUM_NETTO_B_BULAN").html("0")
        $("td#"+wilayah+"_SUM_RP_B_BULAN").html("0")
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

function total_laporan()
{

  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=total_laporan&keyword=' + $("input#keyword").val()+ '&tanggal=' + $(".FILTER_TANGGAL").val()+ '&material=jambul',
    success: function(data) {
      //alert(data.respon.pesan)
      if (data.respon.pesan == "sukses") {
        // KELAPA A
        for (i = 0; i < data.result.length; i++) {
          $("td#TANGGAL_LAPORAN").html("Tanggal "+data.result[i].TANGGAL)
          $("td#TOTAL_SUM_BRUTO_A").html(data.result[i].TOTAL_SUM_BRUTO_A)
          $("td#TOTAL_SUM_NETTO_A").html(data.result[i].TOTAL_SUM_NETTO_A)
          $("td#TOTAL_SUM_RP_A").html(data.result[i].TOTAL_SUM_RP_A)
        }

        // KELAPA B
        for (i = 0; i < data.result_b.length; i++) {
          $("td#TOTAL_SUM_BRUTO_B").html(data.result_b[i].TOTAL_SUM_BRUTO_B)
          $("td#TOTAL_SUM_NETTO_B").html(data.result_b[i].TOTAL_SUM_NETTO_B)
          $("td#TOTAL_SUM_RP_B").html(data.result_b[i].TOTAL_SUM_RP_B)
        }

        // KELAPA A
        for (i = 0; i < data.result_bulan.length; i++) {
          $("td#TOTAL_BULAN_SUM_BRUTO_A").html(data.result_bulan[i].TOTAL_BULAN_SUM_BRUTO_A)
          $("td#TOTAL_BULAN_SUM_NETTO_A").html(data.result_bulan[i].TOTAL_BULAN_SUM_NETTO_A)
          $("td#TOTAL_BULAN_SUM_RP_A").html(data.result_bulan[i].TOTAL_BULAN_SUM_RP_A)
        }

        // KELAPA B
        for (i = 0; i < data.result_bulan_b.length; i++) {
          $("td#TOTAL_BULAN_SUM_BRUTO_B").html(data.result_bulan_b[i].TOTAL_BULAN_SUM_BRUTO_B)
          $("td#TOTAL_BULAN_SUM_NETTO_B").html(data.result_bulan_b[i].TOTAL_BULAN_SUM_NETTO_B)
          $("td#TOTAL_BULAN_SUM_RP_B").html(data.result_bulan_b[i].TOTAL_BULAN_SUM_RP_B)
        }

      } else if (data.respon.pesan == "gagal") {
        $("td#TOTAL_SUM_BRUTO_A").html("0")
        $("td#TOTAL_SUM_NETTO_A").html("0")
        $("td#TOTAL_SUM_RP_A").html("0")

        $("td#TOTAL_SUM_BRUTO_B").html("0")
        $("td#TOTAL_SUM_NETTO_B").html("0")
        $("td#TOTAL_SUM_RP_B").html("0")

        $("td#TOTAL_BULAN_SUM_BRUTO_A").html("0")
        $("td#TOTAL_BULAN_SUM_NETTO_A").html("0")
        $("td#TOTAL_BULAN_SUM_RP_A").html("0")

        $("td#TOTAL_BULAN_SUM_BRUTO_B").html("0")
        $("td#TOTAL_BULAN_SUM_NETTO_B").html("0")
        $("td#TOTAL_BULAN_SUM_RP_B").html("0")
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
  total_laporan();
});


function search() {
  laporan_faktur_list('1');
}

function filter_tanggal(){
  $("tbody#zone_data_02").html("<tr><td colspan='11'><center><div class='loader'></div></center></td></tr>");
  $("tbody#zone_data_03").html("<tr><td colspan='11'><center><div class='loader'></div></center></td></tr>");
  $("tbody#zone_data_04").html("<tr><td colspan='11'><center><div class='loader'></div></center></td></tr>");
  $("tbody#zone_data_05").html("<tr><td colspan='11'><center><div class='loader'></div></center></td></tr>");
  $("tbody#zone_data_06").html("<tr><td colspan='11'><center><div class='loader'></div></center></td></tr>");
  $("tbody#zone_data_07").html("<tr><td colspan='11'><center><div class='loader'></div></center></td></tr>");
  $("tbody#zone_data_08").html("<tr><td colspan='11'><center><div class='loader'></div></center></td></tr>");
  $("tbody#zone_data_09").html("<tr><td colspan='11'><center><div class='loader'></div></center></td></tr>");
  $("tbody#zone_data_10").html("<tr><td colspan='11'><center><div class='loader'></div></center></td></tr>");
  laporan_faktur_list('1','02');
  laporan_faktur_list('1','03');
  laporan_faktur_list('1','04');
  laporan_faktur_list('1','05');
  laporan_faktur_list('1','06');
  laporan_faktur_list('1','07');
  laporan_faktur_list('1','08');
  laporan_faktur_list('1','09');
  laporan_faktur_list('1','10');
  total_laporan();
}
</script>
