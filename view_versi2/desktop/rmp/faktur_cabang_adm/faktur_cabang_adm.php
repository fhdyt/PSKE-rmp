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

 .modalFakturList
 {
   width:1100px;
 }



 </style>
 <div class="row">
 	<div class="col-lg-12 col-md-12">
 		<div class="list-group">
      <div class="box box-solid form_faktur">
        <div class="box-body">
      <div class="row">

      	<div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <a class="btn btn-warning lihat_faktur btn-sm" type="button"><i class="fa fa-list-ol" aria-hidden="true"></i> Faktur</a>
              <a class="btn btn-success buat_faktur_baru btn-sm" type="button" style="display:none;" href="?show=rmp/faktur"><i class="fa fa-plus" aria-hidden="true"></i> Buat Faktur Baru</a>
              <a class="btn btn-default cetak_faktur btn-sm" type="button" style="display:none;"><i class="fa fa-print" aria-hidden="true"></i> Cetak Faktur</a>
            </div>
          </div>
          <br>
          <form id="faktur_detail">
      		<div class="row">

            <div class="form_faktur_cabang" >
            <div class="col-md-3">
            <div class="form-group" >
              <label for="exampleInputEmail1">Faktur Cabang</label> <select class="ID_FAKTUR_CABANG selectpicker with-ajax-personal form-control" data-live-search="true" id="ID_FAKTUR_CABANG" name="ID_FAKTUR_CABANG" onchange="id_faktur_cabang()">
              </select>
              <p class="help-block">Pilih Faktur Cabang.</p>
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
                <label for="exampleInputEmail1">ID Faktur Cabang</label><input autocomplete="off" class="form-control ID_ID_FAKTUR_CABANG" id="ID_ID_FAKTUR_CABANG" name="ID_ID_FAKTUR_CABANG" type="text" readonly>
                <p class="help-block">Pastikan ID Sesuai dengan RMPc.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group" >
                <label for="exampleInputEmail1">Tanggal</label><input autocomplete="off" class="form-control TANGGAL_REKAP_FAKTUR_CABANG" id="TANGGAL_REKAP_FAKTUR_CABANG" name="TANGGAL_REKAP_FAKTUR_CABANG" placeholder="TANGGAL_REKAP_FAKTUR_CABANG" type="text" readonly>
                <p class="help-block">Tanggal rekap faktur cabang.</p>
              </div>
            </div>
            </div>
      		</div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group" >
                <label for="exampleInputEmail1">Alamat</label><input autocomplete="off" class="form-control ALAMAT_FAKTUR_CABANG" id="ALAMAT_FAKTUR_CABANG" name="ALAMAT_FAKTUR_CABANG" type="text" >
                <p class="help-block">Alamat Cabang.</p>
              </div>
            </div>
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
            <input autocomplete="off" class="form-control POTONGAN" id="POTONGAN" name="POTONGAN" placeholder="POTONGAN" value="0" type="hidden">
            <!-- <div class="col-md-3">
              <div class="form-group">
                <label for="exampleInputEmail1">Potongan</label>
                <p class="help-block">Gunakan "." untuk bilangan desimal</p>
              </div>
            </div> -->
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
                            <th>No. Faktur</th>
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
                            <td colspan="3" class="text-center">Total</td>
                            <td id="td_total_bruto_a"></td>
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
                            <th>No. Faktur</th>
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
                            <td colspan="3" class="text-center">Total</td>
                            <td id="td_total_bruto_b"></td>
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
                            <th>No. Faktur</th>
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
                            <td colspan="3" class="text-center">Total</td>
                            <td id="td_total_bruto_c"></td>
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



 <div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalLihatFaktur" role="dialog" tabindex="-1">
 	<div class="modal-dialog modalFakturList" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
 				<h4 class="modal-title" id="myModalLabel">Faktur</h4>
 			</div>
 			<div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <div class="small-box bg-aqua">
              <div class="inner">
                <p class="TOTAL_KELAPA_A" style="font-size:40px">0</p>
                <p>Kelapa A</p>
              </div>
              <div class="icon">
                <i>A</i>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="small-box bg-green">
              <div class="inner">
                <p class="TOTAL_KELAPA_B" style="font-size:40px">0</p>
                <p>Kelapa B</p>
              </div>
              <div class="icon">
                <i>B</i>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="small-box bg-yellow">
              <div class="inner">
                <p class="TOTAL_KELAPA_C" style="font-size:40px">0</p>
                <p>Kelapa C</p>
              </div>
              <div class="icon">
                <i>C</i>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-right">
            <form id="form_filter" class="form-inline" method="POST" action="javascript:filter();">
              <div class="form-group">
            <select id="FILTER_MATERIAL" name="FILTER_MATERIAL" type="text" class=" form-control FILTER_MATERIAL"  autocomplete="off" onchange="filter_tanggal_list()">
            <option value="ITD">--Pilih Material--</option>
            <option value="JAMBUL">JAMBUL</option>
            <option value="GELONDONG">GELONDONG</option>
            <option value="LICIN">LICIN</option>
                  </select>
                </div>
					<div class="form-group">
              <input type="date" id="FILTER_TANGGAL_LIST" class="form-control FILTER_TANGGAL_LIST" name="FILTER_TANGGAL" onchange="filter_tanggal_list()" value="<?php echo date("Y-m-d"); ?>"/>
          </div>
        </form>
          </div>
				</div>
        <br>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>No. Faktur</th>
              <th>No. Nota</th>
              <th>Nama</th>
              <th>Kelapa</th>
              <th>Bruto</th>
              <th>Potongan</th>
              <th>Netto</th>
              <th>Tanggal</th>
              <th></th>

            </tr>
          </thead>
          <tbody id="zone_lihat_faktur">
            <tr>
              <td colspan="9">
                <center>
                  <div class="loader"></div>
                </center>
              </td>
            </tr>
          </tbody>
        </table>
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
    data: 'ref=list_faktur_cabang_c&ID_FAKTUR=' + id_faktur,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        //$('.TEST').html(data.respon.text_msg)
        $("tbody#zone_data_c").empty();
        for (i = 0; i < data.result_c.length; i++) {
          $("tbody#zone_data_c").append("<tr class='detailLogId'>" +
					"<td >" + data.result_c[i].NO + ".<input type='hidden' name='id_detail[]' value='" + data.result_c[i].RMP_REKAP_FC_PROSES_ID  + "' id='id_detail_" + data.result_c[i].RMP_REKAP_FC_PROSES_ID  + "'><input type='hidden' name='jenis[]' value='C' id='jenis_" + data.result_c[i].RMP_REKAP_FC_PROSES_ID  + "'></td>" +
					"<td><input type='text' name='no_faktur[]' id='no_faktur_" + data.result_c[i].RMP_REKAP_FC_PROSES_ID  + "' class='form-control' autocomplete='off'></td>" +
					"<td>" + data.result_c[i].RMP_REKAP_FC_PROSES_NAMA  + "<input type='hidden' name='supplier_name[]' value='" + data.result_c[i].RMP_REKAP_FC_PROSES_NAMA  + "' id='supplier_name_" + data.result_c[i].RMP_REKAP_FC_PROSES_ID  + "'></td>" +
					"<td>" + data.result_c[i].RMP_REKAP_FC_PROSES_BRUTO  + "<input type='hidden' name='bruto[]' value='" + data.result_c[i].RMP_REKAP_FC_PROSES_BRUTO  + "' id='bruto_" + data.result_c[i].RMP_REKAP_FC_PROSES_ID  + "'></td>" +
					"<td>" + data.result_c[i].RMP_REKAP_FC_PROSES_POTONGAN  + "<input type='hidden' name='potongan[]' value='" + data.result_c[i].RMP_REKAP_FC_PROSES_POTONGAN  + "' id='potongan_" + data.result_c[i].RMP_REKAP_FC_PROSES_ID  + "'></td>" +
					"<td>" + data.result_c[i].RMP_REKAP_FC_PROSES_NETTO  + "<input type='hidden' name='netto[]' value='" + data.result_c[i].RMP_REKAP_FC_PROSES_NETTO  + "' id='netto_" + data.result_c[i].RMP_REKAP_FC_PROSES_ID  + "'></td>" +
					"<td><input type='hidden' name='rupiah[]' value='" + data.result_c[i].RMP_REKAP_FC_PROSES_RUPIAH_KB  + "' id='rupiah_" + data.result_c[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
					"<input type='hidden' name='tambang[]' value='" + data.result_c[i].RMP_REKAP_FC_PROSES_TAMBANG  + "' id='tambang_" + data.result_c[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
					"<input type='hidden' name='biaya[]' value='" + data.result_c[i].RMP_REKAP_FC_PROSES_BIAYA  + "' id='biaya_" + data.result_c[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
					"<input type='hidden' name='ttl_rupiah[]' value='" + data.result_c[i].RMP_REKAP_FC_PROSES_RUPIAH_TOTAL  + "' id='ttl_rupiah_" + data.result_c[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
					"<input type='hidden' name='rp_kg[]' value='" + data.result_c[i].RMP_REKAP_FC_PROSES_RP_KG  + "' id='rp_kg_" + data.result_c[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
          "</td>" +
          "</tr>");
					}
          $("tfoot#total_c tr#total_c_tr td#td_total_bruto_c").html(data.total_bruto_c)
          $("tfoot#total_c tr#total_c_tr td#td_total_potongan_c").html(data.total_potongan_c)
          $("tfoot#total_c tr#total_c_tr td#td_total_netto_c").html(data.total_netto_c)
          // $("tfoot#total_c tr#total_c_tr td#td_total_rupiah_c").html(data.total_rupiah)
      } else if (data.respon.pesan == "gagal") {
        $("tbody#zone_data_c").empty();
        $("tbody#zone_data_c").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Data Tidak Ada</div></td></tr>");
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
    data: 'ref=list_faktur_cabang_b&ID_FAKTUR=' + id_faktur,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        //$('.TEST').html(data.respon.text_msg)
        $("tbody#zone_data_b").empty();
        for (i = 0; i < data.result_b.length; i++) {
          $("tbody#zone_data_b").append("<tr class='detailLogId'>" +
					"<td >" + data.result_b[i].NO + ".<input type='hidden' name='id_detail[]' value='" + data.result_b[i].RMP_REKAP_FC_PROSES_ID  + "' id='id_detail_" + data.result_b[i].RMP_REKAP_FC_PROSES_ID  + "'><input type='hidden' name='jenis[]' value='B' id='jenis_" + data.result_b[i].RMP_REKAP_FC_PROSES_ID  + "'></td>" +
          "<td><input type='text' name='no_faktur[]' id='no_faktur_" + data.result_b[i].RMP_REKAP_FC_PROSES_ID  + "' class='form-control' autocomplete='off'></td>" +
          "<td>" + data.result_b[i].RMP_REKAP_FC_PROSES_NAMA  + "<input type='hidden' name='supplier_name[]' value='" + data.result_b[i].RMP_REKAP_FC_PROSES_NAMA  + "' id='supplier_name_" + data.result_b[i].RMP_REKAP_FC_PROSES_ID  + "'></td>" +
					"<td>" + data.result_b[i].RMP_REKAP_FC_PROSES_BRUTO  + "<input type='hidden' name='bruto[]' value='" + data.result_b[i].RMP_REKAP_FC_PROSES_BRUTO  + "' id='bruto_" + data.result_b[i].RMP_REKAP_FC_PROSES_ID  + "'></td>" +
					"<td>" + data.result_b[i].RMP_REKAP_FC_PROSES_POTONGAN  + "<input type='hidden' name='potongan[]' value='" + data.result_b[i].RMP_REKAP_FC_PROSES_POTONGAN  + "' id='potongan_" + data.result_b[i].RMP_REKAP_FC_PROSES_ID  + "'></td>" +
					"<td>" + data.result_b[i].RMP_REKAP_FC_PROSES_NETTO  + "<input type='hidden' name='netto[]' value='" + data.result_b[i].RMP_REKAP_FC_PROSES_NETTO  + "' id='netto_" + data.result_b[i].RMP_REKAP_FC_PROSES_ID  + "'></td>" +
					"<td><input type='hidden' name='rupiah[]' value='" + data.result_b[i].RMP_REKAP_FC_PROSES_RUPIAH_KB  + "' id='rupiah_" + data.result_b[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
					"<input type='hidden' name='tambang[]' value='" + data.result_b[i].RMP_REKAP_FC_PROSES_TAMBANG  + "' id='tambang_" + data.result_b[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
					"<input type='hidden' name='biaya[]' value='" + data.result_b[i].RMP_REKAP_FC_PROSES_BIAYA  + "' id='biaya_" + data.result_b[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
					"<input type='hidden' name='ttl_rupiah[]' value='" + data.result_b[i].RMP_REKAP_FC_PROSES_RUPIAH_TOTAL  + "' id='ttl_rupiah_" + data.result_b[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
					"<input type='hidden' name='rp_kg[]' value='" + data.result_b[i].RMP_REKAP_FC_PROSES_RP_KG  + "' id='rp_kg_" + data.result_b[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
          "</td>" +
          "</tr>");
					}
          $("tfoot#total_b tr#total_b_tr td#td_total_bruto_b").html(data.total_bruto_b)
          $("tfoot#total_b tr#total_b_tr td#td_total_potongan_b").html(data.total_potongan_b)
          $("tfoot#total_b tr#total_b_tr td#td_total_netto_b").html(data.total_netto_b)


      } else if (data.respon.pesan == "gagal") {
        $("tbody#zone_data_b").empty();
        $("tbody#zone_data_b").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Data Tidak Ada</div></td></tr>");
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
    data: 'ref=list_faktur_cabang_a&ID_FAKTUR=' + id_faktur,
    success: function(data) {
      if (data.respon.pesan == "sukses") {

        $("tbody#zone_data_a").empty();
        for (i = 0; i < data.result_a.length; i++) {
          $("tbody#zone_data_a").append("<tr class='detailLogId'>" +
					"<td >" + data.result_a[i].NO + ".<input type='hidden' name='id_detail[]' value='" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "' id='id_detail_" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'><input type='hidden' name='jenis[]' value='A' id='jenis_" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'></td>" +
          "<td><input type='text' name='no_faktur[]' id='no_faktur_" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "' class='form-control' autocomplete='off'></td>" +
          "<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_NAMA  + "<input type='hidden' name='supplier_name[]' value='" + data.result_a[i].RMP_REKAP_FC_PROSES_NAMA  + "' id='supplier_name_" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'></td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_BRUTO  + "<input type='hidden' name='bruto[]' value='" + data.result_a[i].RMP_REKAP_FC_PROSES_BRUTO  + "' id='bruto_" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'></td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_POTONGAN  + "<input type='hidden' name='potongan[]' value='" + data.result_a[i].RMP_REKAP_FC_PROSES_POTONGAN  + "' id='potongan_" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'></td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_NETTO  + "<input type='hidden' name='netto[]' value='" + data.result_a[i].RMP_REKAP_FC_PROSES_NETTO  + "' id='netto_" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'></td>" +
					"<td><input type='hidden' name='rupiah[]' value='" + data.result_a[i].RMP_REKAP_FC_PROSES_RUPIAH_KB  + "' id='rupiah_" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
					"<input type='hidden' name='tambang[]' value='" + data.result_a[i].RMP_REKAP_FC_PROSES_TAMBANG  + "' id='tambang_" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
					"<input type='hidden' name='biaya[]' value='" + data.result_a[i].RMP_REKAP_FC_PROSES_BIAYA  + "' id='biaya_" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
					"<input type='hidden' name='ttl_rupiah[]' value='" + data.result_a[i].RMP_REKAP_FC_PROSES_RUPIAH_TOTAL  + "' id='ttl_rupiah_" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
					"<input type='hidden' name='rp_kg[]' value='" + data.result_a[i].RMP_REKAP_FC_PROSES_RP_KG  + "' id='rp_kg_" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
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
        $("tbody#zone_data_a").empty();
        $("tbody#zone_data_a").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Data Tidak Ada</div></td></tr>");
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
            id: data.result[i].RMP_REKAP_FC_ID,
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
  var id = $('.ID_FAKTUR_CABANG option:selected').data('id');
	$('input.ID_ID_FAKTUR_CABANG').val(id);
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
        alert("Berhasil Disimpan")
        location.reload()
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


$('.lihat_faktur').on('click', function()
{
	$(".modalLihatFaktur").modal('show');
  lihat_faktur()
});

function filter_tanggal_list(){
  $("tbody#zone_lihat_faktur").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  lihat_faktur()
}

function lihat_faktur()
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=lihat_faktur&TANGGAL='+$(".FILTER_TANGGAL_LIST").val()+'&FILTER_MATERIAL='+$(".FILTER_MATERIAL").val()+'',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				//console.log(data.respon.text_msg);
        $("tbody#zone_lihat_faktur").empty();
        $("p.TOTAL_KELAPA_A").html("0")
        $("p.TOTAL_KELAPA_B").html("0")
        $("p.TOTAL_KELAPA_C").html("0")
        for (i = 0; i < data.result.length; i++) {

          if (data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "JAMBUL-A" || data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "GELONDONG-A" || data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "LICIN-A")
          {
            var kelapa =  $("p.TOTAL_KELAPA_A").text()
            //console.log(kelapa_a)
            var total_kelapa = parseInt(kelapa) + parseInt(data.result[i].NETTO)
            //console.log(data.result[i].NETTO)
            $("p.TOTAL_KELAPA_A").html(total_kelapa+" Kg")
          }

          else if (data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "JAMBUL-B" || data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "GELONDONG-B" || data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "LICIN-B")
          {
            var kelapa =  $("p.TOTAL_KELAPA_B").text()
            //console.log(kelapa_a)
            var total_kelapa = parseInt(kelapa) + parseInt(data.result[i].NETTO)
            //console.log(data.result[i].NETTO)
            $("p.TOTAL_KELAPA_B").html(total_kelapa+" Kg")
          }
          else if (data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "JAMBUL-C" || data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "GELONDONG-C" || data.result[i].RMP_FAKTUR_JENIS_MATERIAL == "LICIN-C")
          {
            var kelapa =  $("p.TOTAL_KELAPA_C").text()
            //console.log(kelapa_a)
            var total_kelapa = parseInt(kelapa) + parseInt(data.result[i].NETTO)
            //console.log(data.result[i].NETTO)
            $("p.TOTAL_KELAPA_C").html(total_kelapa+" Kg")
          }

          if(data.result[i].RMP_FAKTUR_NAMA_SUB == "")
          {
            var nama = data.result[i].RMP_MASTER_PERSONAL_NAMA
          }
          else
          {
            var nama = "" + data.result[i].RMP_MASTER_PERSONAL_NAMA + " / " + data.result[i].RMP_FAKTUR_NAMA_SUB + ""
          }

          if(data.result[i].PURCHASER_STATUS == "BELUM DIPROSES")
          {
            var purchaser_status = ""
          }
          else
          {
            var purchaser_status = "<p class='text-success'><small><i>Telah diproses oleh Purchaser</i></small></p>"
          }
          if (data.result[i].TOTAL_A == null)
          {
            var total_a = "0"
          }
          else
          {
            var total_a = data.result[i].TOTAL_A
          }

          if (data.result[i].TOTAL_B == null)
          {
            var total_b = "0"
          }
          else
          {
            var total_b = data.result[i].TOTAL_B
          }

          if (data.result[i].TOTAL_C == null)
          {
            var total_c = "0"
          }
          else
          {
            var total_c = data.result[i].TOTAL_C
          }

          $("tbody#zone_lihat_faktur").append("<tr class='detailLogId'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_NO_FAKTUR +  " "+purchaser_status+"</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_DETAIL_NO_NOTA +  "</td>" +
					"<td>" + nama +  "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_JENIS_MATERIAL +  "</td>" +
					"<td>" + data.result[i].BRUTO +  "</td>" +
					"<td>" + data.result[i].TOTAL_POTONGAN +  "</td>" +
					"<td>" + data.result[i].NETTO +  "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_TANGGAL +  "</td>" +
					"<td><a class='btn btn-success btn-xs' href='?show=rmp/faktur/" + data.result[i].RMP_FAKTUR_ID +  "'><i aria-hidden='true' class='fa fa-pencil'></i> Lihat</a></td>" +
					"</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#zone_lihat_faktur").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
        $("p.TOTAL_KELAPA_A").html("0 Kg")
        $("p.TOTAL_KELAPA_B").html("0 Kg")
        $("p.TOTAL_KELAPA_C").html("0 Kg")
      }
    }, //end success
    error: function(x, e) {
    } //end error
  });
}
</script>
