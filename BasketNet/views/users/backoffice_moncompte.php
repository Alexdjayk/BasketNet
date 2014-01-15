<?php 

if(Session::read('Backoffice.User.roles_id') != 3){
	$this->redirect('adm/posts/index');
} else {
?>

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
			<h2>Liste des administateurs</h2>
		</div>
		<div class="contentbox">
			<a class="btn bouton_add" href="<?php echo Router::url('adm/users/add');?>">Ajouter</a>
			<table width="100%" cellspacing="0" cellpadding="0" border="0" class="table">
				<thead>
					<tr>
						<th>id</th>
						<th>Name</th>
						<th>prenom</th>
						<th>pseudo</th>
						<th>naissance</th>
						<th>ville</th>
						<th>Catégorie</th>
						<th>Rôle</th>
						<th>Newsletter</th>
						<th>Login</th>
						<th>Password</th>
						<th>Creation</th>
						<th>Modification</th>
						<th>Edit</th>
						<th>Delete</th>
						<th><input name="" type="checkbox"  value=""  id="checkboxall" class="checkall" /></th>
					</tr>
				</thead>
				<tbody>
				<?php 
					
					foreach ($compte as $k => $v){ ?>
					<tr> 
						<td><?php echo $v['id']; ?></td>
						<td><?php echo $v['name']; ?></td>
						<td><?php echo $v['prenom']; ?></td>
						<td><?php echo $v['pseudo']; ?></td>
						<td><?php echo $v['naissance']; ?></td>
						<td><?php echo $v['ville']; ?></td>
						<td><?php echo $categoriesMatch[$v['categories_id']]; ?></td>
						<td><?php echo $fl_Roles[$v['roles_id']]; ?></td>
						<td><?php echo $v['newsletter']; ?></td>
						<td><?php echo $v['login']; ?></td>
						<td><?php echo $v['password']; ?></td>
						<td><?php echo $v['created']; ?></td>
						<td><?php echo $v['modified']; ?></td>
						<td>
							<a href="<?php echo Router::url('adm/users/backoffice_editcompte/'.$v['id']); ?>"><img src="<?php echo BASE_URL; ?>/img/icons/icon_edit.png" alt="Edit" /></a>
						</td>
						<td>
							<a href="<?php echo Router::url('adm/users/delete/'.$v['id']); ?>" class="deleteBox" onClick="return confirm('Voulez vous vraiment supprimer?');"><img src="<?php  echo BASE_URL; ?>/img/icons/icon_delete.png" alt="Delete" /></a>
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
			<div style="clear: both;"></div>
		</div>
	</div>
	<!-- Alternative Content Box End -->
	<?php include ELEMENTS.DS.'backoffice'.DS.'message_flash.php';?>
</div>

<!-- Right Side/Main Content End -->
<?php 
} 
?>




			
			
		


