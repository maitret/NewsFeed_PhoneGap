<?php
header('Access-Control-Allow-Origin: *');
//header("content-type: application/javascript");
include_once("funciones.php");

error_reporting(E_ALL); ini_set('display_errors', '1');
$msg_response = "";
$msg = "";

$getTitulo = $_REQUEST['titulo'];
$getMensaje = $_REQUEST['msg'];

$api_key = "AIzaSyD0GGxeGFQMSmihB6cwefd-iUvRVV29XPQ";


//$registration_ids = array( "APA91bEWSfih_j6EZ5J8s3joTYBJ-jaEBWGPwKaL-IiGjNaS0Kek7mJ38JTvW-7hIdRFTYNxt4H4Af6fCM6lbMxrd-HLVAGtWHZLxZTSLB0U1Fc-KCusekkyeZ0tk01lN7FJs_cdlw2sczPGLG-Ca_4AtICU3QAqDIl8EjDv5AKzVF33qirI7u8" );


$registration_ids = array();

//$query_devices = "SELECT * FROM `usuarios` WHERE `uuid` != '' AND `platform` = 'Android' ORDER BY id DESC"; 
$query_devices = "SELECT DISTINCT `token_push` FROM `usuarios` WHERE `uuid` != '' AND `platform` = 'Android' ORDER BY id DESC"; 
$result_devices = $mysqli->query($query_devices); 
$num_devices = $result_devices->num_rows; 
if($num_devices >= 1){
while($devices = $result_devices->fetch_array(MYSQLI_ASSOC)) {
$registration_ids[] = $devices['token_push'];
}
}

if($getTitulo == ""){
$title = "News Feed";
} else {
$title = $getTitulo;
}


if($getMensaje != "")
{
$message = $getMensaje;

// URL to POST to
$gcm_url = 'https://android.googleapis.com/gcm/send';

// data to be posted
$messageUrl = array( "title" => $title, "body" => $message );
$fields = array(
                'registration_ids'  => $registration_ids,
                'data'              => array( "title" => $title, "message" => $message, "body" => $message, "message-url" => $messageUrl ),
                'message-url'        => array( "title" => $title, "body" => $message )
                );

// headers for the request
$headers = array(
                    'Authorization: key=' . $api_key,
                    'Content-Type: application/json'
                );

$curl_handle = curl_init();

// set CURL options
curl_setopt( $curl_handle, CURLOPT_URL, $gcm_url );
curl_setopt( $curl_handle, CURLOPT_POST, true );
curl_setopt( $curl_handle, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $curl_handle, CURLOPT_RETURNTRANSFER, true );
curl_setopt( $curl_handle, CURLOPT_POSTFIELDS, json_encode( $fields ) );
$response = curl_exec($curl_handle);
curl_close($curl_handle);

echo $response;
echo "<hr>";

// let's check the response
//$data = json_decode($response);
//print_r($data['results']);
/*
foreach ($data['results'] as $key => $value) {
    if ($value['registration_id']) {
        $msg_response .= printf("%s has a new registration id: %s\r\n", $key, $value['registration_id']);
    }
    if ($value['error']) {
        $msg_response .= printf("%s encountered error: %s\r\n", $key, $value['error']);
    }
    if ($value['message_id']) {
        $msg_response .= printf("%s was successfully sent, message id: %s", $key, $value['message_id']);
    }
}
*/

} else {
$msg = "Ingrese un mensaje";
}
?>

<hr>

<?php echo $msg_response; ?>
<form action="envia_push.php" method="post">

<?php echo $msg; ?>
<br>
<textarea name="titulo" placeholder="<?php echo $title; ?>"><?php echo $title; ?></textarea>
<textarea name="msg" placeholder="<?php echo $msg; ?>"><?php echo $getMensaje; ?></textarea>
<br>
<button type="submit">Enviar</button>
</form>

<?php
echo json_encode($registration_ids); 
?>