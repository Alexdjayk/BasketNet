<?php
class SlidersController extends AppController{

/** 
* La fonction index va permettre d'afficher les sliders
**/
	function index(){
		
		$this->loadModel('Slider');
		
		$sliders = $this->Slider->find(array(
				'fields'=> array('image'),
				'conditions'=> array(
					'online' =>1
				)
			)
		);
		pr($sliders);
		$this->set('sliders', $sliders);
		
	}

/** 
* La fonction index va permettre d'afficher les sliders
**/
	// function view($id = NULL ){
		
		// $this->getSlider(); 
		
	// }
	
	
/** La fonction getSlider récupère la liste des sliders du menu, on retourne la variable $Slider qui contient le contenu de mon menu
*	via la fonction find
*	Voir schema requestAction
**/
	
	// function getSlider() {
	
		// $this->loadModel('Slider');
		
		// $slider = $this->Slider->find(
			// array(
				// 'conditions'=> array(
					// 'online' =>1
				// )
			// )
		// );
		// return $slider;
	// }
// }	

?>

