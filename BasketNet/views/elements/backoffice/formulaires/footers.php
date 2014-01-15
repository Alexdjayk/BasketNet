<?php 

echo $this->helpers['Form']->input('title1', "Titre du footer à gauche"); echo '</br>';
echo $this->helpers['Form']->input('content', "Contenu à gauche", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('content'); echo '</br>';
echo $this->helpers['Form']->input('title2', "Titre du footer au milieu"); echo '</br>';
echo $this->helpers['Form']->input('content2', "Contenu au milieu", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('content2'); echo '</br>';
echo $this->helpers['Form']->input('title3', "Titre du footer à droite"); echo '</br>';
echo $this->helpers['Form']->input('content3', "Contenu à droite", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('content3'); echo '</br>';
echo $this->helpers['Form']->input('title4', "Titre du footer à gauche"); echo '</br>';
echo $this->helpers['Form']->input('content4', "Contenu à gauche", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('content4'); echo '</br>';
echo $this->helpers['Form']->input('title5', "Titre du footer au milieu"); echo '</br>';
echo $this->helpers['Form']->input('content5', "Contenu au milieu", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('content5'); echo '</br>';
echo $this->helpers['Form']->input('title6', "Titre du footer à droite"); echo '</br>';
echo $this->helpers['Form']->input('content6', "Contenu à droite", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('content6'); echo '</br>';
echo $this->helpers['Form']->input('online', "En ligne", array('type'=> 'checkbox')); echo '</br>';

?>