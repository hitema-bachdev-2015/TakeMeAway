<?php  
	require_once("header.php"); 

	// Page à appeler
	$page = explode('/', $_SERVER['REQUEST_URI']);
	// var_dump($_GET);

	if(end($page)== "" || end($page)== "index.php") {
		$page ="accueil.php";
	}else{
		$page = end($page);
	}

	if($page == 'accueil.html?confirmattion=ok'){
		$page ="accueil.php";
	}elseif ($page == 'connexion.html?confirmattion=error') {
		$page ="connexion.php";
	}

	include("script/".$page);
	include("layout/".$page);

	include("include/footer.php");
?>

	
</body>
</html>