<?php
class PostsController extends AppController{

/**
* Cette fonction permet de charger les éléments de mes posts, articles
*
*/
	function index() {
		// fonction pagination
		$d['elementPerPage'] = 3; // NB d'elements par pages 
		$d['page'] = $this->request->page; // Nb de pages (voir fonction request)
		$limit = $d['elementPerPage'] * ($d['page']-1); // limit par pages
		$conditions = array('online'=> 1);
		$d['nbPosts'] = $this->Post->findCount($conditions);
		$d['posts'] = $this->Post->find(array(
			'conditions'=> $conditions,
			'limit'=> $limit.', '.$d['elementPerPage'],
		));
		$d['nbPages'] = ceil($d['nbPosts'] / $d['elementPerPage']); 
		// pr($d);
		// pr($_GET);
		$this->set($d);
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesUser = $this->Categorie->find(); 
		$this->set('categoriesUser', $categoriesUser); //On fait passer les données à la vue
		// pr($categoriesUser);
		
		///////////////////////////////////////
		// RECUPERATION DES TYPES D'ARTICLES //
		
		$this->loadModel('Poststype');
		$fl_Poststypes = $this->Poststype->findList(); //On récupère les saisons
		$this->set('fl_Poststypes', $fl_Poststypes); //On les envois à la vue
		// pr($fl_Poststypes);
	}

/**
 * Cette fonction permet de récupérer le détail des posts, et d'afficher les commentaires si il y en a 
 *
 * @param 	integer Id 		Identifiant du post
 * @param 	varchar Slug 	Slug de l'article
 * @param 	varchar Prefix 	prefix du post
 * @access 	public
 */
	function view($id = NULL, $slug = false, $prefix= false){
	
		// On test si l'id existe 
		$id = (int)$id;
		if(!isset($id) || $id == 0) { $this->e404("Désolé mais la page demandée n'existe pas");} 
		// var_dump($id);

		$posts = $this->Post->find(
			array('conditions' => array(
			'id'=>$id,
			'online'=> 1
			))
		);
		
		// Si la page est vide -> erreur
		if(empty($posts)) {$this->e404('Cette article est introuvable');}
		// pr($slug);
		
		//si le slug existe et qu'il n'est pas vide 
		//if( $slug != $posts['slug']) {
		
			// dans ce cas on redirige la vue du post vers l'url 
		//	$this->redirect('posts/view/id:'.$posts['id'].'/slug:'.$posts['slug'].'/prefix:article', 301 );
			
		//} 
		// je rends la variable accessible à la vue
		$this->set('posts', $posts);	
		
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesUser = $this->Categorie->find(); 
		$this->set('categoriesUser', $categoriesUser); //On fait passer les données à la vue
		// pr($categoriesUser);
		
		///////////////////////////////////////
		// RECUPERATION DES TYPES D'ARTICLES //
		
		$this->loadModel('Poststype');
		$fl_Poststypes = $this->Poststype->findList(); //On récupère les saisons
		$this->set('fl_Poststypes', $fl_Poststypes); //On les envois à la vue
		// pr($fl_Poststypes);
		
		///////////////////////////////////////////
		// RECUPERATION DES PSEUDOS DES UTILISATEURS //
		
		$this->loadModel('User');
		$userspseudo = $this->User->findListPseudo(); //On récupère les catégories
		$this->set('userspseudo', $userspseudo); //On les envois à la vue
		// pr($userspseudo);
	
		///////////////////////////////
		// GESTION DES COMMENTAIRES //
		//////////////////////////////
		
		// fonction pagination
		$d['elementPerPage'] = 10; // NB d'elements par pages 
		$d['page'] = $this->request->page; // Nb de pages (voir fonction request)
		$limit = $d['elementPerPage'] * ($d['page']-1); // limit par pages
		// Je charge le model Commentspost
		$this->loadModel('Commentspost');
		$conditions = array('online'=> 1, 'posts_id'=>$id);
		$d['nbCommentsposts'] = $this->Commentspost->findCount($conditions);
		$d['commentsposts'] = $this->Commentspost->find(array(
			'conditions'=> $conditions,
			'limit'=> $limit.', '.$d['elementPerPage'],
		));
		$d['nbPages'] = ceil($d['nbCommentsposts'] / $d['elementPerPage']); 
		// pr($d);
		// pr($_GET);
		$this->set($d);
		
		// variable qui contient la liste des commentaires d'articles qui sont liés au articles et en ligne
		$commentaires = $this->Commentspost->find(
			array('conditions' => array(
			'posts_id'=>$id,
			'online'=> 1
			))
		);
		// je rends la variable accessible à la vue
		$this->set('commentaires', $commentaires);	
		
		////////////////////////////
		// AJOUT DE COMMENTAIRES //
		
		//Si il y  a des données postées 
		if($this->request->data){	
			// Si les données postées sont validées
			if($this->Commentspost->validates($this->request->data)) {
				// Je sauvegarde les données postées
				$this->Commentspost->save($this->request->data);
				// Message de confirmation
				$message ='Votre commentaire a bien été prise en compte, il sera diffusé après validation par notre modérateur';
				Session::setFlash($message, 'confirmation');
				// On redirige vers la page d'accueil des articles
				$this->redirect('/posts/view/'.$id);
			} else {
				//Variable qui contient les index d'erreurs dans la page Commentspost du dossier model
				$errors = $this->Commentspost->errors;
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
	}
	
/**
* Cette fonction permet d'afficher le résultat des recherches
*
* @access 	public
*/
	function search() {
		$this->loadModel('Commentspost');
		// Si il y a des données postées en GET
		if(isset($_GET['q'])){ ;
			// Var qui contient le résultat des données postées en GET
			$q = $_GET['q'];
			//On explode la chaîne de caractère en tableau
			$s= explode(" ", $q);
			//Variable qui permet d'afficher les résultats de la recherche pour la table post (A voir pour rajouter aussi les articles des pages et le commentaires)
			$search = $this->Post->search($s);
			// je rends la variable accessible à la vue
			$this->set('search', $search);
			$this->set('q', $q);
		}
	}
	
/**
* Cette fonction permet d'afficher la page d'érreur
*
* @access 	public
*/
	function error() {
	
	}
}