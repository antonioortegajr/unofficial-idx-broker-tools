<?php


//cURL the provided url
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$data = curl_exec($ch);


//Look for CMS indentifiers in source
echo '<h2>Is this site built on a CMS?</h2>';
$wordpress_pattern = "/\bwp-(?:content|includes)\b/i";
$wix_pattern = "/\bwix(?:.com|press)\b/i";
$squarespace_pattern = "/\bsquarespace(?:.com|.com\/static)\b/i";
$drupal_pattern = "/\bdrupal(?:.js|.settings)\b/i";
$joomla_pattern = "/\bjui(?:\/js)\b/i";
$weebly_pattern = "/\bassets-www1.weebly(?:.com)\b/i";
$websitebox_pattern = "/\b\/wsbx(?:\/)\b/i";

//WP test
if (preg_match_all($wordpress_pattern, $data, $matches)) {
    echo "Number of WordPress indicators found: ";
    echo count($matches);
}

//WIX test
elseif (preg_match_all($wix_pattern, $data)) {
    echo "Number of WIX indicators found:";
    echo count($matches);
}

//squarespace test
elseif (preg_match_all($squarespace_pattern, $data)) {
    echo "Number of squarespace indicators found:";
    echo count($matches);
}

//drupal test
elseif (preg_match_all($drupal_pattern, $data)) {
    echo "Number of Drupal indicators found:";
    echo count($matches);
}

//joomla test
elseif (preg_match_all($joomla_pattern, $data)) {
    echo "Number of Joomla indicators found:";
    echo count($matches);
}
//weebly test
elseif (preg_match_all($weebly_pattern, $data)) {
    echo "A Weebly indicators found:";
    echo count($matches);
  }

//websitebox test
elseif (preg_match_all($weebly_pattern, $data)) {
    echo "Number of WebsiteBox indicators found:.";
    echo count($matches);
}
else{
  echo 'Unable to find CMS idendifiers.';
}


//checking for iframes
echo '<h2>Check for iframes</h2>';
$iframe = "/<iframe(.*)<\/iframe>/U";
$pos = strpos($data, $iframe);
if ($pos === false) {
  echo 'iframes were not found in the page. Great!! Google and search engine crawlers, are unable to index the contect inside of an iframe. If the most important content on the page such as property details pages are within an iframe google is not indexting this content with your website.';
} else {
  echo 'iframes found ';
  echo ' and exists at position'.$pos.'If this is your search, you might want to do soem research to learn more about iframes and real estate SEO.';
}



echo '<h2>How about Social?</h2>';

// parse the html into a DOM Document
$dom = new DOMDocument();
@$dom->loadHTML($data);

// grab all anchor tags the on the page
$xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("/html/body//a");

$facebook_links = array();
$twitter_links = array();

//look for fb and twitter anchor tags and count.
for ($i = 0; $i < $hrefs->length; $i++) {
  $href = $hrefs->item($i);
  $url = $href->getAttribute('href');
    //look for twitter url, but not tweets in a widget
    if (preg_match("/\btwitter.com\b/",$url) && strpos($url, '?') === false && strpos($url, 'status') === false && strpos($url, 'share') === false){
        array_push($twitter_links, $url);
        //echo "twitter link found: $url";
       }
    //look for facebook url
    if (preg_match("/\bfacebook.com\b/",$url)){
      array_push($facebook_links, $url);
       //echo "facebook link found: $url";
      }

      }

//count number of links in the arrays
$facebook_count = count($facebook_links);
$twitter_count = count($twitter_links);

if($facebook_count + $twitter_count > 4){
  echo 'Several soucial media links found, looks like social might be important to your site';
}
elseif ($facebook_count + $twitter_count == 0){
  echo 'No social media links found.';
}
else{
foreach ($facebook_links as $links) {
  echo 'Some facebook links found: '.$links. '<br>';
}
echo $breaks;
foreach ($twitter_links as $links) {
  echo 'Some twitter links found: '.$links. '<br>';
}

}

//find email address
//regex for emails that are not in an anchor
//$email_pattern = '#\w+@[\w.-]+|\{(?:\w+, *)+\w+\}@[\w.-]+#';
//preg_match_all($email_pattern, $html, $matches);


//merge first email to array
//foreach ($matches as $match){
  //echo "Email found: ".$match[0]." ...";
//}


 ?>
