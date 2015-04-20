<header ng-controller="DevicesMenuAccordionCtrl">
	<div id="sticky-anchor"></div>
	<div class="container" id="sticky">
		<div class="row">
			<div class="col-md-4" >
				<div id="logo" class="pull-left">
					<img class="hidden-xs hidden-sm" id="normal-logo" src="<?= base_url() . 'assets/images/logo/logo_virtualfarma_small.png'?>" class="img-responsive" alt="Fuck you !">
					<img class="hidden" id="logo-for-sticky" src="<?= base_url() . 'assets/images/logo/logo_virtualfarma_small_alone.png'?>" class="img-responsive" alt="Fuck you !">
				</div>
			</div>
			<div class="col-md-8 no-padding">
				<div id="primary-nav">
					<nav class="navbar navbar-default">
						<div class="container-fluid">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="#">
									<i class="fa fa-cart-plus"></i>
								</a>
							</div>
					
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav">
									<li class="active"><a href="/">Inicio<span class="sr-only">(current)</span></a></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Categorias <span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu">
											<?php foreach ($categories as $category):?>
												<li>
													<a href="<?= "/product/show_products_by_category/" . lcfirst(str_replace(array(' '), '_', $category->name))?>"><?= $category->name?></a>
												</li>
												<li class="divider"></li>
											<?php endforeach;?>	
										</ul>
									</li>
									<li><a href="#" title="Próximamente" >Ofertas</a></li>
								</ul>
								<form class="navbar-form navbar-right search-form" role="search">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Busca aquí tus productos">
										<span class="input-group-btn">
											<button class="btn btn-default" type="button">Buscar</button>
										</span>
									</div><!-- /input-group -->
								</form>
							</div><!-- /.navbar-collapse -->
						</div><!-- /.container-fluid -->
					</nav>
  				</div>
			</div>
		</div>
	</div>
</header>