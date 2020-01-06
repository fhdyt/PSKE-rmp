<?php
$id_faktur = $d3;
 ?>
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
/* table{
font-size: 12px;
} */
</style>

<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="list-group">
			<div class="list-group-item">
				<div class="row">
					<div class="col-md-8">
						<h3><i class="fa fa-list"></i> Pemberian Harga Faktur oleh Purchaser</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right"></div>
				</div><!--/.row-->
          <div class="row">
            <div class="col-md-6">
              <table class="table">
                <tr>
                  <td><b>No Faktur</b></td>
                  <td><p class="NO_FAKTUR"><i class="fa fa-spinner fa-pulse fa-fw"></i></p></td>
                </tr>
                <tr>
                  <td><b>Tanggal Faktur</b></td>
                  <td><p class="TANGGAL_FAKTUR"><i class="fa fa-spinner fa-pulse fa-fw"></i></p></td>
                </tr>
                <tr>
                  <td><b>Kapal</b></td>
                  <td><p class="KAPAL_SUPPLIER"><i class="fa fa-spinner fa-pulse fa-fw"></i></p></td>
                </tr>
                <tr>
                  <td bgcolor="#239B56"><font color="white"><b>Nama Supplier</b> <small><i>Admin<i></small></font></td>
                  <td bgcolor="#239B56"><font color="white"><p class="NAMA_SUPPLIER"><i class="fa fa-spinner fa-pulse fa-fw"></i></p></font>
                  </td>
                </tr>
                <tr>
                  <td bgcolor="#239B56"><font color="white"><b>Nama Supplier</b> <small><i>Purchaser<i></small></font></td>
                  <td bgcolor="#239B56"><font color="white"><p class="NAMA_SUPPLIER_PURCHASER">
                    <select class="NAMA_SUPPLIER form-control select2" style="width: 100%;" id="NAMA_SUPPLIER" name="NAMA_SUPPLIER">
                      <option value=""></option>
                      <input autocomplete="off" class="form-control NAMA_SUPPLIER_HIDDEN" id="NAMA_SUPPLIER_HIDDEN" name="NAMA_SUPPLIER_HIDDEN" type="hidden">
                      <input autocomplete="off" class="form-control NAMA_SUPPLIER_PURCHASER_HIDDEN" id="NAMA_SUPPLIER_PURCHASER_HIDDEN" name="NAMA_SUPPLIER_PURCHASER_HIDDEN" type="hidden">
                    </select>
                </p></font>
                  <input autocomplete="off" class="form-control ID_SUPPLIER" id="ID_SUPPLIER" name="ID_SUPPLIER" type="hidden">
                </td>
                </tr>
                <tr>
                  <td><b>Nomor Rekening</b></td>
                  <td><p class="NO_REKENING">-</p></td>
                </tr>
                <tr>
                  <td><b>Alamat</b></td>
                  <td><p class="ALAMAT_SUPPLIER">-</p></td>
                </tr>
                <tr>
                  <td><b>Jenis Material</b></td>
                  <td><p class="MATERIAL"><i class="fa fa-spinner fa-pulse fa-fw"></i></p>

                  </td>
                </tr>
                <tr>
                  <td><b>Catatan</b></td>
                  <td><p class="CATATAN"><i class="fa fa-spinner fa-pulse fa-fw"></i></p></td>
                </tr>
              </table>
          </div>
          <div class="col-md-4">
            <table class="table">
              <tr>
                <td><b>Berat Gross (Kg)</b></td>
                <td><p class="TOTAL_GROSS"><i class="fa fa-spinner fa-pulse fa-fw"></i></p></td>
              </tr>
              <tr>
                <td><b>Berat Tara (Kg)</b></td>
                <td><p class="TOTAL_TARA"><i class="fa fa-spinner fa-pulse fa-fw"></i></p></td>
              </tr>
              <tr>
                <td><b>Berat Bruto (Kg)</b></td>
                <td><p class="TOTAL_BRUTO"><i class="fa fa-spinner fa-pulse fa-fw"></i></p></td>
              </tr>
              <tr>
                <td><b>Potongan</b></td>
                <td><p class="POTONGAN"><i class="fa fa-spinner fa-pulse fa-fw"></i></p></td>
              </tr>
              <tr>
                <td><b>Berat Netto (Kg)</b></td>
                <td>
                  <p class="TOTAL_NETTO"><i class="fa fa-spinner fa-pulse fa-fw"></i></p>
                  <p class="TOTAL_NETTO_SEBELUM" style="font-size:10px;color:grey;"></i></p>
                </td>
              </tr>
              <tr bgcolor="#239B56">
                <td><input type="checkbox" name="CEK_RP_KG" class="CEK_RP_KG"> <font color="white"><b>@Rp</b></font></td>
                <td><font color="white"><p class="RP_KG"><i class="fa fa-spinner fa-pulse fa-fw"></i></p></font>
                  <p class="VERIFIKASI_HARGA_NOTE text-danger loading"></p>
                  <input autocomplete="off" class="form-control INPUT_RP_KG" id="INPUT_RP_KG" name="INPUT_RP_KG" type="hidden">
                </td>
              </tr>
              <tr bgcolor="#239B56">
                <td><input type="checkbox" name="CEK_TAMBANG" class="CEK_TAMBANG"> <font color="white"><b>Tambang</b></font></td>
                <td><input autocomplete="off" class="form-control INPUT_TAMBANG" id="INPUT_TAMBANG" name="INPUT_TAMBANG" placeholder="" type="text" onkeyup="kalkulasi_biaya()">
                    <input autocomplete="off" class="form-control JENIS_FAKTUR" id="JENIS_FAKTUR" name="JENIS_FAKTUR" placeholder="" type="hidden">
                </td>
              </tr>
              <tr bgcolor="#239B56">
                <td><input type="checkbox" name="CEK_BIAYA" class="CEK_BIAYA"> <font color="white"><b>Biaya</b></font></td>
                <td><input autocomplete="off" class="form-control INPUT_BIAYA" id="INPUT_BIAYA" name="INPUT_BIAYA" placeholder="" type="text" onkeyup="kalkulasi_biaya()">
                  <input autocomplete="off" class="form-control NAMA_MATERIAL" id="NAMA_MATERIAL" name="NAMA_MATERIAL" type="hidden">
                  <input autocomplete="off" class="form-control GRADE_MATERIAL" id="GRADE_MATERIAL" name="GRADE_MATERIAL" type="hidden">
                  <input autocomplete="off" class="form-control NAMA_MATERIAL" id="NAMA_MATERIAL" name="NAMA_MATERIAL" type="hidden">
                  <input autocomplete="off" class="form-control ID_FAKTUR_PURCHASER" id="ID_FAKTUR_PURCHASER" name="ID_FAKTUR_PURCHASER" type="hidden">
                </td>
              </tr>
            </table>
          </div>
          <div class="col-md-2">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="CEK_DITERIMA" class="CEK_DITERIMA" disabled> Bisa Diterima
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="CEK_100_INSPEKSI" class="CEK_100_INSPEKSI" disabled> 100 % Inspeksi
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="CEK_DIPISAH" class="CEK_DIPISAH" disabled> Dipisah
              </label>
            </div>
          </div>
      		</div>
          <hr>
        <div class="row">
          <div class="col-md-7">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tanggal</th>
                  <th>Referensi</th>
                  <th>Gross</th>
                  <th>Tara</th>
                  <th>Bruto</th>
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
          <div class="col-md-5">
            <table class="table table-hover">
              <tr>
                <td><b>Kelapa (Rp)</b></td>
                <td align="right"><p class="KELAPA_RP"><i class="fa fa-spinner fa-pulse fa-fw"></i></p>
                  <input autocomplete="off" class="form-control KELAPA_RUPIAH" id="KELAPA_RUPIAH" name="KELAPA_RUPIAH" type="hidden">
                </td>
              </tr>
              <tr>
                <td><b>Tambang (Rp)</b></td>
                <td align="right"><p class="TAMBANG_RP"><i class="fa fa-spinner fa-pulse fa-fw"></i></p></td>
              </tr>
              <tr>
                <td><b>Biaya (Rp)</b></td>
                <td align="right"><p class="BIAYA_RP"><i class="fa fa-spinner fa-pulse fa-fw"></i></p></td>
              </tr>
              <tr>
                <td bgcolor="#239B56"><font color="white"><h4><b>Total (Rp)</b></h4></font></td>
                <td align="right" bgcolor="#239B56"><font color="white"><h4><b>
                  <p class="TOTAL_RP" id="TOTAL_RP"><i class="fa fa-spinner fa-pulse fa-fw"></i></p>
                  <input autocomplete="off" class="form-control TOTAL_SELURUH" id="TOTAL_SELURUH" name="TOTAL_SELURUH" type="hidden">
                </b></h4></font></td>
              </tr>
            </table>
            <p class="help-block">Mohon periksa kembali kesesuaian data faktur dan data yang anda masukkan.</p>
            <button class="btn btn-success simpanHargaPurchaser">Simpan</button>
            <div class="btn-group" hidden>
              <button type="button" class="btn btn-default dropdown-toggle cetak_relasi_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display:none;">
                <i class="fa fa-print" aria-hidden="true"></i> Cetak <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a onclick="cetak_faktur()" class="cetak_faktur" PRINTED="relasi">Relasi</a></li>
                <li><a onclick="cetak_faktur()" class="cetak_faktur" PRINTED="admin">Admin</a></li>
                <li><a onclick="cetak_faktur()" class="cetak_faktur" PRINTED="beacukai">Beacukai</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalEditHarga" role="dialog" tabindex="-1">
 <div class="modal-dialog modal-large" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title" id="myModalLabel">Penyesuaian Harga Baru</h4>
     </div>
     <div class="modal-body">
       <form action="javascript:download();" class="fDataHarga" id="fDataHarga" name="fDataHarga">
             <div class="form-group">
               <label for="exampleInputEmail1">@Rp Lama</label>
               <input autocomplete="off" class="form-control RP_KG_EDIT_HARGA_LAMA" id="RP_KG_EDIT_HARGA_LAMA" name="RP_KG_EDIT_HARGA_LAMA" placeholder="" type="text" readonly>
               <p class="help-block text-danger">@Rp Lama.</p>
             </div>
             <div class="form-group">
               <label for="exampleInputEmail1">@Rp Baru</label>
               <input autocomplete="off" class="form-control RP_KG_EDIT_HARGA" id="RP_KG_EDIT_HARGA" name="RP_KG_EDIT_HARGA" placeholder="" type="text">
               <p class="help-block text-danger">@Rp baru.</p>
             </div>
             <div class="form-group">
               <label for="exampleInputEmail1">Keterangan</label>
               <textarea class="KETERANGAN_EDIT_HARGA form-control" name="KETERANGAN_EDIT_HARGA"></textarea>
               <p class="help-block">Alasan pergantian penyesuaian harga baru.</p>
             </div>

         <div class="row">
           <div class="col-md-12">
             <div class="form-group">
               <button class="btn btn-success btn-sm verifikasiHargaPurchaser">Simpan</button>
             </div>
           </div>
         </div>
       </form>
   </div>
 </div>
