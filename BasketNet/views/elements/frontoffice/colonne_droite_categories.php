<!-- ZONE COLONNE DE DROITE -->
<div class="grid_5 alpha">
	<div class="bloc_droite_next_game_first">
		<div>
			<div class="next_game_text " style="margin-top:85px;">
				<?php 
				// Affichage des prochains matchs 
				
				foreach($games as $k => $v) {
				
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
					$date = strftime("%d/%m/%Y",strtotime("$dateFormat")); // affiche la date du match en Français jj/mm/yyyy
					$date_jour = strftime("%a",strtotime("$dateFormat")); // affiche juste le nom du jour de match ex: (%A) = Lundi ou (%a) = Lun. 
					
					// Affichage de l'heure du match HH : mm au lieu de HH : mm : ss
					$timeFormat = $v['heure'];
					$time = substr($timeFormat, -8, 5);    
			
					?> <img class="next_match_img_test"  src="<?php echo BASE_URL ; ?>/img/frontoffice/match_resultat_vierge.png" title="Next Game" alt="Next Game"><?php
					?> <div class="next_game_titre">Prochain match : <?php echo $equipes_adverses[$v['equipes_adverses_id']];?></div> <?php // En-Tête avec le nom de l'adversaire
					?> <div class="next_game_soustitre">CATEGORIE : <?php echo $categoriesMatch[$v['categories_id']]; echo $lieu_match; ?> </div> <?php // Affiche si le match se joue à domicile ou à l'exterieur
					?> <div class="next_game_logo_mon_equipe"><?php echo $equipes_logos[$v['equipes_id']];?></div><?php // Affiche le logo de mon équipe 
					?> <div class="next_game_date_jour"> <?php echo $date_jour;?> </div></br> <?php // Affiche la date du prochain match en Français
					?> <div class="next_game_date"> <?php echo $date;?> </div></br> <?php // Affiche la date du prochain match en Français
					?> <div class="next_game_heure"> <?php echo $time;?> </div></br> <?php // Affiche l'heure du prochain match
					?> <div class="next_game_logo_equipe_adverse"><?php echo $equipes_adverses_logos[$v['equipes_adverses_id']];?></div><?php // Affiche le logo de l'équipe adverse
					?> <div class="next_game_nom_equipe"> <?php echo $equipeName[$v['equipes_id']];?> </div></br> <?php // Affiche le nom de mon équipe
					?> <div class="next_game_equipe_adverse"> <?php echo $equipes_adverses[$v['equipes_adverses_id']];?> </div></br> <?php // Affiche le nom de l'équipe adverse
					?> <div class="next_game_id"><?php echo $v['id'];?></div> <?php // Identifiant du match
				}
				?>
				
			</div>
		</div>
	</div>
</div>