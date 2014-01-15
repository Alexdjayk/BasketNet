<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php if(isset($title_for_layout) && !empty($title_for_layout)) { ?> <title> <?php echo $title_for_layout; ?> </title> <?php } else { ?> <title> Titre de mon site </title><?php } 
	?>
	<link type="image/vnd.microsoft.icon" href="<?php echo BASE_URL ; ?>/img/frontoffice/ball.png" rel="shortcut icon">
	
	<?php if(isset($description_for_layout) && !empty($description_for_layout)) { ?> <meta name="description" content="<?php echo $description_for_layout; ?> "/><?php } else { ?> <meta name="description" content="Description de mon site" /> <?php } ?>
	<meta name="generator" content="<?php echo $description_for_layout; ?>" />
	
	<!-- CSS -->
	<?php
	$css = array(
		'reset',
		'grille/960_16_col',
		'grille/reset',
		'grille/text',
		//'datatable',
		'themes/default/default',
		'nivo-slider',
		'style',
		'grids',
		'link-buttons', 
		//'form-buttons',
		'stylesboutons',   
		'superfish',
		'css',
		
	);
	echo $this->helpers['Html']->css($css);
	?>
</head>
<body>
	<!-- AFFICHAGE DES IMAGES DE FOND GAUCHE ET DROITE-->
	<?php include ELEMENTS.DS.'frontoffice'.DS.'background_image.php'; ?>
	<!-- AFFICHAGE DU MENU -->
	<div class="container_16" style="" >
		<?php include ELEMENTS.DS.'frontoffice'.DS.'header.php'; ?>
	</div>
	<!-- FIN DE L'AFFICHAGE DU MENU-->
	<div class="middle_content_back" >
		<!-- SLIDER-->
		<!--
		<div class="wrap_content header">
			<div id="wrapper">
				<div class="slider-wrapper theme-default">
					<div class="ribbon"></div>
					<div id="slider" class="slider nivoSlider">
					
						<?php
							// $sliders = $this->requestAction('sliders', 'getSlider');
							// foreach($sliders as $k => $v){
		
								?> <div style="overflow:hidden;"> <?php // echo $v['image']; ?></div> <?php
		
							// }
						?>
					</div>
				</div>
			</div>
		</div>
		-->
		<?php include VIEWS.DS.'sliders'.DS.'index.php'; ?>
		<!-- FIN SLIDER -->
		<!-- CONTENT -->
		<div class="wrap_content container_16">
			<div class="middle_content">
				<?php echo $content_for_layout; ?>
			</div>
		</div>
		<!-- FIN CONTENT-->
	</div>
	
	<!-- FOOTER -->
	<div id="footer"></div>
	<?php include ELEMENTS.DS.'frontoffice'.DS.'footer.php'; ?>
	<!-- FIN FOOTER -->
	
	<!-- jS -->
	<?php
	$js = array(
		
		'jquery-1.7.1.min',
		'jquery.nivo.slider.pack',
		'jquery.nivo.slider',
		'superfish',
		'scripts',
		'scripts2',
	);
	echo $this->helpers['Html']->js($js);
	?>
</body>
</html>

