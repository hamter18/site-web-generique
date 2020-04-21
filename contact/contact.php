<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-contact.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
            <div>
                <h2>Contact :</h2>
                <div class="contentAll">
                    <?php
                        $req = $bdd->query('SELECT * FROM parametres WHERE 1');
                        $donnees = $req->fetch()
                    ?>
                    <div class="divContact">
                        <div class="contentInfo">
                            <div class="alignementLogo" class="divContact">
                                <i class="fa fa-phone fa-2x" style="color:black;"></i>
                                <div class="divInfoContact">
                                    <?php echo '<p>Numéro de téléphone : '.$donnees['telephone'].'</br>Du lundi au vendredi de 9:00 à 17:00</p>'; ?>
                                </div>
                            </div>
                            <div class="alignementLogo" class="divContact">
                                <i class="fa fa-envelope-o fa-2x" style="color:black;"></i>
                                <div class="divInfoContact">
                                    <?php echo '<p>E-mail : '.$donnees['email'].'</br>Nous répondons à toutes vos questions dans les 24 heures.</p>'; ?>
                                </div>
                            </div>
                            <div class="divContact">
                                <i class="fa fa-map-marker fa-2x" style="color:black;"></i>
                                <div class="alignementLogo" class="divContact">
                                    <?php echo '<p>Adresse : '.$donnees['adresse'].'</br> Agence ouverte du lundi au vendredi de 9:00 à 12:00 et de 14:00 à 18:30. <a href="../contact/rendezVous.php">Prenez rendez-vous ici !</a></p>'; ?>
                                </div>
                            </div>
                            <div class="divContact">
                                <script type="text/javascript" src="../public/js/minichat.js"></script>
                                <i class="fa fa-comments-o fa-2x" style="color:black;"></i>
                                <div class="alignementLogo" class="divContact">
                                    <p>Chat en ligne </br>Du lundi à dimanche de 9:00 à 22:00. <a class="open-button" onclick="openForm()">Chat</a></p>
                                </div>
                            </div>
                            <div class="divContact">
                                <i class="fa fa-weixin fa-2x" style="color:black;"></i>
                                <div class="alignementLogo" class="divInfoContact">
                                    <p>FAQ </br> Vous trouverez ici toutes les questions les plus fréquentes. <a href="../contact/faq.php">FAQ</a></p>
                                </div>
                            </div>
                            <div class="divContact">
                                <i class="fa fa-question-circle-o fa-2x" style="color:black;"></i>
                                <div class="alignementLogo" class="divInfoContact">
                                    <p>Besoin d'aide ? <a href="#"> Cliquez ici ! </a></p>
                                </div>
                            </div>
                        </div>
                        <div class="contentMap">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d11134.593070028179!2d3.09732377529146!3d45.758196958259525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sfr!4v1579349442536!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        </div>
                    </div>
                    <div class="chat-popup" id="myForm">
                        <div>
                            <?php
                            if (isset($_POST['pseudo']) and isset($_POST['message']) and $_POST['message'] != NULL and $_POST['pseudo'] != NULL) {
                                $req = $bdd->prepare('insert into chatuser(pseudo,message) values(:pseudo,:message)');
                                $req->execute(array(
                                    'pseudo' => $_POST['pseudo'],
                                    'message' => $_POST['message']
                                ));
                                header('Location: ../contact/contact.php');
                            }
                            ?>
                        </div>
                        <div>
                            <form class="formChatt" method='POST' action='../contact/minichat.php'>
                                <a href="../contact/minichat.php" class="enlargeChat"><i class="fa fa-square-o fa-2x" style="color:white;"></i></a>
                                <a onclick="closeForm()" class="closeChat"><i class="fa fa-close fa-2x" style="color:red;"></i></a>
                                <div class="scroller">
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
                                <div class="postChat">
                                    <div class="tchatinfo">
                                        <div class="tchat">
                                            <label for="pseudo">Pseudo : </label>
                                            <input type="text" name="pseudo" id="pseudo">
                                        </div>
                                        <div class="tchat">
                                            <label for="message">Message : </label>
                                            <input type="text" name="message" id="message">
                                        </div>
                                        <div class="tchatBtn">
                                            <button><i class="fa fa-send" style="color:green;"></i></button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <?php include('../footer.php') ?>
</body>

</html>