<?php
Flight::route("GET /products", function(){
    Flight::json(Flight::product_service()->get_all());
});

Flight::route("GET /product_by_id", function(){
    Flight::json(Flight::product_service()->get_by_id(Flight::request()->query['id']));
});

Flight::route("GET /products/@id", function($id){
    Flight::json(Flight::product_service()->get_by_id($id));
});

Flight::route("POST /products", function(){
    $request = Flight::request()->data->getData();    
    Flight::json(['message' => "Product added successfully", 'data' => Flight::product_service()->add($request)]);
});

Flight::route("PUT /products/@id", function($id){
    $product = Flight::request()->data->getData();    
    Flight::json(['message' => "Product edited successfully", 'data' => Flight::product_service()->update($product, $id)]);
});

Flight::route("DELETE /products/@id", function($id){
    Flight::product_service()->delete($id);
    Flight::json(['message' => "Product deleted successfully"]);
});

?>