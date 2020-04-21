<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-forum.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div class="containerAll">
                <h2>Forum :</h2>
                <?php
                if (isset($_GET['titre'], $_GET['id']) and !empty($_GET['titre']) and !empty($_GET['id'])) {
                    $get_titre = htmlspecialchars($_GET['titre']);
                    $get_id = htmlspecialchars($_GET['id']);
                    $titre_original = $bdd->prepare('SELECT sujet FROM f_topics WHERE id = ?');
                    $titre_original->execute(array($get_id));
                    $titre_original = $titre_original->fetch()['sujet'];
                    if ($get_titre == url_custom_encode($titre_original)) {
                        $topic = $bdd->prepare('SELECT * FROM f_topics WHERE id = ?');
                        $topic->execute(array($get_id));
                        $topic = $topic->fetch();
                        if (isset($_POST['topic_reponse_submit'], $_POST['topic_reponse'])) {
                            $reponse = htmlspecialchars($_POST['topic_reponse']);
                            if (isset($_SESSION['id'])) {
                                if (!empty($reponse)) {
                                    $ins = $bdd->prepare('INSERT INTO f_messages(id_topic,id_posteur,contenu,date_heure_post) VALUES (?,?,?,NOW())');
                                    $ins->execute(array($get_id, $_SESSION['id'], $reponse));
                                    $reponse_msg = "Votre réponse a bien été postée";
                                    unset($reponse);
                                } else {
                                    $reponse_msg = "Votre réponse ne peut pas être vide !";
                                }
                            } else {
                                $reponse_msg = "Veuillez vous connecter ou créer un compte pour poster une réponse";
                            }
                        }
                        if (isset($_GET['page']) and $_GET['page'] > 1) {
                            $reponsesParPage = 6;
                        } else {
                            $reponsesParPage = 5;
                        }
                        $reponsesTotalesReq = $bdd->prepare('SELECT * FROM f_messages WHERE id_topic = ?');
                        $reponsesTotalesReq->execute(array($get_id));
                        $reponsesTotales = $reponsesTotalesReq->rowCount();
                        $pagesTotales = ceil($reponsesTotales / $reponsesParPage);
                        if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $pagesTotales) {
                            $_GET['page'] = intval($_GET['page']);
                            $pageCourante = $_GET['page'];
                        } else {
                            $pageCourante = 1;
                        }
                        $depart = ($pageCourante - 1) * $reponsesParPage;
                        $reponses = $bdd->prepare('SELECT * FROM f_messages WHERE id_topic = ? LIMIT ' . $depart . ',' . $reponsesParPage);
                        $reponses->execute(array($get_id));
                    } else {
                        die('Erreur: Le titre ne correspond pas à l\'id');
                    }
                    require('views/topic.view.php');
                } else {
                    die('Erreur...');
                }
                ?>
                <table class="forum">
                    <tr class="header">
                        <th class="sub-info w10">Auteur</th>
                        <th class="main center">Sujet: <?= $topic['sujet'] ?></th>
                    </tr>
                    <?php if ($pageCourante == 1) { ?>
                        <tr>
                            <td><?= get_pseudo($topic['id_createur']) ?></td>
                            <td><?= $topic['contenu'] ?></td>
                        </tr>
                    <?php } ?>
                    <?php while ($r = $reponses->fetch()) { ?>
                        <tr>
                            <td><?= get_pseudo($r['id_posteur']) ?></td>
                            <td><?= $r['contenu'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <?php
                for ($i = 1; $i <= $pagesTotales; $i++) {
                    if ($i == $pageCourante) {
                        echo $i . ' ';
                    } else {
                        echo '<a href="topic.php?titre=' . $get_titre . '&id=' . $get_id . '&page=' . $i . '">' . $i . '</a> ';
                    }
                }
                ?>
                <br />
                <?php if (isset($_SESSION['id'])) { ?>
                    <form method="POST">
                        <textarea placeholder="Votre réponse" name="topic_reponse" style="width:80%"><?php if (isset($reponse)) {
                                                                                                            echo $reponse;
                                                                                                        } ?></textarea><br />
                        <input type="submit" name="topic_reponse_submit" value="Poster ma réponse"></form>
                    </form>
                    <?php if (isset($reponse_msg)) {
                        echo $reponse_msg;
                    } ?>
                <?php } else { ?>
                    <p>Veuillez vous connecter ou créer un compte pour poster une réponse</p>
                <?php } ?>
            </div>
        </div>
    </main>

    </html>