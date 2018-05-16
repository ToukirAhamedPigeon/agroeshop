<?php
	session_start();
	if($_SESSION["user_id"]==null){
		header('Location: signin.html');
	}

	function getJSONFromDB($sql){
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

$sql = "select * from products";
$result = getJSONFromDB($sql);
$table = json_decode($result,true);

 ?>
<!DOCTYPE html>
 <html>
	<head>
		<title> productChart </title>
		<style type="text/css">
		.button{
		border:none;
		border-radius:5px;
		border-bottom:15px ;
		padding:10px 20px;
		background:red;
		cursor:pointer;
		}
		.form{
			position:absolute;
			float: right;
		}
		</style>
		
	<script type="text/javascript">

	</script>
	</head>
    <body background="vutta.jpg" style ="background-size:cover"></br>
	<span class="form">
	
	<h1 style="text-align:center;" style="font-size:300%" style="color:black;">productChart</h1>
	<h3 id="h3" style="text-align:center;" style="font-size:300%" style="color:blue;"></h3>
	<form > 
	<button class="button"><a href="signout.php">Signout</a></button>
	</form>
	<table border="2" align="center" style="background-color: white;">
		<tr><td>Product Id</td><td>Product Name</td><td>Product Type</td><td>Product Amount</td><td>Product Price</td><td>Product Description</td><td>Seller ID</td></tr>
		<?php foreach($table as $element){

		 echo "<tr><td>".$element['PRODUCT_ID']."</td><td>".$element['PRODUCT_NAME']."</td><td>".$element['PRODUCT_TYPE']."</td><td>".$element['PRODUCT_AMOUNT']."</td><td>".$element['PRODUCT_PRICE']."</td><td>".$element['PRODUCT_DESCRIPTION']."</td><td>".$element['SELLER_ID']."</td><td><a href='editproduct.php?product_id=".$element['PRODUCT_ID']."'>Edit</a></td></td></tr>";
		}
		//echo ($table[0]['PRODUCT_NAME']);
		?>
		
		
	</table>

    
    </body>
</html>
