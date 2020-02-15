<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?php echo $pagetitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="styles/view.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/css/weather-icons.css">
    <link rel="stylesheet" href="styles/css/weather-icons-wind.css">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gridstack@latest/dist/gridstack.all.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@latest/dist/gridstack.min.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <header>
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">Dashboard météo</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <?php

                    if ($_SESSION['logged'] == 'false') {
                        echo '
                                <li><a href="index.php?action=connect&controller=ControllerUtilisateur">Connexion</a></li>
                                <li><a href="index.php?action=create&controller=ControllerUtilisateur">Créer un compte</a></li>';
                    } else {
                        echo  '
                                <li><a href="index.php?action=readAll&controller=ControllerWidget">Mes Widgets</a></li>
                                <li><a href="index.php?action=create&controller=ControllerWidget">Ajouter un widget</a></li>
                                <li><a href="index.php?action=pref&controller=ControllerWidget">Préférences</a></li>
                                <li><a href="index.php?action=disconnect&controller=ControllerUtilisateur">Déconnexion</a></li>';
                    }

                    ?>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
        <?php

if ($_SESSION['logged'] == 'false') {
    echo '
            <li><a href="index.php?action=connect&controller=ControllerUtilisateur">Connexion</a></li>
            <li><a href="index.php?action=create&controller=ControllerUtilisateur">Créer un compte</a></li>';
} else {
    echo  '
            <li><a href="index.php?action=readAll&controller=ControllerWidget">Mes Widgets</a></li>
            <li><a href="index.php?action=create&controller=ControllerWidget">Ajouter un widget</a></li>
            <li><a href="index.php?action=pref&controller=ControllerWidget">Préférences</a></li>
            <li><a href="index.php?action=disconnect&controller=ControllerUtilisateur">Déconnexion</a></li>';
}

?>
        </ul>
    </header>

    <main>
        <div class="container">
            <?php
            $filepath = File::build_path(array("view", $controller, "$view.php"));
            require $filepath;
            ?>
        </div>
    </main>
    <footer class="page-footer">
        <div class="container">
            © 2019 Copyright Text
        </div>
    </footer>

    <!--    Js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


    <script>
        M.AutoInit();
        $(document).ready(function(){
        $('.sidenav').sidenav();
  });
        
    </script>
    <script type="text/javascript">
        $('.grid-stack').gridstack();
    </script>
</body>

</html>