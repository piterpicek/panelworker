<?php
session_start();
require_once "config.php";

if (isset($_GET['register'])) {
    $sql = "INSERT INTO `costumer`(`cn_costumer`, `costumer_n`, `costumer_p`, `capi_token`, `capi_drive`, `c_credits`, `count_prg`, `bang_ip`, `approved_r`, `banned_r`, `reg_date`)
    VALUES ([value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if( (mysqli_num_rows($cek) > 0 ) && (isset($_GET['login']) && ($_POST['password'] == $data['password']) ) ) {
        $_SESSION['user_login'] = true;
        $_SESSION['username']   = $data['email'];
        $_SESSION['api_token']  = $data['api_token'];
        echo "Found";
    }
    else
        echo 'error1';
}
else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tempat Daftar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    $(document).ready( function () {
    	$("#registrasi").click( function() {
            var user    = $("#email").val().trim()
			var pass    = $("#password").val().trim()
			if(user && pass) {
				$.post("?login", { email: user, password: pass }, function(resmail, status) {
					if (resmail == "Found") {
                        document.location="login.php";
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
