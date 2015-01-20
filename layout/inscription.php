<?php captcha(); 
if(isset($error_mail) && $error_mail == "error"){ ?>
	<div class="notification_ok">
		<span>Cette adresse mail est déjà utilisée.</span>
	</div>
<?php } ?>
<h1>Inscription</h1>

<form action="#" method="POST" id="formInscription">
	<label>
		<span>Nom</span>:
		<input type="text" name="nom" value="<?php echo isset($_POST['nom']) ? $_POST['nom'] : ''; ?>" required/>
	</label>
	<label>
		<span>Prenom</span>:
		<input type="text" name="prenom"  value="<?php echo isset($_POST['prenom']) ? $_POST['prenom'] : ''; ?>" required/>
	</label>
	<label>
		<span>E-mail</span>:
		<input type="text" name="mail"  value="<?php echo isset($_POST['mail']) ? $_POST['mail'] : ''; ?>" required/>
		<?php echo isset($error_mail) && $error_mail == "error" ? "<img src='img/icones/error.png' width='25px' />" : "" ?>
	</label>
	<label>
		<span>Mot de passe</span>:
		<input type="password" name="mdp"  value="<?php echo isset($_POST['mdp']) ? $_POST['mdp'] : ''; ?>" required/>
	</label>
	<label>
		<span>Adresse</span>:
		<input type="text" name="adresse"  value="<?php echo isset($_POST['adresse']) ? $_POST['adresse'] : ''; ?>" required/>
	</label>
	<label>
		<span>Code Postal</span>:
		<input type="text" name="cp"  value="<?php echo isset($_POST['cp']) ? $_POST['cp'] : ''; ?>" required/>
	</label>
	<label>
		<span>Ville</span>:
		<input type="text" name="ville"  value="<?php echo isset($_POST['ville']) ? $_POST['ville'] : ''; ?>" required/>
	</label>
	<label>
		<span>Moyen de transport</span>:
		<select name="mdt">
			<option value="1" <?php echo isset($_POST['mdt']) && $_POST['mdt'] ==1 ? "selected" : ''; ?> >voiture</option>
		</select>
	</label>
	<label>
		<span>Captcha</span>:
		<span class='captcha'><?php echo $_SESSION['captcha']; ?></span>
	</label>
	<label>
		<span>Recopier le captcha</span>:
		<input type="text" name="captcha" required />
		<?php echo isset($error_captcha) ? "<img src='img/icones/error.png' width='25px' />" : "" ?>
	</label>
	<input type="submit" name="btnInscription" value="Enregistrer">
</form>