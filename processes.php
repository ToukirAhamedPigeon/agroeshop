<?php
	session_start();
	if($_SESSION["user_id"]==null){
		header('Location: signin.html');
	}

 ?>
<!DOCTYPE html>
 <html>
	<head>
		<title> PlaceOrder </title>
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
    <body background="fruit.jpg" style ="background-size:cover"></br>  
	<h1 style="text-align:center;" style="font-size:300%" style="color:black;">placeOrder </h1>
	<br>
	<form > 
	<button class="button"><a href="signout.php">Signout</a></button>
	</form>
		
		
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
