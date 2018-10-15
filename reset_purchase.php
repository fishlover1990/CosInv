<?php
header("Content-Type: application/json; charset=UTF-8");

$obj = json_decode($_POST["x"], false);
$user_id = $obj->user;

$servername = "localhost";
$username = "root";
$password = "roc4ever";
$dbname = "Cosmetics";



// Create connection
$conn = mysqli_connect($servername.':3307', $username, $password, $dbname);
// Check connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = 'delete from Purchase where User_id = \''.$user_id.'\' order by Purchase_id DESC limit 1';

$result = mysqli_query($conn, $sql);

print $sql;

?>
