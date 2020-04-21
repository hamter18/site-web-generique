<?php
try {
    $bdd = new PDO('mysql:host=cfaifrnfzyg5.mysql.db;dbname=cfaifrnfzyg5;charset=utf8', 'cfaifrnfzyg5', 'Aiut2020');
    //$bdd =  new PDO("mysql:dbname=cfaifrnfzyg5;host=localhost;charset=utf8", 'root', '');
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur :' . $e->getMessage());
}
session_start();
ini_set('display_errors', 1);

if (isset($_SESSION['status']) and $_SESSION['status'] == 'ban') {
    header('location: banni.php');
}
require('/home/cfaifrnfzy/iutg5/functions.php');
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <?php
    $req = $bdd->query('SELECT nomDuSite FROM parametres WHERE 1');
    $donnees = $req->fetch()
    ?>
    <title><?php echo $donnees['nomDuSite']; ?></title>
    <link rel="stylesheet" href="../public/css/style-body.css">
    <link rel="stylesheet" href="../public/css/style-footer.css">
    <link rel="stylesheet" href="../public/css/style-navigation-bar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
</head>