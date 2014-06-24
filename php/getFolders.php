<?php function findThings($folder){
	$files = "";
	$folders = "";
	foreach (scandir($folder) as $result) {
		if($result == "..")continue;
		if($result == ".")continue;
		if(strpos($result,".")===false){ //directory
			$display = str_replace("../files/","",$folder.$result);
			$folders .= '<option value="'.$folder.$result.'/">'.$display.'</option>';
			$folders .= findThings($folder.$result."/");
		}
	}
	return $folders;
}
echo "<option value=\"../files/\">Root</option>".findThings("../files/");?>