<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-panier.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <h2>Panier :</h2>
            <div class="contentAll">
                <div class="divPanier">
                    <h3>Votre panier :</h3>
                    <table class="myTablePanier">
                        <tr class="header">
                            <th></th>
                            <th>Nom</th">
                            <th>Quantite</th">
                            <th>Prix/U</th">
                        </tr>
                        <?php
                        $nbArticles = count($_SESSION['panier']['id_produit']);
                        if ($nbArticles <= 0) {
                            echo "<tr><td>Votre panier est vide </td></tr>";
                        } else {
                            for ($i = 0; $i < $nbArticles; $i++) {
                                echo '<tr>';
                                $req = $bdd->prepare('SELECT * FROM produit WHERE reference=?');
                                $req->execute(array($_SESSION['panier']['id_produit'][$i]));
                                $donnees = $req->fetch();
                                echo '<td><img src="../public/image/boutique/' . $donnees['nom'] . '.jpg" alt="Image : ' . $donnees['nom'] . '" width="50px"></td>';
                                echo '<td>' . $donnees['nom'] . '</td>';
                                echo '<td>';
                                $selected = '';
                                echo '<select name="quantite" onchange=\'submit()\'>';
                                for ($y = 0; $y <= 10; $y++) {
                                    if ($y == $_SESSION['panier']['quantite'][$i]) {
                                        $selected = 'selected="selected"';
                                    }
                                    echo '<option value="' . $y . '"' . $selected . '>' . $y . '</option>';
                                    $selected = '';
                                }
                                echo '</select>';
                                echo '</td>';
                                echo '<td>' . $donnees['prix'] . '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </table>
                    <div class="codePromo">
                        <input type="text" name="promo" id="promo" placeholder="Code promo ...">
                        <input class="btn" type="submit" value="Appliquer">
                    </div>
                    <?php 
                        if(isset($_SESSION['panier']) && $_SESSION['panier'] != NULL){
                            echo '<a href="../boutique/livraison.php" class="buttonAction">Valider</a>';
                        }
                    ?>
                </div>
                <div class="divRecapPanier">
                    <h3>Sommaire de commande :</h3>
                    <table class="myTableRecap">
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
                                echo '<td>' . $_SESSION['panier']['quantite'][$i]. '</td>';
                                $prixP = $_SESSION['panier']['quantite'][$i] * $donnees['prix'];
                                echo '<td>' . $prixP . '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </table>
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
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>