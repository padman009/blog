<?php
require_once "../connect.php";

global $mysql;

extract($_POST);

$sql = "SELECT * FROM `users` WHERE name = '$name' OR email = '$email' LIMIT 1;";

$res = $mysql->query($sql);

$res = $res->fetch_assoc();

if(!password_verify($password, $res['password'])){
    echo "Wrong password";
}

session_start();

$_SESSION['user_name'] = $res['name'];
$_SESSION['user_email'] = $res['email'];
$_SESSION['user_date'] = $res['date'];

header("Location: http://localhost/Web/blog1");