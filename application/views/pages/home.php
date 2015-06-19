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
                <p id="hours_of_operation" class="bg-info"><strong>Horario de actención:</strong> Lunes a Viernes 8am a 8pm / Sábados de 8am a 6pm y Domingos y Festivos servicio solo virtual (no Callcenter) de 9am a 6pm‏</p>
			</div>
		</div>
		<!-- Errors over -->
		
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
