<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-forum.css">

<body>
	<?php include('../header-image.php') ?>
	<main>
		<div class="container">
			<div class="containerAll">
				<h2>Forum :</h2>
				<?php
				$categories = $bdd->query('SELECT * FROM topic_categories ORDER BY nom');
				$subcat = $bdd->prepare('SELECT * FROM topic_souscategories WHERE id_categorie = ? ORDER BY nom');
				?>
				<table class="forum">
					<tr class="header">
						<th class="main">Catégories</th>
						<th class="sub-info messages hide-640">Réponses</th>
						<th class="sub-info messages hide-640">Vues</th>
						<th class="sub-info dmessage">Dernière réponse</th>
					</tr>
					<?php
					while ($c = $categories->fetch()) {
						$subcat->execute(array($c['id']));
						$souscategories = '';
						while ($sc = $subcat->fetch()) {
							$souscategories .= '<a href="../forum/forum_topics.php?categorie=' . url_custom_encode($c['nom']) . '&souscategorie=' . url_custom_encode($sc['nom']) . '">' . $sc['nom'] . '</a> | ';
						}
						$souscategories = substr($souscategories, 0, -3);
					?>
						<tr class="categories">
							<td class="main">
								<h4><a href="../forum/forum_topics.php?categorie=<?= url_custom_encode($c['nom']) ?>"><?= $c['nom'] ?></a></h4>
								<p>
									<?= $souscategories ?>
								</p>
							</td>
							<td class="sub-info hide-640"><?= reponse_nbr_categorie($c['id']) ?></td>
							<td class="sub-info hide-640">999 999 999</td>
							<td class="sub-info"><?= derniere_reponse_categorie($c['id']) ?></td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</main>
	<?php include('../footer.php') ?>
</body>

</html>