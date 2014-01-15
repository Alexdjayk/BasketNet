<?php
class SeasonsController extends AppController{

/**
 * Cette fonction permet de récupérer les différentes saisons 
 *
 * @access 	public
 */
	function index() {
		//requète qui charge toutes les saisons sans conditions particulière
		$laSeasons = $this->Season->find();
		//Var accessible à la vue
		$this->set('laSeasons', $laSeasons);
		// On charge la listes des variables globales
		require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
	}
}