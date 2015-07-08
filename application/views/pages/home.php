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
		
		<!-- Content start -->
		<section id="carousel">
			<?php include_once( __ROOT__TEMPLATES__ . 'carousel.php');?>
		</section>
		<div class="container" >
			<section id="content">
                <?php if ( isset($products) ):?>
                <div class="row">
                    <?php foreach ( $products as $product ): ?>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="<?= base_url() . 'assets/images/products/' . $product->uri_img . $product->image_format_id?>" class="img-responsive" alt="<?= $product->name ?>" >
                            <div class="caption">
                                <h3><?= $product->name ?></h3>
                                <p><?= $product->presentation ?></p>
                                <h3 class="primary-emphasis" ng-bind="<?= $product->price ?> | currency : '$' : 0"></h3>
                                <p><a href="<?= '/product/search_product/' . lcfirst(str_replace(' ', '_', $product->name))  ?>" class="btn btn-primary">Agregar</a></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif;?>
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
