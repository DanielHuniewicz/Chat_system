<?php

session_start();
require_once 'init.php';

if(isset($_POST['login'])){
    
    $login = $_POST['login'];
    $key = $_SESSION['key'];
    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    
    if(isset($_POST['avatar'])){

        $avatar = $_POST['avatar'];
        $avatar = htmlentities($avatar, ENT_QUOTES, "UTF-8");

        if(!empty($login) && !empty($avatar)){

            $myDb = new database();
            $DAO = new UserDAO($myDb);
            $user = $DAO->getUser($login);

            $user->avatar=$avatar;

            $result = $DAO->editIcon($user);

            if($result){
        
                $apiDAO = new ApiDao();
                $apiDAO->editIcon($login,$key, $avatar);   
                header('Location: chat.php');
                exit();

            } else {
            
                echo 'wystapil blad';
                var_dump($db -> error_list);
                die;
            }
        } else {

            $_SESSION['error_edit']="<b>Nie podano danych</b><br>";
            header('Location: edit_panel.php');
        }

    } else if(isset($_POST['old_password']) && isset($_POST['new_password'])){

        $new_password = $_POST['new_password'];
        $new_password = htmlentities($new_password, ENT_QUOTES, "UTF-8");
        $old_password = $_POST['old_password'];
        $old_password = htmlentities($old_password, ENT_QUOTES, "UTF-8");
    
        if(!empty($login) && !empty($new_password) && !empty($old_password)){

            $myDb = new database();
            $DAO = new UserDAO($myDb);
            $user = $DAO->getUser($login);

            if($old_password == $user->pass){

                $user->pass=$new_password;
                $result = $DAO->editPassword($user);
    
                if($result){
            
                    $apiDAO = new ApiDao();
                    $apiDAO->editPassword($login,$key,$new_password);
                    $apiDAO->status($login,$key,$status);
                    $status = 'offline';
                    session_unset();
	                header('Location: index.php');
                    exit();
    
                } else {
                
                    echo 'wystapil blad';
                    var_dump($db -> error_list);
                    die;
                }
            } else {
                $_SESSION['error_edit']="<b>Błędne hasło</b><br>";
                header('Location: edit_panel.php');
            }
        } else {

            $_SESSION['error_edit']="<b>Nie podano danych</b><br>";
            header('Location: edit_panel.php');
        }
    }

} else {

    header('Location: chat.php');
    exit();
}
?>