<?php
  $RMP_CONFIG=new RMP_CONFIG();
  $SISTEM_CONFIG=new SISTEM_CONFIG();
?>

 <style>
 .table-small
 {
 	font-size: 12px;
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
   0% { -webkit-transform: rotate(0deg); }
   100% { -webkit-transform: rotate(360deg); }
 }

 @keyframes spin
 {
   0% { transform: rotate(0deg); }
   100% { transform: rotate(360deg); }
 }

 /* table{
 font-size: 12px;
 }
 table-detail{
 font-size: 9px;
 } */

 .modalMD
 {
   width:1000px;
 }



 </style>
 <div class="row">
 	<div class="col-lg-12 col-md-12">
 		<div class="list-group">


      <div class="box box-solid form_faktur">
        <div class="box-body">
      <div class="row">

      	<div class="col-md-12">
          <form id="faktur_detail">
      		<div class="row">

            <div class="form_faktur_cabang" >
            <div class="col-md-3">
            <div class="form-group" >
              <label for="exampleInputEmail1">ID Faktur Cabang</label> <select class="ID_FAKTUR_CABANG selectpicker with-ajax-personal form-control" data-live-search="true" id="ID_FAKTUR_CABANG" name="ID_FAKTUR_CABANG" onchange="id_faktur_cabang()">
              </select>
              <p class="help-block">Pilih ID Faktur Cabang Purchaser.</p>
            </div>
            </div>
            <div class="col-md-3">
            <div class="form-group" >
              <label for="exampleInputEmail1">PS Cabang</label><input autocomplete="off" class="form-control PS_CABANG" id="PS_CABANG" name="PS_CABANG" placeholder="PS_CABANG" type="text" readonly>
              <p class="help-block">Pilih ID Faktur Cabang Purchaser.</p>
            </div>
            </div>
            <div class="col-md-3">
              <div class="form-group" >
                <label for="exampleInputEmail1">Tanggal</label><input autocomplete="off" class="form-control TANGGAL_REKAP_FAKTUR_CABANG" id="TANGGAL_REKAP_FAKTUR_CABANG" name="TANGGAL_REKAP_FAKTUR_CABANG" placeholder="TANGGAL_REKAP_FAKTUR_CABANG" type="text" readonly>
                <p class="help-block">Tanggal rekap faktur cabang.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group" >
                <label for="exampleInputEmail1">Alamat</label><input autocomplete="off" class="form-control ALAMAT_FAKTUR_CABANG" id="ALAMAT_FAKTUR_CABANG" name="ALAMAT_FAKTUR_CABANG" type="text" >
                <p class="help-block">Alamat Cabang.</p>
              </div>
            </div>
            </div>
      		</div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="exampleInputEmail1">Tanggal</label>
                <input autocomplete="off" class="form-control TANGGAL_FAKTUR datepicker" id="TANGGAL_FAKTUR" name="TANGGAL_FAKTUR" placeholder="" type="text" value="<?php echo date("Y/m/d"); ?>">
                <p class="help-block">Tanggal faktur.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="exampleInputEmail1">Operator Timbang</label><select class="OPERATOR_TIMBANG with-ajax-personal form-control" data-live-search="true" id="OPERATOR_TIMBANG" name="OPERATOR_TIMBANG" onchange="sel_operator_timbang()">
                </select>
                <p class="help-block">Nama Operator Timbang.</p>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="exampleInputEmail1">Inspektur Mutu</label><select class="INSPEKTUR_MUTU with-ajax-personal form-control" data-live-search="true" id="INSPEKTUR_MUTU" name="INSPEKTUR_MUTU" onchange="sel_inspektur_mutu()">
                </select>
                <p class="help-block">Nama Inspektur Mutu.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="exampleInputEmail1">Potongan</label> <input autocomplete="off" class="form-control POTONGAN" id="POTONGAN" name="POTONGAN" placeholder="POTONGAN" value="0" type="number">
                <p class="help-block">Gunakan "." untuk bilangan desimal</p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2">
              <!-- <input type="checkbox" name="CEK_DITERIMA"> Bisa Diterima
              <input type="checkbox" name="CEK_100_INSPEKSI"> 100 % Inspeksi
              <input type="checkbox" name="CEK_DIPISAH"> Dipisah -->
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="CEK_DITERIMA" class="CEK_DITERIMA"> Bisa Diterima
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="CEK_100_INSPEKSI" class="CEK_100_INSPEKSI"> 100 % Inspeksi
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="CEK_DIPISAH" class="CEK_DIPISAH"> Dipisah
                </label>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="exampleInputEmail1">Catatan Purchaser</label>
                <textarea class="CATATAN_PURCHASER form-control" id="CATATAN_PURCHASER" rows="3" name="CATATAN_PURCHASER"></textarea>
                <p class="help-block">Catatan untuk Purchaser.</p>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="exampleInputEmail1">Catatan Supplier</label>
                <textarea class="CATATAN_SUPPLIER form-control" id="CATATAN_SUPPLIER" rows="3" name="CATATAN_SUPPLIER"></textarea>
                <p class="help-block">Catatan untuk Supplier.</p>
              </div>
            </div>
          </div>
        </form>
      	</div>
      </div>
      </div>
      </div>
      <div class="row form_faktur_cabang">
        <div class="col-md-12">
      		<div class="box box-solid">
      			<div class="box-body">
      				<div class="box box-default">
      					<div class="box-header with-border">
      						<h3 class="box-title">Faktur Cabang</h3>
      					</div>
      					<div class="box-body">
                  <form id="arrayInput">
                  <div class="row">
                    <div class="col-md-12">
                      <h4>Kelapa A</h4>
                    </div>
                    <div class="col-md-12">
                      <table class="table table-hover table-bordered">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Nama Relasi</th>
                            <th>Bruto</th>
                            <th>Potongan</th>
                            <th>Netto</th>
                            <!-- <th>Rupiah KB</th>
                            <th>TGB</th>
                            <th>Biaya</th>
                            <th>TTL Rupiah</th>
                            <th>@Rp/Kg</th>
                            <th></th> -->
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
                            <td id="td_total_broto_a"></td>
                            <td id="td_total_potongan_a"></td>
                            <td id="td_total_netto_a"></td>
                            <td></td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h4>Kelapa B</h4>
                    </div>
                    <div class="col-md-12">
                      <table class="table table-hover table-bordered">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Nama Relasi</th>
                            <th>Bruto</th>
                            <th>Potongan</th>
                            <th>Netto</th>
                            <!-- <th>Rupiah KB</th>
                            <th>TGB</th>
                            <th>Biaya</th>
                            <th>TTL Rupiah</th>
                            <th>@Rp/Kg</th>
                            <th></th> -->
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
                            <td id="td_total_broto_b"></td>
                            <td id="td_total_potongan_b"></td>
                            <td id="td_total_netto_b"></td>
                            <td></td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-12">
                      <h4>Kelapa C</h4>
                    </div>
                    <div class="col-md-12">
                      <table class="table table-hover table-bordered">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Nama Relasi</th>
                            <th>Bruto</th>
                            <th>Potongan</th>
                            <th>Netto</th>
                            <!-- <th>Rupiah KB</th>
                            <th>TGB</th>
                            <th>Biaya</th>
                            <th>TTL Rupiah</th>
                            <th>@Rp/Kg</th>
                            <th></th> -->
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
                            <td id="td_total_broto_c"></td>
                            <td id="td_total_potongan_c"></td>
                            <td id="td_total_netto_c"></td>
                            <td></td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  <a class="btn btn-success simpanreview"><i class="fa fa-spinner fa-spin loading_simpan_faktur_cabang" style="display:none;"></i> Simpan</a>
                </form>
      					</div>
      				</div>
      			</div>
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


