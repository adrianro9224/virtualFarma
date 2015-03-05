<div class="panel panel-default">
	<div class="panel-heading handy" ng-click="openSection('paymentMethod')" ng-class="{'disabled-panel-heading' : !paymentMethod && paymentMethodComplete}">
		<h4>Método de pago <span ng-show="paymentMethodComplete" class="glyphicon glyphicon-ok" aria-hidden="true"></h4> 
	</div>
	<div class="panel-body" ng-if="paymentMethod">
		<p>Por favor, seleccione el método de envío preferido para usar en esta orden.
		Todas las transacciones son seguras y cifradas, Para obtener más información, por favor ver nuestra política de privacidad.</p>
		
		<accordion close-others="oneAtATime">
		    <accordion-group is-open="status.open">
		        <accordion-heading>
		            I can have markup, too! <i class="pull-right glyphicon" ng-class="{'glyphicon-chevron-down': status.open, 'glyphicon-chevron-right': !status.open}"></i>
		        </accordion-heading>
		        This is just some content to illustrate fancy headings.
		    </accordion-group>
 		 </accordion>
		
	</div>
</div>
