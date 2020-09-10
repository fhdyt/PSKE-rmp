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
    <marquee><h3>On Progress...</h3></marquee>
  </div>
  <div class="col-md-4 ">
    <form id="form_filter" method="POST">
      <input type="date" id="FILTER_TANGGAL" class="form-control FILTER_TANGGAL" name="FILTER_TANGGAL" onchange="filter_tanggal()" value="<?php echo date("Y-m-d"); ?>"/>
          <p class="help-block">Tanggal.</p>
        </form>
        <!-- <a class="cetak_laporan btn btn-sm btn-primary">Cetak</a> -->
  </div>
</div><!--/.row-->
<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Nama</th>
      <th>Alamat</th>
      <th>Rekening</th>
      <th>Nomor Faktur</th>
      <th>Goni</th>
      <th>Kg Basah</th>
      <th>%</th>
      <th>@Rp Basah</th>
      <th>Kg Kering</th>
      <th>@Rp Kering</th>
      <th>Rp</th>
      <th></th>

    </tr>
  </thead>
  <tbody id="zone_data_02"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_02">
    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;"># (02)</td>
      <td id="02_SUM_GONI" style="text-align:right ;font-weight: bold;"></td>
      <td id="02_SUM_BRUTO" style="text-align:right ;font-weight: bold;"></td>
      <td id="02_SUM_KUALITET" style="text-align:right ;font-weight: bold;"></td>
      <td id="02_SUM_RP_BASAH" style="text-align:right ;font-weight: bold;"></td>
      <td id="02_SUM_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="02_SUM_RP_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="02_SUM_RP" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;">AKUM</td>
      <td id="02_SUM_GONI_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="02_SUM_BRUTO_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="02_SUM_KUALITET_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="02_SUM_RP_BASAH_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="02_SUM_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="02_SUM_RP_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="02_SUM_RP_BULAN_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>

  </tfooter>

  <tbody id="zone_data_03"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_03">
    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;"># (03)</td>
      <td id="03_SUM_GONI" style="text-align:right ;font-weight: bold;"></td>
      <td id="03_SUM_BRUTO" style="text-align:right ;font-weight: bold;"></td>
      <td id="03_SUM_KUALITET" style="text-align:right ;font-weight: bold;"></td>
      <td id="03_SUM_RP_BASAH" style="text-align:right ;font-weight: bold;"></td>
      <td id="03_SUM_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="03_SUM_RP_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="03_SUM_RP" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;">AKUM</td>
      <td id="03_SUM_GONI_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="03_SUM_BRUTO_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="03_SUM_KUALITET_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="03_SUM_RP_BASAH_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="03_SUM_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="03_SUM_RP_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="03_SUM_RP_BULAN_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>
  </tfooter>

  <tbody id="zone_data_04"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_04">
    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;"># (04)</td>
      <td id="04_SUM_GONI" style="text-align:right ;font-weight: bold;"></td>
      <td id="04_SUM_BRUTO" style="text-align:right ;font-weight: bold;"></td>
      <td id="04_SUM_KUALITET" style="text-align:right ;font-weight: bold;"></td>
      <td id="04_SUM_RP_BASAH" style="text-align:right ;font-weight: bold;"></td>
      <td id="04_SUM_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="04_SUM_RP_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="04_SUM_RP" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;">AKUM</td>
      <td id="04_SUM_GONI_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="04_SUM_BRUTO_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="04_SUM_KUALITET_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="04_SUM_RP_BASAH_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="04_SUM_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="04_SUM_RP_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="04_SUM_RP_BULAN_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>
  </tfooter>

  <tbody id="zone_data_05"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_05">
    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;"># (05)</td>
      <td id="05_SUM_GONI" style="text-align:right ;font-weight: bold;"></td>
      <td id="05_SUM_BRUTO" style="text-align:right ;font-weight: bold;"></td>
      <td id="05_SUM_KUALITET" style="text-align:right ;font-weight: bold;"></td>
      <td id="05_SUM_RP_BASAH" style="text-align:right ;font-weight: bold;"></td>
      <td id="05_SUM_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="05_SUM_RP_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="05_SUM_RP" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;">AKUM</td>
      <td id="05_SUM_GONI_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="05_SUM_BRUTO_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="05_SUM_KUALITET_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="05_SUM_RP_BASAH_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="05_SUM_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="05_SUM_RP_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="05_SUM_RP_BULAN_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>
  </tfooter>

  <tbody id="zone_data_06"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_06">
    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;"># (06)</td>
      <td id="06_SUM_GONI" style="text-align:right ;font-weight: bold;"></td>
      <td id="06_SUM_BRUTO" style="text-align:right ;font-weight: bold;"></td>
      <td id="06_SUM_KUALITET" style="text-align:right ;font-weight: bold;"></td>
      <td id="06_SUM_RP_BASAH" style="text-align:right ;font-weight: bold;"></td>
      <td id="06_SUM_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="06_SUM_RP_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="06_SUM_RP" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;">AKUM</td>
      <td id="06_SUM_GONI_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="06_SUM_BRUTO_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="06_SUM_KUALITET_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="06_SUM_RP_BASAH_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="06_SUM_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="06_SUM_RP_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="06_SUM_RP_BULAN_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>
  </tfooter>

  <tbody id="zone_data_07"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_07">
    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;"># (07)</td>
      <td id="07_SUM_GONI" style="text-align:right ;font-weight: bold;"></td>
      <td id="07_SUM_BRUTO" style="text-align:right ;font-weight: bold;"></td>
      <td id="07_SUM_KUALITET" style="text-align:right ;font-weight: bold;"></td>
      <td id="07_SUM_RP_BASAH" style="text-align:right ;font-weight: bold;"></td>
      <td id="07_SUM_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="07_SUM_RP_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="07_SUM_RP" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;">AKUM</td>
      <td id="07_SUM_GONI_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="07_SUM_BRUTO_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="07_SUM_KUALITET_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="07_SUM_RP_BASAH_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="07_SUM_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="07_SUM_RP_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="07_SUM_RP_BULAN_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>
  </tfooter>

  <tbody id="zone_data_08"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_08">
    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;"># (08)</td>
      <td id="08_SUM_GONI" style="text-align:right ;font-weight: bold;"></td>
      <td id="08_SUM_BRUTO" style="text-align:right ;font-weight: bold;"></td>
      <td id="08_SUM_KUALITET" style="text-align:right ;font-weight: bold;"></td>
      <td id="08_SUM_RP_BASAH" style="text-align:right ;font-weight: bold;"></td>
      <td id="08_SUM_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="08_SUM_RP_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="08_SUM_RP" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;">AKUM</td>
      <td id="08_SUM_GONI_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="08_SUM_BRUTO_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="08_SUM_KUALITET_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="08_SUM_RP_BASAH_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="08_SUM_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="08_SUM_RP_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="08_SUM_RP_BULAN_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>
  </tfooter>

  <tbody id="zone_data_09"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_09">
    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;"># (09)</td>
      <td id="09_SUM_GONI" style="text-align:right ;font-weight: bold;"></td>
      <td id="09_SUM_BRUTO" style="text-align:right ;font-weight: bold;"></td>
      <td id="09_SUM_KUALITET" style="text-align:right ;font-weight: bold;"></td>
      <td id="09_SUM_RP_BASAH" style="text-align:right ;font-weight: bold;"></td>
      <td id="09_SUM_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="09_SUM_RP_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="09_SUM_RP" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;">AKUM</td>
      <td id="09_SUM_GONI_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="09_SUM_BRUTO_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="09_SUM_KUALITET_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="09_SUM_RP_BASAH_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="09_SUM_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="09_SUM_RP_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="09_SUM_RP_BULAN_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>
  </tfooter>

  <tbody id="zone_data_10"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>
  <tfooter id="foot_data_10">
    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;"># (10)</td>
      <td id="10_SUM_GONI" style="text-align:right ;font-weight: bold;"></td>
      <td id="10_SUM_BRUTO" style="text-align:right ;font-weight: bold;"></td>
      <td id="10_SUM_KUALITET" style="text-align:right ;font-weight: bold;"></td>
      <td id="10_SUM_RP_BASAH" style="text-align:right ;font-weight: bold;"></td>
      <td id="10_SUM_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="10_SUM_RP_KERING" style="text-align:right ;font-weight: bold;"></td>
      <td id="10_SUM_RP" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>

    <tr class="warning">
      <td colspan="5" style="text-align:right ;font-weight: bold;">AKUM</td>
      <td id="10_SUM_GONI_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="10_SUM_BRUTO_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="10_SUM_KUALITET_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="10_SUM_RP_BASAH_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="10_SUM_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="10_SUM_RP_KERING_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td id="10_SUM_RP_BULAN_BULAN" style="text-align:right ;font-weight: bold;"></td>
      <td></tr>
    </tr>
  </tfooter>