$(function()
{
	$(".datepicker").datepicker().on('changeDate', function(ev)
  {
		$('.datepicker').datepicker('hide');
	});
});

$(function(){
  sel_operator_timbang();
  sel_inspektur_mutu();
})

function sel_operator_timbang()
{
  var options =
  {
    ajax: {
      url: refseeAPI,
      type: 'POST',
      dataType: 'json',
      data: {
        q: '{{{q}}}',
        ref: 'sel_operator_timbang',
      }
    },
    locale:
    {
      emptyTitle: 'Pilih Nama'
    },
    log: 3,
    preprocessData: function(data)
    {
      var i, l = data.result.length,
        array = [];
      if (l)
      {
        for (i = 0; i < l; i++)
        {
          array.push($.extend(true, data.result[i],
          {
            // text: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
            // value: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
            text: data.result[i].RMP_KONFIGURASI_PETUGAS_NAMA,
            value: data.result[i].RMP_KONFIGURASI_PETUGAS_NIK,
            data:
            {
              subtext: ''
            }
          }));
        }
      }
      else
      {
      }$(function() {
  sel_nama_supplier();
});
      return array;
    }
  };
  $('.OPERATOR_TIMBANG').selectpicker().filter('.with-ajax-personal').ajaxSelectPicker(options);
}

