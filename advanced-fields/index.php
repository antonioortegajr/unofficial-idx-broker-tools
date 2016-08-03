<html>
<head>
</head>
<body style="padding-left: 10%; padding-right: 10%;">

<?php
$test_key = $dev_test_key = $mlsID  = $meth = $out = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   $test_key = test_input($_POST["test_key"]);
   $dev_test_key = test_input($_POST["dev_test_key"]);
   $meth = test_input($_POST["meth"]);
   $out = test_input($_POST["out"]);
   $mlsID = test_input($_POST["mlsID"]);
}

function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>



<h1>Quick API Advanced Fields check</h1>

<!--- Nick's API key: <b>nb3aPvidEaSFgt6ncJHtGw</b><br><br>and the<br><br>Dev Partner key for his account:<b> YLYsuwps-9kG0PyicpGsQZ</b> </p> -->
<p>Currently tests the API response for Advanced Search Fields in prop type 1, some time and size reporting, and Get call tests based on example code from API docs. Output is json or xml. Not choosing an output will assume json when making the call.</p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   Test Key: <input type="text" name="test_key">
Test Dev Partner Key: <input type="text" name="dev_test_key">
<br>MLS ID: <input type="text" name="mlsID">
<br><br>
Sample API call for advanced fields<br>
<br>
   <br><br>
   <input type="submit" name="submit" value="Submit">
</form>

<?php

$method = 'GET';



if ($test_key == "")
 {

echo '<br><br><h2>Please enter an API key to test</h2>';
}


else if ($meth == "")
{


$url = 'https://api.idxbroker.com/mls/searchfields/'  . $mlsID  . '?filterField=mlsPtID&filterValue=1';
$out = 'json';
// headers (required and optional)
$headers = array(
	"Content-Type: application/x-www-form-urlencoded", // required
	"accesskey: " . $test_key, // required - replace with your own
        "ancillarykey: " . $dev_test_key,
	"outputtype: " . $out // optional - overrides the preferences in our API control page

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
$total_time = curl_getinfo($handle, CURLINFO_TOTAL_TIME);
$avg_down_speed = curl_getinfo($handle, CURLINFO_SPEED_DOWNLOAD);
$total_download_size = curl_getinfo($handle, CURLINFO_SIZE_DOWNLOAD);
$connect_time = curl_getinfo($handle, CURLINFO_CONNECT_TIME);




if ($code >= 200 || $code < 300)

if ($out == 'xml') {

echo '';

}

else

{
$response = json_decode($response,true);
}




else
	$error = $code;


	echo '<br><br>Returned response code from API: <b>';
echo  $code;

		if($code == 200) {

		echo '</b> means we are All Good.';

		}

                if($code == 204) {

		echo ' means that the request was received and understood, but that there is no need to send any data back.';

		}



                if($code == 401) {



   			echo 'means accesskey not valid or revoked';

   		}


   		if($code == 403) {



   			echo 'means API call is not using SSL and does not use HTTPS.';

   		}


   		if($code == 405) {

   			echo ' means method requested is invalid. I messed something in my code and I am an idiot';

   		}

   		if($code == 406) {

   			echo ' means an access key is not provided.';

   		}


   		if($code == 409) {

   			echo ' means the API call has an invalid API component specified. So I failed to specify something in this call.';

   		}


   		if($code == 412) {

   			echo ' means the account is over the hourly access limit of API calls.';

   		}

   		if($code == 500) {

   			echo ' means General system error.';

   		}


   		if($code == 503) {

   			echo ' means scheduled API maintenance is currently occurring.';

   		}

echo '</b><br><br>API key used: <b>';

echo $test_key . ' and the Partner Key is: ' . $dev_test_key;

echo '</b><br>';

echo '<br>URL used: ' . $url;

echo '<br>Total Time: '. $total_time . ' (Total transaction time in seconds for last transfer)';

echo '<br>Time to establish connection: ' . $connect_time;

echo '<br>Average download speed: '. $avg_down_speed;

echo '<br>Total download size: '. $total_download_size . ' bytes';

  }

else
{
echo 'Go!';
}



echo '<br><br>';
foreach ($response as $item) {

echo '<a href="adv_fields_values/values.php?name=' . $item["name"] . '&key1=' . $test_key . '&key2=' . $dev_test_key  . '&mls=' . $mlsID  .  '" target="_blank">' . $item["name"] . '</a>' ;
echo '<br>';


}

?>
<p><br><br><hr>This page is for testing purposes only. The code for it is not pretty or elegant.</p>
</body>
</html>
