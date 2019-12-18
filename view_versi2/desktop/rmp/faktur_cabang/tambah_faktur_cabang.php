<?php
$RMP_CONFIG=new RMP_CONFIG();

if ($d3 == '')
{
  $id_faktur = waktu_decimal(Date("Y-m-d H:i:s"));
}
else
{
  $id_faktur = $d3;
}

$data=array(
  'ID_FAKTUR_CABANG'=>$d3,
);

$cr_data=array(
  'case'=>"nonlogin_detail_faktur_cabang",
  'batas'=>1,
  'halaman'=>1,
  'user_privileges_data'=>$_COOKIE['data_http'],
  'data'=>$data,
);

$SW=new SWITCH_DATA();
$SW->data_location="local"; //local,external
$SW->cr_data=$cr_data;
$SW->CLS=new RMP_MODULES(); //nama class -> khusus untuk local data.
$SW->ref="RMP_MODULES"; //nama file --> khusus untuk external data
$da=$SW->output();
// echo "<pre>".print_r($da,true)."</pre>";

foreach($da['refs'] as $r)
{
  $faktur_cabang[]=$r;
}
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
table{
font-size: 12px;
}
</style>
<!-- <pre class='TEST'></pre> -->
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="list-group">
			<div class="list-group-item">
				<div class="row">
					<div class="col-md-8">
						<h3><i class="fa fa-calculator"></i> Tambah Faktur Cabang</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right">
          </div>
				</div><!--/.row-->
        <form action="javascript:download();" class="fDataFaktur" id="fDataFaktur" name="fDataFaktur">
        <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">ID Faktur Cabang</label>
                <input autocomplete="off" readonly class="form-control ID_FAKTUR_CABANG" id="ID_FAKTUR_CABANG" name="ID_FAKTUR_CABANG" placeholder="" value="<?php echo $id_faktur;  ?>" type="text"> <small class="help-block">ID Faktur Cabang</small>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">PS Cabang</label>
                <select class="CABANG form-control" name="CABANG">
                  <option value="">
                    --Pilih PS Cabang--
                  </option><?php
                  $data = $RMP_CONFIG->sel_ps_cabang();
                        foreach ($data['rasult'] as $key => $value)
                          {
                            foreach ($value as $data => $isi)
                            {
                            if($faktur_cabang[0]['RMP_MASTER_PERSONAL_ID']==$isi['RMP_MASTER_PERSONAL_ID'])
                               {
                                 $sel="selected";
                               }
                             else
                               {
                                 $sel="";
                               }

                            ?>
                  <option value="<?php echo $isi['RMP_MASTER_PERSONAL_ID']; ?>" <?php echo $sel; ?>>
                    <?php  echo $isi['RMP_MASTER_PERSONAL_NAMA'];?>
                  </option><?php   }}      ?>
                </select>
                <small class="help-block">Nama PS Cabang</small>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">Kapal</label>
                <input autocomplete="off" class="form-control KAPAL" id="KAPAL" name="KAPAL" placeholder="" type="text" value="<?php echo $faktur_cabang[0]['RMP_REKAP_FC_KAPAL'] ?>"> <small class="help-block">Kapal</small>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">Ponton</label>
                <select class="form-control PONTON" id="PONTON" name="PONTON">
                  <option value="">--Pilih Ponton--</option>
                  <option <?php if ($faktur_cabang[0]['RMP_REKAP_FC_TIMBANG'] == "PTN-1" ) echo 'selected' ; ?> value="PTN-1">Ponton 1</option>
                  <option <?php if ($faktur_cabang[0]['RMP_REKAP_FC_TIMBANG'] == "PTN-2" ) echo 'selected' ; ?> value="PTN-2">Ponton 2</option>
                </select>
                <small class="help-block">Timbang Ponton</small>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">Jenis Kelapa Bulat</label>
                <select class="form-control JENIS_KB" id="JENIS_KB" name="JENIS_KB">
                  <option value="">--Pilih Kelapa Bulat--</option>
                  <option <?php if ($faktur_cabang[0]['RMP_REKAP_FC_JENIS_KB'] == "JAMBUL" ) echo 'selected' ; ?> value="JAMBUL">JAMBUL</option>
                  <option <?php if ($faktur_cabang[0]['RMP_REKAP_FC_JENIS_KB'] == "LICIN" ) echo 'selected' ; ?> value="LICIN">LICIN</option>
                  <option <?php if ($faktur_cabang[0]['RMP_REKAP_FC_JENIS_KB'] == "GELONDONG" ) echo 'selected' ; ?> value="GELONDONG">GELONDONG</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">Tanggal</label>
                <input autocomplete="off" class="form-control TANGGAL_FAKTUR_CABANG datepicker" id="TANGGAL_FAKTUR_CABANG" name="TANGGAL_FAKTUR_CABANG" placeholder="" type="text" value="<?php echo $faktur_cabang[0]['RMP_REKAP_FC_TANGGAL'] ?>"> <small class="help-block">Tanggal Faktur Cabang</small>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">Tambang</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Rp.</span>
                  <input autocomplete="off" class="form-control TAMBANG" id="TAMBANG" name="TAMBANG" placeholder="" type="text" value="<?php echo $faktur_cabang[0]['RMP_REKAP_FC_TAMBANG'] ?>">
                </div>
                 <small class="help-block">Biaya Tambang</small>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">Biaya</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Rp.</span>
                  <input autocomplete="off" class="form-control BIAYA" id="BIAYA" name="BIAYA" placeholder="" type="text" value="<?php echo $faktur_cabang[0]['RMP_REKAP_FC_BIAYA'] ?>">
                </div>
                 <small class="help-block">Biaya Lainnya</small>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                  <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">QTY PSKe A</label>
                <div class="input-group">
                  <input autocomplete="off" class="form-control QTY_TERIMA_PSKE_A" id="QTY_TERIMA_PSKE_A" name="QTY_TERIMA_PSKE_A" placeholder="" type="text" value="<?php echo $faktur_cabang[0]['RMP_REKAP_FC_QTY_PSKE_A'] ?>">
                  <span class="input-group-addon" id="basic-addon2">Kg</span>
                </div>
                  <small class="help-block">Quantity Terima A PSKE</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                  <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">QTY PSKe B</label>
                <div class="input-group">
                  <input autocomplete="off" class="form-control QTY_TERIMA_PSKE_B" id="QTY_TERIMA_PSKE_B" name="QTY_TERIMA_PSKE_B" placeholder="" type="text" value="<?php echo $faktur_cabang[0]['RMP_REKAP_FC_QTY_PSKE_B'] ?>" >
                  <span class="input-group-addon" id="basic-addon2">Kg</span>
                </div>
                  <small class="help-block">Quantity Terima B PSKE</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                  <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">QTY PSKe C</label>
                <div class="input-group">
                  <input autocomplete="off" class="form-control QTY_TERIMA_PSKE_C" id="QTY_TERIMA_PSKE_C" name="QTY_TERIMA_PSKE_C" placeholder="" type="text" value="<?php echo $faktur_cabang[0]['RMP_REKAP_FC_QTY_PSKE_C'] ?>">
                  <span class="input-group-addon" id="basic-addon2">Kg</span>
                </div>
                  <small class="help-block">Quantity Terima C PSKE</small>
              </div>
            </div>
          </div>
        <br>
        <br>
      </form>

        <div class="row">
          <div class="col-md-12">
            <h4>Kelapa A</h4>
          </div>
          <div class="col-md-12 gelondong_a">
            <table class="table table-bordered table-hover kb-gl-a">
							<thead>
								<tr>
									<th>No.</th>
									<th style="padding-right:100px;">Nama Supplier</th>
									<th>BRUTO</th>
									<th>POTONGAN</th>
									<th>NETTO</th>
									<th>@Rp/Kg</th>
									<th>Rupiah KB</th>
									<th></th>
								</tr>
							</thead>
              <form action="javascript:download();" class="fData_GL_A" id="fData_GL_A" name="fData_GL_A">
							<tbody id="dynamic_field">
								<tr>
                  <td>
                  </td>
                  <td>
                    <input autocomplete="off" class="form-control NAMA_SUPPLIER_A" id="NAMA_SUPPLIER_A" name="NAMA_SUPPLIER_A" placeholder="" type="text">
									</td>
									<td>
										<input autocomplete="off" class="form-control BRUTO_A"  type="text" onkeyup="input_proses_a()">
									</td>
                  <td>
										<input class="form-control POTONGAN_A"  type="text" autocomplete="off" onkeyup="input_proses_a()">
									</td>
                  <td>
										<input class="form-control NETTO_A"  type="text" autocomplete="off" onkeyup="input_proses_a()" readonly>
									</td>
									<td>
										<input autocomplete="off" class="form-control RP_KG_A"  type="text" onkeyup="input_proses_a()">
									</td>
                  <td>
										<input class="form-control RUPIAH_A"  type="text" autocomplete="off" onkeyup="input_proses_a()" readonly>
									</td>
                  <td>
                    <button type="button" name="add" id="add_a" class="btn btn-primary add_a"><i class="fa fa-plus">
                  </td>
								</tr>
							</tbody>
              <tbody id="zone_data_a">
              </tbody>
              </form>
              <tfoot id="total_a">
              </tfoot>
						</table>
          </div>
        </div>
        <br>
        <br>


        <div class="row">
          <div class="col-md-12">
            <h4>Kelapa B</h4>
          </div>
          <div class="col-md-12 gelondong_b">
            <table class="table table-bordered table-hover kb-gl-b">
							<thead>
								<tr>
									<th>No.</th>
									<th style="padding-right:100px;">Nama Supplier</th>
									<th>BRUTO</th>
									<th>POTONGAN</th>
									<th>NETTO</th>
									<th>@Rp/Kg</th>
									<th>Rupiah KB</th>
									<th></th>
								</tr>
							</thead>
              <form action="javascript:download();" class="fData_GL_A" id="fData_GL_A" name="fData_GL_A">
							<tbody id="dynamic_field">
								<tr>
                  <td>
                  </td>
                  <td>
                    <input autocomplete="off" class="form-control NAMA_SUPPLIER_B" id="NAMA_SUPPLIER_B" name="NAMA_SUPPLIER_B" placeholder="" type="text">
									</td>
									<td>
										<input autocomplete="off" class="form-control BRUTO_B"  type="text" onkeyup="input_proses_b()">
									</td>
                  <td>
										<input class="form-control POTONGAN_B"  type="text" autocomplete="off" onkeyup="input_proses_b()">
									</td>
                  <td>
										<input class="form-control NETTO_B"  type="text" autocomplete="off" onkeyup="input_proses_b()" readonly>
									</td>
									<td>
										<input autocomplete="off" class="form-control RP_KG_B"  type="text" onkeyup="input_proses_b()">
									</td>
                  <td>
										<input class="form-control RUPIAH_B"  type="text" autocomplete="off" onkeyup="input_proses_b()" readonly>
									</td>
                  <td>
                    <button type="button" name="add" id="add_b" class="btn btn-primary add_b"><i class="fa fa-plus">
                  </td>
								</tr>
							</tbody>
              <tbody id="zone_data_b">
              </tbody>
              </form>
              <tfoot id="total_b">
              </tfoot>
						</table>
          </div>
        </div>
        <br>
        <br>


        <div class="row">
          <div class="col-md-12">
            <h4>Kelapa C</h4>
          </div>
          <div class="col-md-12 gelondong_b">
            <table class="table table-bordered table-hover kb-gl-c">
							<thead>
								<tr>
									<th>No.</th>
									<th style="padding-right:100px;">Nama Supplier</th>
									<th>BRUTO</th>
									<th>POTONGAN</th>
									<th>NETTO</th>
									<th>@Rp/Kg</th>
									<th>Rupiah KB</th>
									<th></th>
								</tr>
							</thead>
              <form action="javascript:download();" class="fData_GL_A" id="fData_GL_A" name="fData_GL_A">
							<tbody id="dynamic_field">
								<tr>
                  <td>
                  </td>
                  <td>
                    <input autocomplete="off" class="form-control NAMA_SUPPLIER_C" id="NAMA_SUPPLIER_C" name="NAMA_SUPPLIER_C" placeholder="" type="text">
									</td>
									<td>
										<input autocomplete="off" class="form-control BRUTO_C" type="text" onkeyup="input_proses_c()">
									</td>
                  <td>
										<input class="form-control POTONGAN_C"  type="text" autocomplete="off" onkeyup="input_proses_c()">
									</td>
                  <td>
										<input class="form-control NETTO_C"  type="text" autocomplete="off" onkeyup="input_proses_c()" readonly>
									</td>
									<td>
										<input autocomplete="off" class="form-control RP_KG_C"  type="text" onkeyup="input_proses_c()">
									</td>
                  <td>
										<input class="form-control RUPIAH_C"  type="text" autocomplete="off" onkeyup="input_proses_c()" readonly>
									</td>
                  <td>
                    <button type="button" name="add" id="add_c" class="btn btn-primary add_c"><i class="fa fa-plus">
                  </td>
								</tr>
							</tbody>
              <tbody id="zone_data_c">
              </tbody>
              </form>
              <tfoot id="total_c">
              </tfoot>
						</table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <a class="btn btn-primary SimpanFaktur">Simpan</a>
            <a class="btn btn-warning" href="?show=rmp/faktur_cabang/review_faktur_cabang/<?php echo $id_faktur;  ?>">Review</a>
          </div>
          <div class="col-md-6">

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>

