<?php include('head.php') ?>
<link rel="stylesheet" href="public/css/style-inscription.css">

<body>
    <?php include('header-image.php') ?>
    <main>
        <?php
        $user_id = $_GET['id'];
        $token = $_GET['token'];
        $req = $bdd->prepare('SELECT * FROM membre WHERE id = ?');
        $req->execute([$user_id]);
        $user = $req->fetch();
        if ($user['confirmation_token'] == $token) {
            $bdd->prepare('UPDATE membre SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?')->execute([$user_id]);
            $_SESSION['id'] = $user['id'];
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['statu'] = $user['statu'];
            header('location: ../index.php');
        } else {
            header('location: ../index.php');
        }
        ?>
    </main>
    <?php include('footer.php') ?>
</body>

</html>