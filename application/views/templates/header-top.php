<div class="container">
	<div class="row ">
	<!-- When the user is logged -->
<!-- 			<div class="pull-right"> -->
<!-- 				<div class="link"> -->
<!-- 					<span class="glyphicon glyphicon-user"></span> -->
<!-- 					<a>Sign in</a> -->
<!-- 				</div> -->
<!-- 			</div> -->
		<div class="pull-left">
            	<div class="header-item"><i class="fa fa-envelope"></i> info@pixlized.cz</div>
                <div class="header-item"><i class="fa fa-phone"></i> +420 123 456 789</div>
        </div>
		<div class="btn-group pull-right">
			<?php if( $user_logged ):?>
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					Mi cuenta <span class="glyphicon glyphicon-user"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/account/log_in">Panel</a></li>
					<li class="divider"></li>
					<li><a href="/account/log_out">Cerrar sessión</a></li>
				</ul>
			<?php else:?>
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					Iniciar sesión <span class="glyphicon glyphicon-user"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/account">Iniciar sesión</a></li>
					<li class="divider"></li>
					<li><a href="/account">Registrarse</a></li>
				</ul>
			<?php endif;?>
		</div>
	</div>
	
</div>