<!DOCTYPE html>
<html class="img-no-display"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Denise Cosmetics Inventory System</title>

</head>
<body>

<?php
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


$sql = 'SELECT * FROM `Product` WHERE ';
$sql = $sql . '`Prod_Category`=\''.$_POST["Category"].'\' AND ';
$sql = $sql . '`Prod_Brand`=\''.$_POST["Brand"].'\' AND ';
$sql = $sql . '`Prod_Name`=\''.$_POST["Name"].'\' AND ';
$sql = $sql . '`Prod_Unit`=\''.$_POST["Unit"].'\' AND ';
$sql = $sql . '`Prod_QV`='.$_POST["QV"];

//echo $sql.'<br>';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["Prod_id"]. " - Category: " . $row["Prod_Category"]." - Brand: " . $row["Prod_Brand"]." - Name: " . $row["Prod_Name"]. " - Unit: " . $row["Prod_Unit"]. " - Quantity/Volumn: " . $row["Prod_QV"]. "<br>";
    }
} else {
	$sql  = 'INSERT INTO `Product` (`Prod_id`, `Prod_Category`, `Prod_Brand`, `Prod_Name`, `Prod_Unit`, `Prod_QV`) VALUES (NULL, \'' . $_POST["Category"].'\',\''.$_POST["Brand"].'\',\''.$_POST["Name"].'\',\''.$_POST["Unit"].'\','.$_POST["QV"].')';
	//echo $sql.'<br>';
	if (mysqli_query($conn, $sql))
		echo "Inserted!<br>";
	}


mysqli_close($conn);
?> 


</body></html>