</div>
</div>

<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-sm modalCetakFaktur" role="dialog" tabindex="-1">
 <div class="modal-dialog modal-sm" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title" id="myModalLabel"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Berhasil Disimpan</h4>
     </div>
     <div class="modal-body">
       <div class="row">
         <div class="col-md-12">
             <table class="table-hover table">
               <tr>
                 <td>
                   Cetak Untuk Relasi
                 </td>
                 <td>
                   <a onclick="cetak_faktur()" class="cetak_faktur btn btn-success" PRINTED="relasi"><i class="fa fa-print" aria-hidden="true"></i></a>
                 </td>
               </tr>
               <tr>
                 <td>
                   Cetak Untuk Admin
                 </td>
                 <td>
                   <a onclick="cetak_faktur()" class="cetak_faktur btn btn-success" PRINTED="admin"><i class="fa fa-print" aria-hidden="true"></i></a>
                 </td>
               </tr>
               <tr>
                 <td>
                   Cetak Untuk Beacukai
                 </td>
                 <td>
                   <a onclick="cetak_faktur()" class="cetak_faktur btn btn-success" PRINTED="beacukai"><i class="fa fa-print" aria-hidden="true"></i></a>
                 </td>
               </tr>
             </table>

         </div>
       </div>

   </div>
 </div>
