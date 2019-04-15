<?php
include '../includes/db_config.php';
include '../includes/functions.php';

$uname = isset( $_REQUEST["username"] ) ? ( $_REQUEST["username"] ) : "";
$password = isset( $_REQUEST["password"] ) ? ( $_REQUEST["password"] ) : "";
$redirectTo = isset( $_REQUEST["redirect"] ) ? ( $_REQUEST["redirect"] ) : "";

$arr_login_msg = array(
	"0" => "Some error occured. Contact your administrator",
	"1" => "Username and password correct. Redirecting...",
	"2" => "Username and password do not match",
	"3" => "Exceeded 3 attempts. Please contact administrator",
	"4" => "Please enter a username",
	"5" => "Please enter a password",
	"6" => "Please enter a username AND a password",
	"7" => "Username and password do not match",
	"8" => "Sorry, you do not have access to this system",
);

$status = 0;
// Pre-verification for empty and illegal characters
if( $uname == "" && $password == "" ) { $status = 6; }
else if( $uname == "" ) { $status = 4; }
else if( $password == "" ) { $status = 5; }

if( $status == 0 ){
	$sql_user="
		SELECT
			id,full_name,username,salt,password,is_admin,status
		FROM users
		WHERE
			1=1
			AND status = 1
			AND username = '$uname'
	";
	$arr_user = db_one($sql_user);

	$blowfish_pre = '$2a$05$';
	$blowfish_end = '$';
	$hashed_pass = crypt($password, $blowfish_pre . $arr_user['salt'] . $blowfish_end);
	
	if($hashed_pass == $arr_user['password']){
		if($arr_user["status"] == 0){
			$status = 8;
		}else{
			$status = 1;
			session_start();
			$_SESSION["logged"] = true;
			$_SESSION["is_login"] = true;
			$_SESSION["uid"] = $arr_user["id"];
			$_SESSION["full_name"] = $arr_user["full_name"];
			$_SESSION["is_admin"] = $arr_user["is_admin"];

		}
	}else{
		$status = 7;
	}
}
$msg = $arr_login_msg[ $status ];
$ret = array();
$ret['status'] = $status;
$ret['msg'] = $msg;
$url = '';
if($status !=7 ){
	if($_SESSION["is_admin"]){
		$url= 'dashboard_admin.php';
	}else{
		$url= 'data_entry.php';
	}
	
}
$ret['path']=$url;
echo json_encode( $ret );