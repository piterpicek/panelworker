<?php
ini_set("display_errors",1);
error_reporting(E_ALL);

session_start();
require_once "config.php";

function ceklogin($type, $user=false, $pass=false)
{
    $srcu   = $user !== false ? $user : $_SESSION['user_login'];
    $cek    = mysqli_query($conn, "SELECT * FROM user WHERE email='$user'");
    $ceknum = mysqli_num_rows($cek) > 0 ? 'ok' : 'ko';
    $data   = mysqli_fetch_assoc($cek);
            
    if($type == 'login' && $cek && $ceknum !== "ko" && $data && $user !== false && $pass !== false ) {
        $user_true = ($user == $data['email'])      ? 'Found' : 'NotFound';
        $pass_true = ($pass == $data['password'])   ? 'Found' : 'NotFound';
        if ($user_true == 'Found' && $pass_true == 'Found') {
            $_SESSION['login']          = true;
            $_SESSION['user_login']     = $user;
            $_SESSION['api_token_mu']   = $apitoken;
            echo 'Found';
        }
        else echo 'error2';
    }
    else if($type == 'cek' && !empty($_SESSION['login']) && $srcu == $data['email'] ) $datasesion = 'logged';
    else    $datasesion = 'error1';
    return $datasesion;
}

function kick() {
    unset($_SESSION['login']);
    unset($_SESSION['user_login']);
    unset($_SESSION['api_token_mu']);
    //session_destroy();
}

if(isset($_POST['login']) && $_POST['login'] == 'Login' ) {
	$user	= isset($_POST['email']);
	$pass	= isset($_POST['password']);
	
	if($user && $pass) {
        echo ceklogin('login', $user, $pass, $conn);
    }
    else die( 'error3' );
}
else {

    if ( ceklogin('cek') == 'logged' ) {
        header("Location: gui.php");
    }
    else kick();
    echo @$_SESSION['login'].":".@$_SESSION['user_login']."<br>\n";    

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="theme/js/jquery.min.js"></script>
	<script>
	$(document).ready( function () {
		$("#login").click( function() {
            var login   = $("#login").text()
            var user    = $("#email").val().trim()
			var pass    = $("#password").val().trim()
			if(user && pass) {
				$.post("?login", {  login: login , email: user, password: pass }, function(resmail, status) {
					if (resmail == "Found") {
                        document.location="gui.php";   
                    }
                    else if (resmail == "error1") {
                        $("#notice").text("Email atau password tidak cocok!")
                    } 
                    else if (resmail == "error2") {
                        $("#notice").text("Email tidak terdaftar!")   
                    }
                    else if (resmail == "error3") {
                        $("#notice").text("Email atau password tidak boleh kosong!")
                    }
                    else {
                        $("#notice").text("Sorry limit of login!")
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
</html>
<?php
}
?>