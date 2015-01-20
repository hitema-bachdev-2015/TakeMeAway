<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

    <title>TakeMeAway!</title>

	<!-- insertion de Query -->
	<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.min.js"></script>

	<!-- insertion de mes scripts JS -->
	<script type="text/javascript" src="js/index.js"></script>

	<!-- insertion des liens css -->
    <link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

	<!-- insertion des fonts css de google -->
</head>
<body>
    <?php 
        session_start();
        require_once('../script/bdd.php'); 
        require_once('../script/functions.php'); 
        require_once('../classes/Tools.php');
        require_once('../classes/Utilisateur.php');
        // require_once('classes/Vehicule.php');
    ?>