<form method="post" action="index.php?action=created&controller=ControllerUtilisateur">
    <fieldset>
        <legend>Crée un compte : </legend>
        <p>
            <label for="email">Email :</label>
            <input type="email" placeholder="Ex : totodu34@gmail.com" name="email" id="email" required />
            <br>
            <label for="password">Mot de passe</label>
            <input type="password" placeholder="Ex : *****" name="password" id="password" required />
            <br>

            <label for="verifpassword">Retapez votre mot de passe</label>
            <input type="password" value="" placeholder="Ex : *****" name="verifpassword" id="verifpassword" required />
            <br>
            <input type='hidden' name='format' value='metric'>

            <p>
                <input type="submit" value="Crée mon compte" />
            </p>
    </fieldset>
</form>