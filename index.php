<?php require_once("config.php")?>
<!DOCTYPE html>
<html lang="de" dir="ltr">
	<head>
		<title><?php echo $NAME;?></title>
		<script src="js/jquery.min.js" type="text/javascript"></script>
		<script src="js/jquery.urlvars.min.js" type="text/javascript"></script>
		<script src="js/jquery.clipboard.js" type="text/javascript"></script>
		<script src="js/main.js" type="text/javascript"></script>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<meta charset="UTF-8" />
	</head>
	<body>
		<h1><?php echo $NAME;?> v<?php echo $VERSION;?></h1>
		<div id="content"></div>
		<div id="info"><?php echo $NAME;?> v<?php echo $VERSION;?> by <?php echo $AUTHOR;?> --- <a href="http://www.webdad.eu" target="_blank">WebDaD.eu</a></div>
	</body>
</html>