<?php 
$title_for_layout = 'Liste des articles'; 
$description_for_layout = 'description de la page des articles'; 
?>
<div class="article">
	<div class="hr"></div>
	<div class="titre_article">
		<h1>Liste des utilisateurs</h1>
	</div>
	<div class="content_article">
		<?php 
		// Je foreach la variable $post qui va nous permettre d'afficher la liste des articles
		foreach ($posts as $k => $v) { ?>
			<div class="posts_article">
				<div class="blog_post_img"><img src="<?php echo BASE_URL ; ?>/img/blog-post-title3.png" title="" alt=""></div>
				<h1><a href="<?php echo Router::url('posts/view/id:'.$v['id'].'/slug:'.$v['slug'].'/prefix:article'); ?>" title="<?php echo $v['name']; ?>" alt="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></a></h1>
				<div class="date_posts">Janv, 20</div>
				<div class="typearticle"><span>Janv, 20 </span> tags :<span>Sport</span> par <span>Djayk</span> dans <span> Articles</span>.</div>
				<div class="hr"></div>
				<div class="post_image"><img src="<?php echo BASE_URL ; ?>/img/187_100.jpg" title="" alt=""></div>
				<div class="post_content"><?php echo 'Content '.$v['content']; ?></div>
			</div> <?php
		}
		// pr($posts);
		//Pagination de la liste des articles ?>
		<div class="clear"></div>
		<div class="container_16 pagination">
			<!--?page= On recupère les num des pages en $_GET -->
			<ul>
				<li><a href="<?php echo Router::url('blog').'?page=1'; ?>">First </a></li>
				<?php for($i=1; $i<= $nbPages; $i++) { ?>
				<li><a href="<?php echo Router::url('blog').'?page='.$i; ?>"><?php echo $i ; ?></a></li>
				<?php } ?>
				<li><a href="<?php echo Router::url('blog').'?page='.$nbPages; ?>">last</a></li>
			</ul>
		</div>
	</div>	
</div>

