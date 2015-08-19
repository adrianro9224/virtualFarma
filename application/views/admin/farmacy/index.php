<!DOCTYPE html>
<html lang="en" ng-app="farmapp">
<?php include_once(__ROOT__ADMIN__TEMPLATES__ . 'head.php');?>

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
                <audio id="newOrderAlert" src="/assets/sounds/sounds-715-nasty-error-long.mp3" hidden="true" controls preload="auto" autobuffer ></audio>
                <input type="hidden" name="numOfOrders" ng-model="numOfordersWithoutSend" ng-init="numOfordersWithoutSend = <?= '(' . $numOfordersWithoutSend . ')'; ?>">
				<div class="row" id="farmacy-subtitle">
					<p class="bg-primary"><i class="fa fa-user-md"></i> <?= $FARMACY_account->first_name . ' ' . $FARMACY_account->last_name?>
                    <?php if( $numOfordersWithoutSend > 0 ):?>
                        <label class="pull-right">
                            <input type="checkbox" name="seeying" ng-model="seeingStatusCheckbox" ng-change="changeSeeingStatus()" ng-init="seeingStatusCheckbox = 0"> Revisando
                        </label>
                        <span class="pull-right" id="num-of-orders">Ordenes sin enviar <?= '(' . $numOfordersWithoutSend . ')'; ?></span>
                    <?php endif; ?>
                    </p>
				</div>
				<div class="row">
					<section id="orders-panel" >
						<div class="col-md-12">
							<?php include_once( __ROOT__FARMACY__TEMPLATES . 'order-panel.php');?>
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

