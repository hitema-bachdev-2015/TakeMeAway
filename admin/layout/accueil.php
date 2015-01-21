<div id="tabs">
  <ul>
    <li><a href="#profil">Profil</a></li>
    <li><a href="#monVehicule">Ajout/Modification</a></li>
  </ul>
  <div id="profil">
      <form action="#" method="POST" id="formProfil">
        <label>
          <span>Nom</span>:
          <input type="text" name="nom" value="<?php echo $profil['nom']; ?>" required/>
        </label>
        <label>
          <span>Prenom</span>:
          <input type="text" name="prenom"  value="<?php echo $profil['prenom']; ?>" required/>
        </label>
        <label>
          <span>Changer de mot de passe</span>:
          <input type="password" name="mdp"  value="" />
        </label>
        <label>
          <span>Adresse</span>:
          <input type="text" name="adresse"  value="<?php echo $profil['adresse']; ?>" required/>
        </label>
        <label>
          <span>Code Postal</span>:
          <input type="text" name="cp"  value="<?php echo $profil['cp']; ?>" required/>
        </label>
        <label>
          <span>Ville</span>:
          <input type="text" name="ville"  value="<?php echo $profil['ville']; ?>" required/>
        </label>
        <input type="submit" name="btnModifProfil" value="Modifier">
      </form>
      <ul>
          <li class='titleForm'>
            <span>Marque</span><span>Modele</span><span>Moteur</span>
          </li>
        <?php 
          for ($i=0; $i < count($listeVehicule) ; $i++) { 
              echo  "
                      <li>
                      <span>".$listeVehicule[$i]['marque']."</span><span>".$listeVehicule[$i]['modele']."</span><span>".$listeVehicule[$i]['type_moteur']."</span>
                      </li>
                    ";
          }
        ?>
      </ul>
  </div>
  <div id="monVehicule">
    <select>
		<option>Voiture 1</option>
		<option>Ajout d'un vehicule</option>		
	</select>
  </div>
</div>