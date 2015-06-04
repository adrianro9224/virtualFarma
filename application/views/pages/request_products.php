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
                <section id="left_sidebar">
                    <div class="col-md-3">
                        <section  id="shopping-cart-panel" ng-controller="ShoppingCartCtrl">
                            <div class="col-md-12" ng-if="shoppingcart.haveProducts">
                                <?php include_once( __ROOT__TEMPLATES__ . 'shopping-cart.php');?>
                            </div>
                        </section>
                        <div class="col-md-12" id="categories_panel">
                            <?php include_once( __ROOT__TEMPLATES__ . 'category-left-sidebar.php');?>
                        </div>
                    </div>
                </section>
                <!-- category left sidebar over -->

                <!-- product list start -->
                <section ng-controller="ProductListCtrl" id="request_product_form" >
                    <div class="col-md-9">
                        <section id="form">
                            <div class="well well-lg">
                                <p class="bg-primary">...</p>
                                <form class="form-horizontal" action="<?= base_url() . 'product/send_product_request'?>" method="post" autocomplete="off">
                                    <div class="form-group">
                                        <label for="product_name" class="col-md-3 control-label">Nombre del producto: *</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name ="product_name" id="product_name" placeholder="Escribe el nombre del producto" ng-disabled="<?= $user_logged ? 0 : 1?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_lab" class="col-md-3 control-label" >Nombre del laboratorio del producto: *</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control"  name="product_lab" id="product_lab" placeholder="Escribe el laboratorio del producto" ng-disabled="<?= $user_logged ? 0 : 1?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_presentation" class="col-md-3 control-label">Presentación del producto: *</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="product_presentation" id="product_presentation" placeholder="Escribe la presentación del producto" ng-disabled="<?= $user_logged ? 0 : 1?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary" ng-disabled="<?= $user_logged ? 0 : 1?>" >Enviar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                        <?php if ( isset($related_products) ):?>
                            <section id="slick_slider">
                                <div id="slick_slider_container" class="col-md-12">
                                    <?php include( __ROOT__TEMPLATES__ . 'suggested_products_carousel.php');?>
                                </div>
                            </section>
                        <?php endif;?>
                    </div>
                </section>
                <!-- product list over -->
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


