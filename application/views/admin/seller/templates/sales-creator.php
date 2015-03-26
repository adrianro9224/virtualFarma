<div class="well well-lg" >
	<div class="form-group">
		<label class="sr-only" for="searchProductInput">Search</label>
		<div class="input-group">
			<div class="input-group-addon"></div>
			<input type="text" class="form-control" ng-model="search" id="searchProductInput" placeholder="Producto a buscar">
			<div class="input-group-addon"></div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Resultados</h3>
		</div>
		<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Presentación</th>
					<th>Precio</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="product in products | filter:search">
					<td class="name" ng-bind="product.name"></td>
					<td ng-bind="product.presentation"></td>
					<td ng-bind="product.price"></td>
				</tr>
			</tbody>
		</table>					
		</div>
	</div>
</div>