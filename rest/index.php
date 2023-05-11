<?php
require_once '../vendor/autoload.php';
require_once "services/UserService.php";
require_once "services/OrderService.php";
require_once "services/ProductService.php";
require_once "services/CategoryService.php";
require_once "services/AddressService.php";
require_once "services/SupplierService.php";

Flight::register('user_service', "UserService");
Flight::register('category_service', "CategoryService");
Flight::register('product_service', "ProductService");
Flight::register('order_service', "OrderService");
Flight::register('address_service', "AddressService");
Flight::register('supplier_service', "SupplierService");

require_once 'routes/UserRoutes.php';
require_once 'routes/OrderRoutes.php';
require_once 'routes/ProductRoutes.php';
require_once 'routes/CategoryRoutes.php';
require_once 'routes/AddressRoutes.php';
require_once 'routes/SupplierRoutes.php';

Flight::start();
?>