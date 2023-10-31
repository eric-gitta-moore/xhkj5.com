<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$return = <<<EOF


EOF;
 if($syncurl) { 
$return .= <<<EOF

<script type="text/javascript">
EOF;
 if(is_array($syncdata)) foreach($syncdata as $key => $rs) { 
$return .= <<<EOF
var x{$key} = new Ajax();
var data{$key} = '{$rs}';
x{$key}.post('{$syncurl}', data{$key}, function(msg) {});

EOF;
 } 
$return .= <<<EOF

</script>

EOF;
 } 
$return .= <<<EOF


EOF;
?>
