<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-blog.css">

<?php
$ArticleParPage = 5;
$ArticleTotalesReq = $bdd->query('SELECT id FROM billets');
$ArticleTotales = $ArticleTotalesReq->rowCount();
$pagesTotales = ceil($ArticleTotales / $ArticleParPage);
if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $pagesTotales) {
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
} else {
    $pageCourante = 1;
}
$depart = ($pageCourante - 1) * $ArticleParPage;
?>

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div class="containerAll">
                <h2>Blog :</h2>
                <div class="divAllBlog">
                    <?php
                    $reponse = $bdd->query('select id,contenu,titre, DAY(date_creation) AS jour, MONTH(date_creation) AS mois, YEAR(date_creation) AS annee, HOUR(date_creation) AS heure, MINUTE(date_creation) AS minute, SECOND(date_creation) AS seconde from billets order by date_creation limit ' . $depart . ',' . $ArticleParPage);
                    while ($donnees = $reponse->fetch()) {
                    ?>
                        <div class="divBlog">
                            <div class="blogPostImage">
                                <?php
                                $image = str_replace(' ', '', '../public/image/blog/' . $donnees['titre'] . '.jpg');
                                echo '<img src="' . $image . '" alt="Image : ' . $donnees['titre'] . '">'; ?>
                            </div>
                            <div class="blogPostInfo">
                                <div class="blogPostDate">
                                    <span><?php echo '<Le ' . $donnees['jour'] . '/' . $donnees['mois'] . '/' . $donnees['annee'] . ' à ' . $donnees['heure'] . 'h' . $donnees['minute'] . '</p>'; ?></span>
                                </div>
                                <h3 class="blogPostTitre"><?php echo $donnees['titre']; ?></h3>
                                <P><?php $chaine = $donnees['contenu'];
                                    $morceau_chaine = substr($donnees['contenu'], 0, 225);
                                    echo $morceau_chaine; ?></P>
                                <a <?php echo 'href="../blog/commentaires.php?id_billet=' . $donnees['id'] . '"' ?> class="blogPostLien">Lire plus ...</a>
                            </div>
                        </div>

                    <?php }
                    $reponse->closeCursor(); ?>
                </div>
                <div class="pagination">
                    <?php
                    for ($i = 1; $i <= $pagesTotales; $i++) {
                        if ($i == $pageCourante) {
                            echo '<button  class="active" class="button">' . $i . '</button>';
                        } else {
                            echo '<a href="../blog/blog.php?page=' . $i . '"><button>' . $i . '</button></a> ';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>