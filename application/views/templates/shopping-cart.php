<a id="button-payment" class="btn btn-default" ng-click="createShoppingcartToken(shoppingcart)" role="button">Pagar</a>
<div class="panel panel-default" >
	<div id="shopping-cart-panel-content">
		<div id="total-products" class="shopping-cart-item">
			<div class="shopping-cart-item-content">
				<span class="title">Subtotal</span>
			</div>
			<div class="shopping-cart-item-content">
				<span class="pull-right value" >{{subtotal | currency : "$ " : 0}}</span>
			</div>
		</div>
		<div id="total-products" class="shopping-cart-item">
			<div class="shopping-cart-item-content">
				<span class="title" ng-bind="shippingCharge"></span>
			</div>
			<div class="shopping-cart-item-content">
				<span class="pull-right value">{{shippingCharge}}</span>
			</div>
		</div>
		<div id="total-products" class="shopping-cart-item">
			<div class="shopping-cart-item-content">
				<span class="title">IVA</span>
			</div>
			<div class="shopping-cart-item-content">
				<span class="pull-right value">{{tax | currency}}</span>
			</div>
		</div>
		<div id="total-products" class="shopping-cart-item">
			<div class="shopping-cart-item-content">
				<span class="title">Total</span>
			</div>
			<div class="shopping-cart-item-content">
				<span class="pull-right value secondary-emphasis">{{total | currency}}</span>
			</div>
		</div>
	</div>
</div>
