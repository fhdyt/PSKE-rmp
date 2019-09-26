<?php
//info personal
//$params=array('case'=>"nonlogin_master_beranda",'data_http'=>$_COOKIE['data_http'],'input_option'=>array('PERSONAL_NIK'=>$cf['user_login']['PERSONAL_NIK'])); 
//$home_master=$SISTEM->personal($params)->load->module; 

#echo "<pre>".print_r($home_master,true)."</pre>";


### Default Tab yang aktif #####
if(empty($d3)){
	$d3="master_relasi";	
}else{
	$d3=$d3;
}
?>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="list-group">
			<div class="list-group-item">
				<div class="row">
					<div class="col-md-8">
						<h3><i class="fa fa-credit-card"></i>  <?php echo  $BAHASA->terjemahkan("Master Relasi");?></h3>
					</div>
					<div class="col-md-4 text-right"></div>
				</div><!--/.row-->
				<div class="row">
						<ul class="nav nav-tabs">
						  <!--<li role="presentation" id="saldo" class=""><a href="?show=hrd/surat/cuti/saldo/">Saldo Cuti</a></li>	-->
						  <li role="presentation" id="buat_memo"><a href="?show=rmpc/relasi/master_relasi/">Master Relasi</a></li>
						  <li role="presentation" id="memo_masuk"><a href="?show=umum/form_umum/memo/memo_masuk/">List Memo Masuk</a></li>
						  <li role="presentation" id="memo_keluar"><a href="?show=umum/form_umum/memo/memo_keluar/">List Memo Keluar</a></li>
						  <!--<li role="presentation" id="verified_ptk" class=""><a href="?show=wo/transaction/work_order/verified_ptk/">Verifikasi PTK</a></li>-->
						</ul>
						<br/>
						<script>
							$(function(){
								$(".nav-tabs li").removeClass('active');
								$(".nav-tabs li#<?php echo $d3; ?>").addClass('active');
							});
						</script>
				</div>
		
				<?php 
					if($d3=='buat_memo'){
						require_once("relasi/master_relasi.php");
					}
					elseif($d3=='memo_masuk'){
						require_once("memo/memo_masuk.php");
					}
					elseif($d3=='memo_keluar'){
						require_once("memo/memo_keluar.php");
					}
					else {
						require_once("memo/memo_masuk.php");
					}
				?>
			</div><!--/.list-group-item-->
			
		</div><!--/.list-group-->
	</div><!--/.col-->
</div><!--/.row-->


