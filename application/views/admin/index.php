<!DOCTYPE html>
<html lang="en" ng-app="farmapp">
<?php include_once(__ROOT__ADMIN__TEMPLATES__ . 'head.php');?>

<body>
	<div id="wrapper">
		<!-- Header start -->
		<section id="admin-header" class="primary-background">
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
			<div  class="container">
				<div class="row">
					<section id="admin_log_in">
						<div class="col-md-offset-3">
							<?php include_once( __ROOT__ADMIN__TEMPLATES__ . 'log-in.php');?>
						</div>
					</section>
				</div>
			</div>
		</section>
		
		<!-- Content over -->
		
		<!-- Footer start -->

		<!-- Footer over -->
	</div>	
</body>
</html>


