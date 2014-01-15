<?php 
	 $var = Session::read('Flash');
	 $class = Session::read('Flash.type');
	 // pr($var);
	 if($var){ ?>
		<div style="margin-top:10px;" class="status <?php echo $class;?> ">
			<p class="closestatus ">
				<p><img src="<?php echo BASE_URL; ?>/img/icons/icon_<?php echo $class; ?>.png" alt="Information" /><span>Information: <?php echo $var['message']; ?></span></p>
			</p>
		</div>
		<?php
		Session::delete('Flash');	
	 }
?>