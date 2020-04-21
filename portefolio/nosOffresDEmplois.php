<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-nosOffresDEmplois.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div class="containerAll">
                <h2>Nos offres d'emplois :</h2>
                <div class="candidature">
                    <div class="listeCandidature">
                        <?php
                            $reponse = $bdd->query('SELECT * FROM offreEmplois');
                            while ($donnees = $reponse->fetch()) {
                        ?>
                        <div class="offre">
                            <?php
                                $chaine = $donnees['titreOffreEmplois'];
                                echo '<h4>'. $chaine .'</h4>';
                            ?>
                            <div class="card">
                                <div class="offreEmploi">
                                    <div class="taille image">
                                        <img src="../public/image/offre_emploi/offreEmplois_consultant-informatique.jpg" alt="Consultant informatique">
                                    </div>
                                    <div class="taille option">
                                        <p><i class="fa fa-briefcase" style="color:black;"></i><a href="../pageEnConstruction.php">Postulez ici !</a></p>                           
                                        <p><i class="fa fa-star" style="color:black;"></i><a href="../pageEnConstruction.php">Intéressé(e) ?</a></p>                           
                                        <p><i class="fa fa-share-alt" style="color:black;"></i><a href="../pageEnConstruction.php">Partager</a></p>                           
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php
                                        $chaine = $donnees['descriptionOffreEmplois'];
                                        echo '<p>'. $chaine .'</p>';
                                    ?>
                                    </div>
                                    <div class="card-footer">
                                        <?php
                                            $chaine = $donnees['dateOffreEmplois'];
                                            echo '<p>'. $chaine .'</p>';
                                        ?>
                                        <?php echo 
                                            '
                                            <a href="../portefolio/candidatureEmploie.php?offreEmplois=' . $donnees['idOffreEmplois'] . '">
                                                <i class="fa fa-angle-double-right fa-2x" style="color:black;"></i>
                                            </a>'; 
                                        ?>

                                    </div>
                            </div>
                        </div> 
                        <?php }
                            $reponse->closeCursor(); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>