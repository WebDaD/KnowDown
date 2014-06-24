<?php
require_once("../config.php");
$html = '<input type="hidden" value="http://'.$_SERVER['HTTP_HOST'].'/'.$base_path.'/index.php?raw='.$_GET["file"].'" id="txt_link"/>';
$html .= '<a id="btn_back"><img src="img/left-grey-arrow-md.png"/></a>';
$html .= file_get_contents("../files/".$_GET["file"]);
echo "<pre class=\"raw_pre\">".$html."</pre>";
?>