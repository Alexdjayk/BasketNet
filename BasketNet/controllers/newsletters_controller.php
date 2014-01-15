<?php
class NewslettersController extends AppController{

/**
* Cette fonction permet de charger les éléments de la newsletter
*
*/
	function index() {
		// fonction pagination
		$d['elementPerPage'] = 3; // NB d'elements par pages 
		$d['page'] = $this->request->page; // Nb de pages (voir fonction request)
		$limit = $d['elementPerPage'] * ($d['page']-1); // limit par pages
		// $this->loadModel('Post');
		$conditions = array('online'=> 1);
		$d['nbNewsletters'] = $this->Newsletter->findCount($conditions);
		$d['newsletters'] = $this->Newsletter->find(array(
			'conditions'=> $conditions,
			'limit'=> $limit.', '.$d['elementPerPage'],
		));
		$d['nbPages'] = ceil($d['nbNewsletters'] / $d['elementPerPage']); 
		// pr($d);
		// pr($_GET);
		$this->set($d);
		$conditions = array('online'=> 1);
		$nbNewsletters = $this->Newsletter->findCount($conditions);
		$this->set('nbNewsletters', $nbNewsletters);
	}
	
/**
* Cette fonction permet de charger les newsletters en détails
* A revoir sous forme de tableau
* @param	$id			INT		identifiant de la newsletter
* @param	$slug		VARCHAR		identifiant de la newsletter
* @param	$id			INT		identifiant de la newsletter
*/
	function view($id = NULL, $slug, $prefix){
		
		// On test si l'id existe 
		$id = (int)$id;
		if(!isset($id) || $id == 0) { $this->e404("Désolé mais la page demandée n'existe pas");} 
		// var_dump($id);
		
		// $this->loadModel('Post');
		
		$post = $this->Newsletter->findFirst(
			array('conditions' => array(
			'id'=>$id,
			'online'=> 1
			))
		);
		
		// Si la page est vide -> erreur
		if(empty($post)) {$this->e404('Cette article est introuvable');}
		// pr($slug);
		
		//si le slug existe et qu'il n'est pas vide 
		if( $slug != $post['slug']) {
		
			// dans ce cas on redirige la vue du post vers l'url 
			$this->redirect('posts/view/id:'.$post['id'].'/slug:'.$post['slug'].'/prefix:article', 301 );
			
		} 
		
		$this->set('post', $post);	
			
	}
	
	/** 
* La Fonction backoffice_index permet d'afficher tous les posts de type 2 et ainsi avoir la possibilité de modifier, ajouter, supprimer les posts.
**/
	function backoffice_index(){
		
		// fonction pagination
		$d['elementPerPage'] = 25; // NB d'elements par pages 
		$d['page'] = $this->request->page; // Nb de pages (voir fonction request)
		// pr($this->request);
		
		$limit = $d['elementPerPage'] * ($d['page']-1); // limit par pages
		
		
		$d['nbNewsletters'] = $this->Newsletter->findCount();
		
		$d['newsletters'] = $this->Newsletter->find(array(
		
			'limit'=> $limit.', '.$d['elementPerPage'],
	
		));
		
		$d['nbPages'] = ceil($d['nbNewsletters'] / $d['elementPerPage']); 

		$this->set($d);

		require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
		
	}
	
