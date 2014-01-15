<?php
class Controller{
	
	public $request;
	public $helpers = array(
		'Form', 'Html'
	);
	public $layout = 'default';
	private $vars = array();
	private $rendered = false;
	
	
/**
* Constructeur de la classe Controller
* @param 	object 	$request 		Objet de type Request
**/

	function __construct($request = NULL, $beforeFilter = false){
		// Chargement des variables globales
		require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
		if(isset($request)) { 
			$this->request = $request;			
			include CORE.DS.'is_logged.php';
		}
		//Parcours de la variable public helpers contenant un tableau (form, html)
		foreach($this->helpers as $k => $v){
			
			$filename = Inflector::underscore($v);
			// pr($v);
			// $helper = Inflector::underscore($v);
			require_once HELPERS.DS.$filename.'.php';
			$h = new $v($this);
			unset($this->helpers[$k]);
			$this->helpers[$v] = $h;
			// pr($this->helpers);
			// pr($h);
		}
		//si beforfilter est vrai, on fait appel à la fonction
		if($beforeFilter) { $this->beforeFilter(); } 
	}
	
/**
* Cette fonction permet de rendre une vue
* Pour rendre une vue particulière il faut préfixer la variable $view par un /
*
* @param 	varchar 	$view 	Nom de la vue à rendre
*/

	function render($view){
		
		if($this->rendered) {return false;}
		//On extrait les variable en fonctions des clées du tableau passées en paramètre
		extract($this->vars);
		if(strpos($view, '/') ===0) {$view = ROOT.DS.'views'.$view.'.php';}
		else {$view = ROOT.DS.'views'.DS.$this->request->controller.DS.$view.'.php';}
		//On démarre la temporisation de sortie (buffer)
		ob_start();
		require($view);
		//On vide le buffer dans une variable
		$content_for_layout = ob_get_clean();
		//On charge un layout par défault
		// si il y a un prefixe de type 'backoffice' on redirige la page vers notre backoffice
		if(isset($this->request->prefix) && $this->request->prefix == 'backoffice') {
			//sécurisation du backoffice, seul les utilisateurs ayant un rôle de niveau 3 accèdent au backoffice
			if(Session::read('Backoffice.User.roles_id') == 3) {
				$this->layout = 'backoffice';
			// sinon ils sont redirigés vers la page d'accueil
			} else {
				$this->redirect('homes/index');
			}
		}
		// On charge le layout demandé
		require(ROOT.DS.'views'.DS.'layout'.DS.$this->layout.'.php');
		$this->rendered=true;
	}
	
	
/**
* Accesseur en écriture, permet d'envoyer des variables à la vue à partir de variable du controller
* Cette fonction permet l'initialisation d'une ou plusieurs variables dans la vue
* Elle fonctionne de la façon suivante
* Soit elle prend en paramètres un couple clé / valeur
* Soit un tableau avec une liste de couples clé / valeur
*
* @param 	mixed 	$key	Nom de la variable, ou tableau de variables
* @param 	mixed 	$value	Valeur de la variable (optionnel)
* @acces	public	
* @author 	Alex
**/
	
	public function set($key, $value = null){
		if(is_array($key)){ $this->vars += $key; }
		else{ $this->vars{$key} = $value; }
	}
	
	
/** 
* Fonction public loadModel 
* @param 	varchar  	$modelName
* @param 	varchar 	$name 	Nom du model à charger
* @acces	public	
* @author 	Alex
**/
	
	public function loadModel($modelName){
		//suivante la version de php la fonction lcfirst n'est pas définie
		if(!function_exists('lcfirst')){
			function lcfirst($string)
			{
				$string[0] = strtolower($string[0]);
				return $string;
			}
		}
		$file = ROOT.DS.'models'.DS.lcfirst($modelName).'.php';
		require_once($file);
		/** la dernière ligne évite de charger plusieurs fois le même model **/
		if(!isset($this->$modelName)){ $this->$modelName = new $modelName();}
	}
	
	
/**
* Fonction qui permet de gérer l'affichage des erreurs  
* @param 	varchar 	$message 	message d'erreur 
* @acces	public	
* @author 	Alex
**/
	
	public function e404($message){
		header("HTTP/1.0 404 Not Found"); // code erreur pour les pages de recherche
		$this->set('message', $message);
		$this->render('/errors/404');
		die();
	}
	
	
/**
* Fonction qui permet d'utiliser une méthode d'après une vue (voir shema requestAction)
* La fonction permet à partir d'une vue de faire une requète
* @param 	varchar 	$controller 	controlleur 
* @param 	varchar 	$action 		action
* @acces	public	
* @author 	Alex
**/

	public function requestAction($controller, $action) {
		//Nous allons récupérer le controleur directement avec la variable request, ucfirst -> Met le premier caractère en majuscule
		$name = ucfirst($controller).'Controller';
		// On Génère le chemin d'acces vers le fichier qui contient la definition de la classe à instancier que l'on stock dans une variable $file
		$file = ROOT.DS.'controllers'.DS.$controller.'_controller.php';
		require_once $file;
		//creation d'un objet dynamique portant le nom du controlleur
		$var = new $name();
		// On retourne une variable qui contient la variable action() qui correspond aux paramètes de la fonction requestAction
		return $var->$action(); 
	}
	
/**
* Fonction redirect qui permet de rediriger vers l'url passée en paramètre
* @param varchar 	$url 		Url de la page de redirection
* @param interger  	$code 		Code erreur html
**/

