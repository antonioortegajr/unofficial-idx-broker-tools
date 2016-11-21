<html>
<head>
</head>
<body style="padding-left: 10%; padding-right: 10%;">
<?php

//url to check
$url = htmlspecialchars($_GET["domain"]);

if ($url != NULL){

			//page html
			echo '<h1>Check your website</h1>
			<p>Let\'s check your website for attributes all current real estate websites should measure.
			</p>
			<p>
			Links to features of IDX Broker will be provided when applicable.
			</p>' ;
			$breaks = '<br><br>';

			//Site checked
			echo '<h2>Site checked:</h2> '.$url;
			echo '<hr>';
			echo $breaks;
			//check with google for mobile friendliness and page speed
			include_once 'google-check/page-speed-api.php';
			//check for XML sitemap at /sitemap.xml
			include_once 'site/sitemap/sitemap-check.php';
			//check site for iframes and CMS indicators and facebook/twitter links
			include_once 'site/check.php';

			echo $breaks;
			echo '<hr>';
			echo '<hr>Done testing. Some tests may not be shown due to timeouts or other issues.';

}
else{
	echo '<h1>Analyze your website</h1><p>Let\'s check your website for attributes all current real estate websites should measure.</p><p>Please enter a url</p><form action="" method="GET"><input name="domain"><input type="submit" value="Submit">';
}

?>
</body>
</html>
