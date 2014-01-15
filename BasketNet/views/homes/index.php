<?php 
$title_for_layout = 'Page d accueil'; 
$description_for_layout = 'description de la page d accueil'; 

?>

<div>
	<div class="hr"></div>
	<div class="container_16 gamma ">
		<!-- ZONE LAST GAMES -->
		<div class="titre_slogan">
			<a href="<?php echo Router::url('games/index');?>" title="" alt=""><h1>Les derniers résultats</h1></a>
			<div class="last_game" style=" margin-left:-50px;">
				<?php 
				if(isset($last_games_count) && $last_games_count == 3) {
					$last_game_potision_img = 'style= float:right;';
					$last_game_position = 'class ="grid_5 "';	
				}
				if(isset($last_games_count) && $last_games_count == 2) {
									$last_game_position = 'class ="grid_8"';
				} 
				if(isset($last_games_count) && $last_games_count == 1) {
					$last_game_position = 'class ="grid_16"';	
				} 	else {
					$last_game_potision_img = 'style= float:right;';
					$last_game_position = 'class ="grid_5"';	
				} 	
				?>
				
				<?php foreach($last_games as $k => $v) {?>
			
				<div <?php echo $last_game_position; if(isset($last_game_potision_img)) {echo $last_game_potision_img; }?> ><?php
					// Si le match est à domicile dans ce cas il s'affiche en Vert sinon si c'est un match à l'exterieur il s'affiche en Rouge
					if(isset($v['stades_id']) && $v['stades_id'] == 0) {
						$lieu_match = '<div class="dom"> Match à Domicile </div>'; // Vert
					} else {
						$lieu_match = "<div class='ext'> Match à l'extérieur </div>"; // Rouge
					}
					/* Configure le script en français */
					setlocale (LC_TIME, 'fr_FR','fra');
					//Définit le décalage horaire par défaut de toutes les fonctions date/heure  
					date_default_timezone_set("Europe/Paris");
					//Definit l'encodage interne
					mb_internal_encoding("UTF-8");
					//Convertir une date US en françcais
					
					$dateFormat = $v['date'];
					$date = strftime("%a %b %d",strtotime("$dateFormat")); // affiche la date du match en Français jj/mm/yyyy 
					
					?> <img class="last_game_img" src="<?php echo BASE_URL ; ?>/img/frontoffice/last_match_vierge.png" title="Last Game" alt="Last Game"><?php // affiche l'image de fond
					?> <div class="last_game_categorie"><?php echo $categoriesMatch[$v['categories_id']]; ?> </div> <?php // Affiche la catégorie du match
					?> <div class="last_game_date"><?php echo $date; ?> </div> <?php
					?> <div class="last_game_abreviation_mon_equipe"><?php echo $equipes_abreviations[$v['equipes_id']]; ?></div> 
					<div class="last_game_icone_mon_equipe"><?php echo $equipes_icones[$v['equipes_id']]; ?></div> <?php
					// Affichage du résultat de mon équipe, si celui-ci est supérieur à celui de l'adversaire alors il s'affichera en rouge
					if(isset($v['resultat_equipe']) && $v['resultat_equipe'] > $v['resultat_adverse']){
						
						$resultat_equipe = 'win'; 
						
					} else {$resultat_equipe = '';}
					
					echo '<div class="last_game_resultat_mon_equipe '.$resultat_equipe.'">'.$v['resultat_equipe'].'</div>';
					?> <div class="last_game_abreviation_equipe_adverse"><?php echo $equipes_adverses_abreviations[$v['equipes_adverses_id']]; ?></div> 
					<div class="last_game_icone_equipe_adverse"><?php echo $equipes_adverses_icones[$v['equipes_adverses_id']]; ?></div> <?php
					// Affichage du résultat de l'équipe adverse, si celui-ci est supérieur à celui de mon équipe alors il s'affichera en rouge
						if(isset($v['resultat_equipe']) &&  $v['resultat_adverse'] > $v['resultat_equipe'] ){
							
							$resultat_equipe = 'win'; 
							
						} else { $resultat_equipe = ''; }
						echo '<div class="last_game_resultat_equipe_adverse '.$resultat_equipe.'">'.$v['resultat_adverse'].'</div>';
					?> <div class="last_game_recap"><a href="<?php echo Router::url('games/view/'.$v['id']);?>" title="" alt=""><?php echo 'Resume'; ?></a></div><?php
					?> <div class="last_game_dom_ext"><?php echo $lieu_match ; ?></div>
				</div><?php
				} 	
				?>
			</div>
		</div>
	</div>
