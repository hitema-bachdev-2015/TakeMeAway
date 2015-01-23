<?php  
	require_once("header.php"); 
	if(isset($_SESSION['user']['id'])){
		include("script/accueil.php");
		include("layout/accueil.php");
	}else{
		header("location:../accueil.php");
	}

	include("../include/footer.php");
?>

	
</body>
</html>