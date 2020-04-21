<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-nosProjet.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div>
                <h2>Nos projets :</h2>
                <div class="contentAll">
                    <div class="divProjet">
                        <?php
                            $reponse = $bdd->query('SELECT * FROM projet');
                            while ($donnees = $reponse->fetch()) {
                        ?>
                        <div class="projet">
                            <div class="circle">
                                <img src="../public/image/portefolio/projets/nosProjet.jpg">
                                <div>
                                    <?php
                                        $chaine = $donnees['titreProjet'];
                                        echo '<p>'. $chaine .'</p>';
                                    ?>
                                    <?php
                                        $chaine = $donnees['descriptionProjet'];
                                        echo '<p>'. $chaine .'</p>';
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php }
                            $reponse->closeCursor(); 
                        ?>
                    </div>
                </div>
            </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>