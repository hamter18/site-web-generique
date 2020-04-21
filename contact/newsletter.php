<?php include('head.php') ?>
<link rel="stylesheet" href="public/css/style-connexion.css">

<body>
    <?php include('header-image.php') ?>
    <main>
        <div class="container">
            <h2>Abonnement Newsletter éffectué ! </h2>
            <?php
            if (isset($_POST['mail'])&&$_POST['mail'] != NULL&&preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail'])){
                $req = $bdd->prepare('INSERT INTO `abonnéNewsletter` (`id`, `mail`) VALUES (NULL, :email)');
                $req->execute(array(
                    'email' => $_POST['mail'],
                ));
            }
            ?>
        </div>
    </main>
    <?php include('footer.php') ?>
</body>
</html>