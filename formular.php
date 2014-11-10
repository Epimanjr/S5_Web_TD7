<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Formulaire</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="style.css"/>
  </head>
	
  <body>
    <div id="main">
	
	  <!-- Connection panel -->
	  <div class="panel">
	  
	    <b>Connexion</b>
		
	    <form action="#" method="post">
		  <div class="column">
		    <span class="simplelabel">Identifiant</span>
			<input type="text" id="identifiant" size="20"/>
		  </div>
			
		  <div class="column">
			<span class="simplelabel">Mot de passe</span>
			<input type="password" name="mdp"/>
		  </div>
		  
		  <div class="column">
		    <input type="button" value="Connexion"/>
		  </div>
		</form>
	  </div>

	  <!-- Registration panel -->
	  <div class="panel">

        <b>Inscription</b>
	  
		<form action="registration.php" method="post">
		  <div class="column">
		    <span class="label">Nom d'utilisateur</span>
			<input type="text" name="username" />
			<br/>
			<span class="label">Mot de passe</span>
			<input type="password" name="password" />
			<br/>
			<span class="label">Confirmation</span>
			<input type="password" name="confirmation" />
			<br/>
			<span class="label">Adresse email</span>
			<input type="text" name="email" />
		  
		    <p>
		      <input type="checkbox" name="get_emails"/>Recevoir des mails de la part du site
		    </p>
			
		  </div>
		  
		  <div class="column">
		    <div>
			  Vos genres de musique préférés :
		    </div>
		
		    <p>
			  <input type="checkbox" name="genres[]" value="blues"/><span class="genre">Blues</span>
			  <input type="checkbox" name="genres[]" value="classique"/><span class="genre">Classique</span>
			  <input type="checkbox" name="genres[]" value="country"/><span class="genre">Country</span>
			  <br/>
			  <input type="checkbox" name="genres[]" value="electro"/><span class="genre">Electro</span>
			  <input type="checkbox" name="genres[]" value="hiphop"/><span class="genre">Hip Hop</span>
			  <input type="checkbox" name="genres[]" value="jazz"/><span class="genre">Jazz</span>
			  <br/>
			  <input type="checkbox" name="genres[]" value="metal"/><span class="genre">Metal</span>
			  <input type="checkbox" name="genres[]" value="pop"/><span class="genre">Pop</span>
			  <input type="checkbox" name="genres[]" value="reggae"/><span class="genre">Reggae</span>
			  <br/>
			  <input type="checkbox" name="genres[]" value="rnb"/><span class="genre">RNB</span>
			  <input type="checkbox" name="genres[]" value="rock"/><span class="genre">Rock</span>
			  <input type="checkbox" name="genres[]" value="soul"/><span class="genre">Soul</span>
            </p>
		  
		  </div>
		  
		  <p>
		    <input type="submit" value="S'inscrire" />
		  </p>			
		</form>
	  </div>
	</div>
  </body>
</html>