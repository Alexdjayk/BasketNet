<?php

echo $this->helpers['Form']->input('name', "Titre du slider"); echo '</br>';
echo $this->helpers['Form']->input('slug', "Url"); echo '</br>';
echo $this->helpers['Form']->input('image', "L'image du slider", array('type'=> 'textarea',  'toolbar' => 'image')); echo '</br>';
echo $this->helpers['Form']->ckeditor('image'); echo '</br>';
echo $this->helpers['Form']->input('online', "En ligne", array('type'=> 'checkbox')); echo '</br>';

?>