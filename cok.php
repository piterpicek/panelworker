<?php
//  $minimal = 60;
//  $mahasiswa = 

//$merge = array_merge(array_chunk($mahasiswa,4), $array2)

//$totalapi =  15;
//$doc = explode("\n", file_get_contents("list.txt"));
//$data = array( fscanf(fopen("list.txt", "r"), "%s\n") );
//var_dump($fp);
//$doc = explode("\n", $fp);
//var_export($data[1])
//echo $total;

// function lastend($value = [], int $bagi)
// {
//   $data     = array_chunk( $value, $bagi );

//   if ( count(end($data)) < count($data[0]) && count($data) > 1 ) {
//   	$endl[] = array_merge( $data[count($data)-2], end($data) );
//   	return array_merge(array_slice($data, 0, -2), $endl);
//   }
//   else return $data;
//   //$out    = $data,$endl;
// }

//var_export(lastend($mahasiswa, $total));
$lists 		= file('list.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$totalapi 	= 2;

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
echo "TOTAL : ".count($lists)."\n";
var_export( ATS($lists, $totalapi) )


// if (isset($_GET['width']) AND isset($_GET['height'])) {
//   // output the geometry variables
//   echo "Screen width is: ". $_GET['width'] ."<br />\n";
//   echo "Screen height is: ". $_GET['height'] ."<br />\n";
// } else {
//   echo "<script language='javascript'>\n";
//   echo "  location.href=\"${_SERVER['SCRIPT_NAME']}?${_SERVER['QUERY_STRING']}"
//             . "&width=\" + screen.width + \"&height=\" + screen.height;\n";
//   echo "</script>\n";
//   exit();
// }


# DELETE FILE ON FILE ZIP WITH SPESIFIC
// $zip = new ZipArchive;
// if ($zip->open('www.zip') === TRUE) {
//     $zip->deleteName('phpinfo.php');
//     $zip->close();
//     echo 'ok';
// } else {
//     echo 'failed';
// }

# BACA KOMENTAR DALAM FILE ZIP
// $zip = new ZipArchive;
// $res = $zip->open('www.zip');
// if ($res === TRUE) {
//     //var_dump($zip->getArchiveComment());
//     /* Or using the archive property */
//     echo $zip->comment;
// } else {
//     echo 'failed, code:' . $res;
// }

# MENGKOMPRESS FILE
// $zip = new ZipArchive();
// $stat = stat($filename='readme.txt');
// if (is_array($stat) && $zip->open('test2.zip', ZipArchive::CREATE) === TRUE) {
//     $zip->addFile($filename);
//     $zip->setExternalAttributesName($filename, ZipArchive::OPSYS_UNIX, $stat['mode'] << 16);
//     $zip->close();
//     echo "Ok\n";
// } else {
//     echo "KO\n";
// }

# EXTRACT ALL TO
// $zip = new ZipArchive;
// if ($zip->open('test.zip') === TRUE) {
//     $zip->extractTo('/my/destination/dir/');
//     $zip->close();
//     echo 'ok';
// } else {
//     echo 'failed';
//}

#Extract 2 FILE
// $zip = new ZipArchive;
// $res = $zip->open('test_im.zip');
// if ($res === TRUE) {
//     $zip->extractTo('/my/destination/dir/', array('pear_item.gif', 'testfromfile.php'));
//     $zip->close();
//     echo 'ok';
// } else {
//     echo 'failed';
// }

// $zip = new ZipArchive;
// if ($zip->open('read.zip') === TRUE) {
// 	$zip->setPassword('123');
//     $zip->extractTo('./');
//     $zip->close();
//     echo 'ok';
// } else {
//     echo 'failed';
// }

// array_walk(array_chunk($mahasiswa,4), function ($siswa, $key) use ($mahasiswa) {
// //    echo "Nama : ".$siswa['nama']."<br />";
//  //   echo "Nilai : ".$siswa['nilai']."<br />";
// //    echo "Keterangan : ";
//   //echo $siswa."\n";
// //var_export($siswa);
// //var_export($siswa);
//   $lastend = (count($mahasiswa)-1);
//   $siswa[] = array_merge( $key[$lastend][$siswa], end($key[$siswa]) );
//     var_export($siswa);
// //$result[] = $siswa;
// //echo "\n";
// //  $result[] = $siswa;
//     // if ($siswa['nilai'] >= $minimal) {
//     //   echo "Lulus <br /><br />";
//     // } else {
//     //   echo "Gagal <br /><br />";
//     // }

//   });
//$piper = array_reduce($piper, '$result', array());
//var_export($piper);
//echo count($mahasiswa)."\n";
//$piper = "|k=f|p=t|e=r|t=m|";

//$piper = explode("|",$piper);

// $piper = array_filter($mahasiswa);

// function splitter($result, $item) {
//     //$splitted = $item; // explode("=",$item);
//     $key    = $item[0];
//     $value  = $item[1];

//     $result[$key] = $value;

//     return $result;
// }

// $piper = array_reduce($piper, 'splitter', array());

// $assoc_arr = array_reduce($mahasiswa, function ($result, $item) {
//     $result[$item[1]] = $item[0];
//     return $result;
// }, array());

// echo(array_reduce($mahasiswa, function($carry, $item) {
//     return $carry ? $carry.' => '.$item : '';
// }));

//var_export($assoc_arr);
?>