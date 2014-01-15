<?php
class Model {
	
	public $conf = 'default';
	public $db;
	public $table = false;
	public $primaryKey ='id';
	static $connections =array();
	
	public function __construct() {
		/** On charge le fichier database.php qui contient les paramètres pour se connecter à la base de donnée.**/ 
		require ROOT.DS.'configs'.DS.'database.php';
		// create new ConfigMagik-Object
		$Config = new ConfigMagik(ROOT.DS.'configs'.DS.'database.ini', true, true);
		// pr($Config);
		//On test si on est en local ou en ligne
		$httpHost = $_SERVER['HTTP_HOST'];
		if($httpHost == 'localhost' || $httpHost == '127.0.0.1'){$section = 'localhost';}
		else {$section ='online';}
		$conf = $Config->get($section);
		// pr($conf);
		// $conf = $databases[$this->conf];
		// $conf = $Config;
		// si le nom de la table n'est pas défini on va l'initialiser automatiquement
		// Par convention le nom de la table sera le nom de la classe en minuscule avec un s à la fin
		if($this->table === false){
			$tableName = strtolower(get_class($this)).'s'; // mise en variable du nom de la table
			$this->table = $tableName; //Affectation de la variable de classe
		}
		$this->dbName = $conf['database']; // Variable de class 
		// $this->dbName = $Config; // Variable de class 	
		// on test qu'une connexion ne soit pas déjà active
		// Pour éviter de se connecter 2 fois à la base de données
		if(isset(Model::$connections[$this->conf])) { 
			$this->db = Model::$connections[$this->conf];
			return true;
		}
		// on va tenter de se connecter à la base de données
		try{
			//création d'un objet PDO
			$pdo = new PDO(
				'mysql:host='.$conf['host'].';dbname='.$conf['database'],
				$conf['login'],
				$conf['password'],
				array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
			);
			// mise en place des erreurs de la classe PDO
			// Utilisation du mode exception pour récupérer les erreurs
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			Model::$connections[$this->conf] = $pdo; // on affecte l'objet à la classe
			$this->db = $pdo;
		} catch(PDOException $e) { // erreur
			$message = '<pre style="background-color: #EBEBEB; border:1px dashed black; padding : 10px">';
			$message .= "La base de données n'est pas disponible merci de rééssayer plus tard ".$e->getMessage();
			$message .= '</pre>';
			die($message);
		}
		// echo 'je suis connecté à ma base de données';
	}
	
	
	/**
	 * Fonction permettant d'effectuer des recherches dans la base de données
	 * 
	 * $req peut être composé des index suivants :
	 * 	- fields (optionnel) : liste des champs à récupérer. Cet index peut être une chaine de caractères ou un tableau, si il est laissé vide la requête récupèrera l'ensemble des *  - colonnes de la table.
	 * 	- conditions (optionnel) : ensemble des conditions de recherche à mettre en place. Cet index peut être une chaine de caractères ou un tableau.
	 * 	- moreConditions (optionnel) : cet index est une chaine de caractères et permet lorsqu'il est renseigné de rajouter des conditions de recherche particulières.
	 * 	- order (optionnel) : cet index est une chaine de caractères et permet lorsqu'il est renseigné d'effectuer un tri sur les éléments retournés.
	 * 	- limit (optionnel) : cet index est un entier et permet lorsqu'il est renseigné de limiter le nombre de résultats retournés.
	 *  - allLocales (optionnel) : cet index est un booléen qui permet lors de la récupération d'un élément d'indiquer si il faut ou non récupérer l'ensemble des champs traduits
	 * 
	 * @param 	array 	$req 	Tableau de conditions et paramétrages de la requete
	 * @param 	object 	$type 	Indique le type de retour de PDO dans notre cas un tableau dont les index sont les colonnes de la table
	 * @return 	array 	Tableau contenant les éléments récupérés lors de la requête  
	 * 
	**/
	
