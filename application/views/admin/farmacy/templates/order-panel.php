<?php if( isset($orders) ):?>
	<table class="table table-condensed ">
		<thead>
			<tr>
				<th>Id</th>
				<th>Destinatario</th>
				<th>Dirección de destino</th>
				<th>Barrio</th>
				<th>Notas</th>
				<th>Estado</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $orders as $order ):?>
			<tr ng-class="{'success' : '<?= $order->status?>' == 'RECEIVED', 'info' : '<?= $order->status?>' == 'SENDED', 'danger' : '<?= $order->status?>' == 'DECLINED'}" >
				<td><?= $order->id?></td>
				<td><?= $order->names . ' ' . $order->last_names?></td>
				<td><?= $order->address_line?></td>
				<td><?= $order->neighborhood?></td>
				<td>
				<?php if ( isset($order->note) ):?>
					<?= $order->note?>
				<?php else:?>
					<em>Sin notas</em>
				<?php endif;?>
				</td>
				<td><?= $order->status?></td>
				<td>
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					Opciones<i class="fa fa-user"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/account/log_in"><i class="fa fa-cog"></i> Panel</a></li>
					<li class="divider"></li>
					<li><a href="/account/log_out"><i class="fa fa-sign-out"></i> Cerrar sessión</a></li>
				</ul>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
<?php else:?>
	<p class="bg-warning">No hay ordenes</p>
<?php endif;?>