</div>
</div>
<script>
function customRound(n){
  var angka = n.toString()

  if (angka.includes('.') == true)
  {
    var r = angka.split(".")
    var x = r[1].substr(0,1)
    if (x < 5)
    {
    var bulat = Math.floor(angka)
    }
    else
    {
    var bulat = Math.ceil(angka)
    }
    return bulat;
  }
  else
  {
    return n
  }


}

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

$(function () {
  //Initialize Select2 Elements
  $('.select2').select2()
})

function faktur_detail_list(curPage)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=faktur_detail_list&ID_FAKTUR=<?php echo $d3; ?>',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        $('p.TOTAL_GROSS').html( data.total_gross)
        $('p.TOTAL_TARA').html( data.total_tara)
        $('p.TOTAL_BRUTO').html( data.total_bruto)
        $('p.POTONGAN').html( data.potongan + " %")

        var potongan = data.total_bruto*(data.potongan/100)

        $('p.TOTAL_NETTO').html(Math.round(data.total_bruto-potongan))
        $('p.TOTAL_NETTO_SEBELUM').html(data.total_bruto-potongan)

        $("tbody#zone_data").empty();
        for (i = 0; i < data.result.length; i++) {
          if(data.result[i].RMP_FAKTUR_CEK_DITERIMA == 'Y')
          {
            $('.CEK_DITERIMA').prop('checked', true)
          }
          else{}

          if(data.result[i].RMP_FAKTUR_CEK_100_INSPEKSI == 'Y')
          {
            $('.CEK_100_INSPEKSI').prop('checked', true)
          }
          else{}

          if(data.result[i].RMP_FAKTUR_CEK_DIPISAH == 'Y')
          {
            $('.CEK_DIPISAH').prop('checked', true)
          }
          else{}
          $("tbody#zone_data").append("<tr class='detailLogId'  >" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_DETAIL_TANGGAL + "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_DETAIL_REF + "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_DETAIL_BRUTO + "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_DETAIL_TARA + "</td>" +
					"<td>" + data.result[i].RMP_FAKTUR_DETAIL_NETTO + "</td>" +
          "</tr>");
					}

        for (i = 0; i < data.resultb.length; i++) {
          if (data.result[i].RMP_FAKTUR_NAMA_SUB == "" )
          {
            var supplier = data.resultb[i].RMP_MASTER_PERSONAL_NAMA
          }
          else
          {
            var supplier = data.resultb[i].RMP_MASTER_PERSONAL_NAMA +" / <b>"+ data.resultb[i].RMP_FAKTUR_NAMA_SUB +"</b>"
          }

          $("p.NO_FAKTUR").html(data.resultb[i].RMP_FAKTUR_NO_FAKTUR)
          //alert(data.resultb[i].RMP_FAKTUR_NO_FAKTUR)
          $("p.KAPAL_SUPPLIER").html(data.resultb[i].RMP_FAKTUR_KAPAL)
          $("p.ALAMAT_SUPPLIER").html(data.resultb[i].RMP_FAKTUR_ALAMAT)
          $("p.NAMA_SUPPLIER").html(supplier)
          $(".NAMA_SUPPLIER_HIDDEN").val(data.resultb[i].RMP_MASTER_PERSONAL_NAMA)
          $("p.TANGGAL_FAKTUR").html(data.resultb[i].TANGGAL)
          $("p.MATERIAL").html(data.resultb[i].RMP_FAKTUR_DETAIL_JENIS_MATERIAL)
          $(".NAMA_MATERIAL").val(data.resultb[i].NAMA_MATERIAL)
          $(".GRADE_MATERIAL").val(data.resultb[i].GRADE_MATERIAL)
          $(".CATATAN").html(data.resultb[i].RMP_FAKTUR_CATATAN_PURCHASER)
          $(".JENIS_FAKTUR").val(data.resultb[i].RMP_FAKTUR_JENIS)
					}
          sel_nama_supplier();

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

