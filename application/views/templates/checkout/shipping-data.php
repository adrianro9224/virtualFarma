<div class="panel panel-default">
	<div class="panel-heading handy" ng-click="openSection('shippingData')" ng-class="{'disabled-panel-heading' : !shippingData}">
		<h4>Datos de envío</h4>
	</div>
	<?= var_dump($shipping_data)?>
	<div class="panel-body" ng-init="useMyData = false">
		<p>Por favor ingresa los datos de la persona a quien se la hará el envío.</p>
		<div class="checkbox" ng-init="shippingDataCompleted=<?= ( isset($shipping_data) ) ? 1 : 0 ?>">
			<label>
		    	<input type="checkbox" ng-model="useMyData" ng-disabled="!shippingDataCompleted">
		    	Usar los datos de mi cuenta
		  	</label>
		  	<!-- helptext -->
			<span id="helpBlock" class="help-block">Si todos los datos de tu cuenta estàn completos, podrás usarlos para el envío</span>
			<!-- helptext -->
		</div>
		<form id="shipping-data-form" name="ShippingDataForm" ng-controller="ShippingDataFormCtrl" method="post" novalidate >
			<div class="col-md-6">
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataNames.$valid && ShippingDataForm.shippingDataNames.$dirty}">
					<label for="shippingDataNames">Nombres<span class="primary-emphasis">*</span></label>
					<div ng-if="useMyData">
						<input type="text" name="shippingDataNames" ng-model="order.shippingData.names" class="form-control"  id="shippingDataNames" placeholder="Ingresa tus nombres" ng-init="order.shippingData.names='<?= ( isset($shipping_data) ) ? $shipping_data->names : null ?>'" ng-maxLength="50" required>
					</div>
					<div ng-if="!useMyData">
						<input type="text" name="shippingDataNames" ng-model="order.shippingData.names" class="form-control"  id="shippingDataNames" placeholder="Ingresa tus nombres" ng-init="order.shippingData.names=false" ng-maxLength="50" required>
					</div>
					<!-- tooltip -->
					<div ng-if="ShippingDataForm.shippingDataNames.$invalid && ShippingDataForm.shippingDataNames.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="ShippingDataForm.shippingDataNames.$error.required && ShippingDataForm.shippingDataNames.$dirty">Tus nombres son obligatorios!</span>
							<span ng-if="ShippingDataForm.shippingDataNames.$error.maxlength">Son muy extensos!</span>
						</div>
					</div>
					<!-- tooltip -->
				</div>
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataLastNames.$valid && ShippingDataForm.shippingDataLastNames.$dirty}">
					<label for="shippingDataLastNames">Apellidos<span class="primary-emphasis">*</span></label>
					<input type="text" name="shippingDataLastNames" ng-model="order.shippingData.lastNames" class="form-control" id="shippingDataLastNames" placeholder="Ingresea tus apellidos" ng-maxLength="50" required>
					<!-- tooltip -->
					<div ng-if="ShippingDataForm.shippingDataLastNames.$invalid && ShippingDataForm.shippingDataLastNames.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="ShippingDataForm.shippingDataLastNames.$error.required && ShippingDataForm.shippingDataLastNames.$dirty">Tus apellidos son obligatorios!</span>
							<span ng-if="ShippingDataForm.shippingDataLastNames.$error.maxlength && ShippingDataForm.shippingDataLastNames.$dirty">Son muy extensos!</span>
						</div>
					</div>
					<!-- tooltip -->
				</div>
				
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataEmail.$valid && ShippingDataForm.shippingDataEmail.$dirty}">
					<label for="shippingDataEmail">Correo electrónico</label>
					<div class="input-group">
						<div class="input-group-addon">@</div>
						<input type="text" name="shippingDataEmail" ng-model="order.shippingData.email" class="form-control" id="shippingDataEmail" placeholder="Ingrese su email" ng-pattern="/[\w.]+?\@{1}[\w.]+(\.+[\w.]+)/" >
					</div>
					<!-- tooltip -->
					<div ng-if="ShippingDataForm.shippingDataEmail.$invalid && ShippingDataForm.shippingDataEmail.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="ShippingDataForm.shippingDataEmail.$error.maxlength && ShippingDataForm.shippingDataEmail.$dirty">Es muy extenso!</span>
							<span ng-if="ShippingDataForm.shippingDataEmail.$error.pattern && ShippingDataForm.shippingDataEmail.$dirty">Por favor ingresa un correo electrónico válido!</span>
						</div>
					</div>
					<!-- tooltip -->
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: example@example.com</span>
					<!-- helptext -->
				</div>
				
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataCompany.$valid && ShippingDataForm.shippingDataCompany.$dirty}">
					<label for="shippingDataCompany">Compañia</label>
					<input type="text" name="shippingDataCompany" ng-model="order.shippingData.company" class="form-control" id="shippingDataCompany" placeholder="Ingresa el nombre de tu compañia" ng-maxLength="50">
					<!-- tooltip -->
					<div ng-if="ShippingDataForm.shippingDataCompany.$invalid">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="ShippingDataForm.shippingDataCompany.$error.maxlength">El nombre de tu compañia es muy extenso!</span>
						</div>
					</div>
					<!-- tooltip -->
				</div>
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataId.$valid && ShippingDataForm.shippingDataId.$dirty}">
					<label for="shippingDataId">Número de identificación<span class="primary-emphasis">*</span></label>
					<input type="text" name="shippingDataId" ng-model="shippingDataId" class="form-control" id="shippingDataId" placeholder="Ingrese su numero de identificación" ng-pattern="/[\d-.]/" required>
					<!-- tooltip -->
					<div ng-if="ShippingDataForm.shippingDataId.$invalid && ShippingDataForm.shippingDataId.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="ShippingDataForm.shippingDataId.$error.required && ShippingDataForm.shippingDataId.$dirty">Es muy extenso!</span>
							<span ng-if="ShippingDataForm.shippingDataId.$error.maxlength && ShippingDataForm.shippingDataId.$dirty">Es muy extenso!</span>
							<span ng-if="ShippingDataForm.shippingDataId.$error.pattern && ShippingDataForm.shippingDataId.$dirty">Solo se permiten valores numéricos y los caractéres {-.}</span>
						</div>
					</div>
					<!-- tooltip -->
				</div>
			</div>	
			<div class="col-md-6">
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataAddressLine1.$valid && ShippingDataForm.shippingDataAddressLine1.$dirty}">
					<label for="shippingDataAddressLine1">Dirección<span class="primary-emphasis">*</span></label>
					<input type="text" name="shippingDataAddressLine1" ng-model="order.shippingData.addressLine1" class="form-control" id="shippingDataAddressLine1" placeholder="Ingresa tu dirección" ng-maxLength="50" required>
					<!-- tooltip -->
					<div ng-if="ShippingDataForm.shippingDataAddressLine1.$invalid && ShippingDataForm.shippingDataAddressLine1.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="ShippingDataForm.shippingDataAddressLine1.$error.required && ShippingDataForm.shippingDataAddressLine1.$dirty">Tu dirección es obligatoria!</span>
							<span ng-if="ShippingDataForm.shippingDataAddressLine1.$error.maxlength && ShippingDataForm.shippingDataAddressLine1.$dirty">Tu dirección es muy extensa!</span>
						</div>
					</div>
					<!-- tooltip -->
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: Carrera 73 # 96 - 75</span>
					<!-- helptext -->
				</div>		
				
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataNeighborhood.$valid && ShippingDataForm.shippingDataNeighborhood.$dirty}">
					<label for="shippingDataNeighborhood">Barrio<span class="primary-emphasis">*</span></label>
					<input type="text" name="shippingDataNeighborhood" ng-model="order.shippingData.neighborhood" class="form-control" id="shippingDataNeighborhood" placeholder="Ingresa tu dirección" ng-maxLength="50" required>
					<!-- tooltip -->
					<div ng-if="ShippingDataForm.shippingDataNeighborhood.$invalid && ShippingDataForm.shippingDataNeighborhood.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="ShippingDataForm.shippingDataNeighborhood.$error.required && ShippingDataForm.shippingDataNeighborhood.$dirty">El nombre de tu barrio es obligatorio!</span>
							<span ng-if="ShippingDataForm.shippingDataNeighborhood.$error.maxlength && ShippingDataForm.shippingDataNeighborhood.$dirty">El nombre de tu barrio es muy extenso!</span>
						</div>
					</div>
					<!-- tooltip -->
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: El Encanto</span>
					<!-- helptext -->
				</div>			
				
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataPhone.$valid && ShippingDataForm.shippingDataPhone.$dirty}">
					<label for="shippingDataPhone">Teléfono fijo<span class="primary-emphasis">*</span></label>
					<div class="input-group">
						<div class="input-group-addon">#</div>
						<input type="text" name="shippingDataPhone" ng-model="order.shippingData.Phone" class="form-control" id="shippingDataPhone" placeholder="Ingresa tu teléfono fijo" ng-maxLength="32" ng-minLength="7" ng-pattern="/[\d-]/" required>
					</div>
					<!-- tooltip -->
					<div ng-if="ShippingDataForm.shippingDataPhone.$invalid && ShippingDataForm.shippingDataPhone.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="ShippingDataForm.shippingDataPhone.$error.required && ShippingDataForm.shippingDataPhone.$dirty">Tu telefono fijo es obligatorio!</span>
							<span ng-if="ShippingDataForm.shippingDataPhone.$error.maxlength && !ShippingDataForm.shippingDataPhone.$error.pattern && ShippingDataForm.shippingDataPhone.$dirty">Es muy extenso!</span>
							<span ng-if="ShippingDataForm.shippingDataPhone.$error.minlength && !ShippingDataForm.shippingDataPhone.$error.pattern && ShippingDataForm.shippingDataPhone.$dirty">Es muy corto, debe contener mínimo 7 dígitos</span>
							<span ng-if="ShippingDataForm.shippingDataPhone.$error.pattern">Solo se permiten valores numéricos y el caractér "-"</span>
						</div>
					</div>
					<!-- tooltip -->
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: (571) 6742838</span>
					<!-- helptext -->
				</div>
				
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.ShippingDataMobile.$valid && ShippingDataForm.ShippingDataMobile.$dirty}">
					<label for="ShippingDataMobile">Teléfono celular<span class="primary-emphasis">*</span></label>
					<div class="input-group">
						<div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
						<input type="text" name="ShippingDataMobile" ng-model="order.shippingData.mobile" class="form-control" id="ShippingDataMobile" placeholder="Ingrese su teléfono celular" ng-maxLength="32" ng-minLength="10" ng-pattern="/[\d-]/" required>
					</div>
					<!-- tooltip -->
					<div ng-if="ShippingDataForm.ShippingDataMobile.$invalid && ShippingDataForm.ShippingDataMobile.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="ShippingDataForm.ShippingDataMobile.$error.required && ShippingDataForm.ShippingDataMobile.$dirty">Tu telefono fijo es obligatorio!</span>
							<span ng-if="ShippingDataForm.ShippingDataMobile.$error.maxlength && !ShippingDataForm.ShippingDataMobile.$error.pattern && ShippingDataForm.ShippingDataMobile.$dirty">Es muy extenso!</span>
							<span ng-if="ShippingDataForm.ShippingDataMobile.$error.minlength && !ShippingDataForm.ShippingDataMobile.$error.pattern && ShippingDataForm.ShippingDataMobile.$dirty">Es muy corto, debe contener mínimo 10 dígitos</span>
							<span ng-if="ShippingDataForm.ShippingDataMobile.$error.pattern && ShippingDataForm.ShippingDataMobile.$dirty">Solo se permiten valores numéricos y el caractér "-"</span>
						</div>
					</div>	
					<!-- tooltip -->
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: 3124718075</span>
					<!-- helptext -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<a class="btn btn-primary center-horizontaly pull-right" ng-click="stepCompleted(order, 'shippingData')" ng-disabled="ShippingDataForm.$invalid">Continuar</a>
				</div>
			</div>
		</form>
	</div>
</div>
