<?php
include '../includes/files.php';

$id = isset($_GET['id'])?$_GET['id']:0;

$arr_update = array();
$arr_update['status'] = 0;

$where = ' id = '.$id;

db_update('account_data',$arr_update,$where);

echo "Deleted";
