<?php
header("Content-Type: application/json; charset=UTF-8");

$obj = json_decode($_POST["x"], false);
$user_id = $obj->user;
$date = $obj->today;

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

$sql = 'Delete from Consume where User_id = \''.$user_id.'\' and Consume_Date=\''.$date.'\'';

$result = mysqli_query($conn, $sql);

print $sql;

?>
