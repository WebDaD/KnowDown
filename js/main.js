/**
 * 
 */
Dropzone.autoDiscover = false;
$( document ).ready(function() {
	$("#results").hide();
	if($.getUrlVar('action') !== undefined){
		if($.getUrlVar('action') == "new"){
			getNewFile();
		} else if($.getUrlVar('action') == "edit"){
			editFile($.getUrlVar('file'));
		}
	}
	else if($.getUrlVar('file') !== undefined){
		loadFile($.getUrlVar('file'));
	} else if($.getUrlVar('query') !== undefined){
		getResultsReload($.getUrlVar('query'));
	} else if($.getUrlVar('raw') !== undefined){
		getRawFile($.getUrlVar('raw'));
	} else {
		getFiles();
	}
	
	$("#content").on('click','.tofile',function(evt){
		evt.preventDefault();
		loadFile($(this).data("filename"));
	});
	
	$("#content").on('click','.tofolder',function(evt){
		evt.preventDefault();
		$(this).children("img").attr("src","img/folder-open.png");
		$(this).addClass("openfolder");
		$(this).next("ul").show();
	});
	$("#content").on('click','.openfolder',function(evt){
		evt.preventDefault();
		$(this).children("img").attr("src","img/folder.png");
		$(this).removeClass("openfolder");
		$(this).next("ul").hide();
	});
	
	$("#content").on('click','#btn_back',function(evt){
		evt.preventDefault();
		getFiles();
	});
	$("#content").on('click','#link',function(evt){
		evt.preventDefault();
	});
	$("#content").on('click','#lnk_pdf',function(evt){
		evt.preventDefault();
		getPDF($(this).data("filename"));
	});
	$("#content").on('click','#lnk_raw',function(evt){
		evt.preventDefault();
		getRawFile($(this).data("filename"));
	});
	$("#content").on('click','#lnk_edit',function(evt){
		evt.preventDefault();
		editFile($(this).data("filename"));
	});
	
	$("#txt_search").focus();
	$("#content").on('click','#btn_search',function(evt){
		evt.preventDefault();
		getResults($("#txt_search").val());
	});
	$('#content').on('keyup','#txt_search', function (evt) {
		if (evt.which != 13) {
			if($("#txt_search").val() != "" && $("#txt_search").val().length >= 3){
				getResults($("#txt_search").val());
			} else {
				$("#results").hide();
			}
		}
	});
	
	$("#content").on('click','#btn_new_file',function(evt){
		evt.preventDefault();
		getNewFile();
	});
	$("#content").on('click','#btn_cancel',function(evt){
		evt.preventDefault();
		getFiles();
	});
	$("#content").on('click','#btn_save',function(evt){
		evt.preventDefault();
		saveFile($("#dd_folders").val(),$("#txt_name").val(),$("#txt_content").val(), false);
	});
	$("#content").on('click','#btn_save_close',function(evt){
		evt.preventDefault();
		saveFile($("#dd_folders").val(),$("#txt_name").val(),$("#txt_content").val(), true);
	});
	
	
	function saveFile(path,name,content, main){
		$.post("php/saveFile.php", {path:path,name:name,content:content}, function(data){
			if(data == "0"){
				if(main){
					getFiles();
				} else {
					//TODO: Display OK
				}
			} else {
				//TODO DIsplay Error
			}
		});
	}
	
	function editFile(filename){
		$.get( "php/editFile.php",{file:filename})
		  .done(function( data ) {
		    $("#content").html(data);
		    document.title = "MarkDownManagr :: Edit File :: "+filename;
		    window.history.pushState({"html":data,"pageTitle":"MarkDownManagr :: Edit File :: "+filename},"", $("#txt_link").val());
		  });
	}
	
	function getNewFile(){
		$.get( "php/newFile.php")
		  .done(function( data ) {
		    $("#content").html(data);
		    document.title = "MarkDownManagr :: New File";
		    window.history.pushState({"html":data,"pageTitle":"MarkDownManagr :: New File"},"", $("#txt_link").val());
		  });
	}
	
	function checkToggleResults(){
		if($('#search_results li').length >= 1){
			$("#results").show();
		} else {
			$("#results").hide();
		}
	}
	
	function getResultsReload(query){
		$.get( "php/getFiles.php")
		  .done(function( data ) {
		    $("#content").html(data);
		    getResults(query);
		    $("#txt_search").val(query);
		  });
	}
	
	function getResults(query){
		$.get( "php/getResults.php",{query:query})
		  .done(function( data ) {
		    $("#search_results").html(data);
		    document.title = "MarkDownManagr :: Search for "+query;
		    checkToggleResults();
		    window.history.pushState({"html":$("#content").html(),"pageTitle":"MarkDownManagr :: Search for "+query},"", $("#search_link").val());
		  });
	}
	
	function getFiles(){
		$.get( "php/getFiles.php")
		  .done(function( data ) {
		    $("#content").html(data);
		    document.title = "MarkDownManagr";
		    window.history.pushState({"html":data,"pageTitle":"MarkDownManagr"},"", $("#txt_link").val());
		    checkToggleResults();
		    getFolders();
		    $("form#dz_new_file").dropzone({ 
		    	url: "php/uploadFile.php", 
		    	acceptedFiles:".md",
		    	init: function(){
		    		this.on("sending", function(file,xhr,fd){
		    			fd.append("target_folder",$("#dd_folders").val());
		    		});
		    		this.on("success", function(event, response){
		    			if(response == "0"){
		    				getFiles();
		    			} else {
		    				alert("Error on Upload!");
		    			}
		    			
		    		});
		    		this.on("error", function(event, errMessage){
		    			alert(errMessage);
		    		});
		    	}
		    });
		  });
	}
	
	function getFolders(){
		$.get( "php/getFolders.php")
		  .done(function( data ) {
		    $("#dd_folders").html(data);
		  });
	}
	
	function getRawFile(filename){
		$.get("php/getRaw.php", {file:filename})
			.done(function(data){
				 $("#content").html(data);
				 document.title = "MarkDownManagr :: Raw :: "+filename;
				 window.history.pushState({"html":data,"pageTitle":"MarkDownManagr :: Raw :: "+filename},"", $("#txt_link").val());				    
		});
	}
	
	function getPDF(filename){
		$.get("php/getPDF.php", {file:filename})
			.done(function(data){
				window.open(data);
				 //TODO: data is a pdf. how can we force the download?			    
		});
	}
	
	function loadFile(filename){
		$.get( "php/loadFile.php", { file: filename } )
		  .done(function( data ) {
		    $("#content").html(data);
		    document.title = "MarkDownManagr :: "+filename;
		    window.history.pushState({"html":data,"pageTitle":"MarkDownManagr :: "+filename},"", $("#txt_link").val());
		    
		    $("#link").clipboard({
		        path: 'js/jquery.clipboard.swf',
		        copy: function() {
		        	$("#txt_link").focus();
		        	$("#txt_link").select();
		        	$("#lbl_ok").fadeIn("slow");
		        	setTimeout(function() {
		        		 $("#lbl_ok").fadeOut("slow")
		        	    }, 2500);
		            return $("#txt_link").val();
		        }
		    });
		    
		  });
	}
	
	window.onpopstate = function(e){
	    if(e.state){
	        $("#content").html(e.state.html);
	        document.title = e.state.pageTitle;
	    }
	};
});