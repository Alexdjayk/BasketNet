<?php
Class Gamestype extends Model {
	
	var $validates = array(
		'name'=> array(
			'rule'=> 'notEmpty',
			'message'=> "Vous devez indiquez un nom de catégorie"
			
		)
	);
}
