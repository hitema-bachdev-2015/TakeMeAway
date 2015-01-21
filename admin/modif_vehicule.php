<!doctype html>
<html lang="en">
<head>
<style>
	#detail_vehicule{
		display: none;
	}
</style>
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script type="text/javascript" src="modif_vehicule_script"></script>
  <script>
  $(function() {
    $( "#tabs" ).tabs({
		active:1});
  });
  </script>
</head>
<body>
 <?php 
	include("../script/bdd.php");
	$query1 = "SELECT * FROM vehicule WHERE id_utilisateur = :id_utilisateur";
	$query2 = "SELECT * FROM vehicule WHERE id = :id_vehicule"
  ?>
<div id="tabs">
  <ul>
    <li><a href="#profil">Profil</a></li>
    <li><a href="#monVehicule">Ajout/Modification</a></li>
  </ul>
  <div id="profil">


  </div>
  <div id="monVehicule">
	
    <select id="choix_vehicule" name="vehicule">
		<option value="choix">Choisir un véhicule</option>
		<?php
			$sth = $bdd->prepare($query1);
			$sth->execute(array(":id_utilisateur" => 1));
			$resu = $sth->fetchall();
			foreach($resu as $value){
				echo "<option value='" . $value['id'] . "'>" . $value['modele'] . "</option>";
			}
		?>
		<option value="ajout">Ajout d'un vehicule</option>		
	</select>
<?php
	if(isset($_POST['vehicule']) && $_POST['vehicule']!="value"){
		$sth = $bdd -> prepare($query2);
		$sth->execute(array(":id_vehicule" => $_POST['vehicule']));
		$rps = $sth -> fetch();
	}
?>
	<form id="detail_vehicule" method="POST">
		<span>- Constucteur :</span><input id="champ_constructeur" name="constucteur"></input>
		<span>- Modèle :</span><input id="champ_modele" name="modele"></input>
		<span>- Type Moteur</span>
			<input type="radio" id="champ_essence" value="0" name="type_moteur" id="champ_essence">Essence
			<input type="radio" id="champ_diesel" value="1" name="type_moteur">Diesel
		<span>- Consommation :</span><input id="champ_consommation" name="constucteur"></input>
		<button id="valid_modif">VALIDER</button>
		
	</form>
  </div>
</div>
</body>
</html>