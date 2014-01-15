<?php
/**
* Cette classe va faire les actions suivantes : 
* - Récupération de l'url courante
* - Gestion des variables passées en GET
* - Gestion des variables passées en POST
* - Gestion des champs upload
* - __construct() : PHP permet aux développeurs de déclarer des constructeurs pour les classes. Les classes qui possèdent une méthode constructeur appellent cette méthode à chaque création d'une 	nouvelle instance de l'objet, ce qui est intéressant pour toutes les initialisations dont l'objet a besoin avant d'être utilisé. 
*/
class Request{

	public $url;
	public $fullUrl; //Url appellée par l'utilisateur (avec http://...)
	public $page = 1;
	public $data = false;
	
	function __construct(){
		$this->url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/'; //Affectation de l'url
		// Par defaut, si l'url n'est pas indiquée, on redirige l'application vers la page d'accueil
		if($this->url == '/'){
			$this->url = '/Page-d-accueil';
		}
		// $this->fullUrl = 'http://'.$_SERVER["HTTP_HOST"].Router::url($this->url, ''); //Affectation de l'url complète
		if(isset($_GET['page']) && is_numeric($_GET['page'])) {
			$this->page = $_GET['page']; // On donne la valeur $_GET['page'];
		} 
		// si il y a des données postées
		if(!empty($_POST)) {
			// si la variable data n'est pas un tableau, il le devient
			if(!$this->data) {$this->data = array();}
			// on parcours les données postées 
			foreach($_POST as $k => $v){
				// si la valeur n'est pas un tableau
				if(!is_array($v)){$v = stripslashes($v);}
				
				$this->data[$k]= $v;
			}
		}
	}
}