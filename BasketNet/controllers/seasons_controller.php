<?php
class SeasonsController extends AppController{

/**
 * Cette fonction permet de r�cup�rer les diff�rentes saisons 
 *
 * @access 	public
 */
	function index() {
		//requ�te qui charge toutes les saisons sans conditions particuli�re
		$laSeasons = $this->Season->find();
		//Var accessible � la vue
		$this->set('laSeasons', $laSeasons);
		// On charge la listes des variables globales
		require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
	}
}