<?php

require_once File::build_path(array("controller","ControllerWidget.php"));
require_once File::build_path(array("controller","ControllerUtilisateur.php"));

if(isset($_GET['action']) && isset($_GET['controller'])){
    $action = $_GET['action'];
    $controller = $_GET['controller'];
    $availableActions = get_class_methods($controller);
    if (in_array($action, $availableActions)) {
        $controller::$action();
    }
    else {
        ControllerWidget::showError("Cette page n'existe pas");
    }
}
else {
    ControllerWidget::readAll();
}
?>