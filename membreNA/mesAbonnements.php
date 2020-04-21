<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-mesAbonnements.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div class="boxMonCompte">
                <h2>Mon compte</h2>
                <div class="divMonCompte">
                    <div class="barreNavigation">
                        <?php include('../barreNavidationCompte.php')  ?>
                    </div>
                    <div class="divAbonnements">
                        <h3>Mes abonnements : </h3>
                        <div class="abonnements">
                            <h4>Newsletter :</h4>
                            <p>Vous n'êtes pas abonné. Vous-voulez commencer maintenant ? <a href="#"> Cliquez ici !</a></p>                        
                            
                            <p>Vous êtes abonné aux newsletter ! Désirez vous vous désabonner ? <a href="#"> Cliquez ici !</a></p>                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>