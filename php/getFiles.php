<?php require_once("../config.php");?>
<?php function findThings($folder){
	$files = "";
	$folders = "";
	foreach (scandir($folder) as $result) {
		if($result == "..")continue;
		if($result == ".")continue;
		if(strpos($result,".")===false){ //directory
			$folders .= '<li><a data-folder="'.$folder.$result.'/" class="tofolder"><img src="img/folder.png" style="margin-right:10px;"/>'.$result.'</a>';
			$folders .= '<ul style="display:none;" class="file_list">';
			$folders .= findThings($folder.$result."/");
			$folders .= '</ul></li>';
		}
		if(strpos($result,".md")!==false){ //files

			$display = str_replace(".md","",$result);
			$files .= '<li><a data-filename="'.$folder.$result.'" class="tofile"><img src="img/document.png" style="margin-right:10px;"/>'.$display.'</a></li>'; 
		}
	}
	return $folders.$files;
} ?>
<input type="hidden" value="http://<?php echo $_SERVER['HTTP_HOST'];?>/<?php echo $base_path;?>/" id="txt_link"/>
<h2>Search</h2>
	<input type="text" id="txt_search" value="" placeholder="Search..." style="float:left;"/>
	<img src="img/magnifier.png" style="clear:both;" id="btn_search"/>
	<div id="results">
		<h3>Results</h3>
		<ul id="search_results"></ul>
	</div>
<h2>Select File</h2>
	<ul id="filelist">
		<?php echo findThings("../files/"); ?>
	</ul>
<h2>New File</h2>
<img src="img/document--plus.png" alt="Create File" id="btn_new_file"/>

<h2>Upload File</h2>
<select id="dd_folders" style="width:100%;"></select>
<form action="php/upload.php" class="dropzone" id="dz_new_file"></form>