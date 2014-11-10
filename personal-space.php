<?php

/* Script qui permet de vérifier que le nom d'utilisateur et le mot de passe figurent dans la base de données */
include 'base.php';
echo "BONJOUR";

/* Récupération des variables du formulaire */
$id = $_POST['id'];
$password = $_POST['mdp'];

/* Cryptage du mot de passe */
$passcrypte = md5($password);

/* Sélection dans la base */
$resquery = mysql_query("SELECT COUNT(*) > 0 FROM users WHERE name='" . $id . "' AND password='" . $passcrypte . "'");
$row = mysql_fetch_row($resquery);
if(!$row[0]) {
    echo "Erreur.";
} else #
    echo "Done.";

/* Comparaison */
