<div class="">
	<div class="row" ng-controller="ShoppingCartAxuCtrl">
        <div class="visible-xs-12 hidden-lg hidden-md">
            <img class="center-horizontaly" id="normal-logo" src="<?= base_url() . 'assets/images/logo/logo_virtualfarma_final.png'?>" class="img-responsive" alt="virtualfarma.com.co">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 primary-background">
            <div class="row">
                <div class="col-md-12">
                    <div class="header-item-container">
                        <div class="header-item">
                            <i class="fa fa-phone-square fa-2x"></i>
                            <span > Linea de ventas Bogotá D.C</span>
                        </div>
                        <div class="header-item">
                            <h1>606 2101</h1>
                        </div>
                        <div class="header-item" id="WA-info">
                            <i class="fa fa-whatsapp"></i>
                            <span ><strong>WhatsApp 322 5714648</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <img class="hidden-xs hidden-sm center-horizontaly" id="normal-logo" src="<?= base_url() . 'assets/images/logo/logo_virtualfarma_final.png'?>" class="img-responsive" alt="virtualfarma.com.co">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 primary-background" id="login_buttons">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group-wrap">
                        <div class="btn-group" >
                            <?php if( $user_logged ):?>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    Opciones <i class="fa fa-user"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/account/log_in"><i class="fa fa-cog"></i> Panel</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/account/log_out"><i class="fa fa-sign-out"></i> Cerrar sessión</a></li>
                                </ul>
                            <?php else:?>
                                <a class="btn btn-default" href="/account" role="button">Regístrate <i class="fa fa-user-plus"></i></a>
                                <a class="btn btn-default" href="/account" role="button">Iniciar sesión <i class="fa fa-users"></i></a>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ( isset($shoppingcart) ): ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div id="mini-shopping-cart-details-aux">
                        <a ng-click="showShoppingCartAux()" ><i class="fa fa-shopping-cart"></i> Ver productos <i class="fa fa-chevron-down"></i></a>
                    </div>
                    <!-- shoppingcart-aux-->
                    <div class="row ng-cloak" ng-cloak>
                        <div class="col-md-12">
                            <section  id="shopping-cart-panel" ng-controller="ShoppingCartCtrl">
                                <div id="shopping-cart-panel-aux" class="col-md-12 check-element animate-hide" ng-show="show" ng-hide="!show"  ng-if="shoppingcart.haveProducts">
                                    <div class="panel panel-default" >
                                        <div id="shopping-cart-panel-content" >
                                            <div id="total-products" class="shopping-cart-item">
                                                <div class="shopping-cart-item-content">
                                                    <span class="title">Subtotal</span>
                                                </div>
                                                <div class="shopping-cart-item-content">
                                                    <span class="pull-right value" ng-bind="subtotal | currency : '$' : 0"></span>
                                                </div>
                                            </div>
                                            <div id="total-products" class="shopping-cart-item">
                                                <div class="shopping-cart-item-content">
                                                    <span class="title" >Costo de envío</span>
                                                </div>
                                                <div class="shopping-cart-item-content">
                                                    <span class="pull-right value" ng-bind="shippingCharge" ng-show="shoppingcart.shippingFree"></span>
                                                    <span class="pull-right value" ng-bind="shippingCharge | currency : '$' : 0" ng-show="!shoppingcart.shippingFree"></span>
                                                </div>
                                            </div>
                                            <div id="total-products" class="shopping-cart-item">
                                                <div class="shopping-cart-item-content">
                                                    <span class="title">IVA</span>
                                                </div>
                                                <div class="shopping-cart-item-content">
                                                    <span class="pull-right value" ng-bind="tax | currency : '$' : 0"></span>
                                                </div>
                                            </div>
                                            <div id="total-products" class="shopping-cart-item">
                                                <div class="shopping-cart-item-content">
                                                    <span class="title">Total</span>
                                                </div>
                                                <div class="shopping-cart-item-content">
                                                    <span class="pull-right value secondary-emphasis" ng-class="{'text-danger' : limitOrderValueInvalid}" ng-bind="total | currency : '$' : 0"></span>
                                                </div>
                                                <div class="form-group ng-cloak" ng-if="shoppingcart.minimumOrderValueInvalid" ng-cloak>
                                                    <!-- tooltip -->
                                                    <div class="arrow-up-info">
                                                    </div>
                                                    <div class="farma-tooltip-info">
                                                        <span ng-bind=" 'El mónto mínimo de tu compra debe ser de ' + (shoppingcart.minimumOrderValue | currency : '$' : 0) + ' pesos :(, solo te faltan ' + ((shoppingcart.minimumOrderValue - shoppingcart.subtotal) | currency : '$' : 0) + ' :D'"></span>
                                                    </div>
                                                    <!-- tooltip -->
                                                </div>
                                                <div class="form-group ng-cloak" ng-if="shoppingcart.limitOrderValueInvalid" ng-cloak>
                                                    <!-- tooltip -->
                                                    <div class="arrow-up-info">
                                                    </div>
                                                    <div class="farma-tooltip-info">
                                                        <span>El mónto máximo de tu compra no debe superar los 2'800.000 si vas a realizar tu compra atravez de Payu :'(</span>
                                                    </div>
                                                    <!-- tooltip -->
                                                </div>
                                            </div>
                                        </div>
                                        <div id="mini-shopping-cart-details" class="table-responsive table-emphasis">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th><span>Producto</span></th>
                                                    <th><span class="pull-right">Cant</span></th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr ng-repeat="(key, product) in shoppingcart.products">
                                                    <td ng-bind="product.name"></td>
                                                    <td><span class="pull-right" ng-bind="product.cant"></span></td>
                                                    <td><button ng-click="removeProduct( key )" type="button" class="close pull-right" aria-label="Close"><span aria-hidden="true">&times;</span></button></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <a id="button-payment" href="/checkout"class="btn btn-primary" role="button" ng-disabled="shoppingcart.minimumOrderValueInvalid">Pagar</a>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
	</div>
</div>