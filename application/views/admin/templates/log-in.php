<div class="col-md-5" ng-controller="AdminLogInForm">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Administrador</h3>
		</div>
		<div class="panel-body">
			<form id="admin-log-in-form" name="AdminLogInForm" action="<?= base_url() . 'log_in' ?>" method="post" novalidate >
				<div class="form-group" ng-class="{ 'has-error' : !AdminLogInForm.adminUsername.$valid && AdminLogInForm.adminUsername.$dirty }">
					<label for="adminUsername">Usuario<span class="primary-emphasis">*</span></label>
					<input type="text" name="adminUsername" ng-model="adminUsername" class="form-control" id="InputAdminName" placeholder="Ingresa tu usuario" ng-maxLength="90" required>
					<!-- tooltip -->
					<div ng-if="AdminLogInForm.adminUsername.$invalid && AdminLogInForm.adminUsername.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="AdminLogInForm.adminUsername.$error.required">Por favor ingresa tu nombre de usuario!</span>
						</div>
					</div>
					<!-- tooltip -->
				</div>
				<div class="form-group" ng-class="{ 'has-error' : !AdminLogInForm.AdminUserPassword.$valid && AdminLogInForm.AdminUserPassword.$dirty }">
					<label for="AdminUserPassword">Contraseña<span class="primary-emphasis">*</span></label>
					<input type="password" name="AdminUserPassword" ng-model="AdminUserPassword" class="form-control" id="InputAdminPassword" placeholder="Ingrese su contraseña" ng-maxLength="50" ng-minLength="6" required>
					<!-- tooltip -->
					<div ng-if="AdminLogInForm.AdminUserPassword.$invalid && AdminLogInForm.AdminUserPassword.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="AdminLogInForm.AdminUserPassword.$error.required && AdminLogInForm.AdminUserPassword.$dirty">Tu contraseña es obligatoria!</span>
							<span ng-if="AdminLogInForm.AdminUserPassword.$error.maxlength && AdminLogInForm.AdminUserPassword.$dirty">Es demaciado extensa!</span>
							<span ng-if="AdminLogInForm.AdminUserPassword.$error.minlength && AdminLogInForm.AdminUserPassword.$dirty">Tu contraseña es muy corta, debe contener mínimo 6 dígitos!</span>
						</div>
					</div>
					<!-- tooltip -->
				</div>
				
				<div id="login-button-wrapper" ng-mouseover="showSubmitButtonTooltip()" ng-mouseleave="hideSubmitButtonTooltip()">
					<button type="submit" class="btn btn-primary center-horizontaly" ng-disabled="AdminLogInForm.$invalid">Iniciar sesión</button>
				</div>
				<div class="form-group" ng-if="AdminLogInForm.$invalid">
					<!-- tooltip -->
					<div ng-if="mouseover">
						<div class="arrow-up-info"> 
						</div>
						<div class="farma-tooltip-info">
							<span>Debes completar primero el formulario.</span>
						</div>
					</div>
					<!-- tooltip -->
				</div>
			</form>
		</div>
	</div>
</div>