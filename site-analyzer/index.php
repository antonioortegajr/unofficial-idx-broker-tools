<?php

//url to check
$url = htmlspecialchars($_GET["domain"]);

if ($url != NULL){

	//Google page speed test
	/**
 	* @param $url
 	* @param $apiKey
 	* @return mixed
 	*/
	function isMobileReady($url, $apiKey)
		{
    		$curl = curl_init();
    		curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://www.googleapis.com/pagespeedonline/v3beta1/mobileReady?key='.$apiKey.'&url='.$url.'&strategy=mobile',
    		));
    		$resp = curl_exec($curl);
    		curl_close($curl);
    		return $resp;
			}

			//result as an array
			$result = json_decode(isMobileReady($url, 'AIzaSyBIO6HebUdpY_idIdH2t3FDq0obSnu0NZA'), true);


			//page html
			echo '<h1>Check your website</h1><p>Let\'s check your website for attributes all current real estate websits should measure.' ;
			$breaks = '<br><br>';

			//Site checked
			echo '<h2>Site checked:</h2> '.$url;
			echo $breaks;


			//get page count? No way to do this via API yet.
			echo '<h2>Check your page count with google:</h2> <a href="'.'https://www.google.com/webhp?ion=1&espv=2&ie=UTF-8#q=site%3A'.urlencode($url).'" target=_"blank">site:'.$url.'</a> This is the number of pages google as index from you site. The higher the number the more pages google has assoiated with your domain and subdomains.';
			echo $breaks;


			//Check for mobile friendlyness
			switch ($result["ruleGroups"]["USABILITY"]["pass"]) {
				case 0:
				$mobile_friendly = 'False. With more and more traffic happening on mobile devices mobile friendliness is critical.';
				break;

				case 1:
				$mobile_friendly = 'True. Yay!!!';
				break;
			}
			echo '<h2>Is your site Mobile Friendly:</h2> '.$mobile_friendly;
			echo $breaks;
			echo '<h2>Google Page Speed score:</h2> '.$result["ruleGroups"]["USABILITY"]["score"].' This is google\'s page speed score for your site. The scale goes to 100.';
			echo $breaks;


			//checking for iframes

     	//cURL the provided url
    	$ch = curl_init($url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  		$data = curl_exec($ch);
  		echo '<h2>Check for iframes</h2>';
			$iframe = "/<iframe(.*)<\/iframe>/U";
			$pos = strpos($data, $iframe);
			if ($pos === false) {
    		echo 'iframes were not found in the site. Great!! Google and search engine crawlers, are unable to index the contect inside of an iframe. If the most important content on the page such as property details pages are within an iframe google is not indexting this content with your website.';
			} else {
    		echo 'iframnes found ';
    		echo ' and exists at position'.$pos.'If this is your search please click here to learn more about iframes and real estate SEO.';
			}
		echo '<br><hr><br>';


}
else{
	echo '<h1>Analyze your website</h1><p>Let\'s check your website for attributes all current real estate websits should measure.</p><p>Please enter a url</p><form action="" method="GET"><input name="domain"><input type="submit" value="Submit">';
}

?>
