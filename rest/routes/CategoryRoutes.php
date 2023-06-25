<?php
Flight::route("GET /categories", function(){
    Flight::json(Flight::category_service()->get_all());
});

Flight::route("GET /category_by_id", function(){
    Flight::json(Flight::category_service()->get_by_id(Flight::request()->query['id']));
});

Flight::route("GET /categories/@id", function($id){
    Flight::json(Flight::category_service()->get_by_id($id));
});

Flight::route("POST /categories", function(){
    $request = Flight::request()->data->getData(); 
    $category_name = $request['name'];
    $existing_categories = Flight::category_service()->get_category_by_name($category_name);
    if(count($existing_categories) > 0){
        Flight::json(["message" => "Category with that name already exists. Please choose another name"], 404);
    } else {   
        Flight::json(['message' => "Category added successfully.", 'data' => Flight::category_service()->add($request)]);
    };
});

Flight::route("PUT /categories/@id", function($id){
    $category = Flight::request()->data->getData();    
    Flight::json(['message' => "category edited successfully", 'data' => Flight::category_service()->update($category, $id)]);
});

Flight::route("DELETE /categories/@id", function($id){
    Flight::category_service()->delete($id);
    Flight::json(['message' => "category deleted successfully"]);
});

?>