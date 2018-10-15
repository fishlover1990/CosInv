<!DOCTYPE html>

<?php
$servername = "localhost";
$username = "root";
$password = "roc4ever";
$dbname = "Cosmetics";

// Create connection
$conn = mysqli_connect($servername.':3307', $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
// Check connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$user = $_POST["user"];

/*===============CHECK CATEGGORY, INSERT IF NEW=======================*/

$stmt = mysqli_prepare($conn, "SELECT Cat_id FROM Category WHERE Cat_Name = ? AND Cat_Divisible = ? AND Cat_Unit = ? AND user_id = ?");
mysqli_stmt_bind_param($stmt, 'siss', $_POST["Category"], $_POST["Divisible"], $_POST["Unit"], $user);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $cat_id);

echo "<h2>Category Query Result:</h2>";

//if (mysqli_num_rows($result) > 0) {
if (mysqli_stmt_fetch($stmt)) {
	
    echo "Already exist in Category table, get the cat_id: ";
	echo $cat_id."<br>";
	mysqli_stmt_close($stmt);
}
else {
	$stmt = mysqli_prepare($conn, "INSERT INTO `Category` VALUES (NULL,?,?,?,?)");
	mysqli_stmt_bind_param($stmt, 'siss', $_POST["Category"], $_POST["Divisible"], $_POST["Unit"], $user);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	// get the cat_id
	$stmt = mysqli_prepare($conn, "SELECT Cat_id FROM Category WHERE Cat_Name = ? AND Cat_Divisible = ? AND Cat_Unit = ? AND user_id = ?");
	mysqli_stmt_bind_param($stmt, 'siss', $_POST["Category"], $_POST["Divisible"], $_POST["Unit"], $user);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $cat_id);
	mysqli_stmt_fetch($stmt);
	echo "Inserted into Category table, get the cat_id: ";
	echo $cat_id."<br>";
	mysqli_stmt_close($stmt);
}

/*===============CHECK BRAND, INSERT IF NEW=======================*/
mysqli_set_charset($conn, "utf8");
$stmt = mysqli_prepare($conn, "SELECT Brand_id FROM `Brand` WHERE Brand_Name = ? AND user_id = ?");
mysqli_stmt_bind_param($stmt, 'ss', $_POST["Brand"], $user);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $brd_id);

echo "<h2>Brand Query Result:</h2>";
if (mysqli_stmt_fetch($stmt)) {
    echo "Already exist in Brand table, get the brd_id: ";
	echo $brd_id."<br>";
	mysqli_stmt_close($stmt);
}
else {
	mysqli_set_charset($conn, "utf8");
	$stmt = mysqli_prepare($conn, "INSERT INTO `Brand` VALUES (NULL,?,?)");
	mysqli_stmt_bind_param($stmt, 'ss', $_POST["Brand"],$user);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	// get the brd_id
	mysqli_set_charset($conn, "utf8");
	$stmt = mysqli_prepare($conn, "SELECT Brand_id FROM `Brand` WHERE Brand_Name = ? AND user_id = ?");
	mysqli_stmt_bind_param($stmt, 'ss', $_POST["Brand"], $user);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $brd_id);
	mysqli_stmt_fetch($stmt);
	echo "Inserted into Brand table, get the brd_id: ";
	echo $brd_id."<br>";
	mysqli_stmt_close($stmt);
}

/*===============CHECK CITY, INSERT IF NEW=======================*/
if ($_POST["City"] != "") {
	$stmt = mysqli_prepare($conn, "SELECT City_id FROM `City` WHERE City_Name = ? AND user_id = ?");
	mysqli_stmt_bind_param($stmt, 'ss', $_POST["City"], $user);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $cty_id);


	echo "<h2>City Query Result:</h2>";
	if (mysqli_stmt_fetch($stmt)) {
		echo "Already exist in City table, get the cty_id: ";
		echo $cty_id."<br>";
		mysqli_stmt_close($stmt);
	}
	else {
		$stmt = mysqli_prepare($conn, "INSERT INTO `City` VALUES (NULL,?,?)");
		mysqli_stmt_bind_param($stmt, 'ss', $_POST["City"], $user);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		// get the cty_id
		$stmt = mysqli_prepare($conn, "SELECT City_id FROM `City` WHERE City_Name = ? AND user_id = ?");
		mysqli_stmt_bind_param($stmt, 'ss', $_POST["City"], $user);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $cty_id);
		mysqli_stmt_fetch($stmt);
		echo "Inserted into City table, get the cty_id: ";
		echo $cty_id."<br>";
		mysqli_stmt_close($stmt);
	}
}

/*===============CHECK PRODUCT, INSERT IF NEW=======================*/
mysqli_set_charset($conn, "utf8");
$stmt = mysqli_prepare($conn, "SELECT Prod_id FROM Product WHERE Cat_id = ? AND Brand_id = ? AND Prod_Name = ? AND Prod_QV = ? AND user_id = ?");
mysqli_stmt_bind_param($stmt, 'iisis', $cat_id, $brd_id, $_POST["Name"], $_POST["QV"], $user);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $prd_id);

echo "<h2>Product Query Result:</h2>";

//if (mysqli_num_rows($result) > 0) {
if (mysqli_stmt_fetch($stmt)) {
	
    echo "Already exist in Product table, get the prd_id: ";
	echo $prd_id."<br>";
	mysqli_stmt_close($stmt);
}
else {
	mysqli_set_charset($conn, "utf8");
	$stmt = mysqli_prepare($conn, "INSERT INTO `Product` VALUES (NULL,?,?,?,?,?)");
	mysqli_stmt_bind_param($stmt, 'iisis', $cat_id, $brd_id, $_POST["Name"], $_POST["QV"], $user);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	// get the prd_id
	mysqli_set_charset($conn, "utf8");
	$stmt = mysqli_prepare($conn, "SELECT Prod_id FROM Product WHERE Cat_id = ? AND Brand_id = ? AND Prod_Name = ? AND Prod_QV = ? AND user_id = ?");
	mysqli_stmt_bind_param($stmt, 'iisis', $cat_id, $brd_id, $_POST["Name"], $_POST["QV"], $user);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $prd_id);
	mysqli_stmt_fetch($stmt);
	echo "Inserted into Product table, get the prd_id: ";
	echo $prd_id."<br>";
	mysqli_stmt_close($stmt);
}


echo "<h2>Purchase Update Result:</h2>";
$stmt = mysqli_prepare($conn, "INSERT INTO `Purchase` VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?)");
mysqli_stmt_bind_param($stmt, 'siissssssss', $_POST["Date"], $prd_id, $_POST["Qty"], $_POST["ExpDate"], $user, $_POST["Price"],$_POST["Curr"],$_POST["Price_HKE"],$_POST["Shop"],$_POST["City"], $_POST["Remark"]);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
// get the pur_id
$stmt = mysqli_prepare($conn, "SELECT Purchase_id FROM Purchase WHERE Purchase_Date = ? AND Prod_id = ? AND Purchase_Qty = ? AND user_id = ?");
mysqli_stmt_bind_param($stmt, 'siis', $_POST["Date"], $prd_id, $_POST["Qty"], $user);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $pur_id);
mysqli_stmt_fetch($stmt);
echo "Inserted into Purchase table, get the pur_id: ";
echo $pur_id."<br>";
mysqli_stmt_close($stmt);

mysqli_close($conn);

if ($pur_id) {
	header("Location: index.html");
	die();
}
?> 


