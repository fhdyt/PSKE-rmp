<?php
$RMP_CONFIG=new RMP_CONFIG();
 ?>

<style>

.modalPersonal {
  width: 1300px;
}

.modalIMG {
  width: 1000px;
}

.modal{
    overflow-y: auto;
}

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

.modal-large {
	width: 1000px;
}

table {
	font-size: 12px;
}
</style>

<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="list-group">
			<div class="list-group-item">
				<div class="row">
					<div class="col-md-8">
						<h3><i class="fa fa-calculator"></i> Kopra</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right"></div>
				</div><!--/.row-->
        <div class="row">
          <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No.</th>
                  <th style="padding-right:100px;">Nama</th>
                  <th style="padding-right:100px;">Wilayah</th>
                  <th style="padding-right:100px;">Lokasi</th>
                  <th style="padding-right:100px;">Kualitet</th>
                  <th style="padding-right:100px;">Harga Jadi</th>
                  <th style="padding-right:100px;">Harga Patokan</th>
                  <th style="padding-right:100px;">Harga Setengah Jadi</th>
                  <th style="padding-right:100px;">Harga Transaksi</th>
                  <th style="padding-right:100px;">Berlaku</th>
                  <th style="padding-right:100px;">Berakhir</th>
                  <th style="padding-right:130px;"></th>
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
        </div>
        </div>
      </div>
      <br>
				<div class="row">
  <div class="col-md-9">
    <div class="pagination-holder clearfix">
      <div class="pagination" id="tujuan-light-pagination"></div>
    </div>
  </div>
  <div class="col-md-3 text-right">
    <!-- <select class="form-control MATERIAL" id="MATERIAL" name="MATERIAL"></select> -->
    <label>Jumlah Baris Per Halaman</label> <input class="form-control" id="REC_PER_HALAMAN" max='1000' min="1" name="REC_PER_HALAMAN" required="" type="number" value="10">
  </div>
</div><!--/row-->
			</div>
		</div>
	</div>
</div>


<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalQualitedHarga" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-large" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Penyesuaian Harga Kopra</h4>
			</div>
			<div class="modal-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Kualitet</th>
              <th>Harga Jadi</th>
              <th>Harga Patokan</th>
              <th>Harga Setengah Jadi</th>
              <th>Harga Transaksi</th>
              <th>Tanggal Berlaku</th>
              <th>Tanggal Berakhir</th>
            </tr>
          </thead>
          <tbody id="data_qualited_harga">
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

<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalTambahHarga" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-large" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Tambah Penyesuaian Harga Kopra</h4>
			</div>
			<div class="modal-body">
        <form action="javascript:download();" class="fDataHarga" id="fDataHarga" name="fDataHarga">
          <div class="row">
            <input autocomplete="off" class="form-control MATERIAL" id="MATERIAL" name="MATERIAL" placeholder="" value="14" type="hidden">
            <input autocomplete="off" class="form-control ID_SUPPLIER" id="ID_SUPPLIER" name="ID_SUPPLIER" placeholder="" type="hidden">

            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Kualitet</label>
                <input autocomplete="off" class="form-control QUALITED_HARGA_QUALITED" id="QUALITED_HARGA_QUALITED" name="QUALITED_HARGA_QUALITED" placeholder="" type="text">
								<p class="help-block QUALITED_WARNING text-danger"></p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Jadi</label>
                <input autocomplete="off" class="form-control HARGA_JADI" id="HARGA_JADI" name="HARGA_JADI" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Patokan</label>
                <input autocomplete="off" class="form-control HARGA_PATOKAN" id="HARGA_PATOKAN" name="HARGA_PATOKAN" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Setengah Jadi</label>
                <input autocomplete="off" class="form-control HARGA_SETENGAH_JADI" id="HARGA_SETENGAH_JADI" name="HARGA_SETENGAH_JADI" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Transaksi</label>
                <input autocomplete="off" class="form-control HARGA_TRANSAKSI" id="HARGA_TRANSAKSI" name="HARGA_TRANSAKSI" placeholder="" type="text">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal Berlaku</label>
                <input autocomplete="off" class="form-control datepicker QUALITED_HARGA_TANGGAL_BERLAKU" data-date-format="yyyy/mm/dd" id="QUALITED_HARGA_TANGGAL_BERLAKU" name="QUALITED_HARGA_TANGGAL_BERLAKU" type="text" value="">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal Berakhir</label>
              <input autocomplete="off" class="form-control datepicker QUALITED_HARGA_TANGGAL_BERAKHIR" data-date-format="yyyy/mm/dd" id="QUALITED_HARGA_TANGGAL_BERAKHIR" name="QUALITED_HARGA_TANGGAL_BERAKHIR" type="text" value="">
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
    						<button class="btn btn-success btn-sm FormKirimSimpanHarga">Simpan</button>
    					</div>
            </div>
          </div>
				</form>
		</div>
	</div>
