<?php
Class Commentspost extends Model {
	var $validates = array(
		'content'=> array(
			'rule'=> 'notEmpty',
			'message'=> "Vous devez remplir le formulaire"
			
		),
	);
}