function detail_purchaser(curPage)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=detail_purchaser&ID_FAKTUR=<?php echo$d3; ?>',
    success: function(data) {
      if (data.respon.pesan == "sukses") {

        for (i = 0; i < data.resultbc.length; i++) {
          //alert(data.respon.text_msg)
          if(data.resultbc[i].RMP_FAKTUR_JENIS == "FAKTUR CABANG")
          {
            //alert(data.resultbc[i].RMP_FAKTUR_PURCHASER_RP_KELAPA)
            $('p.KELAPA_RP').html(number_format(data.resultbc[i].RMP_FAKTUR_PURCHASER_RP_KELAPA));
            $('.KELAPA_RUPIAH').val(data.resultbc[i].RMP_FAKTUR_PURCHASER_RP_KELAPA);
          }
        //  $("p.RP_KG").html(data.resultbc[i].RMP_FAKTUR_PURCHASER_RP_KG)
          $('p.RP_KG').html(data.resultbc[i].RMP_FAKTUR_PURCHASER_RP_KG + " &nbsp; &nbsp; &nbsp;<a class='edit_harga' onclick='edit_harga()' id='edit_harga'><i class='fa fa-pencil'></i></a>");
          $("p.NO_REKENING").html(data.resultbc[i].REKENING)
          //$("p.ALAMAT_SUPPLIER").html(data.resultbc[i].ALAMAT)
          $(".INPUT_RP_KG").val(data.resultbc[i].RMP_FAKTUR_PURCHASER_RP_KG)
          $(".INPUT_TAMBANG").val(data.resultbc[i].RMP_FAKTUR_PURCHASER_TAMBANG)
          //$("p.NAMA_SUPPLIER_PURCHASER").html(data.resultbc[i].RMP_MASTER_PERSONAL_NAMA)
          $(".INPUT_BIAYA").val(data.resultbc[i].RMP_FAKTUR_PURCHASER_BIAYA)
          $(".ID_SUPPLIER").val(data.resultbc[i].RMP_MASTER_PERSONAL_ID)
          $(".JENIS_FAKTUR").val(data.resultbc[i].RMP_FAKTUR_JENIS)
          $(".NAMA_SUPPLIER_PURCHASER_HIDDEN").val(data.resultbc[i].RMP_MASTER_PERSONAL_NAMA)
          kalkulasi_biaya()
        //  $(".ID_FAKTUR_PURCHASER").val(data.resultbc[i].RMP_FAKTUR_PURCHASER_ID)
          if(data.resultbc[i].FRRECORD_STATUS == 'A')
          {
            $(".ID_FAKTUR_PURCHASER").val(data.resultbc[i].RMP_FAKTUR_PURCHASER_ID)
            if(data.resultbc[i].RMP_FAKTUR_PURCHASER_CEK_TAMBANG == "Y")
            {
              $('.CEK_TAMBANG').prop('checked', true);
            }
            else
            {
              $('.CEK_TAMBANG').prop('checked', false);
            }

            if(data.resultbc[i].RMP_FAKTUR_PURCHASER_CEK_BIAYA == "Y")
            {
              $('.CEK_BIAYA').prop('checked', true);
            }
            else
            {
              $('.CEK_BIAYA').prop('checked', false);
            }

            if(data.resultbc[i].RMP_FAKTUR_PURCHASER_CEK_RP == "Y")
            {
              $('.CEK_RP_KG').prop('checked', true);
            }
            else
            {
              $('.CEK_RP_KG').prop('checked', false);
            }

            $('.cetak_relasi_dropdown').removeAttr('style');
          }
          else if(data.resultbc[i].FRRECORD_STATUS == "V")
          {
            $("p.VERIFIKASI_HARGA_NOTE").html("<small><i>Menunggu Verifikasi...</i></small>")
            $(".simpanHargaPurchaser").attr("disabled", true)
          }
          else
          {
            $(".ID_FAKTUR_PURCHASER").val(data.resultbc[i].RMP_FAKTUR_PURCHASER_ID)
          }

          if(data.resultbc[i].RMP_FAKTUR_PURCHASER_VERIFIKASI_STATUS == 'VERIFIKASI' && data.resultbc[i].FRRECORD_STATUS == "N")
          {
            $("p.VERIFIKASI_HARGA_NOTE").html("<small><i>Harga Terverifikasi</i></small>")
            $("p.VERIFIKASI_HARGA_NOTE").removeAttr("class", "text-danger")
          }
					}

      } else if (data.respon.pesan == "gagal") {
      //  alert(data.respon.text_msg)
        $("p.RP_KG").html("0")
        $(".INPUT_RP_KG").val("")
        $(".INPUT_TAMBANG").val("0")
        $(".INPUT_BIAYA").val("0")
      }

    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}



