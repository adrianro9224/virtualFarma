<div class="panel panel-default">
	<div class="panel-heading">Datos de envío</div>
	<div class="panel-body">
		<form id="shipping-data-form" name="ShippingDataForm" ng-controller="ShippingDataFormCtrl" action="" method="post" novalidate >
			<div class="col-md-6">
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataNames.$valid}">
					<label for="shippingDataNames">Nombres<span class="primary-emphasis">*</span></label>
					<input type="text" name="shippingDataNames" ng-model="shippingDataNames" class="form-control" id="shippingDataNames" placeholder="Ingresa tus nombres" ng-init="shippingDataNames='<?= (isset($user_logged_account->first_name) ? $user_logged_account->first_name : null)?>'" ng-maxLength="50" required>
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
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataLastNames.$valid}">
					<label for="shippingDataLastNames">Apellidos</label>
					<input type="text" name="shippingDataLastNames" ng-model="shippingDataLastNames" class="form-control" id="shippingDataLastNames" placeholder="Ingresea tus apellidos" ng-init="shippingDataLastNames='<?= (isset($user_logged_account->second_name) ? $user_logged_account->second_name : null)?>'" ng-maxLength="50" required>
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
				
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataEmail.$valid}">
					<label for="shippingDataEmail">Correo electrónico</label>
					<div class="input-group">
						<div class="input-group-addon">@</div>
						<input type="text" name="shippingDataEmail" ng-model="shippingDataEmail" class="form-control" id="shippingDataEmail" placeholder="Ingrese su email" ng-init="shippingDataEmail='<?= (isset($user_logged_account->email) ? $user_logged_account->email : null)?>'" ng-pattern="/[\w.]+?\@{1}[\w.]+(\.+[\w.]+)/" >
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
				</div>
				
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataCompany.$valid}">
					<label for="shippingDataCompany">Compañia</label>
					<input type="text" name="shippingDataCompany" ng-model="shippingDataCompany" class="form-control" id="shippingDataCompany" placeholder="Ingresa el nombre de tu compañia" ng-init="shippingDataCompany='<?= (isset($user_logged_account->first_name) ? $user_logged_account->first_name : null)?>'" ng-maxLength="50">
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
			</div>	
			<div class="col-md-6">
			
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataAddressLine1.$valid}">
					<label for="shippingDataAddressLine1">Dirección<span class="primary-emphasis">*</span></label>
					<input type="text" name="shippingDataAddressLine1" ng-model="shippingDataAddressLine1" class="form-control" id="shippingDataAddressLine1" placeholder="Ingresa tu dirección" ng-init="shippingDataAddressLine1='<?= (isset($user_logged_account->first_name) ? $user_logged_account->first_name : null)?>'" ng-maxLength="50" required>
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
				</div>		
				
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataNeighborhood.$valid}">
					<label for="shippingDataNeighborhood">Barrio<span class="primary-emphasis">*</span></label>
					<input type="text" name="shippingDataNeighborhood" ng-model="shippingDataNeighborhood" class="form-control" id="shippingDataNeighborhood" placeholder="Ingresa tu dirección" ng-init="shippingDataNeighborhood='<?= (isset($user_logged_account->first_name) ? $user_logged_account->first_name : null)?>'" ng-maxLength="50" required>
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
				</div>			
				
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataPhone.$valid}">
					<label for="shippingDataPhone">Teléfono fijo<span class="primary-emphasis">*</span></label>
					<div class="input-group">
						<div class="input-group-addon">#</div>
						<input type="text" name="shippingDataPhone" ng-model="shippingDataPhone" class="form-control" id="shippingDataPhone" placeholder="Ingresa tu teléfono fijo" ng-init="shippingDataPhone='<?= (isset($user_logged_account->phone) ? $user_logged_account->phone : null)?>'" ng-maxLength="32" ng-minLength="7" ng-pattern="/[\d-]/" required>
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
				</div>
				
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.ShippingDataMobile.$valid}">
					<label for="ShippingDataMobile">Teléfono celular<span class="primary-emphasis">*</span></label>
					<div class="input-group">
						<div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
						<input type="text" name="ShippingDataMobile" ng-model="ShippingDataMobile" class="form-control" id="ShippingDataMobile" placeholder="Ingrese su teléfono celular" ng-init="ShippingDataMobile='<?= (isset($user_logged_account->mobile) ? $user_logged_account->mobile : null)?>'" ng-maxLength="32" ng-minLength="10" ng-pattern="/[\d-]/" required>
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
				</div>
				<div class="checkbox">
					<label>
				    	<input type="checkbox" value="">
				    	Usar los datos de mi cuenta
				  	</label>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<button type="submit" class="btn btn-primary center-horizontaly pull-right" ng-disabled="EditAccountForm.$invalid">Continuar</button>
				</div>
			</div>
		</form>
	</div>
</div>
