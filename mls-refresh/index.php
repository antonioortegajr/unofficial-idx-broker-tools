<html>
<head>
</head>
<body style="padding-left: 10%; padding-right: 10%;">
<h1>Check the last refresh of the MLS data via API</h1>
<p>You can use the API to check the last refresh of the MLS data.</p>
  <h3>Remember</h3>
  <ul>
    <li>Download time and processing time differ</li>
    <li>Image process are seperate from this as we download images for some MLSs and the MLS hosts others</li>
    <li>Images are normally downloaded after properties</li>
  </ul>
  <p>Enter a valid API key from an account.</p>
  <p>This will make multiple API calls. One to get the approved MLSs and one for each MLS on the account.</p>
  <form action='' method="POST">
    API key: <input name="key">
    <button>Send</button>
  </form>
<hr>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

$api_key = $_POST["key"];

//call api with api key provided to get approved MLSs unless an array of MLSs is provided.
//Then get the refreshtime for each approved MLS
function api_call($api_key, $mls){

//determine string length as all IDX MLS IDs are 4 chrachters long
if(strlen($mls) !== 4){
  //assume 4 char sting length means this is an IDX MLS ID
  $api_endpoint = 'approvedmls';
}
else{
  //set API endpoint to get approved MLSs for this API key
  $api_endpoint = 'age/'.$mls;
}

  // access URL and request method
$url = 'https://api.idxbroker.com/mls/'.$api_endpoint;
$method = 'GET';

// headers (required and optional)
$headers = array(
	'Content-Type: application/x-www-form-urlencoded', // required
	'accesskey: '.$api_key, // required - replace with your own
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

//return response
return $response;
}


// initial call to get approved MLSs for this API key
$approvedmls = api_call($api_key, $mls);

$r = json_decode($approvedmls, true);

foreach ($r as $key => $value) {
  //loop through array of approved MLS IDs and evho out data
  $mls = $value["id"];
  echo 'MLS name: '.$value["name"];
  echo '<br>';
  echo 'IDX MLS ID: '.$mls;
  echo '<br>';
  $refreshtime = api_call($api_key, $mls);
  echo ' Refresh time: '.$refreshtime;
  echo '<br><br>';
}



}

 ?>
<hr>
<h3>What if I am still missing properties???</h3>
If you are still missing properties and you knwo the property was entered in the MLS after the processing time shown above:
<ul>
<li>Check that the porperty is allowed to be shown via IDX</li>
<li>Send the MLS listing ID of the property and the domain of the cleint to developers@idxbroker.com</li>
</ul>
<h3>What if I am still missing images???</h3>
<ul>
<li>If the MLS jsut processed give it a few hours as images run after that and time varies by size of the MLS</li>
<li>Send the MLS listing ID of the property and the domain of the cleint to developers@idxbroker.com</li>
</ul>
</body>
</html>
