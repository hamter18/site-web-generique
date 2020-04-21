<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-paiement.css">
<link rel="stylesheet" href="../public/css/style-barreCommande.css">
<?php
require_once "config.php";
?>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <h2>Commander :</h2>
            <div class="divPaiement">
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
                    <div class="paiement">
                        <h3>Moyen de paiments :</h3>
                        <div class="divMoyenPaiment">
                            <h4><i class="fa fa-bars"></i>Paypal : </h4>
                            <div class=paypal>
                                <div id="bouton-paypal"></div>
                                <script>
                                    paypal.Button.render({
                                        env: 'sandbox',
                                        commit: true,
                                        style: {
                                            color: 'gold',
                                            size: 'responsive'
                                        },
                                        payment: function(data, actions) {
                                            console.log('paiement créé');
                                        },
                                        onAuthorize: function(data, actions) {},
                                        onCancel: function(data, actions) {},
                                        onError: function(err) {}
                                    }, '#bouton-paypal');
                                </script>
                            </div>
                            <h4><i class="fa fa-bars"></i>Carte bancaire : </h4>
                            <?php
                            $nbArticles = count($_SESSION['panier']['id_produit']);
                            if ($nbArticles <= 0) {
                                $prixtotal = 0;
                            } else {
                                $prixtotal = 0;
                                for ($i = 0; $i < $nbArticles; $i++) {
                                    $req = $bdd->prepare('SELECT * FROM produit WHERE reference=?');
                                    $req->execute(array($_SESSION['panier']['id_produit'][$i]));
                                    $donnees = $req->fetch();
                                    $prixtotal = $prixtotal + ($donnees['prix'] * $_SESSION['panier']['quantite'][$i]);
                                    $prixtotal = $prixtotal * 100;
                                }
                            }
                            ?>
                            <?php echo '<form action="../boutique/stripeIPN.php?id=product1&prix=' . $prixtotal . '" method="POST">';
                            echo '<script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="' . $stripeDetails['publishableKey'] . '" data-amount="' . ($prixtotal) . '" data-name="Achat" data-description="via Stripe" data-image="../public/image/web/placeholder.jpg" data-locale="auto"></script>'; ?>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>