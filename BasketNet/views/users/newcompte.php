<?php include ELEMENTS.DS.'backoffice'.DS.'js.php';?>
<!-- Top Breadcrumb End -->
<?php 
$title_for_layout = 'Création de compte'; 
$description_for_layout = 'description de la page création de compte'; 
?>

<!-- Right Side/Main Content Start -->
<div class="container_16">
	<!-- Alternative Content Box Start -->
	 <div class="grid_8">
		<div class="title_compte">
			<?php include ELEMENTS.DS.'backoffice'.DS.'message_flash.php';?>
			<h2>Création de compte</h2>
		</div>
		<div class="compte_input">
			<?php 
			echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('/users/newcompte'))); echo '</br>';
			echo $this->helpers['Form']->input('name', "Nom"); echo '</br>';
			echo $this->helpers['Form']->input('prenom', "Prénom"); echo '</br>';
			echo $this->helpers['Form']->input('pseudo', "Pseudo"); echo '</br>';
			echo $this->helpers['Form']->input('ville', "Ville "); echo '</br>';
			echo $this->helpers['Form']->input('naissance', "Date de naissance", array('value' => 'yyyy/mm/jj')); echo '</br>';
			echo $this->helpers['Form']->input('roles_id', "", array('type'=>'hidden', 'value'=>'1')); echo '</br>';
			echo $this->helpers['Form']->input('userstypes_id', "Votre statut", array('type' => 'select', 'datas' => $lesUserstypes)); echo '</br>';
			echo $this->helpers['Form']->input('categories_id', "Votre catégorie", array('type' => 'select', 'datas' => $categoriesMatch)); echo '</br>';
			echo $this->helpers['Form']->input('login', "Login "); echo '</br>';
			echo $this->helpers['Form']->input('password', "Password ", array('type' => 'password')); echo '</br>'; ?>
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