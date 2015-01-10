<?php
if(isset($_POST['g-recaptcha-response'])){
echo verify($_POST['g-recaptcha-response']);

}

function verify($response) {
$ip = $_SERVER['REMOTE_ADDR']; //server Ip
$key=""; // google re-captcha Secret key

//Build up the url
$url = 'https://www.google.com/recaptcha/api/siteverify';
$full_url = $url.'?secret='.$key.'&response='.$response.'&remoteip='.$ip;

//Get the response back decode the json
$data = json_decode(file_get_contents($full_url));
//Return true or false, based on users input
if(isset($data->success) && $data->success == true) {
return true;
}
return false;
}
?>