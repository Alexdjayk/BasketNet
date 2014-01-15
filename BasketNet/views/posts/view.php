<?php 
$title_for_layout = 'Liste des articles'; 
$description_for_layout = 'description de la page des articles'; 
?>
<?php 

$css = array(  
	'lightbox',  
);
echo $this->helpers['Html']->css($css);


$js = array(
	'jquery-1.7.1.min',
	'lightbox'
);
echo $this->helpers['Html']->js($js);
	
?>
<div class="grid_16 article_detail">
	<!-- AFFICHAGE DE L'ARTICLE -->
	<div class="hr"></div>
	<!-- AFFICHAGE DU FIL D'ARIANE-->
	<?php include ELEMENTS.DS.'frontoffice'.DS.'breadcrumbs.php'; ?>
	<?php 
	// Affichage d'un message de confirmation 
	include ELEMENTS.DS.'frontoffice'.DS.'message_flash.php';
	
	
	
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
		$formatDate = strftime("%d-%m-%Y",strtotime("$dateFormat")); // affiche la date du match en Français jj/mm/yyyy 
		$date = strftime("%m",strtotime("$dateFormat")); // affiche la date du match en Français jj/mm/yyyy 
		$day = strftime("%d",strtotime("$dateFormat")); // affiche la date du match en Français jj/mm/yyyy  
		
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
		<div class="content_article">
			<div class="posts_article">
				<div class="blog_post_img"><img src="<?php echo BASE_URL ; ?>/img/frontoffice/blog-post-title3.png" title="" alt=""></div>
				<h1><?php echo $v['name']; ?></h1>
				<div class="date_posts"><?php echo $dates.', '.$day;?></div>
				<div class="typearticle"><span><?php echo $formatDate; ?></span> tags: <span> Blog</span> par <span>Djayk</span> dans <span><?php echo $fl_Poststypes[$v['poststypes_id']]?></span>.</div>
				<div class="hr"></div>
				<div class="post_content"><?php echo $v['content']; ?></div>
				<div class="post_description" style="margin-left:-20px; margin-top:25px;"><?php echo $v['description']; ?></div>
				<?php 
				if(!empty($v['image'])){ ?>
					<div class="slideimg">
						<div class="set">
						  <div class="gallerie" style="margin-left:0px; margin-right:0px;"> 
						  <h1 style="margin-left:8px;"><?php echo $v['title_img']; ?></h1>
						  
							<?php
							/** 1ER SOLUTION AVEC 1 SEULE IMAGE
							$img=substr($post['image'], 3, -6);
							echo '<a href="'.BASE_URL .'/upload/images/'.$img.'" rel="lightbox[plants]" title="cliquez en dehors de l image pour fermer la fenêtre."><img class="gallerie_img_size border_magic" src="'.BASE_URL .'/upload/images/'.$img.'" alt="" title=""></a>';
							**/
							
							//Variable qui contient le chemin des images de ma gallerie, 
							//FileAndDir::directoryContent() va permettre de charger toutes les images qui se trouvent dans le dossier parent ou se situe l'image
							$gallerie = FileAndDir::directoryContent(UPLOAD.DS.'files/'.$v['image']);
							// pr($gallerie);
							foreach($gallerie as $k => $val){
								// pr($val);
								echo '<a href="'.BASE_URL .'/upload/files/'.$v['image'].'/'.$val.'" rel="lightbox[plants]" title="cliquez sur les flèches pour avancer."><img class="gallerie_img_size border_magic" src='.BASE_URL .'/upload/files/'.$v['image'].'/'.$val.' alt="'.$v['title_img'].'" title="'.$v['title_img'].'"></a>';
							};?>
						
						  </div>
						</div>
					</div>
				<?php 
				} ?>
			</div> 
		</div>
	
		<!-- FIN D'AFFICHAGE DE L'ARTICLE -->
		<!-- AFFICHAGE DES COMMENTAIRES -->
		<?php 
		//Variable qui contient le nombre de commentaires postés et validés
		$test = $this->get_nb_comments($v['id']);
		// Si il n'y a pas de commentaires, on affiche rien
		if(!empty($test)){
		// Si il y a l'option "formulaire de commentaire" coché pour cet article, alors j'affiche la ligne du dessous
			if($v['commentaires'] == 1){ ;?>
				<div class="content_article">
					<div class="posts_article">
						<div class="hr"></div>
						<h4 style="margin-bottom:20px;">Commentaires : <?php echo '('.$this->get_nb_comments($v['id']).')';?></h4>
						<?php 
						// Et j'affiche tous les commentaires pour l'article séléctionné.
						foreach($commentsposts as $k=>$val){
						
							/* Configure le script en français */
							setlocale (LC_TIME, 'fr_FR','fra');
							//Définit le décalage horaire par défaut de toutes les fonctions date/heure  
							date_default_timezone_set("Europe/Paris");
							//Definit l'encodage interne
							mb_internal_encoding("UTF-8");
							//Convertir une date US en françcais
							
							$dateFormatComments = $v['created'];
							$date_comments = strftime("%D-%T",strtotime("$dateFormatComments")); // affiche la date du commentaire en Français jj/mm/yyyy 
							// pr($date);
							
							// En fonction de l'article, j'affiche le bon commentaire
							if($val['posts_id'] == $v['id']){ 
							// J'affiche le commentaire ?>
								
								<div class="textarea_td commentaires_posts">
									<h5> <?php echo $userspseudo[$val['users_id']].'</br>';?> </h5> <?php
									echo $val['content']; 
									?><p class="created_comments"><?php echo $date_comments;?></p>
								</div> <?php 
							}
						} ?>
						<!-- PAGINATION -->
						<ul class="pagination">
							<li class="text"><a  href="<?php echo Router::url('posts/view/id:'.$v['id'].'/slug:'.$v['slug'].'/prefix:article').'?page=1'; ?>">First </a></li>
							<?php for($i=1; $i<= $nbPages; $i++) { ?>
							<li class="page"><a  href="<?php echo Router::url('posts/view/id:'.$v['id'].'/slug:'.$v['slug'].'/prefix:article').'?page='.$i; ?>"><?php echo $i ; ?></a></li>
							<?php } ?>
							<li class="text"><a href="<?php echo Router::url('posts/view/id:'.$v['id'].'/slug:'.$v['slug'].'/prefix:article').'?page='.$nbPages; ?>">Last</a></li>
						</ul>
					</div>
				</div>
			<?php 
			} 
		} ?>
		<!-- FIN DE L'AFFICHAGE DES COMMENTAIRES -->
		<?php
		// Si il y a un formulaire de commentaires pour cet article, et que l'utilisateur est connecté, j'affiche le formulaire de commentaires
		if($v['commentaires'] == 1 && Session::check('Backoffice.User.id')){?>
			<div class="content_article">
				<div class="posts_article">
					<div class="hr"></div>
					<img src="<?php echo BASE_URL ; ?>/img/frontoffice/comment.png" alt="comments" title="comments"><h3 style="margin-bottom:-35px; margin-top:-32px; margin-left:40px;">Ajouter un commentaire</h3>
					<a id="haut"></a>
					<?php 
					echo $this->helpers['Form']->create(array('method' => 'POST')); echo '</br>';
					echo $this->helpers['Form']->input('users_id', "", array('type'=> 'hidden', 'value'=> Session::read('Backoffice.User.id'))); echo '</br>';
					echo $this->helpers['Form']->input('posts_id', "", array('type'=> 'hidden', 'value'=> $v['id'])); echo '</br>';
					echo $this->helpers['Form']->input('content', "", array('type'=> 'textarea', 'cols' => 145, 'rows' => 5)); echo '</br>';
					echo $this->helpers['Form']->ckeditor('content'); echo '</br>';?>
					<div  class="extrabottom" style="float:right;margin-right:10px;">
						<input class="btn" type="submit" value="Envoyer" ><a href="#haut" ></a></input>
					</div>
				</div>
			</div>
		<?php 
		} ?>
	</div>
	<?php
	} ?>
