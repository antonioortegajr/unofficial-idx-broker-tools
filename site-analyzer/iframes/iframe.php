<?php

echo '<h2>Check for iframes</h2>';
$iframe = '/<iframe(.*)<\/iframe>/U';
if (preg_match($iframe, $data)) {
  echo '<p>iframes found. If this is your search, you might want to do some research to learn more about iframes and real estate SEO. Here is an article from IDX Broker on iframes, FTP and RETS:
    </p>
    <p><a href="https://blog.idxbroker.com/idx-feeds-explained-ftp-iframe-rets/" target="_blank">https://blog.idxbroker.com/idx-feeds-explained-ftp-iframe-rets/</a>';
}
else {
  echo 'iframes were not found on ' . $url . '. Great!! Google and search engine crawlers, are unable to index the contect inside of an iframe. If the most important content on the page such as property details pages are within an iframe google is not indexting this content with your website.';

}
echo '<hr>';

 ?>
