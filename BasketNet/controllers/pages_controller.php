<?php
class PagesController extends AppController{
	
/** 
* La fonction view va permettre d'afficher le menu 
*
* @param $id 	INT			identifiant de la page
* @param $slug 	VARCHAR		réécriture de l'url
**/
	function view($id = NULL, $slug){
		
		//$this->loadModel('Page');
		// On test si l'id existe 
		$id = (int)$id;
		if(!isset($id) || $id == 0) { $this->e404("Désolé mais la page demandée n'existe pas");} 
		 // var_dump($id);

		
		$page = $this->Page->findFirst(
			array('conditions' => array(
			'id'=>$id,
			'online'=> 1
			))
		);
		
		// Si la page est vide -> erreur
		if(empty($page)) {$this->e404('Page Introuvable');}
		
		//si le slug existe et qu'il n'est pas vide 
		if( $slug != $page['slug']) {
			// dans ce cas on redirige la vue du Pages vers l'url 
			$this->redirect('pages/view/id:'.$page['id'].'/slug:'.$page['slug'], 301);
		} 
		$this->set('page', $page);	
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesUser = $this->Categorie->find(array(
				'fields'=>array('id','name')
			)); 
		$this->set('categoriesUser', $categoriesUser); //On fait passer les données à la vue
		// pr($categoriesUser);
		
		/////////////////////////////////////////////////
		// RECUPERATION DES ARTICLES PAR PAGES DU MENU //
		
		$this->loadModel('Postspage');
		$conditions = array('online'=> 1);
		$flPostspages = $this->Postspage->find(array(
			
				'conditions'=> $conditions,

			)); //On récupère les catégories
		$this->set('flPostspages', $flPostspages); //On les envois à la vue
		// pr($flPostspages);
	}
	
/** 
* 	La fonction getMenu récupère la liste des pages du menu, on retourne la variable $Pages qui contient le contenu de mon menu
*	via la fonction find
*	Voir schema requestAction
**/
	
	function getMenu() {
		
		$this->loadModel('Page');
		//conditions en ligne et le parent_id est différent de 0, 0 est égal à la racine du menu (voir la représentation intervallaire)
		$conditions = 'online = 1 AND parent_id != 0';
		$Pages = $this->Page->find(
			array(
				'conditions'=> $conditions
			)
		);
		return $Pages;
	}
	
	
/** 
* La Fonction backoffice_index permet d'afficher tous les pages de type différents de 4 et ainsi avoir la possibilité de modifier, ajouter, supprimer les posts.
**/
	function backoffice_index(){
		
		// fonction pagination
		$d['elementPerPage'] = 25; // NB d'elements par pages 
		$d['page'] = $this->request->page; // Nb de pages (voir fonction request)
		// pr($this->request);
		
		$limit = $d['elementPerPage'] * ($d['page']-1); // limit par pages
		// conditions : type différents de 4 dans l'ordre ASC de lft
		$conditions = 'type != 4 ORDER BY lft ASC';
		$d['nbPages'] = $this->Page->findCount($conditions);
		$d['pages'] = $this->Page->find(array(
			'conditions'=> $conditions,
			'limit'=> $limit.', '.$d['elementPerPage'],
		));
		$d['nbPages'] = ceil($d['nbPages'] / $d['elementPerPage']); 
		$this->set($d);
		require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
	}
}