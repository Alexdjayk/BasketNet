<?php

/** Ensemble des descriptions des différentes routes**/
Router::prefix('adm', 'backoffice'); // definition du prefixe backoffice


//  - A gauche l'url voulue
//  - A droite l'url renseignée dans les vues


////////////////////////////////////////
// 			REGLE FRONTOFFICE         //
///////////////////////////////////////

// Détail d'un article + listing

//Affichage du détail d'un post
Router::connect(':prefix/:slug-:id', 		'posts/view/id:([0-9]+)/slug:([a-zA-Z0-9\-]+)/prefix:([a-zA-Z0-9\-]+)'); 	

//listing des posts
Router::connect('blog', 					'posts/index'); 

//listing des utilisateurs
Router::connect('connexion', 				'users/login');

//listing des utilisateurs 
Router::connect('adm', 						'posts/backoffice_index');

Router::connect(':slug-:id', 				'pages/view/id:([0-9]+)/slug:([a-zA-Z0-9\-]+)'); 	

// listing des posts en backoffice
Router::connect('blog_backoffice', 			'adm/posts/index'); 

// listing des comptes
Router::connect('Creation-de-compte', 			'users/newcompte'); 

// listing des comptes à éditer
Router::connect('Editer-mon-compte', 			'users/editcompte'); 

// listing de la page d'accueil
Router::connect('Page-d-accueil', 			'homes/index'); 

// listing de la gallerie
Router::connect('Gallerie', 			'pictures/index'); 

// listing des catégories d'équipes
Router::connect('categories-d-equipes', 			'categories/index'); 

// listing de la page de contact
Router::connect('nous-contacter', 			'contacts/index'); 
?>