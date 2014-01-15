<?php
class GamesController extends AppController{

/**
* Cette fonction permet de charger les derniers résultats des matchs
*
*/
	function index() {
		
		///////////////////////////////////////////
		//          	LAST GAME                //
		///////////////////////////////////////////
		// // $this->loadModel('Game');
		$last_games = $this->Game->find(
			array('conditions' => array(
			'end_game' => 1,
			),
			'order' => 'date ASC',
			)
		); 
		$this->set('last_games', $last_games); //On fait passer les données à la vue
		//pr($datas);

		$conditions = array('end_game' => 1);
		$last_games_count = $this->Game->findCount($conditions);
		$this->set('last_games_count', $last_games_count); //On fait passer les données à la vue
		// pr($last_games_count);
		
		////////////////////////////////////////////////////
		// RECUPERATION DE L'ABREVIATION DU NOM DE EQUIPE //
		
		$this->loadModel('Equipe');
		$equipes_abreviations = $this->Equipe->findListAbreviation(); 
		$this->set('equipes_abreviations', $equipes_abreviations); //On fait passer les données à la vue
		// pr($equipes_abreviations);

		//////////////////////////////////////////////////////////////
		// RECUPERATION DE L'ABREVIATION DU NOM DE L'EQUIPE ADVERSE //
		
		$this->loadModel('Adversaire');
		$equipes_adverses_abreviations = $this->Adversaire->findListAbreviation(); 
		$this->set('equipes_adverses_abreviations', $equipes_adverses_abreviations); //On fait passer les données à la vue
		// pr($equipes_adverses_abreviations);
		

		////////////////////////////////////////
		// RECUPERATION DE ICONE DE MON EQUIPE //
		
		$this->loadModel('Equipe');
		$equipes_icones = $this->Equipe->findListIcone(); 
		$this->set('equipes_icones', $equipes_icones); //On fait passer les données à la vue
		// pr($equipes_icones);


		/////////////////////////////////////////////////
		// RECUPERATION DES LOGOS DES EQUIPES ADVERSES //
		
		$this->loadModel('Adversaire');
		$equipes_adverses_icones = $this->Adversaire->findListIcone(); 
		$this->set('equipes_adverses_icones', $equipes_adverses_icones); //On fait passer les données à la vue
		// pr($equipes_adverses_icones);
	
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesMatch = $this->Categorie->findList(); 
		$this->set('categoriesMatch', $categoriesMatch); //On fait passer les données à la vue
		// pr($equipes);
		
		///////////////////////////////////////////
		// RECUPERATION DU LIEU DU MATCH //
		
		$this->loadModel('Stade');
		$stades = $this->Stade->findList(); 
		$this->set('stades', $stades); //On fait passer les données à la vue
		// pr($stades);
		
		/////////////////////////////////////
		// RECUPERATION DES TYPES DE MATCHS//
		
		$this->loadModel('Gamestype');
		$lesGamestypes = $this->Gamestype->findList(); //On récupère les saisons
		$this->set('lesGamestypes', $lesGamestypes); //On les envois à la vue
		// pr($lesGamestypes);
		
		
		
		/////////////////////////////////
		// RECUPERATION DE MON EQUIPE //
		
		$this->loadModel('Equipe');
		$equipeName = $this->Equipe->findList(); 
		$this->set('equipeName', $equipeName); //On fait passer les données à la vue
		// pr($equipeName);
		
		////////////////////////////////////////
		// RECUPERATION DU LOGO DE MON EQUIPE //
		
		$this->loadModel('Equipe');
		$equipes_logos = $this->Equipe->findListLogo(); 
		$this->set('equipes_logos', $equipes_logos); //On fait passer les données à la vue
		// pr($equipes);
		
		///////////////////////////////////////
		// RECUPERATION DES EQUIPES ADVERSES //
		
		$this->loadModel('Adversaire');
		$equipes_adverses = $this->Adversaire->findList(); 
		$this->set('equipes_adverses', $equipes_adverses); //On fait passer les données à la vue
		// pr($equipes_adverses);
		
		/////////////////////////////////////////////////
		// RECUPERATION DES LOGOS DES EQUIPES ADVERSES //
		
		$this->loadModel('Adversaire');
		$equipes_adverses_logos = $this->Adversaire->findListLogo(); 
		$this->set('equipes_adverses_logos', $equipes_adverses_logos); //On fait passer les données à la vue
		// pr($equipes_adverses_logos);
	}
	
/**
* Cette fonction permet de charger les matchs en détails avec la possibilité de commenter le match
*
* @param	$id		INT		identifiant du match
*/
	function view($id) {
		
		///////////////////////////////////////////
		//          	LAST GAME                //
		///////////////////////////////////////////
		
		// Variable qui contient le résultat de la requète, ou les matchs sont terminés
		$last_games = $this->Game->find(
			array('conditions' => array(
			'id'=> $id,
			'end_game' => 1
			))
		); 
		$this->set('last_games', $last_games); //On fait passer les données à la vue
		//Variable qui contient les matchs ciblés et qui sont terminés (end-game)
		$game = $this->Game->findFirst(
			array('conditions' => array(
			'id'=>$id,
			'end_game'=> 1
			))
		);
		$this->set('game', $game); //On fait passer les données à la vue
		
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
		
		///////////////////////////////////////////
		// RECUPERATION DU LIEU DU MATCH //
		
		$this->loadModel('Stade');
		$stades = $this->Stade->findList(); 
		$this->set('stades', $stades); //On fait passer les données à la vue
		// pr($stades);
		
		/////////////////////////////////////
		// RECUPERATION DES TYPES DE MATCHS//
		
		$this->loadModel('Gamestype');
		$lesGamestypes = $this->Gamestype->findList(); //On récupère les saisons
		$this->set('lesGamestypes', $lesGamestypes); //On les envois à la vue
		// pr($lesGamestypes);
		
		///////////////////////////////////////////
		// RECUPERATION DES PSEUDOS DES UTILISATEURS //
		
		$this->loadModel('User');
		$userspseudo = $this->User->findListPseudo(); //On récupère les catégories
		$this->set('userspseudo', $userspseudo); //On les envois à la vue
		// pr($userspseudo);
		
		/////////////////////////////////
		// RECUPERATION DE MON EQUIPE //
		
		$this->loadModel('Equipe');
		$equipeName = $this->Equipe->findList(); 
		$this->set('equipeName', $equipeName); //On fait passer les données à la vue
		// pr($equipeName);
		
		////////////////////////////////////////
		// RECUPERATION DU LOGO DE MON EQUIPE //
		
		$this->loadModel('Equipe');
		$equipes_logos = $this->Equipe->findListLogo(); 
		$this->set('equipes_logos', $equipes_logos); //On fait passer les données à la vue
		// pr($equipes);
		
		///////////////////////////////////////
		// RECUPERATION DES EQUIPES ADVERSES //
		
		$this->loadModel('Adversaire');
		$equipes_adverses = $this->Adversaire->findList(); 
		$this->set('equipes_adverses', $equipes_adverses); //On fait passer les données à la vue
		// pr($equipes_adverses);
		
		/////////////////////////////////////////////////
		// RECUPERATION DES LOGOS DES EQUIPES ADVERSES //
		
		$this->loadModel('Adversaire');
		$equipes_adverses_logos = $this->Adversaire->findListLogo(); 
		$this->set('equipes_adverses_logos', $equipes_adverses_logos); //On fait passer les données à la vue
		// pr($equipes_adverses_logos);
		
		///////////////////////////////
		// GESTION DES COMMENTAIRES //
		//////////////////////////////
		
		// fonction pagination
		$d['elementPerPage'] = 10; // NB d'elements par pages 
		$d['page'] = $this->request->page; // Nb de pages (voir fonction request)
		$limit = $d['elementPerPage'] * ($d['page']-1); // limit par pages
		// Je charge le model Commentsgame
		$this->loadModel('Commentsgame');
		$conditions = array('online'=> 1, 'games_id'=>$id);
		$d['nbCommentsgames'] = $this->Commentsgame->findCount($conditions);
		$d['commentsgames'] = $this->Commentsgame->find(array(
			'conditions'=> $conditions,
			'limit'=> $limit.', '.$d['elementPerPage'],
		));
		$d['nbPages'] = ceil($d['nbCommentsgames'] / $d['elementPerPage']); 
		// pr($d);
		// pr($_GET);
		$this->set($d);
	
		// Je charge le model Commentsgame
		$this->loadModel('Commentsgame');
		$commentairesGames = $this->Commentsgame->find(
			array('conditions' => array(
			'games_id'=>$id,
			'online'=> 1
			))
		);
		// je rends la variable accessible à la vue
		$this->set('commentairesGames', $commentairesGames);	
		
		////////////////////////////
		// AJOUT DE COMMENTAIRES //
		
		//Si il y  a des données postées 
		if($this->request->data){	
			// Si les données postées sont validées
			if($this->Commentsgame->validates($this->request->data)) {
				// Je sauvegarde les données postées
				$this->Commentsgame->save($this->request->data);
				// Message de confirmation
				$message ='Votre commentaire a bien été prise en compte, il sera diffusé après validation par notre modérateur';
				Session::setFlash($message, 'confirmation');
			
				// On redirige vers la page d'accueil des articles
				$this->redirect('/games/view/'.$id);
			} else {
				//Variable qui contient les index d'erreurs dans la page Commentsgame du dossier model
				$errors = $this->Commentsgame->errors;
				// Variable qui contient un message d'erreur
				$message = "Erreur dans le formulaire ";
				// Je parcours les index d'erreurs 
				foreach($errors as $k => $v){	
					// Je concatene le message d'erreur avec le message d'erreur de l'index où il y a l'erreur
					$message .= $v.'</br>';
				}
				// J'affiche les 2 messages d'erreurs 
				$this->set('message', $message);
				Session::setFlash($message, 'error');
			}
		}
	}
	
/**
* Cette fonction permet de charger les derniers matchs terminés pour le backoffice (CRUD)
*
*/
	function backoffice_index(){
		//On charge le model Game
		$this->loadModel('Game');
		
		/////////////////////
		// MATCHS TERMINES //
		/////////////////////
		
		// fonction pagination
		$a['elementPerPage'] = 25; // NB d'elements par pages 
		$a['page'] = $this->request->page; // Nb de pages (voir fonction request)
		// pr($this->request);
		$limit = $a['elementPerPage'] * ($a['page']-1); // limit par pages
		$conditions = array('end_game' => 1); // Match terminé
		$a['nbGames'] = $this->Game->findCount($conditions); //On compte le nbr de match en fonction des conditions
		// variable qui contient le résultat de la requète pour les matchs, avec les conditions, order by et limit
		$a['nextgames'] = $this->Game->find(array( 
			'conditions'=> $conditions,
			'order' => 'id DESC',
			'limit'=> $limit.', '.$a['elementPerPage'],
		));
		$a['nbPages2'] = ceil($a['nbGames'] / $a['elementPerPage']); 
		$this->set($a);
		//Match terminé
		$conditions = array('end_game'=> 1);
		//On compte le nbr de matchs terminés
		$nbNextgames = $this->Game->findCount($conditions);
		// On les rends accessible à la vue
		$this->set('nbNextgames', $nbNextgames);
		// Chargement du fichier qui contient tous les findlists 
		require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
	}
	
	/**
	* fonction backoffice_nextgames permet d'afficher la liste des prochains matchs 
	*
	**/
		function backoffice_nextgames(){
		//on charge le model
		$this->loadModel('Game');
		// fonction pagination
		$d['elementPerPage'] = 25; // NB d'elements par pages 
		$d['page'] = $this->request->page; // Nb de pages (voir fonction request)
		// pr($this->request);
		$limit = $d['elementPerPage'] * ($d['page']-1); // limit par pages
		//Conditions matchs pas terminés
		$conditions = array('end_game' => 0);
		$d['nbGames'] = $this->Game->findCount($conditions);
		$d['games'] = $this->Game->find(array(
			'conditions'=> $conditions,
			'order' => 'id DESC',
			'limit'=> $limit.', '.$d['elementPerPage'],
		));
		$d['nbPages'] = ceil($d['nbGames'] / $d['elementPerPage']); 
		$this->set($d);
		//Conditions matchs pas terminés
		$conditions = array('end_game'=> 0);
		$nbGames = $this->Game->findCount($conditions);
		$this->set('nbGames', $nbGames);
		// Chargement du fichier qui contient tous les findlists 
		require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
	}
}