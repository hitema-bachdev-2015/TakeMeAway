<div id="tabs">
  <ul>
    <li><a href="#profil">Profil</a></li>
    <li><a href="#monVehicule"><?php if(isset($_GET['id'])) echo "Modification Vehicule"; else echo "Ajout Vehicule"; ?> </a></li>
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
                      <a href='?id=" . $listeVehicule[$i]['id'] . "#monVehicule'><span>".$listeVehicule[$i]['marque']."</span><span>".$listeVehicule[$i]['modele']."</span><span>".$listeVehicule[$i]['type_moteur']."</span></a>
                      </li>
                    ";
          }
        ?>
      </ul>
  </div>
  <div id="monVehicule">
	<?php if(isset($_GET['id'])) $vehicule = new Vehicule($_GET['id']); ?>
	<form id="detail_vehicule" method="POST">
		<span>- Constucteur :</span><input id="champ_constructeur" <?php if(isset($_GET['id'])) echo "value=" . $vehicule -> getMarque(); ?> name="constucteur"></input>
		<span>- Modèle :</span><input id="champ_modele" name="modele"<?php if(isset($_GET['id'])) echo "value=" . $vehicule->getModele(); ?>></input>
		<span>- Type Moteur</span>
			<input type="radio" id="champ_essence" value="0" name="type_moteur" <?php if(isset($_GET['id']) && ($vehicule->getTypeMoteur() == 0)) echo "checked"; ?> >Essence
			<input type="radio" id="champ_diesel" value="1" name="type_moteur" <?php if(isset($_GET['id']) && ($vehicule->getTypeMoteur() == 1)) echo "checked"; ?> >Diesel
		<span>- Consommation :</span><input id="champ_consommation" name="constucteur"<?php if(isset($_GET['id'])) echo "value=" . $vehicule->getConsommation(); ?>></input>
		<span>- Type vehicule :</span>
			<select id="champ_vehicule">
				<?php
					if(isset($_GET['id'])) {
						//Recuperation du type de vehicule
						$sth = $bdd -> prepare("SELECT * FROM vehicule WHERE id = :id_vehicule");
						$sth->execute(array(":id_vehicule" => $_GET['id']));
						$info = $sth->fetch();
					}
					//Recuperation de tout les type de vehicule
					$sth = $bdd -> prepare("SELECT * FROM type_vehicule");
					$sth->execute();
					$rps = $sth -> fetchall();
					foreach($rps as $value) {
						echo "<option value='" . $value['id'] . "'";
						if(isset($_GET['id'])){ if($info['type_vehicule'] == $value['id']) echo "selected"; }
						echo ">" . $value['libelle'] . "</option>";
					}
				?>
			</select>
		<button id="valid_modif">VALIDER</button>
	</form>
      <ul>
          <li class='titleForm'>
            <span>Marque</span><span>Modele</span><span>Moteur</span>
          </li>
        <?php 
          for ($i=0; $i < count($listeVehicule) ; $i++) { 
              echo  "
                      <li>
                      <a href='?id=" . $listeVehicule[$i]['id'] . "'><span>".$listeVehicule[$i]['marque']."</span><span>".$listeVehicule[$i]['modele']."</span><span>".$listeVehicule[$i]['type_moteur']."</span></a>
                      </li>
                    ";
          }
        ?>
      </ul>

  </div>
</div>