<!-- ---------------------TOTAL SELURUH FAKTUR-------------------------------------------------------------------- -->

    <tbody id="zone_data_101"><tr><td colspan="11"></tbody>
      <tr class="success">
        <td colspan="6" id="TANGGAL_LAPORAN" style="text-align:right ;font-weight: bold;"></td>
        <td id="TOTAL_SUM_BRUTO_A" style="text-align:right ;font-weight: bold;"></td>
        <td id="TOTAL_SUM_PERSEN_A" style="text-align:right ;font-weight: bold;"></td>
        <td id="TOTAL_SUM_NETTO_A" style="text-align:right ;font-weight: bold;"></td>
        <td id="TOTAL_SUM_RP_KG_A" style="text-align:right ;font-weight: bold;"></td>
        <td id="TOTAL_SUM_RP_A" style="text-align:right ;font-weight: bold;"></td>

        <td id="TOTAL_SUM_BRUTO_B" style="text-align:right ;font-weight: bold;"></td>
        <td id="TOTAL_SUM_PERSEN_B" style="text-align:right ;font-weight: bold;"></td>
      </tr></tfooter>

      <tr class="success">
        <td colspan="6" id="BULAN_LAPORAN" style="text-align:right ;font-weight: bold;"></td>
        <td id="TOTAL_BULAN_SUM_BRUTO_A" style="text-align:right ;font-weight: bold;"></td>
        <td id="TOTAL_SUM_PERSEN_A" style="text-align:right ;font-weight: bold;"></td>
        <td id="TOTAL_BULAN_SUM_NETTO_A" style="text-align:right ;font-weight: bold;"></td>
        <td id="TOTAL_SUM_RP_KG_A" style="text-align:right ;font-weight: bold;"></td>
        <td id="TOTAL_BULAN_SUM_RP_A" style="text-align:right ;font-weight: bold;"></td>

        <td id="TOTAL_BULAN_SUM_BRUTO_B" style="text-align:right ;font-weight: bold;"></td>
        <td id="TOTAL_SUM_PERSEN_B" style="text-align:right ;font-weight: bold;"></td>
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
    data: 'ref=laporan_faktur_kp&keyword=' + $("input#keyword").val()+ '&tanggal=' + $(".FILTER_TANGGAL").val()+ '&wilayah=' + wilayah + '&material=KOPRA',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log("Sukses");
        $("tbody#zone_data_"+wilayah+"").empty();

        console.log(data.result)
        for (i = 0; i < data.result.length; i++) {
          var jumlah_data = data.result.length;
          var nomor = i;
          if(data.result[i].RMP_FAKTUR_STATUS == "NOT"){
            var btn_kirim = "<a class='btn btn-link btn-xs kirim_pembukuan' no_faktur='" + data.result[i].RMP_FAKTUR_NO_FAKTUR + "'><span class='fa fa-book icon_kirim_pembukuan' aria-hidden='true'></span></a>"
          }
          else{
            var btn_kirim = ""
          }

          if(data.result[i].PURCHASER_STATUS == "A")
          {
            var tr = ""
          }
          else{
            var tr = "danger"
          }

          if(data.result[i].RMP_FAKTUR_PURCHASER_RP_KG == null)
          {
            data.result[i].RMP_FAKTUR_PURCHASER_RP_KG = "0"
          }
          // console.log(nomor);
          $("tbody#zone_data_"+wilayah+"").append("<tr class='"+tr+"' id='list_laporan' >" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_MASTER_PERSONAL_NAMA + "</td>" +
					"<td>" + data.result[i].MASTER_WILAYAH + "</td>" +
					"<td>" + data.result[i].RMP_REKENING_RELASI + "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_NO_FAKTUR + "</td>" +
					"<td align='right'>" + data.result[i].RMP_FAKTUR_GONI + "</td>" +
					"<td align='right'>" + data.result[i].KG_BASAH + "</td>" +
					"<td align='right'>" + data.result[i].RMP_FAKTUR_KUALITET + "</td>" +
          "<td align='right'>" + data.result[i].RMP_FAKTUR_PURCHASER_RP_KG + "</td>" +
          "<td align='right'>" + data.result[i].KG_KERING + "</td>" +
          "<td align='right'>" + data.result[i].RP_KERING + "</td>" +
          "<td align='right'>" + data.result[i].TOTAL + "</td>" +

          "<td><a class='btn btn-success btn-xs' target='_blank' href='?show=rmp/purchaser/detail_faktur_kp/"+ data.result[i].RMP_FAKTUR_ID +"'><span class='fa fa-calculator' aria-hidden='true'></span></a></td>" +
          "</tr>");

          $("td#"+wilayah+"_SUM_GONI").html(data.result[i].SUM_GONI)
          $("td#"+wilayah+"_SUM_BRUTO").html(data.result[i].SUM_BRUTO)
          $("td#"+wilayah+"_SUM_KUALITET").html("")
          $("td#"+wilayah+"_SUM_RP_BASAH").html("")
          $("td#"+wilayah+"_SUM_KERING").html("")
          $("td#"+wilayah+"_SUM_RP_KERING").html("")
          $("td#"+wilayah+"_SUM_RP").html(data.result[i].SUM_RP)

          $("td#"+wilayah+"_SUM_GONI_BULAN").html(data.result[i].SUM_GONI_BULAN)
          $("td#"+wilayah+"_SUM_BRUTO_BULAN").html(data.result[i].SUM_BRUTO_BULAN)
          $("td#"+wilayah+"_SUM_KUALITET_BULAN").html("")
          $("td#"+wilayah+"_SUM_RP_BASAH_BULAN").html("")
          $("td#"+wilayah+"_SUM_KERING_BULAN").html("")
          $("td#"+wilayah+"_SUM_RP_KERING_BULAN").html("")
          $("td#"+wilayah+"_SUM_RP_BULAN").html(data.result[i].SUM_RP_BULAN)

        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#zone_data_"+wilayah+"").html("<tr><td colspan='16'></td></tr>");

        $("td#"+wilayah+"_SUM_BRUTO").html("0")
        $("td#"+wilayah+"_SUM_NETTO").html("0")
        $("td#"+wilayah+"_SUM_RP").html("0")

        $("td#"+wilayah+"_SUM_BRUTO_BULAN").html("0")
        $("td#"+wilayah+"_SUM_NETTO_BULAN").html("0")
        $("td#"+wilayah+"_SUM_RP_BULAN").html("0")
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
    data: 'ref=total_laporan&keyword=' + $("input#keyword").val()+ '&tanggal=' + $(".FILTER_TANGGAL").val()+ '&material=kopra',
    success: function(data) {
      //alert(data.respon.pesan)
      if (data.respon.pesan == "sukses") {
        // KELAPA A
        //alert(data.respon.text_msg)
        for (i = 0; i < data.result.length; i++) {
          $("td#TANGGAL_LAPORAN").html("Hari Ini /  "+data.result[i].TANGGAL)
          $("td#BULAN_LAPORAN").html("Tanggal 01 S/D " +data.result[i].TANGGAL)
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
  total_laporan();
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

}

function kirim_pembukuan(no_faktur){
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=kirim_pembukuan&NO_FAKTUR=' + no_faktur ,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        console.log("sukses")
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
      else if (data.respon.pesan == "gagal")
      {
      //  alert (data.respon.text_msg);
        alert("Gagal Menyimpan");
      }
    }, //end success
    error: function(x, e)
    {
      console.log("Error Ajax");
    } //end error
  });
}
$("tbody#zone_data_02,tbody#zone_data_03,tbody#zone_data_04,tbody#zone_data_05,tbody#zone_data_06,tbody#zone_data_07,tbody#zone_data_08,tbody#zone_data_09,tbody#zone_data_10").on("click", "a.kirim_pembukuan", function(){
  $(this).find('span').removeClass('fa fa-book');
  $(this).find('span').addClass('fa fa-spinner fa-pulse fa-fw');
  var no_faktur = $(this).attr("no_faktur")
  kirim_pembukuan(no_faktur)
})

$(".cetak_laporan").on("click", function(){
  var material = btoa("KOPRA")
  var tanggal = btoa($(".FILTER_TANGGAL").val())
  window.open("?show=rmp/pdf/cetak_laporan_harian/"+ material +"/"+ tanggal , '_blank');
})
</script>
