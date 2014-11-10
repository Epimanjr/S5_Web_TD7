<?php

include 'Users.php';

/* Récupération de l'ID */
$id = $_POST['id'];

/* Création de l'utilisateur en fonction de l'ID */
$user = Users::findById($id);

$user->nom = $_POST['id'];
$user->email = $_POST['email'];

$user->update();

?>