<?php
$RMP_CONFIG=new RMP_CONFIG();
$SISTEM_CONFIG=new SISTEM_CONFIG();
 ?>

 <style>
 .table-small {
 	font-size: 12px;
 }

 .loader {
   border: 5px solid #f3f3f3;
   border-radius: 50%;
   border-top: 5px solid #3498db;
   width: 40px;
   height: 40px;
   -webkit-animation: spin 2s linear infinite; /* Safari */
   animation: spin 2s linear infinite;
 }

 /* Safari */
 @-webkit-keyframes spin {
   0% { -webkit-transform: rotate(0deg); }
   100% { -webkit-transform: rotate(360deg); }
 }

 @keyframes spin {
   0% { transform: rotate(0deg); }
   100% { transform: rotate(360deg); }
 }

 /* table{
 font-size: 12px;
 }
 table-detail{
 font-size: 9px;
 } */

 .modal-gudang{
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
          <div class="row">
            <div class="col-md-8">
            </div>
           <div class="col-md-4">
             <select class="form-control CHANGE_JENIS_FAKTUR" onchange="change_jenis_faktur()">
               <option value="faktur">Faktur</option>
               <option value="faktur_cabang">Faktur Cabang</option>
             </select>
             <p class="help-block">Jenis Faktur yang akan diproses.</p>
           </div>
          </div>

      		<div class="row form_faktur_hasil_timbang">
      			<div class="col-md-6">
      				<div class="small-box bg-aqua">
      					<div class="inner">
      						<p class="NO_FAKTUR" style="font-size:40px">-</p>
      						<p>No. Faktur</p>
      					</div>
      					<div class="icon">
      						<i class="fa fa-balance-scale"></i>
      					</div>
      				</div>
      			</div>
      			<div class="col-md-6">
      				<div class="small-box bg-green">
      					<div class="inner">
      						<p class="NO_NOTA_INPUT" style="font-size:40px">0</p>
      						<p>No. Nota</p>
      					</div>
      					<div class="icon">
      						<i class="fa fa-balance-scale"></i>
      					</div>
      				</div>
      			</div>
      		</div>
          <form id="faktur_detail">
      		<div class="row">

            <div class="form_faktur_cabang" hidden>
            <div class="col-md-4">
            <div class="form-group" >
              <label for="exampleInputEmail1">ID Faktur Cabang</label> <select class="ID_FAKTUR_CABANG selectpicker with-ajax-personal form-control" data-live-search="true" id="ID_FAKTUR_CABANG" name="ID_FAKTUR_CABANG" onchange="id_faktur_cabang()">
              </select>
              <p class="help-block">Pilih ID Faktur Cabang Purchaser.</p>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group" >
              <label for="exampleInputEmail1">PS Cabang</label><input autocomplete="off" class="form-control PS_CABANG" id="PS_CABANG" name="PS_CABANG" placeholder="PS_CABANG" type="text" readonly>
              <p class="help-block">Pilih ID Faktur Cabang Purchaser.</p>
            </div>
            </div>
            <div class="col-md-4">
              <div class="form-group" >
                <label for="exampleInputEmail1">Tanggal</label><input autocomplete="off" class="form-control TANGGAL_REKAP_FAKTUR_CABANG" id="TANGGAL_REKAP_FAKTUR_CABANG" name="TANGGAL_REKAP_FAKTUR_CABANG" placeholder="TANGGAL_REKAP_FAKTUR_CABANG" type="text" readonly>
                <p class="help-block">Tanggal rekap faktur cabang.</p>
              </div>
            </div>
            </div>

            <div class="form_faktur_hasil_timbang">
            <div class="col-md-4">
            <div class="form-group">
              <label for="exampleInputEmail1">Nomor Nota</label> <select class="NO_NOTA selectpicker with-ajax-personal form-control" data-live-search="true" id="NO_NOTA" name="NO_NOTA" onchange="no_nota()">
              </select>
              <p class="help-block">Pilih Nomor Nota.</p>
            </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Nota</label>
                <input autocomplete="off" class="form-control NAMA_NOTA" id="NAMA_NOTA" name="NAMA_NOTA" type="text" readonly>
                <input autocomplete="off" class="form-control ID_FAKTUR" id="ID_FAKTUR" name="ID_FAKTUR" placeholder="ID_FAKTUR" type="hidden" >
                <input autocomplete="off" class="form-control NO_FAKTUR" id="NO_FAKTUR" name="NO_FAKTUR" placeholder="NO_FAKTUR" type="hidden" >
                <input autocomplete="off" class="form-control JENIS_KELAPA" id="JENIS_KELAPA" name="JENIS_KELAPA" placeholder="JENIS_KELAPA" type="hidden" >
                <p class="help-block">Nama Supplier Pada Nota Timbang.</p>
              </div>

          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Supplier</label><select class="NAMA_SUPPLIER with-ajax-personal form-control" data-live-search="true" id="NAMA_SUPPLIER" name="NAMA_SUPPLIER" onchange="sel_nama_supplier()">
              </select>
              <p class="help-block">Nama Supplier Untuk Faktur.</p>
            </div>
          </div>
            </div>
      		</div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Operator Timbang</label><select class="OPERATOR_TIMBANG with-ajax-personal form-control" data-live-search="true" id="OPERATOR_TIMBANG" name="OPERATOR_TIMBANG" onchange="sel_nama_karyawan()">
                </select>
                <p class="help-block">Nama Operator Timbang.</p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Inspektur Mutu</label><select class="INSPEKTUR_MUTU with-ajax-personal form-control" data-live-search="true" id="INSPEKTUR_MUTU" name="INSPEKTUR_MUTU" onchange="sel_nama_karyawan()">
                </select>
                <p class="help-block">Nama Inspektur Mutu.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Potongan</label> <input autocomplete="off" class="form-control POTONGAN" id="POTONGAN" name="POTONGAN" placeholder="POTONGAN" value="0" type="text">
                <p class="help-block">Masukkan Potongan.</p>
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
                  <input type="checkbox" name="CEK_DITERIMA"> Bisa Diterima
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="CEK_100_INSPEKSI"> 100 % Inspeksi
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="CEK_DIPISAH"> Dipisah
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



      <div class="row form_faktur_hasil_timbang">
      	<div class="col-md-6">
      		<div class="box box-solid">
      			<div class="box-body">
      				<div class="box box-default">
      					<div class="box-header with-border">
      						<h3 class="box-title">Hasil Timbang</h3>
      					</div>
      					<div class="box-body">

      						<div class="form-group" hidden="">
      							<label for="TANGGAL">Tanggal</label> <input autocomplete="off" class="form-control TANGGAL_NOTA datepicker" id="TANGGAL_NOTA" name="TANGGAL_NOTA" onchange="onchange_pilih_nota()" placeholder="TANGGAL" type="text" value="<?php echo date('Y-m-d'); ?>"> <small class="help-block">Tanggal No Nota</small>
      						</div>
      						<!-- <div class="small-box bg-yellow">
      							<div class="inner">
      								<p class="total_timbang" style="font-size:40px">0</p>
      								<p>Total</p>
      							</div>
      							<div class="icon">
      								<i class="fa fa-balance-scale"></i>
      							</div>
      						</div> -->
      							<table class="table table-small table-bordered">
      								<thead>
      									<tr>
      										<th>No.</th>
      										<th>Tanggal / Jam</th>
      										<th>Gross</th>
      										<th>Jenis Kelapa</th>
      										<th>Ponton</th>
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
      						<div class="text-left">
      							<a class="btn btn-success buat_faktur">Buat Faktur</a>
      						</div>
      					</div>
      				</div>
      			</div>
      		</div>
      	</div>
      	<div class="col-md-6">
      		<div class="box box-solid">
      			<div class="box-body">
      				<div class="box box-default">
      					<div class="box-header with-border">
      						<h3 class="box-title">Faktur</h3>
      					</div>
      					<div class="box-body">
      						<div class="small-box bg-yellow">
      							<div class="inner">
      								<p class="total_timbang" style="font-size:40px">0</p>
      								<p>Total</p>
      							</div>
      							<div class="icon">
      								<i class="fa fa-balance-scale"></i>
      							</div>
      						</div>

      						<table class="table table-small table-bordered">
      							<thead>
      								<tr>
      									<th>No.</th>
      									<th>Tanggal / Jam</th>
      									<th>Gross</th>
      									<th>Jenis Kelapa</th>
      									<th></th>
      								</tr>
      							</thead>
      							<tbody id="zone_data_faktur">
      								<tr>
      									<td colspan="9">
      										<center>
      											<div class="loader"></div>
      										</center>
      									</td>
      								</tr>
      							</tbody>
      						</table>
                  <br>
      						<div class="text-left">
      							 <button class="btn btn-success simpan_faktur" type="button">Simpan Faktur</button>
                     <!-- <a class="btn btn-default btn_lihat_faktur" style="display:none;"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a> -->
                     <a class="btn btn-default btn_cetak_faktur" style="display:none;"><i class="fa fa-print" aria-hidden="true"></i> Cetak</a>
      						</div>
      					</div>
      				</div>
      			</div>
      		</div>
      	</div>
      </div>

      <div class="row form_faktur_cabang" hidden>
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
                  <a class="btn btn-success simpanreview">Simpan</a>
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

$('.buat_faktur').on('click', function()
{
  if ($('.NO_NOTA').val() == null)
  {
    alert('Pilih Nomor Nota Terlebih Dahulu')
  }
  else if ($('.NO_FAKTUR').val() == '')
  {
    $(this).html('Buat Faktur Baru');
    $('.NO_NOTA').attr('disabled', 'disabled');
    //$('div.form_faktur').toggle('hidden')
    //$('.NO_FAKTUR').val('<?= $buat_nomor_faktur;  ?>')

    var no_faktur = $('.NO_FAKTUR').val()
    faktur_list(no_faktur);
  }
  else
  {
    $(this).attr('disabled', 'disabled');
    location.reload();
  }
})

$(function()
{
	$(".datepicker").datepicker().on('changeDate', function(ev)
  {
		$('.datepicker').datepicker('hide');
	});
});

function onchange_pilih_nota()
{
  console.log('onchange')
  var tanggal = $('.TANGGAL_NOTA').val();
  console.log(tanggal)
  var options =
  {
    ajax: {
      url: refseeAPI,
      type: 'POST',
      dataType: 'json',
      data: {
        q: '{{{q}}}',
        TANGGAL_NOTA: tanggal,
        ref: 'pilih_no_nota',
      }
    },
    locale:
    {
      emptyTitle: 'Pilih Nota Timbang'
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
            text: data.result[i].notr,
            value: data.result[i].notr,
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
  $('.selectpicker').selectpicker().filter('.with-ajax-personal').ajaxSelectPicker(options);
}

function sel_nama_supplier()
{
  console.log("sel_nama_supplier")
  var options =
  {
    ajax: {
      url: refseeAPI,
      type: 'POST',
      dataType: 'json',
      data: {
        q: '{{{q}}}',
        ref: 'sel_nama_supplier',
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
}

function sel_nama_karyawan()
{
  var options =
  {
    ajax: {
      url: refseeAPI,
      type: 'POST',
      dataType: 'json',
      data: {
        q: '{{{q}}}',
        ref: 'sel_nama_karyawan',
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
            text: data.result[i].PERSONAL_NAME,
            value: data.result[i].PERSONAL_NIK,
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
  $('.INSPEKTUR_MUTU,.OPERATOR_TIMBANG').selectpicker().filter('.with-ajax-personal').ajaxSelectPicker(options);
}

$(function() {
  sel_nama_karyawan();
});

$(function() {
  sel_nama_supplier();
});
$(function() {
  onchange_pilih_nota();
});


function no_nota()
{
  var no_nota = $('.NO_NOTA').val();
  console.log(no_nota)
  hasil_timbang(no_nota);
}

function hasil_timbang(no_nota)
{
  var jenis_kelapa = $(".JENIS_KELAPA").val()
  var data = "JENIS_KELAPA="+jenis_kelapa+"&NO_NOTA="+no_nota+"";
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=hasil_timbang_list&'+data,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        $("tbody#zone_data").empty();
        for (i = 0; i < data.result.length; i++)
        {
          console.log(data.result[i].nama_relasi)
          $('.NAMA_NOTA').val(data.result[i].nama_relasi)
          // $('p.TANGGAL').html(data.result[i].RMP_HASIL_TIMBANG_TANGGAL)
          $('p.TANGGAL').html(data.result[i].tgl)
          // $('p.KAPAL').html(data.result[i].RMP_HASIL_TIMBANG_KAPAL)
          $('p.KAPAL').html(data.result[i].RMP_FAKTUR_KAPAL)
          // $('p.NO_NOTA_INPUT').html(data.result[i].RMP_HASIL_TIMBANG_NO_NOTA)
          $('p.NO_NOTA_INPUT').html(data.result[i].notr)
          $('p.ALAMAT').html(data.result[i].alamat)
          $('input.idnota').html(data.result[i].id)

          if(data.result[i].RECORD_STATUS=='N')
          {
            var a = ""
            var tr = "danger"
          }
          else if(data.result[i].RECORD_STATUS=='A')
          {
            var a = ""
            var tr = "danger"
          }
          else
          {
            // var a = "<a class='btn btn-default btn-sm kirim_hasil_timbang' ID_HASIL_TIMBANG='" + data.result[i].RMP_HASIL_TIMBANG_ID +  "' NO_NOTA='" + data.result[i].RMP_HASIL_TIMBANG_NO_NOTA +  "'><i aria-hidden='true' class='fa fa-external-link'></i></a>"
            // var tr = ""
            var a = "<a class='btn btn-default btn-sm kirim_hasil_timbang' ID_HASIL_TIMBANG='" + data.result[i].id +  "' NO_NOTA='" + data.result[i].notr +  "'   BRUTO='" + data.result[i].gross + "' PONTON='" + data.result[i].id_timbang + "' JENIS_KELAPA='" + data.result[i].jenis_kelapa + "'><i aria-hidden='true' class='fa fa-angle-double-right'></i></a>"
            var tr= ""
          }

          $("tbody#zone_data").append("<tr class='"+tr+"'  detailLogId='" + data.result[i].ICD_BARANG_KODE_INVENTORI + "'>" +
            "<td >" + data.result[i].NO + ".<input type='hidden' class='idnota'></td>" +
            // "<td>" + data.result[i].RMP_HASIL_TIMBANG_TANGGAL + "</td>" +
            "<td>" + data.result[i].tgl + "</td>"+
            // "<td>" + data.result[i].RMP_HASIL_TIMBANG_KG + "</td>" +
            "<td>" + data.result[i].gross + "</td>"+
            "<td>" + data.result[i].jenis_kelapa + "</td>"+
            "<td>" + data.result[i].id_timbang + "</td>"+
            "<td>"+ a +"</td>" +
            "</tr>");
        }
      }
      else if (data.respon.pesan == "gagal") {
        $("tbody#zone_data").html("<tr><td colspan='10'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e)
    {
      error_handler_json(x, e, '=> barang_kamus_list()');
    } //end error
  });
}

$(function() {
  hasil_timbang();
});

$("tbody#zone_data").on('click','a.kirim_hasil_timbang', function()
{
  $("a.kirim_hasil_timbang").attr("style","display:none;")
  var id_timbang = $(this).attr('ID_HASIL_TIMBANG');
  var no_nota = $(this).attr('NO_NOTA');
  var jenis_kelapa = $(this).attr('JENIS_KELAPA');
  var data = 'ID_TIMBANG='+id_timbang+'&NO_NOTA='+no_nota;
  $(".JENIS_KELAPA").val(jenis_kelapa);
    kirim_hasil_timbang(data)
    var no_nota = $('.NO_NOTA').val();
    hasil_timbang(no_nota);
    var no_faktur = $('.NO_FAKTUR').val()
    console.log("NOMOR FAKTUR::::::::::::::::::"+no_faktur)

})

function kirim_hasil_timbang(data)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=kirim_hasil_timbang&' + data ,
    success: function(data)
    {
      if (data.respon.pesan == "sukses")
      {
        console.log(data.respon.text_msg);
        $(".NO_FAKTUR").val(data.respon.text_msg)
        $("p.NO_FAKTUR").html(data.respon.text_msg)
        faktur_list(data.respon.text_msg);
      }
      else if (data.respon.pesan == "gagal")
      {
        console.log(data.respon.text_msg);
        alert("Gagal Menghapus");
      }
    }, //end success
    error: function(x, e)
    {
      console.log("Error Ajaxxxxxxxxxxxxx");
    } //end error
  });
}

function faktur_list(no_faktur)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=faktur_list&NO_FAKTUR='+no_faktur,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        $('p.total_timbang').html(data.respon.total_kg)
        $("tbody#zone_data_faktur").empty();
        for (i = 0; i < data.result.length; i++)
        {
          if(data.result[i].RECORD_STATUS=='D')
          {
            var a = ""
          }
          else if(data.result[i].RECORD_STATUS=='A')
          {
            var a = ""
          }
          else
          {
            // var a = "<a class='btn btn-default btn-sm kembali_hasil_timbang' ID_HASIL_TIMBANG='" + data.result[i].RMP_HASIL_TIMBANG_ID +  "' NO_NOTA='" + data.result[i].RMP_HASIL_TIMBANG_NO_NOTA +  "' ><i aria-hidden='true' class='fa fa-external-link'></i></a>"
            var a = "<a class='btn btn-default btn-sm kembali_hasil_timbang' ID_HASIL_TIMBANG='" + data.result[i].RMP_FAKTUR_DETAIL_ID +  "' NO_NOTA='" + data.result[i].RMP_FAKTUR_DETAIL_NO_NOTA +  "' ><i aria-hidden='true' class='fa fa-angle-double-left'></i></a>"
          }
          $("tbody#zone_data_faktur").append("<tr class='default'  detailLogId='" + data.result[i].ICD_BARANG_KODE_INVENTORI + "'>" +
            "<td >" + data.result[i].NO + ".</td>" +
            "<td>" + data.result[i].RMP_FAKTUR_DETAIL_TANGGAL + "</td>" +
            "<td>" + data.result[i].RMP_FAKTUR_DETAIL_NETTO + "</td>" +
            "<td>" + data.result[i].RMP_FAKTUR_DETAIL_JENIS_MATERIAL + "</td>" +
            "<td>"+ a +"</td>" +
            "</tr>");
        }
      }
      else if (data.respon.pesan == "gagal")
      {
        $('p.total_timbang').html('0')
        $("tbody#zone_data_faktur").html("<tr><td colspan='10'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e)
    {
      console.log("Gagal Ajax")
    } //end error
  });
}

$(function()
{
  var no_faktur = $('.NO_FAKTUR').val()
  faktur_list(no_faktur);
});

function simpan_faktur()
{
  var fData = $("#faktur_detail").serialize();
  console.log(fData)
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=simpan_faktur&' + fData,
    success: function(data)
    {
      if (data.respon.pesan == "sukses")
      {
        $('.btn_cetak_faktur').removeAttr('style');
        for (i = 0; i < data.result.length; i++) {
          var id_faktur = data.result[i].RMP_FAKTUR_ID
          $('.ID_FAKTUR').val(id_faktur);
        }
        $('.btn_lihat_faktur').removeAttr('style');
        for (i = 0; i < data.result.length; i++) {
          var id_faktur = data.result[i].RMP_FAKTUR_ID
          $('.ID_FAKTUR').val(id_faktur);

        }

      }
      else if (data.respon.pesan == "gagal")
      {
        console.log(data.respon.text_msg);
        alert("Gagal Menghapus");
      }
    }, //end success
    error: function(x, e)
    {
      console.log("Error Ajax");
    } //end error
  });
}

$('.simpan_faktur').on('click', function()
{
  if($('.POTONGAN').val() == '')
  {
    alert("Potongan Tidak Boleh Kosong")
  }
  else
  {
  $(this).attr('disabled', 'disabled');
  var no_nota = $('.NO_NOTA').val();
  hasil_timbang(no_nota);
  var no_faktur = $('.NO_FAKTUR').text();
  simpan_faktur();
  faktur_list(no_faktur);
  }
})

$('.btn_cetak_faktur').on('click', function()
{
  var id_faktur = $('.ID_FAKTUR').val();
  window.open('?show=rmp/pdf/cetak_faktur/' + id_faktur + '', '_blank');
})

$('.btn_lihat_faktur').on('click', function()
{
  var id_faktur = $('.ID_FAKTUR').val();
  window.open('?show=rmp/html/faktur/' + id_faktur + '', '_blank');
})

function kembali_hasil_timbang(data)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=kembali_hasil_timbang&' + data ,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        console.log(data.respon.text_msg);

      }
      else if (data.respon.pesan == "gagal")
      {
        console.log(data.respon.text_msg);
        alert("Gagal Menghapus");
      }
    }, //end success
    error: function(x, e)
    {
      console.log("Error Ajax");
    } //end error
  });
}

