<div>
	<div id="breadcrumb" >
		<div class="current" style="margin-top:-5px;"><h2>Bonjour <?php?> et bienvenue dans le backoffice </h2></div>
	</div>
</div>
<!-- Top Breadcrumb End -->

<!-- Right Side/Main Content Start -->
<div id="rightside">
	<!-- Alternative Content Box Start -->
	 <div class="contentcontainer">
		<div class="headings alt">
			<h2>Liste des commentaires des matchs</h2>
		</div>
		
		<?php 
		$controllerDatas = $this->request->controller; 
		// pr($$controllerDatas);
		?>
		<div class="contentbox">
			<table width="100%" cellspacing="0" cellpadding="0" border="0" class="table">
				<thead>
					<tr>
						<th>id</th>
						<th>Content</th>
						<th>user_id</th>
						<th>Created</th>
						<th>Online</th>
						<th>Edit</th>
						<th>Delete</th>
						<th><input name="" type="checkbox"  value=""  id="checkboxall" class="checkall" /></th>
					</tr>
				</thead>
				<tbody>
				<?php 
					
					foreach ($$controllerDatas as $k => $v){ ?>
					<tr> 
						<td><?php echo $v['id']; ?></td>
						<td><?php echo $v['content']; ?></td>
						<td><?php echo $userspseudo[$v['users_id']]; ?></td>
						<td><?php echo $v['created']; ?></td>
						<td style="text-align:center;">
							<?php if($v['online'] == 1){
								echo '<img src="'.BASE_URL.'/img/icons/icon_approve.png" alt="Approve" />';
							} else{
								echo '<img src="'.BASE_URL.'/img/icons/icon_unapprove.png" alt="Unapprove" />';
							}; ?>
						</td>
						<td>
							<a href="<?php echo Router::url('adm/commentsgames/edit/'.$v['id']); ?>"><img src="<?php echo BASE_URL; ?>/img/icons/icon_edit.png" alt="Edit" /></a>
						</td>
						<td>
							<a href="<?php echo Router::url('adm/commentsgames/delete/'.$v['id']); ?>" class="deleteBox" onClick="return confirm('Voulez vous vraiment supprimer?');"><img src="<?php  echo BASE_URL; ?>/img/icons/icon_delete.png" alt="Delete" /></a>
						</td>
						<td class="txtcenter xxs"><input type="hidden" value="0" name="delete[<?php echo $v['id']; ?>]" id="InputDelete<?php echo $v['id']; ?>hidden">
							<input type="checkbox" value="1" name="delete[<?php echo $v['id']; ?>]" id="InputDelete<?php echo $v['id']; ?>">
						</td>
					</tr>
		  <?php } ?>
					
				</tbody>
			</table>
			<div class="extrabottom">
				<ul>
					<li><img src="<?php echo BASE_URL; ?>/img/icons/icon_edit.png" alt="Edit" /> Edit</li>
					<li><img src="<?php echo BASE_URL; ?>/img/icons/icon_approve.png" alt="Approve" /> Approve</li>
					<li><img src="<?php echo BASE_URL; ?>/img/icons/icon_unapprove.png" alt="Unapprove" /> Unapprove</li>
					<li><img src="<?php echo BASE_URL; ?>/img/icons/icon_delete.png" alt="Delete" /> Remove</li>
					<li>Nombres de commentaires d'articles validés : <?php echo $nbCommentairesgames;?></li>
				</ul>
			</div>
			<!-- PAGINATION -->
			<ul class="pagination">
				<li class="text"><a  href="<?php echo Router::url('adm/commentsgames/index').'?page=1'; ?>">First </a></li>
				<?php for($i=1; $i<= $nbPages; $i++) { ?>
				<li class="page"><a  href="<?php echo Router::url('adm/commentsgames/index').'?page='.$i; ?>"><?php echo $i ; ?></a></li>
				<?php } ?>
				<li class="text"><a href="<?php echo Router::url('adm/commentsgames/index').'?page='.$nbPages; ?>">last</a></li>
			</ul>
			
			<div style="clear: both;"></div>
		</div>
	</div>
	<!-- Alternative Content Box End -->
	<?php include ELEMENTS.DS.'backoffice'.DS.'message_flash.php';?>
	<div style="clear:both;"></div>
	<div id="footer">
		&copy; Copyright 2013 Sport.net
	</div> 
</div>

<!-- Right Side/Main Content End -->





			
			
		


