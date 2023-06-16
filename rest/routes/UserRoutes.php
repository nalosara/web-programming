<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


Flight::route("GET /users", function(){
    Flight::json(Flight::user_service()->get_all());
});

Flight::route("GET /user_by_id", function(){
    Flight::json(Flight::user_service()->get_by_id(Flight::request()->query['id']));
});

Flight::route("GET /users/@id", function($id){
    Flight::json(Flight::user_service()->get_by_id($id));
});

Flight::route("POST /users", function(){
    $request = Flight::request()->data->getData();    
    Flight::json(['message' => "User added successfully", 'data' => Flight::user_service()->add($request)]);
});

Flight::route("PUT /users/@id", function($id){
    $user = Flight::request()->data->getData();    
    Flight::json(['message' => "User edited successfully", 'data' => Flight::user_service()->update($user, $id)]);
});

Flight::route("DELETE /users/@id", function($id){
    Flight::user_service()->delete($id);
    Flight::json(['message' => "User deleted successfully"]);
});

Flight::route('POST /login', function(){
    $login = Flight::request()->data->getData();
    $user = Flight::user_service()->get_user_by_email($login['email']);
    if(count($user) > 0){
        $user = $user[0];
    }
    if (isset($user['id'])){
      if($user['password'] == md5($login['password'])){
        unset($user['password']);
        unset($user['phone_number']);
        unset($user['email_address']);
        $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
        Flight::json(['token' => $jwt]);
      }else{
        Flight::json(["message" => "Incorrect username or password"], 404);
      }
    }else{
      Flight::json(["message" => "Incorrect username or password"], 404);
  }
});

Flight::route('POST /signup', function(){
    $signup = Flight::request()->data->getData();
    $user = Flight::user_service()->get_user_by_email($signup['email']);
    print_r($signup);
    if(count($user) > 0){
        Flight::json(["message" => "User with that email is already registered. Please choose a different email or log in instead."], 404);
    }else {
        $new_user = new stdClass();
        $new_user->name = $signup['full_name'];
        $new_user->email_address = $signup['email'];
        $new_user->phone_number = $signup['phone'];
        $new_user->password = md5($signup['password']);
        $new_user->authorization = 'unauthorized';
        $new_user_array = (array) $new_user;
        $added_user = Flight::user_service()->add($new_user_array);
        $logged_user = Flight::user_service()->get_user_by_email($added_user['email_address'])[0];
        unset($logged_user['email_address']);
        unset($logged_user['password']);
        unset($logged_user['phone_number']);
        $jwt = JWT::encode($logged_user, Config::JWT_SECRET(), 'HS256');
        Flight::json(['token' => $jwt]);


    }
});

?>