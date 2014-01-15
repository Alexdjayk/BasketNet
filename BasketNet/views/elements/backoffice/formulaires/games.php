<?php 

echo $this->helpers['Form']->input('categories_id', "Catégorie du match", array('type'=> 'select', 'datas'=> $categoriesMatch)); echo '</br>';
echo $this->helpers['Form']->input('date', "Date du match", array('value'=>'aaaa/mm/jj')); echo '</br>';
echo $this->helpers['Form']->input('heure', "Heure du match", array('value'=>'hh:mm')); echo '</br>';
echo $this->helpers['Form']->input('gamestypes_id', "Le type de match", array('type'=> 'select', 'datas'=> $lesGamestypes)); echo '</br>';
echo $this->helpers['Form']->input('stades_id', "Lieu du match", array('type'=> 'select', 'datas'=> $stades)); echo '</br>';
echo $this->helpers['Form']->input('equipes_id', "Notre équipe", array('type'=>'select', 'datas' => $equipeName)); echo '</br>';
echo $this->helpers['Form']->input('equipes_adverses_id', "Notre adversaire", array('type'=> 'select', 'datas'=> $equipes_adverses)); echo '</br>';
echo $this->helpers['Form']->input('resultat_equipe', "Notre score"); echo '</br>';
echo $this->helpers['Form']->input('resultat_adverse', "Score de l'adversaire"); echo '</br>';
echo $this->helpers['Form']->input('content', "Résumé du match", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('content'); echo '</br>';
echo $this->helpers['Form']->input('users_id', "", array('type'=> 'hidden', 'value'=> Session::read('Backoffice.User.id'))); echo '</br>';
echo $this->helpers['Form']->input('end_game', "Match terminé", array('type'=> 'checkbox')); echo '</br>';

?>