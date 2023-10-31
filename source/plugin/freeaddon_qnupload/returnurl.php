<?php
	$fi1e_name = $_GET['filename'];
	$filename = urldecode($fi1e_name);

	$fi1e_downurl = $_GET['filedownurl'];
	$fi1edownurl = urldecode($fi1e_downurl);
?>

<script>
 function getUrlParam(name){      
          var reg   =   new   RegExp("(^|&)"+   name   +"=([^&]*)(&|$)");      
          var r   =   window.location.search.substr(1).match(reg);      
          if (r!=null){return unescape(r[2]);}else{ return   null;  }} 
   var myDate = new Date();
	var filename   = "<?php echo $filename; ?>";
	var filedownurl= "<?php echo $fi1edownurl; ?>";
	var fileurlid = myDate.getTime(); 
	if(filedownurl !=""){
		var stringtest = "<table width='100%' cellspacing='0' cellpadding='0' border='0' summary='post_attachbody'><tbody ><tr><td class='atnu'></td><td class='attswf'> <a title='"+filedownurl+"' id ="+fileurlid+" onclick='insertQianNaoLink("+fileurlid+",1);' class='lighttxt' href='javascript:;'>"+filename+"</a></td><td class='atds'><a title='"+filedownurl+"' onclick='insertQianNaoLink("+fileurlid+",1);' class='lighttxt'  href='javascript:;'>&#x63D2;&#x5165;&#x5230;&#x5E16;&#x5B50;</a></td></tr></tbody></table>";
			parent.document.getElementById('qn_upload').style.display ='none';
			parent.document.getElementById('qn_common_div').style.display = 'none';
			parent.document.getElementById('qn_common_upload').className = '';
			parent.document.getElementById('qn_filelist_div').style.display = '';
			parent.document.getElementById('qn_file_list').className = 'current';
			parent.document.getElementById('qn_attachlist').innerHTML += stringtest;
	}else{

	}
</script>

