<?php
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
/*
Flight::route("GET /orders/@name/@status", function($name, $status){
    echo "Hello from /orders route with name = " . $name . " and status = " . $status;
})*/
?>