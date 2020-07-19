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
$user = $_POST['user'];
$chat_id = $_SESSION['chat_id'];

$user = htmlentities($user, ENT_QUOTES, "UTF-8");

$apiDAO = new ApiDao();
$apiDAO->join($login, $key, $user, $chat_id);
?>

