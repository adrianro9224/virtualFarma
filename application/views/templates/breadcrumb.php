<div class="col-md-12">
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<h2><?= $breadcrumb->title?></h2><span> <?php if ( isset($breadcrumb->sub_title) ) echo ': ' . str_replace( '_', ' ', $breadcrumb->sub_title );?></span>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<?php if( isset($shoppingcart) ): ?>
			<a id="button-payment" class="btn btn-primary" href="/checkout" role="button" ng-disabled="<?= ($shoppingcart->subtotal < $shoppingcart->minimumOrderValue) ? 1 : 0 ;?>"><i class="fa fa-credit-card"></i> Ir a pagar</a>
		<?php endif;?>
	</div>
	<div class="col-lg-4 col-md-4 hidden-sm hidden-xs">
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