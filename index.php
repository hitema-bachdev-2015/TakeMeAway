<?php  
	require_once("header.php"); 

	// Page à appeler
	$page = explode('/', $_SERVER['REQUEST_URI']);


	if(empty(end($page))) {
		$page ="accueil.php";
	}else{
		$page = end($page);
	}

	include("script/".$page);
	include("layout/".$page);

	include("include/footer.php");
?>

	
</body>
</html>