</div>
</div>
<script>
function supplier_list(curPage)
{
  var url = window.location.href;
  var pageA = url.split("#");
  if (pageA[1] == undefined) {} else
  {
    var pageB = pageA[1].split("page-");
    if (pageB[1] == '')
    {
      var curPage = curPage;
    } else
    {
      var curPage = pageB[1];
    }
  }
  var filter = $("#form_filter").serialize();
  console.log(filter);
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=supplier_list&batas=' + $('input#REC_PER_HALAMAN').val() + '&material_id=14&halaman=' + curPage + '&keyword=' + $("input#keyword").val() + '&' + filter,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        $("tbody#zone_data").empty();
        $('#tujuan-light-pagination').pagination({
          pages: data.result_option.jml_halaman,
          cssStyle: 'light-theme',
          currentPage: curPage,
        });
        for (i = 0; i < data.result.length; i++)
        {
          console.log(data.result[i].STATUS_QUALITED)
          if (data.result[i].STATUS_QUALITED == 'EMPTY'){
            var tr = ""
            var material = "<select class='form-control MATERIAL' id='MATERIAL_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' id_personal='" + data.result[i].RMP_MASTER_PERSONAL_ID + "' name='MATERIAL_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' onchange='onchange_qualited(this)'><option value=''>-Pilih Material-</option></select>"
            var kualitet = "<input autocomplete='off' class='form-control QUALITED_HARGA_QUALITED_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' id='QUALITED_HARGA_QUALITED_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' name='QUALITED_HARGA_QUALITED_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' placeholder='' type='text'><p class='help-block QUALITED_WARNING_" + data.result[i].RMP_MASTER_PERSONAL_ID + " text-danger'></p>"
            var harga_jadi = "<input autocomplete='off' class='form-control HARGA_JADI_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' id='HARGA_JADI_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' name='HARGA_JADI_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' placeholder='' type='text'><p class='help-block" + data.result[i].RMP_MASTER_PERSONAL_ID + " text-danger'></p>"
            var harga_patokan = "<input autocomplete='off' class='form-control HARGA_PATOKAN_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' id='HARGA_PATOKAN_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' name='HARGA_PATOKAN_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' placeholder='' type='text'><p class='help-block" + data.result[i].RMP_MASTER_PERSONAL_ID + " text-danger'></p>"
            var harga_setengah_jadi = "<input autocomplete='off' class='form-control HARGA_SETENGAH_JADI_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' id='HARGA_SETENGAH_JADI_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' name='HARGA_SETENGAH_JADI_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' placeholder='' type='text'><p class='help-block" + data.result[i].RMP_MASTER_PERSONAL_ID + " text-danger'></p>"
            var harga_transaksi = "<input autocomplete='off' class='form-control HARGA_TRANSAKSI_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' id='HARGA_TRANSAKSI_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' name='HARGA_TRANSAKSI_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' placeholder='' type='text'><p class='help-block" + data.result[i].RMP_MASTER_PERSONAL_ID + " text-danger'></p>"
            var berlaku = "<input autocomplete='off' class='form-control datepicker QUALITED_HARGA_TANGGAL_BERLAKU_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' data-date-format='yyyy/mm/dd' id='QUALITED_HARGA_TANGGAL_BERLAKU_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' name='QUALITED_HARGA_TANGGAL_BERLAKU_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' type='text' value=''>"
            var berakhir = "<input autocomplete='off' class='form-control datepicker QUALITED_HARGA_TANGGAL_BERAKHIR_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' data-date-format='yyyy/mm/dd' id='QUALITED_HARGA_TANGGAL_BERAKHIR_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' name='QUALITED_HARGA_TANGGAL_BERAKHIR_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' type='text' value=''>"
            var btn = "<button class='btn btn-success simpan_harga btn-sm' ID_SUPPLIER='" + data.result[i].RMP_MASTER_PERSONAL_ID + "'><i class='fa fa-floppy-o' aria-hidden='true'></i></button>"
            var btn_add = ""

          }
          else {
            var tr = "success"
            var material = data.result[i].MATERIAL
            var kualitet = data.result[i].KUALITET
            var harga_jadi = data.result[i].HARGA_JADI
            var harga_patokan = data.result[i].HARGA_PATOKAN
            var harga_setengah_jadi = data.result[i].HARGA_SETENGAH_JADI
            var harga_transaksi = data.result[i].HARGA_TRANSAKSI
            var berlaku = data.result[i].TANGGAL_BERLAKU
            var berakhir = data.result[i].TANGGAL_BERAKHIR
            var btn = "<button class='btn btn-danger hapus_harga btn-sm' ID_KUALITET_HARGA='" + data.result[i].ID_PENYESUAIAN_HARGA + "'><i class='fa fa-trash' aria-hidden='true'></i></button>"
            var btn_add = "<button class='btn btn-primary tambah_harga btn-sm' SUPPLIER_ID='" + data.result[i].RMP_MASTER_PERSONAL_ID + "'><i class='fa fa-plus' aria-hidden='true'></i></button>"

          }

          var btn_list = "<button class='btn btn-default list_harga btn-sm' ID_SUPPLIER='" + data.result[i].RMP_MASTER_PERSONAL_ID + "'><i class='fa fa-list' aria-hidden='true'></i></button>"

          $("tbody#zone_data").append("<tr class='"+tr+"'  detailLogId='" + data.result[i].RMP_MASTER_PERSONAL_ID + "'>" +
          "<td >" + data.result[i].NO + ".</td>" +
          "<td>" + data.result[i].RMP_MASTER_PERSONAL_NAMA + "</td>" +
          "<td>" + data.result[i].MASTER_WILAYAH + "</td>" +
          "<td>" + data.result[i].RMP_MASTER_WILAYAH + "</td>" +
          "<td>" + kualitet + "</td>"+
          "<td>" + harga_jadi + "</td>"+
          "<td>" + harga_patokan + "</td>"+
          "<td>" + harga_setengah_jadi + "</td>"+
          "<td>" + harga_transaksi + "</td>"+
          "<td>" + berlaku + "</td>"+
          "<td>" + berakhir + "</td>"+
          "<td>" + btn + " " + btn_add + " " + btn_list + "</td>"+
          "</tr>");

        }
        var sel_material = function() {
          $.ajax({
            type: 'POST',
            url: refseeAPI,
            dataType: 'json',
            data: 'ref=sel_material',
            success: function(data) {
              if (data.respon.pesan == "sukses") {
                for (s = 0; s < data.result.length; s++) {
                  $("select.MATERIAL").append('<option value="' + data.result[s].RMP_MASTER_MATERIAL_ID + '" QUALITED="'+ data.result[s].RMP_MASTER_MATERIAL_QUALITED +'" >' + data.result[s].RMP_MASTER_MATERIAL + '</option>');
                }
              } else if (data.respon.pesan == "gagal") {
                console.log("Gagal Material");
              }
            },
            error: function(x, e) {
              console.log("Error Ajax Material");
            }
          });
        }
        var send = new sel_material();
        $(function()
        {
        	$(".datepicker").datepicker().on('changeDate', function(ev)
          {
        		$('.datepicker').datepicker('hide');
        	});
        });
      }
      else if (data.respon.pesan == "gagal")
      {
        $("tbody#zone_data").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e)
    {
    } //end error
  });
}
$(function()
{
  supplier_list('1');
});
$(window).on('hashchange', function(e)
 {
  supplier_list('1');
});
$("input#REC_PER_HALAMAN").on('change', function()
{
  supplier_list('1')
});

