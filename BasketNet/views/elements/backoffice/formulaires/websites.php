<?php 

echo $this->helpers['Form']->input('name', "Titre du site"); echo '</br>';
echo $this->helpers['Form']->input('logo', "Le logo", array('type'=> 'textarea','toolbar' => 'image')); echo '</br>';
echo $this->helpers['Form']->ckeditor('logo'); echo '</br>';
echo $this->helpers['Form']->input('image', "Logo grand format", array('type'=> 'textarea','toolbar' => 'image')); echo '</br>';
echo $this->helpers['Form']->ckeditor('image'); echo '</br>';
echo $this->helpers['Form']->input('image2', "Logo supplémentaire", array('type'=> 'textarea','toolbar' => 'image')); echo '</br>';
echo $this->helpers['Form']->ckeditor('image2'); echo '</br>';
echo $this->helpers['Form']->input('background_left', "L'image de fond de gauche", array('type'=> 'textarea','toolbar' => 'image')); echo '</br>';
echo $this->helpers['Form']->ckeditor('background_left'); echo '</br>';
echo $this->helpers['Form']->input('background_right', "L'image de fond de droite", array('type'=> 'textarea','toolbar' => 'image')); echo '</br>';
echo $this->helpers['Form']->ckeditor('background_right'); echo '</br>';
echo $this->helpers['Form']->input('online', "En ligne", array('type'=> 'checkbox')); echo '</br>';

?>