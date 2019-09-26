<?php $RMP_CONFIG=new RMP_CONFIG();

$data=array(
  'RMP_MASTER_PERSONAL_ID'=>$d3,
);

$cr_data=array(
  'case'=>"nonlogin_data_443_detail",
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

foreach($da['refs'] as $r){
  $petani_id[]=$r;
}

?>
<style>
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
table {
	font-size: 12px;
}
table-detail {
	font-size: 9px;
}
.modal-gudang {
	width: 1300px;
}
</style>

<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="list-group">
			<div class="list-group-item">
				<div class="row">
					<div class="col-md-8">
						<h3><i class="fa fa-tree"></i> Relasi Petani</h3>
						<hr>
					</div>
					<div class="col-md-4 text-right"></div>
				</div><!--/.row-->
				<a class="btn btn-primary btn-sm" href="?show=rmp/supplier/add_petani">Tambah Petani</a> <!-- <button class="btn btn-primary btn-sm tambah" type="button"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Inventori</button> -->
				<div class="row">
					<div class="col-md-12">
					Nama : <?php echo $petani_id[0]['RMP_MASTER_PERSONAL_NAMA'] ?>
					<br>
					Alamat : <?php echo $petani_id[0]['RMP_MASTER_PERSONAL_NAMA'] ?>
				</div>
			</div>
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
			</div>
		</div>
	</div>
</div>

<script>

</script>
