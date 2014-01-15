<?php
Class Contact extends Model {
	
	var $validates = array(
		'name'=> array(
			'rule'=> 'notEmpty',
			'message'=> "- Vous devez indiquez votre Nom"
			
		),
		'prenom'=> array(
			'rule'=> 'notEmpty',
			'message'=> "- Vous devez indiquez votre Prenom"
			
		),
		'telephone'=> array(
			'rule'=> 'notEmpty',
			'message'=> "- Vous devez indiquez votre Numéro de téléphone"
			
		),
		'email'=> array(
			'rule'=> 'notEmpty',
			'message'=> "- Vous devez indiquez votre Adresse email"
			
		),
	);
}
