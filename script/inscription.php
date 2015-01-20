<?php 
	if(isset($_POST['btnInscription'])){
		if($_SESSION['captcha'] == $_POST['captcha']){

		}else{
			$error_captcha = 'error';
		}
	}
?>