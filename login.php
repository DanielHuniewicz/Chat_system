<?php

session_start();
require_once 'init.php';

//Odesłanie użytkownika do index.php w przypadku nie ustawienia parametrow
if ((!isset($_POST['name'])) || (!isset($_POST['password'])))
{
	header('Location: index.php');
	exit();	
}

// przypisanie POST-ów
$name = $_POST['name'];
$password = $_POST['password'];
$key = md5( $name. hash('sha256', $password ));
$status = 'online';

$name = htmlentities($name, ENT_QUOTES, "UTF-8");
$password = htmlentities($password, ENT_QUOTES, "UTF-8");

$myDb = new database();
$DAO = new UserDAO($myDb);
$user = $DAO->getUser($name);

$apiDAO = new ApiDao();
$verify = $apiDAO->verify($name,$key);
$apiDAO->status($name,$key,$status);   

if ($user && strpos($verify, 'ok') !== false){

	// porownianie wpisanego hasla do zahaszowanego hasla z bazy danych oraz sprawdzenie zaków alfanumerycznych w loginie
	if (($password == $user->pass) && ctype_alnum($user->login)==true){

		// ustawienie zmiennych sesyjnych
		unset($_SESSION['error']);		
		$_SESSION['login'] = true;
		$_SESSION['name'] = $user->login;
		$_SESSION['admin'] = false;	
		$_SESSION['key'] = $key;	

		// przekierowanie na panel admina
		header('Location: chat.php');
		die;
		
	} else {

		// Przygotowanie i wysłanie komunikatu błędu o niepoprawności danych
		$_SESSION['error'] = '<br><span style="color:red">Nieprawidłowe dane</span>';
		header('Location: index.php');
	}
} else {

	// Przygotowanie i wysłanie komunikatu błędu o niepoprawności danych
	$_SESSION['error'] = '<br><span style="color:red">Nieprawidłowe dane</span>';
	header('Location: index.php');
}	
?>