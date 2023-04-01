<?php
require_once '../vendor/autoload.php';
require_once "services/UserServices.php";

Flight::register('user_service', "UserService");

require_once 'routes/UserRoutes.php';


Flight::start();
?>