<div class="">
	<div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 primary-background">
            <div class="header-item-container">
                <div class="center-horizontaly-force header-item">
                    <i class="fa fa-phone-square fa-2x"></i><span> Linea de ventas</span>
                </div>
                <div class="center-horizontaly-force header-item">
                    <h1>606 2101</h1>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <img class="hidden-xs hidden-sm center-horizontaly" id="normal-logo" src="<?= base_url() . 'assets/images/logo/logo_virtualfarma_final.png'?>" class="img-responsive" alt="virtualfarma.com.co">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 primary-background" id="login_buttons">
            <div class="btn-group" >
                <?php if( $user_logged ):?>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        Mi cuenta <i class="fa fa-user"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/account/log_in"><i class="fa fa-cog"></i> Panel</a></li>
                        <li class="divider"></li>
                        <li><a href="/account/log_out"><i class="fa fa-sign-out"></i> Cerrar sessión</a></li>
                    </ul>
                <?php else:?>
                    <a class="btn btn-default" href="/account" role="button">Iniciar sesión <i class="fa fa-users"></i></a>
                <?php endif;?>
            </div>
        </div>
	</div>
</div>