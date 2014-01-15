<?php 

echo $this->helpers['Form']->input('name', "Titre de l'article"); echo '</br>';
echo $this->helpers['Form']->input('slug', "Url"); echo '</br>';
echo $this->helpers['Form']->input('user_id', "", array('type' => 'hidden', 'value' => 1));
echo $this->helpers['Form']->input('content', "Contenu de l'article", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('content'); echo '</br>';
echo $this->helpers['Form']->input('image', "Image de l'article", array('type'=> 'textarea','toolbar' => 'image')); echo '</br>';
echo $this->helpers['Form']->ckeditor('image'); echo '</br>';
echo $this->helpers['Form']->input('online', "En ligne", array('type'=> 'checkbox')); echo '</br>';

?>