<!DOCTYPE html>
<html lang="en" ng-app="farmapp">
<?php include_once(__ROOT__TEMPLATES__ . 'head.php');?>

<body>
	<div id="wrapper">
		<!-- Header start -->
		<section id="header">
			<section id="header-top" class="container-fluid">
				<?php include_once( __ROOT__TEMPLATES__ . 'header-top.php');?>
			</section>
			<section id="header-nav">
				<?php include_once( __ROOT__TEMPLATES__ . 'header-nav.php');?>
			</section>
			<section class="breadcrumb-wrapper">
        		<div class="container">
		            <?php include_once( __ROOT__TEMPLATES__ . 'breadcrumb.php');?>
        		</div>
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
				
					<!-- category left sidebar start -->
					<section ng-controller="CheckoutPanelCtrl" id="checkout-panel-content" >
						<div class="col-md-9">
							<section id="checkout-panel">
								<div class="row hidden-xs" >
									<div class="col-md-12">
										<?php include_once( __ROOT__TEMPLATES__ . '/checkout/checkout-panel-nav.php');?>
									</div>
								</div>
								<div class="row" id="checkout-panel-content-views">
									<section id="shipping-data" class="col-md-12">
										<?php include_once( __ROOT__TEMPLATES__ . '/checkout/shipping-data.php');?>
									</section>
									<section id="payment-methods" class="col-md-12">
										<?php include_once( __ROOT__TEMPLATES__ . '/checkout/payment-methods.php');?>
									</section>
									<section id="order-summary" class="col-md-12">
										<?php include_once( __ROOT__TEMPLATES__ . '/checkout/order-summary.php');?>
									</section>
								</div>
							</section>
						</div>
					</section>
					<!-- category left sidebar over -->
					
					<!-- checkout panel start -->
					<section id="left_sidebar">
						<div class="col-md-3">
							<section  id="shopping-cart-panel" ng-controller="ShoppingCartCtrl">
								<div class="col-md-12" ng-if="shoppingCartWithProducts">
								<!-- define content -->
								</div>
							</section>
							<div class="col-md-12" id="categories_panel">
								<?php include_once( __ROOT__TEMPLATES__ . 'category-left-sidebar.php');?>								
							</div>							
						</div>
					</section>
					<!-- checkout panel over -->
				</div>
			</div>
		</section>
		
		<!-- Content over -->
		
		<!-- Footer start -->
		<section id="footer">
				<?php include_once( __ROOT__TEMPLATES__ . 'footer.php');?>
		</section>
		<!-- Footer over -->
	</div>	
</body>
</html>

