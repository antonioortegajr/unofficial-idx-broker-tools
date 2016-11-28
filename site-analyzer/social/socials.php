<?php
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
  echo '<p>Several soucial media links found, looks like social might be important to your site
  </p>
  <p>IDX Broker offers a facebook applicaion to bring your listings into your facebook business page:
  </p>
  <p><a href="http://www.idxbroker.com/features/idx-facebook-application" target="_blank">http://www.idxbroker.com/features/idx-facebook-application</a>';
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
echo '<p>Even if social meida isn\'t the biggest aspect of your online stratagy, IDX Broker offers sharing oppertunity via ShareThis:
  </p>
  <p>
  <a href="http://www.idxbroker.com/features/social-media-sharing-tools" target="_blank">http://www.idxbroker.com/features/social-media-sharing-tools</a>
  </p>';
}
echo '<hr>';

//find email address
//regex for emails that are not in an anchor
//$email_pattern = '#\w+@[\w.-]+|\{(?:\w+, *)+\w+\}@[\w.-]+#';
//preg_match_all($email_pattern, $html, $matches);


//merge first email to array
//foreach ($matches as $match){
  //echo "Email found: ".$match[0]." ...";
//}






 ?>
