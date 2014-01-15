<?php 
// pr($this);
// pr('left : '.$this->request->data['lft']);
// pr('right : '.$this->request->data['rgt']);
// pr('parent_id : '.$this->request->data['parent_id']);
// pr('level : '.$this->request->data['level']);

echo $this->helpers['Form']->input('parent_id', "Page parente", array('type'=> 'select', 'datas' => $pagesList)); echo '</br>';
echo $this->helpers['Form']->input('name', "Titre de la page"); echo '</br>';
echo $this->helpers['Form']->input('slug', "Url"); echo '</br>';
echo $this->helpers['Form']->input('type', "", array('type' => 'hidden', 'value' => 1));
echo $this->helpers['Form']->input('user_id', "", array('type' => 'hidden', 'value' => 1));
echo $this->helpers['Form']->input('online', "En ligne", array('type'=> 'checkbox')); echo '</br>';

?>