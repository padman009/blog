<?php

$url = isset($_GET["url_param"]) ? $_GET["url_param"]: "";

$req = explode("/", trim($url, "/"));

$file="";
$data = empty(file_get_contents("php://input")) ? "" : json_decode(file_get_contents("php://input"), true);

if($url == ""){
    $file = "pages/main.php";
}else if($req[0] == "login"){
    $file = "pages/login.php";
}else if($req[0] == "sign_up"){
    $file = "pages/sign_up.php";
}else if($req[0] == "posts" && !isset($req[1])){
    $file = "server/posts.php";
    require_once $file;
    $options = [];
    if(isset($data['query']) && $data['query']){
        $options['query'] = $data['query'];
    }
    handleRequest($_SERVER["REQUEST_METHOD"], $options);
}else if($req[0] == "posts" && isset($req[1])){
    require_once "server/posts.php";
    $options = ["query" => $req[1]];
    $post = handleRequest($_SERVER["REQUEST_METHOD"], $options);
    
    if($post){
        $file = "pages/post.php";
    }else{
        $file = "pages/404.php";
    }
}else if($req[0] == "auth"){
    $file = "auth/user.php";
    require_once $file;
    handleRequest($data);
}

// echo "file=".json_encode($req).PHP_EOL;
require_once $file;