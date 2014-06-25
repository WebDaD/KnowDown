<?php require_once("../config.php");?>
<?php function findThings($folder){
	global $FILE_PATH;
	$files = "";
	$folders = "";
	foreach (scandir($folder) as $result) {
		if($result == "..")continue;
		if($result == ".")continue;
		if(strpos($result,".")===false){ //directory
			$display = str_replace($FILE_PATH,"",$folder.$result);
			$folders .= '<option value="'.$folder.$result.'/">'.$display.'</option>';
			$folders .= findThings($folder.$result."/");
		}
	}
	return $folders;
}
echo "<option value=\"\">Root</option>".findThings($FILE_PATH);?>