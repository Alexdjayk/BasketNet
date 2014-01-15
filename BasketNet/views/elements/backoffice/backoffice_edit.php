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
			echo $this->helpers['Form']->create(array('method' => 'POST', 'action' => Router::url('/adm/'.$this->request->controller.'/edit/'.$id))); echo '</br>';
			echo $this->helpers['Form']->input('id', "", array('type' => 'hidden'));
			// include ELEMENTS.DS.'backoffice'.DS.'formulaires'.DS.$this->request->controller.'.php';
			$this->elements('backoffice'.DS.'formulaires'.DS.$this->request->controller.'.php');
			echo $this->helpers['Form']->end(true);
			?>
		</div>
	</div>
	<!-- Alternative Content Box End -->
	<?php include ELEMENTS.DS.'backoffice'.DS.'message_flash.php';?>
</div>
<!-- Right Side/Main Content End -->
