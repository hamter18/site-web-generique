<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-monCompte.css">

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
                    <div class="divInfoMembres">
                        <h3>Mes informations : </h3>
                        <div class="infoMembre">
                            <div class="info">
                                <?php
                                $req = $bdd->prepare('SELECT * FROM membre WHERE pseudo=?');
                                $req->execute(array($_SESSION['pseudo']));
                                $data = $req->fetch();
                                $date = date("d/m/Y");
                                $date_inscription = date_create($data['date_inscription']);
                                $date_inscription = date_format($date_inscription, 'd/m/Y');
                                ?>
                                <form method="POST">
                                    <h4>Mes données :</h4>
                                    <?php if (isset($_POST['modif']) && $_POST['modif'] == "true") {
                                    ?>
                                        <input id="modif" name="modif" type="hidden" value="false">
                                        <p>Nom : <label><input id="nom" name="nom" type="text" value="<?php echo $data['nom']; ?>"></label></p>
                                        <p>Prénom : <label><input id="prenom" name="prenom" type="text" value="<?php echo $data['prenom']; ?>"></label></p>
                                        <p>Pseudo : <label><input id="pseudo" name="pseudo" type="text" value="<?php echo $data['pseudo']; ?>"></label></p>
                                        <p>E-mail : <label><input id="email" name="email" type="email" value="<?php echo $data['email']; ?>"></label></p>
                                        <p>Numéro de téléphone : <label><input id="telephone" name="telephone" type="tel" value="<?php echo $data['telephone']; ?>"></label></p>
                                    <?php
                                    }
                                    if (!isset($_POST['modif']) or $_POST['modif'] == "false") {
                                    ?>
                                        <input id="modif" name="modif" type="hidden" value="true">
                                        <p>Nom : <label><?php echo $data['nom']; ?></label></p>
                                        <p>Prénom : <label><?php echo $data['prenom']; ?></label></p>
                                        <p>Pseudo : <label><?php echo $data['pseudo']; ?></label></p>
                                        <p>E-mail : <label><?php echo $data['email']; ?></label></p>
                                        <p>Numéro de téléphone : <label><?php echo $data['telephone']; ?></label></p>
                                    <?php
                                    } ?>
                                    <h5>Vous voulez modifier vos données ?</h5>
                                    <button class="buttonAction" type="submit" value="Cliquez ici !">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        Cliquez ici !
                                    </button>
                                </form>
                                    <?php
                                    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['telephone']) && $_POST['nom'] != NULL && $_POST['prenom'] != NULL && $_POST['pseudo'] != NULL && $_POST['email'] != NULL && $_POST['telephone'] != 0) {
                                        $req = $bdd->prepare('SELECT count(*) AS nbr FROM membre WHERE pseudo=?');
                                        $req->execute(array($_POST['pseudo']));
                                        $donne = $req->fetch(PDO::FETCH_ASSOC);
                                        $mofifInformation = null;
                                        if ($donne['nbr'] != 0) {
                                            if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
                                                if (preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $_POST['telephone'])) {
                                                    $req = $bdd->prepare('UPDATE membre SET nom=:nom , prenom=:prenom, email=:email, telephone=:telephone where pseudo=:Spseudo');
                                                    $req->execute(array(
                                                        'nom' => $_POST['nom'],
                                                        'prenom' => $_POST['prenom'],
                                                        'email' => $_POST['email'],
                                                        'telephone' => $_POST['telephone'],
                                                        'Spseudo' => $_SESSION['pseudo'],
                                                    ));
                                                    $mofifInformation = true;
                                                } else {
                                                    $mofifInformation = false;
                                                    echo '<div class="alert alert-danger"><strong>Information : </strong> Le numero de téléphone est invalide non valide  ou champ vide</div>';
                                                }
                                            } else {
                                                $mofifInformation = false;
                                                echo '<div class="alert alert-danger"><strong>Information : </strong> Adresse email non valide ou champ vide</div>';
                                            }
                                        } else {
                                            if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
                                                if (preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $_POST['telephone'])) {
                                                    $req = $bdd->prepare('UPDATE membre SET nom=:nom , prenom=:prenom, pseudo=:pseudo, email=:email, telephone=:telephone where pseudo=:Spseudo');
                                                    $req->execute(array(
                                                        'nom' => $_POST['nom'],
                                                        'prenom' => $_POST['prenom'],
                                                        'pseudo' => $_POST['pseudo'],
                                                        'email' => $_POST['email'],
                                                        'telephone' => $_POST['telephone'],
                                                        'Spseudo' => $_SESSION['pseudo'],
                                                    ));
                                                    rename("../public/image/membre/" . $data['pseudo'] . ".jpg", "../public/image/membre/" . $_POST['pseudo'] . ".jpg");
                                                    $req = $bdd->prepare('UPDATE chatuser SET pseudo=:pseudo WHERE pseudo=:Spseudo');
                                                    $req->execute(array(
                                                        'pseudo' => $_POST['pseudo'],
                                                        'Spseudo' => $_SESSION['pseudo'],
                                                    ));
                                                    $req = $bdd->prepare('UPDATE commentaires SET auteur=:pseudo WHERE pseudo=:Spseudo');
                                                    $req->execute(array(
                                                        'pseudo' => $_POST['pseudo'],
                                                        'Spseudo' => $_SESSION['pseudo'],
                                                    ));
                                                    $req = $bdd->prepare('UPDATE avisProduit SET auteur=:pseudo WHERE pseudo=:Spseudo');
                                                    $req->execute(array(
                                                        'pseudo' => $_POST['pseudo'],
                                                        'Spseudo' => $_SESSION['pseudo'],
                                                    ));
                                                    $_SESSION['pseudo'] = $_POST['pseudo'];
                                                     $mofifInformation = true;
                                                } else {
                                                    $mofifInformation = false;
                                                    echo '<div class="alert alert-danger"><strong>Information : </strong> Le numero de téléphone est invalide non valide ou champ vide</div>';
                                                }
                                            } else {
                                                $mofifInformation = false;
                                                echo '<div class="alert alert-danger"><strong>Information : </strong> Adresse email non valide ou champ vide</div>';
                                            }
                                        }
                                    }
                                    ?>
                            </div>

                            <div class="info">

                                <form method="post" enctype="multipart/form-data">
                                    <h4>Mon image de profil :</h4>
                                    <div class="image">
                                        <img src="../public/image/membre/<?php echo $data['pseudo']; ?>.jpg" alt="">
                                    </div>
                                    <h5>Modification de l'image de profil :</h5>

                                    <input class="file" type="file" name="photo" accept="image/*">
                                    <button class="buttonAction" type="submit">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        Envoyer
                                    </button>
                                </form>
                                <?php
                                if (isset($_FILES['photo']['tmp_name'])) {
                                    $retour = copy($_FILES['photo']['tmp_name'], '../public/image/membre/' . $data['pseudo'] . '.jpg');
                                    if ($retour) {
                                        echo '<div class="alert alert-success"><strong>Information : La photo a bien été envoyée.</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                            if($mofifInformation==true){
                                echo '<div class="alert alert-success"><strong>Information : </strong> Informations modifiés</div>
                                ';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>