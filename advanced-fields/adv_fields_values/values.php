<?php
$value = $_GET["name"];

$key =  $_GET["key1"];

$dev_key = $_GET["key2"];

$mlsid =  $_GET["mls"];

$propt = '1';

// access URL and request method
$url = 'https://api.idxbroker.com/mls/searchfieldvalues/' . $mlsid . '?mlsPtID='. $propt . '&name=' . $value;
$method = 'GET';

// headers (required and optional)
$headers = array(
	'Content-Type: application/x-www-form-urlencoded', // required
	'accesskey: ' . $key, // required - replace with your own
	'ancillarykey: ' . $dev_key, // optional and for partners only - replace with your own
	'outputtype: json' // optional - overrides the preferences in our API control page
);

// set up cURL
$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

// exec the cURL request and returned information. Store the returned HTTP code in $code for later reference
$response = curl_exec($handle);
$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if ($code >= 200 || $code < 300)
	$fields = json_decode($response,true);
else
	$error = $code;

echo $code;

echo '<br>';

echo 'url used, mls, and keys: ' .  $url .  ' and ' . $key .  ' and ' . $dev_key;

echo '<br><br>';

var_dump($response);



?>
