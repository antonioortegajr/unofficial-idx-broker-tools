<?php

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
if (preg_match_all($wordpress_pattern, $data, $matches, PREG_SET_ORDER)) {
    echo "Number of WordPress indicators found: ";
    echo count($matches);
}

//WIX test
elseif (preg_match_all($wix_pattern, $data, $matches)) {
    echo "Number of WIX indicators found:";
    echo count($matches);
}

//squarespace test
elseif (preg_match_all($squarespace_pattern, $data, $matches)) {
    echo "Number of squarespace indicators found:";
    echo count($matches);
}

//drupal test
elseif (preg_match_all($drupal_pattern, $data, $matches)) {
    echo "Number of Drupal indicators found:";
    echo count($matches);
}

//joomla test
elseif (preg_match_all($joomla_pattern, $data, $matches)) {
    echo "Number of Joomla indicators found:";
    echo count($matches);
}
//weebly test
elseif (preg_match_all($weebly_pattern, $data, $matches)) {
    echo "A Weebly indicators found:";
    echo count($matches);
  }

//websitebox test
elseif (preg_match_all($weebly_pattern, $data, $matches)) {
    echo "Number of WebsiteBox indicators found:.";
    echo count($matches);
}
else{
  echo 'Unable to find CMS idendifiers on ' . $url;
}
echo '<hr>';

?>
