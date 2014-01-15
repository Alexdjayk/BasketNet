<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="fr">
<head>
	<title>backoffice</title>
	<!-- CSS -->
	<?php
	$css = array(
		'reset',
		'grille/960_16_col',
		'grille/reset',
		'grille/text',
		'themes/default/default',
		'backoffice/datatable',
		'backoffice/form-buttons',
		'backoffice/forms', 
		'backoffice/link-buttons', 
		'backoffice/styles', 
		'backoffice/grids', 
		'backoffice/layout1', 
		'backoffice/backcss',

	);
	echo $this->helpers['Html']->css($css);

	// JS //
	$js = array(
		
		'backoffice/jquery-1.7.1.min',
		'backoffice/functions',
	);
	echo $this->helpers['Html']->js($js);
	?>
	
</head>
<body id="homepage">
	<div>
		<div id="leftside">
			<div class="user">
				<img src="<?php echo BASE_URL; ?>/img/backoffice/avatar.png" width="44" height="44" class="hoverimg" alt="Avatar" />
				<p>Logged in as: <?php?></p>
				<p class="username"><?php echo Session::read('Backoffice.User.login')?></p>
				<p class="userbtn"><a href="<?php echo Router::url('adm/users/moncompte');?>" title="">Profile</a></p>
				<p class="userbtn"><a href="<?php echo Router::url('users/logout');?>"title="">Log out</a></p>
			</div>
			<!-- AFFICHAGE DES MESSAGES -->
			<div class="notifications">
				<p class="notifycount">
					<a href="<?php echo BASE_URL ; ?>/adm/contacts/index" title="" ><?php
						// affiche le nombre de messages de la page contact
						$NbContact = $this->requestAction('contacts', 'getMessage');
						echo $NbContact;
					?>
					</a>
				</p>
				<?php if($NbContact == 1) { 
					echo '<a href="'.BASE_URL.'/adm/contacts/index" title="" >Nouveau message</a>';
				} 
				else {
					echo '<a href="'.BASE_URL.'/adm/contacts/index" title="" >Nouveaux messages</a>';
				}?>
				<p class="smltxt">(Click to open notifications)</p>
			</div>
			<!-- FIN DE L'AFFICHAGE DES MESSAGES -->
			<!-- AFFICHAGE DU MENU -->
			<ul id="nav">
				<li>
					<ul class="navigation">
						<li class="heading selected">Menu</li>
						<li><a href="<?php echo Router::url('adm/posts/index');?>">Accueil</a></li>
					</ul>
				</li>
				<li>
					<a class="collapsed heading">Articles, focus</a>
					 <ul class="navigation">
						<li><a href="<?php echo Router::url('adm/posts/index');?>">Les articles</a></li>
						<li><a href="<?php echo Router::url('adm/focus/index');?>">Les focus</a></li>
						<li><a href="<?php echo Router::url('adm/poststypes/index');?>">Les types d'articles</a></li>
					</ul>
				</li>
				<li><a class="collapsed heading ">Menu et pages</a>
					<ul class="navigation">
						<li><a href="<?php echo Router::url('adm/pages/index');?>">Le menu</a></li>
						<li><a href="<?php echo Router::url('adm/postspages/index');?>">Les articles des pages</a></li>
					</ul>
				</li> 
				<li>
					<a class="collapsed heading">Les utilisateurs</a>
					 <ul class="navigation">
						<li><a href="<?php echo Router::url('adm/users/index');?>">Les utilisateurs</a></li>
						<li><a href="<?php echo Router::url('adm/users/moncompte');?>">Les administrateurs</a></li>
						<li><a href="<?php echo Router::url('adm/userstypes/index');?>">Les types d'utilisateurs</a></li>
						<li><a href="<?php echo Router::url('adm/roles/index');?>">Les rôles d'utilisateurs</a></li>
					</ul>
				</li>
				<li>
					<a class="collapsed heading">Les messages</a>
					 <ul class="navigation">
						<li><a href="<?php echo Router::url('adm/contacts/index');?>">Les Messages <?php if($NbContact > 0){echo '('.$NbContact.')';}?></a></li>
						<?php 
						// affiche le nombre de commentaires non validés pour les articles
						$NbComment = $this->getcommentposts();
						?>
						<li><a href="<?php echo Router::url('adm/commentsposts/index');?>">Commentaires articles <?php if($NbComment > 0){echo '('.$NbComment.')';}?></a></li>
						<?php 
						// affiche le nombre de commentaires non validés pour les articles
						$NbCommentgame = $this->getcommentgames();
						?>
						<li><a href="<?php echo Router::url('adm/commentsgames/index');?>">Commentaires des matchs <?php if($NbCommentgame > 0){echo '('.$NbCommentgame.')';}?></a></li>
						<li><a href="<?php echo Router::url('adm/newsletters/index'); ?>">Newsletters</a></li>
					</ul>
				</li>
				<li>
					<a class="collapsed heading">Les matchs</a>
					 <ul class="navigation">
						<li><a href="<?php echo Router::url('adm/games/backoffice_nextgames');?>">Les prochains matchs</a></li>
						<li><a href="<?php echo Router::url('adm/games/index');?>" >Les matchs terminés</a></li>
						<li><a href="<?php echo Router::url('adm/gamestypes/index');?>" >Les types de matchs</a></li>
					</ul>
				</li>
				<li><a class="collapsed heading ">Les équipes</a>
					<ul class="navigation">
						<li><a href="<?php echo Router::url('adm/equipes/index');?>">Mon équipe</a></li>
						<li><a href="<?php echo Router::url('adm/adversaires/index');?>">Liste des équipes adverses</a></li>
						<li><a href="<?php echo Router::url('adm/categories/index');?>">Catégories des équipes</a></li>
					</ul>
				</li>
				<li><a class="collapsed heading ">Gestion du site</a>
					<ul class="navigation">
						<li><a href="<?php echo Router::url('adm/websites/index');?>">Le site</a></li>
						
						<li><a href="<?php echo Router::url('adm/sliders/index');?>">Le slider</a></li>
						<li><a href="<?php echo Router::url('adm/pictures/index');?>">La gallerie</a></li>
						<li><a href="<?php echo Router::url('adm/footers/index');?>">Le footer</a></li>
						<li><a href="<?php echo Router::url('adm/seasons/index');?>">Les saisons</a></li>
						<li><a href="<?php echo Router::url('adm/configs/backoffice_database_liste');?>">Base de données</a></li>
					</ul>
				</li> 
			</ul>
			<!-- FIN DU MENU -->
		</div>
	</div>
	<!-- DEBUT DU CONTENT -->
	<div class="backfond" >
		<div class="fondtextb" >
		<?php
			echo $content_for_layout;
		?>
		</div>
	</div>
	<!-- FIN DU CONTENT -->
</body>
</html>



