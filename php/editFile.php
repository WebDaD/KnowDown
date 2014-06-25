<?php require_once("../config.php");?>

<?php 
$path = str_replace($FILE_PATH,"",$_GET["file"]);

$result = array_map('strrev', explode("/", strrev($path),2));

$folder="ROOT";
if($result[1]!=""){$folder=$result[1];}

$name =  str_replace(".md","",$result[0]);
?>

<a id="btn_back"><img src="img/left-grey-arrow-md.png"/></a>
<input type="hidden" value="http://<?php echo $_SERVER['HTTP_HOST'];?>/<?php echo $base_path;?>/index.php?action=edit&file=<?php echo $path;?>" id="txt_link"/>
<h2>Meta</h2>
<table>
	<tr>
		<td>Folder</td>
		<td><input type="text" id="dd_folders" disabled="disabled" value="<?php echo $folder;?>"/></td>
	</tr>
	<tr>
		<td>Name</td>
		<td><input type="text" id="txt_name" disabled="disabled" value="<?php echo $name;?>"/></td>
	</tr>
</table>
<h2>Content</h2>
<textarea id="txt_content" style="width:100%;height:500px;">
	<?php echo file_get_contents($FILE_PATH.$path);?>
</textarea>
<button id="btn_cancel">Cancel</button>
<button id="btn_save">Save</button>
<button id="btn_save_close">Save & Close</button>