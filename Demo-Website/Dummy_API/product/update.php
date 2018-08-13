<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../object/product.php';
$obj=new database;
$connectDB=$obj->getConnectDB();
$updateProduct=new product($connectDB);
//here we will take from json
$updateProduct->id=isset($_GET['id']) ? $_GET['id'] : die();
$getData=json_decode(file_get_contents("php://input"));
$updateProduct->name = $getData->name;
$updateProduct->price = $getData->price;
$updateProduct->description = $getData->description;
$updateProduct->category_id = $getData->category_id;
$updateProduct->modified=date('Y-m-d H:i:s');
if($updateProduct->update()){
    echo '{';
        echo '"message": "Product updated successfuly."';
    echo '}';
}
else{
    echo '{';
        echo '"Error": "Unable to update product."';
    echo '}';
}
 ?>