<?php
header('Access-Control-Allow-Origin: *');
header("content-type: application/javascript");
include_once("funciones.php");

set_time_limit(86400);
ini_set('memory_limit', '20000M');

error_reporting(E_ALL); ini_set('display_errors', '0');

extract($_REQUEST);

//$cat = $_REQUEST['cat'];
//echo json_encode($_REQUEST);
//mail("maitret@myhostmx.com", "cliente", json_encode($_REQUEST)); 

/*
$device = Valida_utf8($_REQUEST['device']);
$platform = Valida_utf8($_REQUEST['platform']);
$token_push = Valida_utf8($_REQUEST['token_push']);
$lat = Valida_utf8($_REQUEST['lat']);
$lon = Valida_utf8($_REQUEST['lon']);
*/

if($device != "" && $platform != ""){ }
$query_insert = "INSERT INTO `usuarios` (`device`, `platform`, `token_push`, `lat`, `lon`, `all_data`) VALUES ('".$device."', '".$platform."', '".$token_push."', '".$lat."', '".$lon."', '".json_encode($_REQUEST)."');";
$result_insert = $mysqli->query($query_insert);
//echo $mysqli->error;



if($cat == ""){
$query_select = "SELECT * FROM `posts` ORDER BY id DESC ";
} else {
$query_select = "SELECT * FROM `posts` WHERE `Cat` = '".$cat."' ORDER BY id DESC ";
}

$result_select = $mysqli->query($query_select);
$num_select = $result_select->num_rows;

$post_json = array();
$all_data = array();
while($selects = $result_select->fetch_array(MYSQLI_ASSOC)) {

$Cuerpo = strip_tags($selects['Cuerpo'], '');
$MiniCuerpo = substr($Cuerpo,0,50);
if($MiniCuerpo != $Cuerpo) { $MiniCuerpo = "".$MiniCuerpo."... "; } else {  }
if($MiniCuerpo == "") { $MiniCuerpo = "<em>Sin comentarios</em>"; }
$selects['Cuerpo'] = $MiniCuerpo;

$Titulo =  strip_tags($selects['Titulo'], '');
$MiniTitulo = substr($Titulo,0,50);
if($MiniTitulo != $Titulo) { $MiniTitulo = "".$MiniTitulo."... "; } else {  }
if($MiniTitulo == "") { $MiniTitulo = substr($MiniCuerpo,0,25); }
$selects['Titulo'] = $MiniTitulo;

$post_json[] = $selects;
}

$all_data = array("notas"=>$post_json, "cat" => $cat);
echo json_encode($all_data);
?>