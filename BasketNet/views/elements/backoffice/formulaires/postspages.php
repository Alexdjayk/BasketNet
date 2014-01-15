<?php 
echo $this->helpers['Form']->input('pages_id', "Page parente", array('type'=> 'select', 'datas' => $pagesList)); echo '</br>';
echo $this->helpers['Form']->input('name', "Titre de l'article"); echo '</br>';
echo $this->helpers['Form']->input('slug', "Url"); echo '</br>';
echo $this->helpers['Form']->input('content', "Contenu de l'article", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('content'); echo '</br>';
echo $this->helpers['Form']->input('contacts', "Formulaire de contact", array('type'=> 'checkbox')); echo '</br>';
echo $this->helpers['Form']->input('online', "En ligne", array('type'=> 'checkbox')); echo '</br>';

?>