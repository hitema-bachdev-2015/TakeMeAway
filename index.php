<?php 
	require_once("script/bdd.php"); 
	require_once("header.php"); 

	// Page à appeler
	$page = explode('/', $_SERVER['REQUEST_URI']);
	if(empty($page[3])) {
		$page ="accueil.php";
	}else{
		$page = $page[3];
	}
	
	include("script/".$page);
	include("layout/".$page);

	include("include/footer.php");
?>

	
</body>
</html>