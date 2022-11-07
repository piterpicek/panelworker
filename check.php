<?php
ini_set("memory_limit",-1);
set_time_limit(0);
require_once 'kernel/RollingCurl/RC.php';
require_once 'config.php';
//error_reporting(0);

function notice($number) {
    switch ($number) {
        case '1':
            return "Data request tdk valid!";
            break;
        
        case '2':
            return "credit anda tidak mencukupi!";
            break;
        
        case '3':
            return "Kamu belum membeli api!";
            break;
        
        default:
            return "Sorry coy api ku perlu di update!";
            break;
    }
}

function ATS($array = [], int $tapi)
{
    $cval 	= count($array);
    $ttp 	= round($cval / $tapi, 1, PHP_ROUND_HALF_UP);
    $ttpd 	= explode('.',$ttp)!==false ? round($ttp + 1) : round($ttp);
    $val 	= ($ttpd <= 2) ? array_chunk($array, 1) : array_chunk($array, $ttpd-2);
    
    for ($i=0; $i < $tapi; $i++) {
        $data[] 	= is_null($val[$i+$tapi]) ? $val[$i] : array_merge( $val[$i], $val[$i+$tapi] );
    }
    // outputnya array
    return $data;
}

function LaunchBackgroundProcess($command){
    // Run command Asynchroniously (in a separate thread)
    if(PHP_OS=='WINNT' || PHP_OS=='WIN32' || PHP_OS=='Windows'){
        // Windows
        $command = 'start "" '. $command;
    } 
    else {
        // Linux/UNIX
        $command = $command .' /dev/null &';
    }
    $handle = popen($command, 'r');
    if( $handle !== false ) {
        pclose($handle);
        return true;
    } 
    else {
        return false;
    }
}


if ( isset($_GET['user']) && !empty($_GET['user']) && !empty($_GET['api_token']) &&  isset($_POST['maillist']) ) {
    $cek    = mysqli_query($conn, "SELECT * FROM user WHERE email='$user'");
    if (mysqli_num_rows($cek) > 0 ) {
        $data   = mysqli_fetch_assoc($cek);

        $api    = explode(":", $data['api_drive']);
        $capi   = count($api);
        $lists  = is_array($_POST['maillist']) ? $_POST['maillist'] : ( exit( notice(1) ) );

        if ($capi == 1) {
            $filename = 'progress/'.md5($data['no_costumer'].date("YmdHis"));

            file_put_contents($filename, $lists);
            LaunchBackgroundProcess('php worker.php '. $lists.' '.$api);

        }
        else if ($capi > 1 ) {
            var_export( ATS($lists, $capi) );
        }
        else exit( notice(3) );
    }
    else exit( notice(1) );
}
else if ( ( isset($_GET['monitoring']) ) && !empty($_GET['monitoring']) ) {
    //$api_monitoring = ['A1234567890'];
    /*
    get number of screen -> for to get monitoring realtime of data
    with foreach ob_flush 
    */
}






function startBackgroundProcess($command, $stdin = null, $redirectStdout = null, $redirectStderr = null, $cwd = null, $env = null, $other_options = null) {
    $descriptorspec = array(
        1 => is_string($redirectStdout) ? array('file', $redirectStdout, 'w') : array('pipe', 'w'),
        2 => is_string($redirectStderr) ? array('file', $redirectStderr, 'w') : array('pipe', 'w'),
    );
    if (is_string($stdin)) {
        $descriptorspec[0] = array('pipe', 'r');
    }
    $proc = proc_open($command, $descriptorspec, $pipes, $cwd, $env, $other_options);
    if (!is_resource($proc)) {
        throw new \Exception("Failed to start background process by command: $command");
    }
    if (is_string($stdin)) {
        fwrite($pipes[0], $stdin);
        fclose($pipes[0]);
    }
    if (!is_string($redirectStdout)) {
        fclose($pipes[1]);
    }
    if (!is_string($redirectStderr)) {
        fclose($pipes[2]);
    }
    return $proc;
}