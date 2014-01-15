<!-- AFFICHAGE DU LOGO DU CLUB -->
<?php
$logos = $this->requestAction('websites', 'getWebsite');
foreach($logos as $k => $v){
	
	if($v['online'] == 0){
		echo '<div class="grid_3 logo" style="width:160px;"></div>';
	} else{
		?> <div class="grid_3 logo" ><a href="<?php  echo Router::url('homes/index'); ?>" title="Logo" alt="logo"> <?php echo $v['logo']; ?></a></div><?php
	}
}
?>
<!-- FIN D'AFFICHAGE DU LOGO DU CLUB -->

<!-- ZONE CONNEXION PROFIL -->
<?php 
// Si je suis connecté dans ce cas un bouton deconnexion rouge apparait
if(Session::check('Backoffice.User')){ ?>
	<a class="login" style="margin-left:750px; position:absolute; width:50px;"href="<?php echo Router::url('users/logout'); ?>" title="Deconnexion" alt="Deconnexion"><img src="<?php echo BASE_URL;?>/img/frontoffice/login4.png" alt="Deconnexion" title="Deconnexion"/></a> <?php
// Sinon un bouton bleue apparait et m'indique que je ne suis pas connecté
} else {?>
<a class="login" style="margin-left:750px; position:absolute; width:50px;"href="<?php echo Router::url('users/login'); ?>" title="Connexion" alt="Connexion"><img src="<?php echo BASE_URL;?>/img/frontoffice/login2.png" alt="Connexion" title="Connexion"/></a>
<?php } ?>
<!-- FIN DE ZONE PROFIL-->

<div>
	<a class="creation_compte"  href="<?php echo Router::url('users/compte'); ?>" title="Mon compte" alt="Mon compte">Mon compte</a>
	<a class="creation_compte" style="margin-right:10px;"href="<?php echo Router::url('users/newcompte'); ?>" title="Connexion" alt="Connexion">Création de compte,</a>
	<a class="creation_compte" target="blank" style="margin-right:10px; margin-bottom:-46px; margin-top:-8px;"href="http://www.ffbb.com/" title="ffbb" alt="ffbb"><img src="<?php echo BASE_URL;?>/img/frontoffice/ffbb.png"  alt="ffbb" title="ffbb"/></a>
</div>

<!-- ZONE DU MENU -->
<?php 
// On affecte à la variable $page le résultat de la fonction requestAction qui contient 2 paramètres, le controller et getMenu qui correspond au menu
$pages = $this->requestAction('pages', 'getMenu');
// Ensuite je foreach la variable $page qui contient les informations de mon menu
// Le BASE_URL est remplacé par Router::url(); Attention à ne pas oublier les : ex= 'pages/view/id:'
?>
<div class="grid_13 menutop">
	<div class="menufish" style="margin-top:2px;">
		<?php 
			$this->helpers['Html']->generateMenu($menuGeneral, $categoriesUser, array('blog'=> Router::url("posts/index")));
		?>
	</div> 
</div>
<!-- FIN DE ZONE DU MENU -->

<!-- BARRE DE RECHERCHE -->
	<?php include HELPERS.DS.'search.php'; ?>
<!-- FIN DE BARRE DE RECHERCHE -->

<!-- Image de fond du menu -->
<div class="header_bg"><img src="<?php echo BASE_URL; ?>/img/frontoffice/header-bg.jpg" title="" alt=""></div>
