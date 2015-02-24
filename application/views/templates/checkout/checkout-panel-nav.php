<section id="checkout-panel-nav">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
		<div class="btn-group" role="group">
    		<button type="button" class="btn btn-default" ng-click="openSection('shippingData')" ng-class="{active: shippingData}" ng-disabled="!shippingDataComplete">
    			<span class="glyphicon glyphicon-map-marker"></span>
    			Datos de envío
    		</button>
  		</div>
	  	<div class="btn-group" role="group">
	    	<button type="button" class="btn btn-default" ng-click="openSection('paymentMethod')" ng-class="{active: paymentMethod}" ng-disabled="!paymentMethodComplete">
	    		<span class="glyphicon glyphicon-usd"></span>
	    		Forma de pago
	    	</button>
	  	</div>
  		<div class="btn-group" role="group">
		    <button type="button" class="btn btn-default" ng-click="openSection('orderSummary')" ng-class="{active: orderSummary}" ng-disabled="!orderSummaryEnable">
				<span class="glyphicon glyphicon-shopping-cart"></span>
			    Resumen de la orden
		    </button>
	  	</div>
	</div>										
</section>