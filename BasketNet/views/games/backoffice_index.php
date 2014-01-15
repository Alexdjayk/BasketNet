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
			<h2>Liste des matchs terminés </h2>
		</div>
		<div class="contentbox">
			<a class="btn bouton_add" href="<?php echo Router::url('adm/games/add');?>">Ajouter</a>
			<table width="100%" cellspacing="0" cellpadding="0" border="0" class="table">
				<thead>
					<tr>
						<th>id</th>
						<th>Catégorie</th>
						<th>Type</th>
						<th>date</th>
						<th>heure</th>
						<th>Lieu du match</th>
						<th>Notre equipe</th>
						<th>Equipe adverse</th>
						<th>Resltat equipe</th>
						<th>Resultat adverse</th>
						<th>Match terminé</th>
						<th>Edit</th>
						<th>Delete</th>
						<th><input name="" type="checkbox"  value=""  id="checkboxall" class="checkall" /></th>
					</tr>
				</thead>
				<tbody>
				<?php 
					
						foreach ($nextgames as $k => $v){ 
						if($v['end_game'] == 1) { ?>
						<tr> 
							<td><?php echo $v['id']; ?></td>
							<td><?php echo $categoriesMatch[$v['categories_id']]; ?></td>
							<td><?php echo $lesGamestypes[$v['gamestypes_id']]; ?></td>
							<td><?php echo $v['date']; ?></td>
							<td><?php echo $v['heure']; ?></td>
							<td><?php echo $stades[$v['stades_id']]; ?></td>
							<td><?php echo $equipeName[$v['equipes_id']]; ?></td>
							<td><?php echo $equipes_adverses[$v['equipes_adverses_id']]; ?></td>
							<td><?php echo $v['resultat_equipe']; ?></td>
							<td><?php echo $v['resultat_adverse']; ?></td>
							<td style="text-align:center;">
							<?php if($v['end_game'] == 1){
									echo '<img src="'.BASE_URL.'/img/icons/icon_approve.png" alt="Approve" />';
								} else{
									echo '<img src="'.BASE_URL.'/img/icons/icon_unapprove.png" alt="Unapprove" />';
								}; ?>
							</td>
							<td>
								<a href="<?php echo Router::url('adm/games/edit/'.$v['id']); ?>"><img src="<?php echo BASE_URL; ?>/img/icons/icon_edit.png" alt="Edit" /></a>
							</td>
							<td>
								<a href="<?php echo Router::url('adm/games/delete/'.$v['id']); ?>" class="deleteBox" onclick="return confirm('Voulez vous vraiment supprimer?');"><img src="<?php  echo BASE_URL; ?>/img/icons/icon_delete.png" alt="Delete" /></a>
							</td>
							<td class="txtcenter xxs"><input type="hidden" value="0" name="delete[<?php echo $v['id']; ?>]" id="InputDelete<?php echo $v['id']; ?>hidden">
								<input type="checkbox" value="1" name="delete[<?php echo $v['id']; ?>]" id="InputDelete<?php echo $v['id']; ?>">
							</td>
						</tr>
						
				  <?php }} ?>
				
					
				</tbody>
			</table>
			<div class="extrabottom">
				<ul>
					<li><img src="<?php echo BASE_URL; ?>/img/icons/icon_edit.png" alt="Edit" /> Edit</li>
					<li><img src="<?php echo BASE_URL; ?>/img/icons/icon_approve.png" alt="Approve" /> Approve</li>
					<li><img src="<?php echo BASE_URL; ?>/img/icons/icon_unapprove.png" alt="Unapprove" /> Unapprove</li>
					<li><img src="<?php echo BASE_URL; ?>/img/icons/icon_delete.png" alt="Delete" /> Remove</li>
					<li><?php echo 'Nombre de matchs terminés : '.$nbNextgames; ?></li>
				</ul>
			</div>
			<!-- PAGINATION -->
			<ul class="pagination">
				<li class="text"><a  href="<?php echo Router::url('adm/games/index').'?page=1'; ?>">First </a></li>
				<?php for($a=1; $a<= $nbPages2; $a++) { ?>
				<li class="page"><a  href="<?php echo Router::url('adm/games/index').'?page='.$a; ?>"><?php echo $a ; ?></a></li>
				<?php } ?>
				<li class="text"><a href="<?php echo Router::url('adm/games/index').'?page='.$nbPages2; ?>">last</a></li>
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




			
			
		


