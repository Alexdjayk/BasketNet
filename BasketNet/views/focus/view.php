<?php $title_for_layout = $focus['name']; ?>
<?php $description_for_layout = $focus['name']; ?>

<div class="grid_16 article_detail">
	<div class="hr"></div>
	<?php
		
			/* Configure le script en français */
			setlocale (LC_TIME, ' fr-FR','fra');
			//Définit le décalage horaire par défaut de toutes les fonctions date/heure  
			date_default_timezone_set("Europe/Paris");
			//Definit l'encodage interne
			mb_internal_encoding("UTF-8");
			//Convertir une date US en françcais
			
			$dateFormat = $focus['created'];
			$fulldate = strftime("%d %b %Y",strtotime("$dateFormat")); // affiche la date du match en Français jj/mm/yyyy 
			$date = strftime("%m",strtotime("$dateFormat")); // affiche la date du match en Français jj/mm/yyyy 
			$day = strftime("%d",strtotime("$dateFormat")); // affiche la date du match en Français jj/mm/yyyy  
			if($date == 01){$dates = "Jan";}
			if($date == 02){$dates = "Fév";}
			if($date == 03){$dates = "Mar";}
			if($date == 04){$dates = "Avr";}
			if($date == 05){$dates = "Mai";}
			if($date == 06){$dates = "Jui";}
			if($date == 07){$dates = "Jui";}
			if($date == 08){$dates = "Aou";}
			if($date == 09){$dates = "Sep";}
			if($date == 10){$dates = "Oct";}
			if($date == 11){$dates = "Nov";}
			if($date == 12){$dates = "Déc";}

	?>
	<div class="posts_article">
			<div class="blog_post_img"><img src="<?php echo BASE_URL ; ?>/img/frontoffice/blog-post-title3.png" title="" alt=""></div>
			<h1><?php echo $focus['name']; ?></h1>
			<div class="date_posts"><?php echo $dates.', '.$day;?></div>
			<div class="typearticle"><span><?php echo $fulldate; ?></span> tags :<span> Focus</span> par <span>Djayk</span></div>
			<div class="hr"></div>
			<div class=" " style="float:left; margin-left:20px; margin-right:20px;"><?php echo $focus['image']; ?></div>
			<div class="" style="margin-top:5px;"><?php echo $focus['content']; ?></div>
		</div> 
	</div>
</div>



