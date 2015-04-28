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
			<div class="header-item"><i class="fa fa-phone-square fa-2x"></i><span> +420 123 456 789</span></div>
        </div>
		<div class="btn-group pull-right">
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