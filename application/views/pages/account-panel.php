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
			<section id="header-nav" class="">
				<?php include_once( __ROOT__TEMPLATES__ . 'header-nav.php');?>
			</section>
			<section class="breadcrumb-wrapper">
        		<div class="container">
		            <?php include_once( __ROOT__TEMPLATES__ . 'breadcrumb.php');?>
        		</div>
    		</section>
		</section>
		
		<!-- Errors start -->
		<div class="container">
			<div class="row">
				<section id="errors">
					<?php include_once( __ROOT__TEMPLATES__ . 'notifications-banner.php');?>
				</section>
			</div>
		</div>
		<!-- Errors over -->
		
		<!-- Header over -->
		
		<!-- Content start -->
		<section id="content" ng-controller="AccountPanelCtrl">
			<div  class="container">
				<div class="row" id="user-name-panel">
					<div class="col-md-6 no-padding">
						<p class="bg-primary">
							<?= 'Hola! ' . $user_logged_account->first_name?>
						</p>
					</div>
				</div>
				
				<section id="primary-menu" class="hidden-xs">
					<?php include_once( __ROOT__TEMPLATES__ . '/account/primary-menu.php');?>
				</section>
				
				<div class="row" id="account-content">
					<section id="my-account" class="col-md-12 no-padding" ng-show="myAccountSelected">
						<?php include_once( __ROOT__TEMPLATES__ . '/account/my-account-section.php');?>
					</section>
					
					<section id="my-purchases" class="col-md-12 no-padding" ng-show="myPurchasesSelected"> 
						<?php include_once( __ROOT__TEMPLATES__ . '/account/my-purchases-section.php');?>			
					</section>

					<section id="my-diagnostic" class="col-md-12 no-padding" ng-show="myDiagnosticSelected">
						<?php include_once( __ROOT__TEMPLATES__ . '/account/my-diagnostic-section.php');?>
					</section>
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


