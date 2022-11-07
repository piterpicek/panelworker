<?php
session_start();	
require_once "config.php";

if ( isset($_GET['login']) ) {
    $user   = $_POST['email'];
    $cek    = mysqli_query($conn, "SELECT * FROM user WHERE email='$user'");
    $data   = mysqli_fetch_assoc($cek);
        
    if( (mysqli_num_rows($cek) > 0 ) && (isset($_GET['login']) && ($_POST['password'] == $data['password']) ) ) {
        $_SESSION['user_login'] = true;
        $_SESSION['username']   = $data['email'];
        $_SESSION['api_token']  = $data['api_token'];
        echo "Found";
    }
    else 
        echo 'error1';
}
else if (isset($_SESSION['user_login']) && isset($_SESSION['username']) ) {
    $user   = $_SESSION['username'];
    $cek    = mysqli_query($conn, "SELECT * FROM user WHERE email='$user'");
    $data   = mysqli_fetch_assoc($cek);
    if ( $_SESSION['api_token'] == $data['api_token'] ) 
        header("Location: gui.php");
    else {       
        unset($_SESSION['login']);
        unset($_SESSION['user_login']);
        unset($_SESSION['api_token']);
    }
}
else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tempat Login2</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="theme/js/jquery.min.js"></script>
    <script>
	$(document).ready( function () {
		$("#login").click( function() {
            var user    = $("#email").val().trim()
			var pass    = $("#password").val().trim()
			if(user && pass) {
				$.post("?login", { email: user, password: pass }, function(resmail, status) {
					if (resmail == "Found") {
                        document.location="gui.php";   
                    }
                    else {
                        $("#notice").text("Email atau password salah!")
                    }
				})
			}
		})
	})
	</script>
</head>
<body>
    <h1>TEMPAT LOGIN</h1><br>
    <p id="notice"></p><br>
    <input type="email" id="email" placeholder="example@domain.com"><br>
    <input type="password" id="password" placeholder="********"><br>
    <button id="login">Login</button>
</body>
</html><?php
	exit;
}
