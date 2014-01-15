<?php 

echo $this->helpers['Form']->input('name', "Nom"); echo '</br>';
echo $this->helpers['Form']->input('prenom', "Prénom"); echo '</br>';
echo $this->helpers['Form']->input('telephone', "Votre téléphone"); echo '</br>';
echo $this->helpers['Form']->input('message', "Contenu du message", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('message'); echo '</br>';
echo $this->helpers['Form']->input('email', "Votre email"); echo '</br>';
echo $this->helpers['Form']->input('valider', "Valider le message", array('type'=> 'checkbox')); echo '</br>';

?>