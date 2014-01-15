<?php
class UsersController extends AppController{

/** 
* La Fonction login permet d'accéder sur la page de connexion. 
* On utilise la fonction sha1 pour crypter les mots de passes donc on l'utilise içi pour vérifier si le mdp correspond avec celui de la bdd
*
**/
	function login() {
		// On change le layout
		$this->layout = 'connect';
		// Chargement du model
		$this->loadModel('User');
		// Affectation des données postées à une variable
		$datas = $this->request->data;
		// Si il y a des données postées et qu'elles ne sont pas vides
		if(($datas) && !empty($datas)){
			$message='';
			//affectation de la fonction sha1 au password pour qu'il soit identique avec celui de la bdd
			$datas['password'] = sha1($datas['password']);
			//Affectation des données login et password dans des variables
			$login = $datas['login'];
			$password = $datas['password'];
			//Affectation de la comparaison entre les données postées et celles de la bdd pour le login
			$user = $this->User->findFirst(
				array(
					'conditions' => array(
						'login' => $login
					),
				)
			);
			// pr($datas['password']);
			// Si la variable $user n'est pas vide 
			if(!empty($user)){
				//Récupération des données de l'utilisateur dans des variables
				$bddPassword = $user['password'];
				//Si le password est égale à celui de la bdd
				if($password == $bddPassword){
					Session::write('Backoffice.User', $user);
					// On redirige vers la page d'accueil du backoffice 
					// Si l'utilisateur à un role de niveau 3 il accède au backoffice
					if(Session::read('Backoffice.User.roles_id') == 3) {
							$this->redirect('adm');
						// Sinon il est redirigé vers la page d'accueil
						} else {
							$this->redirect('/homes/index');
						}
				} else {$message = "Le mot de pass n'est pas correct";}
			} else {$message = "Le login n'est pas correct"; }
			// J'affiche les 2 messages d'erreurs 
			Session::setFlash($message, 'error');
		} 	
	}
	
/** 
* La Fonction logout permet de supprimer la variable de session, donc de se déconnecter 
*
**/
	function logout() {
		// On détruit notre session
		session_destroy();
		// On redirige vers la page d'accueil des articles
		 $this->redirect('/homes/index');
	}
	
	
/**
* La fonction compte permet d'afficher les informations du compte de l'utilisateur 
*
*
**/
	function compte(){
		//on charge le model user
		$this->loadModel('User');
		//Conditions : l'id est égal à celui de la session de l'utilisateur
		$conditions = array('id' => Session::read('Backoffice.User.id'));
		$compte = $this->User->find(array(
			'conditions'=> $conditions,
		));
		$this->set('compte', $compte);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesUser = $this->Categorie->find(); 
		$this->set('categoriesUser', $categoriesUser); //On fait passer les données à la vue
		// pr($categoriesUser);
		
		///////////////////////////////////////
		// RECUPERATION DES DONNEES DU SITE //
		
		$this->loadModel('Website');
		$websites = $this->Website->find(); //On récupère les saisons
		$this->set('websites', $websites); //On les envois à la vue
		// pr($websites);
		
		/////////////////////////////////////
		// RECUPERATION DES TYPES D'UTILISATEURS//
		
		$this->loadModel('Userstype');
		$lesUserstypes = $this->Userstype->findList(); //On récupère les saisons
		$this->set('lesUserstypes', $lesUserstypes); //On les envois à la vue
		// pr($lesUserstypes);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesMatch = $this->Categorie->findList(); 
		$this->set('categoriesMatch', $categoriesMatch); //On fait passer les données à la vue
		// pr($equipes);
		
		///////////////////////////////////////////
		// RECUPERATION DU ROLE DE L'UTILISATEUR //
		
		$this->loadModel('Role');
		$fl_Roles = $this->Role->findList(); 
		$this->set('fl_Roles', $fl_Roles); //On fait passer les données à la vue
		// pr($fl_Roles);
	}
	
	
/** 
* La Fonction backoffice_index permet d'afficher tous les utilisateurs de type 1 et 2 et ainsi avoir la possibilité de modifier, ajouter, supprimer.
*
**/
	function backoffice_index(){
		
		// $this->loadModel('User');
		// fonction pagination
		$d['elementPerPage'] = 25; // NB d'elements par pages 
		$d['page'] = $this->request->page; // Nb de pages (voir fonction request)
		// pr($this->request);
		$limit = $d['elementPerPage'] * ($d['page']-1); // limit par pages
		//le rôle de l'utilisateur est différent de 3
		$conditions = 'roles_id != 3';
		$d['nbUsers'] = $this->User->findCount($conditions);
		$d['users'] = $this->User->find(array(
			'conditions'=> $conditions,
			'limit'=> $limit.', '.$d['elementPerPage'],
		));
		$d['nbPages'] = ceil($d['nbUsers'] / $d['elementPerPage']); 
		$this->set($d);
		//Chargement des différents findlist
		require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
	}
	
/**
* La fonction compte permet d'afficher les informations du compte de l'utilisateur superadmin
*
*
**/
	function backoffice_moncompte(){
	
		// $this->loadModel('User');
		//condition : le rôle de l'utilisateur est celui du superadmin => 3
		$conditions = array('roles_id' => 3);
		$compte = $this->User->find(array(
			'conditions'=> $conditions,
		));
		$this->set('compte', $compte);
		//Chargement des différents findlist
		require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
	}
	
	
/** 
* La Fonction editcompte permet d'éditer le compte de l'utilisateur
* @param 	$id 	INT 	identifiant de l'utilisateur
* 
**/
	function backoffice_editcompte($id){
		// Je charge le model User
		$this->loadModel('User');
		//Si il y  a des données postées 
		if($this->request->data){
			// Si les données postées sont validées
			if($this->User->validates($this->request->data)) {
				// Je sauvegarde les données postées
				$this->User->save($this->request->data);
				// Message de confirmation
				Session::setFlash("Elément modifié");
				// On redirige vers la page d'accueil des articles
				$this->redirect('/users/backoffice_moncompte');	
			} else {
				//Variable qui contient les index d'erreurs dans la page User du dossier model
				$errors = $this->User->errors;
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
		$edit = $this->User->findFirst(
			array('conditions' => array(
			'id'=>$id
			))
		);
		$this->request->data = $edit;
		$this->set('id', $id);
		//Chargement des différents findlist
		require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
	}
	
	
/**
* La fonction newcompte permet au utilisateurs de créer leur compte, dans la table users
*
**/
	function newcompte(){
		//On charge le model User
		$this->loadModel('User');
		//Si il y  a des données postées 
		if($this->request->data){
			// Si les données postées sont validées
			if($this->User->validates($this->request->data)) {
				// Je sauvegarde les données postées
				$this->User->save($this->request->data);
				// Message de confirmation
				Session::setFlash("Création de votre compte validé", 'success');
				// On redirige vers la page d'accueil des articles
				$this->redirect('/users/login');
			} else {
				//Variable qui contient les index d'erreurs dans la page post du dossier model
				$errors = $this->User->errors;
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
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesUser = $this->Categorie->find(); 
		$this->set('categoriesUser', $categoriesUser); //On fait passer les données à la vue
		// pr($categoriesUser);
		
		///////////////////////////////////////
		// RECUPERATION DES DONNEES DU SITE //
		
		$this->loadModel('Website');
		$websites = $this->Website->find(); //On récupère les saisons
		$this->set('websites', $websites); //On les envois à la vue
		// pr($websites);
		
		/////////////////////////////////////
		// RECUPERATION DES TYPES D'UTILISATEURS//
		
		$this->loadModel('Userstype');
		$lesUserstypes = $this->Userstype->findList(); //On récupère les saisons
		$this->set('lesUserstypes', $lesUserstypes); //On les envois à la vue
		// pr($lesUserstypes);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesMatch = $this->Categorie->findList(); 
		$this->set('categoriesMatch', $categoriesMatch); //On fait passer les données à la vue
		// pr($equipes);
	}
	
	
/** 
* La Fonction editcompte permet d'éditer le compte de l'utilisateur
* @param 	$id 	INT 	Identifiant de l'utilisateur 
**/
	function editcompte($id){
		// Je charge le model User
		$this->loadModel('User');
		//Si il y  a des données postées 
		if($this->request->data){
			// Si les données postées sont validées
			if($this->User->validates($this->request->data)) {
				// Je sauvegarde les données postées
				$this->User->save($this->request->data);
				// Message de confirmation
				Session::setFlash("Elément modifié", 'confirmation');
				// On redirige vers la page d'accueil des articles
				$this->redirect('/users/compte');	
			} else {
				//Variable qui contient les index d'erreurs dans la page User du dossier model
				$errors = $this->User->errors;
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
		$edit = $this->User->findFirst(
			array('conditions' => array(
			'id'=>$id
			))
		);
		$this->request->data = $edit;
		$this->set('id', $id);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesUser = $this->Categorie->find(); 
		$this->set('categoriesUser', $categoriesUser); //On fait passer les données à la vue
		// pr($categoriesUser);
		
		///////////////////////////////////////
		// RECUPERATION DES DONNEES DU SITE //
		
		$this->loadModel('Website');
		$websites = $this->Website->find(); //On récupère les saisons
		$this->set('websites', $websites); //On les envois à la vue
		// pr($websites);
		
		/////////////////////////////////////
		// RECUPERATION DES TYPES D'UTILISATEURS//
		
		$this->loadModel('Userstype');
		$lesUserstypes = $this->Userstype->findList(); //On récupère les saisons
		$this->set('lesUserstypes', $lesUserstypes); //On les envois à la vue
		// pr($lesUserstypes);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesMatch = $this->Categorie->findList(); 
		$this->set('categoriesMatch', $categoriesMatch); //On fait passer les données à la vue
		// pr($equipes);
	}
	
	
/** 
* La Fonction editcompte permet d'éditer le mot de pass crypter de l'utilisateur
* @param $id 	INT 	Identifiant de l'utilisateur 
*
**/
	function editcomptepass($id){
		// Je charge le model User
		$this->loadModel('User');
		//Si il y  a des données postées 
		if($this->request->data){
			// Si les données postées sont validées
			// Je sauvegarde les données postées
			$this->User->save($this->request->data);
			// Message de confirmation
			Session::setFlash("Elément modifié", 'confirmation');
			// On redirige vers la page d'accueil des articles
			$this->redirect('/users/compte');	
		}
		// On récupère les données déjà postées
		$edit = $this->User->findFirst(
			array('conditions' => array(
			'id'=>$id
			))
		);
		$this->request->data = $edit;
		$this->set('id', $id);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesUser = $this->Categorie->find(); 
		$this->set('categoriesUser', $categoriesUser); //On fait passer les données à la vue
		// pr($categoriesUser);
		
		///////////////////////////////////////
		// RECUPERATION DES DONNEES DU SITE //
		
		$this->loadModel('Website');
		$websites = $this->Website->find(); //On récupère les saisons
		$this->set('websites', $websites); //On les envois à la vue
		// pr($websites);
		
	}
}