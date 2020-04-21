<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-forum.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div class="containerAll">
                <h2>Forum :</h2>
                <?php
                if (isset($_GET['categorie'])) {
                    $get_categorie = htmlspecialchars($_GET['categorie']);
                    $categorie = $bdd->prepare('SELECT * FROM topic_categories WHERE id = ?');
                    $categorie->execute(array($get_categorie));
                    $cat_exist = $categorie->rowCount();
                    if ($cat_exist == 1) {
                        $categorie = $categorie->fetch();
                        $categorie = $categorie['nom'];
                        $souscategories = $bdd->prepare('SELECT * FROM topic_souscategories WHERE id_categorie = ? ORDER BY nom');
                        $souscategories->execute(array($get_categorie));
                        if (isset($_SESSION['id'])) {
                            if (isset($_POST['tsubmit'])) {
                                if (isset($_POST['tsujet'], $_POST['tcontenu'])) {
                                    $sujet = htmlspecialchars($_POST['tsujet']);
                                    $contenu = htmlspecialchars($_POST['tcontenu']);
                                    $souscategorie = htmlspecialchars($_POST['souscategorie']);
                                    $verify_sc = $bdd->prepare('SELECT id FROM topic_souscategories WHERE id = ? AND id_categorie = ?');
                                    $verify_sc->execute(array($souscategorie, $get_categorie));
                                    $verify_sc = $verify_sc->rowCount();
                                    if ($verify_sc == 1) {
                                        if (!empty($sujet) and !empty($contenu)) {
                                            if (strlen($sujet) <= 70) {
                                                if (isset($_POST['tmail'])) {
                                                    $notif_mail = 1;
                                                } else {
                                                    $notif_mail = 0;
                                                }
                                                $ins = $bdd->prepare('INSERT INTO topic (id_createur, sujet, contenu, notif_createur, date_heure_creation) VALUES(?,?,?,?,NOW())');
                                                $ins->execute(array($_SESSION['id'], $sujet, $contenu, $notif_mail));

                                                $lt = $bdd->query('SELECT id FROM topic ORDER BY id DESC LIMIT 0,1');
                                                $lt = $lt->fetch();
                                                $id_topic = $lt['id'];
                                                $ins = $bdd->prepare('INSERT INTO topic_topics_categories (id_topic, id_categorie, id_souscategorie) VALUES (?,?,?)');
                                                $ins->execute(array($id_topic, $get_categorie, $souscategorie));
                                            } else {
                                                $terror = "Votre sujet ne peut pas dépasser 70 caractères";
                                            }
                                        } else {
                                            $terror = "Veuillez compléter tous les champs";
                                        }
                                    } else {
                                        $terror = "Sous-catégorie invalide";
                                    }
                                }
                            }
                        } else {
                            $terror = "Veuillez vous connecter pour poster un nouveau topic";
                        }
                    } else {
                        die('Catégorie invalide...');
                    }
                } else {
                    die('Aucune catégorie définie...');
                }
                ?>
                <form class="fntopic" method="POST">
                    <table class="forum ntopic">
                        <tr class="header">
                            <th class="main">Nouveau Topic</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>Sujet</td>
                            <td><input type="text" name="tsujet" size="70" maxlength="70" /></td>
                        </tr>
                        <tr>
                            <td>Catégorie</td>
                            <td>
                                <?= $categorie ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Sous-Catégorie</td>
                            <td>
                                <select name="souscategorie">
                                    <?php while ($sc = $souscategories->fetch()) { ?>
                                        <option value="<?= $sc['id'] ?>"><?= $sc['nom'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Message</td>
                            <td><textarea name="tcontenu"></textarea></td>
                        </tr>
                        <tr>
                            <td>Me notifier des réponses par mail</td>
                            <td><input type="checkbox" name="tmail" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" name="tsubmit" value="Poster le Topic" /></td>
                        </tr>
                        <?php if (isset($terror)) { ?>
                            <tr>
                                <td colspan="2"><?= $terror ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </form>
            </div>
        </div>
    </main>

    </html>