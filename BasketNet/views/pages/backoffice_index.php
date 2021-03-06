<div id="breadcrumb">
	<div class="current" style="margin-top:-5px;"><h2>Bonjour <?php?> et bienvenue dans le backoffice </h2></div>
</div>
<!-- Top Breadcrumb End -->

<!-- Right Side/Main Content Start -->
<div id="rightside">
	<!-- Alternative Content Box Start -->
	 <div class="contentcontainer">
		<div class="headings alt">
			<h2>Liste des pages</h2>
		</div>
		<?php 
		// Message d'alerte
		include ELEMENTS.DS.'backoffice'.DS.'message_flash.php';
		?>
		<div class="contentbox">
			<a class="btn bouton_add" href="<?php echo Router::url('adm/pages/add');?>">Ajouter</a>
			<table width="100%" cellspacing="0" cellpadding="0" border="0" class="table">
				<thead>
					<tr>
						<th>id</th>
						<th>Online</th>
						<th>Name</th>
						<th>Level</th>
						<th>Lft</th>
						<th>Rgt</th>
						<th>Parent_id</th>
						<th>Edit</th>
						<th>Delete</th>
						<th><input name="" type="checkbox"  value=""  id="checkboxall" class="checkall" /></th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$levelMarge ='';
					// pr($pagesList);
					foreach ($pages as $k => $v){  ?>
					<?php 
						if($v['level'] == 1){$levelMarge = '__';} 
						if($v['level'] == 2){$levelMarge = '____ ';}
						if($v['level'] == 3){$levelMarge = '______ ';}
						if($v['level'] == 4){$levelMarge = '________ ';}
						if($v['level'] == 5){$levelMarge = '__________ ';}
					?>
					<tr> 
						<td><?php echo $v['id']; ?></td>
						<td style="text-align:center;">
							<?php if($v['online'] == 1){
								echo '<img src="'.BASE_URL.'/img/icons/icon_approve.png" alt="Approve" />';
							} else{
								echo '<img src="'.BASE_URL.'/img/icons/icon_unapprove.png" alt="Unapprove" />';
							}; ?>
						</td>
						<td><?php echo $levelMarge.$v['name']; ?></td>
						<td><?php echo $v['level']; ?></td>
						<td><?php echo $v['lft']; ?></td>
						<td><?php echo $v['rgt']; ?></td>
						<td><?php echo $v['parent_id']; ?></td>
						<td>
							<a href="<?php echo Router::url('adm/pages/edit/'.$v['id']); ?>"><img src="<?php echo BASE_URL; ?>/img/icons/icon_edit.png" alt="Edit" /></a>
						</td>
						<td>
							<a href="<?php echo Router::url('adm/pages/delete/'.$v['id']); ?>" class="deleteBox" onclick="return confirm('Voulez vous vraiment supprimer?');"><img src="<?php  echo BASE_URL; ?>/img/icons/icon_delete.png" alt="Delete" /></a>
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
				</ul>
			</div>
			<!-- PAGINATION -->
			<ul class="pagination">
				<li class="text"><a  href="<?php echo Router::url('adm/pages/index').'?page=1'; ?>">First </a></li>
				<?php for($i=1; $i<= $nbPages; $i++) { ?>
				<li class="page"><a  href="<?php echo Router::url('adm/pages/index').'?page='.$i; ?>"><?php echo $i ; ?></a></li>
				<?php } ?>
				<li class="text"><a href="<?php echo Router::url('adm/pages/index').'?page='.$nbPages; ?>">last</a></li>
			</ul>
			
			<div style="clear: both;"></div>
		</div>
	</div>
	<!-- Alternative Content Box End -->
	<div id="footer">
		&copy; Copyright 2013 Sport.net
	</div> 
	<div style="clear:both;"></div>
</div>
<!-- Right Side/Main Content End -->





			
			
		