	function redirect($url, $code = null) {
		//Code de redirection possibles
		$http_codes = array(
				100 => 'Continue',
				101 => 'Switching Protocols',
				200 => 'OK',
				201 => 'Created',
				202 => 'Accepted',
				203 => 'Non-Authoritative Information',
				204 => 'No Content',
				205 => 'Reset Content',
				206 => 'Partial Content',
				300 => 'Multiple Choices',
				301 => 'Moved Permanently',
				302 => 'Found',
				303 => 'See Other',
				304 => 'Not Modified',
				305 => 'Use Proxy',
				307 => 'Temporary Redirect',
				400 => 'Bad Request',
				401 => 'Unauthorized',
				402 => 'Payment Required',
				403 => 'Forbidden',
				404 => 'Not Found',
				405 => 'Method Not Allowed',
				406 => 'Not Acceptable',
				407 => 'Proxy Authentication Required',
				408 => 'Request Time-out',
				409 => 'Conflict',
				410 => 'Gone',
				411 => 'Length Required',
				412 => 'Precondition Failed',
				413 => 'Request Entity Too Large',
				414 => 'Request-URI Too Large',
				415 => 'Unsupported Media Type',
				416 => 'Requested range not satisfiable',
				417 => 'Expectation Failed',
				500 => 'Internal Server Error',
				501 => 'Not Implemented',
				502 => 'Bad Gateway',
				503 => 'Service Unavailable',
				504 => 'Gateway Time-out'
		);
		 
		if(isset($code)) { header("HTTP/1.0 ".$code." ".$http_codes[$code]); } //Si un code est passé on l'indique dans le header				
		if(!substr_count($url, 'http://')) { $url = Router::url($url); }
		if(isset($params)) {$url .= '?'.$params; }
		header("Location: ".$url);
		die(); //Pour éviter que les fonctions ne continues
	}
	
		
	/**
	*fonction sendmail permet l'envoi de mail. 
	* @param 	$mailDatas 		varchar 		ce sont les données du mail ['layout']['view']['messagesend']['subject']['from']...
	* @param 	$host 			varchar 		c'est l'host du transport
	* @param 	$port 			varchar 		c'est le port de connexion
	* @param 	$username 		varchar 		c'est l'adresse mail de l'envoyeur
	* @param 	$password 		varchar 		c'est le pass du transport 
	* @param	view 			varchar 		Index contenant la vue à utiliser (optionnel)
	*
	* ->setSubject() c'est le titre du mail.
	* ->setFrom() c'est le mail de l'envoyeur.
	* ->->setTo() c'est le mail à qui ont l'envoie.
	* ->addPart() c'est le contenu du mail.
	*
	**/

	function sendmail(
		$mailDatas,
		$host = "ns0.ovh.net",
		$port = '587',
		$username = 'postmaster@basket-net.fr',
		$password = 'UmgmfLw8'
	) {
		require(SWIFT.DS.'swift_required.php');
		// Create the Transport
		$transport = Swift_SmtpTransport::newInstance($host, $port)
		  ->setUsername($username)
		  ->setPassword($password)
		  ;
		// Create the Mailer using your created Transport
		$mailer = Swift_Mailer::newInstance($transport);
		//var qui contient le layout
		$layout = $mailDatas['layout'];
		if(isset($mailDatas['view'])) {
			$view = $mailDatas['view'];
			ob_start(); //On va récupérer dans une variable le contenu de la vue pour l'affichage dans la variable layout_for_content "buffer"
			include(ELEMENTS.DS.'email'.DS.$view.'.php'); //Chargement de la vue
			$content_for_layout = ob_get_clean(); //On stocke dans cette variable le contenu de la vue
		}
		ob_start(); //On va récupérer dans une variable le contenu de la vue pour l'affichage dans la variable layout_for_content
		include(LAYOUT.DS.$layout.'.php'); //Chargement de la vue
		$messageHTML = ob_get_clean(); //On stocke dans cette variable le contenu de la vue
		
		// Create the message
		$message = Swift_Message::newInstance()

		  // Give the message a subject
		  ->setSubject($mailDatas['subject'])

		  // Set the From address with an associative array
		  ->setFrom($mailDatas['from'])

		  // Set the To addresses with an associative array
		  ->setTo($mailDatas['to'])

		   // And optionally an alternative body
		  ->addPart($messageHTML, 'text/html')
		;
		// Send the message
		$result = $mailer->send($message);
		echo $result;
	}
	
	/**
	* Fonction elements permet l'inclusion d'éléments
	* @param 	VARCHAR 	$path		chemin des éléments à inclurent 
	**/
	function elements($path){
		//On extrait les variable en fonctions des clées du tableau passées en paramètre
		extract($this->vars);
		include ELEMENTS.DS.$path;
	}
}