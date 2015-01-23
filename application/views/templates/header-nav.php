<header ng-controller="DevicesMenuAccordionCtrl">
	<div id="sticky-anchor-s-devices"></div>
	<div class="hidden-lg hidden-md">
		<div id="device-menu-button">
			<button type="button" class="btn btn-default btn-lg" ng-click="activeMenu()">
				<span class="glyphicon glyphicon-list"></span>
			</button>
		</div>
		<div id="device-menu" ng-if="menuStatus">
			<div class="list-group">
				<a href="#" class="list-group-item active">
				    Categorias
				</a>
				<a href="#" class="list-group-item">Dapibus ac facilisis in</a>
				<a href="#" class="list-group-item">Morbi leo risus</a>
				<a href="#" class="list-group-item">Porta ac consectetur ac</a>
				<a href="#" class="list-group-item">Vestibulum at eros</a>
			</div>
		</div>
	</div>
	<div id="sticky-anchor"></div>
	<div class="container hidden-sm hidden-xs" id="sticky">
		<div class="row">
			<div id="logo" class="pull-left">
				<img class="hidden-xs hidden-sm" id="normal-logo" src="<?= base_url() . 'assets/images/logo/logo_virtualfarma_small.png'?>" class="img-responsive" alt="Fuck you !">
				<img class="hidden" id="logo-for-sticky" src="<?= base_url() . 'assets/images/logo/logo_virtualfarma_small_alone.png'?>" class="img-responsive" alt="Fuck you !">
			</div>
			<div class="pull-right" id="primary-nav">
		    	<ul class="nav nav-pills">
		      		<li role="presentation" class="active"><a href="/">Home</a></li>
			     	<li role="presentation" class="dropdown" >
			     	    <div dropdown is-open="status.isopen">
							<a type="button" class="dropdown-toggle" ng-disabled="disabled">
								Categorías <span class="glyphicon glyphicon-chevron-down"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
							<?php foreach ($categories as $category):?>
								<li><a href="<?= "/product/show_products_by_category/" . lcfirst(str_replace(' ', '_', $category->name))?>"><?= $category->name?></a></li>
								<li class="divider"></li>
							<?php endforeach;?>	
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div>
  					</li>			    
				    <li role="presentation"><a href="#">Servicios</a></li>
				    <li role="presentation"><a href="#">Tratamientos</a></li>				    
				    <li role="presentation" class="disabled"><a href="#">Acerca de nosotros</a></li>
				    <li role="presentation" class="dropdown">
						<form class="search" method="get" action="search.html">
							<input type="text" class="form-control" name="s" value="" placeholder="Search">
							<button class="fa fa-search"></button>
						</form>			        
				    </li>
		    	</ul>
	    	</div>
  		</div>
	</div>
</header>