	/** 
	* La Fonction backoffice_add permet d'ajouter des articles
	*
	* @param 
	**/
	function backoffice_add(){
		//Si il y  a des données postées 
		if($this->request->data){
			// Si les données postées sont validées
			if($this->Newsletter->validates($this->request->data)) {
				//Si la newsletter est coché en ligne je l'envoie par mail 
				if(isset($this->request->data['online']) && $this->request->data['online'] == 1){
					//je charge le model User
					$this->loadModel('User');
					
					//J'affecte à la variable $conditions une restriction, seuls les utilisateurs qui ont coché la newsletter, les recevront
					$conditions = array('conditions'=> array('newsletter' => 1));
					
					//si il y a une catégorie de selectionné via la checkbox 
					if(!empty($this->request->data['categories_id'])) {
					
						// pr($this->request->data['categories_id']); 
						// pr(array_keys($this->request->data['categories_id'])); 
						
						// variable qui contient un tableau vide
						$tab = array();
						//Je parcours les catégories sélectionnées
						foreach($this->request->data['categories_id'] as $k => $v){
							// Si une catégorie est cochée
							if($v == 1){
								// J'affecte la clée à mon tableau
								$tab[] = $k;
								// Je récupère le resultat et je l'implode
								$resultat = implode(',', $tab);
								// $conditions['moreConditions'] = "categories_id IN (".implode(',', $k ).")";
	
							}
						}
						if(isset($resultat)){
							// je rajoute une condition, j'envoie la newsletter où les catégories sont dans le tableau qui contient les catégories cochées
							$conditions = array('moreConditions'=> 'categories_id IN('.$resultat.')');
							// pr($resultat);
						}
						// $conditions['moreConditions'] = "categories_id IN (".implode(',', array_keys($this->request->data['categories_id'])).")";
					
					}
					
					$users = $this->User->find($conditions);
					
					// Je parcours la table users
					foreach($users as $k=>$v){
						// J'envoie ma newsletter aux utilisateurs qui répondent aux critères des conditions du dessus
						$this->sendmail(
						array (
							'subject' => 'Newsletter pour les membres du club de basket',
							'from' => array("postmaster@fury-game.fr" => "Basket Club"),
							'to' => $v['login'], //plutot je recup l'adresse mail de la personne ($_POST['email'])
							// 'bcc' => array("djaykmatt@gmail.com"), si je rajoute ca mon mail ne va pas apparaitre lors de lenvoie de mail, ca evite detre spamé par la suite, Mon adresse devient invisible 
							'layout' => 'email',
							'view' => 'newsletter',
							'messagesend' => $_POST
						));
					};
					
				}
				// Je sauvegarde les données postées
				$this->Newsletter->save($this->request->data);
				// Message de confirmation
				Session::setFlash("Elément ajouté");
				// On redirige vers la page d'accueil des articles
				$this->redirect('/adm/newsletters/index');
				
			} else {
				//Variable qui contient les index d'erreurs dans la page Newsletter du dossier model
				$errors = $this->Newsletter->errors;
				// Variable qui contient un message d'erreur
				$message = "Erreur dans le formulaire ";
				// Je parcours les index d'erreurs 
				foreach($errors as $k => $v){
					// Je concatene le message d'erreur avec le message d'erreur de l'index où il y a l'erreur
					$message .= $v.'</br>';
				}
				// J'affiche les 2 messages d'erreurs 
				Session::setFlash($message, 'error');
			}
		}
		require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
	}
	
	
	/** 
	* La Fonction backoffice_add permet d'éditer des articles
	*
	* @param 
	**/
	function backoffice_edit($id){
		// Je charge le model Newsletter
		$this->loadModel('Newsletter');
		//Si il y  a des données postées 
		if($this->request->data){
			// Si les données postées sont validées
			if($this->Newsletter->validates($this->request->data)) {
				// Je sauvegarde les données postées
				$this->Newsletter->save($this->request->data);
				
				//je charge le model User
				$this->loadModel('User');
				
				//La variable users contient tout les utilisateurs qui ont un rôle de niveau 1
				$users = $this->User->find(array(
					'conditions'=> array(
						'role_id'=> 1,
				)));
				
				$this->set('users', $users);
				
				// $mailing est un tableau vide par défaut
				$mailing = array();
				
				// Je parcours la table users
				foreach($users as $k=>$v){
					// echo $v['login'].'</br>';
					// Je rajoute des '' autour des adresses mails
					$login = "'".$v['login']."'";
			
					
					//J'affecte à mon tableau vide les adresses mails
					$mailing[] =  $login;
				
				};
				
				// J'affecte à la variable $mail le résultat de mon tableaux d'adresses mail avec comme format => 'monadresse@gmail.com'
				$mail = implode(', ', $mailing);
				
				
				// Requete qui cherche dans la table newsletters tous les résultats qui sont online
				$news = $this->Newsletter->find();
				
				//Si la newsletter est coché en ligne je l'envoie par mail 
				if(isset($this->request->data['online']) && $this->request->data['online'] == 1) {
					// J'envoie une newsletter dans la boite de messagerie des utilisateurs du club qui ont pour rôle 1
					$this->sendmail(
						array (
						'subject' => 'Newsletter pour les membres du club de basket',
						'from' => array("postmaster@fury-game.fr" => "Basket Club"),
						'to' => array('helldjayk@gmail.com'), //plutot je recup l'adresse mail de la personne ($_POST['email'])
						// 'bcc' => array("djaykmatt@gmail.com"), si je rajoute ca mon mail ne va pas apparaitre lors de lenvoie de mail, ca evite detre spamé par la suite, Mon adresse devient invisible 
						'layout' => 'email',
						'view' => 'newsletter',
						'messagesend' => $_POST
						)
					);
				}
				
				// Message de confirmation
				Session::setFlash("Elément modifié");
				
				// On redirige vers la page d'accueil des articles
				$this->redirect('/adm/newsletters/index');	
				
			} else {
				//Variable qui contient les index d'erreurs dans la page Newsletter du dossier model
				$errors = $this->Newsletter->errors;
				// Variable qui contient un message d'erreur
				$message = "Erreur dans le formulaire ";
				// Je parcours les index d'erreurs 
				foreach($errors as $k => $v){	
					// Je concatene le message d'erreur avec le message d'erreur de l'index où il y a l'erreur
					$message .= $v.'</br>';
				}
				// J'affiche les 2 messages d'erreurs 
				Session::setFlash($message, 'error');
			}
		}
		// On récupère les données déjà postées
		$edit = $this->Newsletter->findFirst(
			array('conditions' => array(
			'id'=>$id
			))
		);
		$this->request->data = $edit;
		$this->set('id', $id);
		require(ROOT.DS.'controllers'.DS.'findlist_controller.php');
	}
	
