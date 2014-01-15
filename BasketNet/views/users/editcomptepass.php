<?php 
$title_for_layout = 'Editer mon password'; 
$description_for_layout = 'Déscription de la page : Editer mon password'; 
?>

<?php include ELEMENTS.DS.'backoffice'.DS.'js.php';?>
<!-- Top Breadcrumb End -->

<!-- Right Side/Main Content Start -->
<div class="container_16">
	<!-- Alternative Content Box Start -->
	 <div class="grid_8">
		<div class="title_compte">
			<?php include ELEMENTS.DS.'backoffice'.DS.'message_flash.php';?>
			<h2>Modification de mon password</h2>
		</div>
		<div class="compte_input">
			<?php 
			echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('/users/editcomptepass/'.$id))); echo '</br>';
			echo $this->helpers['Form']->input('id', "", array('type'=> 'hidden')); echo '</br>';
			echo $this->helpers['Form']->input('password', "Password "); echo '</br>'; ?>
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


