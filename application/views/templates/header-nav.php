<header ng-controller="DevicesMenuAccordionCtrl">
	<div id="sticky-anchor"></div>
	<div class="container-fluid" id="sticky">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 no-padding">
				<div id="primary-nav">
					<nav class="navbar navbar-default">
						<div class="container-fluid">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
							<img class="hidden-md hidden-lg pull-left" id="normal-logo" src="<?= base_url() . 'assets/images/logo/logo_virtualfarma_solo_small_devices.png'?>" class="img-responsive" alt="">
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
									<li class="active"><a title="Página principal" href="/">Inicio<span class="sr-only">(current)</span></a></li>
									<li class="dropdown">
										<a href="#" title="lista de categorías" class="dropdown-toggle" role="button" aria-expanded="false">Categorias <span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu" id="categories-scroll">
											<?php foreach ($categories as $category):?>
												<li>
													<a href="<?= "/product/show_products_by_category/" . lcfirst(str_replace(array(' '), '_', $category->name))?>"><?= $category->name?></a>
												</li>
												<li class="divider"></li>
											<?php endforeach;?>	
										</ul>
									</li>
									<li><a href="/product/show_products_by_category/sex_shop" title="Todo lo que necesitas" >Sex shop</a></li>
								</ul>
							</div><!-- /.navbar-collapse -->
						</div><!-- /.container-fluid -->
					</nav>
  				</div>
			</div>
		</div>
        <div class="row" id="search-nav">
            <div class="col-md-6 col-md-offset-3">
                <div id="search-container">
                    <form name="searchProductForm" class="search-form" role="search" action="<?= base_url() . 'product/search_product'?>" method="post">
                        <div id="search-module" class="pull-left">
                            <input popover-placement="top" popover="Escríbe aquí el nombre del producto que deseas!"  popover-trigger="focus" type="text" name="productName" id="productName" ng-change="search( productNameToSearch )" ng-model="productNameToSearch" ng-model="productNameToSearch" class="form-control" placeholder="Busca aquí tus productos" required="required">
                            <!--<span for="productName" class="form-control-feedback"><i class="fa fa-search"></i></span>-->
                        </div><!-- /input-group -->
                        <input id="vf-button" class="pull-left" type="image" src="<?= base_url() . 'assets/images/logo/button.jpg'?>">
                    </form>
                </div>
            </div>

        </div>
	</div>
</header>