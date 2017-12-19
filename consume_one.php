<?php
header("Content-Type: application/json; charset=UTF-8");

$obj = json_decode($_POST["x"], false);
$user_id = $obj->user;
$pid = $obj->pid;
$date = $obj->cdate;

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

$sql = 'INSERT INTO `Consume` (`Consume_id`, `Purchase_id`, `User_id`, `Consume_Qty`, `Consume_Date`) VALUES (NULL, ' . $pid . ', \''.$user_id.'\', 1, \''. $date .'\')';

$result = mysqli_query($conn, $sql);
$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
print json_encode($rows);

?>
