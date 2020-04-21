<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-candidatureEmploie.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div class="containerAll">
                <h2>Candidature :</h2>
                <?php $req = $bdd->prepare('select * from offreEmplois where idOffreEmplois=?');
                $req->execute(array($_GET['offreEmplois']));
                $donnees = $req->fetch(); ?>
                <div class="candidature">
                    <h3><?php echo $donnees['titreOffreEmplois']; ?></h3>
                    <div class="infoGeneral">
                        <div class="info">
                            <i class="fa fa-map-marker fa-2x"></i>
                            <p><?php 
                                if( $donnees['lieu']==null){
                                    echo "Donnée non renseignée";
                            }
                            else {
                                echo $donnees['lieu']; 
                            }
                            ?></p>
                        </div>
                        <div class="info">
                            <i  class="fa fa-building-o"></i>
                            <p><?php 
                                if( $donnees['lieu']==null){
                                    echo "Donnée non renseignée";
                            }
                            else {
                                echo  $donnees['status']; 
                            }
                            ?></p>
                        </div>
                        <div class="info">
                            <i class="fa fa-eur fa-2x"></i>
                            <p><?php 
                                if( $donnees['lieu']==null){
                                    echo "Donnée non renseignée";
                            }
                            else {
                                echo  $donnees['salaire']; 
                            }
                            ?></p>
                        </div>
                    </div>
                    <div class="contenu">
                        <div class=partieDroite>
                            <div class="carte">
                                <img src="../public/image/offre_emploi/offreEmplois_consultant-informatique.jpg" alt="Consultant informatique">
                                <div class="option">
                                    <p><i class="fa fa-star" style="color:black;"></i><a href="../pageEnConstruction.php">Intéressé(e) ?</a></p>                           
                                    <p><i class="fa fa-share-alt" style="color:black;"></i><a  href="../pageEnConstruction.php">Partager</a></p>   
                                </div>
                            </div>
                            <div class="detailDeLOffre">
                                <p><label>Nombre de candidature :</label> 0</p>
                                <p><label>Nombre de poste(s) :</label> <?php echo $donnees['nbPoste']; ?></p>
                            </div>
                        </div>
                        <div class="partieGauche">
                            <div class="infoDetaillee">
                                <h4>Description : </h4>
                                <p><?php echo $donnees['descriptionOffreEmplois']; ?></p>
                            </div>
                            <div class="qualification&qualite">
                                <h4>Qualifications et qualités demandées</h4>
                                <ul>
                                    <?php
                                        if( $donnees['qualification']==null){
                                            echo "Donnée non renseignée";
                                    }
                                    else {
                                        $qualites = $donnees['qualification'];
                                   
                                        while ($qualites != ""){
                                            $afficher = stristr($qualites, '///', true);
                                            echo '<li>'. $afficher .'</li>'; 
                                            $qualites = stristr($qualites, '///');
                                            $qualites = substr($qualites, 3);
                                            
                                        }
                                    }


                                    ?>
                                    

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="postuler">
                    <h3>Postuler : </h3>
                    <div class=formulaire>
                        <div  class="informationsPersonelle">
                            <div class="information">
                                <label>Nom : </label>
                                <input type="text" placeholder="Votre nom...">
                            </div>
                            <div class="information">
                                <label>Prenom : </label>
                                <input type="text" placeholder="Votre prénom...">
                            </div>
                            <div class="information">
                                <label>Email : </label>
                                <input type="text" placeholder="Votre e-mail...">
                            </div>
                        </div>
                        <div class="information">
                            <label>Déposer votre CV : </label>
                            <input type="text" placeholder="Aucun fichier de sélectionné...">
                            <input type="button" value="Parcourir">
                        </div>
                        <div class="information">
                            <label>Déposer votre lettre de motivation : </label>
                            <input type="text" placeholder="Aucun fichier de sélectionné...">
                            <input type="button" value="Parcourir">
                        </div>
                        <input class="buttonAction" type="button" value="Candidater !">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>