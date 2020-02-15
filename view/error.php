<div class="card-panel teal lighten-2">
    <h1>Error</h1>
    <?php 
        if($error==""){
            echo "<h2>Cette page n'existe pas</h2>";
        }else{
            echo '<h2>'. $error.'</h2>';
        }
        ?>
</div>