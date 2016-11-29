<?php

$sitemap_url = $url.'sitemap.xml';

//cURL the provided url
$ch = curl_init($sitemap_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$map_data = curl_exec($ch);
$map_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo '<h2>Site Map Check</h2>
<p>XML Site maps give search engines a map to the pages your site has.
<p/>
Returned Status of page: ';
echo $map_code;
echo ' Site Checked: ' . $sitemap_url;

if($map_code == 200){
  echo 'Site map found at ' . $sitemap_url;
}
elseif($map_code < 300){
  echo '<p>Sitemap not found at ' . $sitemap_url . '
  </p>
  <p>IDX Broker offers a site maps for all clients. Both XML and HTML:</p>
  <p>
  <a href="https://blog.idxbroker.com/difference-html-xml-sitemaps/" target="_blank">https://blog.idxbroker.com/difference-html-xml-sitemaps/</a>
  </p>';
}

echo '<hr>';

 ?>
