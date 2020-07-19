<?php

session_start();
require_once 'init.php';

if (!isset($_SESSION['name'])){

    header('Location: index.php');
    exit();
}

unset($_SESSION['error']);	
$chat_name = $_POST['chat_name'];
$login = $_SESSION['name'];
$key = $_SESSION['key'];

$chat_name = htmlentities($chat_name, ENT_QUOTES, "UTF-8");

$apiDAO = new ApiDao();
$getActive = $apiDAO->createChat($login, $key, $chat_name);
?>

