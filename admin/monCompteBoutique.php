<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-monCompteBoutique.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <script type="text/javascript" src="../public/js/monCompteBoutique.js"></script>
        <script type="text/javascript" src="../public/js/MonCompte.js"></script>
        <div class="container">
            <div class="boxMonCompte">
                <h2>Mon compte</h2>
                <div class="divMonCompte">
                    <div class="barreNavigation">
                        <?php include('../barreNavidationCompte.php')  ?>
                    </div>
                    <div class="divGestion">
                        <h3>Gestion de la boutique : </h3>
                        <div class="divContainerAction">
                            <h4>Produit en ruptue de stock :</h4>
                            <div class="divAction input">
                                <ul class="borderAction listeProduitRupture">
                                    <form method="POST" action="../admin/monCompteBoutique.php">
                                        <?php
                                        $reponse = $bdd->query('SELECT * FROM produit where quantite=0');
                                        while ($donnees = $reponse->fetch()) {
                                        ?>
                                            <li>
                                                <label class="nomProduit"><?php echo ''.$donnees['nom'].' - '.$donnees['prix'].'€'; ?></label>
                                                <div class="quantite">
                                                    <label>Quantité a commander</label>
                                                    <input type="number" id="quantiteC" name="quantiteC" min="0" max="100" value="1">
                                                    <input type="hidden" id="idC" name="idC" value="<?php echo $donnees['reference']; ?>">
                                                </div>
                                                <button class="buttonAction">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    Commander
                                                </button>
                                            </li>
                                        <?php }
                                        $reponse->closeCursor(); ?>
                                    </form>
                                </ul>
                            </div>
                        </div>
                        <div class="divContainerAction">
                            <h4>Ajouter un produit : </h4>
                            <div class="divAction">
                                <div class="ajoutProduit borderAction">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="divInput input">
                                            <label>Nom : </label>
                                            <input type="text" placeholder="Le nom de votre produit..." name="nomP" id="nomP" require="">
                                        </div>
                                        <div class="divInput input">
                                            <label>Type de produit (Cd, t-shirt ...) : </label>
                                            <input type="text" placeholder="Le type de votre produit..." name="typeP" id="typeP" require="">
                                        </div>
                                        <div class="divInput input">
                                            <label>Description : </label>
                                            <textarea placeholder="La description de votre produit..." name="descriptionP" id="descriptionP" require=""></textarea>
                                        </div>
                                        <div class="divInput iput">
                                            <label>Prix : </label>
                                            <input type="number" placeholder="Le prix de votre produit..." name="prixP" id="prixP" require="">
                                        </div>
                                        <div class="divInput input">
                                            <label>Nombre d'article : </label>
                                            <input type="number" id="nbArticleP" name="nbArticleP" min="0" max="100" value="1" require="">
                                        </div>
                                        <div class="divInput" >
                                            <label>Image :</label>
                                            <input class="file" type="file" name="photoP" accept="image/*" require="">
                                        </div>
                                        <button class="buttonAction" type="submit" value="Valider">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            Valider
                                        </button>
                                    </form>
                                    <div class="alert alert-danger">
                                        <?php
                                        if (isset($_FILES['photoP']['tmp_name']) && isset($_POST['nomP']) && isset($_POST['prixP']) && isset($_POST['descriptionP']) && isset($_POST['typeP']) && isset($_POST['nbArticleP']) && $_POST['nomP'] != NULL && $_POST['prixP'] != 0 && $_POST['descriptionP'] != NULL && $_POST['typeP'] != NULL && $_POST['nbArticleP'] != 0) {
                                            $req = $bdd->prepare('SELECT count(*) AS nbr FROM produit where nom=?');
                                            $req->execute(array($_POST['nomP']));
                                            $donne = $req->fetch(PDO::FETCH_ASSOC);
                                            if ($donne['nbr'] != 0) {
                                                echo '<strong>Information : </strong> Nom dejà utilisé';
                                            } else {
                                                $req = $bdd->prepare('INSERT INTO produit (nom,prix,quantite,note,description,categorie) VALUES (:nom,:prix,:quantite,0,:description,:categorie)');
                                                $req->execute(array(
                                                    'nom' => $_POST['nomP'],
                                                    'prix' => $_POST['prixP'],
                                                    'quantite' => $_POST['nbArticleP'],
                                                    'description' => $_POST['descriptionP'],
                                                    'categorie' => $_POST['typeP'],
                                                ));
                                                $namefi = $_FILES['photoP']['name'];
                                                $namefi = preg_replace('#([a-zA-Z_]*).[a-zA-Z_]*$#', '$1.jpg', $namefi);
                                                $retour = copy($_FILES['photoP']['tmp_name'], '../public/image/boutique/' . $namefi);
                                                if ($retour) {
                                                    echo '<p>La photo a bien été envoyée.</p>';
                                                }
                                            }
                                        } else {
                                            echo '<strong>Information : </strong> Un ou plusieurs champs sont vide';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="divContainerAction">
                                <h4>Supprimer ou Modifier un produit : </h4>
                                <div class="divAction input">
                                    <div class="borderAction">
                                        <div class="divInput">
                                            <div class="rechercheArticle">
                                                <label>Nom : </label>
                                                <?php
                                                $produit = $bdd->query('SELECT nom FROM produit ORDER BY reference DESC');
                                                if (isset($_GET['recherche']) and !empty($_GET['recherche'])) {
                                                    $recherche = htmlspecialchars($_GET['recherche']);
                                                    $produit = $bdd->query('SELECT nom FROM produit WHERE nom LIKE "%' . $recherche . '%" ORDER BY reference DESC');
                                                    if ($produit->rowCount() == 0) {
                                                        $produit = $bdd->query('SELECT nom FROM produit WHERE CONCAT(nom, description) LIKE "%' . $recherche . '%" ORDER BY reference DESC');
                                                    }
                                                }
                                                ?>
                                                <form method="GET">
                                                    <input type="search" name="recherche" placeholder="Recherche un produit ..." />
                                                    <button type="submit" class="button">Search</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div>
                                            <label>Fiche d'identité du produit : </label>
                                            <?php
                                            if ($produit->rowCount() > 0) {
                                                while ($a = $produit->fetch()) {
                                                    $reponse = $bdd->prepare('SELECT * FROM produit WHERE nom=? ORDER BY reference');
                                                    $reponse->execute(array($a['nom']));
                                                    while ($donnees = $reponse->fetch()) {
                                            ?>
                                                    <div  class="ficheIdentiter">
                                                        <div>
                                                            <p>Nom : <label><?php echo $donnees['nom']; ?></label></p>
                                                            <p>Prix : <label><?php echo $donnees['prix']; ?></label></p>
                                                            <p>Description :
                                                                <label><?php echo $donnees['description']; ?></label> </p>
                                                        </div>
                                                        <form method="POST" action="../admin/deleteproduit.php?reference=<?php echo $donnees['reference']; ?>">
                                                            <button class="buttonAction" type="submit">
                                                                <span></span>
                                                                <span></span>
                                                                <span></span>
                                                                <span></span>
                                                                Supprimer
                                                            </button>
                                                        </form>
                                                        <button class="buttonAction">
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            Modifier
                                                        </button>
                                                    </div>
                                            <?php
                                                    }
                                                    $reponse->closeCursor();
                                                }
                                            } else {
                                                echo 'Aucun résultat pour: ' . $recherche . '...';
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
if (isset($_POST['quantiteC']) && isset($_POST['idC']) && $_POST['quantiteC'] != 0 && $_POST['idC'] != 0) {
    $req = $bdd->prepare('UPDATE produit SET quantite=:quantite where reference=:reference');
    $req->execute(array(
        'quantite' => $_POST['quantiteC'],
        'reference' => $_POST['idC'],
    ));
}
?>