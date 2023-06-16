<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::route("GET /forms", function(){
    Flight::json(Flight::form_service()->get_all());
});

Flight::route("POST /forms", function(){
    $request = Flight::request()->data->getData(); 
    $user_id = $request['user_id'];
    $decoded = (array)JWT::decode($user_id, new Key(Config::JWT_SECRET(), 'HS256'));
    $decoded_user_id = $decoded['id'];  
    $request['user_id'] = $decoded_user_id;
    Flight::json(['message' => "form added successfully", 'data' => Flight::form_service()->add($request)]);
});

?>