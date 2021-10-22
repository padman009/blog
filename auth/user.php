<?php
require_once "connect.php";
global $mysql;

class User{
    private $name;

    public static function signUp($data)
    {
        if(isset($data['name'])){
            echo "Имя обязательный параметр";
            die();
        }

        extract($data);
        if($password == $re_password){
            $password = password_hash($password, PASSWORD_DEFAULT);
        }else{
            echo "PASSWORDS must be equal";
            die();
        }
        
        $sql = "INSERT INTO `users` (name, email, password) VALUES('$name', '$email', '$password');";
        
        $mysql->query($sql);
        
    }
}