	/**
	 * Cette fonction permet l'initialisation de la liste des catégories dans le site
	 *
	 * @access 	protected
	 */	
	protected function _init_categories() {
		
		$this->loadModel('Categorie'); //Chargement du modèle des catégories
		$categoriesUser = $this->Categorie->find(); //On récupère les types de posts		
		$this->set('categoriesUser', $categoriesUser); //On les envois à la vue
		
	}
	
	
	/**
	 * Cette fonction permet l'initialisation des données de l'association entre la newsletter et les catégories
	 *
	 * @param	integer $newsletterId Identifiant de la newsletter
	 * @access 	protected
	 */	
	protected function _get_assoc_datas($newsletterId) {

		$this->loadModel('Newscategorie'); //Chargement du modèle		
		$newscategories = $this->Newscategorie->find(array('conditions' => array('newsletters_id' => $newsletterId))); //On récupère les données
		
		
		//On va les rajouter dans la variable $this->request->data
		foreach($newscategories as $k => $v) { $this->request->data['categories_id'][$v['categories_id']] = 1; 
		
		}
	}
	
	
	/**
	 * Cette fonction permet la sauvegarde de l'association entre les posts et les types de posts
	 *
	 * @param	integer $newsletterId 		Identifiant du post
	 * @param	boolean $deleteAssoc 	Si vrai l'association entre l'utilisateur et les sites sera supprimée
	 * @access 	protected
	 * @author 	koéZionCMS
	 * @version 0.1 - 26/01/2012 by FI
	 */	
	protected function _save_assoc_datas($newsletterId) {
		
		$this->loadModel('Newscategorie'); //Chargement du modèle

		$categoriesId = $this->request->data['categories_id'];
		foreach($categoriesId as $k => $v) {
		
			if($v) {
		
				$this->Newscategorie->save(array(
					'newsletters_id' => $newsletters_id,
					'categories_id'	=> $k,
				));
			}
		}
	}
}