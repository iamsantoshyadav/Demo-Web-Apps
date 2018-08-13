<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../object/product.php';
$obj=new database;
$connectDB=$obj->getConnectDB();
$readProduct= new product($connectDB);
$results=$readProduct->read();
if($results->num_rows>0){
    $product_array=array();
    $product_array['records']=array();
    while($row=$results->fetch_assoc()){
        extract($row);
        $product_items=array(
            "id" => $id,
            "name"=>$name,
            "description" => html_entity_decode($description),
            "price" => $price,
            "category_id" => $category_id
        );
        array_push($product_array['records'],$product_items);
    }
    echo json_encode($product_array);
}else{
    json_encode(array("message"=>"No product found"));
}
?>