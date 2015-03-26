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
			<div  class="container" id="sales-module">
				<div class="row">
					<section id="seller-left-sidebar">
						<div class="col-md-3">
							<?php include_once( __ROOT__SELLER__TEMPLATES . 'seller-left-sidebar.php');?>
						</div>
					</section>
					<section id="sales-creator">
						<div class="col-md-9" ng-controller="SalesCreatorCtrl">
							<?php include_once( __ROOT__SELLER__TEMPLATES . 'sales-creator.php');?>
						</div>
					</section>
				</div>
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



