<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "todo_list_app";

$koneksi = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$koneksi) {
	echo "Connection failed!";
}

?>