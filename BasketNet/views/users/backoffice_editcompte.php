<?php include ELEMENTS.DS.'backoffice'.DS.'js.php';?>
<div>
	<div id="breadcrumb" >
		<div class="current" style="margin-top:-5px;"><h2>Bonjour <?php?> et bienvenue dans le backoffice </h2></div>
	</div>
</div>
<!-- Top Breadcrumb End -->
<?php include ELEMENTS.DS.'backoffice'.DS.'titre_tableau.php';?>
<!-- Right Side/Main Content Start -->
<div id="rightside">
	<!-- Alternative Content Box Start -->
	 <div class="contentcontainer">
		<div class="headings alt">
			<h2>Editer <?php echo $titrePage[$this->request->controller]; ?></h2>
		</div>
		<div class="contentbox">
			<?php 
			echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('/adm/users/backoffice_editcompte/'.$id))); echo '</br>';
			echo $this->helpers['Form']->input('id', "", array('type' => 'hidden'));
			echo $this->helpers['Form']->input('name', "Nom"); echo '</br>';
			echo $this->helpers['Form']->input('prenom', "Prénom"); echo '</br>';
			echo $this->helpers['Form']->input('pseudo', "Pseudo"); echo '</br>';
			echo $this->helpers['Form']->input('ville', "Ville "); echo '</br>';
			echo $this->helpers['Form']->input('naissance', "Date de naissance", array('value' => 'yyyy/mm/jj')); echo '</br>';
			echo $this->helpers['Form']->input('categories_id', "Votre catégorie", array('type' => 'select', 'datas' => $categoriesMatch)); echo '</br>';
			echo $this->helpers['Form']->input('newsletter', "Recevoir la newsletter", array('type'=> 'checkbox')); echo '</br>';
			echo $this->helpers['Form']->input('login', "Login "); echo '</br>';
			echo $this->helpers['Form']->input('password', "Password ", array('type' => 'password')); echo '</br>';
			echo $this->helpers['Form']->end(true);
			?>
		</div>
	</div>
	<!-- Alternative Content Box End -->
	<?php include ELEMENTS.DS.'backoffice'.DS.'message_flash.php';?>
</div>
<!-- Right Side/Main Content End -->