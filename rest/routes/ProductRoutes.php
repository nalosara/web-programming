<?php

Flight::route("GET /products", function(){
    $category = Flight::query("category");
    $supplier = Flight::query("supplier");
    $order = Flight::query("order");
    Flight::json(Flight::product_service()->get_all_with_filters($category, $supplier, $order));
});

Flight::route("GET /product_by_id", function(){
    Flight::json(Flight::product_service()->get_by_id(Flight::request()->query['id']));
});

Flight::route("GET /products_by_name/@name", function($name) {
    Flight::json(Flight::product_service()->get_by_product_name($name));
});

Flight::route("GET /products/@id", function($id){
    Flight::json(Flight::product_service()->get_by_id($id));
});

Flight::route("GET /categories_and_suppliers", function(){
    Flight::json(Flight::product_service()->get_categories_and_suppliers());
});

Flight::route("POST /products", function(){
    $request = Flight::request()->data->getData();
    $product_name = $request['name'];
    $existing_products = Flight::product_service()->get_by_exact_product_name($product_name);
    if(count($existing_products) > 0){
        Flight::json(["message" => "Product with that name already exists. Please choose another name"], 404);
    } else {    
        Flight::json(['message' => "product added successfully", 'data' => Flight::product_service()->add($request)]);
    }
});

Flight::route("PUT /products/@id", function($id){
    $product = Flight::request()->data->getData();
    $product_name = $product['name'];
    $existing_products = Flight::product_service()->get_by_exact_product_name($product_name);
    if(count($existing_products) > 0 && $existing_products[0]['id'] != $id){
        Flight::json(["message" => "Product with that name already exists. Please choose another name"], 404);
    } else {
        Flight::json(['message' => "product edited successfully", 'data' => Flight::product_service()->update($product, $id)]);
    };
});

Flight::route("DELETE /products/@id", function($id){
    Flight::product_service()->delete($id);
    Flight::json(['message' => "product deleted successfully"]);
});

?>