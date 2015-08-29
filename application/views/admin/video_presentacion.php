<!DOCTYPE html>
<html lang="en" ng-app="farmapp">
<?php include_once(__ROOT__TEMPLATES__ . 'head.php');?>

<body>
	<div id="wrapper">
		<!-- Header start -->
		<section id="header">
			<section id="header-top" class="container-fluid">
				<?php include_once( __ROOT__ADMIN__TEMPLATES__ . 'header-top.php');?>
			</section>
		</section>
		<!-- Header over -->
		
		<!-- Errors start -->
		<div class="container">
			<div class="row">
				<section id="errors">
					<?php include_once( __ROOT__TEMPLATES__ . 'notifications-banner.php');?>
				</section>
			</div>
		</div>
		<!-- Errors over -->
		
		<!-- Content start -->
		
		<section id="content">
			<div  class="container" ng-controller="FarmacyOrdersCtrl">
                
			</div>
		</section>
		
		<!-- Content over -->
		
		<!-- Footer start -->
		<section id="footer">
				<?php include_once( __ROOT__ADMIN__TEMPLATES__ . 'footer.php');?>
		</section>
		<!-- Footer over -->
	</div>	
</body>
</html>

