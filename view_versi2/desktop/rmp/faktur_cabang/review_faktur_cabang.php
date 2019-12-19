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
font-size: 11px;
}
.note{
font-size: 15px;
}
</style>
<!-- <pre class="TEST"></pre> -->
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="list-group">
			<div class="list-group-item">
				<div class="row">

					<div class="col-md-8">

						<h3><i class="fa fa-calculator"></i> Faktur Cabang</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right"></div>
				</div><!--/.row-->
        <form id="arrayInput">
        <div class="row">
          <div class="col-md-12">
            <h4>Kelapa Bulat A</h4>
          </div>
          <div class="col-md-12">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Relasi</th>
                  <th>Bruto</th>
                  <th>Potongan</th>
                  <th>Netto</th>
                  <th>Rupiah KB</th>
                  <th>TGB</th>
                  <th>Biaya</th>
                  <th>TTL Rupiah</th>
                  <th>@Rp/Kg</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="zone_data_a">
                <tr>
                  <td colspan="9">
                    <center>
                      <div class="loader"></div>
                    </center>
                  </td>
                </tr>
              </tbody>
              <tfoot id="total_a">
                <tr id="total_a_tr" class="warning">
                  <td colspan="2" class="text-center">Total</td>
                  <td id="td_total_bruto_a"></td>
                  <td id="td_total_potongan_a"></td>
                  <td id="td_total_netto_a"></td>
                  <td id="td_total_rupiah_a"></td>
                  <td id="td_total_tambang_a"></td>
                  <td id="td_total_biaya_a"></td>
                  <td id="td_total_seluruh_a"></td>
                  <td></td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4>Kelapa Bulat B</h4>
          </div>
          <div class="col-md-12">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Relasi</th>
                  <th>Bruto</th>
                  <th>Potongan</th>
                  <th>Netto</th>
                  <th>Rupiah KB</th>
                  <th>TGB</th>
                  <th>Biaya</th>
                  <th>TTL Rupiah</th>
                  <th>@Rp/Kg</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="zone_data_b">
                <tr>
                  <td colspan="9">
                    <center>
                      <div class="loader"></div>
                    </center>
                  </td>
                </tr>
              </tbody>
              <tfoot id="total_b">
                <tr id="total_b_tr" class="warning">
                  <td colspan="2" class="text-center">Total</td>
                  <td id="td_total_bruto_b"></td>
                  <td id="td_total_potongan_b"></td>
                  <td id="td_total_netto_b"></td>
                  <td id="td_total_rupiah_b"></td>
                  <td></td>
                  <td></td>
                  <td id="td_total_rupiah_b"></td>
                  <td></td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12">
            <h4>Kelapa Bulat C</h4>
          </div>
          <div class="col-md-12">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Relasi</th>
                  <th>Bruto</th>
                  <th>Potongan</th>
                  <th>Netto</th>
                  <th>Rupiah KB</th>
                  <th>TGB</th>
                  <th>Biaya</th>
                  <th>TTL Rupiah</th>
                  <th>@Rp/Kg</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="zone_data_c">
                <tr>
                  <td colspan="9">
                    <center>
                      <div class="loader"></div>
                    </center>
                  </td>
                </tr>
              </tbody>
              <tfoot id="total_c">
                <tr id="total_c_tr" class="warning">
                  <td colspan="2" class="text-center">Total</td>
                  <td id="td_total_bruto_c"></td>
                  <td id="td_total_potongan_c"></td>
                  <td id="td_total_netto_c"></td>
                  <td id="td_total_rupiah_c"></td>
                  <td></td>
                  <td></td>
                  <td id="td_total_rupiah_c"></td>
                  <td></td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <!-- <a class="btn btn-success simpanreview">Simpan</a> -->
      </form>
        <br>
        <br>
        <br>
        <div class="row">
          <div class="col-md-5">
            <table class="table table-bordered note">
              <tr id="note_tr_a">
                <td rowspan="3" align="center">QTY TERIMA PSK</td>
                <td>A</td>
                <td id="note_kg_a"></td>
                <td id="note_rp_kg_a"></td>
                <td id="note_rupiah_a"></td>
              </tr>
              <tr id="note_tr_b">
                <td>B</td>
                <td id="note_kg_b"></td>
                <td id="note_rp_kg_b"></td>
                <td id="note_rupiah_b"></td>
              </tr>
              <tr id="note_tr_c">
                <td>C</td>
                <td id="note_kg_c"></td>
                <td id="note_rp_kg_c"></td>
                <td id="note_rupiah_c"></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
