<?php require_once("../config.php");?>
<?php function findThings($folder){
	$files = "";
	$folders = "";
	foreach (scandir($folder) as $result) {
		if($result == "..")continue;
		if($result == ".")continue;
		if(strpos($result,".")===false){ //directory
			$display = str_replace($FILE_PATH,"",$folder.$result);
			$folders .= '<option value="'.$display.'/">'.$display.'</option>';
			$folders .= findThings($folder.$result."/");
		}
	}
	return $folders;
}?>
<a id="btn_back"><img src="img/left-grey-arrow-md.png"/></a>
<input type="hidden" value="http://<?php echo $_SERVER['HTTP_HOST'];?>/<?php echo $base_path;?>/index.php?action=new" id="txt_link"/>
<h2>Meta</h2>
<table>
	<tr>
		<td>Folder</td>
		<td><select id="dd_folders"><option value="ROOT">Root</option><?php echo findThings($FILE_PATH);?></select></td>
	</tr>
	<tr>
		<td>Name</td>
		<td><input type="text" id="txt_name"/></td>
	</tr>
</table>
<h2>Content</h2>
<textarea id="txt_content" style="width:100%;height:500px;"></textarea>
<button id="btn_cancel">Cancel</button>
<button id="btn_save">Save</button>
<button id="btn_save_close">Save & Close</button>