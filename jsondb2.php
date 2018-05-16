<?php
function getData($sql){
	// $conn = mysqli_connect("localhost", "root", "","record");
	
	//echo $sql;
	require("connection.php");
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


	$sql="select * from users where USER_ID = ".$_REQUEST['user_id'];
	
	echo getData($sql);

?>