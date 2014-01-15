<?php
class ContactsController extends AppController{

	/**
	* Fonction index de la class ContactsController, permet de contacter l'admin du site via un formulaire de contact
	**/
	function index() {
		
		//Si il y  a des données postées 
		if($this->request->data){
			// Si les données postées sont validées
			if($this->Contact->validates($this->request->data)) {
				// Je sauvegarde les données postées
				$this->Contact->save($this->request->data);
				// Je confirme l'envoie d'un message dans la boite de messagerie de l'utilisateur et à l'admin
				$this->sendmail(
					array (
					'subject' => 'Message pour le club de basket',
					'from' => array ("postmaster@fury-game.fr" => "Basket Club"),
					'to' => array ($_POST['email'], 'helldjayk@gmail.com'), //plutot je recup l'adresse mail de la personne ($_POST['email'])
					//'bcc' => array("djaykmatt@gmail.com"), si je rajoute ca mon mail ne va pas apparaitre lors de lenvoie de mail, ca evite detre spamé par la suite, Mon adresse devient invisible 
					'layout' => 'email',
					'view' => 'contact',
					'messagesend' => $_POST
					)
				);
				// Message de confirmation
				Session::setFlash("Message envoyé", "success");
				// On redirige vers la page d'accueil des articles
				$this->redirect('/contacts/index');
			} else {
				//Variable qui contient les index d'erreurs dans la page Contact du dossier model
				$errors = $this->Contact->errors;
				// Variable qui contient un message d'erreur
				$message = "Erreur dans le formulaire </br>";
				// Je parcours les index d'erreurs 
				foreach($errors as $k => $v){
					// Je concatene le message d'erreur avec le message d'erreur de l'index où il y a l'erreur
					$message .= $v.'</br>';
				}
				// J'affiche les 2 messages d'erreurs 
				Session::setFlash($message, 'error');
			}
		}
		///////////////////////////////////////////
		// RECUPERATION DE LA CATEGORIE DU MATCH //
		
		$this->loadModel('Categorie');
		$categoriesUser = $this->Categorie->find(); 
		$this->set('categoriesUser', $categoriesUser); //On fait passer les données à la vue
		// pr($categoriesUser);
		
		///////////////////////////////////////
		// RECUPERATION DES DONNEES DU SITE //
		
		$this->loadModel('Website');
		$websites = $this->Website->find(); //On récupère les saisons
		$this->set('websites', $websites); //On les envois à la vue
		// pr($websites);
}
	
	/** La fonction getMessage récupère la liste des méssages non validés et compte le nombre, 
	*	via la fonction find
	*	Voir schema requestAction
	**/
	
	function getMessage() {
		$this->loadModel('Contact');
		//les méssages non validés
		$conditions = array('valider'=> 0);
		//On compte le nombre de méssages non validés
		$NbContact = $this->Contact->findCount($conditions);
		// On rend la variable accessible à la vue
		$this->set('NbContact', $NbContact);
		// pr($NbContact);
		//On retourne le résultat
		return $NbContact;
	}
}	