	public function find($req = array(), $type = PDO::FETCH_ASSOC) {
		
		$sql = 'SELECT ';
		
		///////////////////
		// CHAMPS FIELDS //
		
		// si il 'y a pas de champs fields on va recup le shéma de la table 
		// Dans le cas de table traduite on va également récupérer les champs traduits
		if(!isset ($req['fields'])) {
			$req['fields'] = $this->shema();
		}
		if(is_array($req['fields'])){ $sql .= implode(', ', $req['fields']); 
		} else {
			$sql .= $req['fields']; // Si il s'agit d'une chaine de caractères
		}
		$sql .= ' FROM '.$this->table;
		$sql .= ' AS '.get_class($this).' ';
		
		///////////////////////
		// CHAMPS CONDITIONS //
		if(isset($req['conditions'])) {
			$cond = ' WHERE ';
			// On teste si conditions est un tableau 
			// Sinon on est dans le cas d'une requète personnalisée
			if(!is_array($req['conditions'])){
				 $cond .= $req['conditions']; // on les ajoute à la requète
				// si c'est un tableau on va rajouter les valeurs
			} else {
				$tab_conditions = array();
				// On parcours les conditions
				foreach ($req['conditions'] as $k => $v) {
					if(!is_numeric($v)){  			// équivalent au mysql_real_escape_string
						$v = $this->db->quote($v);  // PDO::quote — Protège une chaîne pour l'utiliser dans une requête SQL PDO 
					}
					$tab_conditions[] = get_class($this).'.'.$k.' = '.$v; 
				}
				$cond .= implode(' AND ', $tab_conditions);
				// pr($cond);
				// pr($tab_conditions);
			}
			$sql .= $cond; // on rajoute les conditions à la requète
		}
		
		////////////////////////////
		// CHAMPS MORE CONDITIONS //
		
		// Si il existe des conditions supplémentaires et qu'ils ne sont pas vide
		if(isset($req['moreConditions']) && !empty($req['moreConditions'])) {
			// et si il existe des conditions dans ce cas les conditions supplémentaires se rajoutent avec un AND sinon on fait un WHERE
			if(isset($req['conditions'])) { $sql .= ' AND '; } else { $sql .= ' WHERE '; }
			$sql .= $req['moreConditions'];
		}
		//////////////////
		// CHAMPS ORDER //
		
		if(isset($req['order'])) {
			$sql .= ' ORDER BY '.$req['order'];
		}
		
		//////////////////
		// CHAMPS LIMIT //
		// limit (0, 10) on part de 0 et on affiche les 10 prochains résultats soit le nombre d'éléments par pages, ensuite limit(10, 10) ect ...
		if(isset($req['limit'])) {
			$sql .= ' LIMIT '.$req['limit'];
		}
		// pr($sql);
		$pre = $this->db->prepare($sql); // On prépare la requête
		$pre->execute(); // On l'execute
		// si l'execution s'est correctement déroulé 
		return $pre->fetchAll($type);
		// On retourne le résultat si demandé
		// pr($sql);
	}
	
	/**
	Fonction qui permet de récupérer le premier élément d'un tableau avec la fonction Find()
	* @param 	array 		$req tableau de conditions et de paramétrages de la requete
	* @param 	array 		Tableau contenant les données de l'élément
	* @acces
	**/
	
	public function findFirst($req){
		$request = $this->find($req);// on lance la requete
		return current($request); // par defaut on va retourne le 1 élément du tableau
	}
	
	
	/**
	* fonction findList qui permet de Retourner un élément tableau, içi c'est le champ id de la table que l'on va choisir
	* @param 	$table 		varchar  	variable qui contient le nom de la table
	* @param 	varchar		$sql		requète sql
	* @return 	ressource	$link		Ressource de connexion au serveur
	 */
	 
	public function findListId() {
		$tableau = array();
		$list = $this->find();
		foreach($list as $k => $v) { $tableau[$v['id']] = $v['id']; }
		return $tableau;	
	}
	
	/**
	* fonction findList qui permet de Retourner un élément tableau, içi c'est le champ name de la table que l'on va choisir
	* @param 	$table 		varchar  	variable qui contient le nom de la table
	* @param 	varchar		$sql		requète sql
	* @return 	ressource	$link		Ressource de connexion au serveur
	 */
	 
	public function findList() {
		$tableau = array();
		$list = $this->find();
		foreach($list as $k => $v) { $tableau[$v['id']] = $v['name']; }
		return $tableau;	
	}
	
	
	/**
	* fonction findList qui permet de Retourner un élément tableau, içi c'est le champ logo de la table que l'on va choisir
	* @param 	$table 		varchar  	variable qui contient le nom de la table
	* @param 	varchar		$sql		requète sql
	* @return 	ressource	$link		Ressource de connexion au serveur
	*/
	 
	public function findListLogo() {
		$tableau = array();
		$list = $this->find();
		foreach($list as $k => $v) { $tableau[$v['id']] = $v['logo']; }
		return $tableau;	
	}
	
