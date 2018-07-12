<?php
	$devices = $Sonoff->getDevices();
?>
<div class='container-fluid'>


	<?php if ( isset( $devices ) && !empty( $devices ) ): ?>
		<div class='row justify-content-center startpage'>
			<?php foreach ( $devices as $device_group ): ?>
				<?php foreach ( $device_group->names as $key => $devicename ): ?>
					<?php
					$img = _RESOURCESURL_."img/device_icons/".$device_group->img."_off.png";
					?>
					<div class='card-holder col-6 col-sm-3 col-md-2 col-xl-1 mb-4'>
						<div class='card box_device position-relative' style=''
						     data-device_id='<?php echo $device_group->id; ?>'
						     data-device_group='<?php echo count( $device_group->names ) > 1 ? "multi" : "single"; ?>'
						     data-device_ip='<?php echo $device_group->ip; ?>'
						     data-device_relais='<?php echo $key + 1; ?>'
						>
							<div class="animated rubberBand">
								<img class='card-img-top'
								     data-icon='<?php echo $device_group->img; ?>'
								     src='<?php echo $img; ?>'
								     alt=''>
							</div>
							<div class='info-holder'>
								<div class='info info-1 hidden'><span>-</span></div>
								<div class='info info-2 hidden'><span>-</span></div>
								<div class='info info-3 hidden'><span>-</span></div>
								<div class='info info-4 hidden'><span>-</span></div>
								<div class='info info-5 hidden'><span>-</span></div>
								<div class='info info-6 hidden'><span>-</span></div>
							</div>
							<div class='card-text box_device_name'>
								<?php echo $devicename; ?>
							</div>
						</div>
					</div>
				<?php endforeach;
			endforeach; ?>
		</div>
	<?php else: ?>
		<div class='row'>
			<div class='col-12 text-center'>
				<?php echo __( "NO_DEVICES_FOUND", "STARTPAGE" ); ?>
			</div>
		</div>
		<div class='row mt-5 justify-content-center text-center'>
			<div class='col-12 col-sm-2 '>
				<a class="btn btn-primary"
				   href="<?php echo _BASEURL_; ?>devices_autoscan">
					<?php echo __( "DEVICES_AUTOSCAN", "NAVI" ); ?>
				</a>
			</div>
			<div class='col-12 col-sm-2 '>
				<a href='<?php echo _BASEURL_; ?>device_action/add' class="btn btn-primary">
					<?php echo __( "TABLE_HEAD_NEW_DEVICE", "DEVICES" ); ?>
				</a>
			</div>
		</div>

	<?php endif; ?>
</div>

<script src="<?php echo URL::JS( "start" ); ?>"></script>