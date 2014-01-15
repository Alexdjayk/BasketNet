<?php
class FocusController extends AppController{
/** 
* La fonction view va permettre d'afficher le détail de mes focus
**/
	function view($id){
				
		$focus = $this->Focu->findFirst(
			array('conditions' => array(
			'id'=>$id,
			'online'=> 1
			))
		);
		//Variable $focus Accessible à la vue 
		$this->set('focus', $focus);	
	}
}