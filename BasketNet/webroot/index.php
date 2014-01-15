<?php
////////////////////////////////////////////////////////////
//   DEFINITION DES VARIABLES GLOBALES DE L'APPLICATION   //
////////////////////////////////////////////////////////////

define('DS', DIRECTORY_SEPARATOR); //Définition du séparateur dans le cas ou l'on est sur windows ou linux
define('WEBROOT', dirname(__FILE__)); //Chemin absolu vers le dossier webroot
	define('UPLOAD', WEBROOT.DS.'upload'); //Chemin absolu vers le dossier views
define('ROOT', dirname(WEBROOT)); //Chemin absolu vers le dossier racine du site
define('CORE', ROOT.DS.'core'); //Chemin relatif vers le coeur de l'application
define('BASE_URL', dirname($_SERVER['SCRIPT_NAME'])); //
define('HELPERS',ROOT.DS.'views'.DS.'helpers'); //chemin relatif vers le dossier helpers
define('VIEWS', ROOT.DS.'views'); //Chemin absolu vers le dossier views
	define('ELEMENTS', VIEWS.DS.'elements'); //Chemin absolu vers le dossier views
	define('LAYOUT', VIEWS.DS.'layout'); //Chemin absolu vers le dossier layout
define('CONTROLLERS', ROOT.DS.'controllers'); //Chemin absolu vers le dossier views
define('LIB', ROOT.DS.'lib'); //Chemin absolu vers le dossier views
	define('SWIFT', LIB.DS.'swift'); //Chemin absolu vers le dossier swift
define('MODELS', ROOT.DS.'models'); //Chemin relatif vers le dossier models
	define('BEHAVIORS', MODELS.DS.'behaviors'); //Chemin absolu vers le dossier behaviors
	
	
require(CORE.DS.'includes.php');
$dispatcher = new Dispatcher();

