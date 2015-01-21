<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script type="text/javascript" src="js/modif_vehicule_script.js"></script>
  <script>
  $(function() {
    $( "#tabs" ).tabs({
		active:1});
  });
  </script>
</head>
<body>
 <?php 
	$modif = 0;
	if(isset($_GET['modif'])) $modif = $_GET['modif']; 
	include("../script/bdd.php");
  ?>
<div id="tabs">
  <ul>
    <li><a href="#profil">Profil</a></li>
    <li><a href="#monVehicule"><?php echo $modif == 0 ? 'Ajout' : 'Modification'; ?></a></li>
  </ul>
  <div id="profil">


  </div>
  <div id="monVehicule">
	
	<form id="detail_vehicule" method="POST">
		<span>- Constucteur :</span><input id="champ_constructeur" name="constucteur"></input>
		<span>- Modèle :</span><input id="champ_modele" name="modele"></input>
		<span>- Type Moteur</span>
			<input type="radio" id="champ_essence" value="0" name="type_moteur" id="champ_essence">Essence
			<input type="radio" id="champ_diesel" value="1" name="type_moteur">Diesel
		<span>- Consommation :</span><input id="champ_consommation" name="constucteur"></input>
		<span>- Type vehicule :</span>
			<select id="champ_vehicule">
				<?php
					//Recuperation du type de vehicule
					$sth = $bdd -> prepare("SELECT * FROM vehicule WHERE id = :id_vehicule");
					$sth->execute(array(":id_vehicule" => $_POST['id_vehicule']));
					$info = $sth->fetch();
					//Recuperation de tout les type de vehicule
					$sth = $bdd -> prepare("SELECT * FROM type_vehicule");
					$sth->execute();
					$rps = $sth -> fetchall();
					foreach($rps as $value) {
						echo "<option value='" . $value['id'] . "'";
						if($info['type_vehicule'] == $value['id']) echo "selected";
						echo ">" . $value['libelle'] . "</option>";
					}
				?>
			</select>
		<button id="valid_modif">VALIDER</button>
		<php>
		<?php	$profil = Tools::infoUser($_SESSION['user']['id']);
	$listeVehicule = Tools::listeVehicule($_SESSION['user']['id']);
	var_dump($listeVehicule);?>

	</form>
  </div>
</div>
</body>
</html>