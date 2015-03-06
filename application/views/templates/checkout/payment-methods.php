<div class="panel panel-default" id="payment-method-accordion">
	<div class="panel-heading handy" ng-init="order.paymentMethod.status = false" ng-click="openSection('paymentMethod')" ng-class="{'disabled-panel-heading' : !paymentMethod && !order.paymentMethod.status}">
		<h4>Método de pago <span ng-show="paymentMethodComplete" class="glyphicon glyphicon-ok" aria-hidden="true"></h4> 
	</div>
	<div class="panel-body" ng-if="paymentMethod" >
		<p>Por favor, seleccione el método de envío preferido para usar en esta orden.
		Todas las transacciones son seguras y cifradas, Para obtener más información, por favor ver nuestra política de privacidad.</p>
		
		<accordion close-others="oneAtATime">
			<?php foreach ( $payment_methods as $payment_method ):?>
			    <accordion-group is-open="status.open<?= $payment_method->id?>">
			        <accordion-heading>
			           <?= $payment_method->name?><i class="pull-right glyphicon" ng-class="{'glyphicon-chevron-down': status.open<?= $payment_method->id?>, 'glyphicon-chevron-right': !status.open<?= $payment_method->id?>}"></i>
			        </accordion-heading>
			        <div id="payment-method-description">
			        	<?= $payment_method->description?>
			        </div>
			        <div class="checkbox">
						<label>
					    	<input type="radio" ng-model="order.paymentMethod.selectedPaymentMethod" ng-value="<?= $payment_method->id?>" required>
					    	<?= $payment_method->name?>
					  	</label>
						<!-- tooltip start-->
						<div id="shipping-data-checkbox-tooltip" ng-if="!paymentMethodSelected">
			    			<div class="arrow-up-info"> 
			    			</div>
				    		<div class="farma-tooltip-info">
				    			<span>No has seleccionado <?= $payment_method->name?> como tu medio de pago.</span>
				    		</div>
			    		</div>
			    		<!-- tooltip over -->
			    		<?php if( isset($payment_method->help_text) ):?>
						  	<!-- helptext -->
							<span id="helpBlock" class="help-block"><?= $payment_method->help_text?></span>
							<!-- helptext -->
						<?php endif;?>
					</div>
					<a class="btn btn-warning center-horizontaly pull-right" ng-click="stepCompleted( order, 'paymentMethod' )" ng-disabled="ShippingDataForm.$invalid">Continuar</a>
			    </accordion-group>
			 <?php endforeach;?>
 		 </accordion>
	</div>
</div>
