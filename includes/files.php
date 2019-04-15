<?php 
include 'functions.php';

if( !isset($_SESSION) ){
	session_start();
}
include 'db_config.php';

if( !isset( $_SESSION["is_login"] ) || $_SESSION['is_login'] != true ){
	header("location:index.php");
	exit;
}