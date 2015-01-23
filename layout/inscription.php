<?php captcha(); 
if(isset($error_mail) && $error_mail == "error"){ ?>
	<div class="notification_ok">
		<span>Cette adresse mail est déjà utilisée.</span>
	</div>
<?php } ?>
<div class="container">
	<h1 class="title">Inscription</h1>

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
		<div class="g-recaptcha" data-sitekey="6Ld0uwATAAAAAHZJhd-kkJ-lw2HgJGSZWKCyRhFe"></div>
		<?php echo isset($error_captcha) && $error_captcha == "error" ? "<img src='img/icones/error.png'  class='errorCaptcha' width='25px' />" : "" ?>
		<p>
			<a href="accueil.php" class="bouton">Accueil</a>
			<input type="submit" name="btnInscription" value="Enregistrer" class="bouton">
		</p>
	</form>
</div>