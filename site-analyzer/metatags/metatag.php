<?php

//no index test
echo '<h2>Meta Tags</h2>
<p>
Checked for popular metags include title, descriptions, and OpenGraph tags for facebook.
</p>';
//tag we don't want to see
$metatag_noindex = '<meta name="robots" content="noindex,follow';
$pos = strpos($data, $metatag_noindex);
if ($pos === true) {
  echo "No index, no follow meta tag found. This will discourage page indexing by search engines.<br>";
}

//metatags to look for
$meta_array = array(
  'metatag title' => '<title>',
  'metatag description' => '<meta name="description" content=',
  'metatag og:description' => '<meta property="og:description" content=',
  'metatag og:title' => '<meta property="og:title" content=',
  'metatag og:url' => '<meta property="og:url" content=',
  'metatag og:image' => '<meta property="og:image" content='
);

foreach($meta_array as $key => $value){
  $pos = strpos($data, $value);
  if ($pos == true) {
    echo $key.' found<br>';
  }
  else{
    echo $key.' missing<br>';
  }

}
echo '<p>
IDX Broker offers many metatag options:
</p>
<p>
<a href="http://www.idxbroker.com/features/seo-meta-tags" target="_blank">http://www.idxbroker.com/features/seo-meta-tags</a>
</p>';
echo '<hr>';




 ?>
