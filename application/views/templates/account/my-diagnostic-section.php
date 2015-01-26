<div ng-controller="MyDiagnosticCtrl">
	<div class="row">
		<div class="col-md-8">
			<p class="bg-info">
				Acá podras crear tu "historía clínica"
			</p>
		</div>
	</div>
	
	<div class="well">
		<form id="my-diagnostic-form"  name="myDiagnosticForm" action="<?= base_url() . 'account/update_account/' . $user_logged_account->id ?>" method="post" novalidate autocomplete="off">
			<div class="form-group" >
				<label for="userFirstName">Mis enfermedades:</label>
				<?php if( isset($pathologies) ):?>
					<?php foreach ($pathologies as $phatology): ?>
						<a class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>
					<?php endforeach;?>
				<?php else:?>
						<p class="text-warning">No tienes enfermedades registrádas</p>
				<?php endif;?>				
			</div>
			<div class="dropdown">
				<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" >
					Enfermedades
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					<?php foreach ($categories as $phatology_info):?>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?= $phatology_info->name?></a></li>
					<?php endforeach;?>
				</ul>
			</div>
		</form>
	</div>
</div>
