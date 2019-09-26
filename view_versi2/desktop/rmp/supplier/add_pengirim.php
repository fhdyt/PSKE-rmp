<?php
$RMP_CONFIG=new RMP_CONFIG();
?>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="list-group">
			<div class="list-group-item">
				<div class="row">
					<div class="col-md-8">
						<h3><i class="fa fa-cubes"></i> Tambah Pengirim</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right"></div>
				</div><!--/.row-->
				<form class="formPengirim" id="formPengirim" action="javascript:download();">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Nama Lengkap</label>
							<input autocomplete="off" class="form-control NAMA" id="NAMA" name="NAMA" placeholder="NAMA LENGKAP" type="text">
							<p class="help-block">Isi sesuai kartu identitas anda.</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="exampleInputEmail1">No. KTP</label>
							<input autocomplete="off" class="form-control KTP" id="KTP" name="KTP" placeholder="Nomor KTP" type="text">
							<p class="help-block">Isi sesuai kartu identitas anda.</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="exampleInputEmail1">NPWP</label>
							<input autocomplete="off" class="form-control NPWP" id="NPWP" name="NPWP" placeholder="NPWP" type="text">
							<p class="help-block">Nomor Pokok Wajib Pajak.</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Tanggal Pendaftaran</label>
							<input autocomplete="off" class="form-control datepicker TANGGAL_DAFTAR" data-date-format="yyyy/mm/dd" id="TANGGAL_DAFTAR" name="TANGGAL_DAFTAR" type="text" value="">
							<p class="help-block">Tanggap Pendaftaran, Format tanggal (YYYY/MM/DD).</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="exampleInputEmail1">No. HP</label>
							<input autocomplete="off" class="form-control HP" id="HP" name="HP" placeholder="" type="text">
							<p class="help-block">Isi Jika ada.</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Telp/FAX</label>
							<input autocomplete="off" class="form-control TELP" id="TELP" name="TELP" placeholder="" type="text">
							<p class="help-block">Isi Jika ada.</p>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- <div class="col-md-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Email</label> <input class="form-control" id="" placeholder="" type="text">
							<p class="help-block">Example block-level help text here.</p>
						</div>
					</div> -->

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Provinsi</label>
								<select id="PROVINSI" name="PROVINSI"  type="text" class="form-control PROVINSI"  autocomplete="off" onchange="provinsi()" >
								<option value="">--Pilih Provinsi--</option>
								<?php  $data = $RMP_CONFIG->provinsi(); foreach ($data['rasult'] as $key => $value) {	foreach ($value as $data => $isi) 		{ ?>
										<option value="<?php echo $isi['INDONESIA_PROVINSI_ID']; ?>"> <?php  echo $isi['INDONESIA_PROVINSI'];?></option>
												<?php	}}		?>
								</select>
								<p class="help-block">Isi sesuai kartu identitas anda.</p>
							</div>
						</div>
						<div class="col-md-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Kabupaten</label>
							<select id="KABUPATEN" name="KABUPATEN"  type="text" class="form-control KABUPATEN"  onchange="kabupaten()
							" autocomplete="off"  >
           					<option value="">--Pilih Kabupaten--</option>
							</select>
							<p class="help-block">Isi sesuai kartu identitas anda.</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Kecamatan</label>
							<select id="KECAMATAN" name="KECAMATAN"  type="text" class="form-control KECAMATAN"  autocomplete="off" onchange="kecamatan()" >
           					<option value="">--Pilih Kecamatan--</option>
							</select>
							<p class="help-block">Isi sesuai kartu identitas anda.</p>
						</div>
					</div>

				</div>
				<div class="row">
				<div class="col-md-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Desa</label>
							<select id="DESA" name="DESA"  type="text" class="form-control DESA"  autocomplete="off"  >
           					<option value="">--Pilih Desa--</option>
							</select>
							<p class="help-block">Isi sesuai kartu identitas anda.</p>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label for="exampleInputEmail1">Alamat</label> <input autocomplete="off" class="form-control" id="" placeholder="" type="text">
							<p class="help-block">Isi sesuai kartu identitas anda.</p>
						</div>
					</div>
					<!-- <div class="col-md-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Email</label> <input class="form-control" id="" placeholder="" type="text">
							<p class="help-block">Example block-level help text here.</p>
						</div>
					</div> -->
				</div>
				<div class="row">
					<div class="col-md-12 text-right">
						<a class="btn btn-success simpanPengirim" id="simpanPengirim">Simpan</a>
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

