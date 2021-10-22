<?php
require_once "../connect.php";

global $mysql;

extract($_POST);

if($password == $re_password){
    $password = password_hash($password, PASSWORD_DEFAULT);
}else{
    echo "PASSWORDS must be equal";
    die();
}

$sql = "INSERT INTO `users` (name, email, password) VALUES('$name', '$email', '$password');";

$mysql->query($sql);

header("Location: http://localhost/Web/blog1/login.php");