<?php 
$title_for_layout = 'Résultat de la recherche'; 
$description_for_layout = 'description de la page résultat de la recherche'; 
?>
<div class="article">
	<div class="hr"></div>
	<div class="titre_article">
		<h1>Résultat de la recherche <?php echo '" '.$_GET['q'].' "';?></h1>
	</div>
	<div class="content_article">
		<div class="posts_article">
			<?php 
			// pr($q);
			
			foreach($search as $k=>$v){ ?>
				<div class="blog_post_img"><img src="<?php echo BASE_URL ; ?>/img/frontoffice/blog-post-title3.png" title="" alt=""></div>
				<h1><?php echo $v['name']; ?></h1>
				<div class="date_posts">Janv, 20</div>
				<div class="typearticle"><span>Janv, 20 </span> tags :<span>Sport</span> par <span>Djayk</span> dans <span> Articles</span>.</div>
				<div class="hr"></div>
				<?php 
				// $q = $v['content']; 
				// pr($q);
				// $s= explode("/>", $q);
				// pr($s);
				// foreach($s as $mot){
					// $te = explode(" ", $mot);
					// foreach($te as $test){
						// pr($test);
						// if(in_array('alex')){ echo 'plop';}
						
					// }
				// }
				?>
				<div class="post_content" style="margin-bottom:80px;"><?php echo $v['content']; ?></div>
			<?php }?>
		</div> 
	</div>	
</div>

