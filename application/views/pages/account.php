<!DOCTYPE html>
<html lang="en" ng-app="farmapp">
<?php include_once(__ROOT__TEMPLATES__ . 'head.php');?>

<body>
	<div id="wrapper">
		<!-- Header start -->
		<section id="header">
			<section id="header-top" class="container-fluid">
				<?php include_once( __ROOT__TEMPLATES__ . 'header-top.php');?>
			</section>
			<section id="header-nav" class="">
				<?php include_once( __ROOT__TEMPLATES__ . 'header-nav.php');?>
			</section>
			<section class="breadcrumb-wrapper">
        		<div class="container">
		            <?php include_once( __ROOT__TEMPLATES__ . 'breadcrumb.php');?>
        		</div>
    		</section>
		</section>
		<!-- Header over -->
		
		<!-- Errors start -->
		<div class="container">
			<div class="row">
				<section id="errors">
					<?php include_once( __ROOT__TEMPLATES__ . 'notifications-banner.php');?>
				</section>
			</div>
		</div>
		<!-- Errors over -->
		<!-- Content start -->
		<section id="content">
			<div  class="container">
				<div class="row">
                    <p id="benefits-banner" class="bg-info">Regístrate y podrás obtener <strong>puntos</strong> por cada compra, <strong>descuentos</strong>, <strong>tips</strong> de salud, <strong>boletín</strong> de noticias y muchas otras cosas más!</p>
					<div class="col-md-5" ng-controller="RegisterForm">
						<div class="panel panel-default">
		  					<div class="panel-heading">
		  					<h3>Nuevo usuario</h3>
		  					</div>
		  					<div class="panel-body">
		  						<p>Complete el siguiente formulario:</p>
		    					<form id="sign-up-form" name="SignUpForm" action="<?= base_url() . 'account/sign_up' ?>" method="post" novalidate autocomplete="off">
		    						<div class="form-group" ng-class="{'has-error': !SignUpForm.userFirstName.$valid && SignUpForm.userFirstName.$dirty}">
    									<label for="userFirstName">Primer Nombre<span class="primary-emphasis">*</span></label>
    									<input type="text" name="userFirstName" ng-model="userFirstName" class="form-control" id="userFirstName" placeholder="Ingrese su nombre" ng-maxLength="50" required>
    									<!-- tooltip -->
    									<div ng-if="SignUpForm.userFirstName.$invalid && SignUpForm.userFirstName.$dirty">
    										<div class="arrow-up-error"> 
    										</div>
	    									<div class="farma-tooltip-error">
	    										<span ng-if="SignUpForm.userFirstName.$error.required && SignUpForm.userFirstName.$dirty">Tu primer nombre es obligatorio!</span>
	    										<span ng-if="SignUpForm.userFirstName.$error.maxlength && SignUpForm.userFirstName.$dirty">Es demaciado extenso!</span>
	    									</div>
    									</div>
    									<!-- tooltip -->
  									</div>
  									<div class="form-group" ng-class="{'has-error': !SignUpForm.userLastName.$valid && SignUpForm.userLastName.$dirty}">
    									<label for="userlastName">Primer Apellido<span class="primary-emphasis">*</span></label>
    									<input type="text" name="userLastName" ng-model="userLastName" class="form-control" id="userLastName" placeholder="Ingrese su Apellido" ng-maxLength="50" required>
    									<!-- tooltip -->
    									<div ng-if="SignUpForm.userLastName.$invalid && SignUpForm.userLastName.$dirty">
    										<div class="arrow-up-error"> 
    										</div>
	    									<div class="farma-tooltip-error">
	    										<span ng-if="SignUpForm.userLastName.$error.required && SignUpForm.userLastName.$dirty">Tu primer apellido es obligatorio!</span>
	    										<span ng-if="SignUpForm.userLastName.$error.maxlength && SignUpForm.userLastName.$dirty">Es demaciado extenso!</span>
	    									</div>
    									</div>
    									<!-- tooltip -->
  									</div>
									<div class="form-group" ng-class="{'has-error': !SignUpForm.userEmail.$valid && SignUpForm.userEmail.$dirty}">
    									<label for="userEmail">Correo electrónico<span class="primary-emphasis">*</span></label>
    									<div class="input-group">
    										<div class="input-group-addon">@</div>
    										<input type="text" name="userEmail" ng-model="userEmail" ng-change="isEqual( userEmail, 'e' )" class="form-control" id="userEmail" placeholder="Ingrese su correo electrónico" ng-pattern="/[\w.]+?\@{1}[\w.]+(\.+[\w.]+)/" ng-maxLength="90" required>
    									</div>
    									<!-- tooltip -->
    									<div ng-if="SignUpForm.userEmail.$invalid && SignUpForm.userEmail.$dirty">
    										<div class="arrow-up-error"> 
    										</div>
	    									<div class="farma-tooltip-error">
	    										<span ng-if="SignUpForm.userEmail.$error.required && SignUpForm.userEmail.$dirty">Tu correo electrónico es obligatorio!</span>
	    										<span ng-if="(SignUpForm.userEmail.$error.maxlength && SignUpForm.userEmail.$dirty) && !(SignUpForm.userEmail.$error.pattern || SignUpForm.userEmail.$error.email)">Es demaciado extenso!</span>
	    										<span ng-if="SignUpForm.userEmail.$error.pattern || SignUpForm.userEmail.$error.email">Por favor ingresa un correo electrónico válido!</span>
	    									</div>
    									</div>
    									<!-- tooltip -->
  									</div>

                                    <div class="form-group" ng-if="SignUpForm.userEmail.$valid" ng-class="{'has-error': !SignUpForm.userEmailConfirmation.$valid && SignUpForm.userEmailConfirmation.$dirty}">
                                        <label for="userEmailConfirmation">Confirma tu correo electrónico<span class="primary-emphasis">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">@</div>
                                            <input type="text" name="userEmailConfirmation" ng-model="userEmailConfirmation" ng-change="isEqual( userEmailConfirmation, 'e' )" class="form-control" id="userEmailConfirmation" placeholder="Confirma tu correo electrónico" ng-pattern="/[\w.]+?\@{1}[\w.]+(\.+[\w.]+)/" ng-maxLength="90" required>
                                        </div>
                                        <!-- tooltip -->
                                        <div ng-if="(SignUpForm.userEmailConfirmation.$invalid && SignUpForm.userEmailConfirmation.$dirty) || (!emailComparation && SignUpForm.userEmailConfirmation.$dirty)">
                                            <div class="arrow-up-error">
                                            </div>
                                            <div class="farma-tooltip-error">
                                                <span ng-if="SignUpForm.userEmailConfirmation.$error.required && SignUpForm.userEmailConfirmation.$dirty">Por favor confirma tu correo electrónico!</span>
                                                <span ng-if="(SignUpForm.userEmailConfirmation.$error.maxlength && SignUpForm.userEmailConfirmation.$dirty) && !(SignUpForm.userEmailConfirmation.$error.pattern || SignUpForm.userEmailConfirmation.$error.email)">Es demaciado extenso!</span>
                                                <span ng-if="SignUpForm.userEmailConfirmation.$error.pattern || SignUpForm.userEmailConfirmation.$error.email">Por favor ingresa un correo electrónico válido!</span>
                                                <span ng-if="!emailComparation && SignUpForm.userEmailConfirmation.$dirty">Los correos electrónicos no coinciden :(</span>
                                            </div>
                                        </div>
                                        <!-- tooltip -->
                                    </div>
  									<div class="form-group" ng-class="{'has-error': !SignUpForm.userPassword.$valid && SignUpForm.userPassword.$dirty}">
    									<label for="userPassword">Contraseña<span class="primary-emphasis">*</span></label>
    									<input type="password" name="userPassword" ng-model="userPassword" ng-change="isEqual( userPassword, 'p' )" class="form-control" id="userPassword" placeholder="Debe contener mínimo 6 dígitos" ng-maxLength="50" ng-minLength="6" required>
    									<!-- tooltip -->
    									<div ng-if="SignUpForm.userPassword.$invalid && SignUpForm.userPassword.$dirty">
    										<div class="arrow-up-error"> 
    										</div>
	    									<div class="farma-tooltip-error">
	    										<span ng-if="SignUpForm.userPassword.$error.required && SignUpForm.userPassword.$dirty">Tu contraseña es obligatoria!</span>
	    										<span ng-if="SignUpForm.userPassword.$error.maxlength && SignUpForm.userPassword.$dirty">Es demaciado extensa!</span>
	    										<span ng-if="SignUpForm.userPassword.$error.minlength && SignUpForm.userPassword.$dirty">Tu contraseña es muy corta, debe contener mínimo 6 dígitos!</span>
	    									</div>
    									</div>
    									<!-- tooltip -->
  									</div>
                                    <div class="form-group" ng-if="SignUpForm.userPassword.$valid" ng-class="{'has-error': !SignUpForm.userPasswordConfirmation.$valid && SignUpForm.userPasswordConfirmation.$dirty}">
                                        <label for="userPasswordConfirmation">Confirma tu contraseña<span class="primary-emphasis">*</span></label>
                                        <input type="password" name="userPasswordConfirmation" ng-model="userPasswordConfirmation" ng-change="isEqual( userPasswordConfirmation, 'p' )" class="form-control" id="userPasswordConfirmation" placeholder="Confirmar tu contraseña" ng-maxLength="50" ng-minLength="6" required>
                                        <!-- tooltip -->
                                        <div ng-if="(SignUpForm.userPasswordConfirmation.$invalid && SignUpForm.userPasswordConfirmation.$dirty) || (!passwordComparation && SignUpForm.userPasswordConfirmation.$dirty)">
                                            <div class="arrow-up-error">
                                            </div>
                                            <div class="farma-tooltip-error">
                                                <span ng-if="SignUpForm.userPasswordConfirmation.$error.required && SignUpForm.userPasswordConfirmation.$dirty">Por favor confirma tu contraseña!</span>
                                                <span ng-if="SignUpForm.userPasswordConfirmation.$error.maxlength && SignUpForm.userPasswordConfirmation.$dirty">Es demaciado extensa!</span>
                                                <span ng-if="SignUpForm.userPasswordConfirmation.$error.minlength && SignUpForm.userPasswordConfirmation.$dirty">Tu contraseña es muy corta, debe contener mínimo 6 dígitos!</span>
                                                <span ng-if="!passwordComparation && SignUpForm.userPasswordConfirmation.$dirty">Las contraseñas no coinciden :(</span>
                                            </div>
                                        </div>
                                        <!-- tooltip -->
                                    </div>
  									<div class="form-group">
  										<div class="checkbox" ng-controller="TermsAndCondCtrl">
	      									<label>
                                                <?php include_once( __ROOT__TEMPLATES__ . 'terms_and_conditions_modal.php' )?>
	        									<input type="checkbox" name="termsAndConditions" ng-model="termsAndConditions" value="1" required> Acepto <a ng-click="open('lg')" id="terms-and-conditions" >Términos y Condiciones</a>
	      									</label>
    									</div>
	    								<!-- tooltip -->
	    								<div ng-if="SignUpForm.termsAndConditions.$invalid && SignUpForm.termsAndConditions.$dirty">
	    									<div class="arrow-up-error"> 
	    									</div>
		    								<div class="farma-tooltip-error">
		    									<span ng-if="SignUpForm.termsAndConditions.$error.required && SignUpForm.termsAndConditions.$dirty">Por favor acepta los Términos y Condiciones!</span>
		    								</div>
	    								</div>
	    								<!-- tooltip -->
  									</div>
  									
    								<div id="register-button-wrapper"  ng-mouseover="showSubmitButtonTooltip()" ng-mouseleave="hideSubmitButtonTooltip()">
    									<button type="submit" class="btn btn-primary center-horizontaly" ng-disabled="SignUpForm.$invalid" >Registrarme</button>
    								</div>
    								<div class="form-group" ng-if="SignUpForm.$invalid">
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
					
					<div class="col-md-5" ng-controller="LogInForm">
						<div class="panel panel-default" ng-controller="FacebookCtrl">
		  					<div class="panel-heading">
		  						<h3>Usuario registrado</h3>
		  					</div>
		  					<div class="panel-body">
		  						<p>Ya estas registrado ?, ingresa con tu cuenta de virtualFarma:</p>
		    					<form id="log-in-form" name="LogInForm" action="<?= base_url() . 'account/log_in' ?>" method="post" novalidate >
									<div class="form-group" ng-class="{ 'has-error' : !LogInForm.userEmail.$valid && LogInForm.userEmail.$dirty }">
    									<label for="userEmail">Correo electrónico<span class="primary-emphasis">*</span></label>
    									<input type="text" name="userEmail" ng-model="userEmail" class="form-control" id="InputEmail" placeholder="Ingrese su correo electrónico" ng-maxLength="90" ng-pattern="/[\w.]+?\@{1}[\w.]+(\.+[\w.]+)/" required>
    									<!-- tooltip -->
	    								<div ng-if="LogInForm.userEmail.$invalid && LogInForm.userEmail.$dirty">
	    									<div class="arrow-up-error"> 
	    									</div>
		    								<div class="farma-tooltip-error">
		    									<span ng-if="LogInForm.userEmail.$error.required && LogInForm.userEmail.$dirty">Tu correo electrónico es obligatorio!</span>
		    									<span ng-if="(LogInForm.userEmail.$error.maxlength && LogInForm.userEmail.$dirty) && !(LogInForm.userEmail.$error.pattern || LogInForm.userEmail.$error.email)">Es demaciado extenso!</span>
		    									<span ng-if="LogInForm.userEmail.$error.pattern || LogInForm.userEmail.$error.email">Por favor ingresa un correo electrónico válido!</span>
		    								</div>
	    								</div>
	    								<!-- tooltip -->
  									</div>
  									<div class="form-group" ng-class="{ 'has-error' : !LogInForm.userPassword.$valid && LogInForm.userPassword.$dirty }">
    									<label for="userPassword">Contraseña<span class="primary-emphasis">*</span></label>
    									<input type="password" name="userPassword" ng-model="userPassword" class="form-control" id="InputPassword" placeholder="Ingrese su contraseña" ng-maxLength="50" ng-minLength="6" required>
    									<!-- tooltip -->
	    								<div ng-if="LogInForm.userPassword.$invalid && LogInForm.userPassword.$dirty">
	    									<div class="arrow-up-error"> 
	    									</div>
		    								<div class="farma-tooltip-error">
		    									<span ng-if="LogInForm.userPassword.$error.required && LogInForm.userPassword.$dirty">Tu contraseña es obligatoria!</span>
		    									<span ng-if="LogInForm.userPassword.$error.maxlength && LogInForm.userPassword.$dirty">Es demaciado extensa!</span>
		    									<span ng-if="LogInForm.userPassword.$error.minlength && LogInForm.userPassword.$dirty">Tu contraseña es muy corta, debe contener mínimo 6 dígitos!</span>
		    								</div>
	    								</div>
	    								<!-- tooltip -->
  									</div>
  									
  									<div id="login-button-wrapper" ng-mouseover="showSubmitButtonTooltip()" ng-mouseleave="hideSubmitButtonTooltip()">
  										<button type="submit" class="btn btn-primary center-horizontaly" ng-disabled="LogInForm.$invalid">Iniciar sesión</button>
  									</div>
  									<div class="form-group" ng-if="LogInForm.$invalid">
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
	    							
	    							<h3>Ò inicia sessión con Facebook</h3>
									<div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="true" data-scope="public_profile, email, user_friends"></div>
									<div id="status">
									</div>
		    					</form>
		  					</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<!-- Content over -->
		
		<!-- Footer start -->
		<section id="footer">
				<?php include_once( __ROOT__TEMPLATES__ . 'footer.php');?>
		</section>
		<!-- Footer over -->
	</div>	
</body>
</html>

