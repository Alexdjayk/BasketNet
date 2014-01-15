<?php 
$title_for_layout = 'Liste des équipes'; 
$description_for_layout = 'description de la page des équipes'; 
?>
<div>
	<div class="hr"></div>
	<div class="container_16 gamma ">
		<div class="titre_cat titre_article">
			<h1>Listes des équipes</h1>	
		</div>
		<div class="liste_categories">
			<?php
			foreach($categories as $k => $v){
				?><a class="bouton_categorie" href="<?php echo Router::url('categories/view/'.$v['id']) ;?>" alt="" title=""><h2><?php echo  $v['name'];?></h2></a><?php
			}
			?>
		</div>
	</div>
</div>
