<?php
if ( isset($_GET["id"])) {
    $id = $_GET["id"];

$servername  = "localhost";
$username  = "root";
$password  = "";
$database  = "votingsystem";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);

$SQL ="DELETE FROM candidate WHERE id=$id";
$result = $connection->query($SQL);
}

header("location: /vote/candidatesindex.php");
exit;
?>