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
							<section id="checkout-panel" ng-controller="CheckoutPanelCtrl">
								<div class="row">
									<div class="col-md-12">
										<section id="checkout-panel-nav">
												<div class="btn-group btn-group-justified" role="group" aria-label="...">
													<div class="btn-group" role="group">
											    		<button type="button" class="btn btn-default" ng-click="openSection('shippingData')" ng-class="{active: shippingData}">
											    			<span class="glyphicon glyphicon-map-marker"></span>
											    			Datos de envío
											    		</button>
											  		</div>
												  	<div class="btn-group" role="group">
												    	<button type="button" class="btn btn-default" ng-click="openSection('paymentMethod')" ng-class="{active: paymentMethod}">
												    		<span class="glyphicon glyphicon-usd"></span>
												    		Forma de pago
												    	</button>
												  	</div>
											  		<div class="btn-group" role="group">
													    <button type="button" class="btn btn-default" ng-click="openSection('orderSummary')" ng-class="{active: orderSummary}">
															<span class="glyphicon glyphicon-shopping-cart"></span>
														    Resumen de la orden
													    </button>
												  	</div>
												</div>										
										</section>
									</div>
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
								</div>
							</section>
							<div class="col-md-12">
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

