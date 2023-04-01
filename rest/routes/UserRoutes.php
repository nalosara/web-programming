<?php
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
/*
Flight::route("GET /users/@name/@status", function($name, $status){
    echo "Hello from /users route with name = " . $name . " and status = " . $status;
})*/
?>