<?php
require_once 'Parsedown.php';
require_once("../config.php");

$md = file_get_contents("../files/".$_GET["file"]);

$Parsedown = new Parsedown();

$html = '<img id="lnk_raw" alt="RAW" src="img/raw.png" data-filename="'.$_GET["file"].'"/>';

$html .= "<div id=\"link\">";
$html .= "<span id=\"lbl_link\">Link:&nbsp;</span>";
$html .= '<input type="text" value="http://'.$_SERVER['HTTP_HOST'].'/'.$base_path.'/index.php?file='.$_GET["file"].'" id="txt_link"/>';
$html .= '<img src="img/document-copy.png"/>';
$html .= '<span id="lbl_ok">Link copied</span>';
$html .= "</div>";

$html .= '<a id="btn_back"><img src="img/left-grey-arrow-md.png"/></a>';

$html .= $Parsedown->text($md);

echo $html;

?>