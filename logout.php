<?php
	
	require_once 'init.php';
	session_start();

	if (!isset($_SESSION['name'])){

		header('Location: index.php');
		exit();
	}

	$status = 'offline';
	$login = $_SESSION['name'];
	$key = $_SESSION['key'];
	$apiDAO = new ApiDao();
	$apiDAO->status($login,$key,$status);
	  
	// Wyczyszczenie wszystkich zmiennych sesyjnych
	session_unset();
	header('Location: index.php');
?>