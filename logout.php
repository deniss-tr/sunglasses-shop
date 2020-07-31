<?php
	require "app/Controller.php";
	$controller = new Controller();
	$controller->currentUser()->logout();

