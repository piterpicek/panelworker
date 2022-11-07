<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$dbname = 'checker';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

if(! $conn ) {
   die('Could not connect: ' . mysqli_error());
}


// if (mysqli_num_rows($result) > 0) {
//     while($row = mysqli_fetch_assoc($result)) {
//         echo "Name: " . $row["name"]. "<br>";
//     }
// }
// else {
//     echo "0 results";
// }
//mysqli_close($conn);