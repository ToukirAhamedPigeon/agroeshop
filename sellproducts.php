<?php
	session_start();
	if($_SESSION["user_id"]==null){
		header('Location: signin.html');
	}
// Create connection
// $conn = mysqli_connect("localhost", "root","", "record");
// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }else{

	require("connection.php");

	if($_POST['product_name']==="" || $_POST['product_type']==="" || $_POST['product_amount']==="" || $_POST['product_price']==="" || $_POST['product_description']==="" || $_POST['seller_id']===""){
	echo "Can't be empty";
	return;
}


	$sql = "INSERT INTO products (PRODUCT_ID, PRODUCT_NAME, PRODUCT_TYPE, PRODUCT_AMOUNT, PRODUCT_PRICE, PRODUCT_DESCRIPTION, SELLER_ID)
	VALUES (products_sequence.nextval,'".$_POST["product_name"]."', '".$_POST["product_type"]."', '".$_POST["product_amount"]."', '".$_POST["product_price"]."', '".$_POST["product_description"]."','".$_POST["seller_id"]."')";
	$result = oci_parse($conn, $sql);
	if (oci_execute($result)) {
		header('Location: sellproductchart.php');
	} else {
		//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		$e = oci_error();
		die($e['message']);
		echo "Error: " . $sql . "<br>" . $e;
	}
	// }


oci_close($conn);
?>