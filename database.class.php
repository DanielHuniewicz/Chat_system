<?php

class Database
{
    public $db;

    public function __construct(){

        $host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "day2";
    
        $this->db = new mysqli($host,$db_user,$db_password,$db_name);

        if($this->db->connect_error){

           echo 'blad polaczenia';
           var_dump($this->db->connect_error);
           die;
        }
    }

    public function getRow($query){

        $result = $this->db->query($query);
        if ($result) {

            return $result->fetch_assoc();

        } else {

            return [];
       }
    }

    public function getRows($query){

        $result = $this->db->query($query);
        if ($result) {

            return $result->fetch_all(MYSQLI_ASSOC);
            
        } else {

            return [];
        }
    }

    public function query($query){

        $result = $this->db->query($query);
        if($result){

            return true;
            
        } else {

            return false;
        }
    }

    public function getError(){

        return $this->db->error;
    }

    public function getErrorList(){

        return $this->db->error_list;
    }

    public function __destruct(){

        $this->db->close();
    }
}
?>
