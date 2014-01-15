<?php 
	// Nombre de messages validés
	//$this->loadModel('Contact');
	//$conditions = array('valider'=>1);
	//$nbElements = $this->Contact->findCount($conditions);
	//$this->set('nbElements', $nbElements);
	
	// Nombre de messages non validés
	//$conditions = array('valider'=>0);
	//$nbElement = $this->Contact->findCount($conditions);
	//$this->set('nbElement', $nbElement);
	
	/////////////////////////////
	// RECUPERATION DU SLIDER //
	
	$this->loadModel('Slider');
		
		$sliders = $this->Slider->find(array(
				'fields'=> array('image'),
				'conditions'=> array(
					'online' =>1
				)
			)
		);
	$this->set('sliders', $sliders);
	
	///////////////////////////////////////
	// RECUPERATION DES TYPES D'ARTICLES //
	
	$this->loadModel('Poststype');
	$fl_Poststypes = $this->Poststype->findList(); //On récupère les types d'articles
	$this->set('fl_Poststypes', $fl_Poststypes); //On les envois à la vue
	// pr($fl_Poststypes);
