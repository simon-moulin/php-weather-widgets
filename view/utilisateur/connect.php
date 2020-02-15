<form method="POST" action="index.php?action=connected&controller=ControllerUtilisateur" enctype="multipart/form-data">
  	<fieldset>
    <legend>Connexion : </legend>
    <p>
    <label for="email">Email :</label>
            <input type="email" placeholder="Ex : TotoDu34" name="email" id="email" required />
            <br>
            <label for="password">Mot de passe :</label>
            <input type="password" placeholder="Ex : *****" name="password" id="password" required />
            <br>

    <p>
      <input type="submit" value="Connexion" />
    </p>
  </fieldset> 
</form>
