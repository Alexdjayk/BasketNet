<?php
/**
* Cette classe est chargée d'effectuer les opérations suivantes : 
* - Instancier un objet de type Request qui va récupérer l'url
* - Parser cette url via l'objet Router
* - Charger le controller souhaité
*/
class Dispatcher{
	var $request;
	
	function __construct(){
		//On créer l'objet Request que l'on affecte à $this->request
		$this->request = new Request();
		//On parse l'url via l'objet Router, via la fonction parse de la classe Router, c'est une classe static, elle permet de modifier 
		//une variable qui se trouve dans l'objet courrant 
		Router::parse($this->request->url, $this->request);
		// pr($this);
		//on affecte $this->loadController() à la variable $controller, résultat d'un pr($controller);
		// variable de fonction $controller, la portée de la variable n'est que dans accessible dans la class
		$controller = $this->loadController();
		$action = $this->request->action;
		// Si dans l'action il existe un prefixe 
		if(isset($this->request->prefix)){
			$action = $this->request->prefix.'_'.$action;
		}
		// pr($action);
		if(!in_array(
			$action, 
				array_diff(
				get_class_methods($controller), 
				get_class_methods('Controller')
				)
			)
		){
			$this->error("Le contrôleur ".$this->request->controller." n'a pas de méthode ".$action);
		}
		// get_class_methods : Retourne les noms des méthodes d'une classe
		// pr(get_class_methods($controller)); // class courrante
		// pr(get_class_methods('Controller')); // class parente
		// $result = array_diff(get_class_methods($controller), get_class_methods('Controller'));  
		// pr($result);
		
		//Nous allons faire un appel dynamique à une fonction se trouvant dans un controlleur
		call_user_func_array(
			array(
				$controller,
				$action
			),
			$this->request->params //Paramètres éventuels
		);
		//On fait le rendu de la vue
		$controller->render($action);
		// pr($controller);
	}
	
	// mise en place d'une fonction pour gérer les erreurs de pages 
	function error($message){
	
		header("HTTP/1.0 404 Not Found");
		$controller = new Controller($this->request);
		$controller->set('message', $message);
		$controller->render('/errors/404');
		die();
	}
	
	
	/**
	* Cette fonction va charger un controller, 
	* @return $name Objet correspondant au type de controller souhaité
	*/
	function loadController(){
		
		//Nous allons récupérer le controleur directement avec la variable request, ucfirst -> Met le premier caractère en majuscule
		$name = ucfirst($this->request->controller).'Controller';
		// On Génère le chemin d'acces vers le fichier qui contient la definition de la classe à instancier que l'on stock dans une variable $file
		$file = ROOT.DS.'controllers'.DS.$this->request->controller.'_controller.php';
		//Si le controller n'existe pas dans ce cas je lui indique une erreur 404 grâce à la fonction error. 
		if(!file_exists($file)){
			$this->error("Le contrôleur ".$this->request->controller." n'existe pas !");
		}
		require $file;
		$controller = new $name($this->request, true);
		//je recupère le nom du controller 
		$modelName = ucfirst(substr($this->request->controller, 0, -1));
		// On injecte une variable avec le nom du controller qui contient le nom du model courrant
		$controller->request->modelName = $modelName;
		$controller->loadModel($modelName);
		/** creation d'un objet dynamique portant le nom du controlleur**/
		return  $controller ;
	}
}