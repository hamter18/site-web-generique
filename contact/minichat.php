<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-minichat.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div class="containerAll">
                <h2>Mini chatt :</h2>
                <div>
                    <?php
                    if (isset($_POST['pseudo']) and isset($_POST['message']) and $_POST['message'] != NULL and $_POST['pseudo'] != NULL) {
                        $req = $bdd->prepare('insert into chatuser(pseudo,message,date_envoi) values(:pseudo,:message,now())');
                        $req->execute(array(
                            'pseudo' => $_POST['pseudo'],
                            'message' => $_POST['message']
                        ));
                        header('Location: ../contact/contact.php');
                    }
                    ?>
                </div>
                <div class="divChat">
                    <script type="text/javascript" src="../public/js/event.js"></script>
                    <form class="formChatt" method='POST' action='contact/minichat.php'>
                        <div>
                            <div class="scroller">
                                <p>Discussion :</p>
                                <?php
                                $reponse = $bdd->query('select * from chatuser order by id desc') or die(print_r($bdd->errorInfo()));
                                while ($donnees = $reponse->fetch()) {
                                    echo '
                                        <div class="containerMsg">
                                            <div class="Avatar">
                                                <img src="../public/image/web/placeholder.jpg" alt="Avatar">
                                                <label>' . $donnees['pseudo'] . '</label>
                                            </div>
                                            <p>' . $donnees['message'] . '</p>
                                            <span class="time-right">' . $donnees['date_envoi'] . '</span>
                                        </div> ';
                                    $donnees = $reponse->fetch();
                                    echo '
                                        <div class="containerMsg darker">
                                            <div class="Avatar">
                                                <img src="../public/image/web/placeholder.jpg" alt="Avatar" class="right">
                                                <label  class="right">' . $donnees['pseudo'] . '</label>
                                            </div>
                                            <p>' . $donnees['message'] . '</p>
                                            <span class="time-left">' . $donnees['date_envoi'] . '</span>
                                        </div> ';
                                }
                                $reponse->closeCursor();
                                ?>
                            </div>
                            <div>
                                <p>Pour envoyer un message :</p>
                                <label for="pseudo">Pseudo : </label>
                                <input type="text" name="pseudo" id="pseudo">

                                <label for="message">Message : </label>
                                <input type="text" name="message" id="message">

                                <input type="submit">
                                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                                <br>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>