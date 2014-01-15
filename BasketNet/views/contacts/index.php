<?php 
$title_for_layout = 'Liste des messages'; 
$description_for_layout = 'description de la page des messages'; 
?>
<?php include ELEMENTS.DS.'backoffice'.DS.'js.php';?>
<!-- Top Breadcrumb End -->

<!-- Right Side/Main Content Start -->
<div class="container_16">
	<!-- Alternative Content Box Start -->
	<div class="hr"></div>
	 <div class="grid_8">
		<div class="title_compte titre_article">
			<?php include ELEMENTS.DS.'backoffice'.DS.'message_flash.php';?>
			<h2>Nous contacter</h2>
		</div>
		<div class="compte_input">
			<?php 
			echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('/contacts/index'))); echo '</br>';
			echo $this->helpers['Form']->input('name', "Votre nom"); echo '</br>';
			echo $this->helpers['Form']->input('prenom', "Votre prénom"); echo '</br>';
			echo $this->helpers['Form']->input('telephone', "Votre téléphone"); echo '</br>';
			echo $this->helpers['Form']->input('email', "Votre email"); echo '</br>';
			echo $this->helpers['Form']->input('message', "Votre message", array('type'=> 'textarea', 'cols' => 70, 'rows' => 20)); echo '</br>';
			?>
		</div>
		<div class="extrabottom" style="margin-left:10px;">
			<input class="btn" type="submit" value="Envoyer" ></input>
		</div>
	</div>
	<div class="grid_8">
		<div class="compte_logo">
			<?php foreach($websites as $k => $v){
				echo '<div class="compte_logo_top">'.$v['image'].'</div>';
				echo '<div class="compte_logo_middle">'.$v['image2'].'</div>';
			}?>
		</div>
	</div>
</div>
<!-- Right Side/Main Content End -->

