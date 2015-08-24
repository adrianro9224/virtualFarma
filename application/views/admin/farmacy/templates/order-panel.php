<?php if( isset($orders) ):?>
	<?php foreach ( $orders as $order ):?>
		<div class="panel panel-default hidden" id="order_<?= $order->orderid?>">
			<!-- Default panel contents -->
			<div class="panel-heading"><h3>Orden: <?= $order->orderid?> <i class="fa fa-times-circle-o pull-right handy" ng-click="closeOrderDetails( '<?= $order->orderid?>' )" ></i></h3></div>
			<div class="panel-body">
                <p><strong>Código farmacia de origen:</strong>
                    <?php if ( isset($order->nearby_id) ):?>
                        <?= $order->nearby_id?>
                        <?php switch( $order->nearby_id ):
                             case'0':?>
                                <em>Galerias</em>
                            <?php break;?>
                            <?php case'1':?>
                                <em>Campín</em>
                            <?php break;?>
                            <?php case'2':?>
                                <em>Porciúncula</em>
                            <?php break;?>
                            <?php case'3':?>
                                <em>Andes</em>
                            <?php break;?>
                            <?php case'4':?>
                                <em>Castellana</em>
                            <?php break;?>
                        <?php endswitch;?>
                    <?php else:?>
                        <em>Orden sin nerby_id</em>
                    <?php endif;?>
                </p>
                <p><strong>Método de pago:</strong>
                    <?php if ( isset($order->payment_method_id) ):?>
                        <?php switch( $order->payment_method_id ):
                            case'3':?>
                                <em>Efectivo</em>
                                <?php break;?>
                            <?php case'4':?>
                                <em>Tarjeta Débito ó Crédito</em>
                                <?php break;?>
                            <?php default:?>
                                <em>No especificado</em>
                            <?php break;?>
                            <?php endswitch;?>
                    <?php else:?>
                        <em>Orden sin nerby_id</em>
                    <?php endif;?>
                </p>
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
                <p><strong>Teléfono:</strong>
                    <?= $order->phone?>
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
                      <td><?php
                          if(isset($product->PLU))
                            echo $product->PLU;
                          else
                            echo "PLU desc";
                          ?></td>
					  <td><?php
                          if(isset($product->name))
                            echo $product->name;
                          else
                          echo "Nombre desc"
                          ?></td>
					  <td><?php
                          if( isset($product->presentation) )
                            echo $product->presentation;
                          else
                            echo "Presentación desc";
                          ?></td>
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
			<tr ng-click="openOrderDetails( '<?= $order->orderid?>' )"  ng-mouseover="identifyOrderPanel( '<?= $order->orderid?>' )"  ng-mouseleave="identifyOrderPanel( '<?= $order->orderid?>' )" class="handy" ng-class="{'success' : '<?= $order->status?>' == 'RECEIVED', 'info' : '<?= $order->status?>' == 'SENDED', 'danger' : '<?= $order->status?>' == 'DECLINED'}" >
				<td><?= $order->orderid?></td>
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
					<a class="btn btn-warning btn-xs" ng-click="markOrderLikeSended( '<?= $order->orderid?>' )" ng-disabled="UpdatingOrderToSended || ('<?= $order->status?>' == 'SENDED') || ('<?= $order->status?>' == 'DECLINED')">
						Enviado <i class="fa fa-paper-plane-o"></i>
					</a>
					<a class="btn btn-danger btn-xs" ng-click="markOrderLikeDeclined( '<?= $order->orderid?>' )" ng-disabled="UpdatingOrderToSended || ('<?= $order->status?>' == 'DECLINED')">
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