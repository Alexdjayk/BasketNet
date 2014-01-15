<?php 
$title_for_layout = 'Mon compte'; 
$description_for_layout = 'Déscription de la page de mon compte'; 
?>
<?php 
if(Session::read('Backoffice.User.id')){;?>
	<div>
		<div class="hr"></div>
		<div class="container_16 gamma ">
			<!-- ZONE LAST GAMES -->
			<div style="margin-right:30px; margin-left:20px;">
				<?php include ELEMENTS.DS.'frontoffice'.DS.'message_flash.php';?>
			</div>
			<div class="titre_compte">
				<h1>Mon compte</h1>
			</div>
			<div class="mon_compte">
				<img class="img_back_compte" src="<?php echo BASE_URL ;?>/img/frontoffice/derik.png" alt="" title="">
				<?php foreach($compte as $k => $v) { ?>
					<div class="grid_4">
						<div class="portrait "><img src="<?php echo BASE_URL ;?>/img/connexion/user.png " alt="" title=""></div>
					</div>
					<div class="grid_10" style="margin-bottom:20px;">
						<div class="compte_name  ">Nom : <h4><?php echo $v['name'];?></h4> </div>
						<div class="compte_name  ">Prenom : <h4><?php echo $v['prenom'];?></h4> </div>
						<div class="compte_name">Pseudo : <h4><?php echo $v['pseudo'];?></h4> </div>
					
					</div>
					<div class="container_16">
						<div class="grid_8">
							<div class="compte_name">Naissance : <h4><?php echo $v['naissance'];?></h4> </div>
							<div class="compte_name  ">Votre rôle : <h4><?php echo $fl_Roles[$v['roles_id']];?></h4></div>
							<div class="compte_name  ">Votre Catégorie : <h4><?php echo $categoriesMatch[$v['categories_id']];?></h4></div>
							<div class="compte_name  ">Votre statut : <h4><?php echo $lesUserstypes[$v['userstypes_id']];?></h4></div>
						</div>
						<div class="grid_8">
							<div class="compte_name  ">Login : <h4><?php echo $v['login'];?></h4></div>
							<div class="compte_name  ">Password : <h4><?php echo $v['password'];?></h4></div>
							<div class="compte_name  ">Date de création du compte: <h4><?php echo $v['created'];?></h4></div>
							<div class="compte_name  ">Dernière modification du compte: <h4><?php echo $v['modified'];?></h4></div>
						</div>
					</div>
				<?php
				} 	
				?>
			</div>
			<div  class="extrabottom" style="margin-left:20px;">
				<a class="btn" href="<?php echo Router::url('users/editcompte/'.Session::read('Backoffice.User.id'));?>">Modifier mon compte</a>
				<a class="btn" href="<?php echo Router::url('users/editcomptepass/'.Session::read('Backoffice.User.id'));?>">Modifier mon password</a>
			</div>
			
		</div>
	</div>
	<div class="hr"></div>
<?php 
} else {
	$this->redirect('/users/login');
}
?>
