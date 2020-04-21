<div class="navbar">
    <a class="active" href="../index.php"><i class="fa fa-home"></i>Accueil</a>
    <?php
    $req = $bdd->query('SELECT * FROM parametres WHERE 1');
    $donnees = $req->fetch();
    if ($donnees['nomBoutique'] != null) {
        echo '<a href="../boutique/boutique.php">' . $donnees['nomBoutique'] . '</a>';
    }
    if ($donnees['nomBlog'] != null) {
        echo '<a href="../blog/blog.php">' . $donnees['nomBlog'] . '</a>';
    }
    if ($donnees['nomForum'] != null) {
        echo '<a href="../forum/forum.php">' . $donnees['nomForum'] . '</a>';
    }
    if ($donnees['nomPortofolio'] != null) {
        echo '<a href="../portefolio/portefolio.php">' . $donnees['nomPortofolio'] . '</a>';
    }
    if ($donnees['nomContact'] != null) {
        echo '<a href="../contact/contact.php">' . $donnees['nomContact'] . '</a>';
    }
    ?>
    <div class="search">
        <input type="text" placeholder="Search..">
        <button type="button"><i class="fa fa-search fa-1x grey"></i></button>
    </div>
    <div class="subnav">
        <?php
        if ($donnees['nomBoutique'] != null) {
            echo '<a class="subnavbtn" href="../boutique/panier.php"><i class="fa fa-shopping-cart fa-1x grey"></i></a>';
        }
        ?> 
    </div>
    <div class="subnav">
        <a class="subnavbtn"><i class="fa fa-user-circle-o fa-1x grey"></i></a>
        <div class="subnav-content">
            <a href="../connexion.php">Connexion</a>
            <a href="../inscription.php">Inscription</a>
            <?php if (isset($_SESSION['pseudo']) and $_SESSION['pseudo'] != null) { ?>
                <a href="../membreNA/monCompte.php?position=monCompte">Mon compte</a>
                <a href="../deconnexion.php">Deconnexion</a>
            <?php } ?>
        </div>
    </div>
</div>