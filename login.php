<?php
//	session_start();
	require "app/Controller.php";
	$controller = new Controller();
	$controller->login();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="main.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">	
	<title>Login</title>
</head>
<body>
	<?php
      include 'templates\header.php';
    ?>
	<div class="wrapper">
		<form class="login-form" method="POST" action="login.php">
				<h1 class="login-title">LOG IN</h1>
				<input class="input-text" type="text" name="login" required placeholder="Your login" autofocus>
				<input class="input-text" type="password" name="password" placeholder="Password" required>
				<?= $message ?>
				<input class="btn btn_submit" type="submit" value="Login">
			</form>
	</div>

</body>
</html>