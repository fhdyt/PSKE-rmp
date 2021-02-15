
<style>
.panel-fullscreen {
display: block;
z-index: 9999;
position: fixed;
width: 100%;
height: 100%;
top: 0;
right: 0;
left: 0;
bottom: 0;
overflow: auto;
}

.box-grafik {
width: 100%;
height: 70%;
}


.wo-bg-yellow{background:#EFCD12;}
.wo-bg-red{background:#F22248;}


.tabel-utama tr {
  border: 1px solid #A09D9D;
}

.tabel-utama tr td {
  border: 1px solid #A09D9D;
}

.tabel-utama tbody tr {
  border: 1px solid #A09D9D;
}

.tabel-utama thead tr {
  border: 1px solid #A09D9D;
}

.tabel-utama tr th {
  border: 1px solid #A09D9D;
}
.trBaris {
  border:1px solid #A09D9D !important;
  padding:0 0 0 3px !important;
}
.trDetail:hover {
  background:#D8EAF5 !important;
}
.trDetailLibur {
  background:#E96060 !important;
}
.trDetailLibur:hover {
  background:#E96060 !important;
}
.trSumAP {
  border:1px solid #A09D9D !important;
  background:#d3e0ea !important;/*// 8FBC8F*/
  padding:0 0 0 3px !important;
}
.trSumFaktur {
  border:1px solid #A09D9D !important;
  background:#5eaaa8 !important;/*6ADAFF*/
  padding:0 0 0 3px !important;
}
.trSumSuplier {
  border:1px solid #A09D9D !important;
  background:#1687a7 !important;/*6ADAFF*/
  padding:0 0 0 3px !important;
}
.trBold{font-weight:bold !important;}
.trInfo{font-size:10px;
		color:#fff;
		line-height: -2px !important; }
</style>
<?php
//info personal
//$params=array('case'=>"nonlogin_master_beranda",'data_http'=>$_COOKIE['data_http'],'input_option'=>array('PERSONAL_NIK'=>$cf['user_login']['PERSONAL_NIK'])); 
//$home_master=$SISTEM->personal($params)->load->module; 

#echo "<pre>".print_r($home_master,true)."</pre>";


### Default Tab yang aktif #####
if(empty($d3)){
	$d3="wo_out";	
}else{
	$d3=$d3;
}
/*
$input_option=array();
$params=array(
	'case'=>"nonlogin_ambil_bagian",
	'batas'=>$_POST['batas'],
	'halaman'=>$_POST['halaman'],
	'data_http'=>$_COOKIE['data_http'],
	'token_http'=>$_COOKIE['token_http'],
	'input_option'=>$input_option,
);

$respon=$LAPORAN->laporan_kerja($params)->load->module;
#echo "<pre>".print_r($respon['result'],true)."</pre>";
foreach($respon['result'] as $row)
{
	$bagian[]=$row;
}


$input_options=array();
$paramsD=array(
	'case'=>"nonlogin_ambil_departemen",
	'batas'=>$_POST['batas'],
	'halaman'=>$_POST['halaman'],
	'data_http'=>$_COOKIE['data_http'],
	'token_http'=>$_COOKIE['token_http'],
	'input_option'=>$input_options,
);
$responD=$LAPORAN->laporan_kerja($paramsD)->load->module;
#echo "<pre>".print_r($responD['respon'],true)."</pre>";
foreach($responD['result'] as $rowD)
{
	$dept[]=$rowD;
}
$COMPANY_UNIT_ID=$responD['respon']['COMPANY_UNIT_ID'];

//echo "XXX-".$user_login['PERSONAL_NIK'];
*/
?>

<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="list-group">
			<div class="list-group-item">
				<div class="row">
					<div class="col-md-12" >
						<!--FORM-->
						<form class="fData" action="javascript:filter();">
							<div class="row">
								
								<div class="col-md-3 form-group">
									<label for="COMPANY_UNIT_ID">Jenis Material</label>
									<select class="form-control JENIS_MATERIAL" id="JENIS_MATERIAL" name="JENIS_MATERIAL" onchange="pilih_material()">
									<option value="">--Pilih Material--</option>
										<option value="KOPRA" nama_material="KOPRA">KOPRA</option>
										<option value="JAMBUL" nama_material="JAMBUL">JAMBUL</option>
										<option value="GELONDONG" nama_material="GELONDONG">GELONDONG</option>
									</select>
								</div>

								<div class="col-md-3">
									<div class="form-group"  class="text-left">
										<label for="LAPORAN_KERJA_UNIT_ID">Wilayah/No. Rekening</label>
										<div class="input-group">
											<input autocomplete="off" class="form-control NOMOR_REKENING" id="NOMOR_REKENING" name="NOMOR_REKENING" placeholder="" type="text">
											<span class="input-group-btn" style="border:none !important;padding:0 !important;">
												<button type="button" class="btn btn-info btn-flat" id="reload_suplier" onclick="sel_nama_supplier_rekening()">
													<strong><i class="fa fa-refresh"></i></strong>
												</button>
											</span>
											
										</div>
									</div>
								</div>
								<div class="col-md-3 form-group">
									<label for="PERSONAL_NIK">Nama Suplier</label>
									<select class="form-control NAMA_SUPPLIER" style="width: 100%;" aria-hidden="true" id="NAMA_SUPPLIER" name="NAMA_SUPPLIER" onchange="pilih_supplier()">
										<option value="0">--Pilih--</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2 form-group">
									<label for="JENIS_LAPORAN">Jenis Laporan</label>
										<select class="form-control col-sm-2" name="JENIS_LAPORAN" id="JENIS_LAPORAN" onchange="jenisAkumulasi()" required>
											<!--<option value="0">--Pilih--</option>-->
											<option value="Harian" selected>Harian</option>
											<option value="Mingguan">Mingguan</option>
											<option value="Bulanan">Bulanan</option>
											<option value="Tahunan">Tahunan</option>
											<option value="Pengaturan">Pengaturan</option>
										</select>
								</div>
								
								<div class="col-md-2 form-group tanggalawal"  id="divtanggalawal">
									<label for="DATA_sDATE" id="labelsDate">Tanggal awal</label>
									<input id="DATA_sDATE" name="DATA_sDATE"  type="text" class="datepicker col-sm-2 form-control"  placeholder="<?php echo Date("Y/m/d"); ?>" value="<?php echo Date("Y/m/d"); ?>"  autocomplete="off">
								</div>
								<div class="col-md-2 form-group tanggalakhir" id="divtanggalakhir">
									<label for="DATA_eDATE" id="eDate">Tanggal akhir</label>
									<input id="DATA_eDATE" name="DATA_eDATE"  type="text" class="col-sm-2 form-control"  placeholder="<?php echo Date("Y/m/d"); ?>" value="" autocomplete="off">
								</div>
								<div class="col-md-2 form-group" id="divbulanfilter">
									<label for="BULAN_FILTER">Bulan</label>
										<select class="form-control col-sm-2" name="BULAN_FILTER" id="BULAN_FILTER">
											<option value="0">--Pilih bulan--</option>
											<?php 
												$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
												for($bln=1;$bln<=12;$bln++){
													$datenya=Date("m");
													if($bln<=9)
													{
														$blns="0".$bln;
													}else
													{
														$blns=$bln;
													}
													if($blns==$datenya)
													{
														$pilih="selected";	
													}else{$pilih="";}
													echo"<option value='$blns' $pilih>$array_bulan[$bln]</option>";
												}
											?>
										</select>
								</div>
								
								<div class="col-md-2  form-group" id="divtahunfilter">
									<label for="TAHUN_FILTER">Tahun</label>
									<select class="form-control col-sm-2" name="TAHUN_FILTER" id="TAHUN_FILTER">
										<option value="0">--Pilih tahun--</option>
										<?php
											$thnsekarang=Date('Y');
											$thnsebelumnya=$thnsekarang-7;
											for($thn=$thnsebelumnya;$thn<=$thnsekarang;$thn++){
												if($thn==$thnsekarang)
												{
													$pilihth="selected";	
												}else{$pilihth="";}
												echo"<option value='$thn' $pilihth>$thn</option>";
											} ?>
									</select>
								</div>
								
								
								<div class="col-md-1">
									<label>&nbsp;</label>
									<div class="input-group custom-search-form">
										<span class="input-group-btn">
											<button class="btn btn-primary btn-view" type="submit" id="btn-reload">
												<strong><i class="fa fa-refresh"></i> Refresh</strong>
											</button>
										</span> &nbsp;
										<span class="input-group-btn">
											<button class="btn btn-danger btn-view" title="PDF" type="button" id="btn-excel">
											<strong><i class="fa fa-file-pdf-o" aria-hidden="true"></i></strong>
										</button>
										</span> &nbsp;
										<span class="input-group-btn">
											<button class="btn btn-warning btn-view" title="HTML" type="button" id="btn-html">
											<strong><i class="fa fa-file-code-o" aria-hidden="true"></i></strong>
										</button>
										</span>
									</div>
								</div>
								
								
							</div><!--/row-->
						</form>
						<!--END FORM-->
						<table class="table table-responsive table-hover tabel-utama" style="border: 1px solid #A09D9D;">
							<tr style="border: 1px solid #A09D9D;">
								<th class="text-center">Supplier</th>
								<th class="text-center">No AP</th>
								<th class="text-center" width="90px;">Tgl AP</th>
								<th class="text-center">Nilai AP</th>
								<th class="text-center">No Invoice</th>
								<th class="text-center" width="90px;">Tgl Invoice</th>
								<th class="text-center">Nilai Invoice</th>
								<th class="text-center" colspan='2'>Nilai Pengajuan</th>
								<th class="text-center" width="90px;">Tgl Bayar</th>
								<th class="text-center">ReffNo</th>
								<th class="text-center">Nilai Bayar</th>
							</tr>
							<tbody id="zone_data" style="border: 1px solid A09D9D;">
								<tr><td colspan="10" class="text-center">
									<div class="sk-wave">
									<div class="sk-rect sk-rect1"></div>
									<div class="sk-rect sk-rect2"></div>
									<div class="sk-rect sk-rect3"></div>
									<div class="sk-rect sk-rect4"></div>
									<div class="sk-rect sk-rect5"></div>
									</div>
								</td></tr>
							</tbody>
						</table>
							
					</div>
				</div><!--/.row-->
				
			</div><!--/.list-group-item-->
			
		</div><!--/.list-group-->
	</div><!--/.col-->
</div><!--/.row-->




<script>
/////////////////FORMAT ANGKA
String.prototype.format = String.prototype.Format = function () {
    var args = arguments;
    return this.replace(/{(\d+)}/g, function (match, number) {
        return typeof args[number] != 'undefined' ? args[number] : match;
    });
};
function formatNumberDecimal(num) {
    if (num == 'NaN') return '-';
    if (num == 'Infinity') return '&#x221e;';
    num = num.toString().replace(/\$|\,/g, '');
    if (isNaN(num))
        num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3) ; i++)
        num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
    return (((sign) ? '' : '-') + num + ',' + cents);
    return (((sign) ? '' : '-') + num);
}


