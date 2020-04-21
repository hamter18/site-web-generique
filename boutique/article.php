<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-article.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div class="boxArticle">
                <h2>Article : </h2>
                <div class="containerArticle">
                    <div class="divFiltre">
                        <div class="filtre">
                            <?php
                            $reponse = $bdd->query('SELECT DISTINCT categorie FROM produit');
                            while ($donnees = $reponse->fetch()) {
                                echo '<a href="../boutique/boutique.php?categorie=' . $donnees['categorie'] . '"><button class="btn success"><i class="fa fa-music"></i>' . $donnees['categorie'] . '</button></a></a>';
                            }
                            $reponse->closeCursor(); ?>
                            <ul class="rajouterFiltre">
                                <script type="text/javascript" src="../public/js/boutique.js"></script>
                                <li href="javascript:void(0);" onclick="myFunction()">
                                    <span class="nav-icon"><i class="fa fa-bars"></i></span>
                                    Filtres
                                </li>
                            </ul>
                            <div class="filtreAvance">
                                <form method="GET" action="../boutique/boutique.php">
                                    <?php
                                    if (isset($_GET['categorie']) and !empty($_GET['categorie'])) {
                                    ?> <input type="hidden" id="categorie" name="categorie" value="<?php echo $_GET['categorie']; ?>">
                                    <?php
                                    } ?>
                                    <div id="ajoutDiv">
                                        <label>Gamme de produit : </label>
                                        <div class="filtrePrix">
                                            <?php
                                            $reponse = $bdd->query('SELECT min(prix) as min FROM produit');
                                            $donnees = $reponse->fetch();
                                            echo '<input type="number" id="prixMinimun" name="prixMinimun" min="0" max="1000" step="0.01" value="' . $donnees['min'] . '">';
                                            $reponse = $bdd->query('SELECT max(prix) as max FROM produit');
                                            $donnees = $reponse->fetch();
                                            echo '<input type="number" id="prixMaximun" name="prixMaximun" min="0" max="1000" step="0.01" value="' . $donnees['max'] . '">';
                                            ?>
                                        </div>
                                        <label>Artiste : </label>
                                        <div class="filtreSearch">
                                            <input type="text" placeholder="Search.." name="recherche">
                                            <input type="submit" value="Valider"><i class="fa fa-search"></i></input>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="divArticle">
                            <?php $req = $bdd->prepare('select quantite,nom,description,prix,note,categorie from produit where reference=?');
                            $req->execute(array($_GET['reference_produit']));
                            $donnees = $req->fetch(); ?>
                            <div class="product">
                                <div class="product-image">
                                    <?php echo '<img src="../public/image/boutique/' . $donnees['nom'] . '.jpg" alt="Image : ' . $donnees['nom'] . '">'; ?> </div>
                                <div class="stock">
                                    <?php if ($donnees['quantite'] != 0) {
                                        echo '<label class="product-disponibilite">En stock : ' . $donnees['quantite'] . '</label>';
                                    } else {
                                        echo '<label class="product-disponibilite">Indisponible</label>';
                                    }
                                    ?>
                                </div>
                                <div class="product-notation">
                                    <?php switch ($donnees['note']) {
                                        case 0:
                                    ?>
                                            <span class="fa fa-star fa-2x"></span>
                                            <span class="fa fa-star fa-2x"></span>
                                            <span class="fa fa-star fa-2x"></span>
                                            <span class="fa fa-star fa-2x"></span>
                                            <span class="fa fa-star fa-2x"></span>
                                        <?php
                                            break;
                                        case 1:
                                        ?>
                                            <span class="fa fa-star fa-2x checked"></span>
                                            <span class="fa fa-star fa-2x"></span>
                                            <span class="fa fa-star fa-2x"></span>
                                            <span class="fa fa-star fa-2x"></span>
                                            <span class="fa fa-star fa-2x"></span>
                                        <?php
                                            break;
                                        case 2:
                                        ?>
                                            <span class="fa fa-star fa-2x checked"></span>
                                            <span class="fa fa-star fa-2x checked"></span>
                                            <span class="fa fa-star fa-2x"></span>
                                            <span class="fa fa-star fa-2x"></span>
                                            <span class="fa fa-star fa-2x"></span>
                                        <?php
                                            break;
                                        case 3:
                                        ?>
                                            <span class="fa fa-star fa-2x checked"></span>
                                            <span class="fa fa-star fa-2x checked"></span>
                                            <span class="fa fa-star fa-2x checked"></span>
                                            <span class="fa fa-star fa-2x"></span>
                                            <span class="fa fa-star fa-2x"></span>
                                        <?php
                                            break;
                                        case 4:
                                        ?>
                                            <span class="fa fa-star fa-2x checked"></span>
                                            <span class="fa fa-star fa-2x checked"></span>
                                            <span class="fa fa-star fa-2x checked"></span>
                                            <span class="fa fa-star fa-2x checked"></span>
                                            <span class="fa fa-star fa-2x"></span>
                                        <?php
                                            break;
                                        case 5:
                                        ?>
                                            <span class="fa fa-star fa-2x checked"></span>
                                            <span class="fa fa-star fa-2x checked"></span>
                                            <span class="fa fa-star fa-2x checked"></span>
                                            <span class="fa fa-star fa-2x checked"></span>
                                            <span class="fa fa-star fa-2x checked"></span>
                                    <?php
                                            break;
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3><?php echo $donnees['nom'] ?> </h3>
                                <p><?php echo $donnees['description'] ?></p>
                                <div class="prix">
                                    <p>Prix : <label><?php echo '' . $donnees['prix'] . '€'; ?></label></p>
                                </div>
                                <?php if ($donnees['categorie'] == "T-shirt") { ?>
                                    <div class="taille">
                                        <label>Taille : </label>
                                        <input type="submit" name="" value="XS">
                                        <input type="submit" name="" value="S">
                                        <input type="submit" name="" value="M">
                                        <input type="submit" name="" value="L">
                                        <input type="submit" name="" value="XL">
                                        <input type="submit" name="" value="XXL">
                                    </div>
                                <?php
                                }
                                ?>
                                <?php if ($donnees['quantite'] != 0) {
                                ?><form method="GET">
                                        <div class="nbArticle">
                                            <label>Nombre d'article : </label>
                                            <input type="number" id="nbArticle" name="nbArticle" min="1" max="10" value="1">
                                            <input type="hidden" id="reference_produit" name="reference_produit" value="<?php echo $_GET['reference_produit']; ?>">
                                        </div>
                                        <input type="submit" value="Ajouter au panier"><i class="fa fa-search"></i></input>
                                    </form>
                                <?php } ?>

                                <div class="alert alert-danger">
                                    <?php
                                    if (isset($_GET['reference_produit']) and isset($_GET['nbArticle']) and $_GET['reference_produit'] != 0 and $_GET['nbArticle'] != 0) {
                                        if (!isset($_SESSION['panier'])) {
                                            $_SESSION['panier'] = array();
                                            $_SESSION['panier']['id_produit'] = array();
                                            $_SESSION['panier']['quantite'] = array();
                                        }
                                        $positionProduit = array_search($_GET['reference_produit'],  $_SESSION['panier']['id_produit']);
                                        if ($positionProduit !== false) {
                                            $_SESSION['panier']['quantite'][$positionProduit] += $_GET['nbArticle'];
                                        } else {
                                            array_push($_SESSION['panier']['id_produit'], $_GET['reference_produit']);
                                            array_push($_SESSION['panier']['quantite'], $_GET['nbArticle']);
                                        }
                                        echo 'L\'article a été ajouté au panier';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="divAvisClient">
                            <label class="product-avis">Avis : </label>
                            <div class="divAvis">
                                <?php
                                if (isset($_SESSION['pseudo']) and $_SESSION['pseudo'] != NULL) {
                                ?>
                                    <div>
                                    <?php
                                } else {
                                    echo '<p class="text-muted"> Veuillez vous inscire ou vous connectez pour mettre un commentaire</p>';
                                }
                                    ?>
                                    </div>
                            </div>
                            <!--<div id="ajoutDiv">-->
                                <?php echo '<form method="POST" action="../boutique/article.php?reference_produit=' . $_GET['reference_produit'] . '" class="class="form-signin">'; ?>
                                <div class="ajoutCommentaire">
                                    <div class="info">
                                        <label>Date : </label>
                                        <p> <?php $auj = date("d/m/y");
                                            echo $auj; ?> </p>
                                    </div>
                                    <div class="info">
                                        <i class="fa fa-user-circle" style="color:black;"></i>
                                        <label>Auteur : </label>
                                        <p><?php echo $_SESSION['pseudo']; ?></p>
                                    </div>
                                </div>
                                <div class="optionCommentaire">
                                    <button type="button" class="btn btn-primary" disabled="disabled"><strong>[b] Texte en gras [/b]</strong></button>
                                    <button type="button" class="btn btn-secondary" disabled="disabled"><em>[i] Texte en italique [/i]</em></button>
                                    <button type="button" class="btn btn-warning" disabled="disabled"><span style="color:red">[color=red] Texte en rouge [/color]</span></button>
                                    <button type="button" class="btn btn-link" disabled="disabled"><a href="">Lien : http://...</a></button>
                                </div>

                                <textarea name="avis" id="avis" rows="4" cols="10" style="resize:none;" wrap="hard" class="form-control" placeholder="Tapez votre avis (max 500 caractére)" required="" maxlength="500"></textarea>
                                <div class="btnPublier">
                                    <button type="submit">Publier</button>
                                </div>
                                </form>
                                <div>
                                    <?php
                                    if (isset($_POST['avis']) && $_POST['avis'] != NULL) {
                                        $_POST['avis'] = preg_replace('#\[b\](.+)\[/b\]#isU', '<strong>$1</strong>', $_POST['avis']);
                                        $_POST['avis'] = preg_replace('#\[i\](.+)\[/i\]#isU', '<em>$1</em>', $_POST['avis']);
                                        $_POST['avis'] = preg_replace('#\[color=(red|green|blue|yellow|purple|olive)\](.+)\[/color\]#isU', '<span style="color:$1">$2</span>', $_POST['avis']);
                                        $_POST['avis'] = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $_POST['avis']);
                                        $req = $bdd->prepare('INSERT INTO avisProduit (id_produit,id_membre,avis,date_avis) values (:id_produit,:id_membre,:avis,now())');
                                        $req->execute(array(
                                            'id_produit' => $_GET['reference_produit'],
                                            'id_membre' => $_SESSION['id'],
                                            'avis' => $_POST['avis']
                                        ));
                                        $ajoutCommentaire = true;
                                        $req->closeCursor();
                                    } else {
                                        $ajoutCommentaire = false;
                                        echo '<div class="alert alert-danger"><strong>Information : </strong> Un ou plusieurs champs sont vide</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            if ($ajoutCommentaire == true) {
                                echo '<div class="alert alert-success"><strong>Information : </strong> Votre avis a été ajouté</div>';
                            }
                            ?>
                            <div class="listCommentaire">
                                <?php
                                echo '<div>';
                                $req = $bdd->prepare('SELECT * FROM avisProduit WHERE id_produit=?');
                                $req->execute(array($_GET['reference_produit']));
                                while ($donnees = $req->fetch()) { ?>
                                    <div class="avisClient">
                                        <label>Date :</label>
                                        <p> <?php echo $donnees['date_avis']; ?></p>
                                        <i class="fa fa-user-circle" style="color:black;"></i>
                                        <label class="surnameClient">Auteur : </label>
                                        <p>
                                            <?php 
                                            $reponse = $bdd->prepare('SELECT * FROM membre WHERE id=?');
                                            $reponse->execute(array($donnees['id_membre']));
                                            $data = $reponse->fetch();
                                            echo $data['pseudo'];
                                            ?>
                                        </p>
                                        <?php /*
                                        if (isset($_SESSION['id']) and $_SESSION['id'] == $donnees['id_membre']) {
                                        ?>
                                            <i class="fa fa-remove" style="color:red;"></i>
                                            <?php
                                            echo '<form method="POST" action="boutique/deleteavis.php?id=' . $donnees['id'] . '&amp;id_produit=' . $_GET['reference_produit'] . '">';
                                            echo '<button type="submit" class="btnSupp"> Supprimer</button> ';
                                            echo '</form>'; ?>
                                        <?php } */ ?>
                                        <p class="commentaire"> <?php echo $donnees['avis']; ?></p>
                                    </div>
                                <?php
                                }
                                $req->closeCursor();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>