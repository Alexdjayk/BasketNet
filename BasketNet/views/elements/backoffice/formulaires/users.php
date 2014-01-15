<?php 

echo $this->helpers['Form']->input('name', "Nom"); echo '</br>';
echo $this->helpers['Form']->input('prenom', "Prénom"); echo '</br>';
echo $this->helpers['Form']->input('pseudo', "Pseudo"); echo '</br>';
echo $this->helpers['Form']->input('ville', "Ville "); echo '</br>';
echo $this->helpers['Form']->input('naissance', "Date de naissance", array('value' => 'yyyy/mm/jj')); echo '</br>';
echo $this->helpers['Form']->input('roles_id', "Votre rôle", array('type' => 'select', 'datas' => $fl_Roles)); echo '</br>';
echo $this->helpers['Form']->input('categories_id', "Votre catégorie", array('type' => 'select', 'datas' => $categoriesMatch)); echo '</br>';
echo $this->helpers['Form']->input('userstypes_id', "Votre statut", array('type' => 'select', 'datas' => $lesUserstypes)); echo '</br>';
echo $this->helpers['Form']->input('newsletter', "Recevoir la newsletter", array('type'=> 'checkbox')); echo '</br>';
echo $this->helpers['Form']->input('login', "Login "); echo '</br>';
echo $this->helpers['Form']->input('password', "Password ", array('type' => 'password')); echo '</br>';

?>