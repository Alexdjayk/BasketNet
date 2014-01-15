<?php
class PostspagesController extends AppController{

/**
 * Cette fonction permet de récupérer le détail des posts en fonction des pages, et d'y afficher un formulaire de contact si besoin
 *
 * @param 	integer Id 		Identifiant du post
 * @access 	public
 */
	function view($id = NULL){
		
		////////////////////////////////////
		// AJOUT DE FORMULAIRE DE CONTACT //
		
		//Si il y  a des données postées 
		if($this->request->data){	
			// Si les données postées sont validées
			if($this->Contact->validates($this->request->data)) {
				// Je sauvegarde les données postées
				$this->Contact->save($this->request->data);
				// Message de confirmation
				$message ='Votre commentaire a bien été prise en compte, il sera diffusé après validation par notre modérateur';
				Session::setFlash($message, 'confirmation');
				// On redirige vers la page d'accueil des articles
				$this->redirect('/pages/view/'.$id);
			} else {
				//Variable qui contient les index d'erreurs dans la page Contact du dossier model
				$errors = $this->Contact->errors;
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
}