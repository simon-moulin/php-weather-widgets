<div class="row">

    

    <div class="grid-stack">



        <?php
        foreach ($_SESSION['ville'] as $id => $data) {

            $ville = str_replace('+', ' ', $data);
            echo '
        <div class="grid-stack-item" data-gs-width="2" data-gs-height="2">
        <a style="color:grey" href="index.php?action=delete&controller=ControllerWidget&ville='. $ville .'" alt="Supprimer ce widget">x</a>
            <div style="text-align:center" class="grid-stack-item-content"><i style="font-size:20px; color:#87CEEB" class="wi ' . ModelWidget::getIcon($data) . '"> </i> <br>' . $ville . '<br>' . ModelWidget::getTemp($data);
            if($_SESSION['format']=='metric'){
                echo ' °C';
            }else{
                echo ' °F';
            }
            echo '<br></div>
            
            
            </div>
        ';
        }
        ?>

    </div>
</div>