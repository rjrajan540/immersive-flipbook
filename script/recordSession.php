<?php

require_once '../includes/function.php';

$session_id = $_POST['session_id'];
$page_range = $_POST['page_range'];
$page_id    = $_POST['page_id'];

if ($session_id && $page_range && $page_id) {
    $created_on = date("Y-m-d H:i:s");

    $col_arr = ['session_id','page_range','page_id','created_on'];
    $val_arr = [$session_id,$page_range,$page_id,$created_on];
    sql_insert("user_trigger",$col_arr,$val_arr);
}