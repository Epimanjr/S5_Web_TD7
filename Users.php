<?php

include 'Base1.php';

class Users {

    /**
     * Id de l'utilisateur
     * @var type 
     */
    private $user_id;

    /**
     * Nom de l'utilisateur
     * @var type 
     */
    private $name;

    /**
     * Mot de passe de l'utilisateur
     * @var type 
     */
    private $password;

    /**
     * Email de l'utilisateur.
     * @var type 
     */
    private $email;

    /**
     * S'il souhaite recevoir des emails ou non
     * @var type
     */
    private $gets_emails;

    /**
     * Construit un utilisateur.
     */
    public function __construct() {
        
    }

    /**
     * GETTER MAGIQUE 
     * 
     * @param type $attr_name
     * @return type
     */
    public function __get($attr_name) {
        if (property_exists(__CLASS__, $attr_name)) {
            return $this->$attr_name;
        }
    }

    /**
     * SETTER MAGIQUE
     * 
     * @param type $attr_name
     * @param type $attr_val
     */
    public function __set($attr_name, $attr_val) {

        if (property_exists(__CLASS__, $attr_name)) {
            $this->$attr_name = $attr_val;
        }

        //$emess = __CLASS__ . ": unknown member $attr_name (setAttr)";
    }

    /**
     * Permet de mettre à jour un utilisateur dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {

        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->user_id)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }

        $juste = $this->verification();

        if ($juste) {
            /* Connexion à la base */
            $c = Base1::getConnection();

            /* Préparation de la requête */
            $query = $c->prepare("update users set name= ?, password= ?, email= ? where user_id=?");
            $query->bindParam(1, $this->username, PDO::PARAM_STR);
            $query->bindParam(2, $this->password, PDO::PARAM_STR);
            $query->bindParam(3, $this->email, PDO::PARAM_STR);
            $query->bindParam(4, $this->user_id, PDO::PARAM_INT);

            /* Exécution de la requête */
            return $query->execute();
        }
    }

    /**
     * Suppression de l'utilisateur dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->user_id)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }

        /* Connexion à la base de données */
        $c = Base::getConnection();

        /* Préparation de la requête */
        $query = $c->prepare("DELETE FROM users where user_id=?");
        $query->bindParam(1, $this->user_id, PDO::PARAM_INT);

        /* Exécution de la requête */
        return $query->execute();
    }

    /**
     * Recherche d'un utilisateur avec son ID
     * 
     * @param type $id
     * @return \Users
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Base::getConnection();

        /* Préparation de la requête */
        $query = $c->prepare("select * from users where user_id=?");
        $query->bindParam(1, $id, PDO::PARAM_INT);

        /* Exécution de la requête */
        $query->execute();

        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);

        /* Création d'un Objet */
        $user = new Users();
        $user->user_id = $d['user_id'];
        $user->username = $d['username'];
        $user->password = $d['password'];
        $user->email = $d['email'];

        return $user;
    }

    public function verification() {
        $res = true;
        $message = "<p>";
        if (strlen($this->name) < 4) {
            $res = false;
            $message .= "Erreur: le nom doit avoir au moins 4 caractères.<br/>";
        }
        if (strlen($this->password) < 8) {
            $res = false;
            $message .= 'Erreur: le mot de passe doit avoir au moins 8 caractères<br/>';
        }

        $message .= "</p>";

        if ($res == FALSE) {
            echo $message;
        }

        return $res;
    }

}
