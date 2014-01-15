<div id="breadcrumb">
	<div class="current" style="margin-top:-5px;"><h2>Bonjour <?php?> et bienvenue dans le backoffice </h2></div>
</div>
<!-- Top Breadcrumb End -->
<?php 
$controllerDatas = $this->request->controller; 
// pr($$controllerDatas);
?>
<!-- Right Side/Main Content Start -->
<div id="rightside">
	<!-- Alternative Content Box Start -->
	 <div class="contentcontainer">
		<div class="headings alt">
			<h2>Liste des footers</h2>
			<?php 
			// Message d'alerte
			include ELEMENTS.DS.'backoffice'.DS.'message_flash.php';
			?>
		</div>
		<div class="contentbox">
			<a class="btn bouton_add" href="<?php echo Router::url('adm/footers/add');?>">Ajouter</a>
			<table width="100%" cellspacing="0" cellpadding="0" border="0" class="table">
				<thead>
					<tr>
						<th>id</th>
						<th>title1</th>
						<th>content</th>
						<th>title2</th>
						<th>content2</th>
						<th>title3</th>
						<th>content3</th>
						<th>title4</th>
						<th>content4</th>
						<th>title5</th>
						<th>content5</th>
						<th>title6</th>
						<th>content6</th>
						<th>created</th>
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
						<td><?php echo $v['title1']; ?></td>
						<td><?php echo $v['content']; ?></td>
						<td><?php echo $v['title2']; ?></td>
						<td><?php echo $v['content2']; ?></td>
						<td><?php echo $v['title3']; ?></td>
						<td><?php echo $v['content3']; ?></td>
						<td><?php echo $v['title4']; ?></td>
						<td><?php echo $v['content4']; ?></td>
						<td><?php echo $v['title5']; ?></td>
						<td><?php echo $v['content5']; ?></td>
						<td><?php echo $v['title6']; ?></td>
						<td><?php echo $v['content6']; ?></td>
						<td><?php echo $v['online']; ?></td>
						<td>
							<a href="<?php echo Router::url('adm/footers/edit/'.$v['id']); ?>"><img src="<?php echo BASE_URL; ?>/img/icons/icon_edit.png" alt="Edit" /></a>
						</td>
						<td>
							<a href="<?php echo Router::url('adm/footers/delete/'.$v['id']); ?>" class="deleteBox" onclick="return confirm('Voulez vous vraiment supprimer?');"><img src="<?php  echo BASE_URL; ?>/img/icons/icon_delete.png" alt="Delete" /></a>
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
				<li class="text"><a  href="<?php echo Router::url('adm/footers/index').'?page=1'; ?>">First </a></li>
				<?php for($i=1; $i<= $nbPages; $i++) { ?>
				<li class="page"><a  href="<?php echo Router::url('adm/footers/index').'?page='.$i; ?>"><?php echo $i ; ?></a></li>
				<?php } ?>
				<li class="text"><a href="<?php echo Router::url('adm/footers/index').'?page='.$nbPages; ?>">last</a></li>
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





			
			
		


