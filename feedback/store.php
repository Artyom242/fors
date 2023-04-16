<?php

/** @var PDO $db */
$db = require_once $_SERVER['DOCUMENT_ROOT'].'/db.php';

$name = $_POST['name'];
$telephone = $_POST['telephone'];

$query = $db->prepare('insert into feedback (name, telephone) value (:name, :telephone)');
$query->execute(['name' => $name, 'telephone' => $telephone]);

header('Location: /feedback');

$newList = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/requests.txt');
$data = date("d.m.y");
file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/requests.txt', "Заявка от: $data \n$name $telephone\n$newList");

