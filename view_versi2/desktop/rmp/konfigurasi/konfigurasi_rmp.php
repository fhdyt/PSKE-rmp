<?php

	if(empty($d2))
	{
		$d2 = "wilayah";
	}
	else
	{
		$d2 = $d2;
	}

?>

<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="list-group">
			<div class="list-group-item">
				<div class="row">
					<div class="col-md-8">
						<h3><i class="fa fa-credit-card"></i> Konfigurasi RMP</h3>
					</div><!-- col-md-8 -->
					<div class="col-md-4 text-right"></div>
				</div><!-- row -->
				<div class="row">
					<ul class="nav nav-tabs">
						<li id="wilayah" role="presentation">
							<a href="?show=rmp/konfigurasi_rmp/wilayah">Wilayah</a>
						</li>
						<li class="active" id="material" role="presentation">
							<a href="?show=rmp/konfigurasi_rmp/material">Material</a>
						</li>
						<li class="active" id="harga" role="presentation">
							<a href="?show=rmp/konfigurasi_rmp/harga">Harga</a>
						</li>
						<li class="active" id="harga_faktur_cabang" role="presentation">
							<a href="?show=rmp/konfigurasi_rmp/harga_faktur_cabang">Harga Faktur Cabang</a>
						</li>
					</ul><!-- nav nav-tabs -->
					<br>
					<script>
					    $(function(){
					        $(".nav-tabs li").removeClass('active');
					        $(".nav-tabs li#<?php echo $d2; ?>").addClass('active');
					    });
					</script>
				</div><!-- row -->
					<?php

				        if($d2=='wilayah')
				        {
				            require_once("tab/konfigurasi_wilayah.php");
				        }
				        elseif($d2=='material')
				        {
				            require_once("tab/konfigurasi_material.php");
				        }
				        elseif($d2=='harga')
				        {
				            require_once("tab/konfigurasi_harga.php");
				        }
				        elseif($d2=='harga_faktur_cabang')
				        {
				            require_once("tab/konfigurasi_harga_fc.php");
				        }
				        else
				        {
				            require_once("tab/konfigurasi_wilayah.php");
				        }

				    ?>
			</div><!-- list-group-item -->
		</div><!-- list-group -->
	</div><!-- col-lg-12 col-md-12 -->
</div> <!-- row -->