function search() {
  supplier_list('1');
}

$("tbody#zone_data").on('click', '.simpan_harga', function(){
  var id = $(this).attr('ID_SUPPLIER')
  var id_supplier = "ID_SUPPLIER=" + $(this).attr('ID_SUPPLIER') + ""
  var kualitet = "QUALITED_HARGA_QUALITED=" + $('.QUALITED_HARGA_QUALITED_'+id+'').val() + ""
  var harga_jadi = "HARGA_JADI=" + $('.HARGA_JADI_'+id+'').val() + ""
  var harga_patokan = "HARGA_PATOKAN=" + $('.HARGA_PATOKAN_'+id+'').val() + ""
  var harga_setengah_jadi = "HARGA_SETENGAH_JADI=" + $('.HARGA_SETENGAH_JADI_'+id+'').val() + ""
  var harga_transaksi = "HARGA_TRANSAKSI=" + $('.HARGA_TRANSAKSI_'+id+'').val() + ""
  var berlaku = "QUALITED_HARGA_TANGGAL_BERLAKU=" + $('.QUALITED_HARGA_TANGGAL_BERLAKU_'+id+'').val() + ""
  var berakhir = "QUALITED_HARGA_TANGGAL_BERAKHIR=" + $('.QUALITED_HARGA_TANGGAL_BERAKHIR_'+id+'').val() + ""
  var material = "MATERIAL=14"
  var form = "" + id_supplier + "&" + kualitet + "&" + harga_jadi + "&" + harga_patokan + "&" + harga_setengah_jadi + "&" + harga_transaksi + "&" + berlaku + "&" + berakhir + "&" + material + ""

  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=add_penyesuaian_harga&' + form ,
  	success: function(data) {
  		if (data.respon.pesan == "sukses")
  		{
  			console.log(data.respon.text_msg);
        supplier_list('1');
  		}
  		else if (data.respon.pesan == "gagal")
  		{
  			console.log(data.respon.text_msg);
  			alert("Gagal Menyimpan");
  		}
  	}, //end success
  	error: function(x, e)
    {
  		console.log("Error Ajax QUALITED");
  	} //end error
  });
  console.log(form);
})

