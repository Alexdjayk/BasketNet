
<div id="breadcrumb">
	<div class="current" style="margin-top:-5px;"><h2>Prochains matchs : <?php foreach ($games as $k => $v){ echo $equipes[$v['equipes_id']].' VS '.$equipes_adverses[$v['equipes_adverses_id']].' / ';} ?> </h2></div>
</div>
<!-- Top Breadcrumb End -->
 
<!-- Right Side/Main Content Start -->
<div id="rightside">
	<!-- Alternative Content Box Start -->
	 <div class="contentcontainer">
		<div class="headings alt">
			<h2>Liste des prochains matchs </h2>
		</div>
		<div class="contentbox">
			<table width="100%" cellspacing="0" cellpadding="0" border="0" class="table">
				<thead>
					<tr>
						<th>id</th>
						<th>Catégorie</th>
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
					foreach ($games as $k => $v){ ?>
					<tr> 
						<td><?php echo $v['id']; ?></td>
						<td><?php echo $categories[$v['categories_id']]; ?></td>
						<td><?php echo $v['date']; ?></td>
						<td><?php echo $v['heure']; ?></td>
						<td><?php echo $stades[$v['stades_id']]; ?></td>
						<td><?php echo $equipes[$v['equipes_id']]; ?></td>
						<td><?php echo $equipes_adverses[$v['equipes_adverses_id']]; ?></td>
						<td><?php echo $v['resultat_equipe']; ?></td>
						<td><?php echo $v['resultat_adverse']; ?></td>
						<td><?php echo $v['end_game']; ?></td>
						
						<td>
							<a href="<?php echo Router::url('adm/nextgames/edit/'.$v['id']); ?>"><img src="<?php echo BASE_URL; ?>/img/icons/icon_edit.png" alt="Edit" /></a>
						</td>
						<td>
							<a href="<?php echo Router::url('adm/nextgames/delete/'.$v['id']); ?>" class="deleteBox" onclick="return confirm('Voulez vous vraiment supprimer?');"><img src="<?php  echo BASE_URL; ?>/img/icons/icon_delete.png" alt="Delete" /></a>
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
				<a class="btn" href="<?php echo Router::url('adm/nextgames/add');?>">Ajouter</a>
			</div>
			<!-- PAGINATION -->
			<ul class="pagination">
				<li class="text"><a  href="<?php echo Router::url('adm/nextgames/index').'?page=1'; ?>">First </a></li>
				<?php for($i=1; $i<= $nbPages; $i++) { ?>
				<li class="page"><a  href="<?php echo Router::url('adm/nextgames/index').'?page='.$i; ?>"><?php echo $i ; ?></a></li>
				<?php } ?>
				<li class="text"><a href="<?php echo Router::url('adm/nextgames/index').'?page='.$nbPages; ?>">last</a></li>
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





			
			
		


