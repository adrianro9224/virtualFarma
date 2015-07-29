<div ng-controller="MyDiagnosticCtrl">
	<div class="row">
		<div class="col-md-8">
			<p class="bg-info">
				Acá podras crear tu "historía clínica"
			</p>
		</div>
	</div>
    <div class="row" id="pathology-section">
        <div class="col-md-6">
            <div class="loading" ng-if="processingPathologyRequest"><i class="fa fa-refresh fa-spin"></i></div>
            <div class="well">
                <form id="my-diagnostic-form"  name="myDiagnosticForm" action="<?= base_url() . 'account/update_account/' . $user_logged_account->id ?>" method="post" novalidate autocomplete="off">
                    <article>
                        Aquí encontrarás todo tipo de antecedentes clínicos (quirurgicos, patologías), para agregarlas solo haz click sobre ellas.
                    </article>
                    <input ng-disabled="!pathologiesCharged" popover-placement="top" popover="Escríbe aquí el nombre de la patología que quieres buscar!"  popover-trigger="focus" type="text" name="pathologyName" id="pathologyName" ng-change="search( pathologyNameToSearch, myDiagnosticForm.pathologyName.$valid )" ng-model="pathologyNameToSearch" class="form-control" placeholder="{{searchPathologyPlaceHolder}}" required="required">
                </form>

                <div id="showing-pathologies">

                    <table class="table table-condensed table-hover table-striped">
                        <thead>
                        </thead>
                        <tbody >
                        <tr ng-repeat="pathology in results" ng-click="addPathology( pathology.id )" class="handy">
                            <td ><span ng-bind="pathology.name" ></span></td>
                        </tr>
                        <tr ng-if="results.length == 0">
                            <td><span>No se encontró ninguna coincidencia</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="loading" ng-if="processingPathologyRequest"><i class="fa fa-refresh fa-spin"></i></div>
            <div class="well">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group" >
                            <label for="userFirstName">Mi historial clínico:</label>
                            <p class="bg-primary" ng-if="panelDirty" ng-bind="infoStatusText"><i class="fa fa-refresh fa-spin"></i></p>
                            <article ng-if="userPathologiesCharged && !pathologiesEmpty">
                                <h3>Patologías registrádas:</h3>
                                <a class="pathology-btn" ng-repeat="userPathology in userPathologies">{{userPathology.name}} <i class="fa fa-times" ng-click="removePathology( userPathology.id )"></i></a>
                            </article>
                            <article>
                                <p ng-if="!userPathologiesCharged" class="text-warning"><i class="fa fa-refresh fa-spin"></i> Cargando patologías ...</p>
                                <p ng-if="pathologiesEmpty" class="text-warning"></i>No tienes patologías registrádas</p>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
