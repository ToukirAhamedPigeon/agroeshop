<?php
session_start();
function getJSONFromDB($sql){
	require("connection.php");
	//$conn = mysqli_connect("localhost", "root", "","record");
	// $result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	$result = oci_parse($conn, $sql);
	oci_execute($result);
	$arr=array();
	// while($row = mysqli_fetch_assoc($result)) {
	// 	$arr[]=$row;
	// }
	while($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) {
		$arr[]=$row;
	}
	return json_encode($arr);
}
if($_POST['user_email']==="" || $_POST['user_password']===""){
	echo "Username and Password can't be empty";
	return;
}
$jsonData= getJSONFromDB("select * from users");
$mail = $_POST['user_email'];
$pass = $_POST['user_password'];
$flag = false;
$_SESSION["user_email"] = $_POST['user_email'];
//$_SESSION["user_password"] = $_POST['user_password'];

$jsn=json_decode($jsonData,true);

//print_r($jsn); die();
$s = "";
for($i=0;$i<sizeof($jsn);$i++)
{
	//echo($jsn[$i]['USER_EMAIL']);
	if($mail==$jsn[$i]['USER_EMAIL']&&$pass==$jsn[$i]['USER_PASSWORD'])
	{
		echo "Log in Success ";
		$flag = true;
		$_SESSION["user_id"] = $jsn[$i]['USER_ID'];
		$_SESSION["user_name"] =$jsn[$i]['USER_NAME'];
		$_SESSION["user_type"] =$jsn[$i]['USER_TYPE'];
		$_SESSION["user_contact_no"] = $jsn[$i]['USER_CONTACT_NO'];
		$_SESSION["user_address"] = $jsn[$i]['USER_ADDRESS'];
		$_SESSION["shipping_address"] = $jsn[$i]['SHIPPING_ADDRESS'];

		header('Location: homepage.php');
	}
	else 
	{
		
	}
}
echo $s;
/* header('Location: homepage.html');  */
if($flag == false){
	echo "<br> Login Failed !";
}


?>