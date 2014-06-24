<?php
$target_folder = $_POST["target_folder"];
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