<?php
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
    Flight::json(['message' => "address added successfully", 'data' => Flight::address_service()->add($request)]);
});

Flight::route("PUT /addresses/@id", function($id){
    $address = Flight::request()->data->getData();    
    Flight::json(['message' => "address edited successfully", 'data' => Flight::address_service()->update($address, $id)]);
});

Flight::route("DELETE /addresses/@id", function($id){
    Flight::address_service()->delete($id);
    Flight::json(['message' => "address deleted successfully"]);
});
/*
Flight::route("GET /addresses/@name/@status", function($name, $status){
    echo "Hello from /addresses route with name = " . $name . " and status = " . $status;
})*/
?>