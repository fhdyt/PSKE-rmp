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
						<h3><i class="fa fa-calculator"></i> Kelapa Bulat</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right">

            <!-- <form class="form-inline"action="javascript:rekap_perminggu();">
              <div class="form-group">
                <input autocomplete="off" class="form-control tanggal_berlaku datepicker" data-date-format="yyyy/mm/dd" type="text" value="">
                <p class="help-block">Isi sesuai kartu identitas anda.</p>
              </div>
              <button class="btn btn-success btn-view btn-reload set_tanggal" type="submit" id="btn-reload">
                <i class="fa fa-refresh">
                </i></button>
            </form> -->
          </div>
				</div><!--/.row-->

        <div class="row">
          <div class="col-md-9">
          </div>
          <div class="col-md-3">
            <div class="input-group">
            <input type="text" class="form-control tanggal_berlaku datepicker" data-date-format="yyyy/mm/dd" placeholder="yyyy/mm/dd">
            <span class="input-group-btn">
              <button class="btn btn-success btn-view btn-reload set_tanggal" type="submit" id="btn-reload">
                <i class="fa fa-refresh">
                </i></button>
            </span>
            </div><!-- /input-group -->
          </div>
        </div>
      <br>
        <div class="row">
          <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No.</th>
                  <th style="padding-right:100px;">No Rekening</th>
                  <th style="padding-right:100px;">Nama</th>
                  <th style="padding-right:100px;">Wilayah</th>
                  <th style="padding-right:100px;">Lokasi</th>
                  <th style="padding-right:100px;">Harga A</th>
                  <th style="padding-right:100px;">Harga B</th>
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
				<h4 class="modal-title" id="myModalLabel">Penyesuaian Harga Kelapa Bulat</h4>
			</div>
			<div class="modal-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Harga Patokan A</th>
              <th>Harga Patokan B</th>
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
				<h4 class="modal-title" id="myModalLabel">Tambah Penyesuaian Harga Kelapa Bulat</h4>
			</div>
			<div class="modal-body">
        <form action="javascript:download();" class="fDataHarga" id="fDataHarga" name="fDataHarga">
          <div class="row">
            <input autocomplete="off" class="form-control MATERIAL" id="MATERIAL" name="MATERIAL" placeholder="" value="13" type="hidden">
            <input autocomplete="off" class="form-control JENIS_MATERIAL" id="JENIS_MATERIAL" name="JENIS_MATERIAL" placeholder="" value="KELAPA BULAT" type="hidden">
            <input autocomplete="off" class="form-control ID_SUPPLIER" id="ID_SUPPLIER" name="ID_SUPPLIER" placeholder="" type="hidden">

            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Patokan A</label>
                <input autocomplete="off" class="form-control HARGA_PATOKAN_A" id="HARGA_PATOKAN_A" name="HARGA_PATOKAN_A" placeholder="" type="text">
								<p class="help-block QUALITED_WARNING text-danger"></p>
							</div>
						</div>
            <div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Patokan B</label>
                <input autocomplete="off" class="form-control HARGA_PATOKAN_B" id="HARGA_PATOKAN_B" name="HARGA_PATOKAN_B" placeholder="" type="text">
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
$('.set_tanggal').on('click', function(){
  var tanggal_berlaku = $('.tanggal_berlaku').val()
  $('.set_tanggal_berlaku').val(tanggal_berlaku)
})
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
    data: 'ref=supplier_list_kb&batas=' + $('input#REC_PER_HALAMAN').val() + '&material_id=13&jenis_material=KELAPA BULAT&halaman=' + curPage + '&keyword=' + $("input#keyword").val() + '&' + filter,
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
            var harga_patokan_a = "<input autocomplete='off' class='form-control HARGA_PATOKAN_A_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' id='HARGA_PATOKAN_A_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' name='HARGA_PATOKAN_A_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' placeholder='' type='text'><p class='help-block" + data.result[i].RMP_MASTER_PERSONAL_ID + " text-danger'></p>"
            var harga_patokan_b = "<input autocomplete='off' class='form-control HARGA_PATOKAN_B_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' id='HARGA_PATOKAN_B_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' name='HARGA_PATOKAN_B_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' placeholder='' type='text'><p class='help-block" + data.result[i].RMP_MASTER_PERSONAL_ID + " text-danger'></p>"
            var berlaku = "<input autocomplete='off' class='form-control set_tanggal_berlaku datepicker QUALITED_HARGA_TANGGAL_BERLAKU_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' data-date-format='yyyy/mm/dd' id='QUALITED_HARGA_TANGGAL_BERLAKU_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' name='QUALITED_HARGA_TANGGAL_BERLAKU_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' type='text' value=''>"
            var berakhir = "<input autocomplete='off' class='form-control datepicker QUALITED_HARGA_TANGGAL_BERAKHIR_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' data-date-format='yyyy/mm/dd' id='QUALITED_HARGA_TANGGAL_BERAKHIR_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' name='QUALITED_HARGA_TANGGAL_BERAKHIR_" + data.result[i].RMP_MASTER_PERSONAL_ID + "' type='text' value=''>"
            var btn = "<button class='btn btn-success simpan_harga btn-sm' ID_SUPPLIER='" + data.result[i].RMP_MASTER_PERSONAL_ID + "'><i class='fa fa-floppy-o' aria-hidden='true'></i></button>"
            var btn_add = ""
          }
          else {
            var tr = "success"
            var harga_patokan_a = data.result[i].HARGA_A
            var harga_patokan_b = data.result[i].HARGA_B
            var berlaku = data.result[i].TANGGAL_BERLAKU
            var berakhir = data.result[i].TANGGAL_BERAKHIR
            var btn = "<button class='btn btn-danger hapus_harga btn-sm' ID_KUALITET_HARGA='" + data.result[i].ID_PENYESUAIAN_HARGA + "'><i class='fa fa-trash' aria-hidden='true'></i></button>"
            var btn_add = "<button class='btn btn-primary tambah_harga btn-sm' SUPPLIER_ID='" + data.result[i].RMP_MASTER_PERSONAL_ID + "'><i class='fa fa-plus' aria-hidden='true'></i></button>"

          }

          var btn_list = "<button class='btn btn-default list_harga btn-sm' ID_SUPPLIER='" + data.result[i].RMP_MASTER_PERSONAL_ID + "'><i class='fa fa-list' aria-hidden='true'></i></button>"

          $("tbody#zone_data").append("<tr class='"+tr+"'  detailLogId='" + data.result[i].RMP_MASTER_PERSONAL_ID + "'>" +
          "<td >" + data.result[i].NO + ".</td>" +
          "<td>" + data.result[i].RMP_REKENING_RELASI + "</td>" +
          "<td>" + data.result[i].RMP_MASTER_PERSONAL_NAMA + "</td>" +
          "<td>" + data.result[i].MASTER_WILAYAH + "</td>" +
          "<td>" + data.result[i].RMP_MASTER_WILAYAH + "</td>" +
          "<td>" + harga_patokan_a + "</td>"+
          "<td>" + harga_patokan_b + "</td>"+
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
  var harga_patokan_a = "HARGA_PATOKAN_A=" + $('.HARGA_PATOKAN_A_'+id+'').val() + ""
  var harga_patokan_b = "HARGA_PATOKAN_B=" + $('.HARGA_PATOKAN_B_'+id+'').val() + ""
  var berlaku = "QUALITED_HARGA_TANGGAL_BERLAKU=" + $('.QUALITED_HARGA_TANGGAL_BERLAKU_'+id+'').val() + ""
  var berakhir = "QUALITED_HARGA_TANGGAL_BERAKHIR=" + $('.QUALITED_HARGA_TANGGAL_BERAKHIR_'+id+'').val() + ""
  var material = "MATERIAL=13"
  var jenis_material = "JENIS_MATERIAL=KELAPA BULAT"
  var form = "" + id_supplier + "&" + harga_patokan_a + "&" + harga_patokan_b + "&" + berlaku + "&" + berakhir + "&" + material + "&" + jenis_material + ""
  console.log(form)
  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=add_penyesuaian_harga_kb&' + form ,
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
    data: 'ref=hapus_penyesuaian_harga_gl&ID=' + id ,
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
  var material = "MATERIAL=13"
  var jenis_material = "JENIS_MATERIAL=KELAPA BULAT"
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=penyesuaian_harga_kb_list&ID_SUPPLIER=' + id + "&" + material + "&" + jenis_material + "",
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log(data.respon.text_msg);
        $("tbody#data_qualited_harga").empty();
        for (i = 0; i < data.result.length; i++) {
          $("tbody#data_qualited_harga").append("<tr class='detailLogId'>" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_PENYESUAIAN_HARGA_KB_A +  "</td>" +
					"<td>" + data.result[i].RMP_PENYESUAIAN_HARGA_KB_B +  "</td>" +
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
  	data: 'ref=add_penyesuaian_harga_kb&' + form ,
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
