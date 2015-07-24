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
            <div class="loading" ng-if="addingPathology"><i class="fa fa-refresh fa-spin"></i></div>
            <div class="well">
                <form id="my-diagnostic-form"  name="myDiagnosticForm" action="<?= base_url() . 'account/update_account/' . $user_logged_account->id ?>" method="post" novalidate autocomplete="off">
                    <article>
                        Aquí encontrarás todo tipo de antecedentes clínicos (quirurgicos, patologías)
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
            <div class="well">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group" >
                            <label for="userFirstName">Mi historial clínico:</label>
                            <p class="text-{{typeOfinfo}}" ng-bind="infoStatusText"><i class="fa fa-refresh fa-spin"></i></p>
                            <article ng-if="userPathologiesCharged">
                                <p class="text-info">Patologías registrádas:</p>
                                <a class="btn btn-warning" ng-repeat="userPathology in userPathologies">{{userPathology.name}}<i class="fa fa-times"></i></a>
                            </article>
                            <article ng-if="!userPathologiesCharged">
                                <p class="text-warning"><i class="fa fa-refresh fa-spin"></i>No tienes patologías registrádas</p>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
