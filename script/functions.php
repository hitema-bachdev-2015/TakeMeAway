
<?php
function captcha()
{
	$liste = str_pad(mt_rand(1,999), 3, "0", STR_PAD_LEFT);
	$_SESSION['captcha'] = $liste;
	return $liste;
}
?>