<?php
header("Content-Type: application/json; charset=UTF-8");

$obj = json_decode($_POST["x"], false);


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

$sql = 'SELECT * FROM `Category` where `Cat_Name` =\''.$obj->cat_name.'\' and user_id=\''.$obj->user.'\'';

$result = mysqli_query($conn, $sql);
$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
print json_encode($rows);

?>
