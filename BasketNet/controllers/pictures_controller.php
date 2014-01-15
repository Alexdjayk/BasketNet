<?php
class PicturesController extends AppController{

/**
* Cette fonction permet de charger les �l�ments de la gallerie photo
*
*/
	function index() {
		// conditions : en ligne
		$pictures = $this->Picture->find(
			array('conditions' => array(
			'online' => 1
			))
		);
		// on rend la variable accessible � la vue
		$this->set('pictures', $pictures);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesUser = $this->Categorie->find(); 
		$this->set('categoriesUser', $categoriesUser); //On fait passer les donn�es � la vue
		// pr($categoriesUser);
	}
	
/**
* Cette fonction permet de charger les �l�ments pour chaques galleries photos en d�tails
*
* @param	$id		INT 		identifiant de la gallerie
*/
	function view($id) {
		//condition de la requ�te : en ligne et �gal � l'id cibl�
		$pictures = $this->Picture->find(
			array('conditions' => array(
			'online' => 1,
			'id'=>$id
			))
		);
		// Variable accessible � la vue
		$this->set('pictures', $pictures);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesUser = $this->Categorie->find(); 
		$this->set('categoriesUser', $categoriesUser); //On fait passer les donn�es � la vue
		// pr($categoriesUser);
	}
}