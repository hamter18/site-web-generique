<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-changerMdp.css">

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
                    <div class="divChangerMdp">
                        <h3>Changer de mot de passe : </h3>
                        <div class="divInput">
                            <i class="fa fa-lock fa-2x" style="color:white;"></i>
                            <label>Mot de passe actuel :</label>
                            <input type="password" name="mdp" require="" id="mdp" placeholder="Mot de passe actuel" name="" require="">  
                        </div>
                        <div class="divInput">
                            <i class="fa fa-lock fa-2x" style="color:white;"></i>
                            <label>Nouveau mot de passe :</label>
                            <input type="password" name="mdp" require="" id="mdp" placeholder="Nouveau mot de passe" name="" require="">  
                        </div>
                        <div class="divInput">
                            <i class="fa fa-lock fa-2x" style="color:white;"></i>
                            <label>Nouveau mot de passe :</label>
                            <input type="password" name="mdp" require="" id="mdp" placeholder="Nouveau mot de passe" name="" require="">  
                        </div>
                        <button class="buttonAction">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Valider
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>