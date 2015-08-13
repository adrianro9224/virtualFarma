<div ng-controller="AccordionCtrl">
	<accordion close-others="">
        <div class="row">
            <!-- first section -->
            <div class="col-md-8">
                <accordion-group is-open="status.isFirstOpen">
                <accordion-heading>
                    Editar mis datos personales
                    <i class="fa fa-pencil-square-o pull-right"></i>
                </accordion-heading>
                <p>Aquí podras actualizar tus datos personales:</p>
                <!-- helptext -->
                <span id="helpBlock" class="help-block">Los campos con <span class="primary-emphasis">*</span> son obligatorios.</span>
                <!-- helptext -->
                <form id="edit-account-form" name="EditAccountForm" ng-controller="EditAccountForm" action="<?= base_url() . 'account/update_account/' . $user_logged_account->id ?>" method="post" novalidate>
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-sm" ng-class="{'has-error': !EditAccountForm.userFirstName.$valid}">
                                    <label for="userFirstName">Primer Nombre<span class="primary-emphasis">*</span></label>
                                    <input type="text" name="userFirstName" ng-model="userFirstName" class="form-control" id="userFirstName" placeholder="Ingrese su primer nombre" ng-init="userFirstName='<?= ( isset($user_logged_account->first_name) ) ? $user_logged_account->first_name : null?>'" ng-maxLength="50" required>
                                    <!-- tooltip -->
                                    <div ng-if="EditAccountForm.userFirstName.$invalid">
                                        <div class="arrow-up-error">
                                        </div>
                                        <div class="farma-tooltip-error">
                                            <span ng-if="EditAccountForm.userFirstName.$error.required">Tu primer nombre es obligatorio!</span>
                                            <span ng-if="EditAccountForm.userFirstName.$error.maxlength">Es muy extenso!</span>
                                        </div>
                                    </div>
                                    <!-- tooltip -->
                                </div>
                                <div class="form-group form-group-sm" ng-class="{'has-error': !EditAccountForm.userSecondName.$valid}">
                                    <label for="userSecondName">Segundo Nombre</label>
                                    <input type="text" name="userSecondName" ng-model="userSecondName" class="form-control" id="userSecondName" placeholder="Ingrese su segundo nombre" ng-init="userSecondName='<?= ( isset($user_logged_account->second_name) ) ? $user_logged_account->second_name : null?>'" ng-maxLength="50">
                                    <!-- tooltip -->
                                    <div ng-if="EditAccountForm.userSecondName.$invalid">
                                        <div class="arrow-up-error">
                                        </div>
                                        <div class="farma-tooltip-error">
                                            <span ng-if="EditAccountForm.userSecondName.$error.maxlength">Es muy extenso!</span>
                                        </div>
                                    </div>
                                    <!-- tooltip -->
                                </div>
                                <div class="form-group form-group-sm" ng-class="{'has-error': !EditAccountForm.userLastName.$valid}">
                                    <label for="userLastName">Primer Apellido<span class="primary-emphasis">*</span></label>
                                    <input type="text" name="userLastName" ng-model="userLastName" class="form-control" id="userLastName" placeholder="Ingrese su primer apellido" ng-init="userLastName='<?= ( isset($user_logged_account->last_name) ) ? $user_logged_account->last_name : null?>'" ng-maxLength="50" required>
                                    <!-- tooltip -->
                                    <div ng-if="EditAccountForm.userLastName.$invalid">
                                        <div class="arrow-up-error">
                                        </div>
                                        <div class="farma-tooltip-error">
                                            <span ng-if="EditAccountForm.userLastName.$error.required">Tu primer apellido es obligatorio!</span>
                                            <span ng-if="EditAccountForm.userLastName.$error.maxlength">Es muy extenso!</span>
                                        </div>
                                    </div>
                                    <!-- tooltip -->
                                </div>
                                <div class="form-group form-group-sm" ng-class="{'has-error': !EditAccountForm.userSurname.$valid}">
                                    <label for="userSurname">Segundo Apellido</label>
                                    <input type="text" name="userSurname" ng-model="userSurname" class="form-control" id="userSurname" placeholder="Ingrese su segundo apellido" ng-init="userSurname='<?= ( isset($user_logged_account->surname) ) ? $user_logged_account->surname : null?>'" ng-maxLength="50">
                                    <!-- tooltip -->
                                    <div ng-if="EditAccountForm.userSurname.$invalid">
                                        <div class="arrow-up-error">
                                        </div>
                                        <div class="farma-tooltip-error">
                                            <span ng-if="EditAccountForm.userSurname.$error.maxlength">Es muy extenso!</span>
                                        </div>
                                    </div>
                                    <!-- tooltip -->
                                </div>
                                <div class="form-group form-group-sm" ng-class="{'has-error': !EditAccountForm.userAddressLine1.$valid && EditAccountForm.userAddressLine1.$dirty}">
                                    <label for="userAddressLine1">Dirección<span class="primary-emphasis">*</span></label>
                                    <input type="text" name="userAddressLine1" ng-model="userAddressLine1" class="form-control" id="userAddressLine1" placeholder="Ingresa tu dirección" ng-init="userAddressLine1='<?= ( isset($address) ) ? $address->address_line : null?>'" ng-maxLength="50" required>
                                    <!-- tooltip -->
                                    <div ng-if="EditAccountForm.userAddressLine1.$invalid && EditAccountForm.userAddressLine1.$dirty">
                                        <div class="arrow-up-error">
                                        </div>
                                        <div class="farma-tooltip-error">
                                            <span ng-if="EditAccountForm.userAddressLine1.$error.required && EditAccountForm.userAddressLine1.$dirty">Tu dirección es obligatoria!</span>
                                            <span ng-if="EditAccountForm.userAddressLine1.$error.maxlength && EditAccountForm.userAddressLine1.$dirty">Tu dirección es muy extensa!</span>
                                        </div>
                                    </div>
                                    <!-- tooltip -->
                                    <!-- helptext -->
                                    <span id="helpBlock" class="help-block">Ej: Carrera 73 # 96 - 75 apto 201</span>
                                    <!-- helptext -->
                                </div>
                                <label class="radio-inline">
                                    <input type="radio" name="userGender" ng-model="userGender" id="userGenderMale" value="M" ng-checked="<?= ( ( isset($user_logged_account->gender) ) && ($user_logged_account->gender == 'M') ) ? 1 : null ?>"> Hombre
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="userGender" ng-model="userGender" id="userGenderFemale" value="F" ng-checked="<?= ( ( isset($user_logged_account->gender) ) && ($user_logged_account->gender == 'F') ) ? 1 : null ?>"> Mujer
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-sm" ng-class="{'has-error': !EditAccountForm.userNeighborhood.$valid && EditAccountForm.userNeighborhood.$dirty}">
                                    <label for="userNeighborhood">Barrio<span class="primary-emphasis">*</span></label>
                                    <input type="text" name="userNeighborhood" ng-model="userNeighborhood" class="form-control" id="userNeighborhood" placeholder="Ingresa el nombre de tu Barrio" ng-init="userNeighborhood='<?= ( isset($address) ) ? $address->neighborhood : null?>'" ng-maxLength="50" required>
                                    <!-- tooltip -->
                                    <div ng-if="EditAccountForm.userNeighborhood.$invalid && EditAccountForm.userNeighborhood.$dirty">
                                        <div class="arrow-up-error">
                                        </div>
                                        <div class="farma-tooltip-error">
                                            <span ng-if="EditAccountForm.userNeighborhood.$error.required && EditAccountForm.userNeighborhood.$dirty">El nombre de tu barrio es obligatorio!</span>
                                            <span ng-if="EditAccountForm.userNeighborhood.$error.maxlength && EditAccountForm.userNeighborhood.$dirty">El nombre de tu barrio es muy extenso!</span>
                                        </div>
                                    </div>
                                    <!-- tooltip -->
                                    <!-- helptext -->
                                    <span id="helpBlock" class="help-block">Ej: El Encanto</span>
                                    <!-- helptext -->
                                </div>
                                <div class="form-group form-group-sm" ng-class="{'has-error': !EditAccountForm.userPhone.$valid}">
                                    <label for="userPhone">Teléfono fijo</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">#</div>
                                        <input type="text" name="userPhone" ng-model="userPhone" class="form-control" id="userPhone" placeholder="Ingrese su teléfono fijo" ng-init="userPhone='<?= ( isset($user_logged_account->phone) )? $user_logged_account->phone : null?>'" ng-maxLength="32" ng-minLength="7" ng-pattern="/[\d-]/" autocomplete="off">
                                    </div>
                                    <!-- tooltip -->
                                    <div ng-if="EditAccountForm.userPhone.$invalid">
                                        <div class="arrow-up-error">
                                        </div>
                                        <div class="farma-tooltip-error">
                                            <span ng-if="EditAccountForm.userPhone.$error.maxlength && !EditAccountForm.userPhone.$error.pattern">Es muy extenso!</span>
                                            <span ng-if="EditAccountForm.userPhone.$error.minlength && !EditAccountForm.userPhone.$error.pattern">Es muy corto, debe contener mínimo 7 dígitos</span>
                                            <span ng-if="EditAccountForm.userPhone.$error.pattern">Solo se permiten valores numéricos y el caractér "-"</span>
                                        </div>
                                    </div>
                                    <!-- tooltip -->
                                </div>

                                <div class="form-group form-group-sm" ng-class="{'has-error': !EditAccountForm.userMobile.$valid}">
                                    <label for="userMobile">Teléfono celular</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
                                        <input type="text" name="userMobile" ng-model="userMobile" class="form-control" id="userMobile" placeholder="Ingrese su teléfono celular" ng-init="userMobile='<?= ( isset($user_logged_account->mobile) ) ? $user_logged_account->mobile : null?>'" ng-maxLength="32" ng-minLength="10" ng-pattern="/[\d-]/" autocomplete="off">
                                    </div>
                                    <!-- tooltip -->
                                    <div ng-if="EditAccountForm.userMobile.$invalid">
                                        <div class="arrow-up-error">
                                        </div>
                                        <div class="farma-tooltip-error">
                                            <span ng-if="EditAccountForm.userMobile.$error.maxlength && !EditAccountForm.userMobile.$error.pattern">Es muy extenso!</span>
                                            <span ng-if="EditAccountForm.userMobile.$error.minlength && !EditAccountForm.userMobile.$error.pattern">Es muy corto, debe contener mínimo 10 dígitos</span>
                                            <span ng-if="EditAccountForm.userMobile.$error.pattern">Solo se permiten valores numéricos y el caractér "-"</span>
                                        </div>
                                    </div>
                                    <!-- tooltip -->
                                </div>

                                <div class="form-group form-group-sm" ng-class="{'has-error': !EditAccountForm.userEmail.$valid}">
                                    <label for="userEmail">Correo electrónico<span class="primary-emphasis">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">@</div>
                                        <input type="text" name="userEmail" ng-model="userEmail" class="form-control" id="userEmail" placeholder="Ingrese su email" ng-init="userEmail='<?= ( isset($user_logged_account->email) ) ? $user_logged_account->email : null?>'" ng-pattern="/[\w.]+?\@{1}[\w.]+(\.+[\w.]+)/" autocomplete="off" required>
                                    </div>
                                    <!-- tooltip -->
                                    <div ng-if="EditAccountForm.userEmail.$invalid">
                                        <div class="arrow-up-error">
                                        </div>
                                        <div class="farma-tooltip-error">
                                            <span ng-if="EditAccountForm.userEmail.$error.required">Tu correo electrónico es obligatorio!</span>
                                            <span ng-if="EditAccountForm.userEmail.$error.maxlength">Es muy extenso!</span>
                                            <span ng-if="EditAccountForm.userEmail.$error.pattern">Por favor ingresa un correo electrónico válido!</span>
                                        </div>
                                    </div>
                                    <!-- tooltip -->
                                    <!-- helptext -->
                                    <span id="helpBlock" class="help-block">Ej: example@example.com</span>
                                    <!-- helptext -->
                                </div>
                                <div class="form-group form-group-sm" ng-class="{'has-error': !EditAccountForm.userId.$valid}">
                                    <label for="userId">Número de identificación</label>
                                    <input type="text" name="userId" ng-model="userId" class="form-control" id="userId" placeholder="Ingrese su numero de identificación" ng-init="userId='<?= ( isset($user_logged_account->identification_number) ) ? $user_logged_account->identification_number : null?>'" ng-pattern="/[\d-.]/" >
                                    <!-- tooltip -->
                                    <div ng-if="EditAccountForm.userId.$invalid">
                                        <div class="arrow-up-error">
                                        </div>
                                        <div class="farma-tooltip-error">
                                            <span ng-if="EditAccountForm.userId.$error.maxlength">Es muy extenso!</span>
                                            <span ng-if="EditAccountForm.userId.$error.pattern ">Solo se permiten valores numéricos y los caractéres {-.}</span>
                                        </div>
                                    </div>
                                    <!-- tooltip -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" ng-mouseover="showSubmitButtonTooltip()" ng-mouseleave="hideSubmitButtonTooltip()">
                        <button type="submit" class="btn btn-primary center-horizontaly" ng-disabled="EditAccountForm.$invalid || !EditAccountForm.$dirty">Guardar</button>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" ng-if="(!EditAccountForm.$dirty || EditAccountForm.$invalid) && mouseover">
                            <!-- tooltip -->
                            <div class="arrow-up-info">
                            </div>
                            <div class="farma-tooltip-info">
                                <span ng-show="EditAccountForm.$invalid">Debes completar sin errores todos los campos obligatorios del formulario.</span>
                                <span ng-show="!EditAccountForm.$dirty">No haz realizado ningún cambio.</span>
                            </div>
                            <!-- tooltip -->
                        </div>
                    </div>
                </form>
		</accordion-group>
            </div>
            <!-- first section -->
            <!-- second section -->
            <div class="col-md-4" ng-controller="ManageAddressesCtrl">
                <accordion-group is-open="status.isFirstOpen">
                    <accordion-heading>
                        Mis direcciones
                        <i class="fa fa-map-marker pull-right"></i>
                    </accordion-heading>
                    <p>Aquí podras crear y editar tus direcciones preferidas:</p>
                    <!-- helptext -->
                    <span id="helpBlock" class="help-block">Los campos con <span class="primary-emphasis">*</span> son obligatorios.</span>
                    <!-- helptext -->

                    <span ng-if="panelDirty" ng-bind="infoStatusText"><i class="fa fa-refresh fa-spin"></i></span>

                    <h4><span class="label label-primary">Nueva dirección:</span></h4>
                    <!-- wrapper -->
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="addresses-form" name="addressesForm" class="horizontal-form" novalidate>
                                    <div class="form-group form-group-sm" ng-class="{'has-error': !addressesForm.addressName.$valid && addressesForm.addressName.$dirty}">
                                        <label class="control-label col-md-3" for="addressName">Nombre<span class="primary-emphasis">*</span></label>

                                        <div class="col-md-9">
                                            <input type="text" name="addressName" ng-model="address.name" class="form-control"  id="addressName" placeholder="Nombre para tu dirección"  ng-maxLength="64" required>
                                            <!-- tooltip -->
                                            <div ng-if="addressesForm.addressName.$invalid && addressesForm.addressName.$dirty">
                                                <div class="arrow-up-error">
                                                </div>
                                                <div class="farma-tooltip-error">
                                                    <span ng-if="addressesForm.addressName.$error.required && addressesForm.addressName.$dirty">Por favor escribe un nombre para tu dirección!</span>
                                                    <span ng-if="addressesForm.addressName.$error.maxlength">Es muy extenso!</span>
                                                </div>
                                            </div>
                                            <!-- tooltip -->
                                            <!-- helptext -->
                                            <span id="helpBlock" class="help-block">Ej: Casa, Oficina, etc</span>
                                            <!-- helptext -->
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm" ng-class="{'has-error': !addressesForm.addressLine1.$valid && addressesForm.addressLine1.$dirty}">
                                        <label class="control-label col-md-3" for="addressLine1">Dirección<span class="primary-emphasis">*</span></label>

                                        <div class="col-md-9">
                                            <input type="text" name="addressLine1" ng-model="address.line1" class="form-control"  id="addressLine1" placeholder="Dirección de destino"  ng-maxLength="64" required>
                                            <!-- tooltip -->
                                            <div ng-if="addressesForm.addressLine1.$invalid && addressesForm.addressLine1.$dirty">
                                                <div class="arrow-up-error">
                                                </div>
                                                <div class="farma-tooltip-error">
                                                    <span ng-if="addressesForm.addressLine1.$error.required && addressesForm.addressLine1.$dirty">Por favor escribe la dirección!</span>
                                                    <span ng-if="addressesForm.addressLine1.$error.maxlength">Es muy extensa!</span>
                                                </div>
                                            </div>
                                            <!-- tooltip -->
                                            <!-- helptext -->
                                            <span id="helpBlock" class="help-block">Ej: Carrera 73 # 96 - 75 apto 206</span>
                                            <!-- helptext -->
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <a class="btn btn-warning center-horizontaly" ng-click="saveAddress(address)" ng-disabled="addressesForm.$invalid || savingAddress" ng-bind="buttonText"></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <h4><span class="label label-primary">Direcciones favoritas:</span></h4>
                    <!-- wrapper -->
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-md-12">
                                <span ng-if="updatingAddress">Actualizando <i class="fa fa-refresh fa-spin" ></i></span>
                                <h5 ng-if="addressesEmpty">No has agregado direcciones</h5>
                                <accordion-group is-open="" ng-if="addressesCharged && !addressesEmpty" ng-repeat="(key, userAddress) in addresses">
                                    <accordion-heading >
                                        {{userAddress.name}}
                                         <span class="pull-right">Editar <i class="fa fa-pencil-square-o"></i></span>
                                    </accordion-heading>
                                    <form id="edit-addresses-form" name="editAddressesForm" class="horizontal-form" novalidate>
                                        <div class="form-group form-group-sm" ng-class="{'has-error': !editAddressesForm.addressName.$valid && editAddressesForm.addressName.$dirty}">
                                            <label class="control-label col-md-3" for="addressName">Nombre<span class="primary-emphasis">*</span></label>

                                            <div class="col-md-9">
                                                <input type="text" name="addressName" ng-model="address.name" ng-init="address.name = userAddress.name" class="form-control"  id="addressName" placeholder="Nombre para tu dirección"  ng-maxLength="64" required>
                                                <!-- tooltip -->
                                                <div ng-if="editAddressesForm.addressName.$invalid && editAddressesForm.addressName.$dirty">
                                                    <div class="arrow-up-error">
                                                    </div>
                                                    <div class="farma-tooltip-error">
                                                        <span ng-if="editAddressesForm.addressName.$error.required && editAddressesForm.addressName.$dirty">Por favor escribe un nombre para tu dirección!</span>
                                                        <span ng-if="editAddressesForm.addressName.$error.maxlength">Es muy extenso!</span>
                                                    </div>
                                                </div>
                                                <!-- tooltip -->
                                                <!-- helptext -->
                                                <span id="helpBlock" class="help-block">Ej: Casa, Oficina, etc</span>
                                                <!-- helptext -->
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm" ng-class="{'has-error': !editAddressesForm.addressLine1.$valid && editAddressesForm.addressLine1.$dirty}">
                                            <label class="control-label col-md-3" for="addressLine1">Dirección<span class="primary-emphasis">*</span></label>

                                            <div class="col-md-9">
                                                <input type="text" name="addressLine1" ng-model="address.line1" ng-init="address.line1 = userAddress.address_line" class="form-control"  id="addressLine1" placeholder="Dirección de destino"  ng-maxLength="64" required>
                                                <!-- tooltip -->
                                                <div ng-if="editAddressesForm.addressLine1.$invalid && editAddressesForm.addressLine1.$dirty">
                                                    <div class="arrow-up-error">
                                                    </div>
                                                    <div class="farma-tooltip-error">
                                                        <span ng-if="editAddressesForm.addressLine1.$error.required && editAddressesForm.addressLine1.$dirty">Por favor escribe la dirección!</span>
                                                        <span ng-if="editAddressesForm.addressLine1.$error.maxlength">Es muy extensa!</span>
                                                    </div>
                                                </div>
                                                <!-- tooltip -->
                                                <!-- helptext -->
                                                <span id="helpBlock" class="help-block">Ej: Carrera 73 # 96 - 75 apto 206</span>
                                                <!-- helptext -->
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <a class="btn btn-warning btn-xs" ng-click="updateAddress(address, userAddress)" ng-disabled="editAddressesForm.$invalid || updatingAddress || !editAddressesForm.$dirty" >{{buttonUpdateText}} <i class="fa fa-circle-o-notch fa-spin" ng-if="updatingAddress"></i></a>
                                            <a class="btn btn-danger btn-xs pull-right" ng-click="deleteAddress( userAddress.id )" >{{buttonDeleteText}} <i class="fa fa-circle-o-notch fa-spin" ng-if="deletingAddress"></i></a>
                                        </div>
                                    </form>
                                </accordion-group>
                            </div>
                        </div>
                    </div>

                    <!-- wrapper -->
                </accordion-group>
            </div>
            <!-- second section -->
        </div>
		<accordion-group >
			<div ng-controller="MessageCtrl">
				<accordion-heading>
					Mis mensajes
					<i class="fa fa-envelope-o pull-right"></i> 
				</accordion-heading>
				
				
				<div class="row" id="open-message-button">
					<div class="pull-right">
						<a ng-click="openCreateMessage()" ng-if="!open">Nuevo mensáje</a>
						<a ng-click="openCreateMessage()" ng-if="open">Cancelar</a>
					</div>
				</div>
				<div id="new-message-form" ng-if="open" class="message-emphasis">
					<p class="bg-primary">Solo podrás envíar mensájes a personas que estén registradas en virtualfarma.com.co.</p>
					<div class="row">
						<form id="send-message" name="SendMessage" action="<?= base_url() . 'message/send_message/'?>" method="post" novalidate>
							<div class="col-md-6">
								<div class="form-group form-group-sm" ng-class="{'has-error': SendMessage.to.$invalid && SendMessage.to.$dirty}">
									<label for="to">Para<span class="primary-emphasis">*</span>:</label>
									<input type="text" name="to" ng-model="to" class="form-control" id="to" placeholder="Email del destinatario" ng-pattern="/[\w.]+?\@{1}[\w.]+(\.+[\w.]+)/" ng-maxLength="90" required>
									<!-- tooltip -->
									<div ng-if="SendMessage.to.$invalid && SendMessage.to.$dirty">
										<div class="arrow-up-error"> 
										</div>
										<div class="farma-tooltip-error">
											<span ng-if="(SendMessage.to.$error.maxlength && SendMessage.to.$dirty) && !(SendMessage.to.$error.pattern || SendMessage.to.$error.email)">Es demaciado extenso!</span>
											<span ng-if="SendMessage.to.$error.required && SendMessage.to.$dirty">Tu correo electrónico es obligatorio!</span>
											<span ng-if="SendMessage.to.$error.pattern || SendMessage.to.$error.email">Por favor ingresa un correo electrónico válido!</span>
										</div>
									</div>
									<!-- tooltip -->
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-sm" ng-class="{'has-error': SendMessage.content.$invalid && SendMessage.content.$dirty }">
									<label for="content">Mensáje<span class="primary-emphasis">*</span>:</label>
									<textarea name="content" class="form-control" ng-model="content" rows="3" ng-maxLength="1000" required></textarea>
									<!-- tooltip -->
									<div ng-if="SendMessage.content.$invalid && SendMessage.content.$dirty">
										<div class="arrow-up-error"> 
										</div>
										<div class="farma-tooltip-error">
											<span ng-if="SendMessage.content.$error.maxlength && SendMessage.content.$dirty">Es demaciado extenso!</span>
											<span ng-if="SendMessage.content.$error.required && SendMessage.content.$dirty">Vas a enviar un mensáje vacio!</span>
										</div>
									</div>
									<!-- tooltip -->
								</div>
							</div>
							<div class="col-md-12">
								<div class="pull-right">
									<button type="submit" class="btn btn-primary" ng-disabled="SendMessage.$invalid">Enviar</button>
									<a class="btn btn-primary" ng-click="openCreateMessage()" >Cancelar</a>
								</div>
							</div>
						</form>
					</div>
				</div>
				
				<?php if( isset($messages) ):?>
					<?php if( isset($messages->sent) ):?>
						<?php foreach ($messages->sent as $message):?>
							<div class="row normal-padding message hidden" id="<?= "message_" . $message->id?>">
								<div class="col-md-12 message-title">
									<div class="pull-left">
										<h3><?= $message->recipient?></h3>
									</div>
									<div class="pull-right">
										<a ng-click="closeMessage('<?= $message->id?>')"><span class="glyphicon glyphicon-remove"></span></a>
									</div>
								</div>
								<p class="message-box bg-info"><?= $message->content?></p>
							</div>
						<?php endforeach;?>
					<?php endif;?>
					<?php if( isset($messages->received) ):?>
						<?php foreach ($messages->received as $message):?>
							<div class="row normal-padding message hidden" id="<?= "message_" . $message->id?>">
								<div class="col-md-12 message-title">
									<div class="pull-left">
										<h3><?= $message->sender?></h3>
									</div>
									<div class="pull-right">
										<a ng-click="closeMessage('<?= $message->id?>')"><span class="glyphicon glyphicon-remove"></span></a>
									</div>
								</div>
								<p class="message-box bg-info"><?= $message->content?></p>
							</div>
						<?php endforeach;?>
					<?php endif;?>
					<div class="row normal-side-padding">
						<div class="btn-group" role="group" aria-label="...">
							<button type="button" class="btn btn-primary" ng-class="{'active' : receivedActived, 'disabled' : <?= ( isset($messages->received) ) ? 0 : 1?>}" ng-click="activeReceivedMessages()">Recibídos</button>
							<button type="button" class="btn btn-primary" ng-class="{'active' : sentdActived, 'disabled' : <?= ( isset($messages->sent) ) ? 0 : 1?>}" ng-click="activeSentMessages()">Envíados</button>
						</div>
					</div>	
					<?php if ( isset($messages->received) ):?>
						<div class="table-responsive" ng-if="receivedActived">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>Estado</th>
										<th>De</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($messages->received as $message):?>
										<tr id="<?= "tr-" . $message->id ?>" class="received-message" ng-if="receivedActived">
											<td class="handy" ng-click="openMessage('<?= $message->id?>', '<?= $user_logged_account->id ?>')">
												<?php if($message->recipient_status == 'SENT'):?>
													<a><span id="icon-message-<?= $message->id?>" class="glyphicon glyphicon-envelope"></span></a>
												<?php endif;?>
												<?php if($message->recipient_status == 'READED'):?>
													<a><span id="icon-message-<?= $message->id?>" class="glyphicon glyphicon-ok"></span></a>
												<?php endif;?>
											</td>
											<td class="handy" ng-click="openMessage('<?= $message->id?>', '<?= $user_logged_account->id ?>')">
												<?= $message->sender?>
											</td>
											<td>
											<a ng-click="deleteMessage('<?= $message->id?>', '<?= $user_logged_account->id ?>', 1)"><span class="glyphicon glyphicon-remove"></span></a>
											</td>
										</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>	
					<?php else:?>
						<div class="row normal-padding" ng-if="receivedActived">
							<p class="bg-info">No has recibído mensájes</p>
						</div>
					<?php endif;?>
					<?php if ( isset($messages->sent) ):?>
						<div class="table-responsive" ng-if="sentActived">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th></th>
										<th>Para</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($messages->sent as $message):?>
										<tr id="<?= "sent-tr-" . $message->id ?>" class="sent-message">
											<td class="handy" ng-click="openMessageSingle('<?= $message->id?>')">
													<a><span id="icon-message-<?= $message->id?>" class="glyphicon glyphicon-envelope"></span></a>
											</td>
											<td class="handy" ng-click="openMessageSingle('<?= $message->id?>')">
												<?= $message->recipient?>
											</td>
											<td>
											<a ng-click="deleteMessage('<?= $message->id?>', '<?= $user_logged_account->id ?>', 0)"><span class="glyphicon glyphicon-remove"></span></a>
											</td>
										</tr>
									<?php endforeach;?>	
								</tbody>
							</table>
						</div>	
					<?php else:?>
						<div class="row normal-padding" ng-if="sentActived">
							<p class="bg-info">No has envíado mensájes</p>
						</div>
					<?php endif;?>
				<?php else:?>
					<div class="row normal-padding">
						<p class="bg-info">No tienes mensájes</p>
					</div>	
				<?php endif;?>
			</div>
		</accordion-group>
<!-- 		<accordion-group is-open="status.open"> -->
<!-- 			<accordion-heading> -->
<!-- 				I can have markup, too!  -->
<!-- 				<i class="pull-right glyphicon" ng-class="{'glyphicon-chevron-down': !status.open, 'glyphicon-chevron-right': status.open}"></i> -->
<!-- 			</accordion-heading> -->
<!-- 			This is just some content to illustrate fancy headings. -->
<!-- 		</accordion-group> -->
	</accordion>
</div>
