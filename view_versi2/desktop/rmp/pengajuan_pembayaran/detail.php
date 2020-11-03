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
					<div class="col-md-4">
						<table class="table">
              <!-- <tr>
                <td><b>ID Periode</b></td>
                <td><b>:</b></td>
                <td><b><p class="id_periode"></p></b></td>
              </tr> -->
              <tr>
                <td><b>Hari</b></td>
                <td><b>:</b></td>
                <td><b><p class="hari_periode"></p></b></td>
              </tr>
              <tr>
                <td><b>Tanggal</b></td>
                <td><b>:</b></td>
                <td><b><p class="tanggal_periode"></p></b></td>
              </tr>
              <tr>
                <td><b>Dana</b></td>
                <td><b>:</b></td>
                <td><b><p class="dana_periode"></p></b></td>
              </tr>
              <tr>
                <td><b>Sisa</b></td>
                <td><b>:</b></td>
                <td><b><p class="sisa_periode"></p></b></td>
              </tr>
            </table>
						<hr>
				</div><!--/.row-->
        <div class="col-md-8 text-right">
          <!-- <button class="btn btn-success tambah_faktur"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Faktur</button> -->
        </div>
        </div>

        <br>
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>No. Fakur</th>
                  <th>Rekening</th>
                  <th>Material</th>
                  <th>Nama Supplier</th>
                  <th>Rp. Faktur</th>
                  <th>Rp. Pengajuan</th>
                  <th>Rp. Sisa</th>
                  <th>Status</th>
                  <th></th>
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
            <label>Jumlah Baris Per Halaman</label> <input class="form-control" id="REC_PER_HALAMAN" max='1000' min="1" name="REC_PER_HALAMAN" required="" type="number" value="150">
            </div>
            </div><!--/row-->
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

<script>
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
        $("tbody#zone_data").empty();
        $('#tujuan-light-pagination').pagination({
          pages: data.result_option.jml_halaman,
          cssStyle: 'light-theme',
          currentPage: curPage,
        });
        for (i = 0; i < data.result.length; i++) {
          if(data.result[i].FINANCE_DANA_MATERIAL_STATUS == "AKTIF")
          {
            var tr = "success"
          }
          else
          {
            var tr = "default"
          }
          $("tbody#zone_data").append("<tr class="+tr+">" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td >" + data.result[i].RMP_JURNAL_NO_FAKTUR + "</td>" +
					"<td >" + data.result[i].RMP_JURNAL_REKENING + "</td>" +
					"<td >" + data.result[i].RMP_JURNAL_MATERIAL + "</td>" +
					"<td >" + data.result[i].RMP_JURNAL_NAMA_SUPPLIER + "</td>" +
					"<td >" + number_format(data.result[i].RMP_JURNAL_RUPIAH_TOTAL) + "</td>" +
					"<td class='success'>" + number_format(data.result[i].RMP_JURNAL_RUPIAH_PENGAJUAN) + "</td>" +
					"<td >" + number_format(data.result[i].RMP_JURNAL_RUPIAH_SISA) + "</td>" +
					"<td >" + data.result[i].RMP_JURNAL_STATUS_JURNAL + "</td>" +
          "<td><a class='btn btn-success btn-sm verifikasi_action' id_jurnal='"+data.result[i].RMP_JURNAL_ID+"'><span class='fa fa-thumbs-o-up' aria-hidden='true'></span></a></td>" +
          "<td><a class='btn btn-danger btn-sm verifikasi_tolak' id_jurnal='"+data.result[i].RMP_JURNAL_ID+"'><span class='fa fa-thumbs-o-down' aria-hidden='true'></span></a></td>" +

          "</tr>");
					}
      } else if (data.respon.pesan == "gagal") {
        //alert(data.respon.text_msg)
        $("tbody#zone_data").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}
function detail_periode()
{
  console.log("detail Periode")
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

      } else if (data.respon.pesan == "gagal") {
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

$(function() {
  dana_material_list('1');
  detail_periode()
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


$("tbody#zone_data").on('click','a.verifikasi_action', function(){

  var id_jurnal = $(this).attr('id_jurnal')
  if (confirm('Apakah anda sudah yakin?.'))
      {
        $.ajax({
          type: 'POST',
          url: refseeAPI,
          dataType: 'json',
          data: 'ref=verifikasi_pengajuan&id_jurnal=' + id_jurnal ,
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

$("tbody#zone_data").on('click','a.verifikasi_tolak', function(){

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

</script>
