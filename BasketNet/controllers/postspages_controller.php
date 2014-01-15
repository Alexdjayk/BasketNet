<?php
class PostspagesController extends AppController{

/**
 * Cette fonction permet de r�cup�rer le d�tail des posts en fonction des pages, et d'y afficher un formulaire de contact si besoin
 *
 * @param 	integer Id 		Identifiant du post
 * @access 	public
 */
	function view($id = NULL){
		
		////////////////////////////////////
		// AJOUT DE FORMULAIRE DE CONTACT //
		
		//Si il y  a des donn�es post�es 
		if($this->request->data){	
			// Si les donn�es post�es sont valid�es
			if($this->Contact->validates($this->request->data)) {
				// Je sauvegarde les donn�es post�es
				$this->Contact->save($this->request->data);
				// Message de confirmation
				$message ='Votre commentaire a bien �t� prise en compte, il sera diffus� apr�s validation par notre mod�rateur';
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
					// Je concatene le message d'erreur avec le message d'erreur de l'index o� il y a l'erreur
					$message .= $v.'</br>';
				}
				// J'affiche les 2 messages d'erreurs 
				Session::setFlash($message, 'error');
			}
		}
	}
}