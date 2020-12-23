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
						<h3><i class="fa fa-money"></i> Detail Periode</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right">

          </div>
				</div><!--/.row-->
				<div class="row">
          <div class="col-md-6">
            <div class="small-box bg-green">
              <div class="inner">
                <p class="dana_periode" style="font-size:40px"></p>
                <p>Dana</p>
              </div>
              <div class="icon">
                <i class="fa fa-file-text"></i>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="small-box bg-aqua">
              <div class="inner">
                <p class="sisa_periode" style="font-size:40px"></p>
                <p>Sisa</p>
              </div>
              <div class="icon">
                <i class="fa fa-file-text"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Data Jurnal</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body" style="">
        <div class="row">
          <div class="col-md-3">
            <select class="form-control JENIS_MATERIAL" id="JENIS_MATERIAL" name="JENIS_MATERIAL" onchange="pilih_material()">
              <option value="">--Pilih Material--</option>
                <option value="KOPRA" nama_material="KOPRA">KOPRA</option>
                <option value="JAMBUL" nama_material="JAMBUL">JAMBUL</option>
                <option value="GELONDONG" nama_material="GELONDONG">GELONDONG</option>
            </select>

          </div>
          <div class="col-md-4">
            <input autocomplete="off" class="form-control NOMOR_REKENING" id="NOMOR_REKENING" name="NOMOR_REKENING" placeholder="" type="text">
          </div>
          <div class="col-md-4">
            <!-- <select class="NAMA_SUPPLIER with-ajax-personal form-control" data-live-search="true" id="NAMA_SUPPLIER" name="NAMA_SUPPLIER">
            </select> -->
            <select class="form-control NAMA_SUPPLIER" style="width: 100%;" aria-hidden="true" id="NAMA_SUPPLIER" name="NAMA_SUPPLIER" onchange="pilih_supplier()">
                  <!-- <option data-select2-id="32">Washington</option> -->
            </select>
          </div>
          <div class="col-md-1">
            <button type="button" class="btn btn-success" onclick="sel_nama_supplier_rekening()"><i class="fa fa-search"></i>
            </select>
          </div>
        </div>
        <hr>
        <!-- <div class="small-box bg-yellow" >
      <div class="inner">
        <h3 id="no_rekening_supplier">00.00.000.0000</h3>

        <p id="nama_supplier">-</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
    </div> -->
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No.</th>
              <th>Tanggal</th>
              <th>No. Fakur</th>
              <th>Supplier</th>
              <th>Nilai Faktur</th>
              <th>Bayar Faktur</th>
              <th>Sisa Hutang</th>
            </tr>
          </thead>
          <tbody id="ms_zone_data">
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
      <!-- /.box-body -->
    </div>

    <!-- <div class="box box-solid">
      <div class="box-body">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
          </div>
          <div class="box-body">

          </div>
        </div>
      </div>
    </div> -->
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Data Pengajuan</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body" style="">
        <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th></th>
              <th>No.</th>
              <th>Tanggal</th>
              <th>No. Fakur</th>
              <th>Rekening</th>
              <th>Nama</th>
              <th>Total Faktur</th>
              <th>Bayar Faktur</th>
              <th>Sisa Hutang</th>
              <th>Pengajuan</th>
              <th>Sisa Pengajuan</th>
            </tr>
          </thead>
          <tbody id="pengajuan_zone_data">
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
      <!-- /.box-body -->
    </div>
    <div class="box box-solid">
      <div class="box-body">
        <div class="box box-default">
          <div class="box-body">
          <br>
          <div class="small-box bg-aqua">
            <div class="inner">
              <p class="total_periode" style="font-size:40px"></p>
              <p>Total</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text"></i>
            </div>
          </div>
          <div class="text-right">
            <a class='btn btn-success btn-lg verifikasi_action'>Kirim Pengajuan</a>
          </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalPeriode" role="dialog" tabindex="-1">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
 				<h4 class="modal-title" id="myModalLabel">Periode Dana Material</h4>
 			</div>
 			<div class="modal-body">

 				<form action="javascript:download();" class="fDataPeriode form-horizontal" id="fDataManualNota" name="fDataManualNota">
           <div class="form-group">
             <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">ID Periode</label>
             <div class="col-sm-8">
             <input autocomplete="off" class="form-control ID_PERIODE datepicker" id="ID_PERIODE" name="ID_PERIODE" placeholder="" type="text" value="<?php echo $d3; ?>">
           </div>
         </div>
             <div class="form-group">
               <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Dana</label>
               <div class="col-sm-8">
               <input autocomplete="off" class="form-control DANA_MATERIAL" id="DANA_MATERIAL" name="DANA_MATERIAL" placeholder="" type="number" onkeyup="kalkulasi_manual()">
             </div>
           </div>
         </form>

           <div class="row">
             <div class="col-md-12 text-right">
               <div class="form-group">
     						<button class="btn btn-success btn-sm SIMPAN_PERIODE">Simpan</button>
     					</div>
             </div>
           </div>
 		</div>
 	</div>
 </div>
 </div>

 <div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalPengajuanPembayaran" role="dialog" tabindex="-1">
  	<div class="modal-dialog" role="document">
  		<div class="modal-content">
  			<div class="modal-header">
  				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
  				<h4 class="modal-title" id="myModalLabel">Pengajuan Pembayaran</h4>
  			</div>
  			<div class="modal-body">

  				<form action="javascript:download();" class="fDataPengajuan form-horizontal" id="fDataManualNota" name="fDataManualNota">
            <div class="form-group">
              <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Periode Pembayaran</label>
              <div class="col-sm-8">
              <input autocomplete="off" class="form-control PERIODE_ID" id="PERIODE_ID" name="PERIODE_ID" placeholder="" type="hidden">
              <input autocomplete="off" class="form-control PERIODE_PEMBAYARAN" id="PERIODE_PEMBAYARAN" name="PERIODE_PEMBAYARAN" placeholder="" type="text">
            </div>
          </div>
            <div class="form-group">
              <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">No. Faktur</label>
              <div class="col-sm-8">
              <input autocomplete="off" class="form-control NO_FAKTUR_PENGAJUAN datepicker" id="NO_FAKTUR_PENGAJUAN" name="NO_FAKTUR_PENGAJUAN" placeholder="" type="text">
            </div>
          </div>
              <div class="form-group">
                <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Total Faktur</label>
                <div class="col-sm-8">
                <input autocomplete="off" class="form-control TOTAL_FAKTUR" id="TOTAL_FAKTUR" name="TOTAL_FAKTUR" placeholder="" type="number">
              </div>
            </div>
              <div class="form-group">
                <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Bayar Faktur</label>
                <div class="col-sm-8">
                <input autocomplete="off" class="form-control TOTAL_RUPIAH" id="TOTAL_RUPIAH" name="TOTAL_RUPIAH" placeholder="" type="number">
              </div>
            </div>
            <div class="form-group">
              <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Sisa Hutang</label>
              <div class="col-sm-8">
              <input autocomplete="off" class="form-control SISA_HUTANG_FAKTUR" id="SISA_HUTANG_FAKTUR" name="SISA_HUTANG_FAKTUR" placeholder="" type="number" onkeyup="kalkulasi_pengajuan()">
            </div>
          </div>
              <div class="form-group">
                <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Rupiah Pengajuan</label>
                <div class="col-sm-8">
                <input autocomplete="off" class="form-control PENGAJUAN_RUPIAH" id="PENGAJUAN_RUPIAH" name="PENGAJUAN_RUPIAH" placeholder="" type="number" onkeyup="kalkulasi_pengajuan()">
              </div>
            </div>

              <div class="form-group">
                <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Sisa</label>
                <div class="col-sm-8">
                <input autocomplete="off" class="form-control SISA_RUPIAH" id="SISA_RUPIAH" name="SISA_RUPIAH" placeholder="" type="number" onkeyup="kalkulasi_pengajuan()">
                <input autocomplete="off" class="form-control SISA_DANA" id="SISA_DANA" name="SISA_DANA" placeholder="" type="hidden" onkeyup="kalkulasi_pengajuan()">
                <p class="help-block alert_minus text-danger" style="display:none">Sisa tidak boleh kurang dari 0</p>
                <p class="help-block alert_minus_dana text-danger" style="display:none">Pengajuan melebihi sisa dana material</p>
              </div>
            </div>
          </form>
          <hr>
          <table class="table">
            <tr>
              <td><b>Sisa Hutang Faktur</b></td>
              <td><b>:</b></td>
              <td>Rp.</td>
              <td align="right"><b><p class="sisa_hutang_faktur"></p></b></td>
            </tr>
            <tr>
              <td><b>Rupiah Pengajuan</b></td>
              <td><b>:</b></td>
              <td>Rp.</td>
              <td align="right"><b><p class="pengajuan_rupiah"></p></b></td>
            </tr>
            <tr>
              <td colspan="4"><hr></td>
            </tr>
            <tr>
              <td><b>Sisa</b></td>
              <td><b>:</b></td>
              <td>Rp.</td>
              <td align="right"><b><p class="sisa_rupiah"></p></b></td>
            </tr>
          </table>
            <div class="row">
              <div class="col-md-12 text-right">
                <div class="form-group">
      						<button class="btn btn-success btn-sm SIMPAN_PENGAJUAN_PEMBAYARAN">Simpan</button>
      					</div>
              </div>
            </div>
  		</div>
  	</div>
  </div>
  </div>

