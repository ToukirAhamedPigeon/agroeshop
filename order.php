<?php
	session_start();

	$_SESSION["user_id"];
	$_SESSION["user_name"];
	$_SESSION["user_email"];
	$_SESSION["user_contact_no"];
	$_SESSION["user_address"];
	$_SESSION["shipping_address"];

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




 ?>
<!DOCTYPE html>
 <html>
	<head>
		<title> Checkorder </title>
		<style type="text/css">
		
		input[type="text"],[type="number_format"]{
		width:300px;
		height:30px;
		font-size:17px;
		margin-top:20px;
		margin-bottom:50px;
		padding-left:30px;
		background:#fff;
		border:20px;
		border-radius:15px;
		padding-top:5px;
		}
		input[type="button"]{
		border:none;
		border-radius:5px;
		border-bottom:15px ;
		padding:10px 20px;
		background:red;
		cursor:pointer;
		}
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
    <body background="rice.jpg" style ="background-size:cover"></br>  
	<h1 style="text-align:center;" style="font-size:300%" style="color:black;">checkOrder</h1>
	<br>
	<br>
	<h3 id="h3" style="text-align:center;" style="font-size:300%" style="color:blue;">cartInfo</h3>
	<form > 
	<button class="button"><a href="signout.php">Signout</a></button>
	</form>
	<table border="2" align="center" style="background-color: white;">
		<tr><td>Product Id</td><td>Product Name</td><td>Product Type</td><td>Product Amount</td><td>Product Price</td><td>Product Description</td><td>Seller ID</td></tr>

		<?php 
		foreach($_SESSION['user_cart'] as $item){
			$sql = "select * from products where PRODUCT_ID='".$item."'";
			$result = getJSONFromDB($sql);
			$table = json_decode($result,true);
		
			foreach($table as $element){
				$amountSelector = "";
				for($i=1; $i<=$element['PRODUCT_AMOUNT'];$i++){
					$amountSelector .= '<option value="'.$i.'">'.$i.'</option>';
				}
				
			
				echo "<tr><td>".$element['PRODUCT_ID']."</td><td>".$element['PRODUCT_NAME']."</td><td>".$element['PRODUCT_TYPE']."</td><td><select>".$amountSelector."</select></td><td>".$element['PRODUCT_PRICE']."</td><td>".$element['PRODUCT_DESCRIPTION']."</td><td>".$element['SELLER_ID']."</td><td><a href='process.php?product_id=".$element['PRODUCT_ID']."&seller_id=".$element['SELLER_ID']."'>Confirm</a></td><td><a href='remove.php?product_id=".$element['PRODUCT_ID']."'>Cancel</a></td></tr>";
			}
		}
		
		
		?>
		</table>
		<h3 id="h3" style="text-align:center;" style="font-size:300%" style="color:blue;">buyerInfo</h3>
		<table border="2" align="center">
		<tr><td>Buyer Id</td><td>Buyer Name</td><td>Buyer email</td><td>Buyer Contact No</td><td>Buyer Address</td><td>Shipping Address</td></tr>

		<?php

		 echo "<tr><td>".$_SESSION["user_id"]."</td><td>".$_SESSION["user_name"]."</td><td>".$_SESSION["user_email"]."</td><td>".$_SESSION["user_contact_no"]."</td><td>".$_SESSION["user_address"]."</td><td>".$_SESSION["shipping_address"]."</td></tr>";
		?>
		
		
	</table>
		

    
    </body>
</html>
