<?php
//Si il y a un prefix et que ce prefixe est �gale � backoffice et que la session de l'utilisateur n'est pas authentifi�
if(isset($this->request->prefix) && $this->request->prefix == 'backoffice' && !Session::check('Backoffice.User')){
	Session::setFlash('Vous devez vous connecter', 'success');
	//on redirige vers la page de connexion
	$this->redirect('connexion');
}