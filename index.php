<?php
$ROOT_FOLDER = __DIR__;
$DS = DIRECTORY_SEPARATOR;
require_once $ROOT_FOLDER.$DS.'lib'. $DS.'File.php';


session_start();

if(!isset($_SESSION['format'])){
    $_SESSION = array(
        "logged" => "false",
        "login" => "",
        "format" => "metric",
        "ville" => array(

        )
    );
}

require File::build_path(array("controller","routeur.php"));
?>