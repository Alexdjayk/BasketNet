<div>
	<div id="breadcrumb" >
		<div class="current" style="margin-top:-5px;"><h2>Bonjour <?php?> et bienvenue dans le backoffice </h2></div>
	</div>
</div>
<div id="rightside">
	<!-- Alternative Content Box Start -->
	 <div class="contentcontainer">
		<div class="headings alt">
			<h2>Configuration de la base de données (locale)</h2>
		</div>
		<div class="contentbox">
			<?php echo $this->helpers['Form']->create(array('id' => 'ConfigDatabase', 'action' => Router::url('backoffice/configs/database_liste'), 'method' => 'post')); ?>
			<div class="box">
				<div class="content nopadding">
					<!-- Affichage des messages d'erreurs-->
					<?php include ELEMENTS.DS.'backoffice'.DS.'message_flash.php';?>
					<?php 
					
					echo $this->helpers['Form']->input('localhost.host', ('Adresse du serveur'));			 
					echo $this->helpers['Form']->input('localhost.database', ('Nom de la bd'));			 
					echo $this->helpers['Form']->input('localhost.login', ('Identifiant'));			 
					echo $this->helpers['Form']->input('localhost.password', ('Mot de passe'));			 
					echo $this->helpers['Form']->input('localhost.prefix', ('Préfix des tables'));	
					?>
				</div>
			</div>			
	<?php echo $this->helpers['Form']->end(true); ?>
		</div>
	</div>
	<!-- Alternative Content Box End -->

	<!-- Alternative Content Box Start -->
	 <div class="contentcontainer">
		<div class="headings alt">
			<h2>Configuration de la base de données (production)</h2>
		</div>
		<div class="contentbox">
			<?php echo $this->helpers['Form']->create(array('id' => 'ConfigDatabase', 'action' => Router::url('backoffice/configs/database_liste'), 'method' => 'post')); ?>
			<div class="box">
				<div class="content nopadding">
					<?php 
					echo $this->helpers['Form']->input('online.host', ('Adresse du serveur'));			 
					echo $this->helpers['Form']->input('online.database', ('Nom de la bd'));			 
					echo $this->helpers['Form']->input('online.login', ('Identifiant'));			 
					echo $this->helpers['Form']->input('online.password', ('Mot de passe'));			 
					echo $this->helpers['Form']->input('online.prefix', ('Préfix des tables'));	
					?>
				</div>
			</div>			
	<?php echo $this->helpers['Form']->end(true); ?>
		</div>
	</div>
	<!-- Alternative Content Box End -->
</div>

