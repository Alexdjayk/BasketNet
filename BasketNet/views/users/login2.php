<?php 
$title_for_layout = 'Page de connexion'; 
$description_for_layout = 'description de la Page de connexion'; 
?>
<div class="content">
	<table cellpadding="0" cellspacing="0" style="margin-bottom:0px;">
		<tr>
			<td>
				<img class="portrait_profil" src="<?php echo BASE_URL; ?>/img/user.png" alt="photo portrait" title="photo portrait 128px * 128px" />
				<ul>
					<li class="portrait_profil_txt">Mon portrait</li>
				</ul>
			</td>
			<td class="td_sep">
				<h3>Mon profil</h3>
				<ul>
					<li><a href="<?php echo BASE_URL; ?>/homes/index" title="">Nom</a></li>
					<li><a href="<?php echo BASE_URL; ?>/homes/index" title="">Prénom</a></li>
					<li><a href="<?php echo BASE_URL; ?>/homes/index" title="">Date de naissance</a></li>
					<li><a href="<?php echo BASE_URL; ?>/homes/index" title="">Ville</a></li>
				</ul>
			</td>
			<td class="td_sep">
				<h3>Mon équipe</h3>
				<ul>
					<li><a href="<?php echo BASE_URL; ?>/homes/index" title="">Mon poste</a></li>
					<li><a href="<?php echo BASE_URL; ?>/homes/index" title="">Mes statistiques</a></li>
					<li><a href="<?php echo BASE_URL; ?>/homes/index" title="">Mes statistiques de l'année</a></li>
				</ul>
			</td>
			<td class="td_sep">	
				<h3>Gestion du compte</h3>
				<ul>
					<li><a href="<?php echo BASE_URL; ?>/homes/index" title="">Mon compte</a></li>
					<li><a href="<?php echo BASE_URL; ?>/homes/index" title="">Gérer mon profil</a></li>
					<li><a href="<?php echo BASE_URL; ?>/homes/index" title="">Gérer mon compte</a></li>
					<li><a href="<?php echo Router::url('blog_backoffice');?>" alt="" title="">Accéder au backoffice</a></li>
					
				</ul>
			</td>
			<td class="td_sep">									
				<h3>Se connecter</h3>
				<div class="content_article"><?php
					echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('/users/login'))); echo '</br>';
					echo $this->helpers['Form']->input('login', "", array('value'=> 'Votre Login')); echo '</br>';
					echo $this->helpers['Form']->input('password', "",  array('type' => 'password', 'value'=> 'Votre password')); echo '</br>';
					echo $this->helpers['Form']->end(true);
					?>
					<div class="clear"></div>
				</div>
				<?php 
				 $var = Session::read('Flash');
				 $class = Session::read('Flash.type');
				 // pr($var);
				 if($var){ ?>
					<div style="margin-top:10px;" class="status <?php echo $class;?> ">
						<p class="closestatus ">
							<p><img src="<?php echo BASE_URL; ?>/img/icons/icon_<?php echo $class; ?>.png" alt="Information" /><span>Information: <?php echo $var['message']; ?></span></p>
						</p>
					</div>
					<?php
					Session::delete('Flash');	
				 }
				?>
				<?php
				$jour = array(
				"Sunday" => "Dimanche",
				"Monday" => "Lundi",
				"Tuesday" => "Mardi",
				"Wednesday" => "Mercredi",
				"Thursday" => "Jeudi",
				"Friday" => "Vendredi",
				"Saturday" => "Samedi"
				);

				$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre");

				$datefr = $jour[date("l")]." ".date("d")." ".$mois[date("n")]." ".date("Y");
				// Affichage de la date du jour
				echo $datefr.' ';
				?>
			</td>
			
		</tr>	
	</table>	
</div>
<!-- BOUTONS CONNEXION-->
<div class="activate">
	<span class="button"><b>Se connecter</b></span>
	<span class="deconnect">Se déconnecter</span>		
</div>
