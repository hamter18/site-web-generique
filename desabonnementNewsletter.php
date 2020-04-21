<?php include('head.php') ?>
<link rel="stylesheet" href="public/css/style-connexion.css">

<body>
    <?php include('header-image.php') ?>
    <main>
        <div class="container">
            <div class="boxConnexion">
                <h2>Désabonnement Newsletter : </h2>
                <form method="POST" action="../desabonnementNewsletter.php">
                    <div class="inputBox" class="alignementLogo" class="divConnexion">
                        <i class="fa fa-user-circle fa-2x" style="color:white;"></i>
                        <label>Adresse Mail</label>
                        <input id="email" type="email" name="email" require="">
                    </div>
                    <input type="submit" value="Submit">
                </form>
                <div class="alert alert-danger">
                    <?php
                    if (isset($_POST['email']) && $_POST['email'] != NULL) {
                        $req = $bdd->prepare('select count(*) as nbr from abonnéNewsletter where mail=?');
                        $req->execute(array($_POST['email']));
                        $donne = $req->fetch(PDO::FETCH_ASSOC);
                        if ($donne['nbr'] != 0) {
                            $req = $bdd->prepare('delete from abonnéNewsletter where mail=?');
                            $req->execute(array($_POST['email']));
                            $donnee = $req->fetch();
                        } else {
                            echo '<strong>Information : </strong> Mauvaise adresse mail';
                        }
                    } else {
                        echo '<strong>Information : </strong> Champ Vide';
                    } ?>
                </div>
            </div>
        </div>
    </main>
    <?php include('footer.php') ?>
</body>
</html>