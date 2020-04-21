<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-listeDesMembres.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div class="boxMonCompte">
                <h2>Mon Compte :</h2>
                <div class="divMonCompte">
                    <div class="barreNavigation">
                        <?php include('../barreNavidationCompte.php')  ?>
                    </div>
                    <div class="divListeDesMembres">
                        <h3>Liste des membres : </h3>
                        <div class="liste">
                            <?php
                            $reponse = $bdd->query('SELECT * FROM membre ORDER BY date_inscription');
                            while ($donnees = $reponse->fetch()) {
                            ?>
                                <div class="containerImage">
                                    <img src="../public/image/membre/<?php echo $donnees['pseudo']; ?>.jpg" alt="Avatar" class="image">
                                    <?php
                                        if($donnees['statu']=='admin'){
                                            echo '<div class="overlay admin">';
                                        }
                                        else{
                                            echo '<div class="overlay simpleMembre">';
                                        }
                                    ?>
                                        <div class="text">
                                            <div class="avatar">
                                                <img src="../public/image/membre/<?php echo $donnees['pseudo']; ?>.jpg" alt="Avatar">
                                                <label class="labelPseudo"><?php echo $donnees['pseudo']; ?></label>
                                            </div>
                                            <form method="POST" action="../admin/printToPDF.php">
                                                <input type="hidden" name="pseudo" id="pseudo" value="<?php echo $donnees['pseudo']; ?>">
                                                <p><?php echo $donnees['statu']; ?></p>
                                                <input type="hidden" name="statu" id="statu" value="<?php echo $donnees['statu']; ?>">
                                                <p><?php echo $donnees['nom'].' '; ?><?php echo $donnees['prenom']; ?></p>
                                                <input type="hidden" name="nom" id="nom" value="<?php echo $donnees['nom']; ?>">
                                                <input type="hidden" name="prenom" id="prenom" value="<?php echo $donnees['prenom']; ?>">
                                                <button type="submit" class="btn">PrintToPDF</button>
                                                <p><label>E-mail : </label><?php echo $donnees['email']; ?></p>
                                                <input type="hidden" name="email" id="email" value="<?php echo $donnees['email']; ?>">
                                                <p><label>Téléphone : </label><?php echo '+33' . $donnees['telephone']; ?></p>
                                                <input type="hidden" name="telephone" id="telephone" value="<?php echo $donnees['telephone']; ?>">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            $reponse->closeCursor();
                            ?>
                        </div>
                        <form class="allPrintToPDF" method="POST" action="../admin/allPrintToPDF.php">
                            <button class="buttonAction" type="submit">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                Imprimer tout les membres !
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main> <?php include('../footer.php') ?> </body>

</html>