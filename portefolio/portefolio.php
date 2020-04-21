<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-portefolio.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div class="containerAll">
                <?php
                $req = $bdd->query('SELECT * FROM parametres WHERE 1');
                $donnees = $req->fetch()
                ?>
                <h2>Portefolio :</h2>
                <?php if($donnees['descriptionEntreprise'] != NULL){ ?>
                <div class="card">
                    <div class="imgBox">
                        <img src="../public/image/portefolio/quiSommesNous.jpg" />
                    </div>
                    <div class="contentBox">
                        <div class="content">
                            <h2>Qui sommes nous ?</h2>
                            <p>
                                <?php 
                                    $chaine = $donnees['descriptionEntreprise'];
                                    $morceau_chaine = substr($donnees['descriptionEntreprise'], 0, 250);
                                    echo $morceau_chaine; 
                                ?>
                            </p>
                            <a href="../portefolio/quiNousSommes.php">Lire plus ...</a>
                        </div>
                    </div>
                </div>
                <?php }if($donnees['nosprojetsrealises'] != NULL){ ?>
                <div class="card">
                    <div class="imgBox">
                        <img src="../public/image/portefolio/nosProjets.jpeg" />
                    </div>
                    <div class="contentBox">
                        <div class="content">
                            <h2>Nos projets déjà réalisés</h2>
                            <p>
                                <?php echo $donnees['nosprojetsrealises']; ?>
                            </p>
                            <a href="../portefolio/nosProjets.php">Lire plus ...</a>
                        </div>
                    </div>
                </div>
                <?php }if($donnees['nousrecrutons'] != NULL){ ?>
                <div class="card">
                    <div class="imgBox">
                        <img src="../public/image/portefolio/offreEmploie.jpg" />
                    </div>
                    <div class="contentBox">
                        <div class="content">
                            <h2>Nos offres d'emplois...</h2>
                            <p><?php echo $donnees['nousrecrutons']; ?></p>
                            <a href="../portefolio/nosOffresDEmplois.php">Lire plus ...</a>
                        </div>
                    </div>
                </div>
                <?php }if($donnees['notrevisionavenir'] != NULL){ ?>
                <div class="card">
                    <div class="imgBox">
                        <img src="../public/image/portefolio/nousContacter.jpg" />
                    </div>
                    <div class="contentBox">
                        <div class="content">
                            <h2>Nous contacter</h2>
                            <p><?php echo $donnees['notrevisionavenir']; ?></p>
                            <a href="../contact/contact.php">Lire plus ...</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>