<?php

//$aplikasi_user_aktif=$CD::aplikasi_user_aktif(array('data_http'=>$_COOKIE['data_http']));
require_once('menu_sidebar.php');

//echo "<pre>".print_r($aplikasi_user_aktif,true)."</pre>";

//$menu_user_aktif=$CD::menu_user_aktif(array('data_http'=>$_COOKIE['data_http'],'url_parameter'=>$url_parameter[1],));
//echo "<pre>".print_r($menu_user_aktif,true)."</pre>";




?>         


<!------------------------------------------------------------------>
   
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  
     <?php
	 if(!isset($d1) or $d1=="")
	 {
		 $adminLTE->breadcrumb(array(
			 'title'=>"RMP",
			 'title_sub'=>"1.0",
			 'breadcrumb'=>array(
				 array('title'=>"RMP",'link'=>"#"),
				 //array('title'=>"Wiget",'link'=>"#"),
				 //array('title'=>"more title",'link'=>"#"),
			 ),
		 ));
	 }else if($d1=="rmp_monitoring")
	 {
		if(!isset($d2) or $d2=="")
		{
			$adminLTE->breadcrumb(array(
				'title'=>"MONITORING",
				'breadcrumb'=>array(
					array('title'=>"<a href='?show=rmp'>RMP</a>",'link'=>"?show=rmp"),
					array('title'=>"Monitoring",'link'=>"?show=rmp/rmp_monitoring/"),
					//array('title'=>"more title",'link'=>"#"),
				),
			));
		}else if($d2=="ap")
		{

			$adminLTE->breadcrumb(array(
				'title'=>"Monitoring AP-Payment",
				'breadcrumb'=>array(
					array('title'=>"<a href='?show=rmp'>RMP</a>",'link'=>"?show=rmp"),
					array('title'=>"<a href='?show=rmp/rmp_monitoring/'>Monitoring</a>",'link'=>"?show=rmp/rmp_monitoring"),
					array('title'=>"AP-Payment",'link'=>"?show=rmp/rmp_monitoring/ap/"),
					//array('title'=>"more title",'link'=>"#"),
				),
			));
		}else if($d2=="ap_pengajuan")
		{

			$adminLTE->breadcrumb(array(
				'title'=>"Monitoring Permohonan Bayar",
				'breadcrumb'=>array(
					array('title'=>"<a href='?show=rmp'>RMP</a>",'link'=>"?show=rmp"),
					array('title'=>"<a href='?show=rmp/rmp_monitoring/'>Monitoring</a>",'link'=>"?show=rmp/rmp_monitoring"),
					array('title'=>"AP-Pengajuan",'link'=>"?show=rmp/rmp_monitoring/ap_pengajuan/"),
					//array('title'=>"more title",'link'=>"#"),
				),
			));
		}
	 }
		
		
	 ?>
	


    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row box1" id="PlatformWiget">
		  
		<?php  
			foreach($user_wiget['result']['items']['box1'] as $wd){
				$APP_DASHBOARD=new APP_DASHBOARD();
				$APP_DASHBOARD->wiget(array('case'=>$wd['USER_DASHBOARD_CASE_NAME'],'dir_versi'=>$aplikasi_user_aktif['aktif'][0]['USER_APLIKASI_UI_DIR'],'USER_APLIKASI_ID'=>$wd['USER_APLIKASI_ID']));
			}
        ?>
         
      </div>
      <!-- /.row -->
      
      
      
      
      <!---------------------------------------------ISI----------------------------------------->
      
        			
		<div class="row">
			<div class="col-md-12">	
			<?php

			switch(strtoupper($d2)){
				case "AP":
					require_once("monitoring/ap.php");
				break;
				case "AP_PENGAJUAN":
					require_once("monitoring/ap_pengajuan.php");
				break;
				default:
					require_once("monitoring/ap.php");
				break;
			}
			?>
			</div>
			<!--	
			<div class="col-md-1">
				<div class="navbar-default sidebar" role="navigation">
						<div class="sidebar-nav">
							<ul class="nav text-center text-lg" id="side-menu">
								
								<?php if(empty($d2)){ $active_home="active"; }else{ $active_home=""; } ?>
								<li class="global-action-child <?php echo $active_home; ?>"><a href="?show=/<?php echo strtolower($d1); ?>/"><i class="glyphicon glyphicon-home"></i></a></li>
							 
								<?php
								$menu_user_aktif=$CD::menu_user_aktif(array('data_http'=>$_COOKIE['data_http'],'url_parameter'=>$url_parameter[1],));
								foreach($menu_user_aktif['refs'][0]['USER_MENU_GROUP_SUB_DATA'] as $r){
									$actived_level_one=explode("=",$r['USER_MENU_URL']);
									if($actived_level_one[1]==anti_injection($_GET['show'])){ $actived_one="active"; }else{ $actived_one=""; }
									
									echo"<li class='global-action-child ".$actived_one."' data-placement='top' data-toggle='tooltip' title='".$r['USER_PRIVILEGES_MASTER_NAME']."'><a href='".$r['USER_MENU_URL']."'><i class='".$r['USER_MENU_ICON']."'></i></a>";
										if(count($r['USER_MENU_GROUP_SUB_CHILD_DATA'])>=1){
											//menu sub
											echo"<ul class='nav nav-second-level bg-warning'>";
											foreach($r['USER_MENU_GROUP_SUB_CHILD_DATA'] as $c){ 
												echo"<li><a href='".$c['USER_MENU_URL']."'>".$c['USER_PRIVILEGES_MASTER_NAME']." &nbsp; <i class='".$c['USER_MENU_ICON']."'></i></a></li>";
											}
											echo"</ul>";
										}else{  }
									echo"</li>";	
								}
								?>
								
							   
							</ul>
						</div>
						
					</div>
					
			</div><!---->

		</div><!--/row-->
      
      <!-----------------------------END ISI------------------------->
      
      
      



      
      
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
<script>
$(function(){
	$( "div[class^='notification-version']" ).hide();
});	
//config
//http://bootstraptour.com/api/	
var tour = new Tour({
	backdrop: true,
	storage: false 
});

// Add your steps. Not too many, you don't really want to get your users sleepy
tour.addSteps([{
  element: "#PlatformHeader", // string (jQuery selector) - html element next to which the step popover should be shown
  title: "Header Bar", // string - title of the popover
  content: "Bagian ini merupakan ", // string - content of the popover
  placement: "bottom",
},{
  element: "#PlatformMenu", // string (jQuery selector) - html element next to which the step popover should be shown
  title: "Kotak Pencarian", // string - title of the popover
  content: "Bagian ini merupakan kotak untuk memasukan kata kunci pencarian", // string - content of the popover
  placement: "right",
},{
  element: "#PlatformWiget", // string (jQuery selector) - html element next to which the step popover should be shown
  title: "Kotak Pencarian", // string - title of the popover
  content: "Bagian ini merupakan kotak untuk memasukan kata kunci pencarian", // string - content of the popover
  placement: "top",
},{
  element: "#PlatformHitoriAplikasi", // string (jQuery selector) - html element next to which the step popover should be shown
  title: "Notifikasi", // string - title of the popover
  content: "Bagian ini adalah fitur notifikasi, setiap ada pemberitahuan akan muncul disini", // string - content of the popover
  placement: "top",
}]);

// Initialize the tour
tour.init();

$('.PlatformTourStart').on('click',function(){ 
	// Start the tour
    if(tour.start()){
        tour.restart();
    }
});

</script>
