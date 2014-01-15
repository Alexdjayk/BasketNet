<?php class Form{

	/** Variable contenant l'objet controler ayant fait appel au formumaire
	*
	* @var objet
	* @acces public
	**/
	public $controller;
	
	/** 
	* Controlleur de la classe
	*
	*@param 	objet	$view Vue par laquelle la classe est utilisée
	*@acces public
	**/
	function __construct($controller = null){
		$this->controller = $controller;
	
	}
	
	
	/** 
	* Fonction create permet de créer le debut d'un formulaire html avec les options indiquées
	*
	* @params varchar paramètres tableau des options possibles
	* @return varchar chaine de caractères contenant la balise de début de formulaire
	* @acces public
	**/
	function create($params){
	
		$html = '<form'; 
		foreach($params as $k => $v) { 
			// exemple : $k = method, et $v = POST;
			$html .= ' '.$k.'="'.$v.'"'; 
		} 
		$html .= '>';
		return $html;
	}
	
	/**
	* La fonction end va permettre de fermer le formulaire
	*
	* @param booléan $full Booléan indiquant si on ne retourne que la fermeture du formulaire
	* @return varchar chaine de caractères contenant la balise de fin de formulaires
	**/
	function end($full = false){
		
		$html = '';
		if($full){
			$html .='<button class="btn_add btn" type="submit" ><span>Envoyer</span></button>';
		}
		$html .= '</form>';
		return $html;
	}
	
	/**
	* Enter description here...
	*
	* @param unknown_type $input
	* @return unknown
	*
	*/
	function upload_files($field, $params = null) {
	
		if(!isset($params) || empty($params)) {

			$params['label'] = "Fichier à importer";
			$params['tooltip'] = "Sélectionnez le fichier à importer, sélectionnez un fichier vide pour supprimer les données de la catégorie";
			$params['button_value'] = "Sélectionnez le fichier";			
		} else {

			if(!isset($params['label'])) { $params['label'] = "Fichier à importer"; }
			if(!isset($params['tooltip'])) { $params['tooltip'] = "Sélectionnez le fichier à importer, sélectionnez un fichier vide pour supprimer les données de la catégorie"; }
			if(!isset($params['button_value'])) { $params['button_value'] = "Sélectionnez le fichier"; }			
		}
		
		$inputFieldId = $this->_set_input_id($field);	
		
		ob_start();
		?>
		<script type="text/javascript">
			function BrowseServer<?php echo $inputFieldId; ?>() {
			
				// You can use the "CKFinder" class to render CKFinder in a page:
				var finder = new CKFinder();
				finder.basePath = './js/ckfinder/';	// The path for the installation of CKFinder (default = "/ckfinder/").
				finder.selectActionFunction = SetFileField<?php echo $inputFieldId; ?>;
				finder.popup();
			
				// It can also be done in a single line, calling the "static"
				// popup( basePath, width, height, selectFunction ) function:
				// CKFinder.popup( '../', null, null, SetFileField ) ;
				//
				// The "popup" function can also accept an object as the only argument.
				// CKFinder.popup( { basePath : '../', selectActionFunction : SetFileField } ) ;
			}
			
			// This is a sample function which is called when a file is selected in CKFinder.
			function SetFileField<?php echo $inputFieldId; ?>(fileUrl) { document.getElementById("<?php echo $inputFieldId; ?>").value = fileUrl; }				
		</script>	
		<div class="rows">	
			<label style="margin-top:18px;">
				<?php echo $params['label']; ?>
			</label>
			<div class="">			
				<?php 
				echo $this->input('select_file', '', array('type' => 'button', 'onclick' => 'BrowseServer'.$inputFieldId.'();', 'displayError' => false, 'label' => false, 'div' => false, 'tooltip' => false, 'value' => $params['button_value']));
				echo $this->input($field, '', array('tooltip' => false, 'div' => false, 'label' => false, 'class' => 'upload_file'));
				?>
			</div>
		</div>	
		<?php
		
		return ob_get_clean();
	}		
	
	/**
	* Cette fonction permet la création des champs input
	* Les valeurs possibles pour le paramètres options sont : 
	* - type : type de champ input --> hidden, text, textarea, checkbox, radio, file, password, 
	* - label : si vrai la valeur retrounée contiendra le champ label
	* - div : si vrai la valeur retournée sera contenu dans une div 
	* - displayError : si vrai affiche les erreurs sous les champs input
	* - value : si renseignée cette valeur sera insérée dans le champ input
	* - tooltip : si renseignée affichera un tooltip à coté du label
	* - wysiswyg : si renseigné est à vrai alors le code de l'éditeur sera généré
	* 
	* @param varchar $name		Nom du champ input, qui est le meme que celui du champ de la table de la base de donnée
	* @param varchar $label		Label pour le champ input
	* @param varchar $options	Options par défaut
	* @return varchar Chaine html	
	* @acces public
	**/
	function input($name, $label, $options = array()){
	
		// Variable qui contient les attributs à ne pas mettre à nouveau
		$escapeAttribut = array('type','value','label', 'error','wysiswyg','datas', 'displayError', 'div'); //Champs à échaper
	
		// liste des options par défaut
		$defaultOptions = array(
			'type' => 'text',
			'label' => true,
			'value' => false,
			'datas' => array(),
		);
	
		
		// Génération du nouveau tableau d'options si les options par défaut sont modifiés alors on écrase les nouvelles données
		$options = array_merge($defaultOptions, $options); 
		
		//GESTION DES ATTRIBUTS
		$attributs = '';
		// On parcours le tableau des options
		foreach($options as $k => $v) { 
			
			// si les valeurs ne sont pas dans le tableau alors on les affiche, possible de la faire avec un array_diff() compare le tableau array1 avec le tableau array2 et retourne la différence. 
			if(!in_array($k, $escapeAttribut)) { $attributs .= ' '.$k.'="'.$v.'"'; }
			 
		}
		// pr($attributs);
		
		// mise en variable du name
		$inputNameText = $this -> _set_input_name($name);

		//mise en variable de l'id
		$inputIdText = $this -> _set_input_id($inputNameText);
		
		//GESTION DE LA VALEUR PAR DEFAUT
		$value = $this -> _get_input_value($name, $options['value']);
		
		// les options type sont hidden je retourne un input de type hidden
		if($options['type'] == 'hidden'){

			return '<input type="hidden"  name="'.$inputNameText.'"  value="'.$value.'" id="'.$inputIdText.'" />';
			
		}
		
		// Variable qui va contenir la chaine de caractère de l'input
		$html = '';
		$labelReturn = '';
			
		$html .= '<div class="row">';
	
		// $html .= '<label for ="'.$inputIdText.'">'.$label.'</label>';
		
		if($options['label']){
			$labelReturn .= '<label style="margin-top:18px; "for ="'.$inputIdText.'">'.$label.'</label>';
		}
		
		$html .= '<div class="rowright">';
		
		switch($options['type']) { 
		
			// input de type text
			case 'text':
		
				$html .= '<input type="text" '.$attributs.' name="'.$inputNameText.'"  value="'.$value.'" id="'.$inputIdText.'" />';
				
			break;
			

			// input de type textarea
			case 'textarea':
				
				$html .= '<textarea '.$attributs.' name="'.$inputNameText.'" id="'.$inputIdText.'" >'.$value.'</textarea>';			

				if(isset($options['toolbar']) && $options['toolbar']) { 
					$toolbar = $options['toolbar']; 
					$html .= $this->ckeditor(array($inputNameText), $toolbar); 
				} else { $toolbar = null; }
				
			break;
			
			
			// input de type file
			case 'file':
				
				$html .= '<input type="file" '.$attributs.' name="'.$inputNameText.'"  value="'.$value.'" id="'.$inputIdText.'" />';						
			break;
			
			
			// input de type password
			case 'password':
				
				$html .= '<input type="password" '.$attributs.' name="'.$inputNameText.'"  value="'.$value.'" id="'.$inputIdText.'" />';						
			break;
			
			
			// input de type submit
			case 'submit':
				
				$html .= '<input type="submit" '.$attributs.' name="'.$inputNameText.'"  value="'.$value.'" id="'.$inputIdText.'" />';						
			break;
			
			//   INPUT DE TYPE BUTTON   //		
			case 'button': 
			
				$html .= '<input style="width:140px;" type="button" id="'.$inputIdText.'" name="'.$inputNameText.'" value="'.$value.'"'.$attributs.' />';
			break;
			
			// input de type checkbox
			case 'checkbox':
			
				// empty($value) ? $checked = '' : $checked = 'checked="checked"';
				
				// if($value) { $checked = 'checked="checked"'; } else { $checked = ''; }
				$html .= '<input type="hidden"  name="'.$inputNameText.'" id="'.$inputIdText.'Hidden" value="0">';
				// $html .= '<input type="checkbox"  name="'.$inputNameText.'" id="'.$inputIdText.'" '.$checked.' value="1" >';				
				$html .= '<input type="checkbox"  name="'.$inputNameText.'" id="'.$inputIdText.'" value="1" '.(empty($value)?'' : 'checked').' >';				
			break;
			
			
			// input de type select
			case 'select':
				// pr($options['datas']);
				$html .= '<select name="'.$inputNameText.'" id="'.$inputIdText.'"';
				if(isset($options['multiple']) && $options['multiple']){$html .= 'multiple = "multiple"';}
				$html .= $attributs.'>';
					// parcours de l'ensemble des données du select
					foreach($options['datas'] as $k => $v) {
				
						if(isset($value) && $value == $k) { $selected = ' selected="selected"'; } else { $selected = ''; }
					
						$html .='<option value="'.$k.'"'.$selected.'>'.$v.'</option>';  
					}
					// Si il n'y a pas d'options dans ce cas on affiche des options vides par défaut
					if(count($options['datas']) == 0){$html .='<option></option>';}
				
				$html .= '</select>';
				
			break;

		}

		$html .= '</div>';
	$html .= '</div>';
	return $labelReturn.$html;
	}
	
	
	/**
	 * Cette fonction va générer le libellé de l'attribut id en fonction de la valeur de
	 * l'attribut name camelcasé
	 * 
	 * @param 	varchar $name Valeur de l'attribut name
	 * @return 	varchar Libellé de l'attribut id
	 * @access	private
	 */
	function _set_input_name($name) {
		// $idName = 'Input'.ucfirst($name);
		// $idName = 'Input';
		// $idName = $name;
		// $params = explode('_', $name);
		
		// on crée un tableau par rapport au caratère
		$params = explode('.', $name); 
		
		// variable par défaut
		$return = ''; 
		// on parcours le nb d'éléments du tableau
		foreach($params as $k => $v) { 
			//Par defaut lors du premier passage on ne va pas mettre les []
			//Elles ne seront mise 
			if($k == 0){
				$return .= $v; 
			} else {
				// $idName .= '['.ucfirst($v).']'; 
				 $return .= '['.$v.']'; 
			}
		}
		
		// pr($return);
		return $return;
	}
	
	
	/**
	*Cette fonction permet la création de la chaine de caractère qui sera le ID du champ input
	* Le paramètre principal est le name du champ input
	* @param 	varchar $id du champ input
	* @return	varchar Chaine de caractère contenant la valeur  
	* @acces private
	**/
	function _set_input_id($id){
		$return = 'input_'.$id;
		$return = str_replace('[', ' ', $return);
		$return = str_replace(']', ' ', $return);
		$return = Inflector::camelize(Inflector::variable($return));
		return $return;
	}
	
	
	/**
	* Cette fonction permet ma récupération de la valeur par défaut du champ input
	*
	*@param 	varchar	$name Nom du champ$
	*@param		mixed 	$defaultValue Valeur par défaut
	*@return 	mixed 	Valeur du champ input
	*@acces 	private
	**/
	protected function _get_input_value($name, $defaultValue){
	
		// Si les données n'ont jamais été postées
		if(!isset($this->controller->request->data[$name]) && $defaultValue){
			return $defaultValue;
		} else {
			// Sinon on retourne celle postée
			return Set::classicExtract($this->controller->request->data, $name);
		}
	}
	
	
	/**
	* Cette fonction permet de rajouter le wysywyg de ckeditor
	*
	*@param 	varchar	$input 
	*@param 	varchar	
	*@acces 	private
	**/
	function ckeditor($input, $toolbar = null) {
	
		if(!is_array($input)) $input = array($input);

		ob_start();
	
		?>
		<script type ="text/javascript">
			<?php 
			foreach($input as $k => $v){
		
				$id = $this->_set_input_id($v);?>				

				<?php if(!isset($toolbar)) { ?>var ck_<?php echo $id; ?>_editor = CKEDITOR.replace('<?php echo $id; ?>');<?php } 
			
				else if($toolbar == "image") { ?>var ck_<?php echo $id; ?>_editor = CKEDITOR.replace('<?php echo $id; ?>', {toolbar:[{name:'document',items:['Source']},{name:'insert',items:['Image']},{name:'links',items:['Link','Unlink']}]});<?php }
				else if($toolbar == "gallerie") { ?>var ck_<?php echo $id; ?>_editor = CKEDITOR.replace('<?php echo $id; ?>', {toolbar:[{name:'document',items:['Source', 'Templates']},{name:'insert',items:['Image']},{name:'links',items:['Link','Unlink']}]});<?php }
				
				?>CKFinder.setupCKEditor( ck_<?php echo $id;?>_editor, '<?php echo Router::webroot('js/ckfinder/'); ?>'); <?php
				
			}?>
		</script>
		<?php 
		return ob_get_clean();
	}
}
