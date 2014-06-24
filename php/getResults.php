<?php require_once("../config.php");?>
<input type="hidden" value="http://<?php echo $_SERVER['HTTP_HOST'];?>/<?php echo $base_path;?>/index.php?query=<?php echo $_GET["query"];?>" id="search_link"/>
<?php
$path_to_check = '../files/';
$needle = escapeshellcmd($_GET["query"]);
$cmd = ' find '.$path_to_check.' -iname "*.md" -type f -exec grep -srin "'.$needle.'" {} +';


$files="";
$result = trim(shell_exec($cmd));
if($result==""){
	$files = "<li>No Results for <span class=\"query\">".$needle."</span></li>";
} else {
	$res = explode("\n",$result);
	foreach($res as $row){
		$info = explode(":",$row,3); //file,line,text
		$file = str_replace($path_to_check,"",$info[0]);
		
		$content = preg_replace('/' . preg_quote($needle, "/") . '/i', "<span class=\"query\">\$0</span>", $info[2]);
		
		$display = str_replace(".md","",$file);
		
		$files .= '<li><a data-filename="'.$file.'" class="tofile"><img src="img/document.png" style="margin-right:10px;"/>'.$display.'</a>:<span style="color:blue;">'.$info[1].'</span>:'.$content.'</li>';
	}
}
echo $files;
?>