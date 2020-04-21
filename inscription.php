<?php include('head.php') ?>
<link rel="stylesheet" href="public/css/style-inscription.css">

<body>
    <?php include('header-image.php') ?>
    <main>
        <?php require_once "functions.php"; ?>
        <div class="container">
            <div class="boxInscription">
                <h2>Inscription :</h2>
                <form method="POST">
                    <div class="formInscription">
                        <div class="divInscription">
                            <div class="inputBox" class="alignementLogo" class="divInscriptionChamps">
                                <div>
                                    <i class="fa fa-user fa-2x" style="color:white;"></i>
                                    <label>Nom</label>
                                </div>
                                <input type="nom" name="nom" id="nom" require="">
                            </div>
                            <div class="inputBox" class="alignementLogo" class="divInscriptionChamps">
                                <div>
                                    <i class="fa fa-user fa-2x" style="color:white;"></i>
                                    <label>Prénom</label>
                                </div>
                                <input type="text" name="prenom" id="prenom" require="">
                            </div>
                        </div>
                        <div class="divInscription">
                            <div class="inputBox" class="alignementLogo" class="divInscriptionChamps">
                                <div>
                                    <i class="fa fa-user-circle fa-2x" style="color:white;"></i>
                                    <label>Pseudo</label>
                                </div>
                                <input type="text" name="pseudo" id="pseudo" require="">
                            </div>
                            <div class="inputBox" class="alignementLogo" class="divInscriptionChamps">
                                <div>
                                    <i class="fa fa-at fa-2x" style="color:white;"></i>
                                    <label>E-mail</label>
                                </div>
                                <input type="email" name="email" id="email" require="">
                            </div>
                        </div>
                        <div class="divInscription">
                            <div class="inputBox" class="alignementLogo" class="divInscriptionChamps">
                                <div>
                                    <i class="fa fa-lock fa-2x" style="color:white;"></i>
                                    <label>Mot de passe :</label>
                                </div>
                                <input type="password" name="password" id="password" require="">
                            </div>
                            <div class="inputBox" class="alignementLogo" class="divInscriptionChamps">
                                <div>
                                    <i class="fa fa-lock fa-2x" style="color:white;"></i>
                                    <label>Confirmer votre mot de passe :</label>
                                </div>
                                <input type="password" name="confirmPassword" id="confirmPassword" require="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <?php
                        if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['confirmPassword']) && isset($_POST['email']) && isset($_POST['nom']) && isset($_POST['prenom']) && $_POST['pseudo'] != NULL && $_POST['password'] != NULL && $_POST['confirmPassword'] != NULL && $_POST['email'] != NULL && $_POST['nom'] != NULL && $_POST['prenom'] != NULL) {
                            if (!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['pseudo'])) {
                                echo '<div class="alert alert-danger"><strong>Information : </strong> Vous pseudo n\'est pas valide (alphanumérique) </div>';
                            } else {
                                $req = $bdd->prepare('SELECT count(*) AS nbr FROM membre WHERE pseudo=?');
                                $req->execute(array($_POST['pseudo']));
                                $donne = $req->fetch(PDO::FETCH_ASSOC);
                                if ($donne['nbr'] != 0) {
                                    echo '<div class="alert alert-danger"><strong>Information : </strong> Pseudo dejà utilisé</div>';
                                } else {
                                    if ($_POST['confirmPassword'] != $_POST['password']) {
                                        echo '<strong>Information : </strong> Mot de passe différent par rapport à la confimration';
                                    } else {
                                        if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
                                            $pass_hach = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                            $req = $bdd->prepare('INSERT INTO membre (pseudo,email,pass,prenom,nom,date_inscription,confirmation_token) VALUES (:pseudo,:email,:pass,:prenom,:nom,NOW(),:confirmation_token)');
                                            $token = str_random(60);
                                            $req->execute(array(
                                                'pseudo' => $_POST['pseudo'],
                                                'email' => $_POST['email'],
                                                'pass' => $pass_hach,
                                                'prenom' => $_POST['prenom'],
                                                'nom' => $_POST['nom'],
                                                'confirmation_token' => $token,
                                            ));
                                            $user_id = $bdd->lastInsertId();
                                            $message .= '<html> <body style="background-color: white">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" height="300px">
                <tbody>
                    <tr>
                        <h1>
                            <center> Bonjour ! Merci de vous êtes inscrit à Handball Clermont-Ferrand ! </center>
                        </h1>
                        <h2>
                            <center>Cliquez sur le lien ci dessous pour valider votre adresse mail !</center>
                        </h2>
                        <center>
                            <a href="http://g5.afia.fr/confirm.php?id=' . urlencode($user_id) . '&token=' . urlencode($token) . '" target=blank_>
                            http://g5.afia.fr/confirm.php?id=' . urlencode($user_id) . '&token=' . urlencode($token) . '
                            </a>
                        </center>
                    </tr>
                </tbody>
                </table>
                </body>
                </html>
                ';
                                            mail($_POST['email'], 'Confirmation de votre compte', $message);

                                            copy('/home/cfaifrnfzy/iutg5/public/image/web/placeholder.jpg', '/home/cfaifrnfzy/iutg5/public/image/membre/' . $_POST['pseudo'] . '.jpg');

                                            echo '<div class="alert alert-success"><strong>Information : </strong> Vous venez de vous inscrire !</br><p>Un email de confirmation vous a été envoyé pour valider votre compte</p></br><p>Connecter vous dès maintenant : <a href="connexion.php">Connectez-vous !</a></p></div>';
                                        } else {
                                            echo '<div class="alert alert-danger"><strong>Information : </strong> Adresse email non valide</div>';
                                        }
                                    }
                                }
                            }
                        } else {
                            echo '<div class="alert alert-danger"><strong>Information : </strong> Un ou plusieurs champs sont vide</div>';
                        }
                        ?>
                    </div>
                    <input type="submit" name="" value="S'inscrire !">
                </form>

            </div>
        </div>
    </main>
    <?php include('footer.php') ?>
</body>

</html>