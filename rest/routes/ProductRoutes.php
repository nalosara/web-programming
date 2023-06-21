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

Flight::route("POST /products", function(){
    $request = Flight::request()->data->getData();    
    Flight::json(['message' => "product added successfully", 'data' => Flight::product_service()->add($request)]);
});

Flight::route("PUT /products/@id", function($id){
    $product = Flight::request()->data->getData();    
    Flight::json(['message' => "product edited successfully", 'data' => Flight::product_service()->update($product, $id)]);
});

Flight::route("DELETE /products/@id", function($id){
    Flight::product_service()->delete($id);
    Flight::json(['message' => "product deleted successfully"]);
});


/*
Flight::route("GET /products_by_supplier/@supplier_id", function($supplier_id){
    Flight::json(Flight::product_service()->get_by_supplier_id($supplier_id));
});

Flight::route("GET /products_by_supplier_price_asc/@supplier_id", function($supplier_id){
    Flight::json(Flight::product_service()->get_by_supplier_and_price_asc($supplier_id));
});

Flight::route("GET /products_by_supplier_price_desc/@supplier_id", function($supplier_id){
    Flight::json(Flight::product_service()->get_by_supplier_and_price_desc($supplier_id));
});

Flight::route("GET /products_by_price_asc", function(){
    Flight::json(Flight::product_service()->get_by_price_asc());
});

Flight::route("GET /products_by_price_desc",function(){
    Flight::json(Flight::product_service()->get_by_price_desc());
});

Flight::route("GET /products_by_category/@category_id", function($category_id){
    Flight::json(Flight::product_service()->get_by_category_id($category_id));
});

Flight::route("GET /products_by_category_price_asc/@category_id", function($category_id){
    Flight::json(Flight::product_service()->get_by_category_and_price_asc($category_id));
});

Flight::route("GET /products_by_category_price_desc/@category_id", function($category_id){
    Flight::json(Flight::product_service()->get_by_category_and_price_desc($category_id));
});

Flight::route("GET /products_by_category_and_supplier/@category_id/@supplier_id", function($category_id, $supplier_id){
    Flight::json(Flight::product_service()->get_by_category_and_supplier($category_id, $supplier_id));
});

Flight::route("GET /products_by_category_and_supplier_price_asc/@category_id/@supplier_id", function($category_id, $supplier_id){
    Flight::json(Flight::product_service()->get_by_category_and_supplier_price_asc($category_id, $supplier_id));
});

Flight::route("GET /products_by_category_and_supplier_price_desc/@category_id/@supplier_id", function($category_id, $supplier_id){
    Flight::json(Flight::product_service()->get_by_category_and_supplier_price_desc($category_id, $supplier_id));
});
*/
?>