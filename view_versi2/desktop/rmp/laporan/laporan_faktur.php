<?php

	if(empty($d3))
	{
		$d3 = "gelondong";
	}
	else
	{
		$d3 = $d3;
	}

?>

<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="list-group">
			<div class="list-group-item">
				<div class="row">
					<div class="col-md-8">
						<h3><i class="fa fa-credit-card"></i> Laporan Faktur</h3>
					</div><!-- col-md-8 -->
					<div class="col-md-4 text-right"></div>
				</div><!-- row -->
				<div class="row">
					<ul class="nav nav-tabs">
						<li id="gelondong" role="presentation">
							<a href="?show=rmp/laporan/laporan_faktur/gelondong">Gelondong</a>
						</li>
						<li class="active" id="kelapa_bulat" role="presentation">
							<a href="?show=rmp/laporan/laporan_faktur/kelapa_bulat">Kelapa Bulat</a>
						</li>
						<li class="active" id="kelapa_licin" role="presentation">
							<a href="?show=rmp/laporan/laporan_faktur/kelapa_licin">Kelapa Licin</a>
						</li>
					</ul><!-- nav nav-tabs -->
					<br>
					<script>
					    $(function(){
					        $(".nav-tabs li").removeClass('active');
					        $(".nav-tabs li#<?php echo $d3; ?>").addClass('active');
					    });
					</script>
				</div><!-- row -->
					<?php

				        if($d3=='gelondong')
				        {
				            require_once("tab/gelondong.php");
				        }
				        elseif($d3=='kelapa_bulat')
				        {
				            require_once("tab/kelapa_bulat.php");
				        }
				        elseif($d3=='kelapa_licin')
				        {
				            require_once("tab/kelapa_licin.php");
				        }
				        else
				        {
				            require_once("tab/gelondong.php");
				        }

				    ?>
			</div><!-- list-group-item -->
		</div><!-- list-group -->
	</div><!-- col-lg-12 col-md-12 -->
</div> <!-- row -->