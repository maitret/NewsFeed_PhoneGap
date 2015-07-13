<?php
header('Access-Control-Allow-Origin: *');
header("content-type: application/javascript");
include_once("funciones.php");

set_time_limit(86400);
ini_set('memory_limit', '20000M');
error_reporting(E_ALL); ini_set('display_errors', '0');

//echo json_encode($_REQUEST);
/*
$query_select = "SELECT * FROM `posts` ORDER BY id DESC ";
$result_select = $mysqli->query($query_select);
$num_select = $result_select->num_rows;

$post_json = array();
while($selects = $result_select->fetch_array(MYSQLI_ASSOC)) {
$post_json[] = $selects;
}*/
//echo json_encode($post_json);
header("Location: index.html");
?>