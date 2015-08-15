<div class="panel panel-default">
	<div class="panel-heading handy" ng-click="openSection('orderSummary')" ng-class="{ 'disabled-panel-heading' : !order.shippingData.status || !order.paymentMethod.status }">
		<h4><i class="fa fa-shopping-cart"></i> Paso 3: confirmar orden</h4>
	</div>
	<div class="panel-body" ng-if="orderSummary">
		<div id="order-summary-container" ng-hide="order.sended">
			<p>Acá esta toda la información relacionada con tu compra:</p>
            <p class="bg-info">Por cada $1000 pesos en compras recibirás 20 puntos :D <i class="fa fa-gift"></i></p>
            <!-- Use points -->
            <?php if ( isset($points) ): ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" ng-checked="order.shoppingcart.hasDiscount" ng-change="reedemPoints( '<?= $points?>' )" ng-model="pointsToReedem" ng-value="<?= $points?>"> Tienes <strong><?= $points . " puntos"?></strong>, haz click en el recuadro para usarlos como un descuento en tu compra
                </label>
            </div>
            <?php endif; ?>
            <!-- Use points -->
			<div class="table-responsive">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
						  <th>#</th>
						  <th>Producto</th>
						  <th>Presentación</th>
						  <th>IVA</th>
						  <th>Precio Unit</th>
						  <th>Cantidad</th>
						  <th>Total</th>
						  <th></th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="(key, product) in order.shoppingcart.products">
						  <th ng-bind="key + 1"></th>
						  <td ng-bind="product.name"></td>
						  <td ng-bind="product.presentation"></td>
						  <td ng-bind="product.tax | currency : '$' : 0"></td>
						  <td ng-bind="product.price | currency : '$' : 0"></td>
						  <td ng-init="order.shoppingcart.products[key].cant = product.cant" class="order-summary-input-container">
						  	<a id="decrease" ng-click="recalculateTotals( key , 'decrease' )"><i class="fa fa-minus fa-lg"></i></a>
						  	<input type="number" name="productQty" ng-model="order.shoppingcart.products[key].cant" ng-change="recalculateTotals( key )">
						  	<a id="increase" ng-click="recalculateTotals( key , 'increase' )"><i class="fa fa-plus fa-lg"></i></a>
						  </td>
						  <td ng-bind="(product.price * product.cant) | currency : '$' : 0"></td>
						  <td>
						  	<a ng-click="recalculateTotals( key , 'delete' )"><i class="fa fa-trash-o fa-lg"></i></a>
						  </td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="order-totals" class="panel panel-default">
				<div id="order-summary-content">
					<div id="total-products" class="order-summary-item">
						<div class="order-summary-item-content">
							<span class="title">Total Productos</span>
						</div>
						<div class="order-summary-item-content">
							<span class="pull-right value" ng-bind="order.shoppingcart.subtotal | currency : '$' : 0"></span>
						</div>
                        <div class="form-group ng-cloak" ng-if="(order.shoppingcart.minimumOrderValueInvalid) || !order.shoppingcart.shippingFree" ng-cloak>
                            <!-- tooltip -->
                            <div class="arrow-up-info">
                            </div>
                            <div class="farma-tooltip-info">
                                <span ng-if="order.shoppingcart.minimumOrderValueInvalid" ng-bind=" 'El mónto mínimo de tu compra debe ser de ' + (order.shoppingcart.minimumOrderValue | currency : '$' : 0) + ' pesos :(, solo te faltan ' + ((order.shoppingcart.minimumOrderValue - order.shoppingcart.subtotal) | currency : '$' : 0) + ' :D'"></span>
                                <span ng-if="(!order.shoppingcart.hasDiscount) && (!order.shoppingcart.shippingFree && !order.shoppingcart.minimumOrderValueInvalid)" ng-bind=" 'Si quieres que tu envío sea gratis tu compra debe ser de ' + (order.shoppingcart.limitForFreeShipping | currency : '$' : 0) + ' pesos :(, solo te faltan ' + ((order.shoppingcart.limitForFreeShipping - order.shoppingcart.subtotal) | currency : '$' : 0) + ' :D'"></span>
                                <span ng-if="order.shoppingcart.hasDiscount && (!order.shoppingcart.shippingFree && !order.shoppingcart.minimumOrderValueInvalid)" ng-bind=" 'Si quieres que tu envío sea gratis tu compra debe ser de ' + (order.shoppingcart.limitForFreeShipping | currency : '$' : 0) + ' pesos :(, solo te faltan ' + ((order.shoppingcart.limitForFreeShipping - (order.shoppingcart.subtotal + order.shoppingcart.pointsDoDiscount ) ) | currency : '$' : 0) + ' :D'"></span>
                            </div>
                            <!-- tooltip -->
                        </div>

                    </div>
					<div id="total-products" class="order-summary-item">
						<div class="order-summary-item-content">
							<span class="title">Costo de envío</span>
						</div>
						<div class="order-summary-item-content">
							<span class="pull-right value" ng-bind="order.shoppingcart.shippingCharge" ng-show="order.shoppingcart.shippingFree"></span>
							<span class="pull-right value" ng-bind="order.shoppingcart.shippingCharge | currency : '$' : 0" ng-show="!order.shoppingcart.shippingFree"></span>
						</div>
					</div>
					<div id="total-products" class="order-summary-item">
						<div class="order-summary-item-content">
							<span class="title">IVA</span>
						</div>
						<div class="order-summary-item-content">
							<span class="pull-right value" ng-bind="order.shoppingcart.tax | currency : '$' : 0"></span>
						</div>
					</div>
                    <div id="total-products" class="order-summary-item">
                        <div class="order-summary-item-content">
                            <span class="title">Puntos que ganarás</span>
                        </div>
                        <div class="order-summary-item-content">
                            <span class="pull-right value" ng-bind="order.shoppingcart.subtotal * 0.02"></span>
                        </div>
                    </div>
					<div id="total-products" class="order-summary-item">
						<div class="order-summary-item-content">
							<span class="title">Total</span>
						</div>
						<div class="order-summary-item-content">
							<span class="pull-right secondary-emphasis value" ng-bind="order.shoppingcart.total | currency : '$' : 0"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="well" ng-show="order.sended">
		<p class="bg-primary">
			Tu orden a sido realizada con éxito, en este momento uno de nuestro mensajeros va en camino con tu pedido en la dirrecíon {{order.shippingData.addressLine1}}. 
			Tu pedido estará allí en menor tiempo posible, gracias por tu compra!.
		</p>
        <p class="bg-primary">
            Acumulaste {{order.points}}
        </p>
		<h3>¿Que desear hacer ahora?</h3>
		<div class="list-group">
			<!-- Add if isset discount -->
			<a href="<?php base_url() . 'product/search_product/nuestros_productos'?>" class="list-group-item active">
				<h4 class="list-group-item-heading">Hacer otra compra, aprovecha nuestras ofertas!</h4>
				<p class="list-group-item-text">En esta sección encontraras todos nuestros prodructos con descuentos.</p>
			</a>
			<a href="/account/log_in" class="list-group-item">
				<h4 class="list-group-item-heading">Ir a mi cuenta</h4>
				<p class="list-group-item-text">Acá podras editar tus datos personales, ver tus mensájes.</p>
			</a>
		</div>		
		</div>
		<a href="/account/log_in" ng-show="order.sended" id="go-to-orders-button" class="btn btn-success btn-lg" role="button">Compra completada, ir a mi cuenta</a>
		<a ng-click="stepCompleted( order, 'orderSummary' )" ng-hide="order.sended" ng-disabled="( !(order.shippingData.status && order.paymentMethod.status) || sendingOrder ) || order.shoppingcart.minimumOrderValueInvalid" id="confirm-order-button" class="btn btn-warning btn-lg" role="button">Confirmar Orden <i ng-if="sendingOrder" class="fa fa-spinner fa-pulse"></i></a>
	</div>
</div>
