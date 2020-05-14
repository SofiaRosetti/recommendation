<?php

if (!defined("HOST")) {
	define("HOST", "localhost");
}
if (!defined("USER")) {
	define("USER", "root");
}
if (!defined("PASSWORD")) {
	define("PASSWORD", "");
}
if (!defined("DATABASE")) {
	define("DATABASE", "tesi_db");
}


	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	mysqli_set_charset($mysqli, "utf8");

	$dbCon = new PDO("mysql:host=".HOST.";port=3306;dbname=".DATABASE, USER, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
