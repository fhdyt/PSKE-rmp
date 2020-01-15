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
  if ($faktur_cabang[0]['RMP_REKAP_FC_PROSES_ADM_PKB'] == "Yes")
  {
    $warning = "";
    $buttonwaring = "YES";
  }
  else {
    $warning = "";
    $buttonwaring = "";
  }
}
 ?>
<style>

.modalMD
{
  width: 400px;
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
        <div class="row">
          <div class="col-md-12">
            <div class="callout callout-warning warning_faktur" hidden>
                <h4>Faktur telah diproses oleh Admin PKB!</h4>

                <p>Anda tidak dapat melakukan perubahan.</p>
              </div>
          </div>
        </div>

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
                  <option <?php if ($faktur_cabang[0]['RMP_REKAP_FC_TIMBANG'] == "PTN-3" ) echo 'selected' ; ?> value="PTN-2">Ponton 3</option>
                </select>
                <small class="help-block">Timbang Ponton</small>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">Jenis Kelapa Bulat</label>
                <select class="form-control JENIS_KB" id="JENIS_KB" name="JENIS_KB" onchange="potongan()">
                  <option value="">--Pilih Kelapa Bulat--</option>
                  <option <?php if ($faktur_cabang[0]['RMP_REKAP_FC_JENIS_KB'] == "JAMBUL" ) echo 'selected' ; ?> value="JAMBUL">JAMBUL</option>
                  <option <?php if ($faktur_cabang[0]['RMP_REKAP_FC_JENIS_KB'] == "LICIN" ) echo 'selected' ; ?> value="LICIN">LICIN</option>
                  <option <?php if ($faktur_cabang[0]['RMP_REKAP_FC_JENIS_KB'] == "GELONDONG" ) echo 'selected' ; ?> value="GELONDONG">GELONDONG</option>
                </select>
                <small class="help-block">Jenis Material Kelapa Bulat</small>
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
            <div class="col-md-3">
              <div class="form-group">
                  <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">Harga Kelapa Bulat</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon2">Rp.</span>
                  <input autocomplete="off" class="form-control HARGA_KELAPA_BULAT" id="HARGA_KELAPA_BULAT" name="HARGA_KELAPA_BULAT" placeholder="" type="text" value="<?php echo $faktur_cabang[0]['RMP_REKAP_FC_KELAPA'] ?>">
                </div>
                  <small class="help-block">Quantity Terima A PSKE</small>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                  <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">QTY PSKe A</label>
                <div class="input-group">
                  <input autocomplete="off" class="form-control QTY_TERIMA_PSKE_A" id="QTY_TERIMA_PSKE_A" name="QTY_TERIMA_PSKE_A" placeholder="" type="text" value="<?php echo $faktur_cabang[0]['RMP_REKAP_FC_QTY_PSKE_A'] ?>">
                  <span class="input-group-addon" id="basic-addon2">Kg</span>
                </div>
                  <small class="help-block">Quantity Terima A PSKE</small>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                  <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">QTY PSKe B</label>
                <div class="input-group">
                  <input autocomplete="off" class="form-control QTY_TERIMA_PSKE_B" id="QTY_TERIMA_PSKE_B" name="QTY_TERIMA_PSKE_B" placeholder="" type="text" value="<?php echo $faktur_cabang[0]['RMP_REKAP_FC_QTY_PSKE_B'] ?>" >
                  <span class="input-group-addon" id="basic-addon2">Kg</span>
                </div>
                  <small class="help-block">Quantity Terima B PSKE</small>
              </div>
            </div>
            <div class="col-md-3">
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
          <div class="row potongan" hidden>
            <div class="col-md-3">
              <div class="form-group">
                  <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">Potongan Kelapa A</label>
                <div class="input-group">
                  <input autocomplete="off" class="form-control POTONGAN_KELAPA_A" id="POTONGAN_KELAPA_A" name="POTONGAN_KELAPA_A" placeholder="" type="text" value="<?php echo $faktur_cabang[0]['RMP_REKAP_FC_POTONGAN_A'] ?>">
                  <span class="input-group-addon" id="basic-addon2">%</span>
                </div>
                  <small class="help-block">Potonga Kelapa A, Jika Ada</small>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                  <label for="ICD_TRANSAKSI_INVENTORI_LOKASI">Potongan Kelapa B</label>
                <div class="input-group">
                  <input autocomplete="off" class="form-control POTONGAN_KELAPA_B" id="POTONGAN_KELAPA_B" name="POTONGAN_KELAPA_B" placeholder="" type="text" value="<?php echo $faktur_cabang[0]['RMP_REKAP_FC_POTONGAN_B'] ?>">
                  <span class="input-group-addon" id="basic-addon2">%</span>
                </div>
                  <small class="help-block">Potonga Kelapa B, Jika Ada</small>
              </div>
            </div>
            <div class="col-md-6">
            </div>
          </div>
        <br>
        <br>
      </form>

      <!-- Custom Tabs -->
<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab_1" data-toggle="tab">Faktur Cabang</a></li>
    <li><a href="#tab_2" data-toggle="tab">Faktur PSKE</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab_1">
      <hr>
      <div class="row">
        <div class="col-md-12">
          <center><h4>Kelapa Bulat A</h4></center>
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
      <hr>

      <div class="row">
        <div class="col-md-12">
          <center><h4>Kelapa Bulat B</h4></center>
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
      <hr>

      <div class="row">
        <div class="col-md-12">
          <center><h4>Kelapa Bulat C</h4></center>
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
    </div>
    <!-- /.tab-pane -->
    <div class="tab-pane" id="tab_2">
      <hr>
      <div class="row">
        <div class="col-md-12">
          <center><h4>Kelapa Bulat A</h4></center>
        </div>
        <div class="col-md-12">
          <a class="btn btn-primary btn-sm tambah_proses_baru" GRADE="A"><i class="fa fa-plus"></i></a>
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Relasi</th>
                <th>Bruto</th>
                <th>Potongan</th>
                <th>Netto</th>
                <th>Rupiah KB</th>
                <th>TGB</th>
                <th>Biaya</th>
                <th>TTL Rupiah</th>
                <th>@Rp/Kg</th>
              </tr>
            </thead>
            <tbody id="proses_data_a">
              <tr>
                <td colspan="10">
                  <center>
                    <div class="loader"></div>
                  </center>
                </td>
              </tr>
            </tbody>
            <tfoot id="proses_total_a">
              <tr id="proses_total_a_tr" class="warning">
                <td colspan="2" class="text-center">Total</td>
                <td id="td_total_bruto_a"></td>
                <td id="td_total_potongan_a"></td>
                <td id="td_total_netto_a"></td>
                <td id="td_total_rupiah_a"></td>
                <td id="td_total_tambang_a"></td>
                <td id="td_total_biaya_a"></td>
                <td id="td_total_seluruh_a"></td>
                <td></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <center><h4>Kelapa Bulat B</h4></center>
        </div>
        <div class="col-md-12">
          <a class="btn btn-primary btn-sm tambah_proses_baru" GRADE="B"><i class="fa fa-plus"></i></a>
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Relasi</th>
                <th>Bruto</th>
                <th>Potongan</th>
                <th>Netto</th>
                <th>Rupiah KB</th>
                <th>TGB</th>
                <th>Biaya</th>
                <th>TTL Rupiah</th>
                <th>@Rp/Kg</th>
              </tr>
            </thead>
            <tbody id="proses_data_b">
              <tr>
                <td colspan="10">
                  <center>
                    <div class="loader"></div>
                  </center>
                </td>
              </tr>
            </tbody>
            <tfoot id="proses_total_b">
              <tr id="proses_total_a_tr" class="warning">
                <td colspan="2" class="text-center">Total</td>
                <td id="td_total_bruto_a"></td>
                <td id="td_total_potongan_a"></td>
                <td id="td_total_netto_a"></td>
                <td id="td_total_rupiah_a"></td>
                <td id="td_total_tambang_a"></td>
                <td id="td_total_biaya_a"></td>
                <td id="td_total_seluruh_a"></td>
                <td></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <center><h4>Kelapa Bulat C</h4></center>
        </div>
        <div class="col-md-12">
          <a class="btn btn-primary btn-sm tambah_proses_baru" GRADE="C"><i class="fa fa-plus"></i></a>
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Relasi</th>
                <th>Bruto</th>
                <th>Potongan</th>
                <th>Netto</th>
                <th>Rupiah KB</th>
                <th>TGB</th>
                <th>Biaya</th>
                <th>TTL Rupiah</th>
                <th>@Rp/Kg</th>
              </tr>
            </thead>
            <tbody id="proses_data_c">
              <tr>
                <td colspan="10">
                  <center>
                    <div class="loader"></div>
                  </center>
                </td>
              </tr>
            </tbody>
            <tfoot id="proses_total_c">
              <tr id="proses_total_a_tr" class="warning">
                <td colspan="2" class="text-center">Total</td>
                <td id="td_total_bruto_a"></td>
                <td id="td_total_potongan_a"></td>
                <td id="td_total_netto_a"></td>
                <td id="td_total_rupiah_a"></td>
                <td id="td_total_tambang_a"></td>
                <td id="td_total_biaya_a"></td>
                <td id="td_total_seluruh_a"></td>
                <td></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <!-- /.tab-pane -->
  </div>
  <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->

        <br>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <?php echo $warning; ?>
            <a class="btn btn-success SimpanFaktur">Simpan</a>
            <a class="btn btn-default proses_faktur_cabang">Proses Faktur Cabang</a>
            <a class="btn btn-default" href="?show=rmp/faktur_cabang/review_faktur_cabang/<?php echo $id_faktur;  ?>" style="display:none;">Review</a>

          </div>
          <div class="col-md-6">

          </div>
        </div>

      </div>
    </div>
  </div>
</div>





<!-- MODAL EDIT PROSES DATA -->
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalEditDataProses" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Data PSKE</h4>
			</div>
			<div class="modal-body">

				<form action="javascript:download();" class="fDataProses form-horizontal" id="fDataProses" name="fDataProses">
              <div class="form-group">
                <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Nama</label>
                <div class="col-sm-8">
                <input autocomplete="off" class="form-control PROSES_ID_FAKTUR_CABANG form-control" id="PROSES_ID_FAKTUR_CABANG" name="PROSES_ID_FAKTUR_CABANG" placeholder="" type="hidden" value="">
                <input autocomplete="off" class="form-control PROSES_JENIS_KB form-control" id="PROSES_JENIS_KB" name="PROSES_JENIS_KB" placeholder="" type="hidden" value="">
                <input autocomplete="off" class="form-control PROSES_TANGGAL form-control" id="PROSES_TANGGAL" name="PROSES_TANGGAL" placeholder="" type="hidden" value="">
                <input autocomplete="off" class="form-control PROSES_ID form-control" id="PROSES_ID" name="PROSES_ID" placeholder="" type="hidden" value="">
                <input autocomplete="off" class="form-control PROSES_NAMA" id="PROSES_NAMA" name="PROSES_NAMA" placeholder="" type="text" value="">
              </div>
              </div>
              <div class="form-group">
                <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Bruto</label>
                <div class="col-sm-8">
                <input autocomplete="off" class="form-control PROSES_BRUTO form-control" id="PROSES_BRUTO" name="PROSES_BRUTO" placeholder="" type="number" value="" onkeyup="kalkulasi_data_proses()">
              </div>
              </div>
              <div class="form-group">
                <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Potongan</label>
                <div class="col-sm-8">
                <input autocomplete="off" class="form-control PROSES_POTONGAN" id="PROSES_POTONGAN" name="PROSES_POTONGAN" placeholder="" type="number" value="" onkeyup="kalkulasi_data_proses()">
              </div>
            </div>
              <div class="form-group">
                <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Netto</label>
                <div class="col-sm-8">
                <input autocomplete="off" class="form-control PROSES_NETTO" id="PROSES_NETTO" name="PROSES_NETTO" placeholder="" type="number" value="" onkeyup="kalkulasi_data_proses()">
              </div>
            </div>
              <div class="form-group">
                <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Rupiah KB</label>
                <div class="col-sm-8">
                <input autocomplete="off" class="form-control PROSES_RUPIAH_KB" id="PROSES_RUPIAH_KB" name="PROSES_RUPIAH_KB" placeholder="" type="number" value="" onkeyup="kalkulasi_data_proses()">
              </div>
            </div>
              <div class="form-group">
                <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">TGB</label>
                <div class="col-sm-8">
                <input autocomplete="off" class="form-control PROSES_TAMBANG" id="PROSES_TAMBANG" name="PROSES_TAMBANG" placeholder="" type="number" value="" onkeyup="kalkulasi_data_proses()">
              </div>
            </div>
              <div class="form-group">
                <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Biaya</label>
                <div class="col-sm-8">
                <input autocomplete="off" class="form-control PROSES_BIAYA" id="PROSES_BIAYA" name="PROSES_BIAYA" placeholder="" type="number" value="" onkeyup="kalkulasi_data_proses()">
              </div>
            </div>
              <div class="form-group">
                <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">TTL Rupiah</label>
                <div class="col-sm-8">
                <input autocomplete="off" class="form-control PROSES_RUPIAH_TOTAL" id="PROSES_RUPIAH_TOTAL" name="PROSES_RUPIAH_TOTAL" placeholder="" type="number" value="" onkeyup="kalkulasi_data_proses()">
              </div>
            </div>
              <div class="form-group">
                <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">@Rp/Kg</label>
                <div class="col-sm-8">
                <input autocomplete="off" class="form-control PROSES_RP_KG" id="PROSES_RP_KG" name="PROSES_RP_KG" placeholder="" type="number" value="" onkeyup="kalkulasi_data_proses()">
              </div>
            </div>
              </form>

          <div class="row">
            <div class="col-md-12 text-right">
              <div class="form-group">
    						<button class="btn btn-success btn-sm SIMPAN_EDIT_PROSES">Simpan</button>
    					</div>
            </div>
          </div>

		</div>
	</div>
</div>
</div>
<!-- MODAL EDIT PROSES DATA -->
<script>



$(function()
{
  if ("<?php echo $buttonwaring; ?>" == "YES")
  {
    $("div.warning_faktur").attr("hidden", false)
    $("a").attr("disabled", true)
    $("button").attr("disabled", true)
    $("input").attr("disabled", true)
    $("select").attr("disabled", true)
    $("text").attr("disabled", true)
  }

	$(".datepicker").datepicker().on('changeDate', function(ev)
	{
		$('.datepicker').datepicker('hide');
	});
  potongan();
});

function potongan(){
  if($('.JENIS_KB').val() == "JAMBUL" || $('.JENIS_KB').val() == "LICIN" )
  {
    $('div.potongan').attr('hidden', false)
  }
  else {
    $('div.potongan').attr('hidden', true)
  }
}

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
  if($("select.CABANG").val() == "")
  {
    alert("Pilih Cabang")
  }
  else if($("input.KAPAL").val() == "")
  {
    alert("Nama Kapal Harus Diisi")
  }
  else if($("select.PONTON").val() == "")
  {
    alert("Pilih Ponton")
  }
  else if($("select.JENIS_KB").val() == "")
  {
    alert("Pilih Jenis Kelapa Bulat")
  }
  else if($("input.TANGGAL_FAKTUR_CABANG").val() == "")
  {
    alert("Tanggal Faktur Cabang Harus Disi")
  }
  else if($("input.TAMBANG").val() == "")
  {
    alert("Tambang Harus Disi")
  }
  else if($("input.BIAYA").val() == "")
  {
    alert("Biaya Harus Disi")
  }
  else {
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
}
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



//////////////////////////////////////////////////////////////////// DATA PSKE////////////
//////////////////////////////////////////////////////////////////// DATA PSKE////////////
//////////////////////////////////////////////////////////////////// DATA PSKE////////////
//////////////////////////////////////////////////////////////////// DATA PSKE////////////
//////////////////////////////////////////////////////////////////// DATA PSKE////////////
function list_cabang_proses_a()
{
  var id_faktur ="<?php echo $id_faktur; ?>"
  console.log(id_faktur)
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=list_cabang_proses_a&ID_FAKTUR=' + id_faktur + '&JENIS_KB='+$('.JENIS_KB').val()+'-A',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        //$('.TEST').html(data.respon.text_msg)
        //////////// GELODONG A
        $("tbody#proses_data_a").empty();
        for (i = 0; i < data.result_a.length; i++) {
          $("tbody#proses_data_a").append("<tr id='edit_proses' ID_data='" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
					"<td>" + data.result_a[i].NO + ".</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_NAMA + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_BRUTO + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_POTONGAN + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_NETTO + "</td>" +
          "<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_RUPIAH_KB + "</td>" +
          "<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_TAMBANG + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_BIAYA + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_RUPIAH_TOTAL + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_RP_KG + "</td>" +
          "<td><a class='btn btn-success btn-sm edit_proses_a' ID_data='" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'><i class='fa fa-pencil'></i></a> " +
          "<a class='btn btn-danger btn-sm hapus_proses_a' ID_data='" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'><i class='fa fa-trash'></i></a></td>" +
          "</tr>");
					}

        $("tfoot#proses_total_a").empty();
        for (i = 0; i < data.result_total_a.length; i++) {
          console.log(data.result_total_a[i].BRUTO)
          $("tfoot#proses_total_a").append("<tr class='warning'>" +
					"<td colspan='2' class='text-center'><b>Total</b></td>" +
					"<td ><b>" + data.result_total_a[i].BRUTO + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].POTONGAN + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].NETTO + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].RUPIAH_KB + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].TAMBANG + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].BIAYA + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].TOTAL_RUPIAH + "</b></td>" +
          "<td></td>" +
          "</tr>");
					}
          //////////// end GELODONG A
      } else if (data.respon.pesan == "gagal") {
        $("tfoot#proses_total_a").empty();
        $("tbody#proses_data_a").empty();
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

function list_cabang_proses_b()
{
  var id_faktur ="<?php echo $id_faktur; ?>"
  console.log(id_faktur)
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=list_cabang_proses_a&ID_FAKTUR=' + id_faktur + '&JENIS_KB='+$('.JENIS_KB').val()+'-B',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        //$('.TEST').html(data.respon.text_msg)
        //////////// GELODONG A
        $("tbody#proses_data_b").empty();
        for (i = 0; i < data.result_a.length; i++) {
          $("tbody#proses_data_b").append("<tr id='edit_proses' ID_data='" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
					"<td>" + data.result_a[i].NO + ".</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_NAMA + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_BRUTO + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_POTONGAN + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_NETTO + "</td>" +
          "<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_RUPIAH_KB + "</td>" +
          "<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_TAMBANG + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_BIAYA + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_RUPIAH_TOTAL + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_RP_KG + "</td>" +
          "<td><a class='btn btn-success btn-sm edit_proses_a' ID_data='" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'><i class='fa fa-pencil'></i></a> " +
          "<a class='btn btn-danger btn-sm hapus_proses_a' ID_data='" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'><i class='fa fa-trash'></i></a></td>" +
          "</tr>");
					}

        $("tfoot#proses_total_b").empty();
        for (i = 0; i < data.result_total_a.length; i++) {
          console.log(data.result_total_a[i].BRUTO)
          $("tfoot#proses_total_b").append("<tr class='warning'>" +
					"<td colspan='2' class='text-center'><b>Total</b></td>" +
					"<td ><b>" + data.result_total_a[i].BRUTO + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].POTONGAN + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].NETTO + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].RUPIAH_KB + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].TAMBANG + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].BIAYA + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].TOTAL_RUPIAH + "</b></td>" +
          "<td></td>" +
          "</tr>");
					}
          //////////// end GELODONG A
      } else if (data.respon.pesan == "gagal") {
        $("tfoot#proses_total_b").empty();
        $("tbody#proses_data_b").empty();
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

function list_cabang_proses_c()
{
  var id_faktur ="<?php echo $id_faktur; ?>"
  console.log(id_faktur)
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=list_cabang_proses_a&ID_FAKTUR=' + id_faktur + '&JENIS_KB='+$('.JENIS_KB').val()+'-C',
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        //$('.TEST').html(data.respon.text_msg)
        //////////// GELODONG A
        $("tbody#proses_data_c").empty();
        for (i = 0; i < data.result_a.length; i++) {
          $("tbody#proses_data_c").append("<tr id='edit_proses' ID_data='" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'>" +
					"<td>" + data.result_a[i].NO + ".</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_NAMA + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_BRUTO + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_POTONGAN + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_NETTO + "</td>" +
          "<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_RUPIAH_KB + "</td>" +
          "<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_TAMBANG + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_BIAYA + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_RUPIAH_TOTAL + "</td>" +
					"<td>" + data.result_a[i].RMP_REKAP_FC_PROSES_RP_KG + "</td>" +
          "<td><a class='btn btn-success btn-sm edit_proses_a' ID_data='" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'><i class='fa fa-pencil'></i></a> " +
          "<a class='btn btn-danger btn-sm hapus_proses_a' ID_data='" + data.result_a[i].RMP_REKAP_FC_PROSES_ID  + "'><i class='fa fa-trash'></i></a></td>" +
          "</tr>");
					}

        $("tfoot#proses_total_c").empty();
        for (i = 0; i < data.result_total_a.length; i++) {
          console.log(data.result_total_a[i].BRUTO)
          $("tfoot#proses_total_c").append("<tr class='warning'>" +
					"<td colspan='2' class='text-center'><b>Total</b></td>" +
					"<td ><b>" + data.result_total_a[i].BRUTO + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].POTONGAN + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].NETTO + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].RUPIAH_KB + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].TAMBANG + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].BIAYA + "</b></td>" +
					"<td ><b>" + data.result_total_a[i].TOTAL_RUPIAH + "</b></td>" +
          "<td></td>" +
          "</tr>");
					}
          //////////// end GELODONG A
      } else if (data.respon.pesan == "gagal") {
        $("tfoot#proses_total_c").empty();
        $("tbody#proses_data_c").empty();
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

$(function(){
list_cabang_proses_a()
list_cabang_proses_b()
list_cabang_proses_c()
})


$('tbody#proses_data_a').on('click', 'a.edit_proses_a', function(){
  ambil_data_proses($(this).attr('ID_data'))
  //hapus_detail_rekap(id)
})
$('tbody#proses_data_b').on('click', 'a.edit_proses_a', function(){
  ambil_data_proses($(this).attr('ID_data'))
  //hapus_detail_rekap(id)
})
$('tbody#proses_data_c').on('click', 'a.edit_proses_a', function(){
  ambil_data_proses($(this).attr('ID_data'))
  //hapus_detail_rekap(id)
})

// $('tbody#proses_data_a, tbody#proses_data_b, tbody#proses_data_c').on('click', 'tr#edit_proses', function(){
//   ambil_data_proses($(this).attr('ID_data'))
// })

function kalkulasi_data_proses()
{
  var bruto = $(".PROSES_BRUTO").val()
  var potongan = $(".PROSES_POTONGAN").val()
  var netto = bruto - potongan
  $(".PROSES_NETTO").val(netto)
  var rp_kg = $(".PROSES_RP_KG").val()
  var tambang = $(".PROSES_TAMBANG").val()
  var biaya = $(".PROSES_BIAYA").val()
  var rupiah_kb = $(".PROSES_RUPIAH_KB").val()
  var total = parseInt(tambang) + parseInt(biaya) + parseInt(rupiah_kb)
  $(".PROSES_RUPIAH_TOTAL").val(total)
  //var rupiah_kb = (netto * rp_kg) - tambang - biaya
  //$(".PROSES_RUPIAH_KB").val(rupiah_kb)
}

function ambil_data_proses(id)
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=ambil_data_proses&ID=' + id,
    success: function(data) {
      if (data.respon.pesan == "sukses") {
        for (i = 0; i < data.result.length; i++) {
          $(".PROSES_ID").val(data.result[i].RMP_REKAP_FC_PROSES_ID)
          $(".PROSES_NAMA").val(data.result[i].RMP_REKAP_FC_PROSES_NAMA)
          $(".PROSES_BRUTO").val(data.result[i].RMP_REKAP_FC_PROSES_BRUTO)
          $(".PROSES_POTONGAN").val(data.result[i].RMP_REKAP_FC_PROSES_POTONGAN)
          $(".PROSES_NETTO").val(data.result[i].RMP_REKAP_FC_PROSES_NETTO)
          $(".PROSES_RUPIAH_KB").val(data.result[i].RMP_REKAP_FC_PROSES_RUPIAH_KB)
          $(".PROSES_TAMBANG").val(data.result[i].RMP_REKAP_FC_PROSES_TAMBANG)
          $(".PROSES_BIAYA").val(data.result[i].RMP_REKAP_FC_PROSES_BIAYA)
          $(".PROSES_RUPIAH_TOTAL").val(data.result[i].RMP_REKAP_FC_PROSES_RUPIAH_TOTAL)
          $(".PROSES_RP_KG").val(data.result[i].RMP_REKAP_FC_PROSES_RP_KG)
					}
          $('.modalEditDataProses').modal('show')
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

$(".proses_faktur_cabang").on("click", function(){
  $(this).html("Loading...")
  proses_faktur_cabang('list_review_faktur_cabang_a')
  proses_faktur_cabang('list_review_faktur_cabang_b')
  proses_faktur_cabang('list_review_faktur_cabang_c')
})

function proses_faktur_cabang(url){
  var id_faktur = "<?php echo $d3; ?>"
  //alert(url)
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref='+url+'&ID_FAKTUR=' + id_faktur,
    success: function(data) {
      if (data.respon.pesan == "sukses")
      {
        list_cabang_proses_a()
        list_cabang_proses_b()
        list_cabang_proses_c()
        if (url == 'list_review_faktur_cabang_c')
        {
        $(".proses_faktur_cabang").html("Proses Faktur Cabang")
        }
      } else if (data.respon.pesan == "gagal")
      {
        list_cabang_proses_a()
        list_cabang_proses_b()
        list_cabang_proses_c()
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}

$('.SIMPAN_EDIT_PROSES').on('click', function(){

  var fData = $('.fDataProses').serialize();
  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=simpan_edit_proses&' + fData ,
  	success: function(data) {
  		if (data.respon.pesan == "sukses")
  		{
        list_cabang_proses_a()
        list_cabang_proses_b()
        list_cabang_proses_c()
  			$('.modalEditDataProses').modal('hide')
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

$('tbody#proses_data_a').on('click', 'a.hapus_proses_a', function(){
  var id = $(this).attr('ID_data')
  hapus_proses(id)
})
$('tbody#proses_data_b').on('click', 'a.hapus_proses_a', function(){
  var id = $(this).attr('ID_data')
  hapus_proses(id)
})
$('tbody#proses_data_c').on('click', 'a.hapus_proses_a', function(){
  var id = $(this).attr('ID_data')
  hapus_proses(id)
})

function hapus_proses(id){
  $.ajax({
  	type: 'POST',
  	url: refseeAPI,
  	dataType: 'json',
  	data: 'ref=hapus_proses&ID=' + id,
  	success: function(data) {
  		if (data.respon.pesan == "sukses")
  		{
  			console.log(data.respon.text_msg);
        list_cabang_proses_a()
        list_cabang_proses_b()
        list_cabang_proses_c()
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

$(".tambah_proses_baru").on('click', function(){
  $(".PROSES_ID").val("")
  $(".PROSES_NAMA").val("")
  $(".PROSES_BRUTO").val("")
  $(".PROSES_POTONGAN").val("")
  $(".PROSES_NETTO").val("")
  $(".PROSES_RUPIAH_KB").val("")
  $(".PROSES_TAMBANG").val("")
  $(".PROSES_BIAYA").val("")
  $(".PROSES_RUPIAH_TOTAL").val("")
  $(".PROSES_RP_KG").val("")

  $(".PROSES_ID_FAKTUR_CABANG").val("<?php echo $d3; ?>")
  var grade = $(this).attr("GRADE")
  var material = $(".JENIS_KB").val()
  $(".PROSES_JENIS_KB").val(material+"-"+grade)
  var tanggal = $(".TANGGAL_FAKTUR_CABANG").val()
  $(".PROSES_TANGGAL").val(tanggal)
  $('.modalEditDataProses').modal('show')

})
</script>
