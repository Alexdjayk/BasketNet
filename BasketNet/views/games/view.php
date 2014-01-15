<?php $title_for_layout = 'Match catégorie : '.$categoriesMatch[$games['categories_id']]; ?>
<?php $description_for_layout = 'Match catégorie : '.$categoriesMatch[$games['categories_id']]; ?>
<div>
	<div class="hr"></div>
	<!-- AFFICHAGE DU FIL D'ARIANE-->
	<?php include ELEMENTS.DS.'frontoffice'.DS.'breadcrumbs.php'; ?>
	<div class="container_16 gamma ">
		<div class="titre_slogan">
			<div class="resume_last_games">
				<?php 	
				foreach($last_games as $k => $v) { ?>
					<div class="detail_game_all"><?php
						// Si le match est à domicile dans ce cas il s'affiche en Vert sinon si c'est un match à l'exterieur il s'affiche en Rouge
						if(isset($v['stades_id']) && $v['stades_id'] == 0) {
							$lieu_match = '<div class="dom"> Match à Domicile </div>'; // Vert
						} else {
							$lieu_match = "<div class='ext'> Match à'extérieur </div>"; // Rouge
						}
						/* Configure le script en français */
						setlocale (LC_TIME, 'fr_FR','fra');
						//Définit le décalage horaire par défaut de toutes les fonctions date/heure  
						date_default_timezone_set("Europe/Paris");
						//Definit l'encodage interne
						mb_internal_encoding("UTF-8");
						//Convertir une date US en français
						
						$dateFormat = $v['date'];
						$date_day_titre = strftime("%A %d ",strtotime("$dateFormat")); // affiche la date du match en Français jj/mm/yyyy 
						$date = strftime("%m",strtotime("$dateFormat")); // affiche le mois du match en Français jj/mm/yyyy 
						
						if($date == 01){$dates = "Janvier";}
						if($date == 02){$dates = "Février";}
						if($date == 03){$dates = "Mars";}
						if($date == 04){$dates = "Avril";}
						if($date == 05){$dates = "Mai";}
						if($date == 06){$dates = "Juin";}
						if($date == 07){$dates = "Juillet";}
						if($date == 08){$dates = "Août";}
						if($date == 09){$dates = "Septembre";}
						if($date == 10){$dates = "Octobre";}
						if($date == 11){$dates = "Novembre";}
						if($date == 12){$dates = "Décembre";} 
						
						// DATE DU MATCH //
						?> 
						<div class="date_match">
							<h1><?php echo 'Match du '. ucfirst($date_day_titre), ucfirst($dates); ?> <h1>
						</div> 
						<div class="typearticle" style="margin-left:20px; margin-bottom:5px;">
							Tags :<span><?php echo $lesGamestypes[$v['gamestypes_id']];?></span> Catégorie :<span><?php echo $categoriesMatch[$v['categories_id']];?></span> Lieu : <span>Match à <?php echo $stades[$v['stades_id']];?></span>  par <span><?php echo $userspseudo[$v['users_id']]; ?></span>
						</div>
						<div class="hr" style="margin-left:20px;"></div>
						<div class="detail_game">
							
							<div class="grid_8 detail_game_left"><?php
								// NOM DE MON EQUIPE //
								?> <div class="" style="font-size:20px;"> <?php echo $equipeName[$v['equipes_id']];?> </div></br> <?php // Affiche le nom de mon équipe
								
								// LOGO MON EQUIPE //
								?> <div class=""><?php echo $equipes_logos[$v['equipes_id']];?></div><?php // Affiche le logo de mon équipe 
								
								// RESULTAT MON EQUIPE //
								// Affichage du résultat de mon équipe, si celui-ci est supérieur à celui de l'adversaire alors il s'affichera en rouge
								if(isset($v['resultat_equipe']) && $v['resultat_equipe'] > $v['resultat_adverse']){
									
									$resultat_equipe = 'win'; 
									
								} else {$resultat_equipe = '';}
								
								echo '<div class="'.$resultat_equipe.'" style="font-size:20px;">'.$v['resultat_equipe'].'</div>'; // J'affiche le résultat de mon équipe
							?>
							</div>
							
							<div class="grid_8 detail_game_right"><?php
								// NOM EQUIPE ADVERSE
								?> <div class="" style="font-size:20px;"> <?php echo $equipes_adverses[$v['equipes_adverses_id']];?> </div></br> <?php // Affiche le nom de l'équipe adverse
								
								// LOGO EQUIPE ADVERSE //
								?> <div class=""><?php echo $equipes_adverses_logos[$v['equipes_adverses_id']];?></div><?php // Affiche le logo de l'équipe adverse

								// RESULTAT EQUIPE ADVERSE //
								// Affichage du résultat de l'équipe adverse, si celui-ci est supérieur à celui de mon équipe alors il s'affichera en rouge
								if(isset($v['resultat_equipe']) &&  $v['resultat_adverse'] > $v['resultat_equipe'] ){
									
									$resultat_equipe = 'win'; 
									
								} else { $resultat_equipe = ''; }
								echo '<div class="'.$resultat_equipe.'" style="font-size:20px;">'.$v['resultat_adverse'].'</div>'; // J'affiche le résultat de l'équipe adverse
							?></div>
							
						</div>	
					</div>
					<!-- RESUME DU MATCH -->
					<?php
					// Si il n'y a pas encore de résumé noté
					if(empty($v['content'])){
						$dateFormat_created = $v['modified'];
						$date_created = strftime("%c",strtotime("$dateFormat_created")); // affiche la date du match en Français jj/mm/yyyy 
						// pr($date); ?>
						<div class="posts_article" style="margin-right:20px; margin-left:20px;">
							<div class="detail_game_resume">
								<h2>Résumé du match : </h2>
								<div class="textarea_td commentaires_posts">
									<h5> <?php echo $userspseudo[$v['users_id']].'</br>';?> </h5> 
									<p>Le résumé du match est en cours de rédaction...</p>
								</div>
							</div>
						</div>
						<?php 
					// sinon je l'affiche
					} else {
						$dateFormat_created = $v['modified'];
						$date_created = strftime("%c",strtotime("$dateFormat_created")); // affiche la date du match en Français jj/mm/yyyy 
						// pr($date); ?>
						<div class="posts_article" style="margin-right:20px; margin-left:20px;">
							<div class="detail_game_resume">
								<h2>Résumé du match : </h2>
								<div class="textarea_td commentaires_posts">
									<h5> <?php echo $userspseudo[$v['users_id']].'</br>';?> </h5> <?php
									echo $v['content'];
									?><p class="created_comments"><?php echo $date_created;?></p>
								</div>
							</div>
						</div>
						<!-- FIN DE RESUME DU MATCH --><?php 
					}
				} ?> 
			</div>
		</div>
		<?php
		//Variable qui contient le nombre de commentaires postés et validés
		$test = $this->get_nb_comments_games($games['id']);
		// Si il n'y a pas de commentaires, on affiche rien
		if(!empty($test)){ ?>
			<!-- COMMENTAIRES DU MATCH -->
			<div class="content_article">
				<div class="posts_article" style="margin-right:20px; margin-left:20px;">
					<h4 style="margin-bottom:10px;">Commentaires : <?php echo '('.$this->get_nb_comments_games($games['id']).')';?></h4>
					<div class="hr"></div>
					<?php 
					// Et j'affiche tous les commentaires pour le match séléctionné.
					foreach($commentsgames as $k=>$v){
						/* Configure le script en français */
						setlocale (LC_TIME, 'fr_FR','fra');
						//Définit le décalage horaire par défaut de toutes les fonctions date/heure  
						date_default_timezone_set("Europe/Paris");
						//Definit l'encodage interne
						mb_internal_encoding("UTF-8");
						//Convertir une date US en françcais
						
						$dateFormat = $v['created'];
						$date = strftime("%c",strtotime("$dateFormat")); // affiche la date du match en Français jj/mm/yyyy 
						// pr($date); 
						
						// En fonction de l'article, j'affiche le bon commentaire
						if($v['games_id'] == $games['id']){ ?>
							<div class="textarea_td commentaires_posts">
								<h5> <?php echo $userspseudo[$v['users_id']].'</br>';?> </h5> <?php
								echo $v['content']; 
								?><p class="created_comments"><?php echo $date;?></p>
							</div> <?php 
						}
					}?>
					<!-- PAGINATION -->
					<ul class="pagination">
						<li class="text"><a  href="<?php echo Router::url('games/view/'.$games['id']).'?page=1'; ?>">First </a></li>
						<?php for($i=1; $i<= $nbPages; $i++) { ?>
						<li class="page"><a  href="<?php echo Router::url('games/view/'.$games['id']).'?page='.$i; ?>"><?php echo $i ; ?></a></li>
						<?php } ?>
						<li class="text"><a href="<?php echo Router::url('games/view/'.$games['id']).'?page='.$nbPages; ?>">Last</a></li>
					</ul>
				</div>
			</div>
			<!-- FIN DES COMMENTAIRES DU MATCH -->
		<?php 
		} ?>
		<!-- FORMULAIRE DE COMMENTAIRES DU MATCH -->
		<?php
		// Si il y a un formulaire de commentaires pour cet article je l'affiche
		if(Session::check('Backoffice.User.id')){?>
			<div class="content_article">
				<div class="posts_article">
					<div class="hr"></div>
					
					<?php 
					// Affichage d'un message de confirmation 
					include ELEMENTS.DS.'frontoffice'.DS.'message_flash.php';?>
					<img src="<?php echo BASE_URL ; ?>/img/frontoffice/comment.png" alt="comments" title="comments"><h3 style="margin-bottom:-35px; margin-top:-32px; margin-left:40px;">Ajouter un commentaire</h3>
					<a id="haut"></a>
					<?php 
					echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('/adm/commentsgames/add'))); echo '</br>';
					echo $this->helpers['Form']->input('users_id', "", array('type'=> 'hidden', 'value'=> Session::read('Backoffice.User.id'))); echo '</br>';
					echo $this->helpers['Form']->input('games_id', "", array('type'=> 'hidden', 'value'=> $games['id'])); echo '</br>';
					echo $this->helpers['Form']->input('content', "", array('type'=> 'textarea', 'cols' => 145, 'rows' => 5)); echo '</br>';
					echo $this->helpers['Form']->ckeditor('content'); echo '</br>';?>
					<div  class="extrabottom" style="float:right;margin-right:30px;">
						<input class="btn" type="submit" value="Envoyer" ><a href="#haut" ></a></input>
					</div>
				</div>
			</div>
		<?php 
		} ?>
		<!-- FIN DU FORMULAIRE DE COMMENTAIRES DU MATCH -->
	</div>
</div>

