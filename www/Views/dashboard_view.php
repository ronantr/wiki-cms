<section>
	<h1 class="titleh1">Tableau de bord</h1>

	<section class="statistique">
		<h1 class="titleh1" style="width:100%;margin:0;font-size:2rem;">Statistique de création</h1>
		<div class="block">
			<h2><?php echo count($page);?> Pages</h2>
			<p>Depuis 1 Mois</p>

		</div>
		<div class="block">
			<h2><?php echo count($article); ?> Articles</h2>
			<p>Depuis 1 Mois</p>
		</div>
		<div class="block">
			<h2><?php echo count($commentaire); ?> Commentaires</h2>
			<p>Depuis 1 Mois</p>
		</div>
	</section>
	<div class="separateur"></div>
	<section class="statistique">
		<h1 class="titleh1" style="width:100%;margin:0;font-size:2rem;">Récent</h1>
		<div class="block-recent">
			<table>
				<thead>
					<tr>
						<td>Page</td>
						<td>Date</td>
					</tr>
				</thead>
				<tbody>
					<?php for($i=0;$i<5;$i++){ 
						if(!empty($page[$i])){?>
						<tr>
							<td><?php echo htmlspecialchars_decode($page[$i]['slug']);?></td>
							<td><?php echo $page[$i]['createdAt'];?></td>
						</tr>
						<?php }
						$i++;
					} ?>
				</tbody>
			</table>

		</div>
		<div class="block-recent">
			<table>
				<thead>
					<tr>
						<td>Article</td>
						<td>Date</td>
					</tr>
				</thead>
				<tbody>
					<?php for($i=0;$i<5;$i++){ 
						if(!empty($article[$i])){?>
						<tr>
							<td><?php echo htmlspecialchars_decode($article[$i]['title']);?></td>
							<td><?php echo $article[$i]['createdAt'];?></td>
						</tr>
						<?php }
						$i++;
					} ?>
				</tbody>
			</table>

		</div>
		<div class="block-recent">
			<table>
				<thead>
					<tr>
						<td>ID</td>
						<td>Date</td>
					</tr>
				</thead>
				<tbody>
					<?php for($i=0;$i<5;$i++){ 
						if(!empty($commentaire[$i])){?>
						<tr>
							<td><?php echo htmlspecialchars_decode($commentaire[$i]['id']);?></td>
							<td><?php echo $commentaire[$i]['createdAt'];?></td>
						</tr>
						<?php }
						$i++;
					} ?>
				</tbody>
			</table>

		</div>
	</section>	
</section>
