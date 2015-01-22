<?php
	include("../script/bdd.php");
	include("../classes/Tools.php");
	session_start();

	$tool = new Tools();
	$reponse = $tool -> recupHisto($_SESSION['user']['id']);

	if ($reponse != null) {
		
		echo json_encode($reponse);
	}
	else
	{
		echo json_encode("EMPTY");
	}

?>