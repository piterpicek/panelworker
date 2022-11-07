<?php
ini_set("display_errors",1);
error_reporting(E_ALL);

session_start();
//@session_destroy();
//var_export($_SESSION['user_token']);
if( empty($_SESSION['user_login']) || empty($_SESSION['username']) ) {
	header("Location: login.php");
}
echo @$_SESSION['user_login'].":".@$_SESSION['username'].":".@$_SESSION['api_token']."<br>\n";
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Test Panel Worker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="theme/js/jquery.min.js"></script>
	<script>
	$(document).ready( function () {
		$("#send").click( function() {
			var apits = $("#api_token").val().trim()
			var uname = $("#mailuser").val().trim()
			var lists = $("#markItUp").val().trim()
			if(lists) {
				$.post("check.php?user="+ uname +"api_token="+ apits, { maillist: lists.split("\n") }, function(resmail, status) {
					$("#result_life").text(resmail+" -> "+status+"<br>")
					//var value = resmail.split("\n")
					// $.each(value, function (index, values) {
					// 	var json = JSON.parse(values)
					// 	if (json.status == "life") 
					// 		$("#result_life").text(json.email+"<br>");
					// 	else 
					// 		$("#result_die").text(json.email+"<br>");
					// })
				})
			}
		})
	})
	</script>
</head>
<body>
<div style="width: 50%">
	<input type="hidden" id="api_token" value="<?=$_SESSION['api_token'];?>">
	<input type="hidden" id="mailuser" value="<?=$_SESSION['username'];?>">
	<textarea id="markItUp"></textarea><br>
	<button id="send">Send</button>
</div>
<hr>
<p id="result_life"></p>
<hr>
<p id="result_die"></p>
</body>
</html>
