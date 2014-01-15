<?php 
$title_for_layout = 'Page de connexion'; 
$description_for_layout = 'description de la Page de connexion'; 
?>

<?php
	echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('/users/login'))); echo '</br>';
	?><div class="login_input"><?php echo $this->helpers['Form']->input('login', "Votre login", array('class' => 'logininput'));?></div><?php echo '</br>';
	echo $this->helpers['Form']->input('password', "Votre password ", array('type' => 'password', 'class'=>'logininput')); echo '</br>';
	?>
	<!--
	<p>Enter your username:</p>
	<input type="text" class="logininput" />
	<p>Enter your password:</p>
	<input type="password" class="logininput" />
	-->
	<?php
	echo $this->helpers['Form']->end(true);
?>


