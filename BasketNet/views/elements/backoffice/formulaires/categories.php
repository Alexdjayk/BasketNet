<?php 

echo $this->helpers['Form']->input('name', "Nom de la catégorie"); echo '</br>';
echo $this->helpers['Form']->input('image', "Photo de l'équipe </br>(taille : 600 X 250px)", array('type'=> 'textarea',  'toolbar' => 'image')); echo '</br>';
echo $this->helpers['Form']->ckeditor('image'); echo '</br>';
echo $this->helpers['Form']->input('coach', "Nom de l'entraineur"); echo '</br>';
echo $this->helpers['Form']->input('entrainement', "Horraire des entrainements", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('entrainement'); echo '</br>';
echo $this->helpers['Form']->input('online', "En ligne", array('type'=> 'checkbox')); echo '</br>';
?>