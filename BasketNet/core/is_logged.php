<?php
//Si il y a un prefix et que ce prefixe est égale à backoffice et que la session de l'utilisateur n'est pas authentifié
if(isset($this->request->prefix) && $this->request->prefix == 'backoffice' && !Session::check('Backoffice.User')){
	Session::setFlash('Vous devez vous connecter', 'success');
	//on redirige vers la page de connexion
	$this->redirect('connexion');
}