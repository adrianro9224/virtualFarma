<div class="panel panel-default">
	<!-- Default panel contents -->	
	<div class="panel-heading">
		<h3><i class="fa fa-user-md"></i> Categorias</h3>
	</div>
	<div class="panel-body" >
		<p>...</p>
	</div>

	<!-- List group -->
	<ul class="list-group" id="left-sidebar-categories-list">
		<?php foreach( $categories as $category ): ?>
			<li class="list-group-item no-padding">
				<a href=<?= "/product/show_products_by_category/" . lcfirst(str_replace(' ', '_', $category->name))?> >
					<?= $category->name?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>	
