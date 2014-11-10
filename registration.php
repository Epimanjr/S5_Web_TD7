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
  
  $valid = true;
  $message = "";
  
  // Check user name
  if (!isset($_POST['username']) || strlen($_POST['username']) < 4){
    $valid = false;
    $message .= '<p class="error">Le nom d\'utilisateur est trop court.</p>';
  }
  else{
    $username = $_POST['username'];  
  }
  
  // Check password  
  if (!isset($_POST['password']) || strlen($_POST['password']) < 8){
    $valid = false;
    $message .= '<p class="error">Le mot de passe est trop court.</p>';
  }
  else{
    $password = $_POST['password'];
	
    // Check password confirmation
    if (!isset($_POST['confirmation']) || $_POST['confirmation'] != $password){
      $valid = false;
      $message .= '<p class="error">Le mot de passe et sa confirmation ne sont pas identiques.</p>';
    }	
  }
  
  // Check email
  if (!isset($_POST['email']) || !contains('@', $_POST['email']) || !contains('.', $_POST['email'])){
    $valid = false;
	$message .= '<p class="error">L\'email entré est invalide.</p>';
  }
  else{
    $email = $_POST['email'];
  }
  
  // Check genres
  if (!isset($_POST['genres']) || sizeof($_POST['genres']) < 2){
    $valid = false;
	$message .= '<p class="error">Le nombre de genres sélectionné est insuffisant.</p>';
  }
  else{
    $genres = $_POST['genres'];
  }

  // Check the availability of the user name
  if ($valid){
	$available = checkUserName($username);
	if (!$available){
	  $valid = false;
	  $message .= '<p class="error">Le nom d\'utilisateur '.$username.' est déjà pris.</p>';
	}
  }

  // All the criteria were respected, add user
  if ($valid){
    echo "<p>Les champs ont été validés par le serveur.<p/>";
	
	// Password encryption
	$cryptedPw = md5($password);
	
    // Gets emails?
    if (isset($_POST['get_emails']) && $_POST['get_emails'] == "on"){
      $get_emails = true;
    }
    else{
      $get_emails = false;
    }

	// Add user to the database
	$userOK = addUser($username, $email, $cryptedPw, $get_emails);
	
	if ($userOK){
	  // Add user genres
      $userid = mysql_insert_id();
	  $genresOK = addGenres($userid, $genres);
	
	  if ($genresOK){
	    echo "<p>L'inscription a été réalisée avec succès.</p>";
	  }
    }
  }
  
  // At least one criterion was not respected, display error messages
  else{
    echo "<p class=\"error\">L'inscription n'a pas pu être validée pour les raisons suivantes :</p>";
    echo $message;	
	echo '<p><a href="formular.php">Retour vers le formulaire d\'inscription.</a></p>';
  }
  ?>
  
  </div>
  </div>
  </body>
</html>

<?php
  /**
   * Test if the character $c is in the string $s.
   */
  function contains($c, $s){
    for ($i = 0; $i < strlen($s); $i++){
	  if ($s[$i] == $c){
	    return true;
	  }
	}
	return false;
  }
  
  /**
   * Check the availability of a user name.
   */
  function checkUserName($username){
    $result = mysql_query("SELECT COUNT(*) > 0 FROM users WHERE name = '".$username."'");
	$row = mysql_fetch_row($result);
	return !$row[0];
  }

  /**
   * Put the user and its genres in the database.
   */  
  function addUser($username, $email, $cryptedPw, $get_emails){
	$OK = mysql_query("INSERT INTO users (name, email, password, gets_emails) VALUES('".$username."', '".$email."', '".$cryptedPw."', '".$get_emails."')");
	return $OK;
  }
  
  /**
   * Put the genres of a user in the database.
   */
  function addGenres($userid, $genres){
    for ($i = 0; $i < sizeof($genres); $i++){
	  $OK = mysql_query("INSERT INTO users_genres (user_id, genre) VALUES('".$userid."', '".$genres[$i]."')");
	  if (!$OK){
	    return false;
	  }
	}
	return true;
  }
?>