<?php

define('_DB_HOST_', 'localhost');
define('_DB_NAME_', 'tma');
define('_DB_USERNAME_', 'root');
define('_DB_PASSWORD_', '');

$bdd = new PDO('mysql:host='._DB_HOST_.';dbname='._DB_NAME_, _DB_USERNAME_, _DB_PASSWORD_, array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO:: FETCH_ASSOC,
	PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
));