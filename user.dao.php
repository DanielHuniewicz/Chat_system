<?php

require_once 'init.php';

class UserDAO{

    public $db;

    public function __construct(database $db){

        $this ->db = $db;
    }

    public function getAll() : array{

        $query = 'SELECT * FROM `users`';   
        $rows = $this->db->getRows($query);
        $userObjects = [];
        foreach ($rows as $row){

            $userObjects[] = $this->getUserObject($row);
        }

        return $userObjects;
    }

    public function getAdmins() : array{

        $query = 'SELECT * FROM `users` WHERE admin = "1"';   
        $rows = $this->db->getRows($query);
        $userObjects = [];
        foreach ($rows as $row){

            $userObjects[] = $this->getUserObject($row);
        }

        return $userObjects;
    }

    public function getUser($login){

        $query = 'SELECT * FROM users WHERE login = "'.$login.'"';
        $row = $this->db->getRow($query);

        return $this->getUserObject($row);
    }

    public function getUserObject(array $row) : User {

       $userObject = new User();

        if(!empty($row)){
    
        $userObject->login = $row['login'];
        $userObject->pass = $row['pass'];
        $userObject->email = $row['email'];
        $userObject->age = $row['wiek'];
        $userObject->phone = $row['telefon'];
        $userObject->place = $row['Miejscowosc'];
        $userObject->avatar = $row['avatar'];
        $userObject->admin = $row['admin'];
        }

        return $userObject;
    }

    public function add(User $user){

        $query = "INSERT INTO `users` (`login`, `pass`) VALUES ('{$user->login}', '{$user->pass}');";
        return $this->db->query($query);
    }

    public function editIcon(User $user){

        $query = 'UPDATE `users` SET `avatar` = "'.$user->avatar.'"  WHERE `login` = "'.$user->login.'"';
        return $this->db->query($query);
    }

    public function editPassword(User $user){

        $query = 'UPDATE `users` SET `pass` = "'.$user->pass.'"  WHERE `login` = "'.$user->login.'"';
        return $this->db->query($query);
    }

    public function delete($user){

        $query = "DELETE FROM users  WHERE login = '$user';";
        return $this->db->query($query);
    }
}
?>