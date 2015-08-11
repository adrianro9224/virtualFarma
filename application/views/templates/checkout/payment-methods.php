<div class="panel panel-default" id="payment-method-accordion" ng-hide="order.sended">
	<div class="panel-heading handy" ng-click="openSection('paymentMethod')" ng-class="{'disabled-panel-heading' : !paymentMethod && !order.paymentMethod.status}">
		<h4><i class="fa fa-money"></i> Paso 2: método de pago <i ng-show="order.paymentMethod.status" class="fa fa-check" > Completado</i></h4>
	</div>
	<div class="panel-body" ng-if="paymentMethod" >
		<p>Por favor, seleccione el método de envío preferido para usar en esta orden.
		Todas las transacciones son seguras y cifradas, Para obtener más información, por favor ver nuestra política de privacidad.</p>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><i class="fa fa-motorcycle"></i> Pago contra entrega</h4>
            </div>
            <div class="panel-body">
                <!-- helptext -->
                <span id="helpBlock" class="help-block">Elige el medio de pago de tu preferencia.</span>
                <!-- helptext -->
                    <form id="payment-method-form" name="PaymentMethodForm" novalidate>
                        <?php foreach ( $payment_methods as $payment_method ):?>
                        <div class="checkbox">
                            <label>
                                <input type="radio" name="paymentMethod" ng-model="order.paymentMethod.selectedPaymentMethod" ng-value="<?= $payment_method->id?>" required>
                                <?= $payment_method->name?>
                            </label>
                            <?php if( isset($payment_method->help_text) ):?>
                                <!-- helptext -->
                                <span id="helpBlock" class="help-block"><?= $payment_method->help_text?></span>
                                <!-- helptext -->
                            <?php endif;?>
                        </div>
                        <?php endforeach; ?>
                        <a class="btn btn-warning center-horizontaly pull-right" ng-click="stepCompleted( order, 'paymentMethod' )" ng-disabled="PaymentMethodForm.$invalid">Continuar</a>
                    </form>

            </div>
        </div>
	</div>
</div>
