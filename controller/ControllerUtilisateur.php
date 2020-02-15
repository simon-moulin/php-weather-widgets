<?php

require_once File::build_path(array("model", "ModelUtilisateur.php"));
require_once File::build_path(array("lib","Security.php"));


class ControllerUtilisateur{

    public static function create(){
        $controller = "utilisateur";
        $view = 'create';
        $pagetitle = "Creation d'un utilisateur";

        require(File::build_path(array("view", "view.php")));
    }

    public static function created(){

        if(($_POST['password'])!= ($_POST['verifpassword'])){
            self::create();
        }else{


        $val = array(
            "email" => $_POST['email'],
            "password" => Security::chiffrer($_POST['password']),
            "format" => $_POST['format']
        );

        $u = new ModelUtilisateur($val);
        $saveEx = $u->save();

        if ($saveEx == false) {
            $controller = "";
            $view = 'error';
            $pagetitle = "Erreur lors de l'insert!";
            $error="L'utilisateur existe déjà!";
            require(File::build_path(array("view", "view.php")));
        }else{

            ControllerWidget::readAll();
        }

    }
    }

    public static function connect(){
        $controller="utilisateur";
        $view="connect";
        $pagetitle = "Page de connexion :";
        
        require(File::build_path(array("view", "view.php")));
    }

    public static function disconnect(){
        session_unset();
        session_destroy();
        setcookie(session_name(),'', time()-1);

        $_SESSION = array(
            "logged" => "false",
            "format" => "metric",
            "login" => "",
            "ville" => array(
    
            )
        );

        ControllerWidget::readAll();
    }

    public static function connected(){
        $controller="widget";
        $view="list";
        $pagetitle = "Connecté!";

        $email = $_POST['email'];
        $password = Security::chiffrer($_POST['password']);

        if(ModelUtilisateur::checkPassword($email, $password)){
            $_SESSION['login'] = $email;
            $_SESSION['logged'] = 'true';



            $user = ModelUtilisateur::getUserByEmail($email);
            $_SESSION['format'] = $user->getFormat();
            ModelUtilisateur::updateWidgets();
            ControllerWidget::readAll();
        }else{
            self::connect();
        }
    }

}

?>