<form method="post" action="index.php?action=modifPref&controller=ControllerWidget" enctype="multipart/form-data">
    <fieldset>
        <legend>Modification des préférences : </legend>
        <p>
            Format :

            <label>
                <?php 
                echo'<input name="format" type="radio" value="metric"';

                if($preference =="metric"){
                    echo 'checked';
                }
                echo ' />';
                ?>
                <span>Celsius</span>
            </label>

            <label>

            <?php 
                echo'<input name="format" type="radio" value="imperial"';

                if($preference =="imperial"){
                    echo 'checked';
                }
                echo ' />';
                ?>
                <span>Fahrenheit</span>
            </label>
            <p>
                <input type="submit" value="Valider" />
            </p>
    </fieldset>
</form>