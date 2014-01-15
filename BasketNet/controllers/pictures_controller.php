<?php
class PicturesController extends AppController{

/**
* Cette fonction permet de charger les éléments de la gallerie photo
*
*/
	function index() {
		// conditions : en ligne
		$pictures = $this->Picture->find(
			array('conditions' => array(
			'online' => 1
			))
		);
		// on rend la variable accessible à la vue
		$this->set('pictures', $pictures);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesUser = $this->Categorie->find(); 
		$this->set('categoriesUser', $categoriesUser); //On fait passer les données à la vue
		// pr($categoriesUser);
	}
	
/**
* Cette fonction permet de charger les éléments pour chaques galleries photos en détails
*
* @param	$id		INT 		identifiant de la gallerie
*/
	function view($id) {
		//condition de la requète : en ligne et égal à l'id ciblé
		$pictures = $this->Picture->find(
			array('conditions' => array(
			'online' => 1,
			'id'=>$id
			))
		);
		// Variable accessible à la vue
		$this->set('pictures', $pictures);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesUser = $this->Categorie->find(); 
		$this->set('categoriesUser', $categoriesUser); //On fait passer les données à la vue
		// pr($categoriesUser);
	}
}