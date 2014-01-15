<?php 
$control = $this->request->controller;
$action = $this->request->action;
$params = $this->request->params;
// pr($control);
?>
<a href="<?php echo Router::url('homes/index'); ?>" alt="" title="" style="color:#333;" ><img src="<?php echo BASE_URL ;?>/img/frontoffice/accueil.png" alt="Accueil" title="Accueil" style="margin-top:-15px;" ></a><span style="color:#006cb7;"> » </span>
<?php
// FIL D'ARIANE POUR LES ARTICLES //
//Si le controlleur est égal à posts
if($control == 'posts'){
	//je le renomme Articles
	$control = 'Articles';
	//j'affiche le fil d'ariane avec le lien vers le controlleur de l'article (posts)
	echo '<a href="'.Router::url($this->request->controller).'" alt="" title="" style="color:#333;" >'.$control.' </a>';

	//Je parcours les paramètres 
	foreach($params as $k => $v){
		//si la clé est égale à 1 
		if($k == 1){
			//J'affiche le nom du posts
			echo '<span style="color:#006cb7;"> » </span>'.$posts['name'];
		}
	}
}

// FIL D'ARIANE POUR LES GALLERIES //
//Si le controlleur est différent d'Articles et est égal à pictures
if($control != 'Articles' && $control == 'pictures'){
	if($control == 'pictures'){
		//Je renomme le controlleur 
		$control = 'Galleries';
		//j'affiche le fil d'ariane avec le lien vers le controlleur de la gallerie 
		echo '<a href="'.Router::url($this->request->controller).'" alt="" title="" style="color:#333;" >'.$control.' </a>';
	}
	//si les paramètres ne sont pas empty
	if(!empty($params)){
		//Je parcours la variable pictures
		foreach($pictures as $k => $v){
			//et j'affiche le nom de la gallerie ciblée
			echo '<span style="color:#006cb7;"> » </span>'.$v['name'];
		}
	}
}

// FIL D'ARIANE POUR LES CATEGORIES D'EQUIPES //
//Si le controlleur est égal à categories
if($control == 'categories'){
	if($control == 'categories'){
		//je le renomme 
		$control = 'Catégories';
			//j'affiche le fil d'ariane avec le lien vers le controlleur de la catégories
		echo '<a href="'.Router::url($this->request->controller).'" alt="" title="" style="color:#333;" >'.$control.' </a>';
		
		//si les paramètres ne sont pas empty
		if(!empty($params)){
			//Je parcours la variable categories
			foreach($categories as $k => $v){ 
				//et j'affiche le nom de la catégorie ciblée ?>
				<span style="color:#006cb7;"> » </span><a href="<?php echo Router::url('categories/view/'.$v['id']); ?>" alt="" title="" style="color:#333;" ><?php echo $v['name']; ?></a>
			<?php
			}
		}
	}
	
}

// FIL D'ARIANE POUR LES MATCHS //
//Si le controlleur est égal à categories
if($control == 'games'){
	if($control == 'games'){
		//je le renomme 
		$control = 'Matchs';
			//j'affiche le fil d'ariane avec le lien vers le controlleur du match
		echo '<a href="'.Router::url($this->request->controller).'" alt="" title="" style="color:#333;" >'.$control.' </a>';
	}
	//si les paramètres ne sont pas empty
	if(!empty($params)){ 
		
		//et j'affiche le nom du match ciblé avec le lien de la categorie du match ?>
		<span style="color:#006cb7;"> » </span><a href="<?php echo Router::url('categories/view/'.$games['categories_id']); ?>" alt="" title="" style="color:#333;" ><?php echo $categoriesMatch[$games['categories_id']]; ?></a> <?php
	}
}

// FIL D'ARIANE POUR LES PAGES //
// ********* A REVOIR ********//
//Si le controlleur est égal à pages
if($control == 'pages'){
	
	//si les paramètres ne sont pas empty
	if(!empty($params)){
		//et j'affiche le nom de la page
		echo $page['name'];
	}
}