var KABUPATEN = function() {
	var PROVINSI_VAL = $('select.PROVINSI').val();
	//console.log(PROVINSI_VAL);
	$.ajax({
		type: 'POST',
		url: refseeAPI,
		dataType: 'json',
		data: 'ref=sel_kabupaten&PROVINSI=' + PROVINSI_VAL,
		success: function(data) {
			if (data.respon.pesan == "sukses") {
				//console.log("Sukses");
				$('select.KABUPATEN').empty();
				for (s = 0; s < data.result.length; s++) {
					//console.log(data.result[s].INDONESIA_KABUPATEN);
					$('select.KABUPATEN').append('<option value="' + data.result[s].INDONESIA_KABUPATEN_ID + '">' + data.result[s].INDONESIA_KABUPATEN + '</option>');
				}
			} else if (data.respon.pesan == "gagal") {
				//console.log("Gagal");
			}
		}, //end success
		error: function(x, e) {
			//console.log("Error Ajax");
		} //end error
	});
}

function provinsi() {
	//console.log("ONCHANGE")
	var send = new KABUPATEN();
	$('select.KECAMATAN').empty();
	$('select.DESA').empty();
};



var KECAMATAN = function() {
	var KABUPATEN_VAL = $('select.KABUPATEN').val();
	//console.log(KABUPATEN_VAL);
	$.ajax({
		type: 'POST',
		url: refseeAPI,
		dataType: 'json',
		data: 'ref=sel_kecamatan&KABUPATEN=' + KABUPATEN_VAL,
		success: function(data) {
			if (data.respon.pesan == "sukses") {
				//console.log("Sukses");
				$('select.KECAMATAN').empty();
				for (s = 0; s < data.result.length; s++) {
					//console.log(data.result[s].INDONESIA_KECAMATAN);
					$('select.KECAMATAN').append('<option value="' + data.result[s].INDONESIA_KECAMATAN_ID + '">' + data.result[s].INDONESIA_KECAMATAN + '</option>');
				}
			} else if (data.respon.pesan == "gagal") {
				//console.log("Gagal");
			}
		}, //end success
		error: function(x, e) {
			//console.log("Error Ajax");
		} //end error
	});
}

function kabupaten() {
	//console.log("ONCHANGE")
	var send = new KECAMATAN();
	$('select.DESA').empty();
};


var DESA = function() {
	var KECAMATAN_VAL = $('select.KECAMATAN').val();
	console.log(KECAMATAN_VAL);
	$.ajax({
		type: 'POST',
		url: refseeAPI,
		dataType: 'json',
		data: 'ref=sel_desa&KECAMATAN=' + KECAMATAN_VAL,
		success: function(data) {
			if (data.respon.pesan == "sukses") {
				//'console.log("Sukses");
				$('select.DESA').empty();
				for (s = 0; s < data.result.length; s++) {
					//'console.info(data.result[s].INDONESIA_DESA);
					$('select.DESA').append('<option value="' + data.result[s].INDONESIA_DESA_ID + '">' + data.result[s].INDONESIA_DESA + '</option>');
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

function kecamatan() {
	//'console.log("ONCHANGE");
	var send = new DESA();
};


$('.simpanPengirim').on('click',function(){
var formPengirim = $('form.formPengirim').serialize();
console.log(formPengirim);

$.ajax({
	type: 'POST',
	url: refseeAPI,
	dataType: 'json',
	data: 'ref=add_pengirim&' + formPengirim,
	success: function(data) {
		if (data.respon.pesan == "sukses")
		{
			console.log(data.respon.text_msg);
			window.location.href = "?show=rmp/supplier/master_pengirim";
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
