<?php
	if(!defined('IN_DISCUZ')) {
		exit('Access Denied');
	}

	function getmode($tid,$pid,$title,$msg){ 
		global $_G;
		$exx_tagseo = $_G['cache']['plugin']['exx_tagseo'];	
		if($exx_tagseo['hq']==1){
			return getkw($tid,$pid,$title,$msg);
		}else{
			return baiduKeyword($tid,$pid,$title,$msg);
		}
	}
	
	
	function baiduKeyword($tid,$pid,$title,$msg){ 
		$w=dfsockopen('https://m.baidu.com/s?word='.urlencode($title).'&ie=gbk'); 
		preg_match_all('/<div class="rw-list">(.*?)<\/div>/i',$w,$con); 
		$list=$con[1][0]; 
		preg_match_all('|<a class="rw-item" href=(.*)>(.*)</a>|isU',$list,$content); 
		$result=implode(",",$content[2]); 
		$result=diconv($result,'UTF-8' ,CHARSET);
		$return=settag($tid,$pid,$result);
		return $return;
	
	}
		
	function getkw($tid,$pid,$subjectenc,$messageenc){
		$data = @implode('', file("http://keyword.discuz.com/related_kw.html?ics=".CHARSET."&ocs=".CHARSET."&title=$subjectenc&content=$messageenc"));
		if($data) {
			if(PHP_VERSION > '5' && CHARSET != 'utf-8') {
				require_once libfile('class/chinese');
				$chs = new Chinese('utf-8', CHARSET);
			}
			$parser = xml_parser_create();
			xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
			xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
			xml_parse_into_struct($parser, $data, $values, $index);
			xml_parser_free($parser);
			$kws = array();
			foreach($values as $valuearray) {
				if($valuearray['tag'] == 'kw' || $valuearray['tag'] == 'ekw') {
					$kws[] = !empty($chs) ? $chs->convert(trim($valuearray['value'])) : trim($valuearray['value']);
				}
			}
			$keyw=implode(',', $kws);
		}
		$keyw=$keyw?$keyw:$subjectenc;
		$keyw=str_replace(array(" ","　","\t","\n","\r"), '', $keyw); 
		$return=settag($tid,$pid,$keyw);
		return $return;
	}

	function settag($tid,$pid,$result){
		$newtagclass = new tag();
		$tags = $newtagclass->add_tag($result, $tid, 'tid');
		if($result) {
			loadcache('censor');
			C::t('forum_post')->update('tid:'.$tid, $pid, array(
			'tags' => $tags,
			));
		}
		if($tags){
			$tagarray = explode("\t", $tags);
			if($tagarray) {
				foreach($tagarray as $v) {
					if($v) {
						$tag = explode(',', $v);
						$ptag_array[] = $tag;
					}
				}
			}
		}
		
		return $ptag_array;

	}