<?php
class WebsitesController extends AppController{

/** 
* La fonction view va permettre d'afficher les éléments du site, logos, couleurs, fond d'image, texte d'accroche ...
*
* @param $id 	INT 	identifiant du site
**/
	function view($id = NULL ){
		//Appel de la fonciton getWebsite qui permet d'afficher tous les éléments du site 
		$this->getWebsite(); 
	}
	
	
/** La fonction getMenu récupère la liste des pages du menu, on retourne la variable $logos qui contient le contenu de mon menu
*	via la fonction find
*	Voir schema requestAction
**/
	function getWebsite() {
		$this->loadModel('Website');
		//variable qui contient la requète sans conditions
		$logos = $this->Website->find(array(
			
			'fields'=> array('name', 'logo', 'online')
		));
		
		//on retourne le résultat de la requète au travers la variable $logos
		return $logos;
	}
	

	
/** 
* La Fonction backoffice_index permet d'afficher les éléments du site et ainsi avoir la possibilité de modifier, ajouter, supprimer les éléments du site.
*
**/
	function backoffice_index(){
	
		// $this->loadModel('Website');

		// fonction pagination
		$d['elementPerPage'] = 5; // NB d'elements par pages 
		$d['page'] = $this->request->page; // Nb de pages (voir fonction request)
		// pr($this->request);
		$limit = $d['elementPerPage'] * ($d['page']-1); // limit par pages
		$d['nbWebsites'] = $this->Website->findCount();
		$d['websites'] = $this->Website->find(array(
			'limit'=> $limit.', '.$d['elementPerPage'],
		));
		$d['nbPages'] = ceil($d['nbWebsites'] / $d['elementPerPage']);
		$this->set($d);
	}
	
	
/** 
* La Fonction backoffice_add permet d'ajouter des éléments au site, mais celle-ci ne sera pas accessible pour le moment
*
*  
**/
	function backoffice_add(){
		// Je charge le model Website
		$this->loadModel('Website');
		//Si il y  a des données postées 
		if($this->request->data){
			// Si les données postées sont validées
			if($this->Website->validates($this->request->data)) {
				// Je sauvegarde les données postées
				$this->Website->save($this->request->data);
				// Message de confirmation
				Session::setFlash("Elément ajouté");
				// On redirige vers la page d'accueil des articles
				$this->redirect('/adm/websites/index');
			} else {
				//Variable qui contient les index d'erreurs dans la page Website du dossier model
				$errors = $this->Website->errors;
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
	}
	
	
	/** 
	* La Fonction backoffice_edit permet d'éditer les éléments du site Websites
	*
	* @param  INT 	$id 	identifiant du site (Website)
	**/
	function backoffice_edit($id){
		// Je charge le model Website
		$this->loadModel('Website');
		//Si il y  a des données postées 
		if($this->request->data){
			// Si les données postées sont validées
			if($this->Website->validates($this->request->data)) {
				// Je sauvegarde les données postées
				$this->Website->save($this->request->data);
				// Message de confirmation
				Session::setFlash("Elément modifié");
				// On redirige vers la page d'accueil des articles
				$this->redirect('/adm/websites/index');	
			} else {
				//Variable qui contient les index d'erreurs dans la page Website du dossier model
				$errors = $this->Website->errors;
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
		$edit = $this->Website->findFirst(
			array('conditions' => array(
			'id'=>$id
			))
		);
		$this->request->data = $edit;
		$this->set('id', $id);
	}
}