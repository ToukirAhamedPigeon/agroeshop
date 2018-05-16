<?php
	session_start();
	if($_SESSION["user_id"]==null){
		header('Location: signin.html');
	}
	
	require("connection.php");
	if($_POST['product_id']==="" || $_POST['seller_id']==="" || $_POST['buyer_id']===""){
	echo "Can't be empty";
	return;
	}

	$sql = "INSERT INTO orders (ORDER_ID, PRODUCT_ID,SELLER_ID,BUYER_ID)
	VALUES (orders_sequence.nextval,'".$_GET["product_id"]."', '".$_GET["seller_id"]."', '".$_SESSION["user_id"]."')";
	$result = oci_parse($conn, $sql);
	if (oci_execute($result)) {
		unset($_SESSION['user_cart']);
		//echo 'alert("Your order has been placed.")';
		header('Location: homepage.php');
	} else {
		//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		$e = oci_error();
		die($e['message']);
		echo "Error: " . $sql . "<br>" . $e;
	}
	// }
	


oci_close($conn);

 ?>

