<?php
require '../vendor/autoload.php';
require_once("dao/UserDao.class.php");

Flight::register('user_dao', "UserDao");


Flight::route("/", function(){
    echo "Hello from / route";
});

Flight::route("GET /users", function(){
    //echo "Hello from /users route with name = " . $name;
    //$results = Flight::user_dao()->get_all();
    //print_r($results);
    Flight::json(Flight::user_dao()->get_all());
});

Flight::route("GET /user_by_id", function(){
    //$id = Flight::request()->query['id'];
    Flight::json(Flight::user_dao()->get_by_id(Flight::request()->query['id']));
});

Flight::route("GET /users/@id", function($id){
    //echo "Hello from /users route with name = " . $name;
    //$results = Flight::user_dao()->get_by_id($id);
    //print_r($results);
    Flight::json(Flight::user_dao()->get_by_id($id));
});

Flight::route("POST /users", function(){
    //echo "Hello from /users route with name = " . $name;
    //$user_dao = new UserDao();
    $request = Flight::request()->data->getData();
    //$response = Flight::user_dao()->add($request);
    
    Flight::json(['message' => "User added successfully", 'data' => Flight::user_dao()->add($request)]);
});

Flight::route("PUT /users/@id", function($id){
    //echo "Hello from /users route with name = " . $name;
    //$user_dao = new UserDao();
    $user = Flight::request()->data->getData();
    //$response = Flight::user_dao()->update($user, $id);
    
    Flight::json(['message' => "User edited successfully", 'data' => Flight::user_dao()->update($user, $id)]);
});

Flight::route("DELETE /users/@id", function($id){
    //echo "Hello from /users route with name = " . $name;
    //$user_dao = new UserDao();
    Flight::user_dao()->delete($id);
    //print_r($results);
    Flight::json(['message' => "User deleted successfully"]);
});

Flight::route("GET /users/@name/@status", function($name, $status){
    echo "Hello from /users route with name = " . $name . " and status = " . $status;
});

Flight::start();
?>