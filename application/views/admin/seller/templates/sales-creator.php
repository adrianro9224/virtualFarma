<div class="well well-lg" >
	<div class="form-group">
		<label class="sr-only" for="searchProductInput">Search</label>
		<div class="input-group">
			<div class="input-group-addon"></div>
			<input type="text" class="form-control" ng-change="search( searchText )" ng-model="searchText" id="searchProductInput" placeholder="Producto a buscar">
			<div class="input-group-addon"></div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Resultados</h3>
		</div>
		<div class="panel-body">
			<a ng-repeat="product in results">
				<span class="name" ng-bind="product.name"></span>
				<span ng-bind="product.presentation"></span>
				<span ng-bind="product.price"></span>
			</a>
		</div>
	</div>
</div>