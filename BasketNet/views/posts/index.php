<?php 
$title_for_layout = 'Liste des articles'; 
$description_for_layout = 'description de la page des articles'; 
?>

<div class="article">
	<div class="hr"></div>
	<!-- AFFICHAGE DU FIL D'ARIANE-->
	<?php include ELEMENTS.DS.'frontoffice'.DS.'breadcrumbs.php'; ?>
	<div class="titre_article">
		<h1>Liste des articles</h1>
	</div>
	<div class="content_article">
		<?php 
	
		// Je foreach la variable $post qui va nous permettre d'afficher la liste des articles
		foreach ($posts as $k => $v) { 
			
			/* Configure le script en français */
			setlocale (LC_TIME, ' fr-FR','fra');
			//Définit le décalage horaire par défaut de toutes les fonctions date/heure  
			date_default_timezone_set("Europe/Paris");
			//Definit l'encodage interne
			mb_internal_encoding("UTF-8");
			//Convertir une date US en françcais
			
			$dateFormat = $v['created'];
			$formatDate = strftime("%d-%m-%Y",strtotime("$dateFormat")); // affiche la date du match en Français  
			$date = strftime("%m",strtotime("$dateFormat")); // affiche le mois du match 
			$day = strftime("%d",strtotime("$dateFormat")); // affiche le jour du match  
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
			if($date == 12){$dates = "Déc";}
			?>
				 
			<div class="posts_article">
				<div class="blog_post_img"><img src="<?php echo BASE_URL ; ?>/img/frontoffice/blog-post-title3.png" title="" alt=""></div>
				<h1><a href="<?php echo Router::url('posts/view/id:'.$v['id'].'/slug:'.$v['slug'].'/prefix:article'); ?>" title="<?php echo $v['name']; ?>" alt="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></a></h1>
				<div class="date_posts"><?php echo $dates.', '.$day;?></div>
				<div class="typearticle"><span><?php echo $formatDate; ?></span> tags :<span> Blog</span> par <span>Djayk</span> dans <span><?php echo $fl_Poststypes[$v['poststypes_id']]?></span><?php 
					// Si il y a un formulaire de commentaires 
					if($v['commentaires'] == 1){
						// J'affiche le nombres de commentaires pour cet article
						echo ',<span> '.$this->get_nb_comments($v['id']).' commentaire(s)</span>';
					}?>
				</div>
				<div class="hr"></div>
				<div class="post_content" ><?php echo $v['content']; ?></div>
				<div class="extrabottom" style="text-align:right; margin-right:30px;">
					<a href="<?php echo BASE_URL .'/posts/view/'.$v['id']; ?>" class="btn" >Lire plus</a>
				</div>
			</div> <?php
			
		}
		//Pagination de la liste des articles ?>
		<div class="clear"></div>
		<div class="container_16 pagination">
			<!-- PAGINATION -->
			<ul class="pagination">
				<li class="text"><a  href="<?php echo Router::url('blog').'?page=1'; ?>">First </a></li>
				<?php for($i=1; $i<= $nbPages; $i++) { ?>
				<li class="page"><a  href="<?php echo Router::url('blog').'?page='.$i; ?>"><?php echo $i ; ?></a></li>
				<?php } ?>
				<li class="text"><a href="<?php echo Router::url('blog').'?page='.$nbPages; ?>">Last</a></li>
			</ul>
		</div>
	</div>	
</div>

