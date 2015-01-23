
<div id="tabs" class="row">
  <h1 class="title">Vehicule(s) Personnel(s)</h4>
  <?php 
    if(isset($_GET['modification'])){
      echo "<div class='notification modification'>Votre modification a bien été éffectué.</div>";
    }
    elseif(isset($_GET['ajout']))
    {
       echo "<div class='notification modification'>Votre ajout a bien été éffectué.</div>";
    }
  ?>
  <center>
    <a href="../accueil.php" class="bouton">Accueil</a>
  </center>
  <ul>
    <li><a href="#monVehicule"><?php if(isset($_GET['id'])) echo "Modification"; else echo "Ajout"; ?> véhicule </a></li>
    <li><a href="#profil">Profil</a></li>
  </ul>
  <div id="profil">
      <form action="" method="POST" id="formProfil">
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
          <input type="hidden" name="mdp1"  value="<?php echo $profil['mdp']; ?>" />
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
        <input type="submit" name="btnModifProfil" value="Modifier" class="bouton">
      </form>
      <ul class='titleForm'>
          <h2>Ma liste de véhicule</h2>
          <li>
            <span>Marque</span><span>Modele</span><span>Moteur</span>
          </li>
        <?php 
          for ($i=0; $i < count($listeVehicule) ; $i++) { 
              echo  "
                      <li>
                        <a  class='lien_voiture' href='?id=" . $listeVehicule[$i]['id'] . "'>
                          <span>".$listeVehicule[$i]['marque']."</span>
                          <span>".$listeVehicule[$i]['modele']."</span>
                          <span>"; 
                            echo $listeVehicule[$i]['type_moteur'] == 0 ? 'Essence' : 'Diesel';
              echo        "</span>
                        </a>
                      </li>
                    ";
          }
        ?>
      </ul>
  </div>
  <div id="monVehicule">
	<?php if(isset($_GET['id'])) $vehicule = new Vehicule($_GET['id']); ?>
	<form id="detail_vehicule" data-idVehic="<?php if(isset($_GET['id'])) echo $_GET['id']; ?>" method="POST">
    <label>
      <span>Constucteur </span>:
      <input id="champ_constructeur" <?php if(isset($_GET['id'])) echo "value=" . $vehicule -> getMarque(); ?> name="constucteur"></input>
    </label>
		<label>
		  <span>Modèle </span>:
      <input id="champ_modele" name="modele"<?php if(isset($_GET['id'])) echo "value=" . $vehicule->getModele(); ?>></input>
    </label>
    <label>
		  <span>Type Moteur</span>:
			<input type="radio" id="champ_essence" value="0" name="type_moteur" <?php if(isset($_GET['id']) && ($vehicule->getTypeMoteur() == 0)) echo "checked"; ?> >Essence
			<input type="radio" id="champ_diesel" value="1" name="type_moteur" <?php if(isset($_GET['id']) && ($vehicule->getTypeMoteur() == 1)) echo "checked"; ?> >Diesel
		</label>
    <label>
      <span>Consommation </span>:
      <input id="champ_consommation" name="constucteur"<?php if(isset($_GET['id'])) echo "value=" . $vehicule->getConsommation(); ?>></input>
    </label>
    <label>
		  <span> Type vehicule </span>:
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
    </label>
		<button id="valid_modif" class="bouton"><?php if(isset($_GET['id'])) echo "Modification"; else echo "Ajout"; ?></button>
	</form>
      <ul class='titleForm'>
          <h2>Ma liste de véhicule</h2>
          <li>
            <span>Marque</span><span>Modele</span><span>Moteur</span>
          </li>
        <?php 
          for ($i=0; $i < count($listeVehicule) ; $i++) { 
              echo  "
                      <li>
                        <a href='?id=" . $listeVehicule[$i]['id'] . "'>
                          <span>".$listeVehicule[$i]['marque']."</span>
                          <span>".$listeVehicule[$i]['modele']."</span>
                          <span>"; 
                            echo $listeVehicule[$i]['type_moteur'] == 0 ? 'Essence' : 'Diesel';
              echo        "</span>
                        </a>
                      </li>
                    ";
          }
        ?>
      </ul>

  </div>
</div>