$(function() {
  console.log("function");
  faktur_detail_list();
  detail_purchaser();
});

function sel_nama_supplier()
{
  var nama_material = "material="+$(".NAMA_MATERIAL").val()
  var grade_material = "grade="+$(".GRADE_MATERIAL").val()
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=sel_nama_supplier_rek&'+nama_material+'&'+grade_material+'',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        for (i = 0; i < data.result.length; i++) {
          if ($(".NAMA_SUPPLIER_PURCHASER_HIDDEN").val() == data.result[i].RMP_MASTER_PERSONAL_NAMA)
          {
            var sel = "selected"
            $('.ID_SUPPLIER').val(data.result[i].RMP_MASTER_PERSONAL_ID)
            $('p.NO_REKENING').html(data.result[i].RMP_REKENING_RELASI);
            //$('p.ALAMAT_SUPPLIER').html(data.result[i].ALAMAT);
            if($('.INPUT_RP_KG').val() == '')
            {
            $('p.RP_KG').html(data.result[i].HARGA + " &nbsp; &nbsp; &nbsp;<a class='edit_harga' onclick='edit_harga()' id='edit_harga'><i class='fa fa-pencil'></i></a>");
            }
          }
          else if ($(".NAMA_SUPPLIER_HIDDEN").val() == data.result[i].RMP_MASTER_PERSONAL_NAMA)
          {
            var sel = "selected"
            $('.ID_SUPPLIER').val(data.result[i].RMP_MASTER_PERSONAL_ID)
            $('p.NO_REKENING').html(data.result[i].RMP_REKENING_RELASI);
            //$('p.ALAMAT_SUPPLIER').html(data.result[i].ALAMAT);
            if($('.INPUT_RP_KG').val() == '')
            {
            $('p.RP_KG').html(data.result[i].HARGA + " &nbsp; &nbsp; &nbsp;<a class='edit_harga' onclick='edit_harga()' id='edit_harga'><i class='fa fa-pencil'></i></a>");
            }
          }
          else
          {
            var sel = ""
          }
          $("select.NAMA_SUPPLIER").append("<option value='"+ data.result[i].RMP_MASTER_PERSONAL_ID +"' RP='"+data.result[i].HARGA+"' REKENING='"+data.result[i].RMP_REKENING_RELASI+"' ALAMAT='"+data.result[i].ALAMAT+"' "+sel+">"+ data.result[i].RMP_MASTER_PERSONAL_NAMA +"</option>");
					}
          kalkulasi_biaya()

      } else if (data.respon.pesan == "gagal") {
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
  };

    $('select.NAMA_SUPPLIER').on('change', function(){
    var id_supplier = $(this).val();
    $('.ID_SUPPLIER').val(id_supplier)
    var rekening = $('.NAMA_SUPPLIER option:selected').attr('REKENING');
    $('p.NO_REKENING').html(rekening);
    // var alamat = $('.NAMA_SUPPLIER option:selected').attr('ALAMAT');
    // $('p.ALAMAT_SUPPLIER').html(alamat);
    if($('.INPUT_RP_KG').val() == '')
    {
      var rp = $('.NAMA_SUPPLIER option:selected').attr('RP');
      $('p.RP_KG').html(rp + " &nbsp; &nbsp; &nbsp;<a class='edit_harga' onclick='edit_harga()' id='edit_harga'><i class='fa fa-pencil'></i></a>");
    }
    else{}
    kalkulasi_biaya()
  })


