<?php

//cURL the provided url
$ch = curl_init($url.'sitemap.xml');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$data = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo '<h2>Site Map Check</h2>
<p>XML Site maps give search engines a map to the pages your site has.
<p/>';
if($code == 200){
  echo 'Site map found at '. $url .'sitemap.xml';
}
elseif($code < 300){
  echo '<p>Sitemap not found at '. $url .'sitemap.xml
  </p>
  <p>IDX Broker offers a site maps for all clients. Both XML and HTML:</p>
  <p>
  <a href="https://blog.idxbroker.com/difference-html-xml-sitemaps/" target="_blank">https://blog.idxbroker.com/difference-html-xml-sitemaps/</a>
  </p>';
}

echo '<hr>';

 ?>