	/**
	* fonction findList qui permet de Retourner un élément tableau, içi c'est le champ icone de la table que l'on va choisir
	* @param 	$table 		varchar  	variable qui contient le nom de la table
	* @param 	varchar		$sql		requète sql
	* @return 	ressource	$link		Ressource de connexion au serveur
	*/
	 
	public function findListIcone() {
		$tableau = array();
		$list = $this->find();
		foreach($list as $k => $v) { $tableau[$v['id']] = $v['icone']; }
		return $tableau;	
	}
	
	/**
	* fonction findList qui permet de Retourner un élément tableau, içi c'est le champ pseudo de la table que l'on va choisir
	* @param 	$table 		varchar  	variable qui contient le nom de la table
	* @param 	varchar		$sql		requète sql
	* @return 	ressource	$link		Ressource de connexion au serveur
	*/
	 
	public function findListPseudo() {
		$tableau = array();
		$list = $this->find();
		foreach($list as $k => $v) { $tableau[$v['id']] = $v['pseudo']; }
		return $tableau;	
	}
	
	/**
	* fonction findList qui permet de Retourner un élément tableau, içi c'est le champ icone de la table que l'on va choisir
	* @param 	$table 		varchar  	variable qui contient le nom de la table
	* @param 	varchar		$sql		requète sql
	* @return 	ressource	$link		Ressource de connexion au serveur
	*/
	 
	public function findListAbreviation() {
		$tableau = array();
		$list = $this->find();
		foreach($list as $k => $v) { $tableau[$v['id']] = $v['abreviation']; }
		return $tableau;	
	}
	
	/**
	Fonction qui permet de compter le nombre éléments dans une table en fonctions des éléments définis 
	* @param 	array 		$req
	* @param 	varchar 	$sql Requète à éffectuer
	* @param 
	**/
	
	public function findCount($conditions = NULL, $moreConditions = NULL){
		$result = $this->findFirst(
			array(
				'fields' => 'COUNT('.get_class($this).'.'.$this->primaryKey.') AS nb_count',
				'conditions' => $conditions,
				'moreConditions' => $moreConditions,
			)
		);
		// $result = $this->query($sql, true);
		// pr($result['nb_count']);
		return $result['nb_count'];
	}
	
	
	/** 
	* La fonction shema récupère le shema d'une table sql 
	* @param 		varchar 	$sql Requète à éffectuer
	* @param 		booléan 	$return Indique si oui ou non on doit retourner le résultat de la requète
	* @return 		array tableau contenant les éléments récupérées lors de la requete
	* @access public 
	**/
	
	public function shema() {
		$tab= array();
		$sql = 'SHOW COLUMNS FROM '.$this->table;
		$result = $this->query($sql, true);
		foreach($result as $k => $v){
			 $tab[] = $v['Field'];
		}
		// pr($tab);
		// pr($result);
		return $tab;
	}
	
	
	/** 
	* Fonction qui récupère la liste de toutes les tables de la base de données.
	* @param 		varchar 	$sql Requète à éffectuer
	* @param 		booléan 	$return Indique si oui ou non on doit retourner le résultat de la requète
	* @return 	array tableau contenant les éléments récupérées lors de la requete
	* @access public 
	**/
	
	public function table_list() {
		$tab = array();
		$sql = 'SHOW TABLES FROM '.$this->dbName; 
		$result = $this->query($sql, true);
		foreach($result as $k => $v){
			$tab[] = $v['Tables_in_mvc_bdd'];
		}
		return $tab;
	}
	
	
	/**
	* Cette fonction permet l'execution du requête sans passer par la fonction find
	* Il suffit d'envoyer directement dans le paramètre $sql la requète à éffectuer (par exemple un SELECT ou autre)
	* @param 		varchar 	$sql Requète à éffectuer
	* @param 		booléan 	$return Indique si oui ou non on doit retourner le résultat de la requète
	* @return 	array tableau contenant les éléments récupérées lors de la requete
	* @access public 
	**/
	
	public function query($sql, $return = false) {
		
		$pre = $this->db->prepare($sql); // On prépare la requête
		$result = $pre->execute(); // On l'execute
		if($result) {
			// si l'execution s'est correctement déroulé 
			if($return) {return $pre->fetchAll(PDO::FETCH_ASSOC);}
			// On retourne le résultat si demandé
			
			else {return true;} // On retourne vrai sinon
			
		} else { return false;} // si la requete ne s'est pas bien déroulé on retourne faux 
	}
	
	
	/**
	* Fonction delete des données. 
	* @param 	$table 		varchar  	variable qui contient le nom de la table
	* @param 	varchar		$sql		requète sql
	* @return 	objet objet PDO
	* @acces public
	* DELETE FROM `nouvelle`.`articles` WHERE `articles`.`id` = 10
	*/
	
