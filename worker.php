<?php
if(isset($argv[1]) && !empty($argv[1]) && !empty($argv[2])){
	$lists = file($argv[1], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	if( !$lists && is_array($argv[1]) ){
		bantuan();
		die();
    }
	$clists     = count($lists);
	foreach($lists as $email) {
        
    }
}
else{
	bantuan();
}

function bantuan(){
	$logo = "==================================================\n";
	$logo .= "#\t Relay Sender                     \t #\n";
	$logo .= "#------------------------------------------------#\n";
	$logo .= "#\t Author \t: MRC                \t #\n";
	$logo .= "#\t Usage \t\t: php ".basename($_SERVER["SCRIPT_FILENAME"], '.php').".php \"mail.txt\" #\n";
	$logo .= "#------------------------------------------------#\n";
	$logo .= "#\t (C) ".date("Y")." JHT                    \t #\n";
	$logo .= "==================================================\n";
	echo $logo;
}
