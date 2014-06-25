<?php 
require_once("../config.php");

$file = $FILE_PATH.escapeshellarg($_POST["file"]);

$cmd = "rm -f ".$file;

$returner=0;
system($cmd,$returner);
echo $returner;
?>
