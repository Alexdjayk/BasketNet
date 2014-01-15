<?php 

echo $this->helpers['Form']->input('imagetop', "Image du haut", array('type'=> 'textarea','toolbar' => 'image')); echo '</br>';
echo $this->helpers['Form']->ckeditor('imagetop'); echo '</br>';
echo $this->helpers['Form']->input('txtgauche', "Texte de gauche", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('txtgauche'); echo '</br>';
echo $this->helpers['Form']->input('txtcentre', "Texte du centre", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('txtcentre'); echo '</br>';
echo $this->helpers['Form']->input('txtdroite', "Texte de droite", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('txtdroite'); echo '</br>';
echo $this->helpers['Form']->input('content', "Contenu de l'historique", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('content'); echo '</br>';
echo $this->helpers['Form']->input('partenaires', "Présentation des partenaires", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('partenaires'); echo '</br>';
echo $this->helpers['Form']->input('photos', "Photos du cub", array('type'=> 'textarea','toolbar' => 'image')); echo '</br>';
echo $this->helpers['Form']->ckeditor('photos'); echo '</br>';
echo $this->helpers['Form']->input('online', "En ligne", array('type'=> 'checkbox')); echo '</br>';

?>