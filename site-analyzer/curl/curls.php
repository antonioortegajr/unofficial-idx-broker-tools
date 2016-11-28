<?php

//function to use cURL and return status code as well as body
function use_curl($url){

  //cURL the provided url
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($ch, CURLOPT_TIMEOUT, 10);
 curl_setopt($ch, CURLOPT_HEADER,true);
 $response = curl_exec($ch);
 $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 $return = array($code, $response);
 return $return;
}

//cURL page given
$data = use_curl($url);

//Check for redirect
if ($data[0] == 301){
  $redirect = get_headers($url);
  $url = $redirect[6];
  $pieces = explode(" ", $url);
  $url = $pieces[1];
  echo '301 detected cheking ' . $url;
  $data = use_curl($url);
  $data =$data[1];
}
else {
  $data =$data[1];
}





 ?>