function formatNumber(num) {
    if (num == 'NaN') return '-';
    if (num == 'Infinity') return '&#x221e;';
    num = num.toString().replace(/\$|\,/g, '');
    if (isNaN(num))
        num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3) ; i++)
        num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
    //return (((sign) ? '' : '-') + num + ',' + cents);
    return (((sign) ? '' : '-') + num);
}
function formatMoney(num) {
    return '$' + formatNumber(num);
}
function formatKg(num) {
    return formatNumber(num)+' Kg';
}

function formatPersen(num) {
    return num+' %';
}
/////////////////END FORMAT ANGKA


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
  sel_nama_supplier_rekening();
}

function pilih_supplier(){
  var supplier = $(".NAMA_SUPPLIER").val()
  $(".NOMOR_REKENING").val(supplier)
  gl_jurnal_list()
}

function sel_nama_supplier_rekening()
{
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=sel_nama_supplier_rekening&rekening='+$(".NOMOR_REKENING").val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
		$('select.NAMA_SUPPLIER').find('option:not(:first)').remove();
        //console.log(data.result)
        for (i = 0; i < data.result.length; i++) 
		{
        	$("select.NAMA_SUPPLIER").append("<option value='"+ data.result[i].RMP_REKENING_RELASI +"'>"+ data.result[i].RMP_REKENING_RELASI +" - "+ data.result[i].RMP_MASTER_PERSONAL_NAMA +"</option>");
        }
        //gl_jurnal_list()
      }else if(data.respon.pesan == "gagal") 
	  {
			$('select.NAMA_SUPPLIER').find('option:not(:first)').remove();
      }
    }, //end success
    error: function(x, e) {
      //console.log("Error Ajax");
    } //end error
  });
}


$(function(){
	/*
	$("input#DATA_eDATE").datepicker().on('changeDate', function(ev)
	{                 
		$('.datepicker').datepicker('hide'); 
    });
    */
});

$(function() {
  $('a.sidebar-toggle').click()
});

var months = {'01':'January', '02':'Februari', '03':'Maret', '04':'April', '05':'Mei', '06':'Juni', '07':'Juli', '08':'Agustus', '09':'September', '10':'Oktober', '11': 'November', '12':'Desember'};


$(function(){
	$("input#DATA_sDATE").datepicker().on('changeDate', function(ev)
	{ 
		var JENIS_LAPORAN=$('select#JENIS_LAPORAN').val();
		//alert(JENIS_LAPORAN);
		if(JENIS_LAPORAN == "Mingguan")
		{
			var TANGGAL_AWAL=$("input#DATA_sDATE").val();             
			//MENENTUKAN TANGGAL AKHIRNYA SEMINGGU DARI TANGGAL AWAL
			var myDate = new Date(TANGGAL_AWAL);
			myDate.setDate(myDate.getDate() + 6);
			
			var month = '' + (myDate.getMonth() + 1),day = '' + myDate.getDate(),year = myDate.getFullYear();
			if (month.length < 2) 
				month = '0' + month;
			if (day.length < 2) 
				day = '0' + day;
			var TANGGAL_AKHIR=year+"/"+month+"/"+day;
			//END MENETUKAN TANGGAL AKHIRNYA
			//alert(TANGGAL_AKHIR);
			$("input#DATA_eDATE").val(TANGGAL_AKHIR); 
		}else if(JENIS_LAPORAN == "Pengaturan")
		{
			var TANGGAL_AWAL=$("input#DATA_sDATE").val();             
			//MENENTUKAN TANGGAL AKHIRNYA SEMINGGU DARI TANGGAL AWAL
			var myDate = new Date(TANGGAL_AWAL);
			myDate.setDate(myDate.getDate() + 0);
			
			var month = '' + (myDate.getMonth() + 1),day = '' + myDate.getDate(),year = myDate.getFullYear();
			if (month.length < 2) 
				month = '0' + month;
			if (day.length < 2) 
				day = '0' + day;
			var TANGGAL_AKHIR=year+"/"+month+"/"+day;
			//END MENETUKAN TANGGAL AKHIRNYA
			//alert(TANGGAL_AKHIR);
			$("input#DATA_eDATE").val(TANGGAL_AKHIR); 
		}else{}
		$('.datepicker').datepicker('hide'); 				
    });
	$("input#DATA_eDATE").datepicker().on('changeDate', function(ev)
	{ 
		$('.datepicker').datepicker('hide'); 				
    });

});	

