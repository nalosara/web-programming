<?php

require_once("rest/dao/UserDao.class.php");
$user_dao = new UserDao();

$type = $_REQUEST['type'];

switch ($type) {
    case 'add':
        $firstName = $_REQUEST['firstName'];
        $lastName = $_REQUEST['lastName'];
        $age = $_REQUEST['age'];
        $results = $user_dao->add($firstName, $lastName, $age);
        print_r($results);
        break;
    case 'delete':
        $id = $_REQUEST['id'];
        $user_dao->delete($id);
        break;
    case 'update':
        $firstName = $_REQUEST['firstName'];
        $lastName = $_REQUEST['lastName'];
        $age = $_REQUEST['age'];
        $id = $_REQUEST['id'];
        $user_dao->update($firstName, $lastName, $age, $id);
        break;
    case 'get': 
    default:
        $results = $user_dao->get_all();
        print_r($results);
        break;
}
?>