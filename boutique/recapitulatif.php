<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-recapitulatif.css">
<link rel="stylesheet" href="../public/css/style-barreCommande.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <h2>Commander :</h2>
            <div class="divRecapitulatif">
                <div class="barreCommande">
                    <?php include('../boutique/barreCommande.php')  ?>
                </div>
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
                    <div>
                        <h3>Mes articles :</h3>
                        <table class="myTablePanier">
                            <?php
                            $nbArticles = count($_SESSION['panier']['id_produit']);
                            if ($nbArticles <= 0) {
                            } else {
                            ?>
                                <tr class="header">
                                    <th>Nom</th">
                                    <th>Quantite</th">
                                    <th>Prix</th">
                                </tr>
                            <?php
                                for ($i = 0; $i < $nbArticles; $i++) {
                                    echo '<tr>';
                                    $req = $bdd->prepare('SELECT * FROM produit WHERE reference=?');
                                    $req->execute(array($_SESSION['panier']['id_produit'][$i]));
                                    $donnees = $req->fetch();
                                    echo '<td>' . $donnees['nom'] . '</td>';
                                    echo '<td>' . $_SESSION['panier']['quantite'][$i] . '</td>';
                                    $prixP = $_SESSION['panier']['quantite'][$i] * $donnees['prix'];
                                    echo '<td>' . $prixP . '</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </table>
                    </div>
            </div>
            <div class="livraisonTotal">
                <div class="detail">
                    <div>
                        <h3>Livraison :</h3>
                        <div class="adresseSecondaire divAdresse">
                            <?php
                            $reponse = $bdd->prepare('SELECT * from adresse where id=:id and idUtilisateur=:idUtilisateur');
                            $reponse->execute(array(
                                'idUtilisateur' => $_SESSION['id'],
                                'id' => $_SESSION['id_adresse'],
                            ));
                            while ($donnees = $reponse->fetch()) {
                            ?>
                                <p>Complément d'adresse : <label><?php echo $donnees['rue']; ?></label></p>
                                <p>Code postal : <label><?php echo $donnees['codePostal']; ?></label></p>
                                <p>Ville : <label><?php echo $donnees['ville']; ?></label></p>
                                <p>Pays : <label><?php echo $donnees['pays']; ?></label></p>
                            <?php
                            }
                            $reponse->closeCursor(); ?>
                        </div>
                    </div>
                    <div>
                        <h3>Paiement :</h3>
                        <div class="cardCB">
                            <?php if (isset($_GET['cb'])) {
                                echo '<label>Par banque (via stripe) :</label>';
                            } else {
                                echo '<label>Par paypal :</label>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="divPrix">
                    <label>Livraison total : OFFERT</label>
                    <?php
                    $nbArticles = count($_SESSION['panier']['id_produit']);
                    if ($nbArticles <= 0) {
                        echo '<h3>Total : 0€</h3>';
                    } else {
                        $prixtotal = 0;
                        for ($i = 0; $i < $nbArticles; $i++) {
                            $req = $bdd->prepare('SELECT * FROM produit WHERE reference=?');
                            $req->execute(array($_SESSION['panier']['id_produit'][$i]));
                            $donnees = $req->fetch();
                            $prixtotal = $prixtotal + ($donnees['prix'] * $_SESSION['panier']['quantite'][$i]);
                        }
                        echo '<h3>Total : ' . $prixtotal . '€</h3>';
                    }
                    ?>
                </div>
            </div>
            <div class="centrebtn">
                <a href="../index.php">Valider</a>
            </div>
        <?php } ?>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>