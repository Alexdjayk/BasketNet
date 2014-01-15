<?php 
$title_for_layout = 'Présentation de la gallerie du club'; 
$description_for_layout = 'description de la page de la gallerie du club'; 
?>
<?php 

$css = array(  
	'lightbox',  
);
echo $this->helpers['Html']->css($css);


$js = array(
	'jquery-1.7.1.min',
	'lightbox'
);
echo $this->helpers['Html']->js($js);
	
?>
<div class="hr"></div>
<!-- AFFICHAGE DU FIL D'ARIANE-->
<?php include ELEMENTS.DS.'frontoffice'.DS.'breadcrumbs.php'; ?>
<div class="container_16">
	<div>
		<?php 
		foreach($pictures as $k => $v){ ?>
			<h1 style="margin-left:20px;"><?php echo $v['name']; ?></h1>
			<div class="slideimg">
				<div class="set">
					<div class="gallerie"><?php
						// Variable qui contient le chemin des images de ma gallerie, 
						//FileAndDir::directoryContent() va permettre de charger toutes les images qui se trouvent dans le dossier parent ou se situe l'image
						$gallerie = FileAndDir::directoryContent(UPLOAD.DS.'files/'.$v['soustitre']);
						// pr($gallerie);
						foreach($gallerie as $k => $val){
							// pr($v);
							echo '<a href="'.BASE_URL .'/upload/files/'.$v['soustitre'].'/'.$val.'" rel="lightbox[plants]" title="cliquez sur les flèches pour avancer."><img class="gallerie_img_size border_magic" src='.BASE_URL .'/upload/files/'.$v['soustitre'].'/'.$val.' alt="" title=""></a>';
						};?>
					</div>
				</div>
			</div><?php 
		}?>
	</div>
</div>






