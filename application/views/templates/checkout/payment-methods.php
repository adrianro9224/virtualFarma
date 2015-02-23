<div class="panel panel-default">
	<div class="panel-heading handy" ng-click="openSection('paymentMethod')" ng-class="{'disabled-panel-heading' : !paymentMethod}">
		<h4>Método de pago</h4>
	</div>
	<div class="panel-body" ng-if="paymentMethod">
		<p>Por favor ingresa los datos de la persona a quien se la hará el envío.</p>
	</div>
</div>
