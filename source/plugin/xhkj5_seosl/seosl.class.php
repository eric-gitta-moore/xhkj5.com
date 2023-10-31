<?php

if(!defined('IN_DISCUZ')) { exit('Access Denied'); }

class plugin_xhkj5_seosl { }

class plugin_xhkj5_seosl_forum extends plugin_xhkj5_seosl {
	function viewthread_posttop_output(){
		global $_G;
		$a=$_G['forum_thread']['replies']-($_G['ppp']*($_G['page']-1));
		if($_G['cache']['plugin']['xhkj5_seosl']['kg'] && $_G['cache']['plugin']['xhkj5_seosl']['showhere'] == 2){			
			$s=URLdecode($_G['forum_thread']['subjectenc']);
			$data = explode("\n",$_G['cache']['plugin']['xhkj5_seosl']['sssz']);
			$sss = '<div class="sftop"><p class="initials"><span>'.$_G['cache']['plugin']['xhkj5_seosl']['qzts'].'</span>';
			$css2 = '<style type="text/css">
                        .sftop{width:99%;height:22px;margin:6px auto 0px;border:1px solid #E9EDF0;border-bottom-color:#D3D3D3;background:#FAFAFA;top:0px;}
                        .sftop p.initials{float:left;height:20px;overflow:hidden;line-height:22px;padding-left:4px;}
                        .sftop p.initials span{height:24px;color:#999;float:left;}
                                   </style>';
			for($k=0;$k<count($data,0);$k++){
				if(strstr($data[$k], '|')){
					$dk[$k] = explode("|",$data[$k]);
					if(count($dk[$k])== 3){
						$ss = str_replace('%s',$s,$dk[$k]['2']);
						$sss .= '<A HREF="'.$ss.'" target="_blank"><IMG SRC="./source/plugin/xhkj5_seosl/xhkj5com/'.$dk[$k][1].'" WIDTH="40" HEIGHT="13" BORDER="0" class="authicn vm">&nbsp;'.$dk[$k][0].'</A>&nbsp;';
					}
				}
			}
		$sss .= '</p></div><BR>';
		$i=1;
		
			$sf2[0]=$css2.$sss;
		}else{
			$sf2[0]='';
		}
		while($i<=$a){
			$sf2[$i]='';
			$i++;
		}
		return array_values($sf2);
	}

	function viewthread_postheader_output(){
		global $_G;
		$a=$_G['forum_thread']['replies']-($_G['ppp']*($_G['page']-1));
		if($_G['cache']['plugin']['xhkj5_seosl']['kg'] && $_G['cache']['plugin']['xhkj5_seosl']['showhere'] == 1){
			$s=URLdecode($_G['forum_thread']['subjectenc']);
			$data = explode("\n",$_G['cache']['plugin']['xhkj5_seosl']['sssz']);
			$sss = '<span class="pipe">|</span>'.$_G['cache']['plugin']['xhkj5_seosl']['qzts'];
			for($k=0;$k<count($data,0);$k++){
				if(strstr($data[$k], '|')){
					$dk[$k] = explode("|",$data[$k]);
					if(count($dk[$k])== 3){
						$ss = str_replace('%s',$s,$dk[$k]['2']);
						$sss .= '<A HREF="'.$ss.'" target="_blank"><IMG SRC="./source/plugin/xhkj5_seosl/xhkj5com/'.$dk[$k][1].'" WIDTH="40" HEIGHT="13" BORDER="0" class="authicn vm">&nbsp;<STRONG>'.$dk[$k][0].'</STRONG></A>&nbsp;';
					}
				}
			}
		$sss .= '<span class="pipe">|</span>';
		$i=1;
		
			$sf1[0]=$sss;
		}else{
			$sf1[0]='';
		}
		while($i<=$a){
			$sf1[$i]='';
			$i++;
		}
		return array_values($sf1);
	}

		function viewthread_postfooter_output(){
		global $_G;
		$css='<style type="text/css">';
		$a=$_G['forum_thread']['replies']-($_G['ppp']*($_G['page']-1));
		if($_G['cache']['plugin']['xhkj5_seosl']['kg'] && $_G['cache']['plugin']['xhkj5_seosl']['showhere'] == 3){
			$s=URLdecode($_G['forum_thread']['subjectenc']);
			$data = explode("\n",$_G['cache']['plugin']['xhkj5_seosl']['sssz']);
			$sss = $_G['cache']['plugin']['xhkj5_seosl']['qzts'];
			for($k=0;$k<count($data,0);$k++){
				if(strstr($data[$k], '|')){
					$dk[$k] = explode("|",$data[$k]);
					if(count($dk[$k])== 3){
						$css_array = explode(".",$dk[$k][1]);
						$css .= '.'.$css_array[0].'{background:url(./source/plugin/xhkj5_seosl/xhkj5com/'.$dk[$k][1].') no-repeat 0 50%;}';
						$ss = str_replace('%s',$s,$dk[$k]['2']);
						$sss .= '<A class="'.$css_array[0].'" HREF="'.$ss.'" target="_blank">'.$dk[$k][0].'</A>';
					}
				}
			}
		$sss .= '';
		$css .= '</style> ';
		$i=1;
		
			$sf3[0]=$sss.$css;
		}else{
			$sf3[0]='';
		}
		while($i<=$a){
			$sf3[$i]='';
			$i++;
		}
		return array_values($sf3);
	}

}