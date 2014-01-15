<?php 

echo $this->helpers['Form']->input('name', "Titre de l'article"); echo '</br>';
echo $this->helpers['Form']->input('slug', "Url"); echo '</br>';
echo $this->helpers['Form']->input('poststypes_id', "Type d'article", array('type'=>'select', 'datas' => $fl_Poststypes)); echo '</br>';
echo $this->helpers['Form']->input('user_id', "", array('type' => 'hidden', 'value' => 1));
echo $this->helpers['Form']->input('content', "Contenu de l'article", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('content'); echo '</br>';
echo $this->helpers['Form']->input('description', "Déscription longue", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('description'); echo '</br>';
echo $this->helpers['Form']->input('title_img', "Titre pour vos images"); echo '</br>';
echo $this->helpers['Form']->input('image', "Nom du dossier contenant vos images"); echo '</br>';
echo $this->helpers['Form']->upload_files('file');
echo $this->helpers['Form']->input('commentaires', "Formulaire de commentaires", array('type'=> 'checkbox')); echo '</br>';
echo $this->helpers['Form']->input('online', "En ligne", array('type'=> 'checkbox')); echo '</br>';

?>