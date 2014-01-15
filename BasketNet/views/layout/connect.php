<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php if(isset($title_for_layout) && !empty($title_for_layout)) { ?> <title> <?php echo $title_for_layout; ?> </title> <?php } else { ?> <title> Titre de mon site </title><?php } ?>
	
	<?php if(isset($description_for_layout) && !empty($description_for_layout)) { ?> <meta name="description" content="<?php echo $description_for_layout; ?> "/><?php } else { ?> <meta name="description" content="Description de mon site" /> <?php } ?>
	<meta name="generator" content="" />
	
	<!-- CSS -->

	<?php
	$css = array(
		'styles/layout',
		'styles/login',
		'themes_color/blue/styles',
	);
	echo $this->helpers['Html']->css($css);
	?>
</head>
<body>
	<div id="logincontainer">
    	<div id="loginbox">
        	<div id="loginheader">
				<p>Page de connexion</p>
            </div>
            <div id="innerlogin">
            	<?php echo $content_for_layout;?>
            </div>
        </div>
        <img src="<?php echo BASE_URL;?>/img/backoffice/login_fade.png" alt="Fade" />
		<?php include ELEMENTS.DS.'backoffice'.DS.'message_flash.php';?>
    </div>
</body>
</html>

