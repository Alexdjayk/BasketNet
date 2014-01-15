<?php
class CategoriesController extends AppController{

/**
* Fonction index de la class CategoriesController, permet d'afficher les catégories d'équipes
**/
	function index() {
		///////////////////////////////////////////
		//          	LAST GAME CAT            //
		///////////////////////////////////////////
		// $this->loadModel('Categorie');
		$last_games_cat = $this->Categorie->find(); 
		$this->set('last_games_cat', $last_games_cat); //On fait passer les données à la vue
		//requete ou l'id est dif de 0
		$categories= $this->Categorie->find(array(
			'conditions'=> 'id != 0'
		));
		$this->set('categories', $categories);
		// pr($categories_id);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesUser = $this->Categorie->find(); 
		$this->set('categoriesUser', $categoriesUser); //On fait passer les données à la vue
		// pr($categoriesUser);
	}
	
/**
* La fonction view permet d'afficher la liste des matchs par catégories 
*
* @param int $categorie Catégorie des matchs
**/
	function view($categories_id) {
		$conditions = array('id'=> $categories_id);
		$categories= $this->Categorie->find(array(
			'conditions'=> $conditions
		));
		$this->set('categories', $categories);
		// pr($categories_id);
		
		///////////////////////////////////////////
		//          	LAST GAME                //
		///////////////////////////////////////////
		$this->loadModel('Game');
		$last_games = $this->Game->find(
			array('conditions' => array(
			'categories_id' => $categories_id,
			'end_game' => 1
			))
		); 
		$this->set('last_games', $last_games); //On fait passer les données à la vue
		//pr($last_games);
		
		///////////////////////////////////////////
		//        MOIS DU LAST GAME              //
		///////////////////////////////////////////
		$this->loadModel('Game');
		$last_games_month = $this->Game->find(
			array('conditions' => array(
			'categories_id' => $categories_id,
			'end_game' => 1
			),
			'limit' => ('0,1')
			)
		); 
		$this->set('last_games_month', $last_games_month); //On fait passer les données à la vue
		// pr($last_games_month);
		
		//////////////////////////////////////////////
		// RECUPERATION DU MATCH EN TETE D'AFFICHE  //
		//////////////////////////////////////////////
		$this->loadModel('Game');
		$games = $this->Game->find(
			array('conditions' => array(
			'end_game' => 0,
			'categories_id' => $categories_id
			),
			'limit'=> '0, 3'
			)
		); 
		$this->set('games', $games); //On fait passer les données à la vue
		//pr($datas);	
		
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
		
		/////////////////////////////////////
		// RECUPERATION DES TYPES DE MATCHS//
		
		$this->loadModel('Gamestype');
		$lesGamestypes = $this->Gamestype->findList(); //On récupère les saisons
		$this->set('lesGamestypes', $lesGamestypes); //On les envois à la vue
		// pr($lesGamestypes);
	}
}