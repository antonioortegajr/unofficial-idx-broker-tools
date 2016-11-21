<?php

//get page count? No way to do this via API yet.
echo '<h2>Check your page count with google:</h2> <a href="'.'https://www.google.com/webhp?ion=1&espv=2&ie=UTF-8#q=site%3A'.urlencode($url).'" target=_"blank">site:'.$url.'</a> This is the number of pages google as index from you site. The higher the number, the more pages google has assoiated with your domain and subdomains.';
echo $breaks;

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
    $mobile_friendly = $result["ruleGroups"]["USABILITY"]["pass"];
    //Check for mobile friendlyness
    switch ($mobile_friendly) {
      case 0:
      $mobile_friendly = '<h2>False!</h2> Not mobile friendly. <br>
      Visit <a href=https://www.google.com/webmasters/tools/mobile-friendly/?url='.$url.' target="_blank">Google\'s mobile test page</a> for more info.
      <br>With more and more traffic happening on mobile devices mobile friendliness is critical.';
      break;
      case 1:
      $mobile_friendly = '<h2>True</h2>According to the Google Page Speed API V3 your page is mobile friendly';
      break;
    }

    echo '<h2>Is your site Mobile Friendly?:</h2> '.$mobile_friendly;
    echo $breaks;
    $page_speed = $result["ruleGroups"]["USABILITY"]["score"];
    if(isset($page_speed)){
      echo '<h2>Google Page Speed score:</h2> '.$page_speed.' This is google\'s page speed score for your site. The scale goes to 100.';
    }
    echo $breaks;
?>
