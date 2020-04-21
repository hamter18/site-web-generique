<?php
function debug($variable)
{
    echo '<pre>' . print_r($variable, true) . '</pre>';
}

function str_random($length)
{
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

function logged_only()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['auth'])) {
        print("<script type=\"text/javascript\">setTimeout('location=(\"connexion.php\")' ,10);</script>");
        echo "<strong>Information : </strong> Vous n'avez pas le droit d'accéder à cette page";
        exit();
    }
}

function url_custom_encode($titre)
{
    $titre = htmlspecialchars($titre);
    $find = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Œ', 'œ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Š', 'š', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Ÿ', '?', '?', '?', '?', 'Ž', 'ž', '?', 'ƒ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');
    $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');
    $titre = str_replace($find, $replace, $titre);
    $titre = strtolower($titre);
    $mots = preg_split('/[^A-Z^a-z^0-9]+/', $titre);
    $encoded = "";
    foreach ($mots as $mot) {
        if (strlen($mot) >= 3 or str_replace(['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], '', $mot) != $mot) {
            $encoded .= $mot . '-';
        }
    }
    $encoded = substr($encoded, 0, -1);
    return $encoded;
}

function get_pseudo($id)
{
    global $bdd;
    $pseudo = $bdd->prepare('SELECT pseudo FROM membre WHERE id = ?');
    $pseudo->execute(array($id));
    $pseudo = $pseudo->fetch()['pseudo'];
    return $pseudo;
}
function reponse_nbr_categorie($id_categorie)
{
    global $bdd;
    $nbr = $bdd->prepare('SELECT topic_messages.id FROM topic_messages LEFT JOIN topic_topics_categories ON topic_topics_categories.id_topic = topic_messages.id_topic WHERE topic_topics_categories.id_categorie = ?');
    $nbr->execute(array($id_categorie));
    return $nbr->rowCount();
}
function reponse_nbr_topic($id_topic)
{
    global $bdd;
    $nbr = $bdd->prepare('SELECT topic_messages.id FROM topic_messages LEFT JOIN topic ON topic.id = topic_messages.id_topic WHERE topic.id = ?');
    $nbr->execute(array($id_topic));
    return $nbr->rowCount();
}
function derniere_reponse_categorie($id_categorie)
{
    global $bdd;
    $rep = $bdd->prepare('SELECT topic_messages.* FROM topic_messages LEFT JOIN topic_topics_categories ON topic_topics_categories.id_topic = topic_messages.id_topic WHERE topic_topics_categories.id_categorie = ? ORDER BY topic_messages.date_heure_post DESC LIMIT 0,1');
    $rep->execute(array($id_categorie));
    if ($rep->rowCount() > 0) {
        $rep = $rep->fetch();
        $dr = $rep['date_heure_post'];
        $dr .= '<br /> de ' . get_pseudo($rep['id_posteur']);
    } else {
        $dr = 'Aucune réponse...';
    }
    return $dr;
}
function derniere_reponse_topic($id_topic)
{
    global $bdd;
    $rep = $bdd->prepare('SELECT topic_messages.* FROM topic_messages LEFT JOIN topic ON topic.id = topic_messages.id_topic WHERE topic.id = ? ORDER BY topic_messages.date_heure_post DESC LIMIT 0,1');
    $rep->execute(array($id_topic));
    if ($rep->rowCount() > 0) {
        $rep = $rep->fetch();
        $dr = $rep['date_heure_post'];
        $dr .= '<br /> de ' . get_pseudo($rep['id_posteur']);
    } else {
        $dr = 'Aucune réponse...';
    }
    return $dr;
}
