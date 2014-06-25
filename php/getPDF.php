<?php
require_once("../config.php");

$md = file_get_contents($FILE_PATH.$_GET["file"]);

require_once 'Parsedown.php';
$Parsedown = new Parsedown();
$html = $Parsedown->text($md);

require_once('mpdf/mpdf.php');

$mpdf=new mPDF();

$display = str_replace(".md","",$_GET["file"]);

$mpdf->SetHeader($NAME.'||'.$display);
$mpdf->SetFooter('{DATE d.m.Y}||{PAGENO}');

$mpdf->WriteHTML($html);

$filename = str_replace(".md",".pdf",$_GET["file"]);



$mpdf->Output($FILE_PATH.$filename,"F");

$simple_filepath = str_replace("../","",$FILE_PATH);
echo "http://".$_SERVER['HTTP_HOST']."/".$base_path."/".$simple_filepath.$filename;
?>