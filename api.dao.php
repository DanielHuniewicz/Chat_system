<?php

require_once 'init.php';

class ApiDao {

    //Funkcja tworząca nową rozmowe
    public function createChat($login, $key, $chat_name){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://tank.iai-system.com/api/chat/create");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
        'login='.$login.'&key='.$key.'&name='.$chat_name.'');
        $output = curl_exec($ch);
        header('Location: chat.php');
        exit();
    }

    //Funkcja opuszczenia rozmowy przez aktywnego uzytkownika
    public function leave($login, $key, $chat_id){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://tank.iai-system.com/api/chat/leave");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
        'login='.$login.'&key='.$key.'&chat_id='.$chat_id.'');
        $output = curl_exec($ch);
        header('Location: chat.php');
        exit();
    }

    //Funkcja dodajaca uzytkownika po nazwie do aktywnej rozmowy
    public function join($login, $key, $user, $chat_id){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://tank.iai-system.com/api/chat/join");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
        'login='.$login.'&key='.$key.'&user='.$user.'&chat_id='.$chat_id.'');
        $output = curl_exec($ch);
        header('Location: chat.php');
        exit();
    }

    //Funkcja wysylajaca wiadomosc do aktywnej rozmowy
    public function send($login, $key, $chat_id, $message){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://tank.iai-system.com/api/chat/send");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
        'login='.$login.'&key='.$key.'&chat_id='.$chat_id.'&message='.$message.'');
        $output = curl_exec($ch);
        header('Location: chat.php');
        exit();
    }

    //Funkcja pobierajaca wiadomosci
    public function get($login,$key){
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://tank.iai-system.com/api/chat/get");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
        'login='.$login.'&key='.$key.'');
        $users = curl_exec($ch);
        $decode = json_decode($users, true);
        return $decode;
    }

    //Funkcja pobierajaca liste wszystkich uzytkownikow
    public function getAll(){

        $ch = curl_init("http://tank.iai-system.com/api/user/getAll");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $users = curl_exec($ch);
        $decode = json_decode($users, true);
        return $decode;
    }
    
    //Funkcja pobierajaca liste wszystkich rozmow w kotrych uczestniczy uzytkownik
    public function getActive($login,$key){
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://tank.iai-system.com/api/chat/getActive");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
        'login='.$login.'&key='.$key.'');
        $users = curl_exec($ch);
        $decode = json_decode($users, true);
        return $decode;
    }
    
    //Funkcja weryfikujaca login i klucz uzytkownika
    public function verify($login, $key){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://tank.iai-system.com/api/user/verify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
        'login='.$login.'&key='.$key.'');
        $output = curl_exec($ch);
        return $output;
        //die;
    }

    //Funkcja dodajaca nowego uzytkownika
    public function add($login, $password){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://tank.iai-system.com/api/user/add");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
        'login='.$login.'&password='.$password.'');
        $output = curl_exec($ch);
    }
    
    //Funkcja edytujaca ikone uzytkownika
    public function editIcon($login, $key, $avatar){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://tank.iai-system.com/api/user/edit");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
        'login='.$login.'&key='.$key.'&icon='.$avatar.'');
        $output = curl_exec($ch);
        //exit();
    }

    //Funkcja edytujaca haslo uzytkownika
    public function editPassword($login, $key, $new_password){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://tank.iai-system.com/api/user/edit");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
        'login='.$login.'&key='.$key.'&new_password='.$new_password.'');
        $output = curl_exec($ch);
    }

    //Funkcja edytujaca status uzytkownika
    public function status($login, $key, $status){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://tank.iai-system.com/api/user/edit");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
        'login='.$login.'&key='.$key.'&status='.$status.'');
        $output = curl_exec($ch);
    }
}
?>