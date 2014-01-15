<?php $title_for_layout = $post['name']; ?>
<?php $description_for_layout = $post['name']; ?>
<div class="grid_16 article_detail">
	<div class="hr"></div>
	<h1>Détail de l'article : <?php echo $post['name'] ; ?></h1>
	<div class="content_article">
		<div class="posts_article">
			<div class="blog_post_img"><img src="<?php echo BASE_URL ; ?>/img/blog-post-title3.png" title="" alt=""></div>
			<h1><?php echo $post['name']; ?></h1>
			<div class="date_posts">Janv, 20</div>
			<div class="typearticle"><span>Janv, 20 </span> tags :<span>Sport</span> par <span>Djayk</span> dans <span> Articles</span>.</div>
			<div class="hr"></div>
			<div class="post_image"><img src="<?php echo BASE_URL ; ?>/img/187_100.jpg" title="" alt=""></div>
			<div class="post_content"><?php echo 'Content '.$post['content']; ?></div>
		</div> 
	</div>
</div>