function sel_inspektur_mutu()
{
  var options =
  {
    ajax: {
      url: refseeAPI,
      type: 'POST',
      dataType: 'json',
      data: {
        q: '{{{q}}}',
        ref: 'sel_inspektur_mutu',
      }
    },
    locale:
    {
      emptyTitle: 'Pilih Nama'
    },
    log: 3,
    preprocessData: function(data)
    {
      var i, l = data.result.length,
        array = [];
      if (l)
      {
        for (i = 0; i < l; i++)
        {
          array.push($.extend(true, data.result[i],
          {
            // text: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
            // value: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
            text: data.result[i].RMP_KONFIGURASI_PETUGAS_NAMA,
            value: data.result[i].RMP_KONFIGURASI_PETUGAS_NIK,
            data:
            {
              subtext: ''
            }
          }));
        }
      }
      else
      {
      }$(function() {
  sel_nama_supplier();
});
      return array;
    }
  };
  $('.INSPEKTUR_MUTU').selectpicker().filter('.with-ajax-personal').ajaxSelectPicker(options);
}



function list_review_faktur_cabang_c()
{
  var id_faktur = $(".ID_FAKTUR_CABANG").val()
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
					"<td><input type='hidden' name='rupiah[]' value='" + data.result_c[i].RUPIAH_C  + "' id='rupiah_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'>" +
					"<input type='hidden' name='biaya[]' value='0' id='biaya_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'>" +
					"<input type='hidden' name='tambang[]' value='0' id='tambang_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'>" +
					"<input type='hidden' name='ttl_rupiah[]' value='" + data.result_c[i].RUPIAH_C  + "' id='ttl_rupiah_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'>" +
					"<input type='hidden' name='rp_kg[]' value='" + data.result_c[i].RP_KG_C  + "' id='rp_kg_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'>" +
          "</td>" +
          "</tr>");
					}
          $("tfoot#total_c tr#total_c_tr td#td_total_bruto_c").html(data.total_bruto)
          $("tfoot#total_c tr#total_c_tr td#td_total_potongan_c").html(data.total_potongan)
          $("tfoot#total_c tr#total_c_tr td#td_total_netto_c").html(data.total_netto)
          // $("tfoot#total_c tr#total_c_tr td#td_total_rupiah_c").html(data.total_rupiah)
      } else if (data.respon.pesan == "gagal") {
        //$("tbody#zone_data").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

// $(function(){
// list_review_faktur_cabang_c()
// })


function list_review_faktur_cabang_b()
{
  var id_faktur = $(".ID_FAKTUR_CABANG").val()
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
					"<td>" + data.result_b[i].RMP_REKAP_FC_DETAIL_POTONGAN  + "<input type='hidden' name='potongan[]' value='" + data.result_b[i].RMP_REKAP_FC_DETAIL_POTONGAN  + "' id='potongan_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_b[i].NETTO_B_SUPPLIER  + "<input type='hidden' name='netto[]' value='" + data.result_b[i].NETTO_B_SUPPLIER  + "' id='netto_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td><input type='hidden' name='rupiah[]' value='" + data.result_b[i].RUPIAH_B  + "' id='rupiah_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
          "<input type='hidden' name='biaya[]' value='0' id='biaya_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'>" +
					"<input type='hidden' name='tambang[]' value='0' id='tambang_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'>" +
					"<input type='hidden' name='ttl_rupiah[]' value='" + data.result_b[i].RUPIAH_B  + "' id='ttl_rupiah_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'>" +
					"<input type='hidden' name='rp_kg[]' value='" + data.result_b[i].RP_KG_B  + "' id='rp_kg_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'>" +
          "</td>" +
          "</tr>");
					}

          $("tfoot#total_b tr#total_b_tr td#td_total_bruto_b").html(data.total_bruto)
          $("tfoot#total_b tr#total_b_tr td#td_total_potongan_b").html(data.total_potongan)
          $("tfoot#total_b tr#total_b_tr td#td_total_netto_b").html(data.total_netto)
          // $("tfoot#total_b tr#total_b_tr td#td_total_rupiah_b").html(data.total_rupiah)


      } else if (data.respon.pesan == "gagal") {
        //$("tbody#zone_data").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

// $(function(){
// list_review_faktur_cabang_b()
// })

function list_review_faktur_cabang_a()
{
  var id_faktur = $(".ID_FAKTUR_CABANG").val()
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
					"<td>" + data.result_a[i].RMP_REKAP_FC_DETAIL_POTONGAN  + "<input type='hidden' name='potongan[]' value='" + data.result_a[i].RMP_REKAP_FC_DETAIL_POTONGAN  + "' id='potongan_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td>" + data.result_a[i].NETTO_A_SUPPLIER  + "<input type='hidden' name='netto[]' value='" + data.result_a[i].NETTO_A_SUPPLIER  + "' id='netto_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
					"<td><input type='hidden' name='rupiah[]' value='" + data.result_a[i].RUPIAH_A  + "' id='rupiah_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'>" +
					"<input type='hidden' name='tambang[]' value='" + data.result_a[i].TAMBANG  + "' id='tambang_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'>" +
					"<input type='hidden' name='biaya[]' value='" + data.result_a[i].BIAYA  + "' id='biaya_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'>" +
					"<input type='hidden' name='ttl_rupiah[]' value='" + data.result_a[i].TOTAL_RUPIAH_A  + "' id='ttl_rupiah_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'>" +
					"<input type='hidden' name='rp_kg[]' value='" + data.result_a[i].RP_KG_A  + "' id='rp_kg_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'>" +
          "</td>" +
          "</tr>");
					}
          $("tfoot#total_a tr#total_a_tr td#td_total_bruto_a").html(data.total_bruto_a)
          $("tfoot#total_a tr#total_a_tr td#td_total_potongan_a").html(data.total_potongan_a)
          $("tfoot#total_a tr#total_a_tr td#td_total_netto_a").html(data.total_netto_a)
          // $("tfoot#total_a tr#total_a_tr td#td_total_rupiah_a").html(data.total_rupiah_a)
          // $("tfoot#total_a tr#total_a_tr td#td_total_tambang_a").html(data.total_tambang_a)
          // $("tfoot#total_a tr#total_a_tr td#td_total_biaya_a").html(data.total_biaya_a)
          // $("tfoot#total_a tr#total_a_tr td#td_total_seluruh_a").html(data.total_seluruh_a)

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

