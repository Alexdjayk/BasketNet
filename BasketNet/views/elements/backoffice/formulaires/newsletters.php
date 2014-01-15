<?php 

echo $this->helpers['Form']->input('name', "Titre de la newsletter"); echo '</br>';
foreach($categoriesUser as $k => $v){
	 ?><span class="checkbox" style="float: left; display: block; margin: 0 20px 20px 0; width: 30%; line-height: 15px;"><?php
	echo $this->helpers['Form']->input('categories_id.'.$v['id'], $v['name'], array('type'=>'checkbox')); echo '</br>';
	 ?></span><?php
}
?><span class="clear"></span><?php
echo $this->helpers['Form']->input('description', "Description de la newsletter", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('description'); echo '</br>';
echo $this->helpers['Form']->input('content', "Contenu de la newsletter", array('type'=> 'textarea')); echo '</br>';
echo $this->helpers['Form']->ckeditor('content'); echo '</br>';
echo $this->helpers['Form']->input('online', "En ligne", array('type'=> 'checkbox')); echo '</br>';


?>