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
						<h3><i class="fa fa-newspaper-o"></i> Pengambilan / Penyetoran</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right">

          </div>
				</div><!--/.row-->
        <div class="row">
            <form action="javascript:download();" class="fDataAmbilSetor" id="fDataAmbilSetor" name="fDataManualNota">
                <div class="col-md-4">
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI ">Tanggal</label>
                 <input autocomplete="off" class="form-control TANGGAL datepicker" id="TANGGAL" name="TANGGAL" placeholder="" type="text" value="<?php echo date("Y/m/d"); ?>" onchange="pilih_supplier()">
               </div>
               </div>
                <div class="col-md-4">
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI ">Jenis</label>
                 <select class="form-control JENIS_PEMBAYARAN" id="JENIS_PEMBAYARAN" name="JENIS_PEMBAYARAN" onchange="pilih_supplier()">
                     <option value="KREDIT" >KREDIT</option>
                     <option value="DEBET">DEBET</option>
                 </select>
               </div>
               </div>
                <div class="col-md-4">
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI ">Nomor Bukti</label>
                 <input autocomplete="off" class="form-control NOMOR" id="NOMOR" name="NOMOR" placeholder="" type="text">
               </div>
               </div>
               </div>
               <div class="row">
                <div class="col-md-4">
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI ">Material</label>
                 <select class="form-control JENIS_MATERIAL" id="JENIS_MATERIAL" name="JENIS_MATERIAL" onchange="pilih_material()">
                     <option value="" >--Pilih Material--</option>
                     <option value="KOPRA" nama_material="KOPRA">KOPRA</option>
                     <option value="JAMBUL" nama_material="JAMBUL">JAMBUL</option>
                     <option value="GELONDONG" nama_material="GELONDONG">GELONDONG</option>
                 </select>
               </div>
               </div>
                <div class="col-md-4">
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI ">Supplier</label>
                 <select class="form-control NAMA_SUPPLIER" style="width: 100%;" aria-hidden="true" id="NAMA_SUPPLIER" name="NAMA_SUPPLIER" onchange="pilih_supplier()">
                   <option value="">--Pilih Material Terlebih Dahulu--</option>
                 </select>
               </div>
               </div>
                <div class="col-md-4">
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI ">Nomor Rekening</label>
                 <input autocomplete="off" class="form-control NOMOR_REKENING" id="NOMOR_REKENING" name="NOMOR_REKENING" placeholder="" type="text" readonly>
                 <input autocomplete="off" class="form-control NAMA" id="NAMA" name="NAMA" placeholder="" type="hidden" readonly>
               </div>
               </div>
             </div>
             <div class="row">
                <div class="col-md-4">
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI ">Rupiah</label>
                 <input autocomplete="off" class="form-control RUPIAH" id="RUPIAH" name="RUPIAH" placeholder="" type="number">
             </div>
             </div>
              <div class="col-md-4">
               <div class="form-group">
                 <label class="ICD_TRANSAKSI_INVENTORI_LOKASI ">Keterangan</label>
                 <input autocomplete="off" class="form-control KETERANGAN" id="KETERANGAN" name="KETERANGAN" placeholder="" type="text">
             </div>
             </div>
             </form>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
             <button class="btn btn-success SIMPAN_BTN">Simpan</button>
           </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Rekening</th>
                  <th>Nomor Bukti</th>
                  <th>Tanggal</th>
                  <th>Jenis</th>
                  <th>Rupiah</th>
                  <th>Keterangan</th>
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
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(function()
{
  $("tbody#ms_zone_data").html("<tr><td colspan='9'><div class='alert alert-success' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Silahkan Pilih <b>Jenis Pembayaran, Material, dan Supplier</b> terlebih dahulu.</div></td></tr>");
  $('.select2').select2()
	$(".datepicker").datepicker().on('changeDate', function(ev)
	{
		$('.datepicker').datepicker('hide');
	});



});

