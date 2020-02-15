<?php

require_once File::build_path(array("model","Model.php"));

class ModelUtilisateur{

    private $email;
    private $password;
    private $format;

    public function __construct($data = NULL){
            if (!is_null($data) && !empty($data)) {
    
                foreach ($data as $key => $value) {
                    $this->$key = $value;
                }
            }
        }

        public function getEmail(){
            return $this->email;
        }

        public function getMdp(){
            return $this->mdp;
        }

        public function getFormat(){
            return $this->format;
        }


        public static function getUserByEmail($email)
        {
            $sql = "SELECT * from utilisateur WHERE email=:email";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "email" => $email,
                //nomdutag => valeur, ...
            );
            // On donne les valeurs et on exécute la requête
            $req_prep->execute($values);

            // On récupère les résultats comme précédemment
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
            $tab_prod = $req_prep->fetchAll();
            // Attention, si il n'y a pas de résultats, on renvoie false
            if (empty($tab_prod))
                return false;
            return $tab_prod[0];
        }

        public static function checkPassword($email, $mdpChiffrer){
            $sql = "SELECT * FROM utilisateur WHERE `email`=:email AND `password`=:password";
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "email" => $email,
                "password" => $mdpChiffrer
            );

            $req_prep->execute($values);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelUtilisateur");
            $tab = $req_prep->fetchAll();

            if(empty($tab)){
                return false;
            }else{
                return true;
            }


        }

        public function save()
        {
            $sql = "INSERT INTO `utilisateur` (`email`, `password`, `format`) VALUES (:email, :password, :format);";
            try {
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                    "email" => $this->email,
                    "password" => $this->password,
                    "format" => $this->format
                );
    
                $req_prep->execute($values);
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    return false;
                }
            }
            return true;
        }

        public static function updatePref($format){

            $sql = "UPDATE utilisateur SET format=:format WHERE email=:email";
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "email" => $_SESSION['login'],
                "format" => $format
            );
            $req_prep->execute($values);

            $_SESSION['format'] =$format;

        }

        public static function updateWidgets(){

            $sql = "SELECT Ville FROM widget WHERE `emailUtilisateur`=:email";
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "email" => $_SESSION['login'],
            );

            $req_prep->execute($values);
            $tab = $req_prep->fetchAll();

            $_SESSION['ville'] =array();

            foreach($tab as $value){
                array_push($_SESSION['ville'],$value['Ville']);
            }
            
        }




}
?>