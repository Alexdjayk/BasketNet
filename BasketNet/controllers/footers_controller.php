<?php
class FootersController extends AppController{

/** 
* La fonction index va permettre d'afficher le footer
*
* @param	$id		INT 		identifiant du footer
**/
	function view($id = NULL ){
		//appel de la fonction getFooter() qui charge les éléments du footer
		$this->getFooter(); 
	}
	
	
/** La fonction getFooter récupère la liste des éléments du footer, on retourne la variable $Footer qui contient le contenu de mon footer
*	via la fonction find
*	Voir schema requestAction
**/
	function getFooter() {
		$this->loadModel('Footer');
		$footers = $this->Footer->find(
			array(
				'conditions'=> array(
					'online' =>1
				)
			)
		);
		//On retourne le résultat de la variable $footers
		return $footers;
	}
}