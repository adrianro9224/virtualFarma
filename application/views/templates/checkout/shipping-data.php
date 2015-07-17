<div class="panel panel-default" ng-hide="order.sended">
	<div class="panel-heading handy" ng-click="openSection('shippingData')" ng-class="{'disabled-panel-heading' : !shippingData && !order.shippingData.status}">
		<h4><i class="fa fa-truck"></i> Datos de envío <i ng-show="order.shippingData.status" class="fa fa-check"></i> </h4>
	</div>
	<div class="panel-body" ng-if="shippingData">
		<p>Por favor ingresa los datos de la persona a quien se la hará el envío.
        <!-- helptext -->
        <span id="helpBlock" class="help-block">Usamos tu ubicación para ayudarte con la dirección :)</span>
        <!-- helptext -->
        <div id="checkout-map-canvas"></div>
		<div class="checkbox" ng-init="shippingDataCompleted=<?= ( isset($shipping_data) ) ? 1 : 0 ?>">
			<label>
		    	<input type="checkbox" ng-model="order.shippingData.useMyDataStatus" ng-disabled="!shippingDataCompleted" ng-change="changeUseAccountDataStatus()">
		    	Usar los datos de mi cuenta
		  	</label>
			<!-- tooltip -->
			<div id="shipping-data-checkbox-tooltip" ng-if="!shippingDataCompleted">
    			<div class="arrow-up-info"> 
    			</div>
	    		<div class="farma-tooltip-info">
	    			<span>Para poder usar este beneficio, debes completar toda tu información personal, sí quieres completarla <a href="/account/log_in">haz click</a>.</span>
	    		</div>
    		</div>
    		<!-- tooltip -->
		  	<!-- helptext -->
			<span id="helpBlock" class="help-block">Si todos los datos de tu cuenta estàn completos, podrás usarlos para el envío</span>
			<!-- helptext -->
		</div>
		<form id="shipping-data-form" name="ShippingDataForm" ng-controller="ShippingDataFormCtrl" method="post" novalidate >
			<div class="col-md-6">
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataNames.$valid && ShippingDataForm.shippingDataNames.$dirty}">
					<label for="shippingDataNames">Nombres<span class="primary-emphasis">*</span></label>
					<div ng-if="order.shippingData.useMyDataStatus">
						<input type="text" name="shippingDataNames" ng-model="order.shippingData.names" class="form-control"  id="shippingDataNames" placeholder="Ingresa tus nombres" ng-init="order.shippingData.names='<?= ( isset($shipping_data) ) ? $shipping_data->names : null ?>'" ng-maxLength="50" required>
					</div>
					<div ng-if="!order.shippingData.useMyDataStatus">
						<input type="text" name="shippingDataNames" ng-model="order.shippingData.names" class="form-control"  id="shippingDataNames" placeholder="Ingresa tus nombres" ng-init="order.shippingData.names=undefined" ng-maxLength="50" required>
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
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: Pedro Pablo</span>
					<!-- helptext -->
				</div>
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataLastNames.$valid && ShippingDataForm.shippingDataLastNames.$dirty}">
					<label for="shippingDataLastNames">Apellidos<span class="primary-emphasis">*</span></label>
					<div ng-if="order.shippingData.useMyDataStatus">
						<input type="text" name="shippingDataLastNames" ng-model="order.shippingData.lastNames" class="form-control" id="shippingDataLastNames" placeholder="Ingresea tus apellidos" ng-init="order.shippingData.lastNames='<?= ( isset($shipping_data) ) ? $shipping_data->last_names : null ?>'" ng-maxLength="50" required>
					</div>
					<div ng-if="!order.shippingData.useMyDataStatus">
						<input type="text" name="shippingDataLastNames" ng-model="order.shippingData.lastNames" class="form-control" id="shippingDataLastNames" placeholder="Ingresea tus apellidos" ng-init="order.shippingData.lastNames=undefined" ng-maxLength="50" required>
					</div>
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
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: Perez Rodriguez</span>
					<!-- helptext -->
				</div>
				
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataDoctorName.$valid && ShippingDataForm.shippingDataDoctorName.$dirty}">
					<label for="shippingDataDoctorName">Doctor que le prescribió</label>
					<input type="text" name="shippingDataDoctorName" ng-model="order.shippingData.doctorName" class="form-control" id="shippingDataDoctorName" placeholder="Ingresa el nombre de tu médico" ng-maxLength="50">
					<!-- tooltip -->
					<div ng-if="ShippingDataForm.shippingDataDoctorName.$invalid">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="ShippingDataForm.shippingDataDoctorName.$error.maxlength">El nombre de tu médico es muy extenso!</span>
						</div>
					</div>
					<!-- tooltip -->
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: Doctor Julio Rodríges</span>
					<!-- helptext -->
				</div>
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataId.$valid && ShippingDataForm.shippingDataId.$dirty}">
					<label for="shippingDataId">Número de identificación<span class="primary-emphasis">*</span></label>
					<div ng-if="order.shippingData.useMyDataStatus">
						<input type="text" name="shippingDataId" ng-model="order.shippingData.id" class="form-control" id="shippingDataId" placeholder="Ingrese su numero de identificación" ng-init="order.shippingData.id='<?= ( isset($shipping_data) ) ? $shipping_data->identification_number : null ?>'" ng-pattern="/[\d-.]/" required>
					</div>
					<div ng-if="!order.shippingData.useMyDataStatus">
						<input type="text" name="shippingDataId" ng-model="order.shippingData.id" class="form-control" id="shippingDataId" placeholder="Ingrese su numero de identificación" ng-init="order.shippingData.id=undefined" ng-pattern="/[\d-.]/" required>
					</div>
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
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: Puedes usar valores numéricos y los caractéres - .</span>
					<!-- helptext -->
				</div>
			</div>	
			<div class="col-md-6">
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataAddressLine1.$valid && ShippingDataForm.shippingDataAddressLine1.$dirty}">
					<label for="shippingDataAddressLine1">Dirección<span class="primary-emphasis">*</span></label>
					<div ng-if="order.shippingData.useMyDataStatus">
						<input type="text" name="shippingDataAddressLine1" ng-model="order.shippingData.addressLine1" class="form-control" id="shippingDataAddressLine1" placeholder="Ingresa tu dirección" ng-init="order.shippingData.addressLine1='<?= ( isset($shipping_data) ) ? $shipping_data->address_line1 : null ?>'" ng-maxLength="50" required>
					</div>
					<div ng-if="!order.shippingData.useMyDataStatus">
						<input type="text" name="shippingDataAddressLine1" ng-model="order.shippingData.addressLine1" class="form-control" id="shippingDataAddressLine1" placeholder="Ingresa tu dirección" ng-init="order.shippingData.addressLine1=undefined" ng-maxLength="50" required>
					</div>
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
					<span id="helpBlock" class="help-block">Ej: Carrera 73 # 96 - 75 apto 206</span>
					<!-- helptext -->
				</div>		
				
				<div class="form-group" ng-class="{'has-error': !ShippingDataForm.shippingDataNeighborhood.$valid && ShippingDataForm.shippingDataNeighborhood.$dirty}">
					<label for="shippingDataNeighborhood">Barrio<span class="primary-emphasis">*</span></label>
					<div ng-if="order.shippingData.useMyDataStatus">
						<input type="text" name="shippingDataNeighborhood" ng-model="order.shippingData.neighborhood" class="form-control" id="shippingDataNeighborhood" placeholder="Ingresa tu dirección" ng-init="order.shippingData.neighborhood='<?= ( isset($shipping_data) ) ? $shipping_data->neighborhood : null ?>'" ng-maxLength="50" required>
					</div>
					<div ng-if="!order.shippingData.useMyDataStatus">
						<input type="text" name="shippingDataNeighborhood" ng-model="order.shippingData.neighborhood" class="form-control" id="shippingDataNeighborhood" placeholder="Ingresa tu dirección" ng-init="order.shippingData.neighborhood=undefined" ng-maxLength="50" required>
					</div>
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
					<label for="shippingDataPhone">Teléfono de contacto<span class="primary-emphasis">*</span></label>
					<div class="input-group">
						<div class="input-group-addon">#</div>
						<div ng-if="order.shippingData.useMyDataStatus">
							<input type="text" name="shippingDataPhone" ng-model="order.shippingData.phone" class="form-control" id="shippingDataPhone" placeholder="Ingresa tu teléfono fijo" ng-init="order.shippingData.phone='<?= ( isset($shipping_data) ) ? $shipping_data->phone : null ?>'" ng-maxLength="32" ng-minLength="7" ng-pattern="/[\d-]/" required>
						</div>
						<div ng-if="!order.shippingData.useMyDataStatus">
							<input type="text" name="shippingDataPhone" ng-model="order.shippingData.phone" class="form-control" id="shippingDataPhone" placeholder="Ingresa tu teléfono fijo" ng-init="order.shippingData.phone=undefined" ng-maxLength="32" ng-minLength="7" ng-pattern="/[\d-]/" required>
						</div>
					</div>
					<!-- tooltip -->
					<div ng-if="ShippingDataForm.shippingDataPhone.$invalid && ShippingDataForm.shippingDataPhone.$dirty">
						<div class="arrow-up-error"> 
						</div>
						<div class="farma-tooltip-error">
							<span ng-if="ShippingDataForm.shippingDataPhone.$error.required && ShippingDataForm.shippingDataPhone.$dirty">Tu telefono de contacto es obligatorio!</span>
							<span ng-if="ShippingDataForm.shippingDataPhone.$error.maxlength && !ShippingDataForm.shippingDataPhone.$error.pattern && ShippingDataForm.shippingDataPhone.$dirty">Es muy extenso!</span>
							<span ng-if="ShippingDataForm.shippingDataPhone.$error.minlength && !ShippingDataForm.shippingDataPhone.$error.pattern && ShippingDataForm.shippingDataPhone.$dirty">Es muy corto, debe contener mínimo 7 dígitos</span>
							<span ng-if="ShippingDataForm.shippingDataPhone.$error.pattern">Solo se permiten valores numéricos y el caractér "-"</span>
						</div>
					</div>
					<!-- tooltip -->
					<!-- helptext -->
					<span id="helpBlock" class="help-block">Ej: (571) 6742838 ó puedes también poner tu número de celular</span>
					<!-- helptext -->
				</div>
                <div class="col-md-12 margin-bottom-5" >
                    <div class="form-group">
                        <label for="exampleInputFile">Imagen de tu prescripción</label>
                        <input type="file" id="exampleInputFile" required>
                        <p class="help-block">Sube una foto de tu orden médica.</p>
                    </div>
                </div>
                <div class="col-md-12 margin-bottom-5" >
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Ó marca aquí si deseas hacerlo al momento de la entréga
                        </label>
                    </div>
                </div>
			</div>

			<div class="col-md-12 margin-bottom-5" >
				<label for="ShippingDataNotes" >Notas</label>
				<textarea name="ShippingDataNotes" class="form-control" ng-model="order.shippingData.notes" rows="3"></textarea>
				<!-- helptext -->
					<span id="helpBlock" class="help-block">Instrucciones especiales</span>
				<!-- helptext -->
			</div>

			<div class="col-md-12" ng-mouseover="showSubmitButtonTooltip()" ng-mouseleave="hideSubmitButtonTooltip()" >
				<a class="btn btn-primary center-horizontaly pull-right" ng-click="stepCompleted( order, 'shippingData' )" ng-disabled="ShippingDataForm.$invalid">Continuar</a>
			</div>
			<div class="col-md-12" id="info-tooltip-arrow-left">
				<div class="form-group" ng-if="(!ShippingDataForm.$dirty && ShippingDataForm.$invalid) && mouseover" >
					<!-- tooltip -->
					<div class="arrow-up-info"> 
		    		</div>
		    		<div class="farma-tooltip-info">
		    			<span ng-show="ShippingDataForm.$invalid">Debes completar sin errores todos los campos obligatorios del formulario.</span>
		    			<span ng-show="!ShippingDataForm.$dirty">No haz realizado ningún cambio.</span>
		    		</div>
			    	<!-- tooltip -->
	    		</div>
    		</div>
		</form>
	</div>
</div>