function edit_harga(){
var harga_lama = $('p.RP_KG').text()
$('.RP_KG_EDIT_HARGA_LAMA').val(harga_lama)
 $('.modalEditHarga').modal('show')
}


$(".simpanHargaPurchaser").on('click', function(){
  var no_faktur = "NO_FAKTUR=" +$('.NO_FAKTUR').text()+ ""
  var personal_id = "PERSONAL_ID=" +$('.ID_SUPPLIER').val()+ ""
  var rp_kg = "RP_KG=" +$('.RP_KG').text()+ ""
  var tambang = "TAMBANG=" +$('.INPUT_TAMBANG').val()+ ""
  var biaya = "BIAYA=" +$('.INPUT_BIAYA').val()+ ""
  var id_faktur_purchaser = "ID_FAKTUR_PURCHASER=" +$('.ID_FAKTUR_PURCHASER').val()+ ""
  var bruto = "TOTAL_BRUTO=" +$('.TOTAL_BRUTO').text()+ ""
  var potongan = "POTONGAN=" +$('.POTONGAN').text()+ ""
  var netto = "TOTAL_NETTO=" +$('.TOTAL_NETTO').text()+ ""
  var rekening = "NO_REKENING=" +$('.NO_REKENING').text()+ ""
  var total_seluruh = "TOTAL_SELURUH=" +$('.TOTAL_SELURUH').val()+ ""
  var rp_kelapa = "RP_KELAPA=" +$('.KELAPA_RUPIAH').val()+ ""
  var jenis_faktur = "JENIS_FAKTUR=" +$('.JENIS_FAKTUR').val()+ ""

  var cek_tambang = "CEK_TAMBANG=" +$('.CEK_TAMBANG').is(":checked")+ ""
  var cek_biaya = "CEK_BIAYA=" +$('.CEK_BIAYA').is(":checked")+ ""
  var cek_rp = "CEK_RP_KG=" +$('.CEK_RP_KG').is(":checked")+ ""
  var form = "" + no_faktur + "&" + personal_id + "&" + id_faktur_purchaser + "&" + rp_kg + "&" + tambang + "&" + biaya + "&" + bruto +"&" + potongan +"&" + netto + "&" + rekening + "&" + total_seluruh + "&" + rp_kelapa + "&" + cek_tambang + "&" + cek_biaya + "&" + cek_rp + "&" + jenis_faktur + ""
  console.log(form)
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=add_faktur_purchaser&' + form ,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        //alert(data.respon.text_msg)
        faktur_detail_list();
        detail_purchaser();
        $('.modalCetakFaktur').modal('show')
      }
      else if (data.respon.pesan == "gagal")
      {
        alert (data.respon.text_msg);
        alert("Gagal Menyimpan");
      }
    }, //end success
    error: function(x, e)
    {
      console.log("Error Ajax QUALITED");
    } //end error
  });
})

