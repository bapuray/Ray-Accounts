<?php 

	$db_type='mysql';
	$db_server = 'localhost';
	$db_name = 'ray_accounts';
	$db_user = 'root';
	$db_pass = '';

	try{
		$conn = new PDO($db_type.':host='.$db_server.';dbname='.$db_name.'', $db_user, $db_pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOExeption $e){
		echo "Error: Access Denied / connection error";
		exit();
	}
	