function jenisAkumulasi(){
	var JENIS_LAPORAN=$('select#JENIS_LAPORAN').val();
	if (JENIS_LAPORAN == "Harian") 
	{
	
		$('input#DATA_sDATE').removeAttr("disabled");
		$('input#DATA_sDATE').attr("required");
		$('div#divtanggalawal').attr("style", "display:block");
		$('label#labelsDate').html("Tanggal");
		
		$('input#DATA_eDATE').attr("disabled","disabled");
		$('div#divtanggalakhir').attr("style", "display:none");
		
		
		$('select#BULAN_FILTER').attr("disabled","disabled");
		$('select#BULAN_FILTER').removeAttr("required");
		$('div#divbulanfilter').attr("style", "display:none");
		
		$('select#TAHUN_FILTER').attr("disabled","disabled");
		$('select#TAHUN_FILTER').removeAttr("required");
		$('div#divtahunfilter').attr("style", "display:none");
		
	} else if (JENIS_LAPORAN == "Mingguan")
	{	
		$('input#DATA_sDATE').removeAttr("disabled");
		$('input#DATA_sDATE').attr("required");
		$('div#divtanggalawal').attr("style", "display:block");
		$('label#labelsDate').html("Tanggal Awal");
	
		$('input#DATA_eDATE').removeAttr("disabled");
		$('input#DATA_eDATE').attr("readonly","readonly");
		$('input#DATA_eDATE').removeClass("datepicker");
		$('div#divtanggalakhir').attr("style", "display:block");
	
		$('select#BULAN_FILTER').attr("disabled","disabled");
		$('select#BULAN_FILTER').removeAttr("required");
		$('div#divbulanfilter').attr("style", "display:none");
		
		$('select#TAHUN_FILTER').attr("disabled","disabled");
		$('select#TAHUN_FILTER').removeAttr("required");
		$('div#divtahunfilter').attr("style", "display:none");
		var TANGGAL_AWAL=$("input#DATA_sDATE").val();             
		//MENENTUKAN TANGGAL AKHIRNYA SEMINGGU DARI TANGGAL AWAL
		var myDate = new Date(TANGGAL_AWAL);
		myDate.setDate(myDate.getDate() + 6);
		
		var month = '' + (myDate.getMonth() + 1),day = '' + myDate.getDate(),year = myDate.getFullYear();
		if (month.length < 2) 
			month = '0' + month;
		if (day.length < 2) 
			day = '0' + day;
		var TANGGAL_AKHIR=year+"/"+month+"/"+day;
		//END MENETUKAN TANGGAL AKHIRNYA
		//alert(TANGGAL_AKHIR);
		$("input#DATA_eDATE").val(TANGGAL_AKHIR); 
		$('input#DATA_eDATE').removeClass("datepicker");
	
	}else if (JENIS_LAPORAN == "Pengaturan")
	{	
		$('input#DATA_sDATE').removeAttr("disabled");
		$('input#DATA_sDATE').attr("required");
		$('div#divtanggalawal').attr("style", "display:block");
		$('label#labelsDate').html("Tanggal Awal");
	
		$('input#DATA_eDATE').removeAttr("disabled");
		$('input#DATA_eDATE').attr("required");
		$('input#DATA_eDATE').removeAttr("readonly");
		$('input#DATA_eDATE').addClass("datepicker");
		$('div#divtanggalakhir').attr("style", "display:block");
	
		$('select#BULAN_FILTER').attr("disabled","disabled");
		$('select#BULAN_FILTER').removeAttr("required");
		$('div#divbulanfilter').attr("style", "display:none");
		
		$('select#TAHUN_FILTER').attr("disabled","disabled");
		$('select#TAHUN_FILTER').removeAttr("required");
		$('div#divtahunfilter').attr("style", "display:none");

		var TANGGAL_AWAL=$("input#DATA_sDATE").val();             
			//MENENTUKAN TANGGAL AKHIRNYA SEMINGGU DARI TANGGAL AWAL
			var myDate = new Date(TANGGAL_AWAL);
			myDate.setDate(myDate.getDate() + 0);
			
			var month = '' + (myDate.getMonth() + 1),day = '' + myDate.getDate(),year = myDate.getFullYear();
			if (month.length < 2) 
				month = '0' + month;
			if (day.length < 2) 
				day = '0' + day;
			var TANGGAL_AKHIR=year+"/"+month+"/"+day;
			//END MENETUKAN TANGGAL AKHIRNYA
			//alert(TANGGAL_AKHIR);
			$("input#DATA_eDATE").val(TANGGAL_AKHIR); 
			$('input#DATA_eDATE').addClass("datepicker");
	
	}else if (JENIS_LAPORAN == "Bulanan")
	{	
	
		$('input#DATA_sDATE').attr("disabled","disabled");
		$('input#DATA_sDATE').removeAttr("required");
		$('div#divtanggalawal').attr("style", "display:none");
	
		$('input#DATA_eDATE').attr("disabled","disabled");
		$('input#DATA_eDATE').removeAttr("required");
		$('div#divtanggalakhir').attr("style", "display:none");
	
		$('select#BULAN_FILTER').removeAttr("disabled");
		$('select#BULAN_FILTER').attr("required");
		$('div#divbulanfilter').attr("style", "display:block");
		
		$('select#TAHUN_FILTER').removeAttr("disabled");
		$('select#TAHUN_FILTER').attr("required");
		$('div#divtahunfilter').attr("style", "display:block");
	
	}else if (JENIS_LAPORAN == "Tahunan")
	{
		
		$('input#DATA_sDATE').attr("disabled","disabled");
		$('input#DATA_sDATE').removeAttr("required");
		$('div#divtanggalawal').attr("style", "display:none");
	
		$('input#DATA_eDATE').attr("disabled","disabled");
		$('input#DATA_eDATE').removeAttr("required");
		$('div#divtanggalakhir').attr("style", "display:none");
	
		$('select#BULAN_FILTER').attr("disabled","disabled");
		$('select#BULAN_FILTER').removeAttr("required");
		$('div#divbulanfilter').attr("style", "display:none");
		
		$('select#TAHUN_FILTER').removeAttr("disabled");
		$('select#TAHUN_FILTER').attr("required");
		$('div#divtahunfilter').attr("style", "display:block");
	
	}else{
		$('input#DATA_eDATE').attr("readonly","readonly");}
	//search();
}

$('button#btn-excel').on('click',function(){
	var JENIS_LAPORAN=$('select#JENIS_LAPORAN').val(); 
	var COMPANY_UNIT_ID=$('select#COMPANY_UNIT_ID').val();
	var LAPORAN_KERJA_UNIT_ID=$('select#LAPORAN_KERJA_UNIT_ID').val();
	var PERSONAL_NIK=$('select#PERSONAL_NIK').val();  
	/*
	var sd = new Date($('input#DATA_sDATE').val());
	var se = new Date($('input#DATA_eDATE').val());
		var PDATA_sDATE = sd.getDate() + "-" + (sd.getMonth()+1) + "-" + sd.getFullYear();
		var PDATA_eDATE = se.getDate() + "-" + (se.getMonth()+1) + "-" + se.getFullYear();
	var DATA_sDATE = sd.getFullYear() + "-" + (sd.getMonth()+1) + "-" + sd.getDate();
	var DATA_eDATE = se.getFullYear() + "-" + (se.getMonth()+1) + "-" + se.getDate();
	*/
	var sd = $('input#DATA_sDATE').val().split("/");
	var se = $('input#DATA_eDATE').val().split("/");
		var PDATA_sDATE = sd[2] + "-" + sd[1] + "-" + sd[0];
		var PDATA_eDATE = se[2] + "-" + se[1] + "-" + se[0];
	var DATA_sDATE = sd[0] + "-" + sd[1] + "-" + sd[2];
	var DATA_eDATE = se[0] + "-" + se[1] + "-" + se[2];
	var BULAN_FILTER = $("#BULAN_FILTER").val();
	var TAHUN_FILTER = $("#TAHUN_FILTER").val();
	if (JENIS_LAPORAN == "Harian") 
	{
		var periode=PDATA_sDATE;
		var alamat='?show=laporan/pdf/departemen/'+JENIS_LAPORAN+'/'+COMPANY_UNIT_ID+'/'+LAPORAN_KERJA_UNIT_ID+'/'+PERSONAL_NIK+'/'+DATA_sDATE;
	}else if (JENIS_LAPORAN == "Mingguan") 
	{
		var periode=PDATA_sDATE+' sampai '+PDATA_eDATE;
		var alamat='?show=laporan/pdf/departemen/'+JENIS_LAPORAN+'/'+COMPANY_UNIT_ID+'/'+LAPORAN_KERJA_UNIT_ID+'/'+PERSONAL_NIK+'/'+DATA_sDATE+'/'+DATA_eDATE;
	}else if (JENIS_LAPORAN == "Bulanan") 
	{
		var periode=BULAN_FILTER+'-'+TAHUN_FILTER;
		var alamat='?show=laporan/pdf/departemen/'+JENIS_LAPORAN+'/'+COMPANY_UNIT_ID+'/'+LAPORAN_KERJA_UNIT_ID+'/'+PERSONAL_NIK+'/'+BULAN_FILTER+'/'+TAHUN_FILTER;
	}else if (JENIS_LAPORAN == "Tahunan") 
	{
		var periode=TAHUN_FILTER;
		var alamat='?show=laporan/pdf/departemen/'+JENIS_LAPORAN+'/'+COMPANY_UNIT_ID+'/'+LAPORAN_KERJA_UNIT_ID+'/'+PERSONAL_NIK+'/'+TAHUN_FILTER;
	}else{}

	if(confirm('Anda akan mencetak dokumen pdf laporan kerja departemen periode '+periode+'.\n'+
			'Yakin akan mencetak dokumen sekarang?'))
	{
		window.open(alamat+'', '_blank');
	}
});

$('button#btn-html').on('click',function(){
	var JENIS_LAPORAN=$('select#JENIS_LAPORAN').val(); 
	var COMPANY_UNIT_ID=$('select#COMPANY_UNIT_ID').val();
	var LAPORAN_KERJA_UNIT_ID=$('select#LAPORAN_KERJA_UNIT_ID').val();
	var PERSONAL_NIK=$('select#PERSONAL_NIK').val();  
	/*
	var sd = new Date($('input#DATA_sDATE').val());
	var se = new Date($('input#DATA_eDATE').val());
		var PDATA_sDATE = sd.getDate() + "-" + (sd.getMonth()+1) + "-" + sd.getFullYear();
		var PDATA_eDATE = se.getDate() + "-" + (se.getMonth()+1) + "-" + se.getFullYear();
	var DATA_sDATE = sd.getFullYear() + "-" + (sd.getMonth()+1) + "-" + sd.getDate();
	var DATA_eDATE = se.getFullYear() + "-" + (se.getMonth()+1) + "-" + se.getDate();
	*/
	var sd = $('input#DATA_sDATE').val().split("/");
	var se = $('input#DATA_eDATE').val().split("/");
		var PDATA_sDATE = sd[2] + "-" + sd[1] + "-" + sd[0];
		var PDATA_eDATE = se[2] + "-" + se[1] + "-" + se[0];
	var DATA_sDATE = sd[0] + "-" + sd[1] + "-" + sd[2];
	var DATA_eDATE = se[0] + "-" + se[1] + "-" + se[2];
	var BULAN_FILTER = $("#BULAN_FILTER").val();
	var TAHUN_FILTER = $("#TAHUN_FILTER").val();
	if (JENIS_LAPORAN == "Harian") 
	{
		var periode=PDATA_sDATE;
		var alamat='?show=laporan/html/departemen/'+JENIS_LAPORAN+'/'+COMPANY_UNIT_ID+'/'+LAPORAN_KERJA_UNIT_ID+'/'+PERSONAL_NIK+'/'+DATA_sDATE;
	}else if (JENIS_LAPORAN == "Mingguan") 
	{
		var periode=PDATA_sDATE+' sampai '+PDATA_eDATE;
		var alamat='?show=laporan/html/departemen/'+JENIS_LAPORAN+'/'+COMPANY_UNIT_ID+'/'+LAPORAN_KERJA_UNIT_ID+'/'+PERSONAL_NIK+'/'+DATA_sDATE+'/'+DATA_eDATE;
	}else if (JENIS_LAPORAN == "Bulanan") 
	{
		var periode=BULAN_FILTER+'-'+TAHUN_FILTER;
		var alamat='?show=laporan/html/departemen/'+JENIS_LAPORAN+'/'+COMPANY_UNIT_ID+'/'+LAPORAN_KERJA_UNIT_ID+'/'+PERSONAL_NIK+'/'+BULAN_FILTER+'/'+TAHUN_FILTER;
	}else if (JENIS_LAPORAN == "Tahunan") 
	{
		var periode=TAHUN_FILTER;
		var alamat='?show=laporan/html/departemen/'+JENIS_LAPORAN+'/'+COMPANY_UNIT_ID+'/'+LAPORAN_KERJA_UNIT_ID+'/'+PERSONAL_NIK+'/'+TAHUN_FILTER;
	}else{}

	if(confirm('Anda akan mencetak html laporan kerja departemen periode '+periode+'.\n'+
			'Yakin akan mencetak dokumen sekarang?'))
	{
		window.open(alamat+'', '_blank');
	}
});

