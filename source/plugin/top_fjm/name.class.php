<?php
class plugin_top_fjm {

	function common(){

		if(CURSCRIPT == 'forum' && CURMODULE == 'attachment'){

			global $_G;

			$top_fjm = $_G['cache']['plugin']['top_fjm'];

			$top_fids = (array)unserialize($top_fjm['top_fids']);

			$top_gids = (array)unserialize($top_fjm['top_gids']);



			if(in_array($_G['groupid'],$top_gids)){

				include_once DISCUZ_ROOT.'/source/plugin/top_fjm/forum_attachment.php';

				exit();

			}

		}

	}

}





?>