<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-quiNousSommes.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div>
                <h2>Qui nous sommes :</h2>
                <div class="contentAll">
                    <div class="divProjet">
                        <div class="projet">
                            <div class="circle">
                                <img src="../public/image/portefolio/quiSommesNous.jpg">
                                <div>
                                    <h2>Description de l'entreprise :</h2>
                                    <?php
                                        $req = $bdd->query('SELECT descriptionEntreprise FROM parametres WHERE 1');
                                        $donnees = $req->fetch();
                                        $chaine = $donnees['descriptionEntreprise'];
                                        echo '<p>'. $chaine .'</p>';
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="presentionDirecteur">
                            <div class="card">
                                <img src="../public/image/portefolio/quiNousSommes/directeur.jpg">
                                <div class="info">
                                    <label class="nom">Michel Dupond</label>
                                    <label class="status">Directeur de l'entreprise</label>
                                </div>
                            </div>
                            <div class="card">
                                <img src="../public/image/portefolio/quiNousSommes/secretaire.jpg">
                                <div class="info">
                                    <label class="nom">Tati Tatou</label>
                                    <label class="status">Assistance</label>
                                </div>
                            </div>
                            <div class="card">
                                <img src="../public/image/portefolio/quiNousSommes/responsableMarketing.jpg">
                                <div class="info">
                                    <label class="nom">Joëlle Princessa</label>
                                    <label class="status">Directrice marketing</label>
                                </div>
                            </div>
                        </div>
                        <div class="autreRebrique">
                            <div class="rebrique">
                                <i class="fa fa-trophy fa-2x"></i>
                                <label class="titreRebrique">Nos objectifs</label>
                                    <?php
                                        $req = $bdd->query('SELECT objectifEntreprise FROM parametres WHERE 1');
                                        $donnees = $req->fetch();
                                        $chaine = $donnees['objectifEntreprise'];
                                        echo '<p>'. $chaine .'</p>';
                                    ?>
                            </div>
                            <div class="rebrique">
                                <i class="fa fa-book fa-2x"></i>
                                <label class="titreRebrique">Notre histoire</label>
                                    <?php
                                        $req = $bdd->query('SELECT histoireEntreprise FROM parametres WHERE 1');
                                        $donnees = $req->fetch();
                                        $chaine = $donnees['histoireEntreprise'];
                                        echo '<p>'. $chaine .'</p>';
                                    ?>
                            </div>
                            <div class="rebrique">
                                <i class="fa fa-shopping-basket fa-2x"></i>
                                <label class="titreRebrique">Nos services</label>
                                    <?php
                                        $req = $bdd->query('SELECT serviceEntreprise FROM parametres WHERE 1');
                                        $donnees = $req->fetch();
                                        $chaine = $donnees['serviceEntreprise'];
                                        echo '<p>'. $chaine .'</p>';
                                    ?>
                            </div>
                            <div class="rebrique">
                                <i class="fa fa-users fa-2x"></i>
                                <label class="titreRebrique">Nos phylosophies</label>
                                    <?php
                                        $req = $bdd->query('SELECT phylosophieEntreprise FROM parametres WHERE 1');
                                        $donnees = $req->fetch();
                                        $chaine = $donnees['phylosophieEntreprise'];
                                        echo '<p>'. $chaine .'</p>';
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>