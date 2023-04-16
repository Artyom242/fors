<?php
/** @var PDO $db */
$db = require_once $_SERVER['DOCUMENT_ROOT'] . '/db.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
$q = $_GET['q'];

$params = explode('/', $q);
$type = $params[0];
$id = $params[1];

if($_SERVER['REQUEST_METHOD'] === "GET"){
    if($type === 'feedback'){
        if(isset($id)){
            getPost($db,$id);
        }else{
            getPosts($db);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === "POST"){
    if($type === 'feedback'){
        if(isset($id)){

        }else{
            addPost($db, $_POST);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === "PATCH"){
    if($type === 'feedback'){
        if(isset($id)){
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
            updatePost($db, $id, $data);
        }
    }
}
