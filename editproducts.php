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


	$sql = "UPDATE products  
	SET PRODUCT_NAME='".$_POST["product_name"]."', PRODUCT_TYPE='".$_POST["product_type"]."', PRODUCT_AMOUNT='".$_POST["product_amount"]."', PRODUCT_PRICE='".$_POST["product_price"]."', PRODUCT_DESCRIPTION='".$_POST["product_description"]."', SELLER_ID='".$_POST["seller_id"]."' where PRODUCT_ID='".$_REQUEST["product_id"]."'";
// 	if (mysqli_query($conn, $sql)) {
// 		header('Location: sellproductchart.php');
// 	} else {
// 		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// 	}
// 	// }
// var_dump($GLOBALS);

// mysqli_close($conn);
	// mysqli_close($conn);
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

//var_dump($GLOBALS);
oci_close($conn);
?>