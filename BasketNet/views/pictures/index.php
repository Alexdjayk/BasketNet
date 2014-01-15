<?php 
$title_for_layout = 'Présentation du club'; 
$description_for_layout = 'description de la page de présentation du club'; 
?>
<div class="hr"></div>
<!-- AFFICHAGE DU FIL D'ARIANE-->
<?php include ELEMENTS.DS.'frontoffice'.DS.'breadcrumbs.php'; ?>
<div class="container_16">
	<div class="grid_16 titre_article"><h1>Présentation de la gallerie</h1></div>
	<div class="grid_11 omega " style="margin-top:20px; margin-bottom:25px;">
		<!-- ZONE DE PRESENTATION DU CLUB -->
		<div class="container_16">

			  <?php foreach($pictures as $k => $v){?>
				<div class="gallerie">
					<div class="gallerie_img"><?php echo $v['path'];?></div>
					<a href="<?php  echo Router::url('pictures/view/'.$v['id']);?>" title="<?php echo $v['name']; ?>" alt="<?php echo $v['name']; ?>"><h5 class="gallerie_name"><?php echo $v['name'];?></h5></a>
				</div>
			  <?php }?>
		</div>
		<!-- FIN DE ZONE DE PRESENTATION DU CLUB -->
	</div>
	
</div>




