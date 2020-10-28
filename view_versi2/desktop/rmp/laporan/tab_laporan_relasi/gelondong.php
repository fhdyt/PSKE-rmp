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
    <select class="NAMA_SUPPLIER with-ajax-personal form-control" data-live-search="true" id="NAMA_SUPPLIER" name="NAMA_SUPPLIER" onchange="sel_nama_supplier()">
    </select>
  </div>
  <div class="col-md-2">
    <select id="FILTER_BULAN" onchange="filter()" name="FILTER_BULAN" type="text" class=" form-control FILTER_BULAN"  autocomplete="off" onchange="filter_material()">
    <option value="01" <?php if (date("m")=="01"){echo "selected";} ?>>Januari</option>
    <option value="02" <?php if (date("m")=="02"){echo "selected";} ?>>Februari</option>
    <option value="03" <?php if (date("m")=="03"){echo "selected";} ?>>Maret</option>
    <option value="04" <?php if (date("m")=="04"){echo "selected";} ?>>April</option>
    <option value="05" <?php if (date("m")=="05"){echo "selected";} ?>>Mei</option>
    <option value="06" <?php if (date("m")=="06"){echo "selected";} ?>>Juni</option>
    <option value="07" <?php if (date("m")=="07"){echo "selected";} ?>>Juli</option>
    <option value="08" <?php if (date("m")=="08"){echo "selected";} ?>>Agusutus</option>
    <option value="09" <?php if (date("m")=="09"){echo "selected";} ?>>September</option>
    <option value="10" <?php if (date("m")=="10"){echo "selected";} ?>>Oktober</option>
    <option value="11" <?php if (date("m")=="11"){echo "selected";} ?>>November</option>
    <option value="12" <?php if (date("m")=="12"){echo "selected";} ?>>Desember</option>
          </select>
  </div>
  <div class="col-md-2">
    <select id="FILTER_TAHUN" onchange="filter()" name="FILTER_TAHUN" type="text" class=" form-control FILTER_TAHUN"  autocomplete="off" onchange="filter_material()">
    <option value="2019" <?php if (date("Y")=="2019"){echo "selected";} ?> >2019</option>
    <option value="2020" <?php if (date("Y")=="2020"){echo "selected";} ?> >2020</option>
    <option value="2021" <?php if (date("Y")=="2021"){echo "selected";} ?> >2021</option>
    <option value="2022" <?php if (date("Y")=="2022"){echo "selected";} ?> >2022</option>
    <option value="2033" <?php if (date("Y")=="2023"){echo "selected";} ?> >2023</option>
    <option value="2024" <?php if (date("Y")=="2024"){echo "selected";} ?> >2024</option>
    <option value="2025" <?php if (date("Y")=="2025"){echo "selected";} ?> >2025</option>
          </select>
  </div>
</div><!--/.row-->
<br>
<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th rowspan="2">No.</th>
      <th rowspan="2">Tanggal</th>
      <th rowspan="2">No. Faktur</th>
      <th rowspan="2">Kapal</th>
      <th colspan="5"><center>KB-A</center></th>
      <th colspan="5"><center>KB-B</center></th>
      <th colspan="5"><center>KB-C</center></th>
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

      <th><center>Kg BRUTO</center></th>
      <th><center>%</center></th>
      <th><center>Kg NETTO</center></th>
      <th id="td_rp_c">@Rp</th>
      <th><center>Rp</center></th>

      <th><center></center></th>

    </tr>
  </thead>
  <tbody id="zone_data"><tr><td colspan="11"><center><div class="loader"></div></center></td></tr></tbody>


</table>
<script>

$(function() {
  $('a.sidebar-toggle').click()
});

$(function () {
  //Initialize Select2 Elements
  $('.select2').select2()
  sel_nama_supplier();
  laporan_faktur_list()
})

function sel_nama_supplier()
{
  $("tbody#zone_data").html("<tr><td colspan='20'><center><div class='loader'></div></center></td></tr>")
  var options =
  {
    ajax: {
      url: refseeAPI,
      type: 'POST',
      dataType: 'json',
      data: {
        q: '{{{q}}}',
        material: 'GELONDONG',
        ref: 'sel_nama_supplier_with_rek',
      }
    },
    locale:
    {
      emptyTitle: 'Pilih Nama'
    },
    log: 3,
    preprocessData: function(data)
    {
      //console.log(data.result)
      var i, l = data.result.length,
        array = [];
      if (l)
      {
        for (i = 0; i < l; i++)
        {
          array.push($.extend(true, data.result[i],
          {
            text: data.result[i].RMP_REKENING_RELASI+' - '+data.result[i].RMP_MASTER_PERSONAL_NAMA,
            value: data.result[i].RMP_MASTER_PERSONAL_ID,
            data:
            {
              subtext: ''
            }
          }));
        }
      }
      else
      {
      }
      return array;
    }
  };
  $('.NAMA_SUPPLIER').selectpicker().filter('.with-ajax-personal').ajaxSelectPicker(options);
  laporan_faktur_list()
}


function laporan_faktur_list(curPage,wilayah)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=laporan_relasi_faktur&supplier=' + $(".NAMA_SUPPLIER").val()+ '&material=jambul' + '&bulan=' + $(".FILTER_BULAN").val() + '&tahun=' + $(".FILTER_TAHUN").val(),
    success: function(data) {
      console.log(data.respon.text_msg)
      if (data.respon.pesan == "sukses") {
        $("tbody#zone_data").empty();

        console.log(data.result)
        for (i = 0; i < data.result.length; i++) {
          if(data.result[i].PURCHASER_STATUS == "A")
          {
            var tr = ""
          }
          else{
            var tr = "danger"
            var btn_kirim = ""
          }
          $("tbody#zone_data").append("<tr clas='"+tr+"' id='list_laporan' >" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_TANGGAL + "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_NO_FAKTUR + "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_KAPAL + "</td>" +

					"<td align='right'>" + data.result[i].BRUTO_A + "</td>" +
					"<td align='right'>" + data.result[i].PERSEN_A + "</td>" +
					"<td align='right'>" + data.result[i].NETTO_A + "</td>" +
          "<td align='right'>" + data.result[i].RP_KG_A + "</td>" +
          "<td align='right'>" + data.result[i].RP_A + "</td>" +

          "<td align='right'>" + data.result[i].BRUTO_B + "</td>" +
          "<td align='right'>" + data.result[i].PERSEN_B + "</td>" +
					"<td align='right'>" + data.result[i].NETTO_B + "</td>" +
          "<td align='right'>" + data.result[i].RP_KG_B + "</td>" +
          "<td align='right'>" + data.result[i].RP_B + "</td>" +

          "<td align='right'>" + data.result[i].BRUTO_C + "</td>" +
          "<td align='right'>" + data.result[i].PERSEN_C + "</td>" +
					"<td align='right'>" + data.result[i].NETTO_C + "</td>" +
          "<td align='right'>" + data.result[i].RP_KG_C + "</td>" +
          "<td align='right'>" + data.result[i].RP_C + "</td>" +

          "<td><a class='btn btn-success btn-xs' target='_blank' href='?show=rmp/purchaser/detail_faktur/"+ data.result[i].RMP_FAKTUR_ID +"'><span class='fa fa-calculator' aria-hidden='true'></span></a></td>" +
          "</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#zone_data").html("<tr><td colspan='20'></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error AjaxX");
    } //end error
  });
}

function filter(){
$("tbody#zone_data").html("<tr><td colspan='20'><center><div class='loader'></div></center></td></tr>")
laporan_faktur_list()
}
</script>
