<?php
require_once "connect.php";
global $mysql;

class Post{
    private $id;
    public $title;
    public $text;
    public $date;

    function _construct($data){
        // $data = json_decode($data, true);
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->text = $data['text'];
        $this->date = $data['date'];
    }

    static function addPost($data){
        global $mysql;
        $slug = self::getSlug($data['title']);
        $sql = "INSERT INTO `posts` (title, text, slug) VALUES('".$data['title']."', '".$data['text'].", $slug');";
        echo $sql;
        $mysql->query($sql);
        if($mysql->errno){
            return null;
        }
        return 1;
    }

    static function getSlug($title){
        $title = strtolower($title);
        $title = str_replace([" ", "-"], $title, "_");
    }

    static function getBySlug($slug){
        $sql = "SELECT * FROM posts WHERE slug = '$slug' LIMIT 1";
        global $mysql;
        $row = $mysql->query($sql);
        if(!$row){
            throw new Exception("Такого поста нет в бд");
        }

        $data = $row->fetch_assoc();
        return $data;
    }

    static function getAllPosts(){
        $sql = "SELECT * FROM `posts`";
        global $mysql;
        $res = $mysql->query($sql);
        return $res->fetch_all(MYSQLI_ASSOC);
    }
}

function handleRequest($method, $options = []){
    $post = new Post();
    $request = empty(file_get_contents("php://input")) ? "" : json_decode(file_get_contents("php://input"), true);
    if($method == "POST"){
        $data = $request['data'];
        $post = Post::addPost($data);
        if($post != null){
            $res['status'] = true;
        }else{
            $res['status'] = false;
            $res['message'] = "Ошибка при создании записи";
        }
        echo json_encode($res);
    }else if($method == "GET"){
        $data = isset($options['query']) ? Post::getBySlug($options['query']) : Post::getAllPosts();
        
        
        if($data == null){
            $res['status'] = "false";
            $res['message'] = "Ошибка при получении записей";
        }else if(empty($data)){
            $res['message'] = "Посты не найдены";
            $res['status'] = "false";
        }else {
            $res['data'] = $data;
            $res['status'] = "true";
        }

        if(isset($options['query'])){
            // $post = new Post($data);
            return $data;
        }else{
            echo json_encode($res);
        }
    }
}