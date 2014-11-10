<?php

include 'Users.php';

/* Récupération de l'ID */
$id = $_POST['id'];

/* Création de l'utilisateur en fonction de l'ID */
$user = Users::findById($id);

echo $user->name;


