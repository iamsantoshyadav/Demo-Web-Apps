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

//now from here we are going to do all the process
$obj=new database;
$connectDB=$obj->getConnectDB();
$deleteProduct=new product($connectDB);
$deleteProduct->id=isset($_GET['id']) ? $_GET['id'] : die();
if($deleteProduct->delete()){
    echo '{';
        echo '"message": "Deleted successfuly."';
    echo '}';
}
else{
    echo '{';
        echo '"Error": "Unable to update product."';
    echo '}';
}