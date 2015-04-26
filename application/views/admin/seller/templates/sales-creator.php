<!-- Nav start -->
<section id="sales-panel-nav">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
	  	<div class="btn-group" role="group">
	    	<button type="button" class="btn btn-default" ng-click="openSection('productsToSale')" ng-class="{active: productsToSale}" ng-disabled="!sale.productsToSale.status || sale.sended">
	    		<span class="glyphicon glyphicon-usd"></span>
	    		Productos
	    	</button>
	  	</div>
		<div class="btn-group" role="group">
    		<button type="button" class="btn btn-default" ng-click="openSection('shippingData')" ng-class="{active: shippingData}" ng-disabled="!sale.shippingData.status || sale.sended">
    			<span class="glyphicon glyphicon-map-marker"></span>
    			Datos de envío
    		</button>
  		</div>
  		<div class="btn-group" role="group">
		    <button type="button" class="btn btn-default" ng-click="openSection('orderSummary')" ng-class="{active: orderSummary}" ng-disabled="(!sale.shippingData.status || !sale.productsToSale.status)">
				<span class="glyphicon glyphicon-shopping-cart"></span>
			    Resumen de la orden
		    </button>
	  	</div>
	</div>										
</section>
<!-- Nav over -->
<div class="well well-lg col-md-12" >
	<div ng-show="shippingData || (sale.currentStep == 'shippingData') " ng-hide="!shippingData">
		<span>Completa toda la información requerida para el envío:</span>
		<form id="sales-form" name="SalesForm" ng-controller="SalesFormCtrl" method="post" novalidate >
			<!-- shipping-data start -->
			<div class="col-md-6">
				<div class="form-group" ng-class="{'has-error': !SalesForm.shippingDataNames.$valid && SalesForm.shippingDataNames.$dirty}">
					<label for="shippingDataNames">Nombres<span class="primary-emphasis">*</span></label>
					<input type="text" name="shippingDataNames" ng-model="sale.shippingData.names" ng-change="putSaveAndSound( sale, SalesForm.shippingDataNames.$valid )" class="form-control"  id="shippingDataNames" placeholder="Ingresa tus nombres" ng-maxLength="50" required>
					<!-- tooltip -->
					<div ng-if="SalesForm.shippingDataNames.$invalid && SalesForm.shippingDataNames.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="SalesForm.shippingDataNames.$error.required && SalesForm.shippingDataNames.$dirty">Los nombres son obligatorios!</span>
							<span ng-if="SalesForm.shippingDataNames.$error.maxlength">Son muy extensos!</span>
						</div>
					</div>
					<!-- tooltip -->
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: Pedro Pablo</span>
					<!-- helptext -->
				</div>
				<div class="form-group" ng-class="{'has-error': !SalesForm.shippingDataLastNames.$valid && SalesForm.shippingDataLastNames.$dirty}">
					<label for="shippingDataLastNames">Apellidos<span class="primary-emphasis">*</span></label>
					<input type="text" name="shippingDataLastNames" ng-model="sale.shippingData.lastNames" ng-change="putSaveAndSound( sale, SalesForm.shippingDataLastNames.$valid )" class="form-control" id="shippingDataLastNames" placeholder="Ingresea tus apellidos" ng-maxLength="50" required>
					<!-- tooltip -->
					<div ng-if="SalesForm.shippingDataLastNames.$invalid && SalesForm.shippingDataLastNames.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="SalesForm.shippingDataLastNames.$error.required && SalesForm.shippingDataLastNames.$dirty">Los apellidos son obligatorios!</span>
							<span ng-if="SalesForm.shippingDataLastNames.$error.maxlength && SalesForm.shippingDataLastNames.$dirty">Son muy extensos!</span>
						</div>
					</div>
					<!-- tooltip -->
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: Perez Rodriguez</span>
					<!-- helptext -->
				</div>
					
				<div class="form-group" ng-class="{'has-error': !SalesForm.shippingDataCompany.$valid && SalesForm.shippingDataCompany.$dirty}">
					<label for="shippingDataCompany">Compañia</label>
					<input type="text" name="shippingDataCompany" ng-model="sale.shippingData.company" ng-change="putSaveAndSound( sale, SalesForm.shippingDataCompany.$valid )" class="form-control" id="shippingDataCompany" placeholder="Ingresa el nombre de tu compañia" ng-maxLength="50">
					<!-- tooltip -->
					<div ng-if="SalesForm.shippingDataCompany.$invalid">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="SalesForm.shippingDataCompany.$error.maxlength">El nombre de tu compañia es muy extenso!</span>
						</div>
					</div>
					<!-- tooltip -->
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: Example S.A.S</span>
					<!-- helptext -->
				</div>
				<div class="form-group" ng-class="{'has-error': !SalesForm.shippingDataId.$valid && SalesForm.shippingDataId.$dirty}">
					<label for="shippingDataId">Número de identificación<span class="primary-emphasis">*</span></label>
					<input type="text" name="shippingDataId" ng-model="sale.shippingData.id" ng-change="putSaveAndSound( sale, SalesForm.shippingDataId.$valid )" class="form-control" id="shippingDataId" placeholder="Ingrese su numero de identificación" ng-pattern="/[\d-.]/" required>
					<!-- tooltip -->
					<div ng-if="SalesForm.shippingDataId.$invalid && SalesForm.shippingDataId.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="SalesForm.shippingDataId.$error.required && SalesForm.shippingDataId.$dirty">El número de indentificaión es necesario!</span>
							<span ng-if="SalesForm.shippingDataId.$error.maxlength && SalesForm.shippingDataId.$dirty">Es muy extenso!</span>
							<span ng-if="SalesForm.shippingDataId.$error.pattern && SalesForm.shippingDataId.$dirty">Solo se permiten valores numéricos y los caractéres {-.}</span>
						</div>
					</div>
					<!-- tooltip -->
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: Puedes usar valores numéricos y los caractéres - .</span>
					<!-- helptext -->
				</div>
			</div>	
			<div class="col-md-6">
				<div class="form-group" ng-class="{'has-error': !SalesForm.shippingDataAddressLine1.$valid && SalesForm.shippingDataAddressLine1.$dirty}">
					<label for="shippingDataAddressLine1">Dirección<span class="primary-emphasis">*</span></label>
					<input type="text" name="shippingDataAddressLine1" ng-model="sale.shippingData.addressLine1" ng-change="putSaveAndSound( sale, SalesForm.shippingDataAddressLine1.$valid )" class="form-control" id="shippingDataAddressLine1" placeholder="Ingresa tu dirección" ng-maxLength="50" required>
					<!-- tooltip -->
					<div ng-if="SalesForm.shippingDataAddressLine1.$invalid && SalesForm.shippingDataAddressLine1.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="SalesForm.shippingDataAddressLine1.$error.required && SalesForm.shippingDataAddressLine1.$dirty">Tu dirección es obligatoria!</span>
							<span ng-if="SalesForm.shippingDataAddressLine1.$error.maxlength && SalesForm.shippingDataAddressLine1.$dirty">Tu dirección es muy extensa!</span>
						</div>
					</div>
					<!-- tooltip -->
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: Carrera 73 # 96 - 75 apto 206</span>
					<!-- helptext -->
				</div>		
			
				<div class="form-group" ng-class="{'has-error': !SalesForm.shippingDataNeighborhood.$valid && SalesForm.shippingDataNeighborhood.$dirty}">
					<label for="shippingDataNeighborhood">Barrio<span class="primary-emphasis">*</span></label>
					<input type="text" name="shippingDataNeighborhood" ng-model="sale.shippingData.neighborhood" ng-change="putSaveAndSound( sale, SalesForm.shippingDataNeighborhood.$valid )" class="form-control" id="shippingDataNeighborhood" placeholder="Ingresa tu dirección" ng-maxLength="50" required>
					<!-- tooltip -->
					<div ng-if="SalesForm.shippingDataNeighborhood.$invalid && SalesForm.shippingDataNeighborhood.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="SalesForm.shippingDataNeighborhood.$error.required && SalesForm.shippingDataNeighborhood.$dirty">El nombre de tu barrio es obligatorio!</span>
							<span ng-if="SalesForm.shippingDataNeighborhood.$error.maxlength && SalesForm.shippingDataNeighborhood.$dirty">El nombre de tu barrio es muy extenso!</span>
						</div>
					</div>
					<!-- tooltip -->
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: El Encanto</span>
					<!-- helptext -->
				</div>			
					
				<div class="form-group" ng-class="{'has-error': !SalesForm.shippingDataPhone.$valid && SalesForm.shippingDataPhone.$dirty}" ng-cloak class="ng-cloak">
					<label for="shippingDataPhone">Teléfono fijo<span class="primary-emphasis">*</span></label>
					<div class="input-group">
						<div class="input-group-addon">#</div>
						<input type="text" name="shippingDataPhone" ng-model="sale.shippingData.phone" ng-change="putSaveAndSound( sale, SalesForm.shippingDataPhone.$valid )" class="form-control" id="shippingDataPhone" placeholder="Ingresa tu teléfono fijo" ng-maxLength="32" ng-minLength="7" ng-pattern="/[\d-]/" required>
					</div>
					<!-- tooltip -->
					<div ng-if="SalesForm.shippingDataPhone.$invalid && SalesForm.shippingDataPhone.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="SalesForm.shippingDataPhone.$error.required && SalesForm.shippingDataPhone.$dirty">Tu telefono fijo es obligatorio!</span>
							<span ng-if="SalesForm.shippingDataPhone.$error.maxlength && !SalesForm.shippingDataPhone.$error.pattern && SalesForm.shippingDataPhone.$dirty">Es muy extenso!</span>
							<span ng-if="SalesForm.shippingDataPhone.$error.minlength && !SalesForm.shippingDataPhone.$error.pattern && SalesForm.shippingDataPhone.$dirty">Es muy corto, debe contener mínimo 7 dígitos</span>
							<span ng-if="SalesForm.shippingDataPhone.$error.pattern">Solo se permiten valores numéricos y el caractér "-"</span>
						</div>
					</div>
					<!-- tooltip -->
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: (571) 6742838 ó puedes también poner tu número de celular</span>
					<!-- helptext -->
				</div>
					
				<div class="form-group" ng-class="{'has-error': !SalesForm.ShippingDataMobile.$valid && SalesForm.ShippingDataMobile.$dirty}">
					<label for="ShippingDataMobile">Teléfono celular<span class="primary-emphasis">*</span></label>
					<div class="input-group">
						<div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
						<input type="text" name="ShippingDataMobile" ng-model="sale.shippingData.mobile" ng-change="putSaveAndSound( sale, SalesForm.ShippingDataMobile.$valid )" class="form-control" id="ShippingDataMobile" placeholder="Ingrese su teléfono celular" ng-maxLength="32" ng-minLength="10" ng-pattern="/[\d-]/" required>
					</div>
					<!-- tooltip -->
					<div ng-if="SalesForm.ShippingDataMobile.$invalid && SalesForm.ShippingDataMobile.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="SalesForm.ShippingDataMobile.$error.required && SalesForm.ShippingDataMobile.$dirty">Tu telefono fijo es obligatorio!</span>
							<span ng-if="SalesForm.ShippingDataMobile.$error.maxlength && !SalesForm.ShippingDataMobile.$error.pattern && SalesForm.ShippingDataMobile.$dirty">Es muy extenso!</span>
							<span ng-if="SalesForm.ShippingDataMobile.$error.minlength && !SalesForm.ShippingDataMobile.$error.pattern && SalesForm.ShippingDataMobile.$dirty">Es muy corto, debe contener mínimo 10 dígitos</span>
							<span ng-if="SalesForm.ShippingDataMobile.$error.pattern && SalesForm.ShippingDataMobile.$dirty">Solo se permiten valores numéricos y el caractér "-"</span>
						</div>
					</div>	
					<!-- tooltip -->
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: 3124718075</span>
					<!-- helptext -->
				</div>
			</div>
			<div class="col-md-12 margin-bottom-5" >
				<label for="ShippingDataNotes" >Notas</label>
				<textarea name="ShippingDataNotes" class="form-control" ng-model="sale.shippingData.notes" ng-change="putSaveAndSound( sale, sale.shippingData.notes, 1 )" rows="3"></textarea>
				<!-- helptext -->
					<span id="helpBlock" class="help-block">Acá nos puedes indicar si quieres que te entreguemos tu pedido a una hora específica.</span>
				<!-- helptext -->
			</div>
			<div class="col-md-12" ng-mouseover="showSubmitButtonTooltip()" ng-mouseleave="hideSubmitButtonTooltip()" >
				<a class="btn btn-primary center-horizontaly pull-right" ng-click="stepCompleted( sale, 'shippingData' )" ng-disabled="SalesForm.$invalid">Siguiente</a>
			</div>
			<div class="col-md-12" id="info-tooltip-arrow-left">
				<div class="form-group" ng-if="SalesForm.$invalid && mouseover" >
					<!-- tooltip -->
					<div class="arrow-up-info"> 
		    		</div>
		    		<div class="farma-tooltip-info">
		    			<span ng-show="SalesForm.$invalid">Debes completar sin errores todos los campos obligatorios del formulario.</span>
		    			<span ng-show="!SalesForm.$dirty">No haz realizado ningún cambio.</span>
		    		</div>
			    	<!-- tooltip -->
	    		</div>
	    	</div>
		</form>
	</div>
	
	<section ng-show="productsToSale || (sale.currentStep == 'productsToSale')" ng-hide="!productsToSale">
		<div class="col-md-12">
			<div class="table-responsive" ng-show="sale.shoppingcart.haveProducts">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
						  <th>#</th>
						  <th>Producto</th>
						  <th>Presentación</th>
						  <th>IVA</th>
						  <th>Precio Unit</th>
						  <th>Cantidad</th>
						  <th>Total</th>
						  <th></th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="(key, product) in sale.shoppingcart.products">
						  <th ng-bind="key + 1"></th>
						  <td ng-bind="product.name"></td>
						  <td ng-bind="product.presentation"></td>
						  <td ng-bind="product.tax | currency : '$' : 0"></td>
						  <td ng-bind="product.price | currency : '$' : 0"></td>
						  <td ng-init="sale.shoppingcart.products[key].cant = product.cant" class="order-summary-input-container">
						  	<a id="decrease" ng-click="recalculateTotals( key , 'decrease' )"><i class="fa fa-minus fa-lg"></i></a>
						  	<input type="number" name="productQty" ng-model="sale.shoppingcart.products[key].cant" ng-change="recalculateTotals( key )">
						  	<a id="increase" ng-click="recalculateTotals( key , 'increase' )"><i class="fa fa-plus fa-lg"></i></a>
						  </td>
						  <td ng-bind="(product.price * product.cant) | currency : '$' : 0"></td>
						  <td>
						  	<a ng-click="recalculateTotals( key , 'delete' )"><i class="fa fa-trash-o fa-lg"></i></a>
						  </td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="form-group">
				<label class="sr-only" for="searchProductInput">Search</label>
				<div class="input-group">
					<div class="input-group-addon"></div>
					<input type="text" class="form-control" popover-placement="left" popover="Escríbe aquí el nombre del producto sin errores!"  popover-trigger="focus" ng-change="search( searchText )" ng-model="searchText" id="searchProductInput" placeholder="Producto a buscar" ng-disabled="!productsCharged">
					<div class="input-group-addon"></div>
				</div>
			</div>
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
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="(key, product) in results" >
								<td ng-bind="product.name"></td>
								<td ng-bind="product.presentation"></td>
								<td ng-bind="product.price | currency : '$' : 0"></td>
								<th>
									<input type="number" class="form-control" name="cant" ng-model="product.cant" ng-init="product.cant = 1">
								</th>
								<th>
									<a class="btn btn-primary btn-xs" ng-click="addToShoppingCart( product )" ng-disabled="">Añadir</a>
								</th>
							</tr>
						</tbody>
					</table>				
				</div>
			</div>
			<button class="btn btn-default pull-right" ng-click="stepCompleted( sale, 'productsToSale' )" ng-disabled="!sale.shoppingcart.haveProducts">Siquiente</button>
		</div>
	</section>
	
	<section ng-show="orderSummary || (sale.currentStep == 'orderSummary')" >
		<div class="panel panel-default">
			<div class="panel-body" >
				<div id="order-summary-container" ng-hide="sale.sended">
					<p>Acá esta toda la información relacionada con la compra:</p>
					<div class="table-responsive">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
								  <th>#</th>
								  <th>Producto</th>
								  <th>Presentación</th>
								  <th>IVA</th>
								  <th>Precio Unit</th>
								  <th>Cantidad</th>
								  <th>Total</th>
								  <th></th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="(key, product) in sale.shoppingcart.products">
								  <th ng-bind="key + 1"></th>
								  <td ng-bind="product.name"></td>
								  <td ng-bind="product.presentation"></td>
								  <td ng-bind="product.tax | currency : '$' : 0"></td>
								  <td ng-bind="product.price | currency : '$' : 0"></td>
								  <td ng-init="sale.shoppingcart.products[key].cant = product.cant" class="order-summary-input-container">
								  	<a id="decrease" ng-click="recalculateTotals( key , 'decrease' )"><i class="fa fa-minus fa-lg"></i></a>
								  	<input type="number" name="productQty" ng-model="sale.shoppingcart.products[key].cant" ng-change="recalculateTotals( key )">
								  	<a id="increase" ng-click="recalculateTotals( key , 'increase' )"><i class="fa fa-plus fa-lg"></i></a>
								  </td>
								  <td ng-bind="(product.price * product.cant) | currency : '$' : 0"></td>
								  <td>
								  	<a ng-click="recalculateTotals( key , 'delete' )"><i class="fa fa-trash-o fa-lg"></i></a>
								  </td>
								</tr>
							</tbody>
						</table>
					</div>
					<div id="order-totals" class="panel panel-default">
						<div id="order-summary-content">
							<div id="total-products" class="order-summary-item">
								<div class="order-summary-item-content">
									<span class="title">Total Productos</span>
								</div>
								<div class="order-summary-item-content">
									<span class="pull-right value" ng-bind="sale.shoppingcart.subtotal | currency : '$' : 0"></span>
								</div>
							</div>
							<div id="total-products" class="order-summary-item">
								<div class="order-summary-item-content">
									<span class="title">Costo de envío</span>
								</div>
								<div class="order-summary-item-content">
									<span class="pull-right value" ng-bind="sale.shoppingcart.shippingCharge" ng-show="sale.shoppingcart.shippingFree"></span>
									<span class="pull-right value" ng-bind="sale.shoppingcart.shippingCharge | currency : '$' : 0" ng-show="!sale.shoppingcart.shippingFree"></span>
								</div>
							</div>
							<div id="total-products" class="order-summary-item">
								<div class="order-summary-item-content">
									<span class="title">IVA</span>
								</div>
								<div class="order-summary-item-content">
									<span class="pull-right value" ng-bind="sale.shoppingcart.tax | currency : '$' : 0"></span>
								</div>
							</div>
							<div id="total-products" class="order-summary-item">
								<div class="order-summary-item-content">
									<span class="title">Total</span>
								</div>
								<div class="order-summary-item-content">
									<span class="pull-right secondary-emphasis value" ng-bind="sale.shoppingcart.total | currency : '$' : 0"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="well" ng-show="sale.sended">
				<p>
					Tu orden a sido realizada con éxito, en este momento uno de nuestro mensajeros va en camino con tu pedido en la dirección {{sale.shippingData.addressLine1}}. 
					Tu pedido estará allí en menos de 20 minutos, gracias por tu compra!.
				</p>
				<h3>¿Que desear hacer ahora?</h3>
				<div class="list-group">
					<!-- Add if isset discount -->
					<a href="/account/log_in" class="list-group-item">
						<h4 class="list-group-item-heading">Nueva compra</h4>
						<p class="list-group-item-text">Acá podras iniciar un anueva compra</p>
					</a>
				</div>		
				</div>
				<a href="#" ng-show="sale.sended" id="go-to-orders-button" class="btn btn-success btn-lg" role="button">Compra completada, iniciar una nueva</a>
				<a ng-click="stepCompleted( sale, 'orderSummary' )" ng-hide="sale.sended" ng-disabled="!(sale.shippingData.status) || sendingOrder" id="confirm-order-button" class="btn btn-warning btn-lg" role="button">Confirmar Orden</a>
			</div>
		</div>
	</section>
		
</div>
	
