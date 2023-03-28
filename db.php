<?php

require_once("rest/dao/UserDao.class.php");

$user_dao = new UserDao();

$results = $user_dao->get_all();
print_r($results);
/*
$servername = "localhost";
$username = "root";
$password = "password";
$schema = "lab3_db";

try {
    $conn = new PDO("mysql:host=$servername;port=3307;dbname=$schema",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";

    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);



} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
*/
?>