$('button#btn-reload').on('click',function(){
    $("tbody#zone_data").html('<tr><td colspan="12">Loading...!</td></tr>');
});


function tampil(curPage){
	var JENIS_LAPORAN=$('select#JENIS_LAPORAN').val();
	var TANGGAL_AWAL=$('input#DATA_sDATE').val();
	var TANGGAL_AKHIR=$('input#DATA_eDATE').val();
	var BULAN_FILTER=$('select#BULAN_FILTER').val();
	var TAHUN_FILTER=$('select#TAHUN_FILTER').val();
	
	if (JENIS_LAPORAN == "Harian") 
	{
		var judulTANGGAL_AWAL=TANGGAL_AWAL.split('/');

		var judulTANGGAL_AWALnya = judulTANGGAL_AWAL[2] + " " + months[judulTANGGAL_AWAL[1]] + " " + judulTANGGAL_AWAL[0];


		
		var JUDUL_AKUMULASI="PENERIMAAN KOPRA <br>PERIODE : "+judulTANGGAL_AWALnya;
		var PERIODE_AKUMULASI=judulTANGGAL_AWALnya;
		
		
		$('span.periodeInvoice').html('('+judulTANGGAL_AWALnya+')');
		$('span.periodeKopraKering').html('('+judulTANGGAL_AWALnya+')');
		$('span.periodeRupiah').html('('+judulTANGGAL_AWALnya+')');
		
	}else if (JENIS_LAPORAN == "Mingguan" || JENIS_LAPORAN == "Pengaturan") 
	{
		var judulTANGGAL_AWAL=TANGGAL_AWAL.split('/');
		var judulTANGGAL_AWALnya = judulTANGGAL_AWAL[2] + " " + months[judulTANGGAL_AWAL[1]] + " " + judulTANGGAL_AWAL[0];
		
		var judulTANGGAL_AKHIR=TANGGAL_AKHIR.split('/');
		var judulTANGGAL_AKHIR = judulTANGGAL_AKHIR[2] + " " + months[judulTANGGAL_AKHIR[1]] + " " + judulTANGGAL_AKHIR[0];
		
		
		
		var JUDUL_AKUMULASI="PENERIMAAN KOPRA <br>PERIODE : "+judulTANGGAL_AWALnya+"-"+judulTANGGAL_AKHIR;
		var PERIODE_AKUMULASI=judulTANGGAL_AWALnya+'-'+judulTANGGAL_AKHIR;
		
		
		$('span.periodeInvoice').html('('+PERIODE_AKUMULASI+')');
		$('span.periodeKopraKering').html('('+PERIODE_AKUMULASI+')');
		$('span.periodeRupiah').html('('+PERIODE_AKUMULASI+')');
	}else if (JENIS_LAPORAN == "Bulanan") 
	{
		var JUDUL_AKUMULASI="PENERIMAAN KOPRA <br>PERIODE : "+months[BULAN_FILTER]+"-"+TAHUN_FILTER;
		var PERIODE_AKUMULASI=months[BULAN_FILTER]+'-'+TAHUN_FILTER;
		
		$('span.periodeInvoice').html('('+PERIODE_AKUMULASI+')');
		$('span.periodeKopraKering').html('('+PERIODE_AKUMULASI+')');
		$('span.periodeRupiah').html('('+PERIODE_AKUMULASI+')');
	}else if (JENIS_LAPORAN == "Tahunan") 
	{
		var JUDUL_AKUMULASI="PENERIMAAN KOPRA <br>PERIODE : "+TAHUN_FILTER;
		var PERIODE_AKUMULASI=TAHUN_FILTER;
		$('span.periodeInvoice').html('('+PERIODE_AKUMULASI+')');
		$('span.periodeKopraKering').html('('+PERIODE_AKUMULASI+')');
		$('span.periodeRupiah').html('('+PERIODE_AKUMULASI+')');
	}else
	{
		var JUDUL_AKUMULASI="PENERIMAAN KOPRA";
		var PERIODE_AKUMULASI="";
	}
	$('span.JUDUL_AKUMULASI').html(JUDUL_AKUMULASI);
	
	//config halaman ajax
	var url = window.location.href;
	var pageA=url.split("#");
	if(pageA[1]==undefined){ }else{		
		var pageB=pageA[1].split("page-");
		if(pageB[1]==''){
			var curPage=curPage;
		}else{
			var curPage=pageB[1];
		} 
	}
	//end config halaman ajax
	$("button").attr("disabled","disabled");
	$.ajax({
		type:'POST',
		url:refseeAPI,
		async: false,
		dataType:'json',
		data:'aplikasi=<?php echo $d0;?>&ref=monitoring_ap_pengajuan&'+$("form.fData").serialize(),
		success:function(data)
		{
			$("tbody#zone_data").empty();
			console.log(data.result);
			$("button").removeAttr("disabled");
			if(data.respon.pesan=="sukses")
			{
				//MENGELOLA TABEL
				if(JENIS_LAPORAN=="Harian"){
					var inputTampil='&DATA_sDATE='+TANGGAL_AWAL;
				}else if(JENIS_LAPORAN=="Mingguan"){
					var inputTampil='&DATA_sDATE='+TANGGAL_AWAL+'&DATA_eDATE='+TANGGAL_AKHIR;
				}else if(JENIS_LAPORAN=="Pengaturan"){
					var inputTampil='&DATA_sDATE='+TANGGAL_AWAL+'&DATA_eDATE='+TANGGAL_AKHIR;
				}else if(JENIS_LAPORAN=="Bulanan"){
					var inputTampil='&BULAN_FILTER='+BULAN_FILTER+'&TAHUN_FILTER='+TAHUN_FILTER;
				}else if(JENIS_LAPORAN=="Tahunan"){
					var inputTampil='&TAHUN_FILTER='+TAHUN_FILTER;
				}else{}
				
				//var status_text="<a href='?show=laporan/kerja/' class='btn btn-success btn-sm' target='_blank'><i class='fa fa-eye'></i></a>";

				if(JENIS_LAPORAN=="Harian" || JENIS_LAPORAN=="Mingguan" || JENIS_LAPORAN=="Pengaturan" || JENIS_LAPORAN=="Bulanan")
				{
					var tableContent = "";  
					for (var result = 0; result < data.result.length; result++) 
					{
						//
						var JumlahAP = data.result[result].AP.length;						
						if(JumlahAP>0)
						{
							var tdAPKosong="";
						}else{
							var tdAPKosong="<td class='trBaris'></td>"+
												"<td class='trBaris'></td>"+
												"<td class='trBaris'></td>"+
												"<td class='trBaris'></td>"+
												"<td class='trBaris'></td>"+
												"<td class='trBaris'></td>"+
												"<td class='trBaris' colspan='2'></td>"+
												"<td class='trBaris'></td>"+
												"<td class='trBaris'></td>"+
												"<td class='trBaris'></td>";
						}
						//
						var rowspan = 0;
						var detailLength = data.result[result].AP.length;
						rowspan += detailLength;

						
						//kebutuhan rowspan tambahan ketika AP ada pada faktur yang ada
						var persiapanRowspanFakturTambahan={};
						var jlhFaktur={};
						var jlhFakturbaru=0;
						for (var i = 0; i < detailLength; i++) 
						{
							rowspan += data.result[result].AP[i].FAKTUR.length;
							jlhFaktur[i]=data.result[result].AP[i].FAKTUR.length;
							if(jlhFaktur[i]>0){
								jlhFakturbaru=jlhFakturbaru+1;
								persiapanRowspanFakturTambahan[data.result[result].RMP_REKENING_RELASI]=jlhFakturbaru;
							}
							
						}
						var rowspanFakturTambahan=persiapanRowspanFakturTambahan[data.result[result].RMP_REKENING_RELASI];
						if(rowspanFakturTambahan==undefined)
						{
							var rowspanFakturTambahanXY=0;
						}else{
							var rowspanFakturTambahanXY=rowspanFakturTambahan;
						}
						//kebutuhan 1 rowspan tambahan ketika faktur ada
						var JumlahRowAP=data.result[result].AP.length;
						if(JumlahRowAP>0)
						{
							var rowspanTetapFakturX=1;
						}else{
							var rowspanTetapFakturX=0;
						}
						//end

						tableContent += "<tr class='trBaris'><td class='trBaris' rowspan=" + parseInt(1 + rowspanFakturTambahanXY + rowspanTetapFakturX +rowspan) + ">" + data.result[result].RMP_REKENING_RELASI + "<br>"+ data.result[result].RMP_MASTER_PERSONAL_NAMA +"</td>"+tdAPKosong+"</tr>";
						var FAKTURLength = 0;
						for (var i = 0; i < detailLength; i++) 
						{
							var JumlahFAKTUR = data.result[result].AP[i].FAKTUR.length;
							if(JumlahFAKTUR>0)
							{
								var tdFAKTURKosong="";
							}else{
								var tdFAKTURKosong="<td class='trBaris'></td>"+
												"<td class='trBaris'></td>"+
												"<td class='trBaris'></td>"+
												"<td class='trBaris'></td>"+
												"<td class='trBaris' colspan='2'></td>"+
												"<td class='trBaris'></td>"+
												"<td class='trBaris'></td>"+
												"<td class='trBaris'></td>";
							}


							FAKTURLength = data.result[result].AP[i].FAKTUR.length;
							tableContent += "<tr class='trBaris'>"+
												"<td  class='trBaris text-left' rowspan=" + parseInt(1 + FAKTURLength) + ">"+
													data.result[result].AP[i].NomorAP +
												"</td>"+
												"<td  class='trBaris text-left' rowspan=" + parseInt(1 + FAKTURLength) + ">"+
													data.result[result].AP[i].TanggalAP +
												"</td>"+
												tdFAKTURKosong+"</tr>";
							
												for (var j = 0; j < FAKTURLength; j++) 
												{
													tableContent += "<tr class='trBaris'>"+
															"<td class='trBaris text-right'>" + formatNumber(data.result[result].AP[i].FAKTUR[j].IDREquivalents) + "</td>"+
															"<td class='trBaris text-left'>" + data.result[result].AP[i].FAKTUR[j].NoFaktur+ "</td>"+
															"<td class='trBaris text-left'>" + data.result[result].AP[i].FAKTUR[j].TglInvoices + "</td>"+
															"<td class='trBaris text-right'>" + formatNumber(data.result[result].AP[i].FAKTUR[j].NilaiFakturs) + "</td>"+
															"<td class='trBaris text-right' colspan='2'>-</td>"+
															"<td class='trBaris text-left'>" + data.result[result].AP[i].FAKTUR[j].TglBayars + "</td>"+
															"<td class='trBaris text-left'>" + data.result[result].AP[i].FAKTUR[j].ReffNo + "</td>"+
															"<td class='trBaris text-right'>" + formatNumber(data.result[result].AP[i].FAKTUR[j].IDREquivalentCBs) + "</td>"+
														"</tr>";
												}
								//baris summary masing-masing ap
								if(JumlahFAKTUR>0)
								{
									tableContent += "<tr class='trSumAP'>"+
															"<td class='trSumAP text-right' colspan='2'>Nilai AP</td>"+
															"<td class='trSumAP text-right trBold'>"+formatNumber(data.result[result].AP[i].NilaiAP) +"</td>"+
															"<td class='trSumAP text-right'>Jlh Invoice (<b>"+data.result[result].AP[i].JumlahInvoice+"</b>)</td>"+
															"<td class='trSumAP text-right'>Nilai Invoice</td>"+
															"<td class='trSumAP text-right trBold'>"+formatNumber(data.result[result].AP[i].NilaiInvoice) +"</td>"+
															"<td class='trSumAP text-right'>Nilai Pengajuan</td>"+
															"<td class='trSumAP text-right trBold'>-</td>"+
															"<td class='trSumAP text-right' colspan='2'>Nilai Bayar</td>"+
															"<td class='trSumAP text-right trBold'>"+formatNumber(data.result[result].AP[i].NilaiBayar) +"</td>"+
														"</tr>";
								}else{}
								//end sum masing-masing ap
							
						}
						//baris summary seluruh ap
						if(JumlahAP>0)
						{
							tableContent += "<tr class='trSumFaktur'>"+
													"<td class='trSumFaktur text-left'><span class='trInfo'>#"+data.result[result].RMP_REKENING_RELASI+"<br>"+data.result[result].RMP_MASTER_PERSONAL_NAMA+"</span><br>Jumlah AP (<b>"+data.result[result].JLH_AP+"</b>)</td>"+
													"<td class='trSumFaktur text-right'>Total Nilai AP</td>"+
													"<td class='trSumFaktur text-right trBold'>"+formatNumber(data.result[result].TotalNilaiAP)+"</td>"+
													"<td class='trSumFaktur text-right' colspan='2'>Total Nilai Invoice</td>"+
													"<td class='trSumFaktur text-right trBold'>"+formatNumber(data.result[result].TotalNilaiInvoice)+"</td>"+
													"<td class='trSumFaktur text-right'>Total Nilai Pengajuan</td>"+
													"<td class='trSumFaktur text-right trBold'>-</td>"+
													"<td class='trSumFaktur text-right' colspan='2'>Total Nilai Bayar</td>"+
													"<td class='trSumFaktur text-right trBold'>"+formatNumber(data.result[result].TotalNilaiBayar)+"</td>"+
												"</tr>";
						}else{}
						//end sum seluruh ap
					}

					//sum keseluruhan suplier
					tableContent += "<tr class='trSumFaktur'>"+
													"<td class='trSumSuplier text-right' colspan='2'>Total Keseluruhan Jumlah AP (<b>"+data.resultTotal.TOTAL_KESELURUHAN_JLH_AP+"</b>)</td>"+
													"<td class='trSumSuplier text-right'>Total Keseluruhan Nilai AP</td>"+
													"<td class='trSumSuplier text-right trBold'>"+formatNumber(data.resultTotal.TotalKeseluruhanNilaiAP)+"</td>"+
													"<td class='trSumSuplier text-right' colspan='2'>Total Keseluruhan Nilai Invoice</td>"+
													"<td class='trSumSuplier text-right trBold'>"+formatNumber(data.resultTotal.TotalKeseluruhanNilaiInvoice)+"</td>"+
													"<td class='trSumSuplier text-right'>Total Nilai Keseluruhan Pengajuan</td>"+
													"<td class='trSumSuplier text-right trBold'>-</td>"+
													"<td class='trSumSuplier text-right' colspan='2'>Total Keseluruhan Nilai Bayar</td>"+
													"<td class='trSumSuplier text-right trBold'>"+formatNumber(data.resultTotal.TotalKeseluruhanNilaiBayar)+"</td>"+
												"</tr>";
					//end keseluruhan suplier
					
				}else
				{
				
              	}
              	$("tbody#zone_data").html(tableContent);
				//$("tbody#zone_data").html('<tr><td colspan="10">loading...</td></tr>');
			}
			else if(data.respon.pesan=="gagal")
			{
				alert(data.respon.text_msg);
			}
		}, //end success
		error:function(x,e){
			error_handler_json(x,e,'=> personel_list()');
		}//end error
	});	
}
//

