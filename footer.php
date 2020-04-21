<footer>
    <div class="footer-gauche">
        <?php
        $req = $bdd->query('SELECT nomDuSite FROM parametres WHERE 1');
        $donnees = $req->fetch();
        echo '<h3>'.$donnees['nomDuSite'].'</h3>';
        ?>
        <h4>Copyright © Tous droits réservés.</h4>
        <div>
            <a href="#">Français</a>
        </div>
    </div>
    <div class="footer-droite">
        <div class="footer-alignement">
            <div class="footer-reseau">
                <div>
                    <h3>Nous suivre :</h3>
                    <a href="https://www.facebook.com/villedeclermontferrand/" class="fa fa-facebook"></a>
                    <a href="https://www.instagram.com/villedeclermontfd/" class="fa fa-instagram"></a>
                    <a href="https://www.linkedin.com/company/ville-de-clermont-ferrand/" class="fa fa-linkedin"></a>
                    <a href="https://www.youtube.com/user/TV8Clermont" class="fa fa-youtube"></a>
                </div>
            </div>
            <div class="footer-newsletter">
                <h3>Abonnez-vous à la Newsletter : </h3>
                <div>
                    <form method="POST" action="../contact/newsletter.php">
                        <input type="email" id="mail" name="mail" placeholder="Veuillez entrer votre addresse e-mail" size="40">
                        <input type="submit" name="" value="Go !">
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-bas">
            <?php 
                echo '<a href="../portefolio/portefolio.php">A propos de '.$donnees['nomDuSite'].'</a>'
            ?>
            <a href="../contact/contact.php">Contact</a>
            <a href="../politiquecookies.php">Politique sur les cookies</a>
            <a href="../conditionutilisation.php">Conditions d'utilisation</a>
        </div>
    </div>
</footer>