<?php
class ClubsController extends AppController{

	function index() {
		
		$clubs = $this->Club->find(
			array('conditions' => array(
			'online' => 1
			))
		);
		
		$this->set('clubs', $clubs);
		
		
		//////////////////////////////////////////////
		// RECUPERATION DU MATCH EN TETE D'AFFICHE  //
		
		$this->loadModel('Game');
		$games = $this->Game->find(
			array('conditions' => array(
			'end_game' => 0
			),
			'limit'=> '0, 3'
			)
		); 
		$this->set('games', $games); //On fait passer les données à la vue
		//pr($datas);
		
		require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
		
	}

}	