$("tbody#zone_data").on('click', '.hapus_harga', function(){
  var id = $(this).attr("ID_KUALITET_HARGA")
  console.log(id)
  if(confirm('Apakah anda sudah yakin menghapus data ?')) {
		hapus_penyesuaian_harga(id)
	}
})

function hapus_penyesuaian_harga(id)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=hapus_penyesuaian_harga&ID=' + id ,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        supplier_list('1');
      }
      else if (data.respon.pesan == "gagal")
      {
        console.log(data.respon.text_msg);
        alert("Gagal Menghapus");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

$("tbody#zone_data").on('click', '.list_harga', function(){
  var id = $(this).attr("ID_SUPPLIER")
  console.log(id)
  $('.modalQualitedHarga').modal('show')
  qualited_harga_list(id)
})

function qualited_harga_list(id)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=penyesuaian_harga_list&ID_SUPPLIER=' + id,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log(data.respon.text_msg);
        $("tbody#data_qualited_harga").empty();
        for (i = 0; i < data.result.length; i++) {
          $("tbody#data_qualited_harga").append("<tr class='detailLogId'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_PENYESUAIAN_HARGA_KUALITET +  "</td>" +
					"<td>" + data.result[i].RMP_PENYESUAIAN_HARGA_JADI +  "</td>" +
					"<td>" + data.result[i].RMP_PENYESUAIAN_HARGA_PATOKAN +  "</td>" +
					"<td>" + data.result[i].RMP_PENYESUAIAN_HARGA_SETENGAH_JADI +  "</td>" +
					"<td>" + data.result[i].RMP_PENYESUAIAN_HARGA_TRANSAKSI +  "</td>" +
					"<td>" + data.result[i].TANGGAL_BERLAKU +  "</td>" +
					"<td>" + data.result[i].TANGGAL_BERAKHIR +  "</td>" +
          "</tr>");
        }
      } else if (data.respon.pesan == "gagal") {
        $("tbody#data_qualited_harga").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
    } //end error
  });
}

function onchange_qualited(att){
  var id = att.getAttribute('id_personal')
  console.log(id)
  var qualited = $("#MATERIAL_"+id+" option:selected").attr("QUALITED");
  console.log(qualited)
  if (qualited == 'ALLOW')
  {
    $('.QUALITED_HARGA_QUALITED_'+id+'').attr('readonly', false);
    $('.QUALITED_HARGA_QUALITED_'+id+'').val('');
    $('p.QUALITED_WARNING_'+id+'').html('');
  }
  else if(qualited == 0)
  {
    $('.QUALITED_HARGA_QUALITED_'+id+'').attr('readonly', true);
    $('.QUALITED_HARGA_QUALITED_'+id+'').val('');
    $('p.QUALITED_WARNING_'+id+'').html('Tidak diizinkan untuk material ini.');
    $('p.QUALITED_WARNING_'+id+'').attr('style',  'color:red');
  }
  else {
    $('.QUALITED_HARGA_QUALITED_'+id+'').attr('readonly', true);
    $('.QUALITED_HARGA_QUALITED_'+id+'').val('');
    $('p.QUALITED_WARNING_'+id+'').html('Tidak diizinkan untuk material ini.');
    $('p.QUALITED_WARNING_'+id+'').attr('style',  'color:red');
  }
}

$("tbody#zone_data").on('click', '.tambah_harga', function(){
  var id = $(this).attr("SUPPLIER_ID")
  console.log(id)
  $('.ID_SUPPLIER').val(id)
  $(".modalTambahHarga").modal('show');
})

$(".FormKirimSimpanHarga").on('click', function(){
var form = $("#fDataHarga").serialize();
console.log(form)
  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=add_penyesuaian_harga&' + form ,
  	success: function(data) {
  		if (data.respon.pesan == "sukses")
  		{
        $(".modalTambahHarga").modal('hide');
  			alert("Penyesuaian Harga Tersimpan")

        supplier_list('1');
  		}
  		else if (data.respon.pesan == "gagal")
  		{
  			console.log(data.respon.text_msg);
  			alert("Gagal Menyimpan");
  		}
  	}, //end success
  	error: function(x, e)
    {
  		console.log("Error Ajax QUALITED");
  	} //end error
  });
})
</script>