</div>
<div class="hr"></div>

<div class="container_16">
	<div class="grid_11 omega">
		<!-- ZONE FOCUS -->
		<div>
			<div class="container_16"> <?php
				foreach($focus as $k => $v){ 
					// si il n' a qu'un focus 
					if($focus_count == 1){$focus_position = 'class ="grid_10 focus"';	$img_position ='margin-left:160px'; $titre_position="margin-left:160px"; $content_position='margin-left:160px; margin-right:170px;';}
					// Si il y a deux focus
					if($focus_count == 2){$focus_position = 'class ="grid_5 focus"'; $img_position=''; $titre_position=''; $content_position='';}?>
					
					<div <?php echo $focus_position;?>>
						<a style="<?php echo $img_position;?>" href="<?php echo BASE_URL .'/focus/view/'.$v['id']; ?>" title="<?php echo $v['name'];?>" alt="<?php echo $v['name'];?>"><?php echo $v['image'];?></a>
						
						<div class="focus_titre" style='<?php echo $titre_position;?>'><a href="<?php echo BASE_URL .'/focus/view/'.$v['id']; ?>" title="<?php echo $v['name'];?>" alt="<?php echo $v['name'];?>"><h3><?php echo $v['name'];?></h3></a></div>
						
						<div class="focus_content" style='<?php echo $content_position;?>'><?php echo $v['content'];?></div>
					</div>
				<?php } ?>
			</div>
		</div>
		<!-- FIN DE ZONE FOCUS -->
		
		<!-- ZONE ARTICLES -->
		<div class="articles_homes">
			<div class="content_article">
				<?php 
				// Je foreach la variable $post qui va nous permettre d'afficher la liste des articles
				foreach ($posts as $k => $v) { ?>
					<div class="posts_article">
						<div class="blog_post_img" style="margin-left:-29px;"><img src="<?php echo BASE_URL ; ?>/img/frontoffice/blog-post-title3.png" title="" alt=""></div>
						<h1 style="margin-left:40px;"><a href="<?php echo BASE_URL .'/posts/view/'.$v['id']; ?>" title="<?php echo $v['name']; ?>" alt="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></a></h1>
						<div class="date_posts" style="margin-left:-22px;">Janv, 20</div>
						<div class="typearticle" style="margin-left:40px;"><span>Janv, 20 </span> tags :<span>Sport</span> par <span>Djayk</span> dans <span> Articles</span><?php
							// Si il y a un formulaire de commentaires 
							if($v['commentaires'] == 1){
								// J'affiche le nombres de commentaires pour cet article
								echo ',<span> '.$this->get_nb_comments($v['id']).' commentaire(s)</span>';
							}?>
						</div>
						<div class="hr_posts_homes"></div>
						<div class="post_content"><?php echo substr($v['content'], 0, 525); ?></div>
						<div class="extrabottom" style="text-align:right; margin-right:30px;">
							<a href="<?php echo BASE_URL .'/posts/view/'.$v['id']; ?>" class="btn" >Lire plus</a>
						</div>
					</div> <?php
				}
				?>
			</div>
		</div>
		<!-- FIN DE ZONE ARICLES -->
	</div>
	<!-- AFFICHAGE DE LA COLONNE DE DROITE -->
	<?php include ELEMENTS.DS.'frontoffice'.DS.'colonne_droite.php'; ?>
	<!-- FIN DE L'AFFICHAGE DE LA COLONNE DE DROITE -->
</div>




