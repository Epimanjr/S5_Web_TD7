<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Enregistrement</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="style.css"/>
    </head>

    <body>
        <div id="main">
            <div class="panel">

                <?php
                require('base.php');

                /* Script qui permet de vérifier que le nom d'utilisateur et le mot de passe figurent dans la base de données */
                include 'base.php';

                /* Récupération des variables du formulaire */
                $id = $_POST['id'];
                $password = $_POST['mdp'];

                /* Cryptage du mot de passe */
                $passcrypte = md5($password);

                /* Sélection dans la base */
                $resquery = mysql_query("SELECT COUNT(*) > 0 FROM users WHERE name='" . $id . "' AND password='" . $passcrypte . "'");
                $row = mysql_fetch_row($resquery);
                if (!$row[0]) {
                    echo "Erreur.";
                } else #
                    echo "Connecté !";
                afficheUtilisateur($id);
                ?>
                
                <form action ="modify-user-data.php">
                    <input type="hidden" name="id" value="<?php $_POST['id'] ?>"/>
                    <input type="submit" Value="Modifier Informations"/>
                </form>

            </div>
        </div>
    </body>
</html>

<?php

function afficheUtilisateur($id) {
    $resquery = mysql_query("SELECT email, gets_emails, user_id FROM users WHERE name='" . $id . "'");
    $row = mysql_fetch_row($resquery);
    echo "</br>Nom d'utilisateur : " . $id;
    echo "</br>Email : " . $row[0];
    if ($row[1] == 0) {
        echo "</br>Recevoir les emails : Non";
    } else {
        echo "</br>Recevoir les emails : Oui";
    }

    /* Requête pour sélectionner tous les genres choisis par l'utilisateur */
    $resquery = mysql_query("SELECT genre FROM users_genres WHERE user_id=" . $row[2]);
    $row = mysql_fetch_row($resquery);

    /* Parcours du tableau pour afficher ses genres */
    echo "</br>Mes genres :";
    foreach($row as $i => $value) {
        echo "<ul>";
        echo "<li>" . $value . "</li>";
        echo "</ul>";
    }
}

?>
