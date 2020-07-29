<?php
	require "app/Controller.php";
	$controller = new Controller();
    $controller->checkout();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="main.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">	
	<title>Cart</title>
</head>
<body>
    <p>Request processed</p>
    <a href="/">return to main page</a>
</body>
</html>