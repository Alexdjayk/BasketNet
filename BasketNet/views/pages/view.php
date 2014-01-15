<?php $title_for_layout = $page['name']; ?>
<?php $description_for_layout = $page['name']; ?>

<div class="article">
	<div class="hr"></div>
	<!-- AFFICHAGE DU FIL D'ARIANE-->
	<?php include ELEMENTS.DS.'frontoffice'.DS.'breadcrumbs.php'; ?>
	<div class="titre_article">
		<!-- J'affiche le titre de ma page, qui est aussi le titre de mon onglet de menu-->
		
	</div>
	<div class="content_article"><?php
		// je parcours les articles en fonction des pages ou je suis.
		foreach($flPostspages as $k => $v){
			/* Configure le script en français */
			setlocale (LC_TIME, ' fr-FR','fra');
			//Définit le décalage horaire par défaut de toutes les fonctions date/heure  
			date_default_timezone_set("Europe/Paris");
			//Definit l'encodage interne
			mb_internal_encoding("UTF-8");
			//Convertir une date US en français
			$dateFormat = $v['created'];
			$date = strftime("%m",strtotime("$dateFormat")); // affiche le mois du match en Français jj/mm/yyyy 
			$day = strftime("%d",strtotime("$dateFormat")); // affiche lle jour du match en Français jj/mm/yyyy  
			if($date == 1){$dates = "Jan";}
			if($date == 2){$dates = "Fév";}
			if($date == 3){$dates = "Mar";}
			if($date == 4){$dates = "Avr";}
			if($date == 5){$dates = "Mai";}
			if($date == 6){$dates = "Jui";}
			if($date == 7){$dates = "Jui";}
			if($date == 8){$dates = "Aou";}
			if($date == 9){$dates = "Sep";}
			if($date == 10){$dates = "Oct";}
			if($date == 11){$dates = "Nov";}
			if($date == 12){$dates = "Déc";} 
			// j'affiche l'article qui correspond à la page de l'article
			if($page['id'] == $v['pages_id']){ ?>
				
				<div class="posts_article">
					<div class="blog_post_img"><img src="<?php echo BASE_URL ; ?>/img/frontoffice/blog-post-title3.png" title="" alt=""></div>
					<h1><?php echo $v['name']; ?></h1>
					<div class="date_posts"><?php echo $dates.' , '.$day;?></div>
					<div class="typearticle"><span><?php echo $v['created']?></span>  par <span>Djayk</span>.</div>
					<div class="hr" style="margin-bottom:25px;"></div>
					<div class="post_description" ><?php echo $v['content']; ?></div>
				</div> <?php
			}
		}?>
	</div>
	<?php
		// Je parcours l'article de la page correspondante 
		foreach($flPostspages as $k =>$val){
			//Si nous sommes bien sur la bonne page 
			if($page['id'] == $val['pages_id']){ 
				// Et si il y a un formulaire de contact pour cet article je l'affiche
				if($val['contacts'] == 1){?>
					<div class="container_16">
						<!-- Alternative Content Box Start -->
						<div class="hr"></div>
						 <div class="grid_8">
							<div class="title_compte titre_article">
								<?php include ELEMENTS.DS.'backoffice'.DS.'message_flash.php';?>
								<img src="<?php echo BASE_URL ; ?>/img/frontoffice/contact.png" alt="contact" title="contact">
								<h2 style="margin-bottom:0px; margin-top:-32px; margin-left:70px;">Nous contacter</h2>
							</div>
							<div class="compte_input">
								<?php 
								echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('/contacts/index'))); echo '</br>';
								echo $this->helpers['Form']->input('name', "Votre nom"); echo '</br>';
								echo $this->helpers['Form']->input('prenom', "Votre prénom"); echo '</br>';
								echo $this->helpers['Form']->input('telephone', "Votre téléphone"); echo '</br>';
								echo $this->helpers['Form']->input('email', "Votre email"); echo '</br>';
								echo $this->helpers['Form']->input('message', "Votre message", array('type'=> 'textarea', 'cols' => 70, 'rows' => 20)); echo '</br>';
								?>
							</div>
							<div class="extrabottom" style="margin-left:10px;">
								<input class="btn" type="submit" value="Envoyer" ></input>
							</div>
						</div>
					</div>
				<?php
				}
			}
		}
	?>
</div>

