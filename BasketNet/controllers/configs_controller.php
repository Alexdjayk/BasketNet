<?php
/**
 * Ce contrôleur permet la gestion de la configuration de l'application
 * 
 * PHP versions 4 and 5
 *
 * KoéZionCMS : PHP OPENSOURCE CMS (http://www.koezion-cms.com)
 * Copyright KoéZionCMS
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright	KoéZionCMS
 * @link        http://www.koezion-cms.com
 * 
 * @todo	Essayer de généraliser un peu plus ce contrôleur		
 */
class ConfigsController extends AppController {

	//public $auto_load_model = false;	
	
//////////////////////////////////////////////////////////////////////////////////////////
//										BACKOFFICE										//
//////////////////////////////////////////////////////////////////////////////////////////	

/**
 * Cette fonction va permettre l'affichage des configurations de la base de données
 *
 * @access 	public
 * @author 	koéZionCMS
 * @version 0.1 - 02/03/2012 by FI
 * @version 0.2 - 18/04/2012 by FI - Modification de la procédure de gestion des configurations de la base de données, maintenant uniquement deux configurations locale et production
 */
	function backoffice_database_liste() { 
		
		//Import de la librairie de gestion des fichiers de configuration
		// require_once(LIBS.DS.'config_magik.php');
		$cfg = new ConfigMagik(ROOT.DS.'configs'.DS.'database.ini', true, true);
		//Si des données sont postées
		if($this->request->data) {
			foreach($this->request->data as $section => $config) { 
				foreach($config as $k => $v) { $cfg->set($k, $v, $section); } 
			}
			
			Session::setFlash("Fichier de configuration modifié"); //Message de confirmation
			$this->redirect('backoffice/configs/database_liste'); //Redirection
		}
		
		//On va récupérer la liste des données de configuration de la base de données (Configurations locale et de production)		
		$sections = $cfg->listSections(); //Récupération des différentes sections du fichier de configuration
		foreach($sections as $section) { $this->request->data[$section] = $cfg->get($section); } //On parcours les sections et on récupère les données que l'on affecte "aux données postées" 
	}
}