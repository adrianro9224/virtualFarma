<h2><?= $breadcrumb->title?></h2>
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
