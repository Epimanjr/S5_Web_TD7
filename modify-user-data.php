<?php

include 'Users.php';

/* Récupération de l'ID */
print_r($_POST);
$id = $_POST['id'];

/* Création de l'utilisateur en fonction de l'ID */
$user = Users::findById($id);

echo $user->name;


