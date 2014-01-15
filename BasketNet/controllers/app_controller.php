<?php
class AppController extends Controller{

/** 
* La Fonction backoffice_index permet d'afficher tous les éléments du backoffice_index du controller sur lequel l'admin se trouve et ainsi avoir 
* la possibilité de modifier, ajouter, et de supprimer. 
* On affiche les éléments avec une pagination
* @access 	public
**/
	function backoffice_index(){
		// $this->loadModel('Post');
		//variable qui contient le nom du controller
		$modelName = $this->request->modelName;
		// pr($modelName);
		// fonction pagination
		$d['elementPerPage'] = 25; // NB d'elements par pages 
		$d['page'] = $this->request->page; // Nb de pages (voir fonction request)
		// pr($this->request->controller);
		$limit = $d['elementPerPage'] * ($d['page']-1); // limit par pages
		$d['nbElements'] = $this->$modelName->findCount();
		$d[$this->request->controller] = $this->$modelName->find(array(
			'limit'=> $limit.', '.$d['elementPerPage'],
		));
		$d['nbPages'] = ceil($d['nbElements'] / $d['elementPerPage']);
		$this->set($d);

		// Ajout de la lib contenant mes variables 
		//require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
	}
	
	
/** 
* La Fonction backoffice_add permet d'ajouter des éléments en fonction du controller 
*
* @access 	public
**/
	function backoffice_add(){
		//variable qui contient le nom du controller
		$modelName = $this->request->modelName;
		$controller = $this->request->controller;
		// pr($modelName);
		//Si il y  a des données postées 
		if($this->request->data){
			// Si les données postées sont validées
			if($this->$modelName->validates($this->request->data)) {
				// Je sauvegarde les données postées
				$this->$modelName->save($this->request->data);
				// Message de confirmation
				Session::setFlash("Elément ajouté", 'success');
				// On redirige vers la page d'accueil du controller
				$this->redirect('/adm/'.$controller.'/index');
			} else {
				//Variable qui contient les index d'erreurs dans la page post du dossier model
				$errors = $this->$modelName->errors;
				// Variable qui contient un message d'erreur
				$message = "Erreur dans le formulaire : ";
				// Je parcours les index d'erreurs 
				foreach($errors as $k => $v){
					// Je concatene le message d'erreur avec le message d'erreur de l'index où il y a l'erreur
					$message .= $v.'</br>';
				}
				// J'affiche les 2 messages d'erreurs 
				Session::setFlash($message, 'error');
			}
		}
		//require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
	}
	
	
/** 
* La Fonction backoffice_add permet d'éditer des articles
*
* @param 	integer 	$id 	Identifiant
* @access 	public
**/
	function backoffice_edit($id){
		//variable qui contient le nom du controller
		$modelName = $this->request->modelName;
		$controller = $this->request->controller;
		// pr($modelName);
		//Si il y  a des données postées 
		if($this->request->data){
			// Si les données postées sont validées
			if($this->$modelName->validates($this->request->data)) {
				// Je sauvegarde les données postées
				$this->$modelName->save($this->request->data);
				// Message de confirmation
				Session::setFlash("Elément modifié", 'success');
				// On redirige vers la page d'accueil des articles
				$this->redirect('/adm/'.$controller.'/index');	
			} else {
				//Variable qui contient les index d'erreurs dans la page post du dossier model
				$errors = $this->$modelName->errors;
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
		$edit = $this->$modelName->findFirst(
			array('conditions' => array(
			'id'=>$id
			))
		);
		$this->request->data = $edit;
		$this->set('id', $id);
		//require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
	}
	
	
/** 
* La Fonction backoffice_delete permet de supprimer tous les posts de type 2.
*
* @param 	integer 	$id 	identifiant du post 
* @access 	public
**/
	function backoffice_delete($id){
		//variable qui contient le nom du controller
		$modelName = $this->request->modelName;
		$controller = $this->request->controller;
		// si la suppression de l'id est vrai on le supprime
		if($this->$modelName->delete($id)){
			// On affiche un message de confirmation
			Session::setFlash("L'élément a bien été supprimé", 'success');
		} else {
			// sinon on retourne un message d'erreur
			Session::setFlash("L'élément n'a pas été supprimé", 'error');
		}
		// On redirige  
		$this->redirect('adm/'.$controller.'/index');
	}
		

/**
* Cette fonction permet de retourner le nombre de commentaires, validés, pour un post donné
*
* @param 	integer 	$postId 	Identifiant du post
* @access 	public
*/
	function get_nb_comments($postId) {
		$this->loadModel('Commentspost');
		$conditions = array('online' => 1, 'posts_id' => $postId);
		return $this->Commentspost->findCount($conditions);
	}	

/**
* Cette fonction permet de retourner le nombre de commentaires, validés, pour un match donné
*
* @param 	integer 	$gameId 	Identifiant du match
* @access 	public
**/
	function get_nb_comments_games($gameId) {
		$this->loadModel('Commentsgame');
		$conditions = array('online' => 1, 'games_id' => $gameId);
		return $this->Commentsgame->findCount($conditions);
	}
	
	
/** La fonction getcommentposts retourne la liste des commentaires d'articles non validés et retourne le nbr
*	
* @access 	public
**/
	
	function getcommentposts() {
		$this->loadModel('Commentspost');
		//les méssages non validés
		$conditions = array('online'=> 0);
		//On compte le nombre de méssages non validés
		$NbComment = $this->Commentspost->findCount($conditions);
		// On rend la variable accessible à la vue
		$this->set('NbComment', $NbComment);
		// pr($NbComment);
		//On retourne le résultat
		return $NbComment;
	}
	
/** La fonction getMessage retourne la liste des commentaires de matchs non validés et retourne le nbr 
*
* @access 	public
**/
	
	function getcommentgames() {
		$this->loadModel('Commentsgame');
		//les méssages non validés
		$conditions = array('online'=> 0);
		//On compte le nombre de méssages non validés
		$NbCommentgame = $this->Commentsgame->findCount($conditions);
		// On rend la variable accessible à la vue
		$this->set('NbCommentgame', $NbCommentgame);
		// pr($NbCommentgame);
		//On retourne le résultat
		return $NbCommentgame;
	}

/**
 * @version 0.1 - 17/01/2012 by FI
 * @version 0.2 - 25/04/2012 by FI - Rajout de la gestion de la page d'accueil
 * @see Controller::beforeFilter()
 * @todo améliorer la récupération des configs...
 * @todo améliorer la récupération du menu général pour le moment une mise en cache qui me semble améliorable...
 */	
	function beforeFilter() {
		
		//////////////////////////////////////////////////////////
		//   MISE EN CACHE DE LA RECUPERATION DU MENU GENERAL   //
		$datas['menuGeneral'] = $this->_get_website_menu();				
		//////////////////////////////////////////////////////////
		//On fait passer les données à la vue
		$this->set($datas);
		// pr($datas);
    }
	
/**
 * Cette fonction permet de récupérer le menu
 *
 * @author 	koéZionCMS
 * @version 0.1 - 03/05/2012 by FI
 */       
    function _get_website_menu() {
    	
		//Récupération du menu général
		$this->loadModel('Page');
		// Variable qui contient les conditions en ligne et de type 1
		$req = array( 'conditions' => array('online' => 1, 'type' => 1));
		// Variable qui contient le menu avec les conditions données juste au dessus comme paramètres.
		// La fonction getTreeRecursive() récupère le menu avec le système parents/enfants pour gérer les sousmenus
		// pr($this->Page->getTreeRecursive($req));
		$menuGeneral = $this->Page->getTreeRecursive($req);
		//On fait passer les données à la vue au travers la variable $menuGeneral
		$this->set('menuGeneral', $menuGeneral);	
    	// pr($menuGeneral);
		// On retourne le résultat 
    	return $menuGeneral;
    } 
}