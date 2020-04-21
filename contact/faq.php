<?php include('../head.php') ?>
<link rel="stylesheet" href="../public/css/style-faq.css">

<body>
    <?php include('../header-image.php') ?>
    <main>
        <div class="container">
        <?php
            $query = 'SELECT id, question, reponse FROM faq ORDER BY id';
            $sql = $bdd->query($query);
            $nb_questions = $sql->rowCount();
            if ($nb_questions == 0) {
                echo '<label>Aucunne question dans cette FAQ</label>';
            } else {
                while ($data = $sql->fetch()) {
                    echo '<section class="faq-section">';
                    echo '<input type="checkbox" id="q', $data['id'], '">';
                    echo '<label for="q',$data['id'],'">';
                    echo $data['question'];
                    echo '</label>';
                    echo '<p>';
                    echo $data['reponse'];
                    echo '</p>';
                    echo '</section>';
                    echo '<br/>';
                }
            }
        ?>
        </div>
    </main>
    <?php include('../footer.php') ?>
</body>
</html>