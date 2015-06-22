<div class="panel panel-default" >
	<div id="shopping-cart-panel-content" >
		<div id="total-products" class="shopping-cart-item">
			<div class="shopping-cart-item-content">
				<span class="title">Subtotal</span>
			</div>
			<div class="shopping-cart-item-content">
				<span class="pull-right value" ng-bind="subtotal | currency : '$' : 0"></span>
			</div>
            <div class="form-group ng-cloak" ng-if="(sale.shoppingcart.minimumOrderValueInvalid) || !sale.shoppingcart.shippingFree" ng-cloak>
                <!-- tooltip -->
                <div class="arrow-up-info">
                </div>
                <div class="farma-tooltip-info">
                    <span ng-if="sale.shoppingcart.minimumOrderValueInvalid" ng-bind=" 'El mónto mínimo de tu compra debe ser de ' + (sale.shoppingcart.minimumOrderValue | currency : '$' : 0) + ' pesos :(, solo te faltan ' + ((sale.shoppingcart.minimumOrderValue - sale.shoppingcart.subtotal) | currency : '$' : 0) + ' :D'"></span>
                    <span ng-if="(!sale.shoppingcart.hasDiscount) && (!sale.shoppingcart.shippingFree && !sale.shoppingcart.minimumOrderValueInvalid)" ng-bind=" 'Si quieres que tu envío sea gratis tu compra debe ser de ' + (sale.shoppingcart.limitForFreeShipping | currency : '$' : 0) + ' pesos :(, solo te faltan ' + ((sale.shoppingcart.limitForFreeShipping - sale.shoppingcart.subtotal) | currency : '$' : 0) + ' :D'"></span>
                    <span ng-if="sale.shoppingcart.hasDiscount && (!sale.shoppingcart.shippingFree && !sale.shoppingcart.minimumOrderValueInvalid)" ng-bind=" 'Si quieres que tu envío sea gratis tu compra debe ser de ' + (sale.shoppingcart.limitForFreeShipping | currency : '$' : 0) + ' pesos :(, solo te faltan ' + ((sale.shoppingcart.limitForFreeShipping - (sale.shoppingcart.subtotal + sale.shoppingcart.pointsDoDiscount ) ) | currency : '$' : 0) + ' :D'"></span>
                </div>
                <!-- tooltip -->
            </div>
        </div>
		<div id="total-products" class="shopping-cart-item">
			<div class="shopping-cart-item-content">
				<span class="title" >Costo de envío</span>
			</div>
			<div class="shopping-cart-item-content">
				<span class="pull-right value" ng-bind="shippingCharge" ng-show="sale.shoppingcart.shippingFree"></span>
				<span class="pull-right value" ng-bind="shippingCharge | currency : '$' : 0" ng-show="!sale.shoppingcart.shippingFree"></span>
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
                <span class="title">Puntos que ganarás</span>
            </div>
            <div class="shopping-cart-item-content">
                <span class="pull-right value" ng-bind="sale.shoppingcart.subtotal * sale.shoppingcart.pointsBase"></span>
            </div>
        </div>
		<div id="total-products" class="shopping-cart-item">
			<div class="shopping-cart-item-content">
				<span class="title">Total</span>
			</div>
			<div class="shopping-cart-item-content">
				<span class="pull-right value secondary-emphasis" ng-class="{'text-danger' : limitOrderValueInvalid}" ng-bind="total | currency : '$' : 0"></span>
			</div>
			<div class="form-group" ng-if="shoppingcart.limitOrderValueInvalid">
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
				<tr ng-repeat="(key, product) in sale.shoppingcart.products">
					<td ng-bind="product.name"></td>
					<td><span class="pull-right" ng-bind="product.cant"></span></td>
					<td><button ng-click="removeProduct( key )" type="button" class="close pull-right" aria-label="Close"><span aria-hidden="true">&times;</span></button></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

