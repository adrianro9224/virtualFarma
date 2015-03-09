<div class="panel panel-default">
	<div class="panel-heading handy" ng-click="openSection('orderSummary')" ng-class="{ 'disabled-panel-heading' : !order.shippingData.status && !order.paymentMethod.status }">
		<h4>Resumen de la orden</h4>
	</div>
	<div class="panel-body" ng-if="orderSummary">
		<p>Por favor ingresa los datos de la persona a quien se la hará el envío.</p>
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
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="(key, product) in order.shoppingcart.products">
					  <th ng-bind="key + 1"></th>
					  <td ng-bind="product.name"></td>
					  <td ng-bind="product.presentation"></td>
					  <td ng-bind="product.tax | currency : '$' : 0"></td>
					  <td ng-bind="product.price | currency : '$' : 0"></td>
					  <td ng-bind="product.cant"></td>
					  <td ng-bind="(product.price * product.cant) | currency : '$' : 0"></td>
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
				</div>
				<div id="total-products" class="order-summary-item">
					<div class="order-summary-item-content">
						<span class="title">Costo de envío</span>
					</div>
					<div class="order-summary-item-content">
						<span class="pull-right value" ng-bind="order.shoppingcart.shippingCharge | currency : '$' : 0"></span>
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
						<span class="title">Total</span>
					</div>
					<div class="order-summary-item-content">
						<span class="pull-right secondary-emphasis value" ng-bind="order.shoppingcart.total | currency : '$' : 0"></span>
					</div>
				</div>
			</div>
		</div>
		<a ng-click="stepCompleted( order, 'orderSummary' )" ng-disabled="!order.shippingData.status && !order.paymentMethod.status" id="confirm-order-button" class="btn btn-warning btn-lg" role="button">Confirmar Orden</a>
	</div>
</div>
