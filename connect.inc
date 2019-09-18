<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "phpproject";

$link = mysqli_connect($host, $username, $password, $database);
if($link == null){
    die("<h2> Fail to Connect Database </h2>");
}

mysqli_set_charset($link, "utf8");

?>
