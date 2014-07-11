<?php require_once("config.php")?>
<!DOCTYPE html>
<html lang="de" dir="ltr">
	<head>
		<title><?php echo $NAME;?></title>
		<script src="js/jquery.min.js" type="text/javascript"></script>
		<script src="js/jquery.urlvars.min.js" type="text/javascript"></script>
		<script src="js/jquery.clipboard.js" type="text/javascript"></script>
		<script src="js/dropzone.js" type="text/javascript"></script>
		<script src="js/main.js" type="text/javascript"></script>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<link rel="stylesheet" href="css/dropzone.css" type="text/css" />
		<meta charset="UTF-8" />
	</head>
	<body>
		<img src="img/logo-48x48.png" alt="Logo" title="<?php echo $NAME;?>" style="float:left;margin-right:10px;"/>
		<h1 style="margin:0;line-height:48px;vertical-align:middle;"><?php echo $NAME;?> v<?php echo $VERSION;?></h1>
		<div style="clear:both;"></div>
		<div id="content"></div>
		<div id="info"><?php echo $NAME;?> v<?php echo $VERSION;?> by <?php echo $AUTHOR;?> --- <a href="http://www.webdad.eu" target="_blank">WebDaD.eu</a></div>
	</body>
</html>