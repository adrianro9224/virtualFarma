<div class="col-md-12">
	<div class="col-lg-4 col-md-8 col-sm-8 hidden-xs hidden-sm hidden-md">
		<h2><?= $breadcrumb->title?></h2>
	</div>
	<div class="col-md-4">
	<?php if( isset($shoppingcart) ):?>
		<a id="button-payment" class="btn btn-default center-horizontaly" ng-click="createShoppingcartToken(shoppingcart)" role="button">Ir a pagar</a>
	<?php endif;?>
	</div>
	<div class="col-lg-4 col-md-8 col-sm-8">
		<ol class="breadcrumb">
			<li><a href="/">Inicio</a></li>
			<?php foreach ($breadcrumb->items as $breadcrumb_item):?>
				<?php if(!$breadcrumb_item->active):?>
					<li><a href="<?= $breadcrumb_item->url?>"><?= $breadcrumb_item->name?></a></li>
				<?php else:?>
					<li class="active"><?= $breadcrumb_item->name?></li>
				<?php endif;?>
			<?php endforeach;?>	
		</ol>
	</div>
</div>