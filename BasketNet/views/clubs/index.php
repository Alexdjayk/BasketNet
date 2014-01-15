<?php 
$title_for_layout = 'Présentation du club'; 
$description_for_layout = 'description de la page de présentation du club'; 
?>
<div class="hr"></div>
<div class="container_16">
	<div class="grid_16"><h1>Présentation du club</h1></div>
	<div class="grid_11 omega " style="margin-top:20px; margin-bottom:25px;">
		<!-- ZONE DE PRESENTATION DU CLUB -->
		<div class="container_16">
			<div  class="grid_10" style="margin-left:3px;">
				
			  <?php foreach($clubs as $k => $v){?>
						
						<div style="margin-top:25px;"><?php echo $v['imagetop'];?></div>
						<div class="grid_10" style="margin-top:25px;" >
							<div class="focus_titre grid_3" style='margin-top:20px; margin-right:25px; '>
								<a href="" title="" alt="" ><h3>titre 1</h3></a>
								<div class="focus_content  " ><?php echo $v['txtgauche'];?></div>
							</div>
							<div class="focus_titre grid_3" style='margin-right:25px;'>
								<a href="" title="" alt="" style="margin-left:110px;"><h3>titre 2</h3></a>
								<div class="focus_content "  ><?php echo $v['txtcentre'];?></div>
							</div>
							<div class="focus_titre grid_3" style='margin-right:20px;'>
								<a href="" title="" alt="" style="margin-left:410px; "><h3>titre 3</h3></a>
								<div class=" focus_content " ><?php echo $v['txtdroite'];?></div>
							</div>
						</div>
						
						<div class="grid_10" style="margin-top:25px;">
							<a href="" title="" alt="" ><h3>Historique du club</h3></a>
							<div class="hr_posts_homes"></div>
							<div class="focus_content grid_10" ><?php echo $v['content'];?></div>
						</div>
						
						<div class="grid_10" style="margin-top:25px;">
							<a href="" title="" alt="" ><h3>Partenaires du club</h3></a>
							<div class="hr_posts_homes"></div>
							<div class="focus_content grid_10" ><?php echo $v['partenaires'];?></div>
						</div>
						
						<div class="grid_10" style="margin-top:25px;">
							<a href="" title="" alt="" ><h3>Photos du club</h3></a>
							<div class="hr_posts_homes"></div>
							
							<div class=" grid_2 omega" style="margin-left:-10px;"><?php echo $v['photos']; ?></div>
						</div>
			  <?php }?>
			</div>
		</div>
		<!-- FIN DE ZONE DE PRESENTATION DU CLUB -->
	</div>
	<!-- AFFICHAGE DE LA COLONNE DE DROITE -->
	<?php include ELEMENTS.DS.'frontoffice'.DS.'colonne_droite.php'; ?>
	<!-- FIN DE L'AFFICHAGE DE LA COLONNE DE DROITE -->
</div>




