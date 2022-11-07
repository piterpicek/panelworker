<?php
ini_set("memory_limit",-1);
set_time_limit(0);
require_once 'kernel/RollingCurl/RC.php';

if(isset($argv[1])){
	$list   = file($argv[1], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $clists = count($list);
    
}