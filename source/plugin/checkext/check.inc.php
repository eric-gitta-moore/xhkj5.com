<?php
/**
 *  [PHP模块检测(checkext.{modulename})] (C)2012-2099 Powered by 时创科技.
 *  Version: $VERSION
 *  Date: $DATE
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

define('SC_DEBUG', false);
if (SC_DEBUG) {
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED ^ E_STRICT);
}

sc_checkext::show();	
exit;

////////////////////////////////////////////////////////////////////////////
class sc_checkext
{
	public static function show()
	{
        $exts = get_loaded_extensions();
		showtableheader('PHP loaded extensions('.count($exts).')');
        if ($exts) {
            foreach ($exts as $k=>$v) {
                $index = $k + 1;
                if (version_compare(PHP_VERSION, '5.0.0') == -1) {
                    showtablerow(
                        '',	//trstryle
                        array('class="td25"', ''), //tdstyle
                        array(
                            $index,
                            $v,
                        )	//tdtext
                    );
                } else {
                    $ext = new ReflectionExtension($v);
                    showtablerow(
                        '',	//trstryle
                        array('class="td25"', '', ''), //tdstyle
                        array(
                            $index,
                            $v,
                            $ext->getVersion(),
                        )	//tdtext
                    );
                }
            }
        }
		showtablefooter();
	}
}
