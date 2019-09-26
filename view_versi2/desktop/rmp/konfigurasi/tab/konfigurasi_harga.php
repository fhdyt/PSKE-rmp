<?php
$RMP_CONFIG=new RMP_CONFIG();
$SISTEM_CONFIG=new SISTEM_CONFIG();
 ?>
<style>
.modalMD {
  width: 1000px;
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
table{
font-size: 12px;
}

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
</style>
<a class="btn btn-primary btn-sm tambah_material">Tambah Harga</a> <!-- <button class="btn btn-primary btn-sm tambah" type="button"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Inventori</button> -->
<table class="table table-hover">
  <thead>
    <tr>
      <th>No.</th>
      <th>Material</th>
      <th>Wilayah</th>
      <th>Lokasi</th>
      <th>Jenis Supplier</th>
      <th>Kualitet</th>
      <th>Harga</th>
      <th>Berlaku</th>
      <th>Berakhir</th>
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
<label>Jumlah Baris Per Halaman</label> <input class="form-control" id="REC_PER_HALAMAN" max='1000' min="1" name="REC_PER_HALAMAN" required="" type="number" value="10">
</div>
</div><!--/row-->
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalJenisMaterial" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content ">
			<div class="modal-header ">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Jenis Material</h4>
			</div>
			<div class="modal-body ">
				<form action="javascript:download();" class="fDataHarga" id="fDataHarga" name="fDataHarga">
					<div class="row">

            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Material</label>
                <select class="form-control QUALITED_JENIS_MATERIAL" id="QUALITED_JENIS_MATERIAL" name="QUALITED_JENIS_MATERIAL" onchange="onchange_qualited()">
									<option value="">
										--Pilih Material--
									</option><?php  $data = $RMP_CONFIG->material(); foreach ($data['rasult'] as $key => $value) {   foreach ($value as $data => $isi)       { ?>
									<option value="<?php echo $isi['RMP_MASTER_MATERIAL_ID']; ?>" QUALITED="<?php echo $isi['RMP_MASTER_MATERIAL_QUALITED']; ?>">
										<?php  echo $isi['RMP_MASTER_MATERIAL'];?>
									</option><?php   }}      ?>
								</select>
								<p class="help-block"></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Wilayah</label>
                <select id="WILAYAH_SUPPLIER" name="WILAYAH_SUPPLIER" type="text" class="col-sm-2 form-control WILAYAH_SUPPLIER"  autocomplete="off" onchange="wilayah_supplier()">
                  <option value="">--Pilih Wilayah--</option>
                  <?php
                  $params = $id_supplier[0]['RMP_MASTER_PERSONAL_ID'];
                  $data = $RMP_CONFIG->wilayah($params);
                  foreach ($data['rasult'] as $key => $value) {
                    foreach ($value as $data => $isi) {
                      if($id_supplier[0]['RMP_MASTER_WILAYAH_KODE']==$isi['RMP_MASTER_WILAYAH_KODE'])
                      {
                        $sel="selected";
                      }
                      else
                        {
                          $sel="";
                        }
          ?>
          <option value="<?php echo $isi['RMP_MASTER_WILAYAH_ID']; ?>" <?php echo $sel; ?> > <?php  echo $isi['RMP_MASTER_WILAYAH'];?></option>
          <?php

        }

      }?>
                </select>
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Sub Wilayah</label>
                <select id="SUB_WILAYAH_SUPPLIER" name="SUB_WILAYAH_SUPPLIER" type="text" class="col-sm-2 form-control SUB_WILAYAH_SUPPLIER"  autocomplete="off">
                  <option value="">--Pilih Wilayah--</option>
                      </select>
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
            </div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Jenis Supplier</label>
                <select class="form-control JENIS_SUPPLIER" id="JENIS_SUPPLIER" name="JENIS_SUPPLIER" onchange="provinsi_keluarga()">
                  <option value="">
                    --Pilih Status--
                  </option>
                <?php foreach($RMP_CONFIG->user()->jenis_supplier as $key=>$val){ echo"<option value='$key' >$val</option>"; } ?>
                </select>
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Kualitet</label>
                <input autocomplete="off" class="form-control QUALITED_HARGA_QUALITED" id="QUALITED_HARGA_QUALITED" name="QUALITED_HARGA_QUALITED" placeholder="" type="text">
								<p class="help-block QUALITED_WARNING text-danger"></p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga</label>
                <input autocomplete="off" class="form-control KONFIGURASI_HARGA" id="KONFIGURASI_HARGA" name="KONFIGURASI_HARGA" type="text" value="">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal Berlaku</label>
                <input autocomplete="off" class="form-control datepicker HARGA_TANGGAL_BERLAKU" data-date-format="yyyy/mm/dd" id="HARGA_TANGGAL_BERLAKU" name="HARGA_TANGGAL_BERLAKU" type="text" value="">
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal Berakhir</label>
              <input autocomplete="off" class="form-control datepicker HARGA_TANGGAL_BERAKHIR" data-date-format="yyyy/mm/dd" id="HARGA_TANGGAL_BERAKHIR" name="HARGA_TANGGAL_BERAKHIR" type="text" value="">
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
    						<button class="btn btn-success btn-sm FormKirimHarga">Simpan</button> <button class="btn btn-default btn-sm BatalJenisMaterial">Batal</button>
    					</div>
            </div>
          </div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
$(function() {
	$(".datepicker").datepicker().on('changeDate', function(ev) {
		$('.datepicker').datepicker('hide');
	});
});

$('.tambah_material').on('click', function()
{
	$(".modalJenisMaterial").modal('show');
});
$('.BatalJenisMaterial').on('click', function()
{
	$(".modalJenisMaterial").modal('hide');
});

var SUB_WILAYAH = function() {
  var WILAYAH = $('select.WILAYAH_SUPPLIER').val();
  console.log(WILAYAH);
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=sub_wilayah&WILAYAH=' + WILAYAH,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        console.log("Sukses");
        $('select.SUB_WILAYAH_SUPPLIER').empty();
        for (s = 0; s < data.result.length; s++) {
          //'console.info(data.result[s].INDONESIA_DESA);
          $('select.SUB_WILAYAH_SUPPLIER').append('<option value="' + data.result[s].RMP_MASTER_WILAYAH_KODE + '">' + data.result[s].RMP_MASTER_WILAYAH + '</option>');
        }
      } else if (data.respon.pesan == "gagal") {
        console.log(data.respon.text_msg);
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

function wilayah_supplier() {
  console.log("ONCHANGE")
  var send = new SUB_WILAYAH();
};


function harga_list(curPage)
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
    data: 'ref=konfigurasi_harga_list&batas=' + $('input#REC_PER_HALAMAN').val() + '&halaman=' + curPage + '&keyword=' + $("input#keyword").val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log("Sukses");
        $("tbody#zone_data").empty();
        $('#tujuan-light-pagination').pagination({
          pages: data.result_option.jml_halaman,
          cssStyle: 'light-theme',
          currentPage: curPage,
        });
        for (i = 0; i < data.result.length; i++) {
          $("tbody#zone_data").append("<tr class='detailLogId'  >" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_MASTER_MATERIAL + "</td>" +
					"<td>" + data.result[i].MASTER_WILAYAH + "</td>" +
          "<td>" + data.result[i].RMP_MASTER_WILAYAH + "</td>" +
					"<td>" + data.result[i].RMP_KONFIGURASI_HARGA_JENIS_SUPPLIER + "</td>" +
					"<td>" + data.result[i].RMP_KONFIGURASI_HARGA_KUALITET + "</td>" +
					"<td>" + data.result[i].RMP_KONFIGURASI_HARGA_HARGA + "</td>" +
					"<td>" + data.result[i].TANGGAL_BERLAKU + "</td>" +
					"<td>" + data.result[i].TANGGAL_BERAKHIR + "</td>" +

          "</tr>");
					}
      } else if (data.respon.pesan == "gagal") {
        console.log("Gagal");
        $("tbody#zone_data").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

$(function() {
  console.log("function");
  harga_list('1');
});
$(window).on('hashchange', function(e) {
  harga_list('1');
});
$("input#REC_PER_HALAMAN").on('change', function() {
  harga_list('1')
});

function search() {
  harga_list('1');
}

function onchange_qualited(){
  var qualited = $("#QUALITED_JENIS_MATERIAL option:selected").attr("QUALITED");
  console.log(qualited);
  if (qualited == 'ALLOW')
  {
    $('.QUALITED_HARGA_QUALITED').attr('readonly', false);
    $('.QUALITED_HARGA_QUALITED').val('');
    $('p.QUALITED_WARNING').html('');
  }
  else if(qualited == 0)
  {
    $('.QUALITED_HARGA_QUALITED').attr('readonly', true);
    $('.QUALITED_HARGA_QUALITED').val('');
    $('p.QUALITED_WARNING').html('Tidak diizinkan untuk material ini.');
    $('p.QUALITED_WARNING').attr('style',  'color:red');
  }
  else {
    $('.QUALITED_HARGA_QUALITED').attr('readonly', true);
    $('.QUALITED_HARGA_QUALITED').val('');
    $('p.QUALITED_WARNING').html('Tidak diizinkan untuk material ini.');
    $('p.QUALITED_WARNING').attr('style',  'color:red');
  }
}

var SUB_WILAYAH = function()
{
  var WILAYAH = $('select.WILAYAH_SUPPLIER').val();
  console.log(WILAYAH);
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=sub_wilayah&WILAYAH=' + WILAYAH,
    success: function(data)
    {
      if (data.respon.pesan == "sukses")
      {
        console.log("Sukses");
        $('select.SUB_WILAYAH_SUPPLIER').empty();
        for (s = 0; s < data.result.length; s++)
        {
          //'console.info(data.result[s].INDONESIA_DESA);
          $('select.SUB_WILAYAH_SUPPLIER').append('<option value="' + data.result[s].RMP_MASTER_WILAYAH_ID + '" KODE_WILAYAH="' + data.result[s].RMP_MASTER_WILAYAH_KODE + '">' + data.result[s].RMP_MASTER_WILAYAH + '</option>');
        }
      } else if (data.respon.pesan == "gagal")
      {
        console.log(data.respon.text_msg);
      }
    }, //end success
    error: function(x, e)
    {
      console.log("Error Ajax");
    } //end error
  });
}

function wilayah_supplier()
{
  console.log("ONCHANGE")
  var send = new SUB_WILAYAH();
};


$('.FormKirimHarga').on('click',function(){
var formharga = $('form.fDataHarga').serialize();
console.log(formharga);

$.ajax({
	type: 'POST',
	url: refseeAPI,
	dataType: 'json',
	data: 'ref=konfigurasi_add_harga&' + formharga ,
	success: function(data) {
		if (data.respon.pesan == "sukses")
		{
			console.log(data.respon.text_msg);
			//window.location.href = "?show=rmp/supplier/MASTER_PERSONAL";
      	$(".modalJenisMaterial").modal('hide');
        harga_list('1');
		}
		else if (data.respon.pesan == "gagal")
		{
			console.log(data.respon.text_msg);
			alert("Gagal Menyimpan");
		}
	}, //end success
	error: function(x, e) {
		console.log("Error Ajax");
	} //end error
});
})
</script>
