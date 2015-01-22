<div class="row" id="my-account-options-banner">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
		<div class="btn-group" role="group">
    		<button type="button" class="btn btn-default" ng-click="openSection('myAccount')" ng-class="{active: myAccountSelected}">
    			<span class="glyphicon glyphicon-user"></span>
    			Mi cuenta
    		</button>
  		</div>
	  	<div class="btn-group" role="group">
	    	<button type="button" class="btn btn-default" ng-click="openSection('myPurchases')" ng-class="{active: myPurchasesSelected}">
	    		<span class="glyphicon glyphicon-folder-open"></span>
	    		Mis compras
	    	</button>
	  	</div>
  		<div class="btn-group" role="group">
		    <button type="button" class="btn btn-default" ng-click="openSection('myDiagnostic')" ng-class="{active: myDiagnosticSelected}">
				<span class="glyphicon glyphicon-list-alt"></span>
			    Mi diagnóstico
		    </button>
	  	</div>
	</div>
</div>
