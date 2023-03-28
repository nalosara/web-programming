<?php

require_once("rest/dao/UserDao.class.php");

$user_dao = new UserDao();

$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];
$age = $_REQUEST['age'];

$results = $user_dao->add($firstName, $lastName, $age);
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

    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $age = $_REQUEST['age'];

    $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, age) VALUES ('$firstName', '$lastName', '$age')");
    $stmt->execute();
    print_r($result);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
*/
?>