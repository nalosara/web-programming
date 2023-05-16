<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once "services/UserService.php";
require_once "services/ProductService.php";
require_once "services/CategoryService.php";
require_once "services/OrderService.php";
require_once "services/SupplierService.php";

Flight::register('user_service', "UserService");
Flight::register('product_service', "ProductService");
Flight::register('category_service', "CategoryService");
Flight::register('supplier_service', "SupplierService");
Flight::register('order_service', "OrderService");

require_once 'routes/UserRoutes.php';
require_once 'routes/ProductRoutes.php';
require_once 'routes/CategoryRoutes.php';
require_once 'routes/SupplierRoutes.php';
require_once 'routes/OrderRoutes.php';


Flight::start();
?>