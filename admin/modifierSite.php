<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-modifierSite.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div class="boxMonCompte">
                <h2>Mon compte</h2>
                <?php
                $req = $bdd->query('SELECT * FROM parametres WHERE 1');
                $donnees = $req->fetch()
                ?>
                <div class="divMonCompte">
                    <div class="barreNavigation">
                        <?php include('../barreNavidationCompte.php')  ?>
                    </div>
                    <div class="divModifierSite">
                        <h3>Modifier site : </h3>
                        <div class="tanleauDeBord">
                            <div>
                                <div>
                                    <form method="POST" action="../admin/modifierSite.php">
                                        <h4>Modification générale :</h4>
                                        <div class="borderAction">
                                            <label>Le nom de l'entreprise :</label>
                                            <?php echo '<input id="modificationNomDuSite" name="modificationNomDuSite" type="text" value="' . $donnees['nomDuSite'] . '" />'; ?>
                                            <div>
                                                <button class="buttonAction" type="submit" value="Valider">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    Valider
                                                </button>
                                            </div>
                                    </form>
                                </div>
                                <div>
                                    <div class="borderAction">
                                        <form method="post" enctype="multipart/form-data">
                                                <h4>Modification de l'image principal :</h4>
                                                <input type="file" name="photo" accept="image/*">
                                                <button class="buttonAction" type="submit">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    Envoyer
                                                </button>
                                        </form>
                                        <?php
                                        if (isset($_FILES['photo']['tmp_name'])) {
                                            $retour = copy($_FILES['photo']['tmp_name'], '../public/image/web/background.jpg');
                                            if ($retour) {
                                                echo '<div class="alert alert-success">La photo a bien été envoyée.</div>';
                                            }
                                            else{
                                                echo '<div class="alert alert-danger">Une erreur est survenue.</div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div>
                                    <div class="borderAction">
                                        <h4>Modification de la video principal :</h4>
                                        <form method="post" enctype="multipart/form-data">
                                            <input type="file" name="video" accept="video/*">
                                            <button class="buttonAction" type="submit">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    Envoyer
                                            </button>
                                        </form>
                                        <?php
                                        if (isset($_FILES['photo']['tmp_name'])) {
                                            $retour = copy($_FILES['photo']['tmp_name'], '../public/image/web/background.jpg');
                                            if ($retour) {
                                                echo '<div class="alert alert-success">La photo a bien été envoyée.</div>';
                                            }
                                            else{
                                                echo '<div class="alert alert-danger">Une erreur est survenue.</div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="borderAction">
                                <h4>Modifer le nom des onglets (de gauche à droite):</h4>
                                <form method="POST" action="../admin/modifierSite.php">
                                    <h5>Deuxième onglet :</h5>
                                    <select name="boutique">
                                        <option value="Boutique">Boutique</option>
                                        <option value="Formation">Formation</option>
                                        <option value="Shop">Shop</option>
                                        <option value="">Ne pas afficher</option>
                                    </select>
                                    <button class="buttonAction" type="submit" value="Valider">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    Envoyer
                                    </button>
                                </form>
                                <form method="POST" action="../admin/modifierSite.php">
                                    <h5>Troisième onglet :</h5>
                                    <select name="blog">
                                        <option value="Blog">Blog</option>
                                        <option value="News">News</option>
                                        <option value="Formation">Nouvelle</option>
                                        <option value="">Ne pas afficher</option>
                                    </select>
                                    <button class="buttonAction" type="submit" value="Valider">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    Envoyer
                                    </button>
                                </form>
                                <form method="POST" action="../admin/modifierSite.php">
                                    <h5>Quatrième onglet :</h5>
                                    <select name="forum">
                                        <option value="Forum">Forum</option>
                                        <option value="">Ne pas afficher</option>
                                    </select>
                                    <button class="buttonAction" type="submit" value="Valider">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    Envoyer
                                    </button>
                                </form>
                                <form method="POST" action="../admin/modifierSite.php">
                                    <h5>Cinquième onglet :</h5>
                                    <select name="portofolio">
                                        <option value="Portofolio">Portofolio</option>
                                        <option value="">Ne pas afficher</option>
                                    </select>
                                    <button class="buttonAction" type="submit" value="Valider">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    Envoyer
                                    </button>

                                </form>

                                <form method="POST" action="../admin/modifierSite.php">
                                    <h5>Sixième onglet :</h5>
                                    <select name="contact">
                                        <option value="Contact">Contact</option>
                                        <option value="">Ne pas afficher</option>
                                    </select>
                                    <button class="buttonAction" type="submit" value="Valider">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    Envoyer
                                    </button>
                                </form>
                            </div>
                            <div>
                                <h4>Modification du portefolio</h4>
                                <div class="borderAction">
                                    <div>
                                        <form method="POST" action="../admin/modifierSite.php">
                                            <label>Notre vision d'avenir : ("Présenter les objectif de votre entreprise...")</label>
                                            <?php echo '<textarea id="modificationNotrevisionavenir" name="modificationNotrevisionavenir" placeholder="' . $donnees['notrevisionavenir'] . '" ></textarea>'; ?>
                                            <div>
                                                <button class="buttonAction" type="submit" value="Valider">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    Valider
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div>
                                        <form method="POST" action="../admin/modifierSite.php">
                                            <label>Nos projets déjà réalisés : ("Présenter quelques projets, ou réalisations de votre entreprise...")</label>
                                            <?php echo '<textarea id="modificationNosprojetsrealises" name="modificationNosprojetsrealises" placeholder="' . $donnees['nosprojetsrealises'] . '" ></textarea>'; ?>
                                            <div>
                                                <button class="buttonAction" type="submit" value="Valider">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    Valider
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div>
                                        <form method="POST" action="../admin/modifierSite.php">
                                            <label>Nous recrutons : ("Présenter votre position au niveau du recrutement...")</label>
                                            <?php echo '<textarea id="modificationNousrecrutons" name="modificationNousrecrutons" placeholder="' . $donnees['nousrecrutons'] . '" ></textarea>'; ?>
                                            <div>
                                                <button class="buttonAction" type="submit" value="Valider">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    Valider
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h4>Modification de la page contact :</h4>
                                <div class="borderAction">
                                    <form method="POST" action="../admin/modifierSite.php">
                                        <div class="article">
                                            <label>Le numéro de téléphone de votre entreprise :</label>
                                            <?php echo '<input id="modificationTelephone" name="modificationTelephone" type="number" value="' . $donnees['telephone'] . '" />'; ?>
                                        </div>
                                        <div class="article">
                                            <label>L'e-mail de votre entreprise :</label>
                                            <?php echo '<input id="modificationEmail" name="modificationEmail" type="text" value="' . $donnees['email'] . '" />'; ?>
                                        </div>
                                        <div class="article">
                                            <label>L'adresse de votre entreprise :</label>
                                            <?php echo '<input id="modificationAdresse" name="modificationAdresse" type="text" value="' . $donnees['adresse'] . '" />'; ?>
                                        </div>
                                        <div>
                                            <button class="buttonAction" type="submit" value="Valider">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                Valider
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div>
                                <h4>Modification de présentation de l'entreprise :</h4>
                                <div class="borderAction">
                                    <form method="POST" action="../admin/modifierSite.php">
                                        <div>
                                            <label>Description de l'entreprise :</label>
                                            <?php echo '<textarea id="descriptionEntreprise" name="descriptionEntreprise" placeholder="' . $donnees['descriptionEntreprise'] . '" ></textarea>'; ?>
                                        </div>
                                        <div>
                                            <label>Nos objectifs :</label>
                                            <?php echo '<textarea id="objectifEntreprise" name="objectifEntreprise" placeholder="' . $donnees['objectifEntreprise'] . '" ></textarea>'; ?>
                                        </div>
                                        <div>
                                            <label>Notre histoire :</label>
                                            <?php echo '<textarea id="histoireEntreprise" name="histoireEntreprise" placeholder="' . $donnees['histoireEntreprise'] . '" ></textarea>'; ?>
                                        </div>
                                        <div>
                                            <label>Nos services :</label>
                                            <?php echo '<textarea id="serviceEntreprise" name="serviceEntreprise" placeholder="' . $donnees['serviceEntreprise'] . '" ></textarea>'; ?>
                                        </div>   
                                        <div>
                                            <label>Notre phylosophie :</label>
                                            <?php echo '<textarea id="phylosophieEntreprise" name="phylosophieEntreprise" placeholder="' . $donnees['phylosophieEntreprise'] . '" ></textarea>'; ?>
                                        </div>                                    
                                        <div>
                                            <button class="buttonAction" type="submit" value="Valider">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                Valider
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div>
                                <h4>Modification des projet réalisés par l'entreprise :</h4>
                                <div class="borderAction">
                                    <form method="POST" action="../admin/modifierSite.php">
                                        <div>
                                            <label>Phrase d'accroche pour la rebrique nos projets réalisés :</label>
                                            <?php echo '<textarea id="notrevisionavenir" name="notrevisionavenir" placeholder="' . $donnees['notrevisionavenir'] . '" ></textarea>'; ?>
                                        </div>
                                        <div>
                                            <button class="buttonAction" type="submit" value="Valider">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                Ajouter
                                            </button>
                                        </div>

                                    </form>
                                    <form method="POST" enctype="multipart/form-data">
                                        <h4>Ajouer un projet</h4>
                                        <div>
                                            <label>Titre d'un projet que vous souhaitez mettre en avant :</label>
                                            <?php echo '<textarea id="titreProjet" name="titreProjet" ></textarea>'; ?>
                                        </div>
                                        <div>
                                            <label>Description d'un projet que vous souhaitez mettre en avant :</label>
                                            <?php echo '<textarea id="descriptionProjet" name="descriptionProjet"  ></textarea>'; ?>
                                        </div>
                                            <div>
                                                <button class="buttonAction" type="submit" value="Valider">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    Ajouter
                                                </button>
                                            </div>
                                    </form>
                                    <div>
                                        <?php
                                        if (isset($_POST['titreProjet']) && isset($_POST['descriptionProjet']) && $_POST['descriptionProjet'] != NULL && $_POST['titreProjet']!= NULL ) {
                                            $req = $bdd->prepare('SELECT count(*) AS nbr FROM projet where titreProjet=?');
                                            $req->execute(array($_POST['titreProjet']));
                                            $donne = $req->fetch(PDO::FETCH_ASSOC);
                                            if ($donne['nbr'] != 0) {
                                                echo '<div class="alert alert-danger"><strong>Information : </strong> Titre dejà utilisé, le projet n\'as pas été ajouté</div>';
                                                $erreur=true;
                                            } else {
                                                $req = $bdd->prepare('INSERT INTO projet (titreProjet,descriptionProjet) VALUES (:titre,:description)');
                                                $req->execute(array(
                                                    'titre' => $_POST['titreProjet'],
                                                    'description' => $_POST['descriptionProjet'],
                                                ));
                                                $erreur=false;
                                            }
                                            if($erreur==false){
                                                echo '<div class="alert alert-success"><strong>Information : </strong> Ajout du projet réussi</div>';     
                                            }

                                        } else {
                                            echo '<div class="alert alert-danger"><strong>Information : </strong> Un ou plusieurs champs sont vides</div>';     
                                        }
                                        ?>
                                    </div>
                                    
                                    <div>
                                        <h4>Supprimer un projet</h4>
                                        <label>Nom : </label>
                                        <form method="GET">
                                            <input type="search" name="recherche" placeholder="Recherche du projet ..." />
                                            <button type="submit" class="button">Search</button>
                                        </form>
                                        <?php
                                        $projets = $bdd->query('SELECT titreProjet FROM projet');
                                        if (isset($_GET['recherche']) and !empty($_GET['recherche'])) {
                                            $recherche = htmlspecialchars($_GET['recherche']);
                                            $projets = $bdd->query('SELECT * FROM projet WHERE titreProjet LIKE "%' . $recherche . '%" ORDER BY titreProjet DESC');
                                            if ($projets->rowCount() == 0) {
                                                echo '<div class="alert alert-danger"><strong>Information : </strong> Il n\'y a pas de projet avec ce titre</h4>';
                                            }
                                            else {
                                                while ($reponse = $projets->fetch()) {                
                                                    echo '<div class="alert alert-success"><strong>Information : </strong> Un élément à été trouvé !</div>';                                                 
                                                    echo '<h4>'.$reponse[titreProjet] .'</h4>';
                                                    echo '<p>'.$reponse[descriptionProjet] .'</p>';
                                                    echo '
                                                        <form method="POST" action="../admin/deleteProjet.php?idProjet='.$reponse['idProjet'].'">
                                                        <button class="buttonAction" type="submit">
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            Supprimer
                                                        </button>
                                                        </form>';
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h4>Modification des offres d'emplois pour l'entreprise :</h4>
                                <div class="borderAction">
                                    <form method="POST" enctype="multipart/form-data">
                                        <h4>Ajouter une offre d'emplois</h4>
                                        <div>
                                            <label>Titre de l'offre d'emplois :</label>
                                            <?php echo '<input id="titreOffreEmplois" name="titreOffreEmplois" />'; ?>
                                        </div>
                                        <div>
                                            <label>Description de l'offre d'emplois :</label>
                                            <?php echo '<textarea id="descriptionOffreEmplois" name="descriptionOffreEmplois" ></textarea>'; ?>
                                        </div>
                                        <div>
                                            <label>Lieu de l'offre d'emplois :</label>
                                            <?php echo '<input id="lieu" name="lieu" />'; ?>
                                        </div>
                                        <div>
                                            <label>Status de l'offre d'emplois (CDD, CDI, stage ...):</label>
                                            <?php echo '<input id="status" name="status" />'; ?>
                                        </div>
                                        <div>
                                            <label>Salaire de l'offre d'emplois :</label>
                                            <?php echo '<input id="salaire" name="salaire" />'; ?>
                                        </div>
                                        <div>
                                            <label>Nombre de poste pour l'offre d'emplois :</label>
                                            <?php echo '<input id="nbPoste" name="nbPoste" />'; ?>
                                        </div>
                                        <div>
                                            <label>Qualification pour l'offre d'emplois (séparer les qualifications par "///", de tel façon : "sérieux///travailleur///"):</label>
                                            <?php echo '<input id="qualification" name="qualification" />'; ?>
                                        </div>
                                        <div>
                                            <button class="buttonAction" type="submit" value="Valider">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                Ajouter
                                            </button>
                                        </div>
                                    </form>
                                    <div>
                                        <?php
                                        if (isset($_POST['titreOffreEmplois']) && isset($_POST['descriptionOffreEmplois']) && isset($_POST['qualification']) && isset($_POST['nbPoste']) 
                                        && isset($_POST['salaire']) && isset($_POST['status']) && isset($_POST['lieu']) && $_POST['descriptionOffreEmplois'] != NULL 
                                        && $_POST['titreOffreEmplois']!= NULL && $_POST['qualification']!= NULL && $_POST['nbPoste']!= NULL && $_POST['salaire']!= NULL
                                        && $_POST['status']!= NULL && $_POST['lieu']!= NULL ) {
                                            $req = $bdd->prepare('SELECT count(*) AS nbr FROM offreEmplois where titreOffreEmplois=?');
                                            $req->execute(array($_POST['titreOffreEmplois']));
                                            $donne = $req->fetch(PDO::FETCH_ASSOC);
                                            if ($donne['nbr'] != 0) {
                                                echo '<div class="alert alert-danger"><strong>Information : </strong> Titre dejà utilisé, l\'offre d\'emploie n\'as pas été rajouté</div>';
                                                $erreur==true;
                                            } else {
                                                $req = $bdd->prepare('INSERT INTO offreEmplois (titreOffreEmplois,descriptionOffreEmplois,qualification,nbPoste,salaire,status,lieu) 
                                                VALUES (:titre,:description,:qualif,:Poste,:salaireEnploie,:statusEmploie,:lieuEmploie)');
                                                $req->execute(array(
                                                    'titre' => $_POST['titreOffreEmplois'],
                                                    'description' => $_POST['descriptionOffreEmplois'],
                                                    'qualif' => $_POST['qualification'],
                                                    'Poste' => $_POST['nbPoste'],
                                                    'salaireEnploie' => $_POST['salaire'],
                                                    'statusEmploie' => $_POST['status'],
                                                    'lieuEmploie' => $_POST['lieu'],
                                                ));
                                                $erreur==false;
                                                echo '<div class="alert alert-success"><strong>Information : </strong> L\'offre d\'emploie a été ajouté</div>';     
                                            }        
                                        } else {
                                            echo '<div class="alert alert-danger"><strong>Information : </strong> Un ou plusieurs champs sont vides</div>';     
                                        }
                                        ?>
                                    </div>  
                                    <div>
                                        <h4>Supprimer une offre d'emplois : </h4>
                                        <label>Nom : </label>
                                        <form method="GET">
                                            <input type="search" name="recherche" placeholder="Recherche du projet ..." />
                                            <button type="submit" class="button">Search</button>
                                        </form>
                                        <?php
                                        $offresDemploie = $bdd->query('SELECT titreProjet FROM projet');
                                        if (isset($_GET['recherche']) and !empty($_GET['recherche'])) {
                                            $recherche = htmlspecialchars($_GET['recherche']);
                                            $offresDemploie = $bdd->query('SELECT * FROM offreEmplois WHERE titreOffreEmplois LIKE "%' . $recherche . '%" ORDER BY titreOffreEmplois DESC');
                                            if ($offresDemploie->rowCount() == 0) {
                                                echo '<div class="alert alert-danger"><strong>Information : </strong> Il n\'y a pas de projet avec ce titre</div>';
                                            }
                                            else {
                                                while ($reponse = $offresDemploie->fetch()) {           
                                                    echo '<div class="alert alert-success"><strong>Information : </strong> Un élément à été trouvé !</div>';                           
                                                    echo '<h4>'.$reponse[titreOffreEmplois] .'</h4>';
                                                    echo '<p>'.$reponse[descriptionOffreEmplois] .'</p>';
                                                    echo '
                                                        <form method="POST" action="../admin/deleteOffreEmplois.php?idOffreEmplois='.$reponse['idOffreEmplois'].'">
                                                        <button class="buttonAction" type="submit">
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            Supprimer
                                                        </button>
                                                        </form>';
                                                }
                                            }
                                        }
                                        ?>
                                    </div>       
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>

<?php
if (isset($_POST['modificationNomDuSite']) && $_POST['modificationNomDuSite'] != NULL) {
    $req = $bdd->prepare('UPDATE parametres SET nomDuSite=? where 1');
    $req->execute(array($_POST['modificationNomDuSite']));
}

if (isset($_POST['boutique'])) {

    $req = $bdd->prepare('UPDATE parametres SET nomBoutique=? where 1');
    $req->execute(array($_POST['boutique']));
}

if (isset($_POST['blog'])) {
    $req = $bdd->prepare('UPDATE parametres SET nomBlog=? where 1');
    $req->execute(array($_POST['blog']));
}
if (isset($_POST['forum'])) {

    $req = $bdd->prepare('UPDATE parametres SET nomForum=? where 1');
    $req->execute(array($_POST['forum']));
}
if (isset($_POST['portofolio'])) {
    $req = $bdd->prepare('UPDATE parametres SET nomPortofolio=? where 1');
    $req->execute(array($_POST['portofolio']));
}
if (isset($_POST['contact'])) {
    $req = $bdd->prepare('UPDATE parametres SET nomContact=? where 1');
    $req->execute(array($_POST['contact']));
}

if (isset($_POST['modificationQuisommesnous'])) {
    if ($_POST['modificationQuisommesnous'] == "") {
        $_POST['modificationQuisommesnous'] = NULL;
    }
    $req = $bdd->prepare('UPDATE parametres SET quisommesnous=? where 1');
    $req->execute(array($_POST['modificationQuisommesnous']));
}

if (isset($_POST['modificationNotrevisionavenir'])) {
    if ($_POST['modificationNotrevisionavenir'] == "") {
        $_POST['modificationNotrevisionavenir'] = NULL;
    }
    $req = $bdd->prepare('UPDATE parametres SET notrevisionavenir=? where 1');
    $req->execute(array($_POST['modificationNotrevisionavenir']));
}
if (isset($_POST['modificationNosprojetsrealises'])) {
    if ($_POST['modificationNosprojetsrealises'] == "") {
        $_POST['modificationNosprojetsrealises'] = NULL;
    }
    $req = $bdd->prepare('UPDATE parametres SET nosprojetsrealises=? where 1');
    $req->execute(array($_POST['modificationNosprojetsrealises']));
}

if (isset($_POST['modificationNousrecrutons'])) {
    if ($_POST['modificationNousrecrutons'] == "") {
        $_POST['modificationNousrecrutons'] = NULL;
    }
    $req = $bdd->prepare('UPDATE parametres SET nousrecrutons=? where 1');
    $req->execute(array($_POST['modificationNousrecrutons']));
}

if (isset($_POST['modificationTelephone'])) {
    if ($_POST['modificationTelephone'] == "") {
        $_POST['modificationTelephone'] = NULL;
    }
    $req = $bdd->prepare('UPDATE parametres SET telephone=? where 1');
    $req->execute(array($_POST['modificationTelephone']));
}
if (isset($_POST['modificationEmail'])) {
    if ($_POST['modificationEmail'] == "") {
        $_POST['modificationEmail'] = NULL;
    }
    $req = $bdd->prepare('UPDATE parametres SET email=? where 1');
    $req->execute(array($_POST['modificationEmail']));
}
if (isset($_POST['modificationAdresse'])) {
    if ($_POST['modificationAdresse'] == "") {
        $_POST['modificationAdresse'] = NULL;
    }
    $req = $bdd->prepare('UPDATE parametres SET adresse=? where 1');
    $req->execute(array($_POST['modificationAdresse']));
}



if (isset($_POST['descriptionEntreprise'])) {
    if ($_POST['descriptionEntreprise'] == "") {
        $_POST['descriptionEntreprise'] = NULL;
    }
    $req = $bdd->prepare('UPDATE parametres SET descriptionEntreprise=? where 1');
    $req->execute(array($_POST['descriptionEntreprise']));
}
if (isset($_POST['objectifEntreprise'])) {
    if ($_POST['objectifEntreprise'] == "") {
        $_POST['objectifEntreprise'] = NULL;
    }
    $req = $bdd->prepare('UPDATE parametres SET objectifEntreprise=? where 1');
    $req->execute(array($_POST['objectifEntreprise']));
}
if (isset($_POST['histoireEntreprise'])) {
    if ($_POST['histoireEntreprise'] == "") {
        $_POST['histoireEntreprise'] = NULL;
    }
    $req = $bdd->prepare('UPDATE parametres SET histoireEntreprise=? where 1');
    $req->execute(array($_POST['histoireEntreprise']));
}
if (isset($_POST['serviceEntreprise'])) {
    if ($_POST['serviceEntreprise'] == "") {
        $_POST['serviceEntreprise'] = NULL;
    }
    $req = $bdd->prepare('UPDATE parametres SET serviceEntreprise=? where 1');
    $req->execute(array($_POST['serviceEntreprise']));
}
if (isset($_POST['phylosophieEntreprise'])) {
    if ($_POST['phylosophieEntreprise'] == "") {
        $_POST['phylosophieEntreprise'] = NULL;
    }
    $req = $bdd->prepare('UPDATE parametres SET phylosophieEntreprise=? where 1');
    $req->execute(array($_POST['phylosophieEntreprise']));
}
if (isset($_POST['notrevisionavenir'])) {
    if ($_POST['notrevisionavenir'] == "") {
        $_POST['notrevisionavenir'] = NULL;
    }
    $req = $bdd->prepare('UPDATE parametres SET notrevisionavenir=? where 1');
    $req->execute(array($_POST['notrevisionavenir']));
}

if (isset($_POST['titreProjet'])) {
    if ($_POST['titreProjet'] == "") {
        $_POST['titreProjet'] = NULL;
    }
    $req = $bdd->prepare('UPDATE parametres SET titreProjet=? where 1');
    $req->execute(array($_POST['titreProjet']));
}

if (isset($_POST['descriptionProjet'])) {
    if ($_POST['descriptionProjet'] == "") {
        $_POST['descriptionProjet'] = NULL;
    }
    $req = $bdd->prepare('UPDATE parametres SET descriptionProjet=? where 1');
    $req->execute(array($_POST['descriptionProjet']));
}
?>