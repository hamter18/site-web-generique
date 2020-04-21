<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-forum.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div class="containerAll">
                <h2>Forum :</h2>
                <?php
                if (isset($_GET['categorie']) and !empty($_GET['categorie'])) {
                    $get_categorie = htmlspecialchars($_GET['categorie']);
                    $categories = array();
                    $req_categories = $bdd->query('SELECT * FROM topic_categories');
                    while ($c = $req_categories->fetch()) {
                        array_push($categories, array($c['id'], url_custom_encode($c['nom'])));
                        echo 'HELLO1';
                    }
                    foreach ($categories as $cat) {
                        if (in_array($get_categorie, $cat)) {
                            $id_categorie = intval($cat[0]);
                        }
                        echo 'HELLO2';
                    }
                    if (@$id_categorie) {
                        if (isset($_GET['souscategorie']) and !empty($_GET['souscategorie'])) {
                            $get_souscategorie = htmlspecialchars($_GET['souscategorie']);
                            $souscategories = array();
                            $req_souscategories = $bdd->prepare('SELECT * FROM topic_souscategories WHERE id_categorie = ?');
                            $req_souscategories->execute(array($id_categorie));
                            while ($c = $req_souscategories->fetch()) {
                                array_push($souscategories, array($c['id'], url_custom_encode($c['nom'])));
                            }
                            foreach ($souscategories as $cat) {
                                if (in_array($get_souscategorie, $cat)) {
                                    $id_souscategorie = intval($cat[0]);
                                }
                                echo 'HELLO3';
                            }
                        }
                        $req = "SELECT * FROM topic
                             LEFT JOIN topic_topicscategories ON topic.id = topic_topicscategories.id_topic 
                             LEFT JOIN topic_categories ON topic_topicscategories.id_categorie = topic_categories.id
                             LEFT JOIN topic_souscategories ON topic_topicscategories.id_souscategorie = topic_souscategories.id
                             LEFT JOIN membre ON topic.id_createur = membre.id
                             WHERE topic_categories.id = ?";
                        echo 'HELLO4';
                        if (@$id_souscategorie) {
                            $req .= " AND topic_souscategories.id = ?";
                            $exec_array = array($id_categorie, $id_souscategorie);
                        } else {
                            $exec_array = array($id_categorie);
                        }
                        echo 'HELLO5';
                        $req .= " ORDER BY topic.id DESC";
                        print_r($exec_array);
                        echo 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
                        $topics = $bdd->prepare($req);
                        $topics->execute($exec_array);
                    } else {
                        die('Erreur: Catégorie introuvable...');
                    }
                } else {
                    die('Erreur: Aucune catégorie sélectionnée...');
                }
                print_r($topics);

                echo 'HELLO6';
                ?>
                <table class="forum">
                    <tr class="header">
                        <th class="main">Sujet</th>
                        <th class="sub-info w10">Messages</th>
                        <th class="sub-info w20">Dernier message</th>
                        <th class="sub-info w20">Création</th>
                    </tr>
                    <?php while ($t = $topics->fetch()) { ?>
                        <tr>
                            <td class="main">
                                <h4><a href=""><?= $t['sujet'] ?></a></h4>
                            </td>
                            <td class="sub-info">4083495</td>
                            <td class="sub-info">25.12.2015 à 18h07<br />de PrimFX</td>
                            <td class="sub-info"><?= $t['date_heure_creation'] ?><br />par <?= $t['pseudo'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </main>

    </html>