$(function()
{
	$(".datepicker").datepicker().on('changeDate', function(ev)
	{
		$('.datepicker').datepicker('hide');
	});
});

var options = {
ajax: {
  url: refseeAPI,
  type: 'POST',
  dataType: 'json',
  data: {
    q: '{{{q}}}',
    ref: 'nama_supplier',
  }
},
locale: {
  emptyTitle: ' '
},
log: 3,
preprocessData: function(data) {
  var i, l = data.result.length,
    array = [];

  if (l) {
    for (i = 0; i < l; i++) {
      array.push($.extend(true, data.result[i], {
        text: data.result[i].RMP_MASTER_PERSONAL_NAMA,
        value: data.result[i].RMP_MASTER_PERSONAL_ID,
        data: {
          subtext: ''
        }
      }));
    }
  } else {}
  return array;
}
};
$('.selectpicker').selectpicker().filter('.with-ajax-personal').ajaxSelectPicker(options);


function list_gl_a()
{
  var id_faktur ="<?php echo $id_faktur; ?>"
  console.log(id_faktur)
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=list_gl_a&ID_FAKTUR=' + id_faktur + '&JENIS_KB='+$('.JENIS_KB').val()+'-A',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        //$('.TEST').html(data.respon.text_msg)
        //////////// GELODONG A
        $("tbody#zone_data_a").empty();
        for (i = 0; i < data.result_a.length; i++) {
          $("tbody#zone_data_a").append("<tr class='detailLogId'>" +
					"<td >" + data.result_a[i].NO + ".</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_DETAIL_NAMA + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_DETAIL_BRUTO + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_DETAIL_POTONGAN + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_DETAIL_NETTO + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_DETAIL_RP_KG + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_DETAIL_RUPIAH + "</td>" +
          "<td><a class='btn btn-danger btn-sm hapus_a' ID_REKAP_FAKTUR_DETAIL_A='" + data.result_a[i].RMP_REKAP_FC_DETAIL_ID  + "'><i class='fa fa-trash'></a></td>" +
          "</tr>");
					}

        $("tfoot#total_a").empty();
        for (i = 0; i < data.result_total_a.length; i++) {
          console.log(data.result_total_a[i].BRUTO)
          $("tfoot#total_a").append("<tr class='warning'>" +
					"<td colspan='2' class='text-center'><b>Total</b></td>" +
					"<td ><b>" + data.result_total_a[i].BRUTO + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].POTONGAN + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].NETTO + "</b></td>" +
					"<td ><b></b></td>" +
					"<td ><b>" + data.result_total_a[i].RUPIAH + "</b></td>" +
          "<td></td>" +
          "</tr>");
					}
          //////////// end GELODONG A
      } else if (data.respon.pesan == "gagal") {
        $("tfoot#total_a").empty();
        $("tbody#zone_data_a").empty();
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

$(function(){
list_gl_a()
})

function list_gl_b()
{
  var id_faktur ="<?php echo $id_faktur; ?>"
  console.log(id_faktur)
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=list_gl_b&ID_FAKTUR=' + id_faktur + '&JENIS_KB='+$('.JENIS_KB').val()+'-B',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        $('.TEST').html(data.respon.text_msg)
        //////////// GELODONG B
        $("tbody#zone_data_b").empty();
        for (i = 0; i < data.result_b.length; i++) {
          $("tbody#zone_data_b").append("<tr class='detailLogId'>" +
					"<td >" + data.result_b[i].NO + ".</td>" +
					"<td>" + data.result_b[i].RMP_REKAP_FC_DETAIL_NAMA + "</td>" +
					"<td>" + data.result_b[i].RMP_REKAP_FC_DETAIL_BRUTO + "</td>" +
					"<td>" + data.result_b[i].RMP_REKAP_FC_DETAIL_POTONGAN + "</td>" +
					"<td>" + data.result_b[i].RMP_REKAP_FC_DETAIL_NETTO + "</td>" +
					"<td>" + data.result_b[i].RMP_REKAP_FC_DETAIL_RP_KG + "</td>" +
					"<td>" + data.result_b[i].RMP_REKAP_FC_DETAIL_RUPIAH + "</td>" +
          "<td><a class='btn btn-danger btn-sm hapus_a' ID_REKAP_FAKTUR_DETAIL_A='" + data.result_b[i].RMP_REKAP_FC_DETAIL_ID  + "'><i class='fa fa-trash'></a></td>" +
          "</tr>");
					}

        $("tfoot#total_b").empty();
        for (i = 0; i < data.result_total_b.length; i++) {
          console.log(data.result_total_b[i].BRUTO)
          $("tfoot#total_b").append("<tr class='warning'>" +
					"<td colspan='2' class='text-center'><b>Total</b></td>" +
					"<td ><b>" + data.result_total_b[i].BRUTO + "</b></td>" +
					"<td ><b>" + data.result_total_b[i].POTONGAN + "</b></td>" +
					"<td ><b>" + data.result_total_b[i].NETTO + "</b></td>" +
					"<td ><b></b></td>" +
					"<td ><b>" + data.result_total_b[i].RUPIAH + "</b></td>" +
          "<td></td>" +
          "</tr>");
					}
          //////////// end GELODONG B
      } else if (data.respon.pesan == "gagal") {
        $("tfoot#total_b").empty();
        $("tbody#zone_data_b").empty();
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

$(function(){
list_gl_b()
})


function list_gl_c()
{
  var id_faktur ="<?php echo $id_faktur; ?>"
  console.log(id_faktur)
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=list_gl_c&ID_FAKTUR=' + id_faktur + '&JENIS_KB='+$('.JENIS_KB').val()+'-C',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        //$('.TEST').html(data.respon.text_msg)
        //////////// GELODONG C
        $("tbody#zone_data_c").empty();
        for (i = 0; i < data.result_c.length; i++) {
          $("tbody#zone_data_c").append("<tr class='detailLogId'>" +
					"<td >" + data.result_c[i].NO + ".</td>" +
					"<td>" + data.result_c[i].RMP_REKAP_FC_DETAIL_NAMA + "</td>" +
					"<td>" + data.result_c[i].RMP_REKAP_FC_DETAIL_BRUTO + "</td>" +
					"<td>" + data.result_c[i].RMP_REKAP_FC_DETAIL_POTONGAN + "</td>" +
					"<td>" + data.result_c[i].RMP_REKAP_FC_DETAIL_NETTO + "</td>" +
					"<td>" + data.result_c[i].RMP_REKAP_FC_DETAIL_RP_KG + "</td>" +
					"<td>" + data.result_c[i].RMP_REKAP_FC_DETAIL_RUPIAH + "</td>" +
          "<td><a class='btn btn-danger btn-sm hapus_a' ID_REKAP_FAKTUR_DETAIL_A='" + data.result_c[i].RMP_REKAP_FC_DETAIL_ID  + "'><i class='fa fa-trash'></a></td>" +
          "</tr>");
					}

        $("tfoot#total_c").empty();
        for (i = 0; i < data.result_total_c.length; i++) {
          console.log(data.result_total_c[i].BRUTO)
          $("tfoot#total_c").append("<tr class='warning'>" +
					"<td colspan='2' class='text-center'><b>Total</b></td>" +
					"<td ><b>" + data.result_total_c[i].BRUTO + "</b></td>" +
					"<td ><b>" + data.result_total_c[i].POTONGAN + "</b></td>" +
					"<td ><b>" + data.result_total_c[i].NETTO + "</b></td>" +
					"<td ><b></b></td>" +
					"<td ><b>" + data.result_total_c[i].RUPIAH + "</b></td>" +
          "<td></td>" +
          "</tr>");
					}
          //////////// end GELODONG C
      } else if (data.respon.pesan == "gagal") {
        $("tfoot#total_c").empty();
        $("tbody#zone_data_c").empty();      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

$(function(){
list_gl_c()
})


////////////////////////////////////////////////// GELONDONG A //////////////////////////////
$('#add_a').click(function()
{
  var id_faktur_cabang ='ID_FAKTUR_CABANG=' + $('.ID_FAKTUR_CABANG').val()
  var jenis ='JENIS='+$('.JENIS_KB').val()+'-A'
  var no_fatur ='NO_FAKTUR=' + $('.NO_FAKTUR_A').val()
  var nama_supplier ='NAMA_SUPPLIER=' + $('.NAMA_SUPPLIER_A').val()
  var bruto ='BRUTO=' + $('.BRUTO_A').val()
  var potongan = 'POTONGAN=' + $('.POTONGAN_A').val()
  var netto = 'NETTO=' + $('.NETTO_A').val()
  var rp_kg = 'RP_KG=' + $('.RP_KG_A').val()
  var rupiah = 'RUPIAH=' + $('.RUPIAH_A').val()

  var fData = '' + jenis + '&' + id_faktur_cabang + '&' + no_fatur + '&' + nama_supplier + '&' + bruto + '&' + potongan + '&' + netto + '&' + rp_kg + '&' + rupiah + ''

  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=add_gl_a&' + fData ,
  	success: function(data) {
  		if (data.respon.pesan == "sukses")
  		{
  			console.log(data.respon.text_msg);
          list_gl_a();
          $('.NO_FAKTUR_A').val('')
          $('.NAMA_SUPPLIER_A').val('')
          $('.BRUTO_A').val('')
          $('.POTONGAN_A').val('')
          $('.NETTO_A').val('')
          //$('.RP_KG_A').val('')
          $('.RUPIAH_A').val('')
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
////////////////////////////////////////////////// END GELONDONG A //////////////////////////

/////////////////////////////////////////// GELONDONG B //////////////////////////
$('#add_b').click(function()
{
  var id_faktur_cabang ='ID_FAKTUR_CABANG=' + $('.ID_FAKTUR_CABANG').val()
  var jenis ='JENIS='+$('.JENIS_KB').val()+'-B'
  var no_fatur ='NO_FAKTUR=' + $('.NO_FAKTUR_B').val()
  var nama_supplier ='NAMA_SUPPLIER=' + $('.NAMA_SUPPLIER_B').val()
  var bruto ='BRUTO=' + $('.BRUTO_B').val()
  var potongan = 'POTONGAN=' + $('.POTONGAN_B').val()
  var netto = 'NETTO=' + $('.NETTO_B').val()
  var rp_kg = 'RP_KG=' + $('.RP_KG_B').val()
  var rupiah = 'RUPIAH=' + $('.RUPIAH_B').val()

  var fData = '' + jenis + '&' + id_faktur_cabang + '&' + no_fatur + '&' + nama_supplier + '&' + bruto + '&' + potongan + '&' + netto + '&' + rp_kg + '&' + rupiah + ''

  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=add_gl_a&' + fData ,
  	success: function(data) {
  		if (data.respon.pesan == "sukses")
  		{
  			console.log(data.respon.text_msg);
          list_gl_b();
          $('.NO_FAKTUR_B').val('')
          $('.NAMA_SUPPLIER_B').val('')
          $('.BRUTO_B').val('')
          $('.POTONGAN_B').val('')
          $('.NETTO_B').val('')
          //$('.RP_KG_B').val('')
          $('.RUPIAH_B').val('')
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
/////////////////////////////////////////// END GELONDONG B //////////////////////////

/////////////////////////////////////////// GELONDONG C //////////////////////////
$('#add_c').click(function()
{
  var id_faktur_cabang ='ID_FAKTUR_CABANG=' + $('.ID_FAKTUR_CABANG').val()
  var jenis ='JENIS='+$('.JENIS_KB').val()+'-C'
  var no_fatur ='NO_FAKTUR=' + $('.NO_FAKTUR_C').val()
  var nama_supplier ='NAMA_SUPPLIER=' + $('.NAMA_SUPPLIER_C').val()
  var bruto ='BRUTO=' + $('.BRUTO_C').val()
  var potongan = 'POTONGAN=' + $('.POTONGAN_C').val()
  var netto = 'NETTO=' + $('.NETTO_C').val()
  var rp_kg = 'RP_KG=' + $('.RP_KG_C').val()
  var rupiah = 'RUPIAH=' + $('.RUPIAH_C').val()

  var fData = '' + jenis + '&' + id_faktur_cabang + '&' + no_fatur + '&' + nama_supplier + '&' + bruto + '&' + potongan + '&' + netto + '&' + rp_kg + '&' + rupiah + ''

  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=add_gl_a&' + fData ,
  	success: function(data) {
  		if (data.respon.pesan == "sukses")
  		{
  			console.log(data.respon.text_msg);
          list_gl_c();
          $('.NO_FAKTUR_C').val('')
          $('.NAMA_SUPPLIER_C').val('')
          $('.BRUTO_C').val('')
          $('.POTONGAN_C').val('')
          $('.NETTO_C').val('')
          //$('.RP_KG_C').val('')
          $('.RUPIAH_C').val('')
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
/////////////////////////////////////////// END GELONDONG C //////////////////////////

$('.SimpanFaktur').on('click', function(){
  $(this).attr("disabled", true);
  $(this).html('Loading...');
  var fDataFaktuCabang = $('.fDataFaktur').serialize()
  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=add_faktur_cabang&' + fDataFaktuCabang ,
  	success: function(data) {
  		if (data.respon.pesan == "sukses")
  		{
  			console.log(data.respon.text_msg);
          list_gl_a();
          list_gl_b();
          list_gl_c();
          alert("Berhasil disimpan")
          window.location.href = '?show=rmp/faktur_cabang/tambah_faktur_cabang/'+$('.ID_FAKTUR_CABANG').val()+''
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

function input_proses_a(){
  var bruto = $('.BRUTO_A').val()
  var potongan = $('.POTONGAN_A').val()
  var netto = $('.NETTO_A').val()
  var rp_kg = $('.RP_KG_A').val()
  var rupiah = $('.RUPIAH_A').val()

  var input_netto = bruto-potongan
  var input_rupiah = netto*rp_kg
  $('.NETTO_A').val(input_netto)
  $('.RUPIAH_A').val(input_rupiah)
}

function input_proses_b(){
  var bruto = $('.BRUTO_B').val()
  var potongan = $('.POTONGAN_B').val()
  var netto = $('.NETTO_B').val()
  var rp_kg = $('.RP_KG_B').val()
  var rupiah = $('.RUPIAH_B').val()

  var input_netto = bruto-potongan
  var input_rupiah = netto*rp_kg
  $('.NETTO_B').val(input_netto)
  $('.RUPIAH_B').val(input_rupiah)
}

function input_proses_c(){
  var bruto = $('.BRUTO_C').val()
  var potongan = $('.POTONGAN_C').val()
  var netto = $('.NETTO_C').val()
  var rp_kg = $('.RP_KG_C').val()
  var rupiah = $('.RUPIAH_C').val()

  var input_netto = bruto-potongan
  var input_rupiah = netto*rp_kg
  $('.NETTO_C').val(input_netto)
  $('.RUPIAH_C').val(input_rupiah)
}

$('tbody#zone_data_a').on('click', 'a.hapus_a', function(){
  var id = $(this).attr('ID_REKAP_FAKTUR_DETAIL_A')
  hapus_detail_rekap(id)
})
$('tbody#zone_data_b').on('click', 'a.hapus_a', function(){
  var id = $(this).attr('ID_REKAP_FAKTUR_DETAIL_A')
  hapus_detail_rekap(id)
})
$('tbody#zone_data_c').on('click', 'a.hapus_a', function(){
  var id = $(this).attr('ID_REKAP_FAKTUR_DETAIL_A')
  hapus_detail_rekap(id)
})

function hapus_detail_rekap(id){
  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=hapus_detail_rekap&ID=' + id,
  	success: function(data) {
  		if (data.respon.pesan == "sukses")
  		{
  			console.log(data.respon.text_msg);
          list_gl_a();
          list_gl_b();
          list_gl_c();
          alert("Berhasil dihapus")
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
}

</script>
