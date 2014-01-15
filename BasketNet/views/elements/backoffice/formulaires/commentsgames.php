<?php 


echo $this->helpers['Form']->input('content', "Contenu du commentaire", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('content'); echo '</br>';
echo $this->helpers['Form']->input('online', "En ligne", array('type'=> 'checkbox')); echo '</br>';

?>