<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico" />

    <title>TakeMeAway!</title>

	<!-- insertion de Query -->
	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>


    <!-- insertion de Google JSapi -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
	
	<!-- insertion de mes scripts JS -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
	<!-- insertion des liens css -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/grid.css" rel="stylesheet">

	<!-- insertion des fonts css de google -->
	<link href='http://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
</head>
<body>
    <?php
        if(empty($_SESSION['user']['id']))
        {
            echo '<script type="text/javascript" src="js/indexNonAuthentifie.js"></script>';
        }
        else
        {
            echo '<script type="text/javascript" src="js/index.js"></script>';
        }
    ?>
    <?php 
        require_once('script/bdd.php'); 
        require_once('script/functions.php'); 
        require_once('classes/Tools.php');
        require_once('mandrill-api-php/src/Mandrill.php');
    ?>
