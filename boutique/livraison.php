<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-livraison.css">
<link rel="stylesheet" href="../public/css/style-barreCommande.css">
<link rel="stylesheet" href="../public/css/style-connexion.css">

<?php
if (isset($_GET['id_adresse']) && $_GET['id_adresse'] != NULL) {
    $_SESSION['id_adresse'] = $_GET['id_adresse'];
}
?>

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div>
                <h2>Commander :</h2>
                <div class="contentAll">
                    <div class="divLivraison">
                        <div class="barreCommande">
                            <?php include('../boutique/barreCommande.php')  ?>
                        </div>
                        <div class="livraison">
                            <h3>Lieu de livraison :</h3>
                            <?php if (!isset($_SESSION['pseudo']) or !isset($_SESSION['id']) or !isset($_SESSION['statu'])) { ?>
                                <h3>Veuillez vous inscire ou vous connectez pour acheter dans la boutique</h3>
                                <div class="boxConnexion">
                                    <h2>Connexion : </h2>
                                    <form method="POST" action="livraison.php">
                                        <div class="inputBox" class="alignementLogo" class="divConnexion">
                                            <i class="fa fa-user-circle fa-2x" style="color:white;"></i>
                                            <label>Username</label>
                                            <input id="pseudo" type="text" name="pseudo" require="">
                                        </div>
                                        <div class="inputBox" class="alignementLogo" class="divConnexion">
                                            <i class="fa fa-lock fa-2x" style="color:white;"></i>
                                            <label>Password</label>
                                            <input type="password" name="mdp" require="" id="mdp">
                                        </div>
                                        <div>
                                            <label class="containerInput">
                                                <input type="checkbox">
                                                <span class="check">Connexion automatique</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <input type="submit" value="Submit">
                                    </form>
                                    <div class="alert alert-danger">
                                        <?php
                                        if (isset($_COOKIE['pseudo']) && isset($_COOKIE['mdp']) && isset($_COOKIE['statu'])) {
                                            $req = $bdd->prepare('select pass from membre where pseudo=?');
                                            $req->execute(array($_COOKIE['pseudo']));
                                            $donne = $req->fetch();
                                            if ($_COOKIE['mdp'] == $donne['pass']) {
                                                $req = $bdd->prepare('select id,statu from membre where pseudo=?');
                                                $req->execute(array($_COOKIE['pseudo']));
                                                $donne = $req->fetch();
                                                $_SESSION['id'] = $donne['id'];
                                                $_SESSION['pseudo'] = $_COOKIE['pseudo'];
                                                $_SESSION['statu'] = $donne['statu'];
                                                header('location: ../boutique/livraison.php');
                                            }
                                        }

                                        if (isset($_POST['pseudo']) && isset($_POST['mdp']) && $_POST['pseudo'] != NULL and $_POST['mdp'] != NULL) {
                                            $req = $bdd->prepare('select count(*) as nbr from membre where pseudo=?');
                                            $req->execute(array($_POST['pseudo']));
                                            $donne = $req->fetch(PDO::FETCH_ASSOC);
                                            if ($donne['nbr'] != 0) {
                                                $req = $bdd->prepare('select pass from membre where pseudo=?');
                                                $req->execute(array($_POST['pseudo']));
                                                $donne = $req->fetch();
                                                $verify = password_verify($_POST['mdp'], $donne['pass']);
                                                if ($verify == true) {
                                                    $req = $bdd->prepare('select id,statu from membre where pseudo=?');
                                                    $req->execute(array($_POST['pseudo']));
                                                    $donne = $req->fetch();
                                                    $_SESSION['id'] = $donne['id'];
                                                    $_SESSION['pseudo'] = $_POST['pseudo'];
                                                    $_SESSION['statu'] = $donne['statu'];
                                                    echo 'Connectée';
                                                    if ($_POST['case'] == 'on') {
                                                        setcookie('pseudo', $_POST['pseudo'], time() + 3600, null, null, false, true);
                                                        $req = $bdd->prepare('select pass,statu from membre where pseudo=?');
                                                        $req->execute(array($_POST['pseudo']));
                                                        $donne = $req->fetch();
                                                        setcookie('mdp', $donne['pass'], time() + 3600, null, null, false, true);
                                                        setcookie('statu', $donne['statu'], time() + 3600, null, null, false, true);
                                                        header('location: ../boutique/livraison.php');
                                                    } else {
                                                        header('location: ../boutique/livraison.php');
                                                    }
                                                } else {
                                                    echo '<strong>Information : </strong> Mauvais identifiant ou mot de passe';
                                                }
                                            } else {
                                                echo '<strong>Information : </strong> Mauvais identifiant ou mot de passe';
                                            }
                                        } else {
                                            echo '<strong>Information : </strong> Un ou plusieurs champs sont vide';
                                        } ?>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="mesAdresse">
                                    <h5>Mes adresse:</h5>
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
                                        echo '<a style="text-decoration:none;" href="../boutique/livraison.php?id_adresse=' . $donnees['id'] . '">';
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
                                <!--
                                <div class="divButton">
                                    <button class="button" type="button">
                                        <i class="fa fa-plus-circle fa-2x" style="color:orange;"></i>
                                        Ajouter une adresse
                                    </button>
                                    <button class="button" type="button">
                                        <i class="fa fa-pencil fa-2x" style="color:#99ff99;"></i>
                                        Modifier une adresse
                                    </button>
                                </div>
                                -->
                        </div>
                    </div>
                    <div>
                        <!--
                            <div>
                                <h3>Détail de la livraison :</h3>
                                <div>
                                    <p>Livraison dans les 5 jours ouvrables pour un montant de 5,99€</p>
                                </div>
                            </div>
                                -->
                        <div class="centrebtn">
                            <?php if (isset($_SESSION['id_adresse'])) {
                                    echo '<a href="../boutique/paiement.php">Valider</a>';
                                } else {
                                    echo 'Veuillez sélectionner un endroit de livraison';
                                }
                            ?>
                        </div>
                    </div>
                <?php
                            }
                ?>
                </div>
            </div>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>