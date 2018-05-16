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

$sql = "select * from products where PRODUCT_ID='".$_GET['product_id']."'";
$result = getJSONFromDB($sql);
$table = json_decode($result,true);	
$_SESSION["product_name"] = $table[0]["PRODUCT_NAME"];
$_SESSION["product_type"] = $table[0]["PRODUCT_TYPE"];
$_SESSION["product_amount"] = $table[0]["PRODUCT_AMOUNT"];
$_SESSION["product_price"] = $table[0]["PRODUCT_PRICE"];
$_SESSION["product_description"] = $table[0]["PRODUCT_DESCRIPTION"];
$_SESSION["seller_id"] = $table[0]["SELLER_ID"];
	 ?>
	
<!DOCTYPE html>
 <html>
	<head>
		<title> Editproduct </title>
		<style type="text/css">
		
		input[type="text"],[type="number_format"]{
		width:300px;
		height:30px;
		font-size:17px;
		margin-top:20px;
		margin-bottom:10px;
		padding-left:10px;
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
		</style>
		
	<script type="text/javascript">

	</script>
	</head>
    <body background="sugarcane.jpg" style ="background-size:cover"></br>  
	<h1 style="text-align:center;" style="font-size:300%" style="color:black;">editProducts</h1>
	<h3 id="h3" style="text-align:center;" style="font-size:300%" style="color:blue;"></h3>

    <div class="form"> 
        
		    <form action="editproducts.php" method="POST" style="text-align:center;"></br></br>
				<div class="form-input">
				<input type="hidden" placeholder="your product id" name="product_id" value=<?php echo 
				
				$_REQUEST["product_id"];?>
				</div>
                <div class="form-input">
				<input type="text" placeholder="your product name" name="product_name" value=<?php echo 
				
				$_SESSION["product_name"];?>
				</div>
				<div class="form-input">
				<input type="text" placeholder="your product type" name="product_type" value=<?php echo 
				
				$_SESSION["product_type"];?>
				</div>
				<div class="form-input">
				<input type="text" placeholder="your product amount" name="product_amount" value=<?php echo 
				
				$_SESSION["product_amount"];?>
				</div>
				<div class="form-input">
				<input type="text" placeholder="your product price" name="product_price" value=<?php echo 
				
				$_SESSION["product_price"];?>
				</div>
				<div class="form-input">
				<input type="text" placeholder="your product description" name="product_description" value=<?php echo 
				
				$_SESSION["product_description"];?>>
				</div>
				<div class="form-input">
				<input type="text" placeholder="your seller id" name="seller_id" value=<?php echo 
				
				$_SESSION["seller_id"];?> </br>
				</div>
				<input type= "submit" value= "edit"/></br></br>
               
		    </form>
    </div>
    </body>
</html>