<?php if(isset($notifications)):?>
	<div ng-controller="NotificationsCtrl" >
		<?php if($notifications):?>
			<?php foreach ($notifications as $key=>$notification):?>
				<?php if( is_array($notification) ): ?>
						<?php
							$type = $key;  
							foreach ($notification as $key=>$same_type_notification):?>
							<div id="<?= $type . $key?>" >
								<button type="button" class="close" ng-click="close('<?= $type . $key?>')">
									<span aria-hidden="true">&times;</span>
								</button>			
								<p class="<?= 'bg-' . $type ?>">
									<?= $same_type_notification?>
								</p>
							</div>
						<?php endforeach;?>
				<?php else:?>
						<div id="<?= $key ?>" >
							<button type="button" class="close" ng-click="close('<?= $key ?>')">
								<span aria-hidden="true">&times;</span>
							</button>			
							<p class="<?= 'bg-' . $key ?>">
								<?= $notification?>
							</p>
						</div>
				<?php endif;?>
			<?php endforeach;?>
		<?php endif;?>
	</div>	
<?php endif;?>	