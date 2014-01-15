<?php
class Session{
	/**Fonction d'initialisation des sessions 
	*
	**/
	static function init(){
			//Evite de passe l'id de la session dans l'url
			ini_set('session.use_trans_sid', 0);
			//retourne le nom de la session courante. Si le paramètre name est fourni, session_name() modifiera le nom de la session et retournera l'ancien nom de la session. 
			session_name('basket-net'); 
			// Démarre une nouvelle session ou reprend une session existante
			session_start(); 
	}
	
	
	/** Fonction pour Verifier si un element est présent la dans variable de session
	*	@param varchar $key clée de la donnée (peut etre composé de . pour les niveaux)
	**/
	static function check($key){
		// si dans ma clé il y a rien 
		if(empty($key)){return false;} // je retourne faux
		// la variable $result contient la fonction classicExtract de la classe Set qui contient 2 paramètres, la variable de session $_SESSION, et la key $key.
		$result = Set::classicExtract($_SESSION, $key); // on procède à l'extraction de la donnée
		//je retourne le resultat de ma variable 
		return isset($result);
	}
	
	
	/** Fonction Pour écrire une donnée dans la variable, on souhaite écrire à l'emplacement que l'on souhaite les valeurs que l'on souhaite
	* 	@param varchar $key clée de la donnée (peut etre composé de . pour les niveaux)
	* 	@return booléan Vrai si la valeur est supprimée, faux sinon
	**/
	static function write($key, $value){
		// On insère les données et on récupère la nouvelle variable de session
		$session  = Set::insert($_SESSION, $key, $value);
		//on affecte les données à la variable de session
		$_SESSION = $session;
		//je vérifie si les résultats de classicExtract est égale à la valeur $value
		return Set::classicExtract($_SESSION, $key) == $value;
	}
	
	
	/** Fonction Pour lire la valeur d'un élément dans la variable
	* 	@param varchar $key clée de la donnée (peut etre composé de . pour les niveaux) 
	**/
	static function read($key = NULL){
		$result = Set::classicExtract($_SESSION, $key);
		if(!is_null($result)){ return $result;} else { return false;}
	}
	
	
	/** Fonction Pour supprimer un élément
	* 	@param varchar $key clée de la donnée (peut etre composé de . pour les niveaux)
	* 	@return booléan Vrai si la valeur est supprimée, faux sinon
	**/
	static function delete($key){
		$result = Set::remove($_SESSION, $key);
		$_SESSION = $result;
		return Session::check($key) == false ;
	}
	
	
	/** Fonction Pour détruire la variable de session
	*
	**/
	static function destroy(){	
		session_unset(); // détruit toutes les données dans la variable de session
		session_destroy(); // finalement, on détruit la session
	}
	
	
	/** Fonction Pour insérer des messages flash qui seront affichés dans le site
	* 	@param varchar $message message à afficher
	* 	@param varchar $type type du message
	**/
	static function setFlash($message, $type ='success, confirmation'){
		// initialisation de la variable de session avec les valeurs reçues
		Session::write('Flash.message', $message);
		Session::write('Flash.type', $type);
	}
}