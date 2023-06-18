<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


Flight::route("GET /orders", function(){
    Flight::json(Flight::order_service()->get_all());
});

Flight::route("GET /order_by_id", function(){
    Flight::json(Flight::order_service()->get_by_id(Flight::request()->query['id']));
});

Flight::route("GET /orders/@id", function($id){
    Flight::json(Flight::order_service()->get_by_id($id));
});

Flight::route("POST /orders", function(){
    $request = Flight::request()->data->getData();
    $user_id = $request['user_id'];
    $decoded = (array)JWT::decode($user_id, new Key(Config::JWT_SECRET(), 'HS256'));
    $decoded_user_id = $decoded['id'];  
    $request['user_id'] = $decoded_user_id;    
    Flight::json(['message' => "order added successfully", 'data' => Flight::order_service()->add($request)]);
});

Flight::route("PUT /orders/@id", function($id){
    $order = Flight::request()->data->getData();    
    Flight::json(['message' => "order edited successfully", 'data' => Flight::order_service()->update($order, $id)]);
});

Flight::route("DELETE /orders/@id", function($id){
    Flight::order_service()->delete($id);
    Flight::json(['message' => "order deleted successfully"]);
});

Flight::route("DELETE /orders_by_product_id/@product_id", function($product_id){
    Flight::order_service()->delete_by_product_id($product_id);
    Flight::json(['message' => "order deleted successfully"]);
});

Flight::route("GET /orders_by_user_id/@user_id", function($user_id){
    Flight::json(Flight::order_service()->get_by_user_id($user_id));
});



?>