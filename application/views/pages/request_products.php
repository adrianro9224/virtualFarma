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
                <section id="request_product_form" ng-controller="RequestProductCtrl">

                    <div class="col-md-9" >
                        <section id="product-request-before" >
                            <div class="row" >
                                <p class="bg-primary sample-show-hide.ng-hide" ng-if="!showRequestProductForm">¡Lo sentimos! tu búsqueda <strong><?= '"' . $string_to_search  . '"'?></strong> no ha generado ninguna coincidencia.</p>
                                <div class="col-md-4">
                                    <section id="product-request-before" >
                                        <div class="list-group">
                                            <a href="#" class="list-group-item active">
                                                <h4 class="list-group-item-heading">Te sugerimos</h4>
                                                <p class="list-group-item-text">Revisa la ortografía de tu búsqueda</p>
                                            </a>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-md-8">
                                    <div class="list-group" ng-click="showForm()">
                                        <a class="list-group-item active">
                                            <h4 class="list-group-item-heading">Solicitar producto</h4>
                                            <p class="list-group-item-text">¿No encontraste tu producto?, permitenos ayudarte, haz click y sigue los pasos</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </section>


                        <section id="product-request-form" ng-if="showRequestProductForm" >
                            <div class="well well-lg">
                                <!--<p class="bg-primary">¡Lo sentimos! No contamos con el producto que estás buscando en estos momentos. Sabemos que tu salud y tu tiempo son muy valiosos, por eso podemos buscar tu producto en el menor tiempo posible. Si deseas este servicio de búsqueda avanzada, por favor diligencia el siguiente formulario:</p>-->
                                <form class="form-horizontal" name="productRequestForm" action="<?= base_url() . 'product/send_product_request'?>" method="post" autocomplete="on" novalidate>
                                    <div class="form-group" ng-class="{'has-error': !productRequestForm.productName.$valid && productRequestForm.productName.$dirty}">
                                        <label for="product_name" class="col-md-3 control-label">Nombre del producto: *</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name ="productName" ng-model="productName" id="product_name" placeholder="Escribe el nombre del producto" ng-disabled="<?= $user_logged ? 0 : 1?>"  ng-maxLength="63" required>
                                            <!-- tooltip -->
                                            <div ng-if="productRequestForm.productName.$invalid && productRequestForm.productName.$dirty">
                                                <div class="arrow-up-error">
                                                </div>
                                                <div class="farma-tooltip-error">
                                                    <span ng-if="productRequestForm.productName.$error.required && productRequestForm.productName.$dirty">Por favor escribe el nombre del producto!</span>
                                                    <span ng-if="productRequestForm.productName.$error.maxlength && productRequestForm.productName.$dirty">Es demaciado extenso!</span>
                                                </div>
                                            </div>
                                            <!-- tooltip -->
                                            <!-- helptext -->
                                            <span id="helpBlock" class="help-block">Ejemplo: Losartán</span>
                                            <!-- helptext -->
                                        </div>
                                    </div>
                                    <div class="form-group" ng-class="{'has-error': !productRequestForm.productLab.$valid && productRequestForm.productLab.$dirty}">
                                        <label for="product_lab" class="col-md-3 control-label" >Nombre del laboratorio del producto: </label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control"  name="productLab" ng-model="productLab" id="product_lab" placeholder="Escribe el laboratorio del producto" ng-disabled="<?= $user_logged ? 0 : 1?>" ng-maxLength="63">
                                            <!-- tooltip -->
                                            <div ng-if="productRequestForm.productLab.$invalid && productRequestForm.productLab.$dirty">
                                                <div class="arrow-up-error">
                                                </div>
                                                <div class="farma-tooltip-error">
                                                    <span ng-if="productRequestForm.productLab.$error.required && productRequestForm.productLab.$dirty">Por favor escribe el laboratorio de tu producto!</span>
                                                    <span ng-if="productRequestForm.productLab.$error.maxlength && productRequestForm.productLab.$dirty">Es demaciado extenso!</span>
                                                </div>
                                            </div>
                                            <!-- tooltip -->
                                            <!-- helptext -->
                                            <span id="helpBlock" class="help-block">Ejemplo: MK</span>
                                            <!-- helptext -->
                                        </div>
                                    </div>
                                    <div class="form-group" ng-class="{'has-error': !productRequestForm.productPresentation.$valid && productRequestForm.productPresentation.$dirty}">
                                        <label for="product_presentation" class="col-md-3 control-label">Presentación del producto: *</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="productPresentation" ng-model="productPresentation" id="product_presentation" placeholder="Escribe la presentación del producto" ng-disabled="<?= $user_logged ? 0 : 1?>" ng-maxLength="63" required>
                                            <!-- tooltip -->
                                            <div ng-if="productRequestForm.productPresentation.$invalid && productRequestForm.productPresentation.$dirty">
                                                <div class="arrow-up-error">
                                                </div>
                                                <div class="farma-tooltip-error">
                                                    <span ng-if="productRequestForm.productPresentation.$error.required && productRequestForm.productPresentation.$dirty">Por favor escribe la presentación en la que viene en tu producto!</span>
                                                    <span ng-if="productRequestForm.productPresentation.$error.maxlength && productRequestForm.productPresentation.$dirty">Es demaciado extenso!</span>
                                                </div>
                                            </div>
                                            <!-- tooltip -->
                                            <!-- helptext -->
                                            <span id="helpBlock" class="help-block">Ejemplo: Tabletas de 100 mg - Jarabe 300 ml</span>
                                            <!-- helptext -->
                                        </div>
                                    </div>

                                    <input type="hidden" name="date_of_product_request" id="date_of_request" ng-value="dateOfProductRequest" required>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary" ng-disabled="<?= $user_logged ? 0 : 1?> || productRequestForm.$invalid" >Enviar</button>
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


