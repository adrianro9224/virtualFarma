<?php if( isset($orders) ):?>
	<?php foreach ( $orders as $order ):?>
		<div class="panel panel-default hidden" id="order_<?= $order->id?>">
			<!-- Default panel contents -->
			<div class="panel-heading"><h3>Orden: <?= $order->id?> <i class="fa fa-times-circle-o pull-right handy" ng-click="closeOrderDetails( '<?= $order->id?>' )" ></i></h3></div>
			<div class="panel-body">
				<p><strong>Notas:</strong> 
					<?php if ( isset($order->note) ):?>
					<?= $order->note?>
					<?php else:?>
					<em>Sin notas</em>
					<?php endif;?>
				</p>
				<p><strong>Destinatario:</strong> 
					<?= $order->names . ' ' . $order->last_names?>
				</p>
			</div>
			<!-- Table -->
			<table class="table table-striped">
				<thead>
					<tr>
					  <th>#</th>
                      <th>P.L.U</th>
					  <th>Producto</th>
					  <th>Descripción</th>
					  <th>IVA</th>
					  <th>Precio Unit</th>
					  <th>Cantidad</th>
					  <th>Total</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ( json_decode($order->products) as $key=>$product ):?>
					<tr>
					  <th><?= $key + 1?></th>
                      <td><?= $product->PLU?></td>
					  <td><?= $product->name?></td>
					  <td><?= $product->presentation?></td>
					  <td><?= $product->tax?></td>
					  <td><?= $product->price?></td>
					  <td><?= $product->cant?></td>
					  <td><?= bcmul($product->cant, $product->price)?></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		</div>			
	<?php endforeach;?>
	<hr>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Recibido a las</th>
				<th>Valor</th>
				<th>Costo de envío</th>
				<th>Dirección de destino</th>
				<th>Barrio</th>
				<th>Notas</th>
				<th>Estado</th>
				<th>Marcar como</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $orders as $key=>$order ):?>
			<tr ng-click="openOrderDetails( '<?= $order->id?>' )"  ng-mouseover="identifyOrderPanel( '<?= $order->id?>' )"  ng-mouseleave="identifyOrderPanel( '<?= $order->id?>' )" class="handy" ng-class="{'success' : '<?= $order->status?>' == 'RECEIVED', 'info' : '<?= $order->status?>' == 'SENDED', 'danger' : '<?= $order->status?>' == 'DECLINED'}" >
				<td><?= $order->id?></td>
				<td><?= $order->send_date?></td>
				<td><?= $order->value?></td>
				<td><?= $order->shipping_charge?></td>
				<td><?= $order->address_line?></td>
				<td><?= $order->neighborhood?></td>
				<td>
				<?php if ( isset($order->note) ):?>
					<?= $order->note?>
				<?php else:?>
					<em>Sin notas</em>
				<?php endif;?>
				</td>
				<td>
					<?php if($order->status == 'RECEIVED'):?>
						Nueva orden
					<?php endif;?>
					<?php if($order->status == 'SENDED'):?>
						Orden enviada
					<?php endif;?>
					<?php if($order->status == 'DECLINED'):?>
						Orden rechazada
					<?php endif;?>
				</td>
				<td>
					<a class="btn btn-warning btn-xs" ng-click="markOrderLikeSended( '<?= $order->id?>' )" ng-disabled="UpdatingOrderToSended || ('<?= $order->status?>' == 'SENDED') || ('<?= $order->status?>' == 'DECLINED')">
						Enviado <i class="fa fa-paper-plane-o"></i>
					</a>
					<a class="btn btn-danger btn-xs" ng-click="markOrderLikeDeclined( '<?= $order->id?>' )" ng-disabled="UpdatingOrderToSended || ('<?= $order->status?>' == 'DECLINED')">
						Rechazado <i class="fa fa-recycle"></i>
					</a>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
<?php else:?>
	<p class="bg-warning">No hay ordenes</p>
<?php endif;?>