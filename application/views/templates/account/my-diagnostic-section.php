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
                    <div class="dropdown">
                        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" >
                            Enfermedades
                            <span class="caret"></span>
                        </button>
                        <ul id="pathologies-dropdown" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1" >
                            <?php foreach ($pathologies->dropdown_items_ids as $id=>$phatology_info):?>
                                <li role="presentation"><a role="menuitem" tabindex="-1" ng-click="showPhatologyDescription('<?= $id?>')"><?= $phatology_info->name?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </form>
                <?php foreach ($pathologies->dropdown_items_ids as $id=>$phatology_info):?>
                    <div id="<?= $id?>" class="row hidden pathology-description-well">
                        <div class="col-md-offset-2 col-md-9">
                            <button id="close-button-patholigy-description" type="button" class="close" ng-click="closePhatologyDescription('<?= $id?>')">
                                <span class="glyphicon glyphicon-remove"></span>
                            </button>
                            <p class="bg-primary pathology-description-well-title"><?= $phatology_info->name?></p>
                            <p class="bg-primary pathology-description-well-content">
                                <?= $phatology_info->name?>
                            </p>

                        </div>
                    </div>
                <?php endforeach;?>
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
