<?php
require_once "db.php";

// ALL CUSTOM FUNCTION DEFINED HERE
function sql_arr($cmd){
	$d1 = new dbconn();
	$db = $d1->connect();
	// print_r($db);
	$result = $db->query($cmd);
	// print_r($result);
	$row = $result->fetchAll(PDO::FETCH_ASSOC);
	$db = null;
	return $row;
}

function sql_insert($table, $col_arr, $val_arr){
	$d1 = new dbconn();
	$db = $d1->connect();
	$col_str = implode(",", $col_arr);
	$valued_str = ":" . implode(",:", $col_arr);

	$cmd = "INSERT INTO $table ($col_str) values ($valued_str)";
	$query = $db->prepare($cmd);

	$actual_arr = array_combine($col_arr, $val_arr);
	$result = $query->execute($actual_arr);
}