$("tbody#zone_data_faktur").on('click','a.kembali_hasil_timbang', function()
{
  $("a.kembali_hasil_timbang").attr("style","display:none;")
  var id_timbang = $(this).attr('ID_HASIL_TIMBANG');
  var no_nota = $(this).attr('NO_NOTA');
  var no_faktur = $('.NO_FAKTUR').text();
  var data = 'ID_TIMBANG='+id_timbang+'&NO_NOTA='+no_nota+'&NO_FAKTUR='+no_faktur;;
  console.log(data)
  if(no_faktur == "")
  {
    alert('Buat Faktur Terlebih Dahulu')
  }
  else
  {
    kembali_hasil_timbang(data)
    var no_nota = $('.NO_NOTA').val()
    hasil_timbang(no_nota)
    var no_faktur = $('.NO_FAKTUR').text()
    faktur_list(no_faktur)
  }
})

function change_jenis_faktur(){
  var jenis_faktur = $('.CHANGE_JENIS_FAKTUR').val()
  if(jenis_faktur == "faktur_cabang"){
    $('div.form_faktur_cabang').toggle('hidden')
    $('div.form_faktur_hasil_timbang').toggle('hidden')
    list_review_faktur_cabang_a()
    list_review_faktur_cabang_b()
    list_review_faktur_cabang_c()
  }
  else if(jenis_faktur == "faktur"){
    $('div.form_faktur_cabang').toggle('hidden')
    $('div.form_faktur_hasil_timbang').toggle('hidden')

  }
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
					"<td>" + data.result_c[i].RMP_MASTER_PERSONAL_NAMA  + " <input type='hidden' name='supplier_name[]' value='" + data.result_c[i].RMP_MASTER_PERSONAL_ID  + "' id='supplier_name_" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
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
					"<td>" + data.result_b[i].RMP_MASTER_PERSONAL_NAMA  + "<input type='hidden' name='supplier_name[]' value='" + data.result_b[i].RMP_MASTER_PERSONAL_ID  + "' id='supplier_name_" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
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
					"<td>" + data.result_a[i].RMP_MASTER_PERSONAL_NAMA  + "<input type='hidden' name='supplier_name[]' value='" + data.result_a[i].RMP_MASTER_PERSONAL_ID  + "' id='supplier_name_" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'></td>" +
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
          text: data.result[i].RMP_REKAP_FC_CABANG,
          value: data.result[i].RMP_REKAP_FC_ID,
          data:
          {
            subtext: data.result[i].RMP_REKAP_FC_ID,
            cabang: data.result[i].RMP_REKAP_FC_CABANG,
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
  var form_detail = $('#faktur_detail').serialize()
  var arrayInput = $('#arrayInput').serialize();
  var data = form_detail + "&" + arrayInput;
  $(this).attr("disabled", true);
  $(this).html('Loading...');
  console.log(data)
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=simpanreview&' + data,
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
