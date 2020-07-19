<?php

session_start();
require_once 'init.php';

if (!isset($_SESSION['name'])){

    header('Location: index.php');
    exit();
}
unset($_SESSION['error']);	

$login = $_SESSION['name'];
$key = $_SESSION['key'];
$chat_id = $_SESSION['chat_id'];
$message = $_POST['message'];

$message = htmlentities($message, ENT_QUOTES, "UTF-8");

$apiDAO = new ApiDao();
$apiDAO->send($login, $key, $chat_id, $message);
?>

