<?php

class UserDao{

    private $connection;

    //Class contructor used to establish connection to db
    public function __construct(){
        try {
            $servername = "localhost";
            $username = "root";
            $password = "password";
            $schema = "lab3_db";
            $this->connection = new PDO("mysql:host=$servername;port=3307;dbname=$schema",$username,$password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    //Method used to get all users from db
    public function get_all() {
        $stmt = $this->connection->prepare("SELECT * FROM users");
        $stmt->execute();
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Method used to get all users from db by id
    public function get_by_id($id) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute(['id' => $id]);
        return $result = $stmt->fetchAll();
    }

    //Method used to add users to db
    public function add($user) {
        $stmt = $this->connection->prepare("INSERT INTO users (firstName, lastName, age) VALUES (:firstName, :lastName, :age)");
        $stmt->execute($user);
        $user['id'] = $this->connection->lastInsertId();
        return $user;

    }

    //Method used to update users from db
    public function update($user, $id) {
        $user['id'] = $id;
        $stmt = $this->connection->prepare("UPDATE users SET firstName = :firstName, lastName = :lastName, age = :age WHERE id=:id");
        $stmt->execute($user);
        return $user;
    }

    //Method used to delete users from db
    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM users WHERE id=:id");
        $stmt->bindParam(':id', $id); #prevent SQL injection
        $stmt->execute();
    }
}

?>