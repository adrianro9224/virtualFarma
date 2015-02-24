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
				<span class="pull-right value secondary-emphasis" ng-class="{'text-danger' : limitOrderValueInvalid}">{{total | currency}}</span>
			</div>
			<div class="form-group" ng-if="limitOrderValueInvalid">
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
</div>
