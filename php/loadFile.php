<?php
require_once 'Parsedown.php';
require_once("../config.php");

$md = file_get_contents($FILE_PATH.$_GET["file"]);
$Parsedown = new Parsedown();
$html = $Parsedown->text($md);

?>
<a id="btn_back"><img src="img/left-grey-arrow-md.png"/></a>
<img id="lnk_delete" title="Delete Document" alt="DELETE" src="img/document--minus.png" data-filename="<?php echo $_GET["file"];?>"/>
<img id="lnk_pdf" title="Download PDF" alt="PDF" src="img/document-pdf-text.png" data-filename="<?php echo $_GET["file"];?>"/>
<img id="lnk_edit" title="Edit Document" alt="EDIT" src="img/document--pencil.png" data-filename="<?php echo $_GET["file"];?>"/>
<img id="lnk_raw" title="get Raw Data" alt="RAW" src="img/document-binary.png" data-filename="<?php echo $_GET["file"];?>"/>
<div id="link">
	<span id="lbl_link">Link:&nbsp;</span>
	<input type="text" value="http://<?php echo $_SERVER['HTTP_HOST'];?>/<?php echo $base_path;?>/index.php?file=<?php echo $_GET["file"];?>" id="txt_link"/>
	<img src="img/document-copy.png"/>
	<span id="lbl_ok">Link copied</span>
</div>
<?php echo $html;?>