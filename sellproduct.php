<?php
	session_start();
	if($_SESSION["user_id"]==null){
		header('Location: signin.html');
	}?>

<!DOCTYPE html>
 <html>
	<head>
		<title> ProductEntry </title>
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
	function check(){
		var flag=true;
		if(document.forms[0].product_name.value==""){
			flag=false;
			alert("You can not name Empty !");
		}
		else if(document.forms[0].product_type.value==""){
			flag=false;
			alert("You can not type Empty !");
		}
		else if(document.forms[0].product_amount.value==""){
			flag=false;
			alert("You can not amount Empty !");
		}
		else if(document.forms[0].product_price.value==""){
			flag=false;
			alert("You can not price Empty !");
		}
		else if(document.forms[0].product_description.value==""){
			flag=false;
			alert("You can not description Empty !");
		}
		else if(document.forms[0].seller_id.value==""){
			flag=false;
			alert("You can not id Empty !");
		}

		if(flag==true){
		document.forms[0].submit();
	}
	}
	</script>
	</head>
    <body background="sorisha.jpg" style ="background-size:cover"></br>  
	<h1 style="text-align:center;" style="font-size:300%" style="color:black;">productEntry</h1>
	<h3 id="h3" style="text-align:center;" style="font-size:300%" style="color:blue;"></h3>

    <div class="form"> 
        
		    <form action="sellproducts.php" method="POST" style="text-align:center;"></br></br> 
                <div class="form-input">
				<input type="text" placeholder="your product name" name="product_name"/>
				</div>
				<div class="form-input">
				<input type="text" placeholder="your product type" name="product_type"/>
				</div>
				<div class="form-input">
				<input type="text" placeholder="your product amount" name="product_amount"/>
				</div>
				<div class="form-input">
				<input type="text" placeholder="your product price" name="product_price"/>
				</div>
				<div class="form-input">
				<input type="text" placeholder="your product description" name="product_description"/>
				</div>
				<div class="form-input">
				<input type="text" placeholder="your seller id" name="seller_id"/>
				</div>
				<input type= "button" value= "post" onclick="check()"/></br></br>
               
		    </form>
    </div>
    </body>
</html>