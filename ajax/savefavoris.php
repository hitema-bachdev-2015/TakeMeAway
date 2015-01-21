<?php

include("../script/bdd.php");
include("../classes/Tools.php");
session_start();
//var_dump($_SESSION);
$tool = new Tools();
$tool -> updateFav($_SESSION['user']['id_historique']);


?>