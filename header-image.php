<link rel="stylesheet" href="/public/css/style-header-image.css">

<header>
    <div class="container">
        <div class="bg">
            <div class="overlay">
                <div class="center">
                    <?php
                    $req = $bdd->query('SELECT nomDuSite FROM parametres WHERE 1');
                    $donnees = $req->fetch();
                    $chaine = $donnees['nomDuSite'];
                    $chaine = strtoupper($chaine);
                    $array_carac = str_split($chaine);
                    foreach ($array_carac as $value) {
                        echo '<span class="letter" data-letter="' . $value . '">' . $value . '</span>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php include('/home/cfaifrnfzy/iutg5/navigation-bar.php') ?>
    </div>
</header>