<link rel="stylesheet" href="/public/css/style-header-video.css">

<header>
    <div class="container">
        <video autoplay controls loop poster="public/image/web/background.jpg" id="bgvid">
            <source src="../public/video/background.mp4" type="video/mp4">
            <p>Votre navigateur ne prend pas en charge les vidéos HTML5.</p>
        </video>
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
            <div class="blockquote">
                « La musique, c'est aussi grand que l'univers. Il suffit juste d'oser »
            </div>
        </div>
        <?php include('/home/cfaifrnfzy/iutg5/navigation-bar.php') ?>
    </div>
</header>