// $(function(){
// list_review_faktur_cabang_a()
// })

var options =
{
  ajax: {
    url: refseeAPI,
    type: 'POST',
    dataType: 'json',
    data: {
      q: '{{{q}}}',
      ref: 'sel_id_faktur_cabang',
    }
  },
  locale:
  {
    emptyTitle: 'Pilih Nama'
  },
  log: 3,
  preprocessData: function(data)
  {
    var i, l = data.result.length,
      array = [];
    if (l)
    {
      for (i = 0; i < l; i++)
      {
        array.push($.extend(true, data.result[i],
        {
          // text: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
          // value: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
          text: data.result[i].RMP_MASTER_PERSONAL_NAMA,
          value: data.result[i].RMP_REKAP_FC_ID,
          data:
          {
            subtext: data.result[i].TANGGAL_REKAP,
            cabang: data.result[i].RMP_MASTER_PERSONAL_NAMA,
            tanggal: data.result[i].TANGGAL_REKAP,
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
$('.ID_FAKTUR_CABANG').selectpicker().filter('.with-ajax-personal').ajaxSelectPicker(options);
$('select.ID_FAKTUR_CABANG').on('change', function(){
  var cabang = $('.ID_FAKTUR_CABANG option:selected').data('cabang');
	$('input.PS_CABANG').val(cabang);
  var tanggal = $('.ID_FAKTUR_CABANG option:selected').data('tanggal');
	$('input.TANGGAL_REKAP_FAKTUR_CABANG').val(tanggal);
})

function id_faktur_cabang() {
  list_review_faktur_cabang_a()
  list_review_faktur_cabang_b()
  list_review_faktur_cabang_c()
}

$('.simpanreview').on('click',function(){
  if($('.POTONGAN').val() != '0')
  {
    alert("Potongan Harus Diisi 0")
  }
  else if($('.OPERATOR_TIMBANG').val() == null)
  {
    alert("Pilih Nama Operator Timbang")
  }
  else if($('.INSPEKTUR_MUTU').val() == null)
  {
    alert("Pilih Nama Inspektur Mutu")
  }
  else if($('.CATATAN_PURCHASER').val() == '')
  {
    alert("Catatan Harus Diisi")
  }
  else if($('.CATATAN_SUPPLIER').val() == '')
  {
    alert("Catatan Harus Diisi")
  }
  else
  {
  $('.loading_simpan_faktur_cabang').removeAttr('style');
  var form_detail = $('#faktur_detail').serialize()
  var arrayInput = $('#arrayInput').serialize();
  var data = form_detail + "&" + arrayInput;
  $(this).attr("disabled", true);
  $(this).html('Loading...');
  //console.log(data)
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=simpanreview&' + data,
    success: function(data)
    {
      if (data.respon.pesan == "sukses")
      {
        //console.log(data.respon.text_msg);
        //alert (data.respon.text_msg);
        $('.loading_simpan_faktur_cabang').attr('style','display:none;');
        $('.simpanreview').html('Simpan');
      }
      else if (data.respon.pesan == "gagal")
      {
        //console.log(data.respon.text_msg);
        alert("Gagal Menyimpan");
      }
    }, //end success
    error: function(x, e)
    {
      console.log("Error Ajax");
    } //end error
  });
}
})



</script>
