<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


Flight::route("GET /carts", function(){
    Flight::json(Flight::cart_service()->get_all());
});

Flight::route("GET /cart_by_id", function(){
    Flight::json(Flight::cart_service()->get_by_id(Flight::request()->query['id']));
});

Flight::route("GET /carts/@id", function($id){
    Flight::json(Flight::cart_service()->get_by_id($id));
});

Flight::route("POST /carts", function(){
    $request = Flight::request()->data->getData(); 
    $user_id = $request['user_id'];
    $decoded = (array)JWT::decode($user_id, new Key(Config::JWT_SECRET(), 'HS256'));
    $decoded_user_id = $decoded['id'];  
    $request['user_id'] = $decoded_user_id;
    Flight::json(['message' => "cart added successfully", 'data' => Flight::cart_service()->add($request)]);
});

Flight::route("PUT /carts/@id", function($id){
    $address = Flight::request()->data->getData();    
    Flight::json(['message' => "cart edited successfully", 'data' => Flight::cart_service()->update($address, $id)]);
});

Flight::route("DELETE /carts/@id", function($id){
    Flight::cart_service()->delete($id);
    Flight::json(['message' => "cart deleted successfully"]);
});

Flight::route("GET /carts_by_user_id/@user_id", function($user_id){
    $decoded = (array)JWT::decode($user_id, new Key(Config::JWT_SECRET(), 'HS256'));
    $decoded_user_id = $decoded['id'];
    Flight::json(Flight::cart_service()->get_by_user_id($decoded_user_id));
});

Flight::route("DELETE /carts_by_user_id/@user_id", function($user_id){
    $decoded = (array)JWT::decode($user_id, new Key(Config::JWT_SECRET(), 'HS256'));
    $decoded_user_id = $decoded['id'];
    Flight::cart_service()->delete_by_user_id($decoded_user_id);
    Flight::json(['message' => "cart deleted successfully"]);
});

Flight::route("DELETE /cart_by_product_id/@product_id", function($product_id){
    Flight::cart_service()->delete_by_product_id($product_id);
    Flight::json(['message' => "cart deleted successfully"]);
});

Flight::route("DELETE /carts_by_user_and_product/@user_id/@product_id", function($user_id, $product_id){
    Flight::cart_service()->delete_by_user_and_product($user_id, $product_id);
    Flight::json(['message' => "cart deleted successfully"]);
});



/*
Flight::route("GET /carts/@name/@status", function($name, $status){
    echo "Hello from /carts route with name = " . $name . " and status = " . $status;
})*/
?>