<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-mesAdresses.css">


<?php
if (isset($_GET['id_adresse']) && $_GET['id_adresse'] != NULL) {
    $_SESSION['id_adresse'] = $_GET['id_adresse'];
}
?>

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div class="boxMonCompte">
                <h2>Mon compte</h2>
                <div class="divMonCompte">
                    <div class="barreNavigation">
                        <?php include('../barreNavidationCompte.php')  ?>
                    </div>
                    <div class="divAdresses">
                        <h3>Mes adresses : </h3>
                        <h5>Mes adresse:</h5>
                        <div class="adresse">
                            <div class="listeAdresse">
                                <?php
                                $reponse = $bdd->prepare('SELECT * from adresse where idUtilisateur=?');
                                $reponse->execute(array($_SESSION['id']));
                                while ($donnees = $reponse->fetch()) {
                                    if ($_SESSION['id_adresse'] != NULL) {
                                        if ($donnees['id'] == $_SESSION['id_adresse']) {
                                            echo '<div class="adressePrincipale divAdresse">';
                                        } else {
                                            echo '<div class="adresseSecondaire divAdresse">';
                                        }
                                    } else {
                                        echo '<div class="divAdresse">';
                                    }
                                    echo '<a style="text-decoration:none;" href="../membreNA/mesAdresses.php?id_adresse=' . $donnees['id'] . '">';
                                ?>
                                    <p>Complément d'adresse : <label><?php echo $donnees['rue']; ?></label></p>
                                    <p>Code postal : <label><?php echo $donnees['codePostal']; ?></label></p>
                                    <p>Ville : <label><?php echo $donnees['ville']; ?></label></p>
                                    <p>Pays : <label><?php echo $donnees['pays']; ?></label></p>
                                    </a>
                                <?php
                                    echo '</div>';
                                }
                                $reponse->closeCursor(); ?>
                            </div>
                        </div>
                        <div class="divButtons">
                                <button class="buttonAction" type="submit">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    Ajouter
                                </button>
                                <button class="buttonAction" type="submit">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    Modifier
                                </button>
                                <button class="buttonAction" type="submit">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    Supprimer
                                </button>
                            <!--
                                <button class="button" type="button">
                                    <i class="fa fa-plus-circle fa-2x" style="color:orange;"></i>
                                    Ajouter une adresse
                                </button>
                                <button class="button" type="button">
                                    <i class="fa fa-pencil fa-2x" style="color:#99ff99;"></i>
                                    Modifier une adresse
                                </button>
                                <button class="button" type="button">
                                    <i class="fa fa-remove fa-2x" style="color:red;"></i>
                                    Supprimer une adresse
                                </button>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>