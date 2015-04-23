<div class="panel panel-default" ng-show="results">
	<div class="panel-heading">
		<h3>Resultados</h3>
	</div>
	<div class="panel-body">
		<table class="table table-condensed ng-cloak table-striped" ng-cloak >
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Presentación</th>
					<th>Precio</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="(key, product) in results" >
					<td ng-bind="product.name"></td>
					<td ng-bind="product.presentation"></td>
					<td ng-bind="product.price | currency : '$' : 0"></td>
					<th>
						<a class="btn btn-primary btn-xs" ng-click="addToShoppingCart( product )" ng-disabled="">ver</a>
					</th>
				</tr>
			</tbody>
		</table>				
	</div>
</div>