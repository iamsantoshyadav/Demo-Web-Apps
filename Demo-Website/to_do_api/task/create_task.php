<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// including database and product object files
include_once '../config/database.php';
include_once '../object/task.php';
//from here we are going to create the task
$obj=new database;
$connectDB=$obj->getConnectDB();
$createTask= new task($connectDB);
$taskDetails = json_decode(file_get_contents("php://input"));
$createTask->userName=$taskDetails->userName;
$createTask->taskName=$taskDetails->taskName;
$createTask->taskDescription=$taskDetails->taskDescription;
$createTask->taskTime=date('Y-m-d H:i:s');
if($createTask->create_task()){
    echo json_encode(array(
        "message"=>"created successfully"
    ));
}else{
    echo json_encode(array(
        "Error"=>"Not created"
    ));
}
?>
