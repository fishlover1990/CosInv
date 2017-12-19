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

$sql = 'select Category.Cat_Name,Brand.Brand_Name,Product.Prod_Name,Product.Prod_QV,Category.Cat_Unit,Category.Cat_Divisible,Bal.Purchase_Qty,Bal.Total_Consumed,Bal.Purchase_id from
Product, Category, Brand,
		(select Purchase.*,Total_Consumed 
		from Purchase left join 
			(select Consume.Purchase_id, SUM(Consume.Consume_Qty) AS Total_Consumed from Consume GROUP by Consume.Purchase_id) Con 
		on Purchase.Purchase_id = Con.Purchase_id) Bal
where Product.Cat_id = Category.Cat_id AND Product.Brand_id = Brand.Brand_id AND Bal.Prod_id = Product.Prod_id AND Bal.User_id = \'' . $obj->user . '\'
';

$result = mysqli_query($conn, $sql);
$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
print json_encode($rows);

?>
