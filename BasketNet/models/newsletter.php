<?php
Class Newsletter extends Model {
	
	var $validates = array(
		'name'=> array(
			'rule'=> 'notEmpty',
			'message'=> "Vous devez indiquez le titre"
			
		),
	);
}
