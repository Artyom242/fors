<?php

function getPosts($db){
    /** @var PDO $db */
    header('Content-type: json/application');

    $sql = $db->query('SELECT * FROM `feedback`') ->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($sql);
}

function getPost($db, $id){
    /** @var PDO $db */
    header('Content-type: json/application');

    $sql = $db->query("SELECT * FROM `feedback` where id = '$id'")->fetchAll(PDO::FETCH_ASSOC);

    if (!$sql){
        http_response_code(404);
    $error = [
      "starus" => false,
      "message" => "Post not found"
    ];
    echo json_encode($error);
    }else{
        echo json_encode($sql);
    }
}

function addPost($db, $data){
    /** @var PDO $db */
    header('Content-type: json/application');

    $name = $data['name'];
    $telephone = $data['telephone'];

    $sql = $db->prepare("INSERT INTO `feedback`(`id`, `name`, `telephone`) VALUES ('',:name, :telephone)");
    $sql->execute(['name' => $name, 'telephone' => $telephone]);
    http_response_code(201);
    $data = [
        "starus" => true,
        "post_id" => LAST_INSERT_ID($sql)
    ];
    echo json_encode($data);

    if (!$sql){
        http_response_code(404);
        $error = [
            "starus" => false,
            "message" => "Post doesn't add"
        ];
        echo json_encode($error);
    }else{
        echo json_encode($sql);
    }
}

function updatePost($db, $id, $data){
    /** @var PDO $db */
    header('Content-type: json/application');

    $name = $data['name'];
    $telephone = $data['telephone'];
    $sql = $db->prepare("UPDATE `feedback` SET `name` = :name, `telephone` = :telephone WHERE `feedback`.`id` = id");
    $sql->execute(['name' => $name, 'telephone' => $telephone, 'id' => $id]);
    http_response_code(200);

    $data = [
        "starus" => true,
        "message" => "Post is updated"
    ];
    echo  json_encode($data);
}