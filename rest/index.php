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
require_once "services/AddressService.php";
require_once "services/CartService.php";
require_once "services/FormService.php";
require_once "services/OrderProductService.php";

Flight::register('user_service', "UserService");
Flight::register('product_service', "ProductService");
Flight::register('category_service', "CategoryService");
Flight::register('supplier_service', "SupplierService");
Flight::register('order_service', "OrderService");
Flight::register('address_service', "AddressService");
Flight::register('cart_service', "CartService");
Flight::register('form_service', "FormService");
Flight::register('order_product_service', "OrderProductService");


require_once 'routes/UserRoutes.php';
require_once 'routes/ProductRoutes.php';
require_once 'routes/CategoryRoutes.php';
require_once 'routes/SupplierRoutes.php';
require_once 'routes/OrderRoutes.php';
require_once 'routes/AddressRoutes.php';
require_once 'routes/CartRoutes.php';
require_once 'routes/FormRoutes.php';
require_once 'routes/OrderProductRoutes.php';

Flight::map('query', function($name, $default_value = null) {
    $request = Flight::request();
    $query_params = @$request->query->getData()[$name];
    $query_params = $query_params ? $query_params : $default_value;
    return $query_params;
});


Flight::start();
?>