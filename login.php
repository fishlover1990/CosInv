<?php
$obj = json_decode($_POST["x"], false);
$uname = $obj->username;
$psw = $obj->password;



$servername = "localhost";
$username = "root";
$password = "roc4ever";
$dbname = "Cosmetics";

$conn = mysqli_connect($servername.':3307', $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$stmt = mysqli_prepare($conn, "SELECT User_id,User_Name FROM User WHERE User_id = ? AND User_pass = ?");
mysqli_stmt_bind_param($stmt, 'ss', $uname, $psw);

mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $user, $name);


if (mysqli_stmt_fetch($stmt)) {
	mysqli_stmt_close($stmt);
	$stmt = mysqli_prepare($conn, "INSERT INTO Session VALUES (?,?,?)");
	$sess = md5($user.random_bytes(25));

	//$expire = date("Y-m-d H:i:s");
	//$expire->add(new DateInterval('P10D'));
	$expire = "2020-12-31 22:22:22";
	
	mysqli_stmt_bind_param($stmt, 'sss', $user, $sess, $expire);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	$arr = array('user_id' => $user, 'user_name' => $name, 'session' => $sess, 'expire' => $expire);
	print json_encode($arr);
}

?>