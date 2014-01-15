<?php 

echo $this->helpers['Form']->input('name', "Nom de l'équipe adverse"); echo '</br>';
echo $this->helpers['Form']->input('logo', "Logo de l'équipe adverse", array('type'=> 'textarea','toolbar' => 'image')); echo '</br>';
echo $this->helpers['Form']->ckeditor('logo'); echo '</br>';
echo $this->helpers['Form']->input('abreviation', "abréviation de l'équipe adverse"); echo '</br>';
echo $this->helpers['Form']->input('icone', "Icone de l'équipe adverse", array('type'=> 'textarea','toolbar' => 'image')); echo '</br>';
echo $this->helpers['Form']->ckeditor('icone'); echo '</br>';

?>