function sel_nama_supplier_rekening()
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=sel_nama_supplier_ambil_setor&material='+$(".JENIS_MATERIAL").val(),
    success: function(data) {
      $("select.NAMA_SUPPLIER").empty()
      if (data.respon.pesan == "sukses") {
        console.log(data.result)
      $("select.NAMA_SUPPLIER").append("<option value=''>--Pilih Supplier--</option>");
        for (i = 0; i < data.result.length; i++) {
        $("select.NAMA_SUPPLIER").append("<option value='"+ data.result[i].RMP_MASTER_PERSONAL_ID +"' rekening='"+ data.result[i].RMP_REKENING_RELASI +"' nama='"+ data.result[i].RMP_MASTER_PERSONAL_NAMA +"' >"+ data.result[i].RMP_MASTER_PERSONAL_NAMA +"</option>");
        }
      } else if (data.respon.pesan == "gagal") {
        console.log(data.respon.text_msg)
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

function pilih_material(){
  sel_nama_supplier_rekening()
}
function pilih_supplier(){
  var rekening = $('.NAMA_SUPPLIER option:selected').attr('rekening')
  $(".NOMOR_REKENING").val(rekening)
  $(".NAMA").val($('.NAMA_SUPPLIER option:selected').attr('nama'))
  list_ambil_setor(rekening)
}


function list_ambil_setor(rekening)
{
  console.log(rekening)
  $("tbody#ms_zone_data").html("<tr><td colspan='20'><center><div class='loader'></div></center></td></tr>")
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=list_ambil_setor&rekening='+rekening+'&tanggal='+$(".TANGGAL").val()+'&jenis='+$(".JENIS_PEMBAYARAN").val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        $("tbody#ms_zone_data").empty();
        //console.log(data.respon.text_msg)
        for (i = 0; i < data.result.length; i++) {
          // no_rekening_supplier.innerText = data.result[0].KodeSup
          // nama_supplier.innerText = data.result[0].NAMA_SUPPLIER
          $("tbody#ms_zone_data").append("<tr >" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td >" + data.result[i].RMP_AMBIL_SETOR_REKENING + "</td>" +
					"<td >" + data.result[i].RMP_AMBIL_SETOR_NO + "</td>" +
					"<td >" + data.result[i].TANGGAL + "</td>" +
					"<td >" + data.result[i].RMP_AMBIL_SETOR_JENIS + "</td>" +
					"<td >" + data.result[i].RMP_AMBIL_SETOR_RUPIAH + "</td>" +
					"<td >" + data.result[i].RMP_AMBIL_SETOR_KETERANGAN + "</td>" +
          "<td><a class='btn btn-danger btn-xs hapus_btn' id='"+data.result[i].RMP_AMBIL_SETOR_ID+"'><span class='fa fa-trash' aria-hidden='true'></span></a></td>" +
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


$(".SIMPAN_BTN").on("click", function(){
  $(this).attr("disabled", true)
  $("tbody#ms_zone_data").html("<tr><td colspan='20'><center><div class='loader'></div></center></td></tr>")
  var fData = $('.fDataAmbilSetor').serialize();
  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=kirim_ambil_setor&' + fData ,
  	success: function(data) {
      console.log(data.respon.text_msg)
  		if (data.respon.pesan == "sukses")
  		{
      list_ambil_setor($(".NOMOR_REKENING").val())
      $(".SIMPAN_BTN").attr("disabled", false)
  		}

  		else if (data.respon.pesan == "gagal")
  		{
  			alert("Gagal Menyimpan");
  		}
  	}, //end success
  	error: function(x, e) {
  		console.log("Error Ajax");
  	} //end error
  });
})

$("tbody#ms_zone_data").on("click", "a.hapus_btn", function(){
  //alert($(this).attr("id"))

  var id = $(this).attr('id')
  if (confirm('Apakah anda sudah yakin?.'))
      {
        $.ajax({
          type: 'POST',
          url: refseeAPI,
          dataType: 'json',
          data: 'ref=hapus_ambil_setor&id=' + id ,
          success: function(data) {
            if (data.respon.pesan == "sukses")
            {
              pilih_supplier()
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
