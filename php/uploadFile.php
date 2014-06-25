<?php
require_once("../config.php");
$target_folder = $FILE_PATH.$_POST["target_folder"];
$tempname = $_FILES['file']['tmp_name'];
$name = $_FILES['file']['name'];

$check = move_uploaded_file  ( $tempname  , $target_folder.$name );

if($check==true){
	$content = "0";
}
else {
	$content = "8";
}

echo $content;
?>