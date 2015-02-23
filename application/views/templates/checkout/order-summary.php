<div class="panel panel-default">
	<div class="panel-heading handy" ng-click="openSection('orderSummary')" ng-class="{'disabled-panel-heading' : !orderSummary}">
		<h4>Resumen de la orden</h4>
	</div>
	<div class="panel-body" ng-if="orderSummary">
		<p>Por favor ingresa los datos de la persona a quien se la hará el envío.</p>
	</div>
</div>
