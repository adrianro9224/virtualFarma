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
                <section id="request_product_form" >
                    <div class="col-md-9">
                        <section id="product-request-form" ng-controller="RequestProductCtrl">
                            <div class="well well-lg">
                                <p class="bg-primary">Cuentanos si tienes alguna pregunta, queja, sugerencía o reclamo :):</p>
                                <form class="form-horizontal" name="productRequestForm" action="<?= base_url() . 'contact/send_pqrs'?>" method="post" autocomplete="on" novalidate>
                                    <div class="form-group" ng-class="{'has-error': !productRequestForm.name.$valid && productRequestForm.name.$dirty}">
                                        <label for="product_name" class="col-md-3 control-label">Nombre completo: *</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name ="name" ng-model="name" id="product_name" placeholder="Tu nombre completo"  ng-maxLength="100" required>
                                            <!-- tooltip -->
                                            <div ng-if="productRequestForm.name.$invalid && productRequestForm.name.$dirty">
                                                <div class="arrow-up-error">
                                                </div>
                                                <div class="farma-tooltip-error">
                                                    <span ng-if="productRequestForm.name.$error.required && productRequestForm.name.$dirty">Por favor escribe tu nombre completo!</span>
                                                    <span ng-if="productRequestForm.name.$error.maxlength && productRequestForm.name.$dirty">Es demaciado extenso!</span>
                                                </div>
                                            </div>
                                            <!-- tooltip -->
                                        </div>
                                    </div>
                                    <div class="form-group" ng-class="{'has-error': !productRequestForm.email.$valid && productRequestForm.email.$dirty}">
                                        <label for="product_lab" class="col-md-3 control-label" >Correo electrónico: *</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control"  name="email" ng-model="email" id="product_lab" placeholder="Tu email" placeholder="Ingrese su correo electrónico" ng-pattern="/[\w.]+?\@{1}[\w.]+(\.+[\w.]+)/" ng-maxLength="63" required>
                                            <!-- tooltip -->
                                            <div ng-if="productRequestForm.email.$invalid && productRequestForm.email.$dirty">
                                                <div class="arrow-up-error">
                                                </div>
                                                <div class="farma-tooltip-error">
                                                    <span ng-if="productRequestForm.email.$error.required && productRequestForm.email.$dirty">Por favor escribe tu email!</span>
                                                    <span ng-if="productRequestForm.email.$error.maxlength && productRequestForm.email.$dirty">Es demaciado extenso!</span>
                                                    <span ng-if="productRequestForm.email.$error.pattern || productRequestForm.email.$error.email">Por favor ingresa un correo electrónico válido!</span>
                                                </div>
                                            </div>
                                            <!-- tooltip -->
                                        </div>
                                    </div>
                                    <div class="form-group" ng-class="{'has-error': !productRequestForm.pqrs.$valid && productRequestForm.pqrs.$dirty}">
                                        <label for="product_presentation" class="col-md-3 control-label">Comentario: *</label>
                                        <div class="col-md-5">
                                            <textarea class="form-control" name="pqrs" ng-model="pqrs" rows="3" required></textarea>
                                            <!-- tooltip -->
                                            <div ng-if="productRequestForm.pqrs.$invalid && productRequestForm.pqrs.$dirty">
                                                <div class="arrow-up-error">
                                                </div>
                                                <div class="farma-tooltip-error">
                                                    <span ng-if="productRequestForm.pqrs.$error.required && productRequestForm.pqrs.$dirty">Indicanos tu comentario!</span>
                                                </div>
                                            </div>
                                            <!-- tooltip -->

                                        </div>
                                    </div>

                                    <input type="hidden" name="date_of_pqrs_request" id="date_of_request" ng-value="dateOfProductRequest" required>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary" ng-disabled="productRequestForm.$invalid" >Enviar</button>
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


