<section id="checkout-panel-nav">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
		<div class="btn-group" role="group">
    		<button type="button" class="btn btn-default" ng-click="openSection('shippingData')" ng-class="{active: shippingData}" ng-disabled="!order.shippingData.status || order.sended">
    			<i class="fa fa-truck"></i>
    			Paso 1: Datos de envío
    		</button>
  		</div>
	  	<div class="btn-group" role="group">
	    	<button type="button" class="btn btn-default" ng-click="openSection('paymentMethod')" ng-class="{active: paymentMethod}" ng-disabled="!order.paymentMethod.status || order.sended">
	    		<i class="fa fa-money"></i>
                Paso 2: Forma de pago
	    	</button>
	  	</div>
  		<div class="btn-group" role="group">
		    <button type="button" class="btn btn-default" ng-click="openSection('orderSummary')" ng-class="{active: orderSummary}" ng-disabled="(!order.shippingData.status || !order.paymentMethod.status)">
				<i class="fa fa-shopping-cart"></i>
                Paso 3: Resumen de la orden
		    </button>
	  	</div>
	</div>										
</section>
