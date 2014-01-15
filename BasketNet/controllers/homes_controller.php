<?php
class HomesController extends AppController{

/**
* Cette fonction permet de charger tous les éléments présents sur la page d'accueil
* 	Au centre de la page :
* - les articles
* - les focus
* - les derniers matchs
* 	Les éléments de la colonne de droite :
* - Les prochains matchs
* - les derniers commentaires des articles postés 
* - Prochainement des bannières publicitaires, liens internes, liens externes ...
*
*/
	function index() {
		
		///////////////////////////////////////////
		//          	ARTICLES                 //
		///////////////////////////////////////////
		$this->loadModel('Post');
		$posts = $this->Post->find(array(
			'fields' => array('id','name', 'content', 'commentaires'),
			'conditions' => array('online'=> 1,),
			'order' => 'id DESC',
			'limit'=> '0, 3'
			)
		);
		$this->set('posts', $posts);
		
		///////////////////////////////////////////
		//          	FOCUS                    //
		///////////////////////////////////////////
		//on charge le model focus 
		$this->loadModel('Focu');
		//Requete sql où les conditions sont : en ligne dans l'ordre ASC et limité à 2 focus
		$focus = $this->Focu->find(
			array('conditions' => array(
			'online'=> 1,
			),
			'order' => 'id ASC',
			'limit'=> '0, 2'
			)
		);
		//On fait passer les données à la vue
		$this->set('focus', $focus);
		
		$conditions = array('online'=> 1 );//condition en ligne
		$focus_count = $this->Focu->findCount($conditions);//On compte le nbr de focus
		$this->set('focus_count', $focus_count); //On fait passer les données à la vue
		
		///////////////////////////////////////////
		//          	LAST GAME                //
		///////////////////////////////////////////
		//On charge le model game
		$this->loadModel('Game');
		//requète, conditions : Matchs terminés dans l'ordre DESC et limité à 3 résultats
		$last_games = $this->Game->find(
			array('conditions' => array(
			'end_game' => 1
			),
			'order' => 'date DESC',
			'limit'=> '0, 3'
			)
		); 
		$this->set('last_games', $last_games); //On fait passer les données à la vue
		//pr($datas);
		
		$conditions = array('end_game' => 1); // Condition : match terminé
		$last_games_count = $this->Game->findCount($conditions); // On compte le nbr de matchs terminés
		$this->set('last_games_count', $last_games_count); //On fait passer les données à la vue
		// pr($last_games_count);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesUser = $this->Categorie->find(); 
		$this->set('categoriesUser', $categoriesUser); //On fait passer les données à la vue
		// pr($categoriesUser);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesMatch = $this->Categorie->findList(); 
		$this->set('categoriesMatch', $categoriesMatch); //On fait passer les données à la vue
		// pr($equipes);
		
		/////////////////////////////////
		// RECUPERATION DE MON EQUIPE //
		
		$this->loadModel('Equipe');
		$equipeName = $this->Equipe->findList(); 
		$this->set('equipeName', $equipeName); //On fait passer les données à la vue
		// pr($equipeName);
		
		/////////////////////////////////
		// RECUPERATION DE L'ABREVIATION DU NOM DE EQUIPE //
		
		$this->loadModel('Equipe');
		$equipes_abreviations = $this->Equipe->findListAbreviation(); 
		$this->set('equipes_abreviations', $equipes_abreviations); //On fait passer les données à la vue
		// pr($equipes_abreviations);
		
		////////////////////////////////////////
		// RECUPERATION DU LOGO DE MON EQUIPE //
		
		$this->loadModel('Equipe');
		$equipes_logos = $this->Equipe->findListLogo(); 
		$this->set('equipes_logos', $equipes_logos); //On fait passer les données à la vue
		// pr($equipes);
		
		////////////////////////////////////////
		// RECUPERATION DE ICONE DE MON EQUIPE //
		
		$this->loadModel('Equipe');
		$equipes_icones = $this->Equipe->findListIcone(); 
		$this->set('equipes_icones', $equipes_icones); //On fait passer les données à la vue
		// pr($equipes_icones);
		

		///////////////////////////////////////
		// RECUPERATION DES EQUIPES ADVERSES //
		
		$this->loadModel('Adversaire');
		$equipes_adverses = $this->Adversaire->findList(); 
		$this->set('equipes_adverses', $equipes_adverses); //On fait passer les données à la vue
		// pr($equipes_adverses);
		
		/////////////////////////////////
		// RECUPERATION DE L'ABREVIATION DU NOM DE L'EQUIPE ADVERSE //
		
		$this->loadModel('Adversaire');
		$equipes_adverses_abreviations = $this->Adversaire->findListAbreviation(); 
		$this->set('equipes_adverses_abreviations', $equipes_adverses_abreviations); //On fait passer les données à la vue
		// pr($equipes_adverses_abreviations);
		
		/////////////////////////////////////////////////
		// RECUPERATION DES LOGOS DES EQUIPES ADVERSES //
		
		$this->loadModel('Adversaire');
		$equipes_adverses_logos = $this->Adversaire->findListLogo(); 
		$this->set('equipes_adverses_logos', $equipes_adverses_logos); //On fait passer les données à la vue
		// pr($equipes_adverses_logos);
		
		/////////////////////////////////////////////////
		// RECUPERATION DES LOGOS DES EQUIPES ADVERSES //
		
		$this->loadModel('Adversaire');
		$equipes_adverses_icones = $this->Adversaire->findListIcone(); 
		$this->set('equipes_adverses_icones', $equipes_adverses_icones); //On fait passer les données à la vue
		// pr($equipes_adverses_icones);
		
		///////////////////////////////////////////
		// RECUPERATION DES PSEUDOS DES UTILISATEURS //
		
		$this->loadModel('User');
		$userspseudo = $this->User->findListPseudo(); //On récupère les catégories
		$this->set('userspseudo', $userspseudo); //On les envois à la vue
		// pr($userspseudo);
		
		///////////////////////////////////////////
		// RECUPERATION DU NOM DU POSTS //
		
		$this->loadModel('Post');
		$fl_posts_name = $this->Post->findList(); 
		$this->set('fl_posts_name', $fl_posts_name); //On fait passer les données à la vue
		// pr($fl_posts_name);
		
		///////////////////////////////////////////
		//   ***    COLONNE DE DROITE    ***     //
		///////////////////////////////////////////
		
		///////////////////////////////////////////////
		// RECUPERATION DES MATCHS EN TETE D'AFFICHE //
		///////////////////////////////////////////////
		//On charge le model
		$this->loadModel('Game');
		//Condition de la requète : match pas terminé et limité à 3 résultats pour l'affichage
		$games = $this->Game->find(
			array('conditions' => array(
			'end_game' => 0
			),
			'limit'=> '0, 3'
			)
		); 
		$this->set('games', $games); //On fait passer les données à la vue
		//pr($datas);
		
		///////////////////////////////////////////////
		// RECUPERATION DES DERNIERS COMMENTAIRES    //
		///////////////////////////////////////////////
		//on charge le model
		$this->loadModel('Commentspost');
		//Conditions de la requète : Commentaires des articles en ligne limité à 3 résultats et dans l'ordre DESC
		$commentsposts = $this->Commentspost->find(
			array('conditions' => array(
			'online' => 1
			),
			'limit'=> '0, 3', 
			'order'=> 'id DESC'
			)
		); 
		$this->set('commentsposts', $commentsposts); //On fait passer les données à la vue
		// pr($commentsposts);
	}
}