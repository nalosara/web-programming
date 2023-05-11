<?php
require_once '../vendor/autoload.php';
require_once "services/UserServices.php";
require_once "services/ProductServices.php";
require_once "services/CategoryServices.php";
require_once "services/OrderServices.php";
require_once "services/SupplierServices.php";

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