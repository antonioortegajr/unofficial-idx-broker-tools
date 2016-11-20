<html>
<head>
</head>
<body style="padding-left: 10%; padding-right: 10%;">
<?php

//url to check
$url = htmlspecialchars($_GET["domain"]);

if ($url != NULL){

			//page html
			echo '<h1>Check your website</h1><p>Let\'s check your website for attributes all current real estate websites should measure.' ;
			$breaks = '<br><br>';

			//Site checked
			echo '<h2>Site checked:</h2> '.$url;
			echo $breaks;
			//check with google for mobile friendliness and page speed
			include_once 'google-check/page-speed-api.php';
			echo '<br><hr><br>';
			//check site for iframes and CMS indicators
			include_once 'site/check.php';

}
else{
	echo '<h1>Analyze your website</h1><p>Let\'s check your website for attributes all current real estate websites should measure.</p><p>Please enter a url</p><form action="" method="GET"><input name="domain"><input type="submit" value="Submit">';
}

?>
</body>
</html>