function list_review_faktur_cabang_c()
{
  var id_faktur = "<?php echo $d3; ?>"
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=list_review_faktur_cabang_c&ID_FAKTUR=' + id_faktur,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        //$('.TEST').html(data.respon.text_msg)
        $("tbody#zone_data_c").empty();
        for (i = 0; i < data.result_c.length; i++) {
          $("tbody#zone_data_c").append("<tr class='detailLogId'>" +
					"<td >" + data.result_c[i].NO + ".<input type='hidden' name='id_detail[]' value='" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "' id='id_detail_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'><input type='hidden' name='jenis[]' value='C' id='jenis_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_c[i].RMP_REKAP_FC_DETAIL_NAMA  + " <input type='hidden' name='supplier_name[]' value='" + data.result_c[i].RMP_REKAP_FC_DETAIL_NAMA  + "' id='supplier_name_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_c[i].BRUTO_C_SUPPLIER  + "<input type='hidden' name='bruto[]' value='" + data.result_c[i].BRUTO_C_SUPPLIER  + "' id='bruto_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_c[i].RMP_REKAP_FC_DETAIL_POTONGAN  + "<input type='hidden' name='potongan[]' value='" + data.result_c[i].RMP_REKAP_FC_DETAIL_POTONGAN  + "' id='potongan_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_c[i].NETTO_C_SUPPLIER  + "<input type='hidden' name='netto[]' value='" + data.result_c[i].NETTO_C_SUPPLIER  + "' id='netto_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_c[i].RUPIAH_C  + "<input type='hidden' name='rupiah[]' value='" + data.result_c[i].RUPIAH_C  + "' id='rupiah_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td><input type='hidden' name='biaya[]' value='0' id='biaya_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td><input type='hidden' name='tambang[]' value='0' id='tambang_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_c[i].RUPIAH_C  + "<input type='hidden' name='ttl_rupiah[]' value='" + data.result_c[i].RUPIAH_C  + "' id='ttl_rupiah_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_c[i].RP_KG_C  + "<input type='hidden' name='rp_kg[]' value='" + data.result_c[i].RP_KG_C  + "' id='rp_kg_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
          "<td></td>" +
          "</tr>");
					}
          $("tfoot#total_c tr#total_c_tr td#td_total_bruto_c").html(data.total_bruto)
          $("tfoot#total_c tr#total_c_tr td#td_total_potongan_c").html(data.total_potongan)
          $("tfoot#total_c tr#total_c_tr td#td_total_netto_c").html(data.total_netto)
          $("tfoot#total_c tr#total_c_tr td#td_total_rupiah_c").html(data.total_rupiah)
      } else if (data.respon.pesan == "gagal") {
        //$("tbody#zone_data").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

$(function(){
list_review_faktur_cabang_c()
})


function list_review_faktur_cabang_b()
{
  var id_faktur = "<?php echo $d3; ?>"
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=list_review_faktur_cabang_b&ID_FAKTUR=' + id_faktur,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        //$('.TEST').html(data.respon.text_msg)
        $("tbody#zone_data_b").empty();
        for (i = 0; i < data.result_b.length; i++) {
          $("tbody#zone_data_b").append("<tr class='detailLogId'>" +
					"<td >" + data.result_b[i].NO + ".<input type='hidden' name='id_detail[]' value='" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "' id='id_detail_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'><input type='hidden' name='jenis[]' value='B' id='jenis_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_b[i].RMP_REKAP_FC_DETAIL_NAMA  + "<input type='hidden' name='supplier_name[]' value='" + data.result_b[i].RMP_REKAP_FC_DETAIL_NAMA  + "' id='supplier_name_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_b[i].BRUTO_B_SUPPLIER  + "<input type='hidden' name='bruto[]' value='" + data.result_b[i].BRUTO_B_SUPPLIER  + "' id='bruto_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_b[i].POTONGAN_B  + "<input type='hidden' name='potongan[]' value='" + data.result_b[i].POTONGAN_B  + "' id='potongan_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_b[i].NETTO_B_SUPPLIER  + "<input type='hidden' name='netto[]' value='" + data.result_b[i].NETTO_B_SUPPLIER  + "' id='netto_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_b[i].RUPIAH_B  + "<input type='hidden' name='rupiah[]' value='" + data.result_b[i].RUPIAH_B  + "' id='rupiah_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
          "<td><input type='hidden' name='biaya[]' value='0' id='biaya_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td><input type='hidden' name='tambang[]' value='0' id='tambang_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_b[i].RUPIAH_B  + "<input type='hidden' name='ttl_rupiah[]' value='" + data.result_b[i].RUPIAH_B  + "' id='ttl_rupiah_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_b[i].RP_KG_B  + "<input type='hidden' name='rp_kg[]' value='" + data.result_b[i].RP_KG_B  + "' id='rp_kg_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
          "<td></td>" +
          "</tr>");
					}

          $("tfoot#total_b tr#total_b_tr td#td_total_bruto_b").html(data.total_bruto)
          $("tfoot#total_b tr#total_b_tr td#td_total_potongan_b").html(data.total_potongan)
          $("tfoot#total_b tr#total_b_tr td#td_total_netto_b").html(data.total_netto)
          $("tfoot#total_b tr#total_b_tr td#td_total_rupiah_b").html(data.total_rupiah)


      } else if (data.respon.pesan == "gagal") {
        //$("tbody#zone_data").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

$(function(){
list_review_faktur_cabang_b()
})

function list_review_faktur_cabang_a()
{
  var id_faktur = "<?php echo $d3; ?>"
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=list_review_faktur_cabang_a&ID_FAKTUR=' + id_faktur,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        //$('.TEST').html(data.respon.text_msg)
        $("tbody#zone_data_a").empty();
        for (i = 0; i < data.result_a.length; i++) {
          $("tbody#zone_data_a").append("<tr class='detailLogId'>" +
					"<td >" + data.result_a[i].NO + ".<input type='hidden' name='id_detail[]' value='" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "' id='id_detail_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'><input type='hidden' name='jenis[]' value='A' id='jenis_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_DETAIL_NAMA  + "<input type='hidden' name='supplier_name[]' value='" + data.result_a[i].RMP_REKAP_FC_DETAIL_NAMA  + "' id='supplier_name_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_a[i].BRUTO_A_SUPPLIER  + "<input type='hidden' name='bruto[]' value='" + data.result_a[i].BRUTO_A_SUPPLIER  + "' id='bruto_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_a[i].POTONGAN_A  + "<input type='hidden' name='potongan[]' value='" + data.result_a[i].POTONGAN_A  + "' id='potongan_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_a[i].NETTO_A_SUPPLIER  + "<input type='hidden' name='netto[]' value='" + data.result_a[i].NETTO_A_SUPPLIER  + "' id='netto_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_a[i].RUPIAH_A  + "<input type='hidden' name='rupiah[]' value='" + data.result_a[i].RUPIAH_A  + "' id='rupiah_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_a[i].TAMBANG  + "<input type='hidden' name='tambang[]' value='" + data.result_a[i].TAMBANG  + "' id='tambang_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_a[i].BIAYA  + "<input type='hidden' name='biaya[]' value='" + data.result_a[i].BIAYA  + "' id='biaya_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_a[i].TOTAL_RUPIAH_A  + "<input type='hidden' name='ttl_rupiah[]' value='" + data.result_a[i].TOTAL_RUPIAH_A  + "' id='ttl_rupiah_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_a[i].RP_KG_A  + "<input type='hidden' name='rp_kg[]' value='" + data.result_a[i].RP_KG_A  + "' id='rp_kg_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
          "<td></td>" +
          "</tr>");
					}
          $("tfoot#total_a tr#total_a_tr td#td_total_bruto_a").html(data.total_bruto_a)
          $("tfoot#total_a tr#total_a_tr td#td_total_potongan_a").html(data.total_potongan_a)
          $("tfoot#total_a tr#total_a_tr td#td_total_netto_a").html(data.total_netto_a)
          $("tfoot#total_a tr#total_a_tr td#td_total_rupiah_a").html(data.total_rupiah_a)
          $("tfoot#total_a tr#total_a_tr td#td_total_tambang_a").html(data.total_tambang_a)
          $("tfoot#total_a tr#total_a_tr td#td_total_biaya_a").html(data.total_biaya_a)
          $("tfoot#total_a tr#total_a_tr td#td_total_seluruh_a").html(data.total_seluruh_a)

          $("tr#note_tr_a td#note_kg_a").html(data.note_kg_a)
          $("tr#note_tr_a td#note_rp_kg_a").html(data.note_rp_kg_a)
          $("tr#note_tr_a td#note_rupiah_a").html(data.note_rupiah_a)

          $("tr#note_tr_b td#note_kg_b").html(data.note_kg_b)
          $("tr#note_tr_b td#note_rp_kg_b").html(data.note_rp_kg_b)
          $("tr#note_tr_b td#note_rupiah_b").html(data.note_rupiah_b)

          $("tr#note_tr_c td#note_kg_c").html(data.note_kg_c)
          $("tr#note_tr_c td#note_rp_kg_c").html(data.note_rp_kg_c)
          $("tr#note_tr_c td#note_rupiah_c").html(data.note_rupiah_c)

      } else if (data.respon.pesan == "gagal")
      {

      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

$(function(){
list_review_faktur_cabang_a()
})

$('.simpanreview').on('click',function(){
  var arrayInput = $('#arrayInput').serialize();
  $(this).attr("disabled", true);
  $(this).html('Loading...');
  var id_rekap_faktur_cabang = "<?php echo $d3; ?>"
  console.log(arrayInput)
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=simpanreview&' + arrayInput + '&id_rekap_faktur_cabang=' + id_rekap_faktur_cabang,
    success: function(data)
    {
      if (data.respon.pesan == "sukses")
      {
        console.log(data.respon.text_msg);
        //alert (data.respon.text_msg);
        $('.simpanreview').html('Simpan');
      }
      else if (data.respon.pesan == "gagal")
      {
        console.log(data.respon.text_msg);
        alert("Gagal Menyimpan");
      }
    }, //end success
    error: function(x, e)
    {
      console.log("Error Ajax");
    } //end error
  });

})
</script>
