<?php
header('Access-Control-Allow-Origin: *');
header("content-type: application/javascript");
include_once("funciones.php");

set_time_limit(86400);
ini_set('memory_limit', '20000M');
error_reporting(E_ALL); ini_set('display_errors', '0');

$id_nota = $_REQUEST['id_nota'];

//echo json_encode($_REQUEST);

if($id_nota == ""){
$query_select = "SELECT * FROM `posts` ORDER BY id DESC LIMIT 1";
} else {
$query_select = "SELECT * FROM `posts` WHERE `id` = '".$id_nota."' ORDER BY id DESC LIMIT 1";
}



$result_select = $mysqli->query($query_select);
$num_select = $result_select->num_rows;

$post_json = array();
$all_data = array();
while($selects = $result_select->fetch_array(MYSQLI_ASSOC)) {
$post_json[] = $selects;
}

$all_data = array("nota"=>$post_json, "cat" => $cat);
echo json_encode($all_data);
?>