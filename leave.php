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
$chat_id = $_POST['id'];

$apiDAO = new ApiDao();
$apiDAO->leave($login, $key, $chat_id);
?>

