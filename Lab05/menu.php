<?php

try {
    $username = "root";
    $password = "";
    $servername = "mysql:host=localhost;dbname=restaurant;charset=utf8";
    $conn = new PDO(
        $servername,
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Database connection error : ". $e->getMessage();
    exit();
}

$name = isset($_GET['name'])? $_GET['name'] : '%';
$stm = $conn->prepare('SELECT * FROM manus WHERE `manu_name` like :manu_name ');
$stm->execute(['manu_name'=>$name]);

$row = $stm->fetch(PDO::FETCH_ASSOC);
var_dump($row);
$row = $stm->fetch(PDO::FETCH_ASSOC);
var_dump($row);

?>
