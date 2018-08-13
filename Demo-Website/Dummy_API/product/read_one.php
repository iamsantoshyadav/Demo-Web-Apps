<?php
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../object/product.php';

//calling database and objects 
$obj= new database;
$conneceDB=$obj->getConnectDB();
$readProduct=new product($conneceDB);
$readProduct->id=isset($_GET['id']) ? $_GET['id'] : die();
$readProduct->read_one();
$product_array=array(
    "id" =>  $readProduct->id,
    "name" => $readProduct->name,
    "description" => $readProduct->description,
    "price" => $readProduct->price,
    "category_id" => $readProduct->category_id
);

    echo json_encode($product_array);
?>