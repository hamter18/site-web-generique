<?php include('head.php') ?>
<link rel="stylesheet" href="public/css/style-connexion.css">

<body>
    <?php include('header-image.php') ?>
    <main>
        <?php require_once "functions.php"; ?>
        <?php
        if (isset($_GET['id']) && isset($_GET['token'])) {
            $req = $bdd->prepare('SELECT * FROM membre WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
            $req->execute([$_GET['id'], $_GET['token']]);
            $user = $req->fetch();
            if ($user) {
                if (!empty($_POST)) {
                    if (!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']) {
                        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                        $bdd->prepare('UPDATE membre SET pass = ?, reset_at = NULL, reset_token = NULL')->execute([$password]);
                        echo '<div class="alert alert-danger"><strong>Information : </strong>  Votre mot de passe a bien été modifié';
                        $_SESSION['id'] = $donne['id'];
                        $_SESSION['pseudo'] = $_POST['pseudo'];
                        $_SESSION['statu'] = $donne['statu'];
                        print("<script type=\"text/javascript\">setTimeout('location=(\"index.php\")' ,10);</script>");
                        exit();
                    }
                }
            } else {
                echo '<div class="alert alert-danger"><strong>Information : </strong>  Ce token n\'est pas valide';
                print("<script type=\"text/javascript\">setTimeout('location=(\"connexion.php\")' ,10);</script>");
                exit();
            }
        } else {
            print("<script type=\"text/javascript\">setTimeout('location=(\"connexion.php\")' ,10);</script>");
            exit();
        }
        ?>
        <form method="POST">
            <div class="form-wrap">
                <h1>Changement de votre mot de passe :</h1>
                <input type="password" name="password" placeholder="Password" required />
                <input type="password" name="password_confirm" placeholder="Confirm Password" required />
                <input type="submit" value="Rénitialiser">
            </div>
        </form>
    </main>
    <?php include('footer.php') ?>
</body>

</html>