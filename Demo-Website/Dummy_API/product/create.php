<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// including database and product object files
include_once '../config/database.php';
include_once '../object/product.php';
//Form here we are going to create data into the database
$obj = new database;
$connectDB=$obj->getConnectDB();
$newProduct= new product($connectDB);
//get the data from json
$getData=json_decode(file_get_contents("php://input"));
$newProduct->name=$getData->name;
$newProduct->description=$getData->description;
$newProduct->price=$getData->price;
$newProduct->category_id=$getData->category_id;
$newProduct->created=date('Y-m-d H:i:s');
if($newProduct->create()){
    echo json_encode(array(
        "message"=>"created successfully"
    ));
}
else{
    echo json_encode(array(
        "Error"=>"Not created"
    ));
}

?>