<div class="footers">
	<?php
	$footers = $this->requestAction('footers', 'getFooter');
	foreach($footers as $k => $v){ ?>
	<div class="textfoot container_16">
		<img style="margin-top:-150px;  margin-bottom: -120px; margin-left:-1500px; z-index:150;" src="<?php echo BASE_URL ; ?>/img/frontoffice/panier_back4.png" alt="Panier basket" title="Panier basket">
		
		<div class="grid_8 separateur">
			<h4><?php echo $v['title1'];?></h4>
			<div><?php echo $v['content']; ?></div> 
		</div>
		<div class="grid_4 separateur">
			<h4><?php echo $v['title2'];?></h4>
			<div><?php echo $v['content2']; ?></div> 
		</div>
		<div class="grid_4 ">
			<h4><?php echo $v['title3'];?></h4>
			<div><?php echo $v['content3']; ?></div> 
		</div>
		<img style="margin-top:-500px; margin-bottom: -270px; margin-left:650px; z-index:-200" src="<?php echo BASE_URL ; ?>/img/frontoffice/derik_back.png" alt="Derrik" title="Derrik">
		
	</div>
	<div class="textfoot container_16" style="margin-top:-200px;">
		<div class="grid_8 separateur" style="margin-left:10px;">
			<h4><?php echo $v['title4'];?></h4>
			<div><?php echo $v['content4']; ?></div> 
		</div>
		<div class="grid_4 separateur">
			<h4><?php echo $v['title5'];?></h4>
			<div><?php echo $v['content5']; ?></div> 
		</div>
		<div class="grid_4 ">
			<h4>Réseaux sociaux</h4>
			<div>Rejoinez nous aussi sur nos réseaux</div>
			<a class="rs_lien"href="https://fr-fr.facebook.com/" target="_blank" title="facebook" alt="facebook"><img src="<?php echo BASE_URL ; ?>/img/frontoffice/facebook.png" alt="facebook" title="facebook"></a>
			<a class="rs_lien"href="http://www.twitter.fr" target="_blank" title="twitter" alt="twitter"><img src="<?php echo BASE_URL ; ?>/img/frontoffice/twitter.png" alt="twitter" title="twitter">
			<a class="rs_lien"href="http://www.youtube.com" target="_blank" title="youtube" alt="youtube"><img src="<?php echo BASE_URL ; ?>/img/frontoffice/youtube.png" alt="youtube" title="youtube">
			<a class="rs_lien"href="http://www.google.fr" target="_blank" title="google" alt="google"><img src="<?php echo BASE_URL ; ?>/img/frontoffice/google.png" alt="google" title="google">
		</div>
	</div>
	<?php } ?>
</div>