	function delete($id){
		if(is_array($id)) { $idConditions = " IN (".implode(',', $id).')'; } else { $idConditions = " = ".$id ;}
		$sql = "DELETE FROM `".$this->table."` WHERE `".$this->primaryKey."`".$idConditions.";"; // requete de suppression de l'élément
		return $this->db->query($sql);
	}
	
	
	/**
	 * Fonction de sauvegarde des données, si c'est un nouvelle ajout on le créer, sinon on l'édit.
	 * On va travailler avec PDO.
	 *
	 * @param 	varchar		$serveur		Nom du serveur
	 * @param 	varchar		$login			Identifiant de connexion au serveur
	 * @param 	varchar		$password		Mot de passe de connexion au serveur
	 * @param 	varchar		$dbName			Base de données à utiliser
	 * @param	varchar		$forceInsert 	cette variable permet de forcer l'ajout d'une clé primraire
	 * @return 	ressource	$link			Ressource de connexion au serveur
	 * exemple de creation : INSERT INTO `nouvelle`.`isauth` (`id`, `login`, `pass`, `isauth`, `role_id`, `name`, `prenom`, *`pseudo`, `guildes_id`) VALUES (NULL, 'test', 'test', '1', '1', 'test', 'test',  * 'test', '0');
	 */
	function save($datas, $forceInsert = false){
		// pr($datas);
		// die();
		// Primary Key
		$Key = $this->primaryKey;
		// tableau des champs à sauvegarder
		$fieldsToSave = array();
		//tableau utilisé lors de la préparation de la requète
		$datasToSave = array();
		//Permet de connaitre le type de requète à éffectuer pour deux choses
		// -> savoir qu'elle requète lancer UPDATE OU INSERT
		// -> savoir comment renvoyer l'id
		//Dans ce cas on est sur de l'update, si la clé existe et qu'elle n'est pas vide et qu'elle n'est pas forcée
		if(isset($datas[$Key]) && !empty($datas[$Key]) && !$forceInsert){
			
			/** Si dans les données postées il y a un champs password, on utilise la fonction sha1 pour crypter le mot de pass*/
			if(isset($datas['password'])){
				$datas['password'] = sha1($datas['password']);
			}
			//Définition de l'action
			$action = " update ";
			//Récupération de la valeur de la clée
			$returnid = $datas[$Key];	
			//On insère dans les données préparées à la valeur de la clée lors de l'update
			$datasToSave[":$Key"] = $returnid;
		} else {
			//Définition de l'action
			$action = "insert";
			//On procéde à la mise à jour du champ created si il existe
			if(in_array('created', $this->shema())){
				$datas['created'] = date('Y-m-d H:i:s');
			}
			//On procéde à la mise à jour du champ created_by si il existe
			if(in_array('created_by', $this->shema())){
				$datas['created_by'] = Session::read('Backoffice.User.id');
			}
			/** Si dans les données postées il y a un champs password, on utilise la fonction sha1 pour crypter le mot de pass*/
			if(isset($datas['password'])){
				$datas['password'] = sha1($datas['password']);
			}
		}
		//On procéde à la mise à jour du champ modify si il existe
		if(in_array('modified', $this->shema())){
			$datas['modified'] = date('Y-m-d H:i:s');
		}
		//On procéde à la mise à jour du champ modified_by si il existe
		if(in_array('modified_by', $this->shema())){
			$datas['modified_by'] = Session::read('Backoffice.User.id');
		}
		//Il faut supprimer du tableau des données la clé primaire si celle ci est définie si c'est de l'update, et si la clé primaire n'est pas forcée, sinon on la garde
		if(isset($datas[$Key]) && !$forceInsert) unset($datas[$Key]);
		//on parcours les données
		foreach($datas as $k => $v){
			// On récupère le shéma de la table pour être sur de n'ajouter à la requète que des champs présent dans la table pour éviter les erreurs
			if(in_array($k, $this->shema())){
				$fieldsToSave[] = "$k=:$k";
				$datasToSave[":$k"] = $v;	
			}
		}
		// pr($action);
		// si c'est un ajout
		if($action == 'insert'){
			$sql = ' INSERT INTO '.$this->table.' SET '.implode(', ', $fieldsToSave).';';
		} else {
			$sql = ' UPDATE '.$this->table.' SET '.implode(',', $fieldsToSave).' WHERE '.$Key.'=:'.$Key.';';			
		}
		// pr($fieldsToSave);
		// pr($datasToSave);
		// pr($sql);
		$prepare = $this->db->prepare($sql);
		// pr($prepare);
		$prepare->execute($datasToSave);
		//affectation de la valeur de la clé primaire à la variable de classe
		if($action == 'insert') {
			$this->id = $this->db->lastInsertId();
		} else {
			$this->id = $returnid;
		}
	}
	
	
	/**
	 * Fonction de validation des données, 
	 *
	 *@param 	varchar	$datas 	les données postées.
	 *
	**/
	function validates($datas){
		// message d'erreur, par defaut vide
		$errors = array();
		//si il y a des règles de validation
		if(isset($this->validates)){
			//je parcous mon tableau de validation
			foreach($this->validates as $k => $v){	
				//Si l'index n'est pas présent dans les données postées, il y a une correspondance entre les index(ceux de la table et ceux des champs validate)
				if(!isset($datas[$k])) {
					// On affiche un message d'erreur
					$errors[$k] = $v['message'];
				} else {
					// sinon si les données postées sont vides 
					if($v['rule'] == "notEmpty"){
						//si c'est vide
						if(empty($datas[$k])){
							// Message d'erreur
							$errors[$k] = $v['message'];
						}
					//preg_match — Expression rationnelle standard
					} else {
						if(!preg_match('/^'.$v['rule'].'$/', $datas[$k])){ $errors[$k] = $v['message'];}	
					}
				} 
			}
		}	
		// On inject les erreurs dans le model
		$this->errors = $errors;
		// si c'est vide
		if(empty($errors)){//je retourne vrai 
		return true;
		}
		// je retourne faux
		return false;
	}
	
	
	/**
	 * Fonction permettant d'effectuer des recherches dans la base de données à partir un formulaire de recherche
	 * 
	 * $s		variable		Mots demandés pour la recherche
	 * $req peut être composé des index suivants :
	 * 	- fields (optionnel) : liste des champs à récupérer. Cet index peut être une chaine de caractères ou un tableau, si il est laissé vide la requête récupèrera l'ensemble des * colonnes de la table.
	 * @param 	array 	$req 	Tableau de conditions et paramétrages de la requete
	 * @param 	object 	$type 	Indique le type de retour de PDO dans notre cas un tableau dont les index sont les colonnes de la table
	 * @return 	array 	Tableau contenant les éléments récupérés lors de la requête  
	 * 
	**/
	
