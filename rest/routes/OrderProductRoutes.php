<?php

Flight::route("DELETE /order_product_by_product_id/@product_id", function($product_id){
    Flight::order_product_service()->delete_by_product_id($product_id);
    Flight::json(['message' => "order product deleted successfully"]);
});

Flight::route("GET /order_product/check/@product_id", function($product_id){
    Flight::json(Flight::order_product_service()->check_if_exists_order_products($product_id));
});

?>