<?php
$RMP_CONFIG=new RMP_CONFIG();
$SISTEM_CONFIG=new SISTEM_CONFIG();
$buat_nomor_faktur=$RMP_CONFIG->buat_nomor_faktur()->callback['nomor'];
 ?>

 <style>
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
			<div class="list-group-item">
				<div class="row">
					<div class="col-md-8">
						<h3><i class="fa fa-sticky-note-o"></i> Faktur</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right"></div>
				</div><!--/.row-->
        <div class="box box-primary form_faktur" hidden>
        <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-credit-card" aria-hidden="true"></i> Buat Faktur</h3>
        </div>
        <div class="box-body">
          <form action="?show=/upload/local_dir/" method="POST" enctype="multipart/form-data" class="formPersonal" id="formPersonal" name="formPersonal">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">No Faktur</label>
                  <p class="NO_FAKTUR"><?php echo $buat_nomor_faktur; ?></p>
                  <input autocomplete="off" class="form-control ID_FAKTUR" id="ID_FAKTUR" name="ID_FAKTUR" placeholder="ID_FAKTUR" type="hidden" >
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">No Nota</label>
                  <p class="NO_NOTA_INPUT"></p>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>
                  <p class="NAMA"></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Alamat</label>
                  <p class="ALAMAT"></p>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Kapal</label>
                  <p class="KAPAL"></p>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Potongan</label>
                  <input autocomplete="off" class="form-control POTONGAN" id="POTONGAN" name="POTONGAN" placeholder="POTONGAN" type="text">
                </div>
              </div>
              <div class="col-md-4">

                <div class="form-group">
                  <label for="exampleInputEmail1">Total Timbangan</label>
                  <p class="total_timbang" style="font-size:40px">0</p>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <table class="table">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Tanggal / Jam</th>
                    <th>Berat (Kg)</th>
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
            </div>
            <div class="row text-right">
              <a class="btn btn-default btn_cetak_faktur" style="display:none;">Cetak</a>
              <button type="button" class="btn btn-success simpan_faktur">Simpan Faktur</button>
            </div>
            </form>
        </div>
        <!-- /.box-body -->
        </div>

        <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-balance-scale" aria-hidden="true"></i> Hasil Timbang</h3>
      </div>
      <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Nomor Nota</label>
                <select name="NO_NOTA" id="NO_NOTA" class="NO_NOTA selectpicker with-ajax-personal form-control"  onchange="no_nota()" data-live-search="true">
    						</select>
                <p class="help-block">Pilih Nomor Nota.</p>
              </div>
            </div>
            <div class="col-md-6" hidden>
              <div class="form-group">
    						<label for="TANGGAL">Tanggal</label>
                <input autocomplete="off" class="form-control TANGGAL_NOTA datepicker" id="TANGGAL_NOTA" name="TANGGAL_NOTA" placeholder="TANGGAL" value="<?php echo date("Y/m/d"); ?>" type="text" onchange="onchange_pilih_nota()"> <small class="help-block">Tanggal No Nota</small>
    					</div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <table class="table">
                <thead>
  								<tr>
  									<th>No.</th>
  									<th>Tanggal / Jam</th>
  									<th>Berat (Kg)</th>
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
          <div class="row text-right">
            <a class="btn btn-success buat_faktur">Buat Faktur</a>
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
    $('div.form_faktur').toggle('hidden')
    $('.NO_FAKTUR').val('<?= $buat_nomor_faktur;  ?>')

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
            text: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
            value: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
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
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=hasil_timbang_list&NO_NOTA='+no_nota,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        $("tbody#zone_data").empty();
        for (i = 0; i < data.result.length; i++)
        {
          $('p.NAMA').html(data.result[i].RMP_MASTER_PERSONAL_NAMA)
          $('p.NAMA').html(data.result[i].RMP_MASTER_PERSONAL_NAMA)
          $('p.TANGGAL').html(data.result[i].RMP_HASIL_TIMBANG_TANGGAL)
          $('p.KAPAL').html(data.result[i].RMP_HASIL_TIMBANG_KAPAL)
          $('p.NO_NOTA_INPUT').html(data.result[i].RMP_HASIL_TIMBANG_NO_NOTA)
          $('p.ALAMAT').html(data.result[i].RMP_MASTER_WILAYAH)

          if(data.result[i].HRECORDSTATUS == 'R')
          {
            var a = ""
          }
          else
          {
            var a = "<a class='btn btn-default btn-sm kirim_hasil_timbang' ID_HASIL_TIMBANG='" + data.result[i].RMP_HASIL_TIMBANG_ID +  "' NO_NOTA='" + data.result[i].RMP_HASIL_TIMBANG_NO_NOTA +  "'><i aria-hidden='true' class='fa fa-external-link'></i></a>"
          }

          $("tbody#zone_data").append("<tr class='default'  detailLogId='" + data.result[i].ICD_BARANG_KODE_INVENTORI + "'>" +
            "<td >" + data.result[i].NO + ".</td>" +
            "<td>" + data.result[i].RMP_HASIL_TIMBANG_TANGGAL + "</td>" +
            "<td>" + data.result[i].RMP_HASIL_TIMBANG_KG + "</td>" +
            "<td></td>" +
            "<td></td>" +
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
  var id_timbang = $(this).attr('ID_HASIL_TIMBANG');
  var no_nota = $(this).attr('NO_NOTA');
  var no_faktur = $('.NO_FAKTUR').val();
  var data = 'ID_TIMBANG='+id_timbang+'&NO_NOTA='+no_nota+'&NO_FAKTUR='+no_faktur;;
  console.log(data)
  if(no_faktur == "")
  {
    alert('Buat Faktur Terlebih Dahulu')
  }
  else
  {
    kirim_hasil_timbang(data)

    var no_nota = $('.NO_NOTA').val();
    hasil_timbang(no_nota);

    var no_faktur = $('.NO_FAKTUR').val()
    faktur_list(no_faktur);
  }

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
          if(data.result[i].FRECORDSTATUS == 'A')
          {
            var a = ""
          }
          else
          {
            var a = "<a class='btn btn-default btn-sm kembali_hasil_timbang' ID_HASIL_TIMBANG='" + data.result[i].RMP_HASIL_TIMBANG_ID +  "' NO_NOTA='" + data.result[i].RMP_HASIL_TIMBANG_NO_NOTA +  "' ><i aria-hidden='true' class='fa fa-external-link'></i></a>"
          }
          $("tbody#zone_data_faktur").append("<tr class='default'  detailLogId='" + data.result[i].ICD_BARANG_KODE_INVENTORI + "'>" +
            "<td >" + data.result[i].NO + ".</td>" +
            "<td>" + data.result[i].RMP_HASIL_TIMBANG_TANGGAL + "</td>" +
            "<td>" + data.result[i].RMP_HASIL_TIMBANG_KG + "</td>" +
            "<td></td>" +
            "<td></td>" +
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

function simpan_faktur(no_faktur)
{
  var potongan = $('.POTONGAN').val()
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=simpan_faktur&NO_FAKTUR=' + no_faktur + '&POTONGAN=' + potongan ,
    success: function(data)
    {
      if (data.respon.pesan == "sukses")
      {
        $('.btn_cetak_faktur').removeAttr('style');
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
  console.log("Tersimpan")
  var no_faktur = $('.NO_FAKTUR').text();
  simpan_faktur(no_faktur);
  faktur_list(no_faktur);
  }
})

$('.btn_cetak_faktur').on('click', function()
{
  var id_faktur = $('.ID_FAKTUR').val();
  window.open('?show=rmp/pdf/cetak_faktur/' + id_faktur + '', '_blank');
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
    var no_nota = $('.NO_NOTA').val();
    hasil_timbang(no_nota);
    var no_faktur = $('.NO_FAKTUR').text()
    faktur_list(no_faktur);
  }
})
</script>
