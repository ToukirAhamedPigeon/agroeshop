<?php
// Create connection
// $conn = mysqli_connect("localhost", "root","", "record");
// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }else{

require("connection.php");

	if($_POST['user_name']==="" || $_POST['user_email']==="" || $_POST['user_password']==="" || $_POST['confirmpassword']==="" || $_POST['user_type']==="" || $_POST['user_contact_no']==="" || $_POST['user_address']==="" || $_POST['shipping_address']===""){
	echo "Can't be empty";
	return;
}


	$sql = "INSERT INTO USERS (USER_ID,USER_NAME,USER_EMAIL,USER_PASSWORD,USER_TYPE,USER_CONTACT_NO,USER_ADDRESS,SHIPPING_ADDRESS)
	VALUES (users_sequence.nextval,'".$_POST["user_name"]."', '".$_POST["user_email"]."', '".$_POST["user_password"]."', '".$_POST["user_type"]."', '".$_POST["user_contact_no"]."', '".$_POST["user_address"]."', '".$_POST["shipping_address"]."')";
// 	if (mysqli_query($conn, $sql)) {
// 		header('Location: homepage.php');
// 	} else {
// 		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// 	}
// 	// }



// mysqli_close($conn);
	$result = oci_parse($conn, $sql);
	//oci_execute($result);
	if (oci_execute($result)) {
		header('Location: homepage.php');
	} else {
		//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		$e = oci_error();
		//die($e['message']);
		echo "Error: " . $sql . "<br>" . $e['message'];
	}
	// }


oci_close($conn);
?>