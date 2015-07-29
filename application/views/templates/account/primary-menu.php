<div class="row" id="my-account-options-banner">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
		<div class="btn-group" role="group">
    		<button type="button" class="btn btn-default" ng-click="openSection('myAccount')" ng-class="{active: myAccountSelected}">
    			<i class="fa fa-user"></i>
    			Mi cuenta
    		</button>
  		</div>
	  	<div class="btn-group" role="group">
	    	<button type="button" class="btn btn-default" ng-click="openSection('myPurchases')" ng-class="{active: myPurchasesSelected}">
	    		<i class="fa fa-folder"></i>
	    		Mis compras
	    	</button>
	  	</div>
  		<div class="btn-group hidden-xs" role="group">
		    <button type="button" class="btn btn-default" ng-click="openSection('myDiagnostic')" ng-class="{active: myDiagnosticSelected}">
				<i class="fa fa-list-alt"></i>
			    Mi diagnóstico
		    </button>
	  	</div>
	</div>
</div>
