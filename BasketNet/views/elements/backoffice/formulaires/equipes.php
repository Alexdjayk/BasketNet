<?php 


echo $this->helpers['Form']->input('name', "Nom de mon équipe"); echo '</br>';
echo $this->helpers['Form']->input('logo', "Logo de mon équipe", array('type'=> 'textarea','toolbar' => 'image')); echo '</br>';
echo $this->helpers['Form']->ckeditor('logo'); echo '</br>';
echo $this->helpers['Form']->input('abreviation', "abréviation de mon équipe"); echo '</br>';
echo $this->helpers['Form']->input('icone', "Icone de mon équipe", array('type'=> 'textarea','toolbar' => 'image')); echo '</br>';
echo $this->helpers['Form']->ckeditor('icone'); echo '</br>';

?>