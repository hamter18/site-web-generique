<link rel="stylesheet" href="../public/css/style-barreNavidationCompte.css">

<?php
if (isset($_GET['position'])) {
    $position = $_GET['position'];
}
?>

<div class="vertical-menu">
    <a href="../membreNA/monCompte.php?position=monCompte" class="home" <?php
                                                                        if (strcmp($_GET['position'], "monCompte") == 0) {
                                                                            echo 'class="active"';
                                                                        }
                                                                        ?>>Mon profil</a>
    <?php if ($_SESSION['statu'] == "admin") { ?>
        <a href="../admin/monCompteTableauDeBord.php?position=monCompteTableauDeBord" <?php
                                                                                        if (strcmp($_GET['position'], "monCompteTableauDeBord") == 0) {
                                                                                            echo 'class="active"';
                                                                                        }
                                                                                        ?>>Tableau de bord</a>
    <?php }
    if ($_SESSION['statu'] == "admin") { ?>
        <a href="../admin/modifierSite.php?position=modifierSite" <?php
                                                                    if (strcmp($_GET['position'], "modifierSite") == 0) {
                                                                        echo 'class="active"';
                                                                    }
                                                                    ?>>Modifier le site</a>
    <?php }
    if ($_SESSION['statu'] == "admin") { ?>
        <a href="../admin/gestionDesActualites.php?position=gestionDesActualites" <?php
                                                                                    if (strcmp($_GET['position'], "gestionDesActualites") == 0) {
                                                                                        echo 'class="active"';
                                                                                    }
                                                                                    ?>>Gestion des actualités</a>
    <?php }
    if ($_SESSION['statu'] == "admin") { ?>
        <a href="../admin/monCompteBoutique.php?position=monCompteBoutique" <?php
                                                                            if (strcmp($_GET['position'], "monCompteBoutique") == 0) {
                                                                                echo 'class="active"';
                                                                            }
                                                                            ?>>Gestion de la boutique</a>
    <?php }
    if ($_SESSION['statu'] == "admin") { ?>
        <a href="../admin/monCompteListeDesMembres.php?position=listeDesMembres" <?php
                                                                                    if (strcmp($_GET['position'], "listeDesMembres") == 0) {
                                                                                        echo 'class="active"';
                                                                                    }
                                                                                    ?>>Liste des membres</a>
    <?php }
    if ($_SESSION['statu'] == "admin") { ?>
        <a href="../admin/bannir.php?position=bannir" <?php
                                                        if (strcmp($_GET['position'], "bannir") == 0) {
                                                            echo 'class="active"';
                                                        }
                                                        ?>>Bannir un membre</a>
    <?php } ?>
    <a href="../membreNA/mesAdresses.php?position=mesAdresses" <?php
                                                                if (strcmp($_GET['position'], "mesAdresses") == 0) {
                                                                    echo 'class="active"';
                                                                }
                                                                ?>>Mes adresses</a>
    <a href="../membreNA/mesAbonnements.php?position=mesAbonnements" <?php
                                                                        if (strcmp($_GET['position'], "mesAbonnements") == 0) {
                                                                            echo 'class="active"';
                                                                        }
                                                                        ?>>Mes abonnements</a>
    <a href="../membreNA/changerMdp.php?position=changerMdp" <?php
                                                                if (strcmp($_GET['position'], "changerMdp") == 0) {
                                                                    echo 'class="active"';
                                                                }
                                                                ?>>Changer de mot de passe</a>
    <a href="../deconnexion.php">Se déconnecter</a>
</div>