<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-commentaires.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div class="containerAll">
                <h2>Articles :</h2>
                <div class="divCommentaire">
                    <?php
                    $req = $bdd->prepare('select id,contenu,titre, DAY(date_creation) AS jour, MONTH(date_creation) AS mois, YEAR(date_creation) AS annee, HOUR(date_creation) AS heure, MINUTE(date_creation) AS minute, SECOND(date_creation) AS seconde from billets where id=?');
                    $req->execute(array($_GET['id_billet']));
                    $donnees = $req->fetch();
                    $image = str_replace(' ', '', '../public/image/blog/' . $donnees['titre'] . '.jpg');
                    echo '
                    <div class="containerTitre" style="background-image: url(' . $image . '); height: 400px; width: 100%; border-radius: 25px; text-align: center;">
                        <div class="textTitre">
                            <h2 class="titre">' . $donnees['titre'] . '</h2>
                        </div>
                    </div> ';
                    ?>
                    <div class="bordure">
                        <div class="infoArticle">
                            <?php
                            echo '<p class="dateDeParution">Paru le ' . $donnees['jour'] . '/' . $donnees['mois'] . '/' . $donnees['annee'] . ' à ' . $donnees['heure'] . 'h' . $donnees['minute'] . '</p>';
                            echo '<p class="contenu">' . $donnees['contenu'] . '</p>';
                            $req->closeCursor();
                            ?>
                        </div>
                    </div>
                </div>
                <div class="ajouterCommentaire">
                    <h3> Ajouter un commentaire :</h3>
                    <h4> Commentaires :</h4>
                    <?php
                    if (isset($_SESSION['pseudo']) and $_SESSION['pseudo'] != NULL) {
                    ?>
                        <script type="text/javascript" src="../public/js/event.js"></script>
                        <div class="btnAjout" href="javascript:void(0);" onclick="clickCommentaire()">
                            <span class="nav-icon"><i class="fa fa-plus-circle fa-3x" style="color:blue;"></i></span>
                        </div>
                        <div>
                        <?php
                    } else {
                        echo '<p class="text-muted"> Veuillez vous inscire ou vous connectez pour mettre un commentaire</p>';
                    }
                        ?>
                        </div>
                </div>
                <div id="ajoutDiv">
                    <?php echo '<form method="POST" action="../blog/commentaires.php?id_billet=' . $_GET['id_billet'] . '" class="class="form-signin">'; ?>
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

                    <textarea name="commentaire" id="commentaire" rows="4" cols="10" style="resize:none;" wrap="hard" class="form-control" placeholder="Tapez votre commentaire (max 500 caractére)" required="" maxlength="500"></textarea>
                    <div class="btnPublier">
                        <button type="submit">Publier</button>
                    </div>
                    </form>
                    <div>
                        <?php
                        if (isset($_POST['commentaire']) && $_POST['commentaire'] != NULL) {
                            $_POST['commentaire'] = preg_replace('#\[b\](.+)\[/b\]#isU', '<strong>$1</strong>', $_POST['commentaire']);
                            $_POST['commentaire'] = preg_replace('#\[i\](.+)\[/i\]#isU', '<em>$1</em>', $_POST['commentaire']);
                            $_POST['commentaire'] = preg_replace('#\[color=(red|green|blue|yellow|purple|olive)\](.+)\[/color\]#isU', '<span style="color:$1">$2</span>', $_POST['commentaire']);
                            $_POST['commentaire'] = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $_POST['commentaire']);
                            $req = $bdd->prepare('insert into commentaires (id_billet,auteur,commentaire,date_commentaire) values (:id_billet,:auteur,:commentaire,now())');
                            $req->execute(array(
                                'id_billet' => $_GET['id_billet'],
                                'auteur' => $_SESSION['pseudo'],
                                'commentaire' => $_POST['commentaire']
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
                if($ajoutCommentaire==true){
                    echo '<div class="alert alert-success"><strong>Information : </strong> Votre commentaire a été ajouté</div>';
                }
                ?>
                <div class="listCommentaire">
                    <?php
                    echo '<div>';
                    $req = $bdd->prepare('select id,commentaire,auteur, DAY(date_commentaire) AS jour, MONTH(date_commentaire) AS mois, YEAR(date_commentaire) AS annee, HOUR(date_commentaire) AS heure, MINUTE(date_commentaire) AS minute, SECOND(date_commentaire) AS seconde from commentaires where id_billet=?');
                    $req->execute(array($_GET['id_billet']));
                    while ($donnees = $req->fetch()) { ?>
                        <div class="commentaireArticle">
                            <div class="infoCommentaire">
                                <div class="info">
                                    <label>Date :</label>
                                    <p> <?php echo ' ' . $donnees['jour'] . '/' . $donnees['mois'] . '/' . $donnees['annee'] . ''; ?></p>
                                </div>
                                <div class="info">
                                    <i class="fa fa-hourglass-2" style="color:black;"></i>
                                    <label><?php
                                            $date = date("G:i:s");
                                            $date_commentaire = date_create($donne['date_commentaire']);
                                            $date_commentaire = date_format($date_commentaire, 'G:i:s');
                                            echo ($date - $date_commentaire);
                                            ?> </label>
                                </div>
                                <div class="info">
                                    <i class="fa fa-user-circle" style="color:black;"></i>
                                    <label>Auteur : </label>
                                    <p><?php echo $donnees['auteur']; ?></p>
                                </div>
                                <?php
                                if (isset($_SESSION['pseudo']) and $_SESSION['pseudo'] == $donnees['auteur']) {
                                ?>
                                    <div class="info">
                                        <i class="fa fa-remove" style="color:red;"></i>
                                        <?php
                                        echo '<form method="POST" action="../blog/deletecommentaires.php?id=' . $donnees['id'] . '&amp;id_billet=' . $_GET['id_billet'] . '">';
                                        echo '<button type="submit" class="btnSupp"> Supprimer</button> ';
                                        echo '</form>'; ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div>
                                <p class="textCommentaire"> <?php echo $donnees['commentaire']; ?></p>
                            </div>
                        </div>

                    <?php }
                    $req->closeCursor(); ?>
                </div>

            </div>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>