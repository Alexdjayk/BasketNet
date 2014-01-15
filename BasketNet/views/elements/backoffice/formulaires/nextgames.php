<?php 

echo $this->helpers['Form']->input('categories_id', "Catégorie du match", array('type'=> 'select', 'datas'=> $categories)); echo '</br>';
echo $this->helpers['Form']->input('date', "Date du match", array('value'=>'aaaa/mm/jj')); echo '</br>';
echo $this->helpers['Form']->input('heure', "Heure du match", array('value'=>'hh:mm')); echo '</br>';
echo $this->helpers['Form']->input('stades_id', "Lieu du match", array('type'=> 'select', 'datas'=> $stades)); echo '</br>';
echo $this->helpers['Form']->input('equipes_id', "Notre équipe", array('type'=>'select', 'datas' => $equipes)); echo '</br>';
echo $this->helpers['Form']->input('equipes_adverses_id', "Notre adversaire", array('type'=> 'select', 'datas'=> $equipes_adverses)); echo '</br>';
echo $this->helpers['Form']->input('resultat_equipe', "Notre score"); echo '</br>';
echo $this->helpers['Form']->input('resultat_adverse', "Score de l'adversaire"); echo '</br>';
echo $this->helpers['Form']->input('end_game', "Match terminé", array('type'=> 'checkbox')); echo '</br>';

?>