<script>
$(function () {
  //Initialize Select2 Elements
  $('.select2').select2()
})
$(function() {
  $('a.sidebar-toggle').click()
});
function number_format (number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

$(".tambah_faktur").on("click", function(){
    $(".modalPeriode").modal("show")
})

$(function()
{
	$(".datepicker").datepicker().on('changeDate', function(ev)
	{
		$('.datepicker').datepicker('hide');
	});
});

function filter(){
$("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
faktur_list('1')
}

function dana_material_list(curPage)
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
    data: 'ref=jurnal_list&batas=' + $('input#REC_PER_HALAMAN').val() + '&halaman=' + curPage + '&keyword=' + $("input#keyword").val() + '&id_periode=<?php echo $d3; ?>',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        $("tbody#pengajuan_zone_data").empty();
        $('#tujuan-light-pagination').pagination({
          pages: data.result_option.jml_halaman,
          cssStyle: 'light-theme',
          currentPage: curPage,
        });
        for (i = 0; i < data.result.length; i++) {
          if(data.result[i].RMP_JURNAL_STATUS_JURNAL == "TERKIRIM")
          {
            var status = "<i class='fa fa-check' aria-hidden='true'></i>"
            var btn_hapus = "<td></td>"
          }
          else
          {
            var status = ""
            var btn_hapus = "<td><a class='btn btn-danger btn-xs verifikasi_tolak' id_jurnal='"+data.result[i].RMP_JURNAL_ID+"'><span class='fa fa-trash' aria-hidden='true'></span></a></td>"
          }
          $("tbody#pengajuan_zone_data").append("<tr>" +
					"<td >" + status + "</td>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td >" + data.result[i].TANGGAL + "</td>" +
					"<td >" + data.result[i].RMP_JURNAL_NO_FAKTUR + "</td>" +
					"<td >" + data.result[i].RMP_JURNAL_REKENING + "</td>" +
					"<td >" + data.result[i].RMP_JURNAL_NAMA_SUPPLIER + "</td>" +
					"<td style='text-align:right'>" + number_format(data.result[i].RMP_JURNAL_RUPIAH_FAKTUR) + "</td>" +
					"<td style='text-align:right'>" + number_format(data.result[i].RMP_JURNAL_RUPIAH_TOTAL) + "</td>" +
					"<td style='text-align:right'>" + number_format(data.result[i].RMP_JURNAL_RUPIAH_SISA_HUTANG_FAKTUR) + "</td>" +
					"<td class='success' style='text-align:right'>" + number_format(data.result[i].RMP_JURNAL_RUPIAH_PENGAJUAN) + "</td>" +
					"<td style='text-align:right'>" + number_format(data.result[i].RMP_JURNAL_RUPIAH_SISA) + "</td>"+btn_hapus+"" +
          // "<td><a class='btn btn-success btn-sm verifikasi_action' id_jurnal='"+data.result[i].RMP_JURNAL_ID+"'><span class='fa fa-thumbs-o-up' aria-hidden='true'></span></a></td>" +


          "</tr>");
					}
      } else if (data.respon.pesan == "gagal") {
        //alert(data.respon.text_msg)
        $("tbody#pengajuan_zone_data").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

function gl_jurnal_list()
{
  $("tbody#ms_zone_data").html("<tr><td colspan='20'><center><div class='loader'></div></center></td></tr>")
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=gl_jurnal_list&material='+$(".JENIS_MATERIAL").val()+'&supplier='+$(".NAMA_SUPPLIER").val()+'&rekening='+$(".NOMOR_REKENING").val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        $("tbody#ms_zone_data").empty();
        //console.log(data.respon.text_msg)
        for (i = 0; i < data.result.length; i++) {
          if(data.result[i].STATUS == "A")
          {
            var tr = "success"
          }
          else
          {
            var tr = "default"
          }
          // no_rekening_supplier.innerText = data.result[0].KodeSup
          // nama_supplier.innerText = data.result[0].NAMA_SUPPLIER
          $("tbody#ms_zone_data").append("<tr class="+tr+">" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td >" + data.result[i].TANGGAL + "</td>" +
					"<td >" + data.result[i].NoFaktur + "</td>" +
					"<td >" + data.result[i].SupplierName + "</td>" +
					"<td style='text-align:right'>" + number_format(data.result[i].NilaiFaktur) + "</td>" +
					"<td style='text-align:right'>" + number_format(data.result[i].BayarAP) + "</td>" +
					"<td style='text-align:right'>" + number_format(data.result[i].SisaHutang) + "</td>" +
          "<td><a class='btn btn-success btn-xs pengajuan_pembayaran' no_faktur='"+data.result[i].NoFaktur+"' total='"+data.result[i].BayarAP+"' total_faktur='"+data.result[i].NilaiFaktur+"' sisa_hutang='"+data.result[i].SisaHutang+"'><span class='fa fa-arrow-circle-right' aria-hidden='true'></span></a></td>" +
          "</tr>");
					}
      } else if (data.respon.pesan == "gagal") {
        $("tbody#ms_zone_data").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

function pilih_material(){
  var material = $(".JENIS_MATERIAL").val()
  if(material == "KOPRA"){
    $(".NOMOR_REKENING").val("14.")
  }
  else if(material == "JAMBUL"){
    $(".NOMOR_REKENING").val("13.")
  }
  else if(material == "GELONDONG"){
    $(".NOMOR_REKENING").val("12.")
  }
  else{
    $(".NOMOR_REKENING").val("")
  }
  gl_jurnal_list()
}

function pilih_supplier(){
  var supplier = $(".NAMA_SUPPLIER").val()
  $(".NOMOR_REKENING").val(supplier)
  gl_jurnal_list()
}

function detail_periode()
{
  //console.log("detail Periode")
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=detail_periode&id_periode=<?php echo $d3; ?>' ,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        $('p.hari_periode').html(data.result[0].HARI)
        $('p.tanggal_periode').html(data.result[0].TANGGAL)
        $('p.id_periode').html(data.result[0].FINANCE_DANA_MATERIAL_ID)
        $('p.dana_periode').html("Rp. "+number_format(data.result[0].DANA))
        $('p.sisa_periode').html("Rp. "+number_format(data.result[0].SISA))
        $('.SISA_DANA').val(data.result[0].SISA)
        $('p.total_periode').html("Rp. "+number_format(data.result[0].TOTAL))

      } else if (data.respon.pesan == "gagal") {
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

// function sel_nama_supplier()
// {
//   //console.log("sel_nama_supplier")
//   var options =
//   {
//     ajax: {
//       url: refseeAPI,
//       type: 'POST',
//       dataType: 'json',
//       data: {
//         q: '{{{q}}}',
//         ref: 'sel_nama_supplier_rekening',
//       }
//     },
//     locale:
//     {
//       emptyTitle: 'Pilih Nama'
//     },
//     log: 3,
//     preprocessData: function(data)
//     {
//       var i, l = data.result.length,
//         array = [];
//       if (l)
//       {
//         for (i = 0; i < l; i++)
//         {
//           array.push($.extend(true, data.result[i],
//           {
//             // text: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
//             // value: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
//             text: data.result[i].RMP_REKENING_RELASI+' - '+data.result[i].RMP_MASTER_PERSONAL_NAMA,
//             value: data.result[i].RMP_MASTER_PERSONAL_ID,
//             data:
//             {
//               subtext: ''
//             }
//           }));
//         }
//       }
//       else
//       {
//       }
//       return array;
//     }
//   };
//   $('.NAMA_SUPPLIER').selectpicker().filter('.with-ajax-personal').ajaxSelectPicker(options);
//   gl_jurnal_list();
// }

$(function() {
  dana_material_list('1');
  detail_periode()
  gl_jurnal_list();
  //sel_nama_supplier();
});
$(window).on('hashchange', function(e) {
  $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  dana_material_list('1');
});
$("input#REC_PER_HALAMAN").on('change', function() {
  $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  dana_material_list('1')
});

function search() {
  $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
  dana_material_list('1');
}


$("a.verifikasi_action").on('click', function(){

  if (confirm('Apakah anda sudah yakin ?'))
      {
        $.ajax({
          type: 'POST',
          url: refseeAPI,
          dataType: 'json',
          data: 'ref=verifikasi_pengajuan&id_periode=<?php echo $d3; ?>' ,
          success: function(data) {
            if (data.respon.pesan == "sukses")
            {
              dana_material_list('1');
              detail_periode()
              alert("Pengajuan Terkirim")
            }
            else if (data.respon.pesan == "gagal")
            {
              alert (data.respon.text_msg);
            }
          }, //end success
          error: function(x, e)
          {
            console.log("Error Ajax QUALITED");
          } //end error
        });
      }

})

$("tbody#pengajuan_zone_data").on('click','a.verifikasi_tolak', function(){

  var id_jurnal = $(this).attr('id_jurnal')
  if (confirm('Apakah anda sudah yakin?.'))
      {
        $.ajax({
          type: 'POST',
          url: refseeAPI,
          dataType: 'json',
          data: 'ref=verifikasi_tolak&id_jurnal=' + id_jurnal ,
          success: function(data) {
            if (data.respon.pesan == "sukses")
            {
              dana_material_list('1');
              detail_periode()
            }
            else if (data.respon.pesan == "gagal")
            {
              alert (data.respon.text_msg);
            }
          }, //end success
          error: function(x, e)
          {
            console.log("Error Ajax QUALITED");
          } //end error
        });
      }

})

function periode_tersedia()
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=periode_tersedia',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        $('.PERIODE_PEMBAYARAN').val(data.result[0].TANGGAL)
        $('.PERIODE_ID').val(data.result[0].FINANCE_DANA_MATERIAL_ID)
      } else if (data.respon.pesan == "gagal") {
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

function sel_nama_supplier_rekening()
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=sel_nama_supplier_rekening&rekening='+$(".NOMOR_REKENING").val(),
    success: function(data) {
      $("select.NAMA_SUPPLIER").empty()
      if (data.respon.pesan == "sukses") {
        console.log(data.result)
        for (i = 0; i < data.result.length; i++) {
        $("select.NAMA_SUPPLIER").append("<option value='"+ data.result[i].RMP_REKENING_RELASI +"'>"+ data.result[i].RMP_REKENING_RELASI +" - "+ data.result[i].RMP_MASTER_PERSONAL_NAMA +"</option>");
        }
        gl_jurnal_list()
      } else if (data.respon.pesan == "gagal") {
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

$("tbody#ms_zone_data").on('click','a.pengajuan_pembayaran', function()
{
  periode_tersedia()
  $(".PENGAJUAN_RUPIAH").val("")
  $(".SISA_RUPIAH").val("")
  $("p.sisa_rupiah").html("0")
  $("p.pengajuan_rupiah").html("0")
	var no_faktur = $(this).attr('no_faktur');
	var total = $(this).attr('total');
	var total_faktur = $(this).attr('total_faktur');
	var sisa_hutang = $(this).attr('sisa_hutang');
  $(".modalPengajuanPembayaran").modal('show');
  $(".NO_FAKTUR_PENGAJUAN").val(no_faktur);
  $(".TOTAL_RUPIAH").val(total);
  $(".TOTAL_FAKTUR").val(total_faktur);
  $(".SISA_HUTANG_FAKTUR").val(sisa_hutang);
  $("p.sisa_hutang_faktur").html(number_format(sisa_hutang))
});

function kalkulasi_pengajuan(){
  var sisa_hutang_faktur = $(".SISA_HUTANG_FAKTUR").val()
  //var total_rupiah = $(".TOTAL_RUPIAH").val()
  var pengajuan_rupiah = $(".PENGAJUAN_RUPIAH").val()
  var sisa_dana = $(".SISA_DANA").val()
  $("p.pengajuan_rupiah").html(number_format(pengajuan_rupiah))
  var sisa = sisa_hutang_faktur-pengajuan_rupiah
  if(sisa < 0 ){
    $("p.alert_minus").removeAttr("style")
    $(".SIMPAN_PENGAJUAN_PEMBAYARAN").attr("disabled", true)
  }
  else{
    $("p.alert_minus").attr("style","display:none")
    $(".SIMPAN_PENGAJUAN_PEMBAYARAN").attr("disabled", false)
  }

  if(parseInt(pengajuan_rupiah) > parseInt(sisa_dana) ){
    $("p.alert_minus_dana").removeAttr("style")
    $(".SIMPAN_PENGAJUAN_PEMBAYARAN").attr("disabled", true)
  }
  else{
    $("p.alert_minus_dana").attr("style","display:none")
    $(".SIMPAN_PENGAJUAN_PEMBAYARAN").attr("disabled", false)
  }
  $(".SISA_RUPIAH").val(sisa)
  $("p.sisa_rupiah").html(number_format(sisa))
}

$(".SIMPAN_PENGAJUAN_PEMBAYARAN").on("click", function(){
  var fData = $('.fDataPengajuan').serialize();
  //console.log(fData)
  if($('.PENGAJUAN_RUPIAH').val() == 0 || $('.PENGAJUAN_RUPIAH').val() == '' )
  {
    alert("Pengajuan Rupiah Harus Diisi")
    return
  }
  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=kirim_pengajuan_pembayaran&' + fData ,
  	success: function(data) {
      console.log(data.respon.text_msg)
  		if (data.respon.pesan == "sukses")
  		{
        $(".modalPengajuanPembayaran").modal('hide');
        dana_material_list('1');
        detail_periode()
        gl_jurnal_list()
  		}

  		else if (data.respon.pesan == "gagal")
  		{
  			//console.log(data.respon.text_msg);
  			alert("Gagal Menyimpan");
  		}
  	}, //end success
  	error: function(x, e) {
  		console.log("Error Ajax");
  	} //end error
  });
})
</script>