$(".verifikasiHargaPurchaser").on('click', function(){
  var no_faktur = "NO_FAKTUR=" +$('.NO_FAKTUR').text()+ ""
  var personal_id = "PERSONAL_ID=" +$('.ID_SUPPLIER').val()+ ""
  var rp_kg = "RP_KG=" +$('.RP_KG_EDIT_HARGA').val()+ ""
  var rp_kg_lama = "RP_KG_LAMA=" +$('.RP_KG_EDIT_HARGA_LAMA').val()+ ""
  var tambang = "TAMBANG=" +$('.INPUT_TAMBANG').val()+ ""
  var biaya = "BIAYA=" +$('.INPUT_BIAYA').val()+ ""
  var keterangan = "KETERANGAN=" +$('.KETERANGAN_EDIT_HARGA').val()+ ""
  var id_faktur_purchaser = "ID_FAKTUR_PURCHASER=" +$('.ID_FAKTUR_PURCHASER').val()+ ""
  var form = "" + no_faktur + "&" + personal_id + "&" + id_faktur_purchaser + "&" + rp_kg + "&" + tambang + "&" + keterangan + "&" + rp_kg_lama + "&" + biaya + ""

  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=add_verifikasi_harga&' + form ,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        $('.modalEditHarga').modal('hide')
        faktur_detail_list();
        detail_purchaser();
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
})

$(".cetak_faktur").on("click", function(){
  // var no_faktur = btoa(fikri); // Enskrip
  // var no_faktur = atob(Zmlrcmk=); // Dekrip
  var rp_kg = btoa($('.RP_KG').text())
  var material = btoa($('.NAMA_MATERIAL').val())
  var printed = btoa($(this).attr("PRINTED"))
  window.open("?show=rmp/pdf/cetak_faktur/<?php echo $d3; ?>/"+ rp_kg +"/"+ material +"/"+ printed +"", "_blank");
})


function kalkulasi_biaya()
{
  var netto = $('.TOTAL_NETTO').text()
  var rp = $('.RP_KG').text()
  var potongan = $('.POTONGAN').text()
  var tambang = $('.INPUT_TAMBANG').val()
  var biaya = parseInt($('.INPUT_BIAYA').val())

  if ($(".JENIS_FAKTUR").val() == "FAKTUR CABANG")
  {
    var tambang_rp = parseInt(tambang);
    var kelapa_total = parseInt($('.KELAPA_RUPIAH').val());
    //$('p.KELAPA_RP').html(number_format(kelapa_total));
  }
  else
  {
    var kelapa_total = parseInt(rp*netto);
    $('p.KELAPA_RP').html(number_format(kelapa_total));
    $('.KELAPA_RUPIAH').val(kelapa_total);
    var tambang_rp = parseInt(tambang*netto);
  }

  var total_rp = parseInt(biaya+kelapa_total+tambang_rp);
  //$('p.KELAPA_RP').html(number_format(kelapa_total));
  $('p.TAMBANG_RP').html(number_format(tambang_rp));
  $('p.BIAYA_RP').html(number_format(biaya));
  $('p.TOTAL_RP').html(number_format(total_rp));
  $('.TOTAL_SELURUH').val(total_rp);
}
</script>
