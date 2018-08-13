<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../object/task.php';
//from here we are going to read the all task
$obj=new database;

$connectDB=$obj->getConnectDB();
$tasks= new task($connectDB);
$tasks->userName=isset($_GET['userName']) ? $_GET['userName'] : die();
$results=$tasks->readTask();
if($results->num_rows>0){
    $task_array=array();
    $task_array['tasks']=array();
    while($row=$results->fetch_assoc()){
        extract($row);
        $tasks=array(
            "taskId"=>$taskId,
            "userName"=>$userName,
            "taskName"=>$taskName,
            "Description"=>$taskDescription,
            "taskTime"=>$taskTime
        );
        array_push($task_array['tasks'],$tasks);
    }
    echo json_encode($task_array);
}else{
    echo '{';
        echo '"Error": "User name not found"';
    echo '}';
}



?>