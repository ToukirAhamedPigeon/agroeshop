<?php
	$conn=oci_connect(
		'record', '123456', 'localhost/XE'
	);

	if(!$conn)
	{
		$e = oci_error();
		die($e['message']);
	}
	// else
	// {
	// 	echo "ok";
	// }
?>
