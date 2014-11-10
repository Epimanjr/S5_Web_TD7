<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Enregistrement</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="style.css"/>
    </head>

    <body>
        <div id="main">
            <?php
            include 'Users.php';

            /* Récupération de l'ID */
            $id = $_POST['id'];

            /* Création de l'utilisateur en fonction de l'ID */
            $user = Users::findById($id);

            global $nom, $email;
            $nom = $user->name;
            $email = $user->email;
            ?>

            <!-- Registration panel -->
            <div class="panel">

                <b>Inscription</b>

                <form action="registration.php" method="post">
                    <div class="column">
                        <span class="label">Nom d'utilisateur</span>
                        <input type="text" name="username" value="<?php echo $nom ?>" />
                        <br/>
                        <span class="label">Adresse email</span>
                        <input type="text" name="email" value="<?php echo $email ?>" />
                    </div>

                    <p>
                        <input type="submit" value="S'inscrire" />
                    </p>			
                </form>
            </div>


        </div>
    </body>
</html>
