<?php 
$title_for_layout = 'Liste des équipes'; 
$description_for_layout = 'description de la page des équipes'; 
?>

<div class="container_16">
	<div class="grid_11 omega">
		<!-- ZONE PRESENTATION EQUIPE -->
		<div class="container_16" style="margin-bottom:20px;"> 
			<div class="hr"></div>
			<?php  foreach($categories as $k=>$v){ ?>
				<h1 style="margin-top:20px; margin-left:10px;">Equipe <?php echo $v['name'];?></h1>
				<div class="equipe_photo"><?php echo $v['image'];?></div>
				<div class="coach"><h3>Entraineur : </h3><?php echo '<span>'.$v['coach'].'</span>';?></div>
				<div class="entrainement"><h3>Horraires des entrainements : </h3><?php echo '<span>'.$v['entrainement'].'</span>';?></div>
				<div class="entrainement"><h3>Salle des entrainements : </h3><span>Gymnase de la place 30440 SUMENE</span></div>
			<?php 
			} ?>
		</div>
		
		<!-- FIN DE ZONE PRESENTATION EQUIPE -->
	</div>
	<!-- AFFICHAGE DE LA COLONNE DE DROITE -->
	<?php include ELEMENTS.DS.'frontoffice'.DS.'colonne_droite_categories.php'; ?>
	<!-- FIN DE L'AFFICHAGE DE LA COLONNE DE DROITE -->
</div>
<div>
	<div class="contentcontainer">
		<div class="titre_slogan titre_categories headings alt" style="width:889px;">
			<h1>Liste des matchs terminés</h1>
		</div>
		<div class="contentbox">
			<?php 
			
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
				// Affichage du tableau html?>
				<table width="100%" cellspacing="0" cellpadding="0" border="0" class="table">
					<thead>		
						<tr>
							<th>Date du match</th>
							<th>Lieu</th>
							<th>Type</th>
							<th>Résumé</th>
							<th>Eq</th>
							<th>Scr</th>
							<th>Scr</th>
							<th>Adv</th>
						</tr> 
					</thead>
					<tbody><?php
					echo '
					<div class="mois">';
						if($k == 01){echo '<div class="last_games_mois_cat"><h3>Janvier</h3></div> ';}
						if($k == 02){echo '<div class="last_games_mois_cat"><h3>Février</h3></div> ';}
						if($k == 03){echo '<div class="last_games_mois_cat"><h3>Mars</h3></div>';}
						if($k == 04){echo '<div class="last_games_mois_cat"><h3>Avril</h3></div>';}
						if($k == 05){echo '<div class="last_games_mois_cat"><h3>Mai</h3></div>';}
						if($k == 06){echo '<div class="last_games_mois_cat"><h3>Juin</h3></div>';}
						if($k == 07){echo '<div class="last_games_mois_cat"><h3>Juillet</h3></div>';}
						if($k == 08){echo '<div class="last_games_mois_cat"><h3>Aout</h3></div>';}
						if($k == 09){echo '<div class="last_games_mois_cat"><h3>Septembre</h3></div>';}
						if($k == 10){echo '<div class="last_games_mois_cat"><h3>Octobre</h3></div>';}
						if($k == 11){echo '<div class="last_games_mois_cat"><h3>Novembre</h3></div>';}
						if($k == 12){echo '<div class="last_games_mois_cat"><h3>Decembre</h3></div>';}
						
						foreach($v as $value){
						
						  ?><div><?php
									
								// Si le match est à domicile dans ce cas il s'affiche en Vert sinon si c'est un match à l'exterieur il s'affiche en Rouge
								if(isset($value['stades_id']) && $value['stades_id'] == 0) {
									$lieu_match = '<div class="dom"> Domicile </div>'; // Vert
								} else {
									$lieu_match = "<div class='ext'> Extérieur </div>"; // Rouge
								}
								
								/* Configure le script en français */
								setlocale (LC_TIME, 'fr_FR','fra');
								//Définit le décalage horaire par défaut de toutes les fonctions date/heure  
								date_default_timezone_set("Europe/Paris");
								//Definit l'encodage interne
								mb_internal_encoding("UTF-8");
								//Convertir une date US en français
								
								$dateFormat2 = $value['date'];
								$date = strftime("%m",strtotime("$dateFormat2")); // affiche le mois du match en Français jj/mm/yyyy 
								$day = strftime("%a %d",strtotime("$dateFormat2")); // affiche le jour et la date du match en Français jj/mm/yyyy  
								
								if($date == 01){$dates = "Jan";}
								if($date == 02){$dates = "Fév";}
								if($date == 03){$dates = "Mar";}
								if($date == 04){$dates = "Avr";}
								if($date == 05){$dates = "Mai";}
								if($date == 06){$dates = "Jui";}
								if($date == 07){$dates = "Jui";}
								if($date == 08){$dates = "Aou";}
								if($date == 09){$dates = "Sep";}
								if($date == 10){$dates = "Oct";}
								if($date == 11){$dates = "Nov";}
								if($date == 12){$dates = "Déc";} ?>
								<tr> 
									<!-- Affichage de la date -->
									<td><?php echo  $day.' '.$dates; ?></td>
									
									<!-- Lieu du match ext ou dom -->
									<td><?php echo  $lieu_match ; ?></td>
									
									<!-- Type de match -->
									<td><?php echo  $lesGamestypes[$value['gamestypes_id']] ; ?></td>
									
									<!-- Lien vers le résumé du match -->
									<td><a class="cat_resume" href="<?php echo Router::url('games/view/'.$value['id']);?>" title="" alt=""><?php echo 'Resume'; ?></a></td>
									
									<!-- Affichage de l'icône de notre équipe -->
									<td class="tab_cat_img"><?php echo $equipes_icones[$value['equipes_id']]; ?></td><?php
									
									// Affichage du résultat de mon équipe, si celui-ci est supérieur à celui de l'adversaire alors il s'affichera en rouge
									if(isset($value['resultat_equipe']) && $value['resultat_equipe'] > $value['resultat_adverse']){
										
										$resultat_equipe = 'win'; 
										
									} else {$resultat_equipe = '';}?>
									
									<!-- Affichage du résultat de notre équipe -->
									<td class="last_game_resultat_mon_equipe <?php echo $resultat_equipe; ?>"><?php echo $value['resultat_equipe'];?> </td><?php
										if(isset($value['resultat_equipe']) &&  $value['resultat_adverse'] > $value['resultat_equipe'] ){
										
										$resultat_equipe = 'win'; 
										
									} else { $resultat_equipe = ''; }?>
									
									<!-- Affichage du résultat de l'équipe adverse -->
									<td class="last_game_resultat_equipe_adverse <?php echo $resultat_equipe; ?>"><?php echo $value['resultat_adverse'];?> </td>
									
									<!-- Affichage de l'icône adverse -->
									<td class="tab_cat_img"><?php echo  $equipes_adverses_icones[$value['equipes_adverses_id']]; ?></td>
								</tr>
							</div><?php
						}
					echo 
					'</div>';?>
					</tbody>
				</table> <?php
			}
			?>	
		</div>
	</div>
</div>



