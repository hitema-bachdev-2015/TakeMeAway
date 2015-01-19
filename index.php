<?php 
	require_once("script/bdd.php"); 
	require_once("header.php"); 

	// Page à appeler
	$page = $_GET['pg'];
	
	include("script/".$page.".php");
	include("layout/".$page.".php");

	include("include/footer.php");
?>

	
</body>
</html>