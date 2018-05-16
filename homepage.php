<?php session_start();?>


<!DOCTYPE html>
 <html>
	<head>
		<title> Homepage </title>
		<style type="text/css">

		input[type="text"]{
		width:300px;
		height:30px;
		font-size:17px;
		margin-bottom:50px;
		padding-left:30px;
		background:#fff;
		border:20px;
		border-radius:15px;
		padding-top:5px;
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
			float:right;
		}
		</style>
<script>
function showHint() {
	if(document.getElementById('mytext').value != ""){
		str=document.getElementById('mytext').value;
		
		var xmlhttp = new XMLHttpRequest();
		
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var data = xmlhttp.responseText;
				var jsonResponse = JSON.parse(data);
				document.getElementById("txtHint").innerHTML = "";
				
				for(var i in jsonResponse){
					//document.getElementById("txtHint").innerHTML += jsonResponse[i]['product_name'] + "<br/>";
					createListItem(jsonResponse[i]);
				}
				
			}
		};

	
	var url="jsondb.php?product_name="+str;
	xmlhttp.open("GET", url, true);
	xmlhttp.send();
	}
	else
		document.getElementById('txtHint').innerHTML = "";
}

function createListItem(item){
	var productId = item['PRODUCT_ID'];
	var productName = item['PRODUCT_NAME'];
	var productType = item['PRODUCT_TYPE'];
	var productQty = item['PRODUCT_AMOUNT'];
	var productPrice = item['PRODUCT_PRICE'];
	var productDesc = item['PRODUCT_DESCRIPTION'];
	var user; 
	
	var xmlhttp = new XMLHttpRequest();
		
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var data = xmlhttp.responseText;
			//alert(data);
			user = JSON.parse(data);
			//alert(user);
		}
	};
    
	var url="jsondb2.php?user_id="+item['SELLER_ID'];
	//alert(url);
	xmlhttp.open("GET", url, false);
	xmlhttp.send();
	
	var userName = user[0]['USER_NAME'];
	//alert(userName);
	
	document.getElementById("txtHint").innerHTML += '<div class="listItem"> <b>Product Name: </b> '+productName+' <br/> <b>Product Type: </b> '+productType+' <br/> <b>Available Stock: </b> '+productQty+' <br/> <b>Price: </b> '+productPrice+' <br/> <b>Product Description: </b> '+productDesc+' <br/> <b>Seller: </b> '+userName+' <br/> <form method="post"> <input type="hidden" name="product_id" value="'+productId+'"/> <input class="button" type="submit" value="Buy Product"/> </form> </div> <br/>';
	
}

function doNothing(){
	
}

</script>
	</head>
	<body background="saccharum.jpg" style ="background-size:cover"> 
	<span class="form">
		<h1 style="text-align:left;" style="font-size:300%" style="color:blue;">AGRO eSHOP</h1>
				<input type="text" placeholder="search your products to buy" id="mytext" name="product_name" onkeyup="showHint()" onkeydown="if (event.keyCode == 13){doNothing();}" />
			<?php if(isset($_SESSION['user_email']) && $_SESSION['user_type'] == "Seller") {echo '<button class="button"><a href="sellproduct.php">Sell Product</a></button>';}?>
			<?php if(isset($_SESSION['user_email'])) {echo '<button class="button"><a href="signout.php">Signout</a></button>';}
			else {echo '<button class="button"><a href="signin.html">Signin</a></button>';}?>
			
			<?php 	if(isset($_SESSION["user_cart"]) && isset($_SESSION['user_email'])){
						echo '<button class="button" id="checkoutBtn" style="float:right;visibility:visible"><a href="order.php">Check</a></button>';
					}
					else{
						echo '<button class="button" id="checkoutBtn" style="float:right;visibility:hidden"><a href="order.php">Check</a></button>';
					}
			?>
			
			

			<div id = "txtHint"></div>
		</span>
	</body>
	
<?php

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_SESSION['user_email'])){
	
	
	if(!isset($_SESSION["user_cart"])){
		$_SESSION["user_cart"][] = $_POST['product_id'];
		echo '<script> document.getElementById("checkoutBtn").style.visibility = "visible"; </script>';
	}
	else{
		$flag = true;
		foreach($_SESSION["user_cart"] as $item){
			if($_POST['product_id'] == $item){
				$flag = false;
				echo "<script>alert('Product already in your cart');</script>";
			}
		}
		if ($flag){
				$_SESSION["user_cart"][] = $_POST['product_id'];
			}
	}


}
?>

</html>

