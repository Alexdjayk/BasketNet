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
			<h2>Liste des posts</h2>
		</div>
		<?php 
		$controllerDatas = $this->request->controller; 
		// pr($$controllerDatas);
		?>
		<div class="contentbox">
			<?php 
			// Méssage d'alerte
			include ELEMENTS.DS.'backoffice'.DS.'message_flash.php';
			?>
			<a class="btn bouton_add" href="<?php echo Router::url('adm/posts/add');?>">Ajouter</a>
			<table width="100%" cellspacing="0" cellpadding="0" border="0" class="table">
				<thead>
					<tr>
						<th>id</th>
						<th>Name</th>
						<th>Slug</th>
						<th>Content</th>
						<th>Created</th>
						<th>user_id</th>
						<th>Commentaires</th>
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
						<td><?php echo $v['name']; ?></td>
						<td><?php echo $v['slug']; ?></td>
						<td><?php echo $v['content']; ?></td>
						<td><?php echo $v['created']; ?></td>
						<td><?php echo $v['user_id']; ?></td>
						<td style="text-align:center;">
							<?php if($v['commentaires'] == 1){
								echo '<img src="'.BASE_URL.'/img/icons/icon_approve.png" alt="Approve" />';
							} else{
								echo '<img src="'.BASE_URL.'/img/icons/icon_unapprove.png" alt="Unapprove" />';
							}; ?>
						</td>
						<td>
							<a href="<?php echo Router::url('adm/posts/edit/'.$v['id']); ?>"><img src="<?php echo BASE_URL; ?>/img/icons/icon_edit.png" alt="Edit" /></a>
						</td>
						<td>
							<a href="<?php echo Router::url('adm/posts/delete/'.$v['id']); ?>" class="deleteBox" onClick="return confirm('Voulez vous vraiment supprimer?');"><img src="<?php  echo BASE_URL; ?>/img/icons/icon_delete.png" alt="Delete" /></a>
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
					<li>Nombres d'articles : <?php echo $nbElements;?></li>
				</ul>
			</div>
			<!-- PAGINATION -->
			<ul class="pagination">
				<li class="text"><a  href="<?php echo Router::url('blog_backoffice').'?page=1'; ?>">First </a></li>
				<?php for($i=1; $i<= $nbPages; $i++) { ?>
				<li class="page"><a  href="<?php echo Router::url('blog_backoffice').'?page='.$i; ?>"><?php echo $i ; ?></a></li>
				<?php } ?>
				<li class="text"><a href="<?php echo Router::url('blog_backoffice').'?page='.$nbPages; ?>">last</a></li>
			</ul>
			
			<div style="clear: both;"></div>
		</div>
	</div>
	<div style="clear:both;"></div>
	<div id="footer">
		&copy; Copyright 2013 Sport.net
	</div> 
</div>