$(function(){
	jenisAkumulasi();
	tampilBagian();
	tampilPersonel();
	tampil();
});

/*
$(window).on('hashchange', function(e){
 // Your Code goes here
 wo_in_list('1'); 
});


$("input#REC_PER_HALAMAN").on('change',function(){
	wo_in_list('1');
	//wo_in_list_halaman(); 
});
function search(){
	//alert('ada');
	wo_in_list('1');
	//wo_in_list_halaman(); 
}
*/

function filter(){
	tampil();  
}
function simpan()
{
	
	var fData=$("#fDataLaporan").serialize(); 
	$.ajax({
		type:'POST',
		url:refseeAPI,
		dataType:'json',
		data:'aplikasi=<?php echo $d0;?>&ref=personel_simpan&'+fData,
		success:function(data)
		{ 
			if(data.respon.pesan=="sukses")
			{
				$("#LaporanForm").modal('hide');
				alert(data.respon.text_msg);
				tampil('1');
				
			}else if(data.respon.pesan=="gagal")
			{
				alert(data.respon.text_msg);
				tampil('1');
			}
		},
		error:function(x,e){
			error_handler_json(x,e,'=> personel_simpan()');
		}//end error
	});
}
//TYPEHEAD JABATAN
!function(a){var b="0.9.3",c={isMsie:function(){var a=/(msie) ([\w.]+)/i.exec(navigator.userAgent);return a?parseInt(a[2],10):!1},isBlankString:function(a){return!a||/^\s*$/.test(a)},escapeRegExChars:function(a){return a.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g,"\\$&")},isString:function(a){return"string"==typeof a},isNumber:function(a){return"number"==typeof a},isArray:a.isArray,isFunction:a.isFunction,isObject:a.isPlainObject,isUndefined:function(a){return"undefined"==typeof a},bind:a.proxy,bindAll:function(b){var c;for(var d in b)a.isFunction(c=b[d])&&(b[d]=a.proxy(c,b))},indexOf:function(a,b){for(var c=0;c<a.length;c++)if(a[c]===b)return c;return-1},each:a.each,map:a.map,filter:a.grep,every:function(b,c){var d=!0;return b?(a.each(b,function(a,e){return(d=c.call(null,e,a,b))?void 0:!1}),!!d):d},some:function(b,c){var d=!1;return b?(a.each(b,function(a,e){return(d=c.call(null,e,a,b))?!1:void 0}),!!d):d},mixin:a.extend,getUniqueId:function(){var a=0;return function(){return a++}}(),defer:function(a){setTimeout(a,0)},debounce:function(a,b,c){var d,e;return function(){var f,g,h=this,i=arguments;return f=function(){d=null,c||(e=a.apply(h,i))},g=c&&!d,clearTimeout(d),d=setTimeout(f,b),g&&(e=a.apply(h,i)),e}},throttle:function(a,b){var c,d,e,f,g,h;return g=0,h=function(){g=new Date,e=null,f=a.apply(c,d)},function(){var i=new Date,j=b-(i-g);return c=this,d=arguments,0>=j?(clearTimeout(e),e=null,g=i,f=a.apply(c,d)):e||(e=setTimeout(h,j)),f}},tokenizeQuery:function(b){return a.trim(b).toLowerCase().split(/[\s]+/)},tokenizeText:function(b){return a.trim(b).toLowerCase().split(/[\s\-_]+/)},getProtocol:function(){return location.protocol},noop:function(){}},d=function(){var a=/\s+/;return{on:function(b,c){var d;if(!c)return this;for(this._callbacks=this._callbacks||{},b=b.split(a);d=b.shift();)this._callbacks[d]=this._callbacks[d]||[],this._callbacks[d].push(c);return this},trigger:function(b,c){var d,e;if(!this._callbacks)return this;for(b=b.split(a);d=b.shift();)if(e=this._callbacks[d])for(var f=0;f<e.length;f+=1)e[f].call(this,{type:d,data:c});return this}}}(),e=function(){function b(b){b&&b.el||a.error("EventBus initialized without el"),this.$el=a(b.el)}var d="typeahead:";return c.mixin(b.prototype,{trigger:function(a){var b=[].slice.call(arguments,1);this.$el.trigger(d+a,b)}}),b}(),f=function(){function a(a){this.prefix=["__",a,"__"].join(""),this.ttlKey="__ttl__",this.keyMatcher=new RegExp("^"+this.prefix)}function b(){return(new Date).getTime()}function d(a){return JSON.stringify(c.isUndefined(a)?null:a)}function e(a){return JSON.parse(a)}var f,g;try{f=window.localStorage,f.setItem("~~~","!"),f.removeItem("~~~")}catch(h){f=null}return g=f&&window.JSON?{_prefix:function(a){return this.prefix+a},_ttlKey:function(a){return this._prefix(a)+this.ttlKey},get:function(a){return this.isExpired(a)&&this.remove(a),e(f.getItem(this._prefix(a)))},set:function(a,e,g){return c.isNumber(g)?f.setItem(this._ttlKey(a),d(b()+g)):f.removeItem(this._ttlKey(a)),f.setItem(this._prefix(a),d(e))},remove:function(a){return f.removeItem(this._ttlKey(a)),f.removeItem(this._prefix(a)),this},clear:function(){var a,b,c=[],d=f.length;for(a=0;d>a;a++)(b=f.key(a)).match(this.keyMatcher)&&c.push(b.replace(this.keyMatcher,""));for(a=c.length;a--;)this.remove(c[a]);return this},isExpired:function(a){var d=e(f.getItem(this._ttlKey(a)));return c.isNumber(d)&&b()>d?!0:!1}}:{get:c.noop,set:c.noop,remove:c.noop,clear:c.noop,isExpired:c.noop},c.mixin(a.prototype,g),a}(),g=function(){function a(a){c.bindAll(this),a=a||{},this.sizeLimit=a.sizeLimit||10,this.cache={},this.cachedKeysByAge=[]}return c.mixin(a.prototype,{get:function(a){return this.cache[a]},set:function(a,b){var c;this.cachedKeysByAge.length===this.sizeLimit&&(c=this.cachedKeysByAge.shift(),delete this.cache[c]),this.cache[a]=b,this.cachedKeysByAge.push(a)}}),a}(),h=function(){function b(a){c.bindAll(this),a=c.isString(a)?{url:a}:a,i=i||new g,h=c.isNumber(a.maxParallelRequests)?a.maxParallelRequests:h||6,this.url=a.url,this.wildcard=a.wildcard||"%QUERY",this.filter=a.filter,this.replace=a.replace,this.ajaxSettings={type:"get",cache:a.cache,timeout:a.timeout,dataType:a.dataType||"json",beforeSend:a.beforeSend},this._get=(/^throttle$/i.test(a.rateLimitFn)?c.throttle:c.debounce)(this._get,a.rateLimitWait||300)}function d(){j++}function e(){j--}function f(){return h>j}var h,i,j=0,k={};return c.mixin(b.prototype,{_get:function(a,b){function c(c){var e=d.filter?d.filter(c):c;b&&b(e),i.set(a,c)}var d=this;f()?this._sendRequest(a).done(c):this.onDeckRequestArgs=[].slice.call(arguments,0)},_sendRequest:function(b){function c(){e(),k[b]=null,f.onDeckRequestArgs&&(f._get.apply(f,f.onDeckRequestArgs),f.onDeckRequestArgs=null)}var f=this,g=k[b];return g||(d(),g=k[b]=a.ajax(b,this.ajaxSettings).always(c)),g},get:function(a,b){var d,e,f=this,g=encodeURIComponent(a||"");return b=b||c.noop,d=this.replace?this.replace(this.url,g):this.url.replace(this.wildcard,g),(e=i.get(d))?c.defer(function(){b(f.filter?f.filter(e):e)}):this._get(d,b),!!e}}),b}(),i=function(){function d(b){c.bindAll(this),c.isString(b.template)&&!b.engine&&a.error("no template engine specified"),b.local||b.prefetch||b.remote||a.error("one of local, prefetch, or remote is required"),this.name=b.name||c.getUniqueId(),this.limit=b.limit||15,this.minLength=b.minLength||1,this.header=b.header,this.footer=b.footer,this.valueKey=b.valueKey||"value",this.template=e(b.template,b.engine,this.valueKey),this.local=b.local,this.prefetch=b.prefetch,this.remote=b.remote,this.itemHash={},this.adjacencyList={},this.storage=b.name?new f(b.name):null}function e(a,b,d){var e,f;return c.isFunction(a)?e=a:c.isString(a)?(f=b.compile(a),e=c.bind(f.render,f)):e=function(a){return"<p>"+a[d]+"</p>"},e}var g={thumbprint:"thumbprint",protocol:"protocol",itemHash:"itemHash",adjacencyList:"adjacencyList"};return c.mixin(d.prototype,{_processLocalData:function(a){this._mergeProcessedData(this._processData(a))},_loadPrefetchData:function(d){function e(a){var b=d.filter?d.filter(a):a,e=m._processData(b),f=e.itemHash,h=e.adjacencyList;m.storage&&(m.storage.set(g.itemHash,f,d.ttl),m.storage.set(g.adjacencyList,h,d.ttl),m.storage.set(g.thumbprint,n,d.ttl),m.storage.set(g.protocol,c.getProtocol(),d.ttl)),m._mergeProcessedData(e)}var f,h,i,j,k,l,m=this,n=b+(d.thumbprint||"");return this.storage&&(f=this.storage.get(g.thumbprint),h=this.storage.get(g.protocol),i=this.storage.get(g.itemHash),j=this.storage.get(g.adjacencyList)),k=f!==n||h!==c.getProtocol(),d=c.isString(d)?{url:d}:d,d.ttl=c.isNumber(d.ttl)?d.ttl:864e5,i&&j&&!k?(this._mergeProcessedData({itemHash:i,adjacencyList:j}),l=a.Deferred().resolve()):l=a.getJSON(d.url).done(e),l},_transformDatum:function(a){var b=c.isString(a)?a:a[this.valueKey],d=a.tokens||c.tokenizeText(b),e={value:b,tokens:d};return c.isString(a)?(e.datum={},e.datum[this.valueKey]=a):e.datum=a,e.tokens=c.filter(e.tokens,function(a){return!c.isBlankString(a)}),e.tokens=c.map(e.tokens,function(a){return a.toLowerCase()}),e},_processData:function(a){var b=this,d={},e={};return c.each(a,function(a,f){var g=b._transformDatum(f),h=c.getUniqueId(g.value);d[h]=g,c.each(g.tokens,function(a,b){var d=b.charAt(0),f=e[d]||(e[d]=[h]);!~c.indexOf(f,h)&&f.push(h)})}),{itemHash:d,adjacencyList:e}},_mergeProcessedData:function(a){var b=this;c.mixin(this.itemHash,a.itemHash),c.each(a.adjacencyList,function(a,c){var d=b.adjacencyList[a];b.adjacencyList[a]=d?d.concat(c):c})},_getLocalSuggestions:function(a){var b,d=this,e=[],f=[],g=[];return c.each(a,function(a,b){var d=b.charAt(0);!~c.indexOf(e,d)&&e.push(d)}),c.each(e,function(a,c){var e=d.adjacencyList[c];return e?(f.push(e),(!b||e.length<b.length)&&(b=e),void 0):!1}),f.length<e.length?[]:(c.each(b,function(b,e){var h,i,j=d.itemHash[e];h=c.every(f,function(a){return~c.indexOf(a,e)}),i=h&&c.every(a,function(a){return c.some(j.tokens,function(b){return 0===b.indexOf(a)})}),i&&g.push(j)}),g)},initialize:function(){var b;return this.local&&this._processLocalData(this.local),this.transport=this.remote?new h(this.remote):null,b=this.prefetch?this._loadPrefetchData(this.prefetch):a.Deferred().resolve(),this.local=this.prefetch=this.remote=null,this.initialize=function(){return b},b},getSuggestions:function(a,b){function d(a){f=f.slice(0),c.each(a,function(a,b){var d,e=g._transformDatum(b);return d=c.some(f,function(a){return e.value===a.value}),!d&&f.push(e),f.length<g.limit}),b&&b(f)}var e,f,g=this,h=!1;a.length<this.minLength||(e=c.tokenizeQuery(a),f=this._getLocalSuggestions(e).slice(0,this.limit),f.length<this.limit&&this.transport&&(h=this.transport.get(a,d)),!h&&b&&b(f))}}),d}(),j=function(){function b(b){var d=this;c.bindAll(this),this.specialKeyCodeMap={9:"tab",27:"esc",37:"left",39:"right",13:"enter",38:"up",40:"down"},this.$hint=a(b.hint),this.$input=a(b.input).on("blur.tt",this._handleBlur).on("focus.tt",this._handleFocus).on("keydown.tt",this._handleSpecialKeyEvent),c.isMsie()?this.$input.on("keydown.tt keypress.tt cut.tt paste.tt",function(a){d.specialKeyCodeMap[a.which||a.keyCode]||c.defer(d._compareQueryToInputValue)}):this.$input.on("input.tt",this._compareQueryToInputValue),this.query=this.$input.val(),this.$overflowHelper=e(this.$input)}function e(b){return a("<span></span>").css({position:"absolute",left:"-9999px",visibility:"hidden",whiteSpace:"nowrap",fontFamily:b.css("font-family"),fontSize:b.css("font-size"),fontStyle:b.css("font-style"),fontVariant:b.css("font-variant"),fontWeight:b.css("font-weight"),wordSpacing:b.css("word-spacing"),letterSpacing:b.css("letter-spacing"),textIndent:b.css("text-indent"),textRendering:b.css("text-rendering"),textTransform:b.css("text-transform")}).insertAfter(b)}function f(a,b){return a=(a||"").replace(/^\s*/g,"").replace(/\s{2,}/g," "),b=(b||"").replace(/^\s*/g,"").replace(/\s{2,}/g," "),a===b}return c.mixin(b.prototype,d,{_handleFocus:function(){this.trigger("focused")},_handleBlur:function(){this.trigger("blured")},_handleSpecialKeyEvent:function(a){var b=this.specialKeyCodeMap[a.which||a.keyCode];b&&this.trigger(b+"Keyed",a)},_compareQueryToInputValue:function(){var a=this.getInputValue(),b=f(this.query,a),c=b?this.query.length!==a.length:!1;c?this.trigger("whitespaceChanged",{value:this.query}):b||this.trigger("queryChanged",{value:this.query=a})},destroy:function(){this.$hint.off(".tt"),this.$input.off(".tt"),this.$hint=this.$input=this.$overflowHelper=null},focus:function(){this.$input.focus()},blur:function(){this.$input.blur()},getQuery:function(){return this.query},setQuery:function(a){this.query=a},getInputValue:function(){return this.$input.val()},setInputValue:function(a,b){this.$input.val(a),!b&&this._compareQueryToInputValue()},getHintValue:function(){return this.$hint.val()},setHintValue:function(a){this.$hint.val(a)},getLanguageDirection:function(){return(this.$input.css("direction")||"ltr").toLowerCase()},isOverflow:function(){return this.$overflowHelper.text(this.getInputValue()),this.$overflowHelper.width()>this.$input.width()},isCursorAtEnd:function(){var a,b=this.$input.val().length,d=this.$input[0].selectionStart;return c.isNumber(d)?d===b:document.selection?(a=document.selection.createRange(),a.moveStart("character",-b),b===a.text.length):!0}}),b}(),k=function(){function b(b){c.bindAll(this),this.isOpen=!1,this.isEmpty=!0,this.isMouseOverDropdown=!1,this.$menu=a(b.menu).on("mouseenter.tt",this._handleMouseenter).on("mouseleave.tt",this._handleMouseleave).on("click.tt",".tt-suggestion",this._handleSelection).on("mouseover.tt",".tt-suggestion",this._handleMouseover)}function e(a){return a.data("suggestion")}var f={suggestionsList:'<span class="tt-suggestions"></span>'},g={suggestionsList:{display:"block"},suggestion:{whiteSpace:"nowrap",cursor:"pointer"},suggestionChild:{whiteSpace:"normal"}};return c.mixin(b.prototype,d,{_handleMouseenter:function(){this.isMouseOverDropdown=!0},_handleMouseleave:function(){this.isMouseOverDropdown=!1},_handleMouseover:function(b){var c=a(b.currentTarget);this._getSuggestions().removeClass("tt-is-under-cursor"),c.addClass("tt-is-under-cursor")},_handleSelection:function(b){var c=a(b.currentTarget);this.trigger("suggestionSelected",e(c))},_show:function(){this.$menu.css("display","block")},_hide:function(){this.$menu.hide()},_moveCursor:function(a){var b,c,d,f;if(this.isVisible()){if(b=this._getSuggestions(),c=b.filter(".tt-is-under-cursor"),c.removeClass("tt-is-under-cursor"),d=b.index(c)+a,d=(d+1)%(b.length+1)-1,-1===d)return this.trigger("cursorRemoved"),void 0;-1>d&&(d=b.length-1),f=b.eq(d).addClass("tt-is-under-cursor"),this._ensureVisibility(f),this.trigger("cursorMoved",e(f))}},_getSuggestions:function(){return this.$menu.find(".tt-suggestions > .tt-suggestion")},_ensureVisibility:function(a){var b=this.$menu.height()+parseInt(this.$menu.css("paddingTop"),10)+parseInt(this.$menu.css("paddingBottom"),10),c=this.$menu.scrollTop(),d=a.position().top,e=d+a.outerHeight(!0);0>d?this.$menu.scrollTop(c+d):e>b&&this.$menu.scrollTop(c+(e-b))},destroy:function(){this.$menu.off(".tt"),this.$menu=null},isVisible:function(){return this.isOpen&&!this.isEmpty},closeUnlessMouseIsOverDropdown:function(){this.isMouseOverDropdown||this.close()},close:function(){this.isOpen&&(this.isOpen=!1,this.isMouseOverDropdown=!1,this._hide(),this.$menu.find(".tt-suggestions > .tt-suggestion").removeClass("tt-is-under-cursor"),this.trigger("closed"))},open:function(){this.isOpen||(this.isOpen=!0,!this.isEmpty&&this._show(),this.trigger("opened"))},setLanguageDirection:function(a){var b={left:"0",right:"auto"},c={left:"auto",right:" 0"};"ltr"===a?this.$menu.css(b):this.$menu.css(c)},moveCursorUp:function(){this._moveCursor(-1)},moveCursorDown:function(){this._moveCursor(1)},getSuggestionUnderCursor:function(){var a=this._getSuggestions().filter(".tt-is-under-cursor").first();return a.length>0?e(a):null},getFirstSuggestion:function(){var a=this._getSuggestions().first();return a.length>0?e(a):null},renderSuggestions:function(b,d){var e,h,i,j,k,l="tt-dataset-"+b.name,m='<div class="tt-suggestion">%body</div>',n=this.$menu.find("."+l);0===n.length&&(h=a(f.suggestionsList).css(g.suggestionsList),n=a("<div></div>").addClass(l).append(b.header).append(h).append(b.footer).appendTo(this.$menu)),d.length>0?(this.isEmpty=!1,this.isOpen&&this._show(),i=document.createElement("div"),j=document.createDocumentFragment(),c.each(d,function(c,d){d.dataset=b.name,e=b.template(d.datum),i.innerHTML=m.replace("%body",e),k=a(i.firstChild).css(g.suggestion).data("suggestion",d),k.children().each(function(){a(this).css(g.suggestionChild)}),j.appendChild(k[0])}),n.show().find(".tt-suggestions").html(j)):this.clearSuggestions(b.name),this.trigger("suggestionsRendered")},clearSuggestions:function(a){var b=a?this.$menu.find(".tt-dataset-"+a):this.$menu.find('[class^="tt-dataset-"]'),c=b.find(".tt-suggestions");b.hide(),c.empty(),0===this._getSuggestions().length&&(this.isEmpty=!0,this._hide())}}),b}(),l=function(){function b(a){var b,d,f;c.bindAll(this),this.$node=e(a.input),this.datasets=a.datasets,this.dir=null,this.eventBus=a.eventBus,b=this.$node.find(".tt-dropdown-menu"),d=this.$node.find(".tt-query"),f=this.$node.find(".tt-hint"),this.dropdownView=new k({menu:b}).on("suggestionSelected",this._handleSelection).on("cursorMoved",this._clearHint).on("cursorMoved",this._setInputValueToSuggestionUnderCursor).on("cursorRemoved",this._setInputValueToQuery).on("cursorRemoved",this._updateHint).on("suggestionsRendered",this._updateHint).on("opened",this._updateHint).on("closed",this._clearHint).on("opened closed",this._propagateEvent),this.inputView=new j({input:d,hint:f}).on("focused",this._openDropdown).on("blured",this._closeDropdown).on("blured",this._setInputValueToQuery).on("enterKeyed tabKeyed",this._handleSelection).on("queryChanged",this._clearHint).on("queryChanged",this._clearSuggestions).on("queryChanged",this._getSuggestions).on("whitespaceChanged",this._updateHint).on("queryChanged whitespaceChanged",this._openDropdown).on("queryChanged whitespaceChanged",this._setLanguageDirection).on("escKeyed",this._closeDropdown).on("escKeyed",this._setInputValueToQuery).on("tabKeyed upKeyed downKeyed",this._managePreventDefault).on("upKeyed downKeyed",this._moveDropdownCursor).on("upKeyed downKeyed",this._openDropdown).on("tabKeyed leftKeyed rightKeyed",this._autocomplete)}function e(b){var c=a(g.wrapper),d=a(g.dropdown),e=a(b),f=a(g.hint);c=c.css(h.wrapper),d=d.css(h.dropdown),f.css(h.hint).css({backgroundAttachment:e.css("background-attachment"),backgroundClip:e.css("background-clip"),backgroundColor:e.css("background-color"),backgroundImage:e.css("background-image"),backgroundOrigin:e.css("background-origin"),backgroundPosition:e.css("background-position"),backgroundRepeat:e.css("background-repeat"),backgroundSize:e.css("background-size")}),e.data("ttAttrs",{dir:e.attr("dir"),autocomplete:e.attr("autocomplete"),spellcheck:e.attr("spellcheck"),style:e.attr("style")}),e.addClass("tt-query").attr({autocomplete:"off",spellcheck:!1}).css(h.query);try{!e.attr("dir")&&e.attr("dir","auto")}catch(i){}return e.wrap(c).parent().prepend(f).append(d)}function f(a){var b=a.find(".tt-query");c.each(b.data("ttAttrs"),function(a,d){c.isUndefined(d)?b.removeAttr(a):b.attr(a,d)}),b.detach().removeData("ttAttrs").removeClass("tt-query").insertAfter(a),a.remove()}var g={wrapper:'<span class="twitter-typeahead"></span>',hint:'<input class="tt-hint" type="text" autocomplete="off" spellcheck="off" disabled>',dropdown:'<span class="tt-dropdown-menu"></span>'},h={wrapper:{position:"relative",display:"inline-block"},hint:{position:"absolute",top:"0",left:"0",borderColor:"transparent",boxShadow:"none"},query:{position:"relative",verticalAlign:"top",backgroundColor:"transparent"},dropdown:{position:"absolute",top:"100%",left:"0",zIndex:"100",display:"none"}};return c.isMsie()&&c.mixin(h.query,{backgroundImage:"url(data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7)"}),c.isMsie()&&c.isMsie()<=7&&(c.mixin(h.wrapper,{display:"inline",zoom:"1"}),c.mixin(h.query,{marginTop:"-1px"})),c.mixin(b.prototype,d,{_managePreventDefault:function(a){var b,c,d=a.data,e=!1;switch(a.type){case"tabKeyed":b=this.inputView.getHintValue(),c=this.inputView.getInputValue(),e=b&&b!==c;break;case"upKeyed":case"downKeyed":e=!d.shiftKey&&!d.ctrlKey&&!d.metaKey}e&&d.preventDefault()},_setLanguageDirection:function(){var a=this.inputView.getLanguageDirection();a!==this.dir&&(this.dir=a,this.$node.css("direction",a),this.dropdownView.setLanguageDirection(a))},_updateHint:function(){var a,b,d,e,f,g=this.dropdownView.getFirstSuggestion(),h=g?g.value:null,i=this.dropdownView.isVisible(),j=this.inputView.isOverflow();h&&i&&!j&&(a=this.inputView.getInputValue(),b=a.replace(/\s{2,}/g," ").replace(/^\s+/g,""),d=c.escapeRegExChars(b),e=new RegExp("^(?:"+d+")(.*$)","i"),f=e.exec(h),this.inputView.setHintValue(a+(f?f[1]:"")))},_clearHint:function(){this.inputView.setHintValue("")},_clearSuggestions:function(){this.dropdownView.clearSuggestions()},_setInputValueToQuery:function(){this.inputView.setInputValue(this.inputView.getQuery())},_setInputValueToSuggestionUnderCursor:function(a){var b=a.data;this.inputView.setInputValue(b.value,!0)},_openDropdown:function(){this.dropdownView.open()},_closeDropdown:function(a){this.dropdownView["blured"===a.type?"closeUnlessMouseIsOverDropdown":"close"]()},_moveDropdownCursor:function(a){var b=a.data;b.shiftKey||b.ctrlKey||b.metaKey||this.dropdownView["upKeyed"===a.type?"moveCursorUp":"moveCursorDown"]()},_handleSelection:function(a){var b="suggestionSelected"===a.type,d=b?a.data:this.dropdownView.getSuggestionUnderCursor();d&&(this.inputView.setInputValue(d.value),b?this.inputView.focus():a.data.preventDefault(),b&&c.isMsie()?c.defer(this.dropdownView.close):this.dropdownView.close(),this.eventBus.trigger("selected",d.datum,d.dataset))},_getSuggestions:function(){var a=this,b=this.inputView.getQuery();c.isBlankString(b)||c.each(this.datasets,function(c,d){d.getSuggestions(b,function(c){b===a.inputView.getQuery()&&a.dropdownView.renderSuggestions(d,c)})})},_autocomplete:function(a){var b,c,d,e,f;("rightKeyed"!==a.type&&"leftKeyed"!==a.type||(b=this.inputView.isCursorAtEnd(),c="ltr"===this.inputView.getLanguageDirection()?"leftKeyed"===a.type:"rightKeyed"===a.type,b&&!c))&&(d=this.inputView.getQuery(),e=this.inputView.getHintValue(),""!==e&&d!==e&&(f=this.dropdownView.getFirstSuggestion(),this.inputView.setInputValue(f.value),this.eventBus.trigger("autocompleted",f.datum,f.dataset)))},_propagateEvent:function(a){this.eventBus.trigger(a.type)},destroy:function(){this.inputView.destroy(),this.dropdownView.destroy(),f(this.$node),this.$node=null},setQuery:function(a){this.inputView.setQuery(a),this.inputView.setInputValue(a),this._clearHint(),this._clearSuggestions(),this._getSuggestions()}}),b}();!function(){var b,d={},f="ttView";b={initialize:function(b){function g(){var b,d=a(this),g=new e({el:d});b=c.map(h,function(a){return a.initialize()}),d.data(f,new l({input:d,eventBus:g=new e({el:d}),datasets:h})),a.when.apply(a,b).always(function(){c.defer(function(){g.trigger("initialized")})})}var h;return b=c.isArray(b)?b:[b],0===b.length&&a.error("no datasets provided"),h=c.map(b,function(a){var b=d[a.name]?d[a.name]:new i(a);return a.name&&(d[a.name]=b),b}),this.each(g)},destroy:function(){function b(){var b=a(this),c=b.data(f);c&&(c.destroy(),b.removeData(f))}return this.each(b)},setQuery:function(b){function c(){var c=a(this).data(f);c&&c.setQuery(b)}return this.each(c)}},jQuery.fn.typeahead=function(a){return b[a]?b[a].apply(this,[].slice.call(arguments,1)):b.initialize.apply(this,arguments)}}()}(window.jQuery);
$('input#LAPORAN_KERJA_AKTIVITAS').typeahead({
	
        remote:'typeahead.php?ref=typeahead_laporan_kerja_aktivitas_cek&isian=LAPORAN_KERJA_AKTIVITAS&q=%QUERY'
        
});                                                                                                   
$('input#LAPORAN_KERJA_AREA').typeahead({
	
	remote:'typeahead.php?ref=typeahead_laporan_kerja_aktivitas_cek&isian=LAPORAN_KERJA_AREA&q=%QUERY'
	
});                                                                                                   
$('input#LAPORAN_KERJA_USER').typeahead({
	
	remote:'typeahead.php?ref=typeahead_laporan_kerja_aktivitas_cek&isian=LAPORAN_KERJA_USER&q=%QUERY'
	
});                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
$('.tt-query').css('background-color','#fff').css('margin-bottom','0px');
 

/*
$('input.PERSONAL_JABATAN_MASTER_NAME').live('keyup',function() {
	var PERSONAL_JABATAN_MASTER_NAME=$(this).val(); 
    delay(function(){
		jabatan_insert_update(PERSONAL_JABATAN_MASTER_NAME);
		jabatan_cek(PERSONAL_JABATAN_MASTER_NAME);
		//jabatan_cek(PERSONAL_JABATAN_MASTER_NAME);
		kirimentri();
    }, 2000 );
});
*/
//END TYPEHEAD
</script>   


