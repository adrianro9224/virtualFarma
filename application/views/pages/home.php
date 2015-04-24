<!DOCTYPE html>
<html lang="en" ng-app="farmapp">
<?php include_once(__ROOT__TEMPLATES__ . 'head.php');?>

<body ng-controller="MainCtrl">
	<div id="wrapper">
		<!-- Header start -->
		<section id="header">
			<section id="header-top" class="container-fluid">
				<?php include_once( __ROOT__TEMPLATES__ . 'header-top.php');?>
			</section>
			<section id="header-nav" class="">
				<?php include_once( __ROOT__TEMPLATES__ . 'header-nav.php');?>
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
		
		<!-- Search products results start -->
		<section id="search-widget-results">
			<div class="container">
				<div class="col-md-12">
					<?php include_once( __ROOT__TEMPLATES__ . 'search_results.php');?>
				</div>
			</div>
		</section>
		<!-- Search products results start -->
		
		<!-- Content start -->
		<section id="carousel">
			<?php include_once( __ROOT__TEMPLATES__ . 'carousel.php');?>
		</section>
		<div class="container" >
			<section id="content">
			</section>
		</div>
		<!-- Content over -->
		<!-- Footer start -->
		<section id="footer">
				<?php include_once( __ROOT__TEMPLATES__ . 'footer.php');?>
		</section>
		<!-- Footer over -->
	</div>	
</body>
</html>
