<?php 

echo $this->helpers['Form']->input('name', "Nom de la gallerie"); echo '</br>';
echo $this->helpers['Form']->input('soustitre', "Nom du dossier"); echo '</br>';
echo $this->helpers['Form']->input('path', "Votre image de présentation", array('type'=> 'textarea', 'toolbar' => 'image')); echo '</br>';
echo $this->helpers['Form']->ckeditor('path'); echo '</br>';
echo $this->helpers['Form']->input('seasons_id', "La saison", array('type' => 'select', 'datas'=> $lesSeasons)); echo '</br>';
echo $this->helpers['Form']->upload_files('file');
echo $this->helpers['Form']->input('online', "En ligne", array('type'=> 'checkbox')); echo '</br>';

?>