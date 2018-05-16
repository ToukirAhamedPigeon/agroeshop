<?php
session_start();

for($i=0;$i<count($_SESSION['user_cart']);$i++){
	if($_SESSION['user_cart'][$i] == $_REQUEST['product_id']){
		unset($_SESSION['user_cart'][$i]);
		header('location:order.php');
	}
}

?>