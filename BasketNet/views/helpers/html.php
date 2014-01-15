<?php class Html{
	
	
//Variable $css private qui contient un tableau vide par défaut.	
private $css = array();

//Variable $js private qui contient un tableau vide par défaut.
private $js = array();

/** 
* fonction css qui permet de charger les liens des pages css 
*
* @param 	VARCHAR 	$css 	lien css 
* @acces 	public
**/
	function css($css){
	
		$html = ''; 
		foreach($css as $k => $v) { 
			// exemple : $k = method, et $v = POST;
			$html .='<link';
			$html .= ' href="'.BASE_URL.'/css/'.$v.'.css"'; 
			$html .=' media="screen" type="text/css" rel="stylesheet"/>';
		} 
		// pr($css);
		return $html;
	}
	
	
/** 
* fonction js qui permet de charger les liens des pages js 
*
* @param 	VARCHAR 	$js 	lien js 
* @acces 	public
**/
	function js($js){
	
		$html = ''; 
		foreach($js as $k => $v) { 
			// exemple : $k = method, et $v = POST;
			$html .='<script';
			$html .= ' type="text/javascript" src="'.BASE_URL.'/js/'.$v.'.js"'; 
			$html .='></script>';
		} 
		// pr($js);
		return $html;
	}
	
/**
 * Merge a group of arrays
 *
 * @param 	array 	First array
 * @param 	array 	Second array
 * @param 	array 	Third array
 * @param 	array 	Etc...
 * @return 	array 	All array parameters merged into one
 * @link http://book.cakephp.org/view/1124/am
 */
	function am() {
		$r = array();
		$args = func_get_args();
		foreach ($args as $a) {
			if (!is_array($a)) {
				$a = array($a);
			}
			$r = array_merge($r, $a);
		}
		return $r;
	}

	
/**
* Cette fonction est utilisée pour générer le menu frontoffice
*
* @param 	array 		$pages				Liste des pages qui composent le menu
* @param 	array 		$categoriesUser		Liste des catégories des équipes du club
* @param 	array 		$fixe				Liste des éléments du menu fixe (blog, galerie, contact...)
* @param 	array 		$children			Liste des enfants du menu (Si il y a des enfants, cela genère automatiquement un sous menu au niveau de l'onglet qui en dispose)
*/

	function generateMenu($menuGeneral, $categoriesUser = false, $fixe = false, $children = false) {
		
		$request = new Request();
		$Url = $request->url;
		
		preg_match('#-(.+).html#isU', $Url, $matches);
		if(!empty($matches)){
			$slug = explode('-',$matches[1]);
			$id = end($slug);
		}else{
			$id = 0;
		}
		
		preg_match('#/(.+).html#isU', $Url, $matches);
		if(!empty($matches)){
			$slug = explode('-',$matches[1]);
			$page = end($slug);
		}else{ $page = 'blog'; }
		
		// Si mon menu 
		if(count($menuGeneral) > 0) { ?>
		
			<ul <?php if(!$children){?> class="sf-menu"<?php } ?> > <?php
			
			foreach($menuGeneral as $k => $v) {
			
			// pr($pages);
				?>
				<li>
					<?php $sCssMenu = '';  ?>
					<a href="<?php echo Router::url('pages/view/'.$v['id'].'/'.$v['slug']); ?>"<?php echo $sCssMenu; if($id == $v['id']){ echo 'class="active"'; } ?>><?php echo $v['name']; ?></a>
					<?php if(isset($v['children'])) { $this->generateMenu($v['children'], true, false,true); }; ?>
				</li>
				<?php
			}
			// si il existe des onglets fixe 
			if($fixe){
			
				// dans ce cas je les parcours
				foreach($fixe as $k => $v){
				?>
					<li>
						<a href="<?php echo $v; ?>" <?php if($page == $k ){ echo 'class="active"'; } ?>><?php echo $k; ?></a>
					</li>
					<li>
						<a href="<?php echo Router::url('pictures/index'); ?>">Galeries</a>
					</li>
					<li >
						<a href="<?php echo Router::url('categories/index'); ?>" title="contact" alt="contact">Nos équipes</a>
						<ul>
							<?php foreach($categoriesUser as $k=>$v){
								if($v['id'] != 0){
									echo '<li class="level2"><a class="level1-a drop" href="'.Router::url('categories/view/'.$v['id']).'" title="'.$v['name'].'" alt="'.$v['name'].'">'.$v['name'].'</a>' ;
								}
							} ?>
						</ul>
					</li> 
					<li>
						<a href="<?php echo Router::url('contacts/index'); ?>">Contact</a>
					</li>
					<?php
				}
			}
			?>
			</ul>
			<?php
		}		
	}
}
