<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#tabs" ).tabs({
		active:1});
  });
  </script>
</head>
<body>
 <?php include("../php/bdd.php"); ?>
<div id="tabs">
  <ul>
    <li><a href="#profil">Profil</a></li>
    <li><a href="#monVehicule">Ajout/Modification</a></li>
  </ul>
  <div id="profil">


  </div>
  <div id="monVehicule">
    <select>
		<option>Voiture 1</option>
		<option>Ajout d'un vehicule</option>		
	</select>
  </div>
</div>
 
</body>
</html>