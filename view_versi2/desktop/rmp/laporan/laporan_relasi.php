<?php

	if(empty($d3))
	{
		$d3 = "kopra";
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
						<h3><i class="fa fa-credit-card"></i> Laporan Relasi</h3>
					</div><!-- col-md-8 -->
					<div class="col-md-4 text-right"></div>
				</div><!-- row -->
				<div class="row">
					<ul class="nav nav-tabs">
						<li id="gelondong" role="presentation">
							<a href="?show=rmp/laporan/laporan_relasi/gelondong">Gelondong</a>
						</li>
						<li class="active" id="jambul" role="presentation">
							<a href="?show=rmp/laporan/laporan_relasi/jambul">Jambul</a>
						</li>
						<li class="active" id="licin" role="presentation">
							<a href="?show=rmp/laporan/laporan_relasi/licin">Licin</a>
						</li>
						<li class="active" id="kopra" role="presentation">
							<a href="?show=rmp/laporan/laporan_relasi/kopra">Kopra</a>
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
				            require_once("tab_laporan_relasi/gelondong.php");
				        }
				        elseif($d3=='jambul')
				        {
				            require_once("tab_laporan_relasi/jambul.php");
				        }
				        elseif($d3=='licin')
				        {
				            require_once("tab_laporan_relasi/licin.php");
				        }
				        elseif($d3=='kopra')
				        {
				            require_once("tab_laporan_relasi/kopra.php");
				        }
				        else
				        {
				            require_once("tab_laporan_relasi/kopra.php");
				        }

				    ?>
			</div><!-- list-group-item -->
		</div><!-- list-group -->
	</div><!-- col-lg-12 col-md-12 -->
</div> <!-- row -->
