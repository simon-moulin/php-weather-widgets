<?php

require_once File::build_path(array("model", "ModelWidget.php"));


class ControllerWidget
{

    public static function readAll(){

        ModelUtilisateur::updateWidgets();

        if($_SESSION['logged']=='false'){
            ControllerUtilisateur::connect();
        }else{
            $controller = 'widget';
            $view = 'list';
            $pagetitle = 'Liste des widgets';
            require(File::build_path(array("view", "view.php")));
        }
    }

    public static function showError($err)
    {
        $controller = "";
        $view = 'error';
        $pagetitle = 'Erreur !';
        $error = $err;
        require(File::build_path(array("view", "view.php")));
    }

    public static function create()
    {

        $controller = 'widget';
        $view = 'create';
        $pagetitle = 'Ajouter un widget';
        require(File::build_path(array("view", "view.php")));
    }
    public static function created()
    {

        
        $ville = str_replace(" ", "+",$_POST['ville']);

        $ok = ModelWidget::addWidget($ville);
        if($ok){
            ModelUtilisateur::updateWidgets();
            self::readAll();
        }else{
            self::showError("Impossible d'ajouter ce widget, cette ville n'as pas été trouvée ou apparait deja sur votre Dashboard");
        }
    }

    public static function delete(){
        $ville = str_replace(" ", "+",$_GET['ville']);

        $ok = ModelWidget::remove($ville);
        if($ok){
            ModelUtilisateur::updateWidgets();
            self::readAll();
        }else{
            self::showError("Impossible de supprimer ce widget");
        }
    }

    public static function pref()
    {
        $controller = 'widget';
        $view = 'pref';
        $pagetitle = 'Préférences';
        $user = ModelUtilisateur::getUserByEmail($_SESSION['login']);
        $preference = $user->getFormat();

        require(File::build_path(array("view", "view.php")));

    }

    public static function modifPref()
    {
        ModelUtilisateur::updatePref($_POST['format']);
        $_SESSION['format'] = $_POST['format'];
        self::readAll();
    }
}
