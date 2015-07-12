<?php
date_default_timezone_set('America/Mexico_City');
//header('Content-Type: text/html; charset=ISO-8859-1');

set_time_limit(86400);
ini_set('memory_limit', '20000M');

error_reporting(E_ALL); ini_set('display_errors', '0');

function Valida($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function Valida_utf8($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = utf8_decode($data);
    return $data;
}

$random = substr(md5(uniqid(rand())),0,6);

$mysqli = new mysqli("us-cdbr-azure-southcentral-e.cloudapp.net", "b2a3ed2344d9d2", "2d42e563", "newsfeed");
if ($mysqli->connect_errno) {
echo "Lo sentimos pero se presento un error al conectarse en la base de datos MySQLi (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


if($server == "")
{ $server = $_SERVER["SERVER_NAME"]; }
else {  }
$url_server = "//".$server."";
$server_url = "//".$server."";

function url_server()
{
$isSecure = false;
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
$isSecure = true;
}
$HTTP = $isSecure ? 'https:' : 'http:';
$server = $_SERVER["SERVER_NAME"];
$url_server = "//".$server."";
return $url_server;
}


function FormTarget_Ajax($target_id)
{
if($target_id =="") { $target_id = "form"; } else {  }
/*
$url_server = url_server(); fa-spinner fa-cog
//$("#response_{$target_id}").html('Error: <br/> textStatus='+textStatus+', errorThrown='+errorThrown+'');
jQuery(document).ready(function($){
*/
$print = <<<EOF
<script type="text/javascript">
$(document).ready(function() {
$("#submit_{$target_id}").click(function(){
$("#source_{$target_id}").submit(function(e){
$("#response_{$target_id}").html("<div class='alert alert-info'><b><i class='fa fa-spinner fa-spin'></i> Un momento...</b></div>");
var postData_{$target_id} = $(this).serializeArray(); var formURL_{$target_id} = $(this).attr("action");
$.ajax( { url : formURL_{$target_id}, type: "POST", data : postData_{$target_id}, success:function(data, textStatus, jqXHR){
$("#response_{$target_id}").html(''+data+'');
$('#submit_{$target_id}').prop("disabled",false); }, error: function(jqXHR, textStatus, errorThrown){
$("#response_{$target_id}").html('Error: <br/> '+JSON.stringify(jqXHR)+'');
$('#submit_{$target_id}').prop("disabled",false); } });
e.preventDefault();
$("#source_{$target_id}").unbind(); $('#submit_{$target_id}').prop("disabled",true); }); $("#source_{$target_id}").submit();
});
function getDoc(frame) { var doc = null; try { if (frame.contentWindow) { doc = frame.contentWindow.document; } } catch(err) {  } if (doc) { return doc; } try { doc = frame.contentDocument ? frame.contentDocument : frame.document; } catch(err) { doc = frame.document; } return doc; }
});
</script>
EOF;
return $print;
}

?>