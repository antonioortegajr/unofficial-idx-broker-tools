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

function site_check($type, $pattern, $data){
  if (preg_match_all($pattern, $data, $matches, PREG_SET_ORDER)) {
      echo 'Number of ' . $type . ' indicators found: ';
      echo count($matches);
    }
}

$types = array(
  'WordPress' => $wordpress_pattern,
  'WIX' => $wix_pattern,
  'SquareSpace'=>$squarespace_pattern,
  'Drupal'=>$drupal_pattern,
  'Joomla'=>$joomla_pattern,
  'Weebly'=>$weebly_pattern,
  'WebSiteBox'=>$websitebox_pattern
);

foreach ($types as $key => $value) {
  $type = $key;
  $pattern = $value;
  site_check($type, $pattern, $data);
}

echo '<hr>';

?>
