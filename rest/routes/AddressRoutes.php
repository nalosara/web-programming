<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


Flight::route("GET /addresses", function(){
    Flight::json(Flight::address_service()->get_all());
});

Flight::route("GET /address_by_id", function(){
    Flight::json(Flight::address_service()->get_by_id(Flight::request()->query['id']));
});

Flight::route("GET /addresses/@id", function($id){
    Flight::json(Flight::address_service()->get_by_id($id));
});

Flight::route("POST /addresses", function(){
    $request = Flight::request()->data->getData(); 
    $user_id = $request['user_id'];
    $alias = $request['alias'];
    $existing_alias = Flight::address_service()->get_address_by_user_id_and_alias($user_id, $alias);  
    if(count($existing_alias) > 0){
        Flight::json(["message" => "You already have address with that alias. Please choose another alias"], 404);
    } else { 
        Flight::json(['message' => "address added successfully", 'data' => Flight::address_service()->add($request)]);
    }
});

Flight::route("PUT /addresses/@id", function($id){
    $address = Flight::request()->data->getData();
    $user_id = $address['user_id'];
    $alias = $address['alias'];
    $existing_alias = Flight::address_service()->get_address_by_user_id_and_alias($user_id, $alias);
    if(count($existing_alias) > 0 && $existing_alias[0]['id'] != $id){
        Flight::json(["message" => "You already have address with that alias. Please choose another alias"], 404);
    } else {
        Flight::json(['message' => "address edited successfully", 'data' => Flight::address_service()->update($address, $id)]);
    }    
    
});

Flight::route("DELETE /addresses/@id", function($id){
    Flight::address_service()->delete($id);
    Flight::json(['message' => "address deleted successfully"]);
});

Flight::route("GET /addresses_by_user_id/@user_id", function($user_id){
    Flight::json(Flight::address_service()->get_address_by_user_id($user_id));
});

Flight::route("GET /addresses_by_user_token/@user_id", function($user_id){
    $decoded = (array)JWT::decode($user_id, new Key(Config::JWT_SECRET(), 'HS256'));
    $decoded_user_id = $decoded['id'];
    Flight::json(Flight::address_service()->get_address_by_user_id($decoded_user_id));
});
/*
Flight::route("GET /addresses/@name/@status", function($name, $status){
    echo "Hello from /addresses route with name = " . $name . " and status = " . $status;
})*/
?>