<!DOCTYPE html>
<html lang="en" ng-app="farmapp">
<?php include_once(__ROOT__ADMIN__TEMPLATES__ . 'head.php');?>

<body ng-controller="MainCtrl">
	<div id="wrapper">
		<!-- Header start -->
		<section id="admin-header" class="primary-background" ng-controller="HeaderNavCtrl">
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
				<div class="row" ng-controller="SalesCreatorCtrl">
					<section id="seller-left-sidebar">
						<div class="col-md-3">
							<section  id="shopping-cart-panel">
								<div class="col-md-12" ng-if="sale.shoppingcart.haveProducts">
									<?php include_once( __ROOT__SELLER__TEMPLATES . 'sales-shopping-cart.php');?>
								</div>
							</section>
							<div class="col-md-12" id="left-sidebar-seller_options">
								<?php include_once( __ROOT__SELLER__TEMPLATES . 'seller-left-sidebar.php');?>
							</div>
						</div>
					</section>
					<section id="sales-creator">
						<div class="col-md-9" >
							<?php include_once( __ROOT__SELLER__TEMPLATES . 'sales-creator.php');?>
						</div>
					</section>
				</div>
			</div>
		</section>
		
		<!-- Content over -->
		
		<!-- Footer start -->
		<section id="footer">

		</section>
		<!-- Footer over -->
	</div>	
</body>
</html>



