<?php
Flight::route("GET /suppliers", function(){
    Flight::json(Flight::supplier_service()->get_all());
});

Flight::route("GET /supplier_by_id", function(){
    Flight::json(Flight::supplier_service()->get_by_id(Flight::request()->query['id']));
});

Flight::route("GET /suppliers/@id", function($id){
    Flight::json(Flight::supplier_service()->get_by_id($id));
});

Flight::route("POST /suppliers", function(){
    $request = Flight::request()->data->getData();
    $supplier_name = $request['name'];
    $existing_suppliers = Flight::supplier_service()->get_supplier_by_name($supplier_name);
    if(count($existing_suppliers) > 0){
        Flight::json(["message" => "Supplier with that name already exists. Please choose another name"], 404);
    } else {    
        Flight::json(['message' => "Supplier added successfully.", 'data' => Flight::supplier_service()->add($request)]);
    };
});

Flight::route("PUT /suppliers/@id", function($id){
    $supplier = Flight::request()->data->getData();    
    Flight::json(['message' => "supplier edited successfully", 'data' => Flight::supplier_service()->update($supplier, $id)]);
});

Flight::route("DELETE /suppliers/@id", function($id){
    Flight::supplier_service()->delete($id);
    Flight::json(['message' => "supplier deleted successfully"]);
});

?>