	public function search($s, $req = array(), $type = PDO::FETCH_ASSOC) {
		
		$sql = 'SELECT ';
		///////////////////
		// CHAMPS FIELDS //
		
		// si il 'y a pas de champs fields on va recup le shéma de la table 
		// Dans le cas de table traduite on va également récupérer les champs traduits
		if(!isset ($req['fields'])) {
			$req['fields'] = $this->shema();
		}
		if(is_array($req['fields'])){ $sql .= implode(', ', $req['fields']); 
		} else {
			$sql .= $req['fields']; // Si il s'agit d'une chaine de caractères
		}
		$sql .= ' FROM '.$this->table;
		$sql .= ' AS '.get_class($this).' ';
		
		///////////////////////
		// CHAMPS CONDITIONS //
		$i = 0;
		//je parcours ma variable qui contient le ou les mots de ma recherche
		foreach($s as $mot){
			// pr($mot);
			// Si mon formulaire de recherche contient un ou plusieurs mots je continue
			if(!empty($mot)){
				if(!is_numeric($mot)){
					// si le mot contient plus de 3 caractères je le prends en compte
					if(strlen($mot)>3){
						// Le premier param est égal à WHERE et je le concatène à ma requète
						if($i ==0){
							$sql.= ' WHERE ';
						}
						// Sinon c'est un OR et je le concatène aussi à ma requète
						else{
							$sql.= ' OR ';
						}
						// Condition 
						$sql.= "content LIKE '%$mot%'";
						$i++;
					}
			// sinon
				} else {
					//je redirige vers une page d'érreur
					header("Location: ".Router::url('posts/error'));
				}
			} else {
				//je redirige vers une page d'érreur
				header("Location: ".Router::url('posts/error'));
			}
		};
		// pr($sql);
		$pre = $this->db->prepare($sql); // On prépare la requête
		$pre->execute(); // On l'execute
		// pr($sql);
		// si l'execution s'est correctement déroulé 
		return $pre->fetchAll($type);
		// On retourne le résultat si demandé
	}
}