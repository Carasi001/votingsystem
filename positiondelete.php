<?php
if ( isset($_GET["id"])) {
    $id = $_GET["id"];

$servername  = "localhost";
$username  = "root";
$password  = "";
$database  = "votingsystem";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);

$SQL ="DELETE FROM position WHERE id=$id";
$result = $connection->query($SQL);
}

header("location: /votingsystem/positionindex.php");
exit;
?>