<?php include('../head.php') ?>

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <h1> Ajouter une adresse :</h1>
            <form method="POST" enctype="multipart/form-data" action="../membreNA/ajouterAdresse.php">
                <label for="rue">Rue : </label><input type="text" name="rue" id="rue" placeholder="Rue" required="" />
                <label for="complementAdresse">Complement d'adresse : </label><input type="text" name="complementAdresse" id="complementAdresse" placeholder="Complement d'adresse :" />
                <label for="codePostal">Code postal : </label><input type="number" name="codePostal" id="codePostal" placeholder="Code postal" required="" />
                <label for="ville">Ville : </label><input type="text" name="ville" id="ville" placeholder="Ville" required="" />
                <label for="pays">Pays : </label><input type="text" name="pays" id="pays" placeholder="Pays" required="" />
                <button type="submit">Ajouter</button>
            </form>

            <div>
                <?php
                if (isset($_POST['rue']) && isset($_POST['codePostal']) && isset($_POST['ville']) && isset($_POST['pays']) && $_POST['rue'] != NULL && $_POST['codePostal'] != NULL && $_POST['ville'] != NULL  && $_POST['pays'] != NULL) {
                    $req = $bdd->prepare('INSERT INTO adresse (idUtilisateur,rue,complementAdresse,codePostal,ville,pays) VALUES (:idUtilisateur,:rue,:complementAdresse,:codePostal,:ville,:pays)');
                    $req->execute(array(
                        'idUtilisateur' => $_SESSION['id'],
                        'rue' => $_POST['rue'],
                        'complementAdresse' => $_POST['complementAdresse'],
                        'codePostal' => $_POST['codePostal'],
                        'ville' => $_POST['ville'],
                        'pays' => $_POST['pays'],
                    ));
                    header('location: ../membreNA/mesAdresses.php');
                } else {
                    echo '<strong>Information : </strong> Un ou plusieurs champs sont vide';
                }
                ?>
            </div>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>