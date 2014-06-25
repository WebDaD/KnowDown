<?php //TODO: errors
require_once("../config.php");

$path="";
if($_POST["path"] == "ROOT"){
	$path=".";
} else {
	$path = $_POST["path"];
}
$target = $FILE_PATH.$path."/".$_POST["name"].".md";

$handle = fopen($target,"w+");
fwrite($handle,$_POST["content"]);
fclose($handle);

echo "0";
?>