<?php
class NextgamesController extends AppController{

	
/** 
* La Fonction backoffice_index permet d'afficher tous les posts de type 2 et ainsi avoir la possibilité de modifier, ajouter, supprimer les posts.
**/
	function backoffice_index(){
		
		$this->loadModel('Game');
		
		// fonction pagination
		$d['elementPerPage'] = 5; // NB d'elements par pages 
		$d['page'] = $this->request->page; // Nb de pages (voir fonction request)
		// pr($this->request);
		$limit = $d['elementPerPage'] * ($d['page']-1); // limit par pages
		$conditions = array('end_game' => 0);
		$d['nbGames'] = $this->Game->findCount($conditions);
		$d['games'] = $this->Game->find(array(
			'conditions'=> $conditions,
			'limit'=> $limit.', '.$d['elementPerPage'],
		));
		$d['nbPages'] = ceil($d['nbGames'] / $d['elementPerPage']); 
		$this->set($d);
		
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categories = $this->Categorie->findList(); 
		$this->set('categories', $categories); //On fait passer les données à la vue
		// pr($equipes);
		
		/////////////////////////////////
		// RECUPERATION DE MON EQUIPE //
		
		$this->loadModel('Equipe');
		$equipes = $this->Equipe->findList(); 
		$this->set('equipes', $equipes); //On fait passer les données à la vue
		// pr($equipes);
		
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
		
		///////////////////////////////////////////////////////////////
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
		// RECUPERATION DU LIEU DU MATCH //
		
		$this->loadModel('Stade');
		$stades = $this->Stade->findList(); 
		$this->set('stades', $stades); //On fait passer les données à la vue
		// pr($stades);
		
	}
	
	/** 
	* La Fonction backoffice_add permet d'ajouter des articles
	*
	* @param 
	**/
	function backoffice_add(){
		
		// Je charge le model Game
		$this->loadModel('Game');
		
		//Si il y  a des données postées 
		if($this->request->data){
			
			// Si les données postées sont validées
			if($this->Game->validates($this->request->data)) {
			
				// Je sauvegarde les données postées
				$this->Game->save($this->request->data);
				
				// Message de confirmation
				Session::setFlash("Elément ajouté");
				
				// On redirige vers la page d'accueil des articles
				$this->redirect('/adm/nextgames/index');
			} else {
				//Variable qui contient les index d'erreurs dans la page Game du dossier model
				$errors = $this->Game->errors;
				// Variable qui contient un message d'erreur
				$message = "Erreur dans le formulaire ";
				// Je parcours les index d'erreurs 
				foreach($errors as $k => $v){
					// Je concatene le message d'erreur avec le message d'erreur de l'index où il y a l'erreur
					$message .= $v.'</br>';
				}
				// J'affiche les 2 messages d'erreurs 
				Session::setFlash($message, 'error');
			}
		}
		
		///////////////////////////////////////////
		// RECUPERATION DU LIEU DU MATCH //
		
		$this->loadModel('Stade');
		$stades = $this->Stade->findList(); 
		$this->set('stades', $stades); //On fait passer les données à la vue
		// pr($stades);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categories = $this->Categorie->findList(); 
		$this->set('categories', $categories); //On fait passer les données à la vue
		// pr($equipes);
		
		///////////////////////////////////////
		// RECUPERATION DES EQUIPES ADVERSES //
		
		$this->loadModel('Adversaire');
		$equipes_adverses = $this->Adversaire->findList(); 
		$this->set('equipes_adverses', $equipes_adverses); //On fait passer les données à la vue
		// pr($equipes_adverses);
		
		/////////////////////////////////
		// RECUPERATION DE MON EQUIPE //
		
		$this->loadModel('Equipe');
		$equipes = $this->Equipe->findList(); 
		$this->set('equipes', $equipes); //On fait passer les données à la vue
		// pr($equipes);
	}
	
	
	/** 
	* La Fonction backoffice_add permet d'éditer des articles
	*
	* @param 
	**/
	function backoffice_edit($id){
		// Je charge le model Game
		$this->loadModel('Game');
		//Si il y  a des données postées 
		if($this->request->data){
			// Si les données postées sont validées
			if($this->Game->validates($this->request->data)) {
				// Je sauvegarde les données postées
				$this->Game->save($this->request->data);
				// Message de confirmation
				Session::setFlash("Elément modifié");
				
				// On redirige vers la page d'accueil des articles
				$this->redirect('/adm/nextgames/index');	
				
			} else {
				//Variable qui contient les index d'erreurs dans la page Game du dossier model
				$errors = $this->Game->errors;
				// Variable qui contient un message d'erreur
				$message = "Erreur dans le formulaire ";
				// Je parcours les index d'erreurs 
				foreach($errors as $k => $v){	
					// Je concatene le message d'erreur avec le message d'erreur de l'index où il y a l'erreur
					$message .= $v.'</br>';
				}
				// J'affiche les 2 messages d'erreurs 
				Session::setFlash($message, 'error');
			}
		}
		// On récupère les données déjà postées
		$edit = $this->Game->findFirst(
			array('conditions' => array(
			'id'=>$id
			))
		);
		$this->request->data = $edit;
		$this->set('id', $id);
		
		///////////////////////////////////////////
		// RECUPERATION DU LIEU DU MATCH //
		
		$this->loadModel('Stade');
		$stades = $this->Stade->findList(); 
		$this->set('stades', $stades); //On fait passer les données à la vue
		// pr($stades);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categories = $this->Categorie->findList(); 
		$this->set('categories', $categories); //On fait passer les données à la vue
		// pr($equipes);
		
		///////////////////////////////////////
		// RECUPERATION DES EQUIPES ADVERSES //
		
		$this->loadModel('Adversaire');
		$equipes_adverses = $this->Adversaire->findList(); 
		$this->set('equipes_adverses', $equipes_adverses); //On fait passer les données à la vue
		// pr($equipes_adverses);
		
		/////////////////////////////////
		// RECUPERATION DE MON EQUIPE //
		
		$this->loadModel('Equipe');
		$equipes = $this->Equipe->findList(); 
		$this->set('equipes', $equipes); //On fait passer les données à la vue
		// pr($equipes);
	}
	
	/** 
	* La Fonction backoffice_delete permet de supprimer tous les posts de type 2.
	* @param $id identifiant du post 
	**/
	function backoffice_delete($id){
		// On charge le model Categorie
		$this->loadModel('Game');
		// si la suppression de l'id est vrai on le supprime
		if($this->Game->delete($id)){
			// On affiche un message de confirmation
			Session::setFlash("L'élément a bien été supprimé");
		} else {
			// sinon on retourne un message d'erreur
			Session::setFlash("L'élément n'a pas été supprimé", 'error');
		}
		// On redirige  
		$this->redirect('adm/nextgames/index');
	}
}