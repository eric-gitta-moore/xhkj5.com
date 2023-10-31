	var SWFUpload;
	function insertQianNaoLink(url,type){
		var fileurl   = document.getElementById(url).title;
		var filename  = document.getElementById(url).innerHTML;
		var ubb_filename;
		var html_filename;
		if(type==1){
			ubb_filename = "[url="+fileurl+"]"+filename+"[/url]";
			html_filename = "<a href="+fileurl+">"+filename+"</a>";
		}else{
			if (isImageFile(filename)){
				ubb_filename = "[img]"+fileurl+"[/img]";
				html_filename = "<img src="+fileurl+">";
			} else {
				ubb_filename = "[url="+fileurl+"]"+filename+"[/url]";
				html_filename = "<a href="+fileurl+">"+filename+"</a>";
			}
		}
		if(wysiwyg) {
			insertText(html_filename, false);
		} else {
			insertText(ubb_filename, strlen(ubb_filename), 0);
		}	
	}
	//id 上传类型  type 图片上传
	function qn_switchAttachbutton(id,type){
		if(id==0){		    //image
			SWFUpload=qn_SWFUpload;
			qn_upload_init();
			document.getElementById('qn_img_upload').className = 'current';
			document.getElementById('qn_img_div').style.display = '';
		}else if(id ==1){  //attach
			qn_upload_init();
			document.getElementById('qn_common_upload').className = 'current';
			document.getElementById('qn_common_div').style.display = '';
			document.getElementById('qn_upload').src = qn_upload_iframe_src;
			document.getElementById('qn_upload').style.display ='';
		}else if(id ==2){  //swfupload
			SWFUpload=qn_SWFUpload;
			qn_upload_init();
			document.getElementById('qn_batch_upload').className = 'current';
			document.getElementById('qn_batch_div').style.display = '';
		}else if(id ==3){  //list
			qn_upload_init();
			document.getElementById('qn_file_list').className = 'current';
			document.getElementById('qn_filelist_div').style.display = '';	
		}
	}

	function qn_upload_init(){
		document.getElementById('qn_img_upload').className = '';
		document.getElementById('qn_common_upload').className = '';
		document.getElementById('qn_batch_upload').className = '';
		document.getElementById('qn_file_list').className = '';
		document.getElementById('qn_img_div').style.display = 'none';
		document.getElementById('qn_common_div').style.display = 'none';
		document.getElementById('qn_batch_div').style.display = 'none';
		document.getElementById('qn_filelist_div').style.display = 'none';
	}

	function btn_copy(editor_id){
		var url = document.getElementById(editor_id).innerHTML;
		try{
			window.clipboardData.setData ("Text", url); 
			browser.messageBox("Copy Sucessfuly!");
		}catch(e){
			browser.messageBox("Can\'t support copy.");
		}
	}

 