 <div class="container">
	<div class="row">
        <div class="col-md-6">
            <?php if( (isset($type_of_admin)) && (isset($account_types)) ):?>
                <?php if ( $type_of_admin == $account_types[2] ):?>
                    <div class="checkbox pull-right">
                        <label>
                            <input type="checkbox" name="orderManual" ng-model="orderManual" ng-change="changeToOrderManualMode( orderManual )"> Orden con productos no existentes
                        </label>
                    </div>
                <?php endif;?>
            <?php endif;?>
        </div>
        <div class="col-md-6">
            <div class="btn-group pull-right">
            <?php if( (isset($type_of_admin)) && (isset($account_types)) ):?>
                <?php if ( $type_of_admin == $account_types[2] ):?>
                    <a class="btn btn-default" ng-click="doNewOrder()" role="button">Iniciar nueva orden </span></a>
                <?php endif;?>
                <?php if ( $type_of_admin == $account_types[0] || $type_of_admin == $account_types[2] || $type_of_admin == $account_types[3] || $type_of_admin == $account_types[4] ):?>

                    <a class="btn btn-default" href="/admin/log_out" >Cerrar sesion <span class="glyphicon glyphicon-user"></span></a>
                <?php endif;?>
            <?php endif;?>
            </div>
        </div>
	</div>
</div>