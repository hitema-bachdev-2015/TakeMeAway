<h1>Inscription</h1>

<form action="#" method="POST" id="formInscription">
	<label>
		<span>Nom</span>:
		<input type="text" name="nom" />
	</label>
	<label>
		<span>Prenom</span>:
		<input type="text" name="prenom" />
	</label>
	<label>
		<span>E-mail</span>:
		<input type="text" name="mail" />
	</label>
	<label>
		<span>Mot de passe</span>:
		<input type="password" name="mdp" />
	</label>
	<label>
		<span>Adresse</span>:
		<input type="text" name="adresse" />
	</label>
	<label>
		<span>Code Postal</span>:
		<input type="text" name="cp" />
	</label>
	<label>
		<span>Ville</span>:
		<input type="text" name="ville" />
	</label>
	<label>
		<span>Moyen de transport</span>:
		<select name="mdt">
			<option value="1">voiture</option>
		</select>
	</label>
	<label>
		<input type="checkbox" />
		<span> Voulez-vous utiliser l'adresse ci-dessus comme domicile.</span>
	</label>
	<input type="submit" name="btnInscription" value="Enregistrer">
</form>

<style type="text/css">
	form > label
	{
		display: block;
	}
	form > label > span:first-child
	{
		display: inline-block;
		width: 200px;
	}
</style>