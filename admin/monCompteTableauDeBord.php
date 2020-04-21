<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-monCompteTableauDeBord.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="/public/js/diagramme.js"></script>
        <label class="container">
            <label class="boxMonCompte">
                <h2>Mon compte</h2>
                <label class="divMonCompte">
                    <div class="barreNavigation">
                        <?php include('../barreNavidationCompte.php')  ?>
                    </div>
                    <label class="divTableauDeBord">
                        <h3>Tableau de bord : </h3>
                        <div class="tableauDeBord">
                            <div class="partieGauche">
                                <div class="top10Article">
                                    <label>Top 10 des articles les plus vendus</label>
                                    <ul class="listeTop10Article">
                                        <?php
                                        $reponse = $bdd->query('SELECT id_produit, count(id_produit) as cs from commande group by id_produit order by cs desc limit 10');
                                        while ($donnees = $reponse->fetch()) {
                                            $req = $bdd->prepare('SELECT * from produit where reference=?');
                                            $req->execute(array($donnees['id_produit']));
                                            $data = $req->fetch();
                                        ?>
                                            <li>
                                                <label class="nomProduit"><?php echo $data['nom']; ?></label>
                                                <a href="#"><?php echo $donnees['cs']; ?></a>
                                            </li>
                                        <?php
                                        }
                                        $reponse->closeCursor(); ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="partieDroite">
                                <div class="categorieArticlePlusVendu diagramme">
                                    <label>Catégorie d'article les plus vendu : </label>
                                    <div class="diagramme">
                                        <div id="piechart"></div>
                                    </div>
                                </div>
                                <div class="diagramme">
                                    <label>Répartition des ventes en Europe : </label>
                                    <div class="diagramme">
                                        <div id="geochart-colors" style="width: 100%; height: 250px;"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="diagramme">
                            <label>Performance de la compagnie : </label>
                            <div class="performanceDeLaCompagnie diagramme">
                                <div class="diagramme">
                                    <div id="columnchart_material" style="width:100%; height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="diagramme">
                            <label>Fréquence de visite du site : </label>
                            <div class="diagramme">
                                <div id="Aeraschart_div" style="width: 100%; height: 450px;"></div>
                            </div>
                        </div>
                    </label>
                </label>
            </label>
        </label>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>