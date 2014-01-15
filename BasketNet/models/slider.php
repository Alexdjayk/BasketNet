<?php
Class Slider extends Model {
	
	var $validates = array(
		'name'=> array(
			'rule'=> 'notEmpty',
			'message'=> "Vous devez indiquez le titre"
			
		),
		'slug'=> array(
			'rule'=> '([a-z0-9\-]+)',
			'message'=> "Le slug n'est pas valide"
		),
	);
}
