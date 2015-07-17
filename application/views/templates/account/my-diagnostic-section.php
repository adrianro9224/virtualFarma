<div ng-controller="MyDiagnosticCtrl">
	<div class="row">
		<div class="col-md-8">
			<p class="bg-info">
				Acá podras crear tu "historía clínica"
			</p>
		</div>
	</div>
    <div class="row">
        <div class="col-md-6">
            <div class="well">
                <form id="my-diagnostic-form"  name="myDiagnosticForm" action="<?= base_url() . 'account/update_account/' . $user_logged_account->id ?>" method="post" novalidate autocomplete="off">
                    <article>
                        Aquí encontrarás todo tipo de antecedentes clínicos (quirurgicos, patologías)
                    </article>
                    <input ng-disabled="!pathologiesCharged" popover-placement="top" popover="Escríbe aquí el nombre de la patología que quieres buscar!"  popover-trigger="focus" type="text" name="pathologyName" id="pathologyName" ng-change="search( pathologyNameToSearch, myDiagnosticForm.pathologyName.$valid )" ng-model="pathologyNameToSearch" class="form-control" placeholder="Buscar patología" required="required">
                </form>
                <table class="table table-condensed table-hover table-striped" ng-if="results.length != 0">
                    <thead>
                    </thead>
                    <tbody >
                    <tr ng-repeat="pathology in results">
                        <td ><a href=""  ng-bind="pathology.name"></a></td>
                    </tr>
                    <tr ng-if="!results">
                        <td>No se encontró ninguna coincidencia</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="well">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group" >
                            <label for="userFirstName">Mi historial clínico:</label>
                            <?php if( isset($pathologies->account_pathologies) ):?>
                                <?php foreach ($pathologies->account_pathologies as $phatology): ?>
                                    <a class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>
                                <?php endforeach;?>
                            <?php else:?>
                                <p class="text-warning">No tienes antecedentes ni patologías registrádas</p>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
