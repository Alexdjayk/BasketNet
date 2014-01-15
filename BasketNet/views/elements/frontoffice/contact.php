<?php
// Si il y a un formulaire de contact pour cet article je l'affiche si l'utilisateur est identifié
if($post['contacts'] == 1 && Session::check('Backoffice.User.id')){?>
	<div class="content_article">
		<div class="posts_article">
			<div class="hr"></div>
			<?php 
			// Affichage d'un message d'alerte
			include ELEMENTS.DS.'frontoffice'.DS.'message_flash.php';?>
			<img src="<?php echo BASE_URL ; ?>/img/frontoffice/contact.png" style="margin-left:10px; "alt="contact" title="contact">
			<h3 style="margin-bottom:5px; margin-top:-28px; margin-left:70px;">Nous contacter</h3>
			<a id="haut"></a>
			<div class="compte_input">
				<?php 
				echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('/contacts/index'))); echo '</br>';
				echo $this->helpers['Form']->input('name', "Votre nom"); echo '</br>';
				echo $this->helpers['Form']->input('prenom', "Votre prénom"); echo '</br>';
				echo $this->helpers['Form']->input('telephone', "Votre téléphone"); echo '</br>';
				echo $this->helpers['Form']->input('email', "Votre email"); echo '</br>';
				echo $this->helpers['Form']->input('message', "Votre message", array('type'=> 'textarea', 'cols' => 70, 'rows' => 20)); echo '</br>'; ?>
			</div>
			<div  class="extrabottom" style="float:left; margin-left:10px;">
				<input class="btn" type="submit" value="Envoyer" ><a href="#haut"></a></input>
			</div>
		</div>
	</div>
<?php 
} ?>