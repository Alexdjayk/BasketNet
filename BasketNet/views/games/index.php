<?php 
$title_for_layout = 'Liste des articles'; 
$description_for_layout = 'description de la page des articles'; 
?>
<div>
	<div class="hr"></div>
	<!-- AFFICHAGE DU FIL D'ARIANE-->
	<?php include ELEMENTS.DS.'frontoffice'.DS.'breadcrumbs.php'; ?>
	<div class="container_16 gamma ">
		<div class="titre_slogan">
			<h1>Saison 2012 / 2013</h1>
			<div class="last_game">
				<?php 
				if(isset($last_games_count) && $last_games_count == 3) {
					$last_game_potision_img = 'style= margin-left:15px;';
					$last_game_position = 'class ="grid_5"';	
				} 
				if(isset($last_games_count) && $last_games_count == 2) {
					$last_game_position = 'class ="grid_8"';
				} 
				if(isset($last_games_count) && $last_games_count == 1) {
					$last_game_position = 'class ="grid_16"';	
				} else {
					$last_game_potision_img = 'style= margin-left:15px;';
					$last_game_position = 'class ="grid_5"';	
				} 	
				
				// $tab = array(
				
					// "01" => "Janvier" ,
					// "02" => "Février",
					// "03" =>"mars" ,
					// "04" =>"Avril" ,
					// "05" =>"Mai" ,
					// "06" =>"Juin" ,
					// "07" =>"Juillet" ,
					// "08" =>"Aout" ,
					// "09" =>"Septembre" ,
					// "10" =>"Octobre" ,
					// "11" =>"Novembre" ,
					// "12" =>"Decembre" ,
					
					// );
				// pr($tab);
				
				//variable qui contient un tableau vide
				$matches = array();
				
				//je parcours la liste des match terminés
				foreach($last_games as $k => $v) {
					
					// j'explode les dates des matchs
					$aDate = explode('-', $v['date']);
					
						//je récupère le tableau vide dans lequel j'y met ma date explode et j'inclue le résultat dans ma variable $v
						$matches[$aDate[1]][] = $v;
					
				}
				 // pr($matches);
				
				foreach($matches as $k => $v){
				
					// pr($k);
			
					echo '<div class="mois">';
					if($k == 01){echo '<div class="last_games_mois"><h2>Janvier</h2></div> ';}
					if($k == 02){echo '<div class="last_games_mois"><h2>Février</h2></div> ';}
					if($k == 03){echo '<div class="last_games_mois"><h2>Mars</h2></div>';}
					if($k == 04){echo '<div class="last_games_mois"><h2>Avril</h2></div>';}
					if($k == 05){echo '<div class="last_games_mois"><h2>Mai</h2></div>';}
					if($k == 06){echo '<div class="last_games_mois"><h2>Juin</h2></div>';}
					if($k == 07){echo '<div class="last_games_mois"><h2>Juillet</h2></div>';}
					if($k == 08){echo '<div class="last_games_mois"><h2>Aout</h2></div>';}
					if($k == 09){echo '<div class="last_games_mois"><h2>Septembre</h2></div>';}
					if($k == 10){echo '<div class="last_games_mois"><h2>Octobre</h2></div>';}
					if($k == 11){echo '<div class="last_games_mois"><h2>Novembre</h2></div>';}
					if($k == 12){echo '<div class="last_games_mois"><h2>Decembre</h2></div>';}?>
					<div class="hr"></div><?php
					foreach($v as $value){
					
						?><div  <?php if(isset($last_game_position)) { echo $last_game_position;} if(isset($last_game_potision_img)) {echo $last_game_potision_img; }?> ><?php
								
								// Si le match est à domicile dans ce cas il s'affiche en Vert sinon si c'est un match à l'exterieur il s'affiche en Rouge
								if(isset($value['stades_id']) && $value['stades_id'] == 0) {
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
								
								$dateFormat2 = $value['date'];
								$date = strftime("%a %b %d",strtotime("$dateFormat2")); // affiche la date du match en Français jj/mm/yyyy 
								
								
								// affiche l'image de fond
								?> <img class="last_game_img" src="<?php echo BASE_URL ; ?>/img/frontoffice/last_match_vierge.png" title="Last Game" alt="Last Game"><?php 
								
								// Affiche la catégorie du match
								?> <div class="last_game_categorie"><?php echo $categoriesMatch[$value['categories_id']]; ?> </div> <?php 
								
								// Affiche la date du match
								?> <div class="last_game_date"><?php echo $date; ?> </div> <?php
								
								// Affiche l'abréviation de mon équipe
								?> <div class="last_game_abreviation_mon_equipe"><?php echo $equipes_abreviations[$value['equipes_id']]; ?></div> <?php
								
								// Affiche l'icone de mon équipe
								?>
								<div class="last_game_icone_mon_equipe"><?php echo $equipes_icones[$value['equipes_id']]; ?></div> 
								<?php
								
								// Affichage du résultat de mon équipe, si celui-ci est supérieur à celui de l'adversaire alors il s'affichera en rouge
								if(isset($value['resultat_equipe']) && $value['resultat_equipe'] > $value['resultat_adverse']){
									
									$resultat_equipe = 'win'; 
									
								} else {$resultat_equipe = '';}
								// J'affiche le résultat de mon équipe
								echo '<div class="last_game_resultat_mon_equipe '.$resultat_equipe.'">'.$value['resultat_equipe'].'</div>';  
								
								// Affiche l'abréviation de l'équipe adverse 
								?> <div class="last_game_abreviation_equipe_adverse"><?php echo $equipes_adverses_abreviations[$value['equipes_adverses_id']]; ?></div> <?php
								
								// Affiche l'icone de l'équipe adverse 
								?><div class="last_game_icone_equipe_adverse"><?php echo $equipes_adverses_icones[$value['equipes_adverses_id']]; ?></div>  <?php
								
								// Affichage du résultat de l'équipe adverse, si celui-ci est supérieur à celui de mon équipe alors il s'affichera en rouge
								if(isset($value['resultat_equipe']) &&  $value['resultat_adverse'] > $value['resultat_equipe'] ){
									
									$resultat_equipe = 'win'; 
									
								} else { $resultat_equipe = ''; }
								// J'affiche le résultat de l'équipe adverse
								echo '<div class="last_game_resultat_equipe_adverse '.$resultat_equipe.'">'.$value['resultat_adverse'].'</div>'; 
								
								// Lien vers le match ciblé
								?> <div class="last_game_recap"><a href="<?php echo Router::url('games/view/'.$value['id']);?>" title="" alt=""><?php echo 'Resume'; ?></a></div><?php
								
								// Lieu du match (Domicile/ Exterieur)
								?> <div class="last_game_dom_ext"><?php echo $lieu_match ; ?></div>
							</div><?php
					}
				echo '</div>';
				}

				///pr($last_games);
				// $matches = array();
				// foreach($last_games as $k => $v) {
					// $aDate = explode('-', $v['date']);
					// $matches[$aDate[1]][] = $v;
				// }
				
				?>
			</div>
		</div>
	</div>
</div>
