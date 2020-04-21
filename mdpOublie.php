<?php include('head.php') ?>
<link rel="stylesheet" href="public/css/style-connexion.css">

<body>
    <?php include('header-image.php') ?>
    <main>
        <div class="container">
            <div class="boxConnexion">
                <h2>Mot de passe oublié : </h2>
                <form method="POST" action="../mdpOublie.php">
                    <input type="email" name="email" id="email" placeholder="Email" required></br></br>
                    <input type="submit" value="Modifier" name="submit">
                </form>
                <div class="alert alert-danger">
                    <?php
                    if (isset($_POST['email']) &&$_POST['email'] != null) {
                        require_once 'functions.php';
                        $req = $bdd->prepare('SELECT * FROM membre WHERE email = ? AND confirmed_at IS NOT NULL');
                        $req->execute([$_POST['email']]);
                        $user = $req->fetch();
                        if ($user) {
                            $reset_token = str_random(60);
                            $bdd->prepare('UPDATE membre SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user['id']]);
                            $user_id = $user['id'];
                            $message .= '<html> <body style="background-color : white">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" height="300px">
            <tbody>
                <tr>
                    <h1>
                        <center> Bonjour ! Vous avez demandé une réinitialisation de votre mot de passe ! </center>
                    </h1>
                    <h2>
                        <center>Cliquez sur le lien ci dessous pour changer votre mot de passe!</center>
                    </h2>
                    <center>
                        <a href="http://g5.afia.fr/reset.php?id=' . urlencode($user_id) . '&token=' . urlencode($reset_token) . '" target=blank_>
                            http://g5.afia.fr/reset.php?id=' . urlencode($user_id) . '&token=' . urlencode($reset_token) . '
                        </a>
                    </center>
                </tr>
            </tbody>
        </table>
        </body>
        </html>
        ';

                            mail($_POST['email'], 'Réinitiatilisation de votre mot de passe', $message);
                            print("<script type=\"text/javascript\">setTimeout('location=(\"connexion.php\")' ,10);</script>");
                            exit();
                        } else {
                            echo '<strong>Information : </strong> Aucun compte ne correspond à cet adresse';
                        }
                    }else{
                        echo '<div class="alert alert-danger"><strong>Information : </strong> Un ou plusieurs champs sont vide</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php include('footer.php') ?>
</body>

</html>